<?php

class support_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('theme_support_detail', $data);
        $id = $this->db->insert_ID();
        return $id;
    }

    public function get() {
        $query = "SELECT t1.user_id as from_user_id,t1.first_name as from_first_name,t1.last_name as from_last_name,t2.user_email,";
        $query .= "tsm.status,tsm.topic,tsm.created_on,tsm.ticket_id,tsm.ID as sid ";
        $query .= " FROM theme_support_master as tsm ";
        $query .= " LEFT JOIN theme_user_details as t1 ON t1.user_id =  tsm.user_id";
        $query .= " LEFT JOIN theme_users as t2 ON t2.ID =  t1.user_id";
        $query .= " GROUP BY tsm.ticket_id ORDER BY tsm.created_on desc";
        $query_rws = $this->db->query($query);
        return $query_rws->result();
    }

    public function get_ticket_detail($ticket_id) {
        $query = "SELECT tsm.*,t1.user_id, t1.profile_photo, t1.first_name, t1.last_name,theme_users.user_login";
        $query .= " FROM theme_support_detail as tsm ";
        $query .= " INNER JOIN theme_support_master as ts ON ts.ticket_id = tsm.ticket_id ";
        $query .= " INNER JOIN theme_user_details as t1 ON t1.user_id = ts.user_id ";
        $query .= " INNER JOIN theme_users on theme_users.ID=t1.user_id ";
        $query .= " Where tsm.ticket_id = $ticket_id ";
        //$query .= " ORDER BY tsm.created_on";

        $query_rws = $this->db->query($query);
        return $query_rws->result();
    }

    public function admin_detail() {
        $query = $this->db->get('theme_admin');
        return $query->row_array();
    }

    public function email_user_data($id) {
        if ($id) {
            $this->db->select('*', 'theme_users.user_email');
            $this->db->from('theme_user_details');
            $this->db->join('theme_users', 'theme_user_details.user_id =theme_users.ID');
            $this->db->where('theme_user_details.user_id', $id);
            return $this->db->get()->result();
        }
    }

}

?>
