<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

Class General {

    public function getLoginUser($tbl, $condition) {
        $CI = & get_instance();
        $CI->db->select('theme_users.user_login,theme_users.user_email,theme_user_details.*', FALSE);
        $CI->db->from('theme_users');
        $CI->db->join('theme_user_details', 'theme_user_details.user_id=theme_users.ID', "inner");
        $CI->db->where($condition, false, false);
        return $CI->db->get()->row_array();
    }

    public function add3dots($string, $repl, $limit) {
        if (strlen($string) > $limit) {
            return substr($string, 0, $limit) . $repl;
        } else {
            return $string;
        }
    }

    public function slugify($str) {
        $search = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
        $str = str_ireplace($search, $replace, strtolower(trim($str)));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        return preg_replace('/\-{2,}/', '-', $str);
    }

}
