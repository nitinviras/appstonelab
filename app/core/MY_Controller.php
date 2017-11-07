<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('username')) {
            $this->session->set_flashdata('msg', "You Already Login.");
            $this->session->set_flashdata('msg_class', 'failure');
            return redirect('author_profile', 'redirect');
        }
    }

}

?>