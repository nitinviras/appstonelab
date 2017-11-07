<?php

class Content_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_users', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_users', $data);
    }

    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_users');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'user_activation_key' => '',
                'user_email' => '',
                'user_login' => '',
                'ID' => ''
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['ID'] != '') {
                $this->db->where('ID', $search['ID']);
            }
            if ($search['user_activation_key'] != '') {
                $this->db->where('user_activation_key', $search['user_activation_key']);
            }
            if ($search['user_email'] != '') {
                $this->db->where('user_email', $search['user_email']);
            }
            if ($search['user_login'] != '') {
                $this->db->select('theme_users.ID as uid,theme_users.*,theme_user_details.*,theme_user_social_link.fb_link,theme_user_social_link.gplus_link,theme_user_social_link.twt_link,theme_cities.name AS cityname,theme_countries.name AS countryname,theme_states.name AS statename', FALSE);
                $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_users.ID', 'left');
                $this->db->join('theme_user_social_link', 'theme_user_social_link.user_id =theme_users.ID', 'left');
                $this->db->join('theme_cities', 'theme_cities.id =theme_user_details.city', 'left');
                $this->db->join('theme_states', 'theme_states.id =theme_user_details.state', 'left');
                $this->db->join('theme_countries', 'theme_countries.id =theme_user_details.country', 'left');
                $this->db->where('user_login', $search['user_login']);
            }
            $query = $this->db->get('theme_users');
            return $query->row();
        } else {
            $query = $this->db->get('theme_users');
            return $query->result();
        }
    }

    function getData($tbl = '', $fields, $condition = '', $join_ary = array(), $orderby = '', $groupby = '', $having = '', $climit = '', $paging_array = array(), $reply_msgs = '', $like = array()) {

        if ($fields == '') {
            $fields = "*";
        }
        $this->db->select($fields, FALSE);

        if (trim($condition) != '') {
            $this->db->where($condition, false, false);
        }
        if (is_array($join_ary) && count($join_ary) > 0) {
            foreach ($join_ary as $ky => $vl) {
                $this->db->join($vl['table'], $vl['condition'], $vl['jointype']);
            }
        }
        if (trim($groupby) != '') {
            $this->db->group_by($groupby);
        }
        if (trim($having) != '') {
            $this->db->having($having, FALSE);
        }
        if ($orderby != '' && is_array($paging_array) && count($paging_array) == "0") {
            $this->db->order_by($orderby, FALSE);
        }
        if (trim($climit) != '') {
            $this->db->limit($climit);
        }
        if ($tbl != '') {
            $this->db->from($tbl);
        } else {
            $this->db->from($this->main_table);
        }
        $list_data = $this->db->get()->result_array();
        return $list_data;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('theme_users');
    }

    public function validate() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean(md5($this->input->post('password')));
        $this->db->where('user_pass', $password);
        $this->db->where('user_email', $username);
        $this->db->or_where('user_login', $username);
        $query = $this->db->get('theme_users');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        } else {
            return false;
        }
    }

    public function country() {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('theme_countries');
        return $query->result();
    }

    public function state($cid) {
        $this->db->order_by('name', 'asc');
        $this->db->where('country_id', $cid);
        $query = $this->db->get('theme_states');
        return $query->result();
    }

    public function city($sid) {
        $this->db->order_by('name', 'asc');
        $this->db->where('state_id', $sid);
        $query = $this->db->get('theme_cities');
        return $query->result();
    }

    public function tag() {
        $this->db->order_by('name', 'asc');
        $this->db->where('status', 'A');
        $query = $this->db->get('theme_tag');
        return $query->result();
    }

    public function compatible_browsers() {
        $this->db->order_by('browser_name', 'asc');
        $this->db->where('status', 'A');
        $query = $this->db->get('theme_user_compatible_browsers');
        return $query->result();
    }

    public function themeforest_file() {
        $this->db->order_by('file_name', 'asc');
        $this->db->where('status', 'A');
        $query = $this->db->get('theme_themeforest_file');
        return $query->result();
    }

    function getSingleRow($tbl, $condition) {
        $this->db->select("*", FALSE);
        $this->db->from($tbl);
        $this->db->where($condition, false, false);
        return $this->db->get()->row_array();
    }

    function getTotalView($tbl, $condition) {
        $this->db->select("*", FALSE);
        $this->db->where($condition, false, false);
        $query = $this->db->get($tbl);
        return $query->num_rows();
    }

    function follwer_feeddata($tbl, $condition) {
        $this->db->select('theme_user_upload_item.*, theme_user_parent_category.title AS p_catagory, theme_user_parent_category.category, theme_user_details.profile_photo, theme_user_details.company_name', FALSE);
        $this->db->join('theme_user_parent_category', 'theme_user_parent_category.ID =theme_user_upload_item.item_parent_category', 'left');
        $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_upload_item.user_id', 'left');
        $this->db->where($condition, false, false);
        $this->db->order_by("theme_user_upload_item.created_date", "desc");
        $this->db->limit(2, 0);
        $query = $this->db->get($tbl);
        return $query->result();
    }

    function more_product($tbl, $condition) {
        $this->db->select(''.$tbl.'.*, theme_user_parent_category.title AS p_catagory, theme_user_parent_category.category, theme_user_details.profile_photo, theme_user_details.company_name', FALSE);
        $this->db->join('theme_user_parent_category', 'theme_user_parent_category.ID ='.$tbl.'.item_parent_category', 'left');
        $this->db->join('theme_user_details', 'theme_user_details.user_id ='.$tbl.'.user_id', 'left');
        $this->db->where($condition, false, false);
        $this->db->order_by("".$tbl.".created_date", "desc");
        $this->db->limit(2, 0);
        $query = $this->db->get($tbl);
        return $query->result();
    }
    function more_service($tbl, $condition) {
        $this->db->select(''.$tbl.'.*,  theme_user_service_category.name AS s_category, theme_user_details.profile_photo, theme_user_details.company_name', FALSE);
        $this->db->join('theme_user_service_category', 'theme_user_service_category.ID ='.$tbl.'.service_category', 'left');
        $this->db->join('theme_user_details', 'theme_user_details.user_id ='.$tbl.'.user_id', 'left');
        $this->db->where($condition, false, false);
        $this->db->order_by("".$tbl.".created_date", "desc");
        $this->db->limit(2, 0);
        $query = $this->db->get($tbl);
        return $query->result();
    }

}

?>