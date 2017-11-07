<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_inquiry extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('service_inquiry_model');
    }

    public function index() {
        $data['title'] = "Service_inquiry";
        $data['Service_inquiry'] = $this->service_inquiry_model->get();
        $this->load->view('index', $data);
    }
}
