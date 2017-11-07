<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_services_model');
        $this->load->model('user_details_model');
    }

    public function index() {
        $data['title'] = "Dashboard";
        $row_pending = array('service_status' => 'P');
        $row_approve = array('service_status' => 'A');
        $data['pending'] = $this->user_services_model->get(FALSE, $row_pending, array());
        $data['approve'] = $this->user_services_model->get(FALSE, $row_approve, array());
        $this->load->view('index', $data);
    }

    public function delete_service() {
        $id = $this->input->get('id');
        $data['pending'] = $this->user_services_model->delete($id);
        $this->load->view('index', $data);
    }

    public function save_service_review() {
        $status = $this->input->post('status');
        if ($status == 'Reject') {
            $this->form_validation->set_rules('item_description', 'Why Product Rejected??', 'required');
            $this->form_validation->set_message('required', 'Please Enter %s');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->pending();
            } else {
                $id = $this->input->post('id');
                $data = array(
                    'service_status' => $this->input->post('status'),
                    'rejection_reject' => $this->input->post('item_description')
                );
                $this->user_services_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Product has Rejected.");
                $this->session->set_flashdata('msg_class', 'success');
                return redirect('index', 'redirect');
            }
        } else {
            $id = $this->input->post('id');
            $data = array(
                'service_status' => $this->input->post('status'),
                'rejection_reject' => $this->input->post('item_description')
            );
            $this->user_services_model->edit($id, $data);
            $this->session->set_flashdata('msg', "Product has Approved.");
            $this->session->set_flashdata('msg_class', 'success');
            return redirect('index', 'redirect');
        }
    }

    public function service_pending() {
        $id = $this->input->get_post('id');
        $user_id = $this->input->get_post('user_id');
        $row_user_details = array('user_id' => $user_id);
        $data = array(
            'title' => "Pending Product",
            'id' => $id,
            'user_id' => $user_id,
            'pending' => $this->user_services_model->get($id),
            'user_details' => $this->user_details_model->get(FALSE, $row_user_details, array())
        );
        $this->load->view('service_pending', $data);
    }

}
