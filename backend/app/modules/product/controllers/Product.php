<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_upload_item');
        $this->load->model('user_details_model');
    }

    public function index() {
        $data['title'] = "Dashboard";
        $row_pending = array('item_status' => 'P');
        $row_approve = array('item_status' => 'A');
        $data['pending'] = $this->user_upload_item->get(FALSE, $row_pending, array());
        $data['approve'] = $this->user_upload_item->get(FALSE, $row_approve, array());
        $this->load->view('index', $data);
        
    }

    public function delete_product() {
        $id = $this->input->get('id');
        $data['pending'] = $this->user_upload_item->delete($id);
        $this->load->view('index', $data);
    }

    public function save_review() {
        $status = $this->input->post('status');
        $user_id= $this->input->post('user_id');
        $id = $this->input->post('id');
        $user_record=$this->user_details_model->email_user_data($user_id);
        
        if ($status == 'Reject') {
            $this->form_validation->set_rules('item_description', 'Why Product Rejected??', 'required');
            $this->form_validation->set_message('required', 'Please Enter %s');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->pending();
            } else {
                
                $data = array(
                    'item_status' => $this->input->post('status'),
                    'rejection_reject' => $this->input->post('item_description')
                );
            $this->user_upload_item->edit($id, $data);
           
            $user_email = $user_record[0]->user_email;
            $name= ucfirst($user_record[0]->first_name) . " " . ucfirst($user_record[0]->last_name);
            $message = "Warning! Your product has not Approved".$this->input->post('item_description');
            $html = $this->load->view("mail/product_detail", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $subject = "Product Notification";
            $define_param['to_name'] = $name;
            $define_param['to_email'] = $user_email;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('msg', "Product has Rejected.");
            $this->session->set_flashdata('msg_class', 'success');
            return redirect('index', 'redirect');
            }
        } else {
           
            $data = array(
                'item_status' => $this->input->post('status'),
                'rejection_reject' => $this->input->post('item_description')
            );
            $this->user_upload_item->edit($id, $data);
            $user_email = "nikulpateletc49@gmail.com";//$user_record[0]->user_email;
            $name= ucfirst($user_record[0]->first_name) . " " . ucfirst($user_record[0]->last_name);
            $message = "Congratulations! Your product has been Approved";
            $html = $this->load->view("mail/product_detail", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $subject = "Product Notification";
            $define_param['to_name'] = $name;
            $define_param['to_email'] = $user_email;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('msg', "Product has Approved.");
            $this->session->set_flashdata('msg_class', 'success');
            return redirect('index', 'redirect');
        }
    }

    public function pending() {
        $id = $this->input->get_post('id');
        $user_id = $this->input->get_post('user_id');
        $row_user_details = array('user_id' => $user_id);
        $data = array(
            'title' => "Pending Product",
            'id' => $id,
            'user_id' => $user_id,
            'pending' => $this->user_upload_item->get($id),
            'user_details' => $this->user_details_model->get(FALSE, $row_user_details, array())
        );
        $this->load->view('pending', $data);
    }

}
