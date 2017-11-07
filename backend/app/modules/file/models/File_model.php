<?php

class File_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_themeforest_file', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_themeforest_file', $data);
    }

    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_themeforest_file');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'profile_photo' => '',
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['profile_photo'] != '') {
                $this->db->where('profile_photo', $search['profile_photo']);
            }
            $query = $this->db->get('theme_themeforest_file');
            return $query->result();
        } else {
            $query = $this->db->get('theme_themeforest_file');
            return $query->result();
        }
    }

    public function delete($id) {

        $this->db->where('ID', $id);
        $this->db->delete('theme_themeforest_file');
    }
}

?>
