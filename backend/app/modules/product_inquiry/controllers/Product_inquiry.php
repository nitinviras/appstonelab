<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_inquiry extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_inquiry_model');
    }

    public function index() {
        $data['title'] = "Product_inquiry";
        $data['Product_inquiry'] = $this->product_inquiry_model->get();
        $this->load->view('index', $data);
    }

   
    
}
