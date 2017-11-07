<?php

class Skill_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('theme_category_skill', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_category_skill', $data);
    }

    public function get($id = FALSE) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_category_skill');
            return $query->row();
        } else {
            $query = $this->db->get('theme_category_skill');
            return $query->result();
        }
    }

    public function delete($id) {

        $this->db->where('ID', $id);
        $this->db->delete('theme_category_skill');
    }
}

?>
