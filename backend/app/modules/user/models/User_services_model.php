<?php

class User_services_model extends CI_Model {

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_user_services', $data);
    }

    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_user_services');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'user_id' => '',
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['user_id'] != '') {
                $this->db->where('user_id', $search['user_id']);
            }
            $query = $this->db->get('theme_user_services');
            return $query->result();
        } else {
            $query = $this->db->get('theme_user_services');
            return $query->result();
        }
    }

    public function delete($id) {
        $this->db->where('ID', $id);
        $this->db->delete('theme_user_services');
    }

}

?>
