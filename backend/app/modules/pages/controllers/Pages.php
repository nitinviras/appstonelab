<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pages_model');
//       $this->load->library('MY_Form_validation');
       
    }

    public function index() {
        $data['title'] = "pages";
        $data['Pages'] = $this->pages_model->get();
        $this->load->view('index', $data);
    }

    public function insert_pages() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['Pages'] = $this->pages_model->get($id);
        }
        $data['title'] = "Insert pages";
        $this->load->view('insert_pages', $data);
    }

    public function save_pages() {
      
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('pages_name', 'pages Name', 'required|is_unique[theme_pages.name.ID.' . $id . ']');
        $this->form_validation->set_rules('pages_slug', 'pages Slug', 'required|is_unique[theme_pages.slug.ID.' . $id . ']');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
     if ($this->form_validation->run() == FALSE) {
        $this->insert_pages();
        } else {
             
            $data = array(
                'name' => $this->input->post('pages_name'),
                'slug' => $this->input->post('pages_slug'),
                'description' => $this->input->post('pages_description'),
                'status' => $this->input->post('pages_status'),
            );
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->pages_model->edit($id, $data);
                $this->session->set_flashdata('msg', "pages Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->pages_model->insert($data);
                $this->session->set_flashdata('msg', "pages Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }


            return redirect('pages', 'redirect');
        }
    }
        
    public function pages_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your pages succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your pages succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->pages_model->edit($id, $data);
        return redirect('pages', 'redirect');
    }

    public function delete_pages() {
        $id = (int) $this->input->get('id');
        $this->pages_model->delete($id);
        $this->session->set_flashdata('msg', "Your pages succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('pages', 'redirect');
    }

}
