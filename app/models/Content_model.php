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

}

?>