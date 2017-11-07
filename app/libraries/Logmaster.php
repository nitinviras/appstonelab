<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logmaster {

    public function save_log($user_id, $activity, $location) {
        $CI = & get_instance();
        $data = array(
            'user_id' => $user_id,
            'date' => date("Y-m-d H:i:s"),
            'user_ip' => isset($location['ip']) ? $location['ip'] : "",
            'city' => isset($location['city']) ? $location['city'] : "",
            'state' => isset($location['region']) ? $location['region'] : "",
            'country' => isset($location['country']) ? $location['country'] : "",
            'loc' => isset($location['loc']) ? $location['loc'] : "",
            'org' => isset($location['org']) ? $location['org'] : "",
            'activity' => isset($activity) ? $activity : ""
        );
        $CI->db->insert('theme_user_log', $data);
    }

}

?>