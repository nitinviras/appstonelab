<?php

class User_details_model extends CI_Model {

    public function get($id = FALSE, $row_search = array(), $result_search = array()) {
        if ($id) {
            $this->db->where('ID', $id);
            $query = $this->db->get('theme_user_details');
            return $query->row();
        } else if (!empty($row_search)) {
            $defaultSearch = array(
                'user_id' => '',
            );
            $search = array_merge($defaultSearch, $row_search);
            if ($search['user_id'] != '') {
                $this->db->select('theme_user_details.*,theme_cities.name AS cityname,theme_countries.name AS countryname,theme_states.name AS statename', FALSE);
                $this->db->join('theme_cities', 'theme_cities.id =theme_user_details.city', 'left');
                $this->db->join('theme_states', 'theme_states.id =theme_user_details.state', 'left');
                $this->db->join('theme_countries', 'theme_countries.id =theme_user_details.country', 'left');
                $this->db->where('user_id', $search['user_id']);
            }
            $query = $this->db->get('theme_user_details');
            return $query->row();
        } else {
            $query = $this->db->get('theme_user_details');
            return $query->result();
        }
    }

}

?>
