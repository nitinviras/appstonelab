<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->authenticate->check();
    }

    public function index() {
        $data['title'] = "Dashboard";
        $this->load->view('index', $data);
    }

}
