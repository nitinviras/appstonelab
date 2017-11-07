<?php

class Setting_model extends CI_Model {

//    public function insert($data) {
//
//        $this->db->insert('theme_setting', $data);
//        $id = $this->db->insert_ID();
//        return $id;
//    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_setting', $data);
    }

    public function get($id =FALSE) {
        if ($id) {
            $this->db->where('user_id', $id);
            $query = $this->db->get('theme_setting');
            return $query->row();
        } 
    }

    
}

?>
