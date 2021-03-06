<?php

class User_details_model extends CI_Model {

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
