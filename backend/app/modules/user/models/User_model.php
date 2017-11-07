<?php

class User_model extends CI_Model {

    public function get($id = FALSE) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_users');
            return $query->row();
        }else {
            $query = $this->db->get('theme_users');
            return $query->result();
        }
    }

}

?>
