<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tag extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tag_model');
    }

    public function index() {
        $data['title'] = "Tag";
        $data['Tag'] = $this->tag_model->get();
        $this->load->view('index', $data);
    }

    public function insert_tag() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['Tags'] = $this->tag_model->get($id);
        }
        $data['title'] = "Insert Tag";
        $this->load->view('insert_tag', $data);
    }

    public function save_tag() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('tag_name', 'Tag Name', 'required|is_unique[theme_tag.name.ID.' . $id . ']');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_tag();
        } else {

            $data = array(
                'name' => $this->input->post('tag_name'),
                'status' => $this->input->post('tag_status'),
            );
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->tag_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Tag Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->tag_model->insert($data);
                $this->session->set_flashdata('msg', "Tag Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }


            return redirect('tag', 'redirect');
        }
    }

    public function tag_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Tag succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Tag succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->tag_model->edit($id, $data);
        return redirect('tag', 'redirect');
    }

    public function delete_tag() {
        $id = (int) $this->input->get('id');
        $this->tag_model->delete($id);
        $this->session->set_flashdata('msg', "Your Tag succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('tag', 'redirect');
    }

}
