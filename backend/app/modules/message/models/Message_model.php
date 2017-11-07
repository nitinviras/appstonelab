<?php

class message_model extends CI_Model {

    public function get() {
        $this->db->select('theme_messages.ID, `message_text`, tud1.first_name as from_firstname, tud1.last_name as from_lastname, tud2.first_name as to_firstname, tud2.last_name as to_lastname');
        $this->db->join('theme_user_details tud1', 'tud1.user_id = theme_messages.msg_from_id', 'INNER');
        $this->db->join('theme_user_details tud2', 'tud2.user_id = theme_messages.msg_to_id', 'INNER');
        $this->db->order_by('theme_messages.created_on','D');
        $query = $this->db->get('theme_messages');
        return $query->result();
    }

}

?>
