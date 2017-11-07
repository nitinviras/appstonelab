<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('file_model');
//       $this->load->library('MY_Form_validation');
       
    }

    public function index() {
        $data['title'] = "file";
        $data['File'] = $this->file_model->get();
        $this->load->view('index', $data);
    }

    public function insert_file() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['File'] = $this->file_model->get($id);
        }
        $data['title'] = "Insert file";
        $this->load->view('insert_file', $data);
    }

    public function save_file() {
      
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('file_name', 'file Name', 'required|is_unique[theme_user_compatible_browsers.browser_name.ID.' . $id . ']');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
     if ($this->form_validation->run() == FALSE) {
        $this->insert_file();
        } else {
             
            $data = array(
                'file_name' => $this->input->post('file_name'),
                'status' => $this->input->post('file_status'),
                'category' => $this->input->post('category'),
            );
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->file_model->edit($id, $data);
                $this->session->set_flashdata('msg', "file Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->file_model->insert($data);
                $this->session->set_flashdata('msg', "file Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }


            return redirect('file', 'redirect');
        }
    }
        
    public function file_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your file succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your file succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->file_model->edit($id, $data);
        return redirect('file', 'redirect');
    }

    public function delete_file() {
        $id = (int) $this->input->get('id');
        $this->file_model->delete($id);
        $this->session->set_flashdata('msg', "Your file succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('file', 'redirect');
    }

}
