<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('content_model');
    }

    public function error_page() {
        $this->load->view('error_page');
    }

    public function index() {
        $data['title'] = "Home";
        $this->template->load('main_page', 'index', $data);
    }

    public function service() {
        $data['title'] = "Service";
        $this->template->load('main_page', 'service', $data);
    }

    public function portfolio() {
        $data['title'] = "portfolio";
        $this->template->load('main_page', 'portfolio', $data);
    }

    public function portfolio_details() {
        $data['title'] = "portfolio-details";
        $this->template->load('main_page', 'portfolio_details', $data);
    }

    public function service_details() {
        $data['title'] = "Service Details";
        $this->template->load('main_page', 'service-details', $data);
    }

    public function about_us() {
        $data['title'] = "About us";
        $this->template->load('main_page', 'about-us', $data);
    }

    public function contact_us() {
        $data['title'] = "Contact us";
        $this->template->load('main_page', 'contact-us', $data);
    }

}

?>