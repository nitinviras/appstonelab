<?php

class Product_inquiry_model extends CI_Model {

 public function get() {
        $this->db->select('inquiry_description, tud1.first_name as from_firstname, tud1.last_name as from_lastname, tud2.first_name as to_firstname, tud2.last_name as to_lastname');
        $this->db->join('theme_user_details tud1', 'tud1.user_id = theme_user_product_inquiry.inquiry_from_id', 'INNER');
        $this->db->join('theme_user_details tud2', 'tud2.user_id = theme_user_product_inquiry.inquiry_to_id', 'INNER');
        $this->db->order_by('theme_user_product_inquiry.created_on','D');
        $query = $this->db->get('theme_user_product_inquiry');
        return $query->result();
        
    }  
   
}
//SELECT `inquiry_description`, `tud1`.`first_name` as `from_firstname`, `tud1`.`last_name` 
//as `from_lastname`, `tud2`.`first_name` as `to_firstname`, `tud2`.`last_name` 
//as `to_lastname` FROM `theme_user_product_inquiry` INNER JOIN `theme_user_details` `tud1` ON
//`tud1`.`user_id` = `theme_user_product_inquiry`.`inquiry_from_id` INNER JOIN `theme_user_details` `tud2` ON
//`tud2`.`user_id` = `theme_user_product_inquiry`.`inquiry_to_id` 
// ORDER BY `theme_user_product_inquiry`.`created_on`
?>
