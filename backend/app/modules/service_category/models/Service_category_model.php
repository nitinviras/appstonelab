<?php

class Service_category_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_user_service_category', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function get_service_category() {
        $this->db->select('*');
        $this->db->from('theme_user_service_category');
        return $this->db->get()->result();
    }

    public function insert_subcategory($data) {

        $this->db->insert('theme_service_sub_category', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_service_sub_category', $data);
    }

    public function get($value ='', $value2 = '', $id = FALSE) {
        if (!empty($value)) {
            $this->db->select('*');
            $this->db->from('theme_user_service_category');
            return $this->db->get()->result();
        } else if (!empty($value2)) {
            $this->db->select('theme_service_sub_category.ID,theme_service_sub_category.name,theme_service_sub_category.status,theme_user_service_category.name AS title,theme_service_sub_category.category,theme_service_sub_category.created_on,theme_service_sub_category.updated_on');
            $this->db->from('theme_service_sub_category');
            $this->db->join('theme_user_service_category', 'theme_service_sub_category.category = theme_user_service_category.ID');
           
            return $this->db->get()->result();
        } else if (!empty($id)) {
            $this->db->select('theme_service_sub_category.ID,theme_service_sub_category.name,theme_service_sub_category.status,theme_user_service_category.name AS title,theme_service_sub_category.category');
            $this->db->from('theme_service_sub_category');
            $this->db->join('theme_user_service_category', 'theme_service_sub_category.category=theme_user_service_category.ID');
            $this->db->where('theme_service_sub_category.ID', $id);
            return $this->db->get()->result();
        }
    }

    public function delete($id) {

        $this->db->where('ID', $id);
        $this->db->delete('theme_service_sub_category');
    }

}

?>
