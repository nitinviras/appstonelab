<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->authenticate->check();
        $this->load->model('user_model');
        $this->load->model('user_details_model');
        $this->load->model('user_upload_item');
        $this->load->model('user_services_model');
    }

    public function index() {
       $data['title'] = "User";
       $data['User'] = $this->user_model->get();
       $this->load->view('index', $data);
    }

    public function user_details() {
        $data['title'] = "User Details";
        $id = (int) $this->input->get('id');
        $data['User'] = $this->user_model->get($id);
        $user_details = array('user_id' => $id);
        $data['User_details'] = $this->user_details_model->get(FALSE, $user_details, array());
        $row_search = array('user_id' => $id);
        $data['User_products'] = $this->user_upload_item->get(FALSE, $row_search, array());
        $row_search = array('user_id' => $id);
        $data['User_services'] = $this->user_services_model->get(FALSE, $row_search, array());
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->load->view('user_details', $data);
    }

}
