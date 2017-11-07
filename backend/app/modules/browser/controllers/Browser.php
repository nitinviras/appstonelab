<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Browser extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('browser_model');
//       $this->load->library('MY_Form_validation');
       
    }

    public function index() {
        $data['title'] = "Browser";
        $data['Browser'] = $this->browser_model->get();
        $this->load->view('index', $data);
    }

    public function insert_browser() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['Browser'] = $this->browser_model->get($id);
        }
        $data['title'] = "Insert Browser";
        $this->load->view('insert_browser', $data);
    }

    public function save_browser() {
      
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('browser_name', 'Browser Name', 'required|is_unique[theme_user_compatible_browsers.browser_name.ID.' . $id . ']');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
     if ($this->form_validation->run() == FALSE) {
        $this->insert_browser();
        } else {
             
            $data = array(
                'category' => $this->input->post('category'),
                'browser_name' => $this->input->post('browser_name'),
                'status' => $this->input->post('browser_status'),
            );
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->browser_model->edit($id, $data);
                $this->session->set_flashdata('msg', "browser Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->browser_model->insert($data);
                $this->session->set_flashdata('msg', "browser Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }


            return redirect('browser', 'redirect');
        }
    }
        
    public function browser_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your browser succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your browser succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->browser_model->edit($id, $data);
        return redirect('browser', 'redirect');
    }

    public function delete_browser() {
        $id = (int) $this->input->get('id');
        $this->browser_model->delete($id);
        $this->session->set_flashdata('msg', "Your browser succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('browser', 'redirect');
    }

}
