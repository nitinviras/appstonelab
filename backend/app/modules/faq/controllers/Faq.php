<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('faq_model');
//       $this->load->library('MY_Form_validation');
       
    }

    public function index() {
        $data['title'] = "faq";
        $data['Faq'] = $this->faq_model->get();
        $this->load->view('index', $data);
    }

    public function insert_faq() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['Faq'] = $this->faq_model->get($id);
        }
        $data['title'] = "Insert faq";
        $this->load->view('insert_faq', $data);
    }

    public function save_faq() {
      
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('faq_name', 'faq Name', 'required|is_unique[theme_faq.title.ID.' . $id . ']');
        $this->form_validation->set_rules('faq_description', 'Faq Description', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
     if ($this->form_validation->run() == FALSE) {
        $this->insert_faq();
        } else {
             
                 $data = array(
                'title' => $this->input->post('faq_name'),
                'description' => $this->input->post('faq_description'),
                'status' => $this->input->post('faq_status'),
            );
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->faq_model->edit($id, $data);
                $this->session->set_flashdata('msg', "faq Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->faq_model->insert($data);
                $this->session->set_flashdata('msg', "faq Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }


            return redirect('faq', 'redirect');
        }
    }
        
    public function faq_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your faq succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your faq succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->faq_model->edit($id, $data);
        return redirect('faq', 'redirect');
    }

    public function delete_faq() {
        $id = (int) $this->input->get('id');
        $this->faq_model->delete($id);
        $this->session->set_flashdata('msg', "Your faq succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('faq', 'redirect');
    }

}
