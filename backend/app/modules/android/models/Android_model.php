<?php

class Android_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_user_parent_category', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function get_android_category() {

        $this->db->from('theme_user_parent_category');
        $this->db->where('category', 'android');
        return $this->db->get()->result();
    }

    public function insert_subcategory($data) {

        $this->db->insert('theme_user_product_category', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function edit($id, $data) {

        $this->db->where('ID', $id);
        $this->db->update('theme_user_product_category', $data);
    }

    public function get($value = FALSE, $value2 = '', $id = FALSE) {
        if (!empty($value)) {
            $this->db->select('ID,title');
            $this->db->from('theme_user_parent_category');
            $this->db->where('category', $value);
            return $this->db->get()->result();
        } else if (!empty($value2)) {
            $this->db->select('theme_user_product_category.ID,theme_user_product_category.name,theme_user_product_category.status,theme_user_parent_category.title,theme_user_product_category.parent_category,theme_user_product_category.created_on,theme_user_product_category.updated_on');
            $this->db->from('theme_user_product_category');
            $this->db->join('theme_user_parent_category', 'theme_user_product_category.parent_category = theme_user_parent_category.ID');
            $this->db->where('theme_user_parent_category.category', $value2);
            return $this->db->get()->result();
        } else if (!empty($id)) {
            $this->db->select('theme_user_product_category.ID,theme_user_product_category.name,theme_user_product_category.status,theme_user_parent_category.title,theme_user_product_category.parent_category');
            $this->db->from('theme_user_product_category');
            $this->db->join('theme_user_parent_category', 'theme_user_product_category.parent_category=theme_user_parent_category.ID');
            $this->db->where('theme_user_product_category.ID', $id);
            return $this->db->get()->result();
        }
    }

    public function delete($id) {

        $this->db->where('ID', $id);
        $this->db->delete('theme_user_product_category');
    }

}

?>
