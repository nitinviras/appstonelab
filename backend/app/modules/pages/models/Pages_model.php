<?php

class Pages_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_pages', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_pages', $data);
    }

    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_pages');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'profile_photo' => '',
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['profile_photo'] != '') {
                $this->db->where('profile_photo', $search['profile_photo']);
            }
            $query = $this->db->get('theme_pages');
            return $query->result();
        } else {
            $query = $this->db->get('theme_pages');
            return $query->result();
        }
    }

    public function delete($id) {

        $this->db->where('ID', $id);
        $this->db->delete('theme_pages');
    }
}

?>
