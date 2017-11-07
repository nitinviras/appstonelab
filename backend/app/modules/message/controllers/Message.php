<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function index() {
        $data['title'] = "Message Inquiry";
        $data['Message'] = $this->message_model->get();
       $this->load->view('index', $data);
       
    }

   
    
}
