<?php

class User_details_model extends CI_Model {
    
      public function email_user_data($id) {
        if ($id) {
            $this->db->select('*','theme_users.user_email');
            $this->db->from('theme_user_details');
            $this->db->join('theme_users', 'theme_user_details.user_id =theme_users.ID');
            $this->db->where('theme_user_details.user_id',$id);
         return $this->db->get()->result();
        }
      }
    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_user_details');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'user_id' => '',
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['user_id'] != '') {
                $this->db->where('user_id', $search['user_id']);
            }
            $query = $this->db->get('theme_user_details');
            return $query->row();
        } else {
            $query = $this->db->get('theme_user_details');
            return $query->result();
        }
    }

    
    
}

?>
