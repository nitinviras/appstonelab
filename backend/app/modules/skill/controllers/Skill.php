<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skill extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('skill_model');
    }

    public function index() {
        $data['title'] = "Skill";
        $data['Skill'] = $this->skill_model->get();
        $this->load->view('index', $data);
    }

    public function insert_skill() {
        $id = (int) $this->input->get_post('id');
        if ($id > 0) {
            $data['Skills'] = $this->skill_model->get($id);
        }
        $data['title'] = "Insert Skill";
        $this->load->view('insert_skill', $data);
    }

    public function save_skill() {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('skill_name', ' Enter Skill Name', 'required|is_unique[theme_category_skill.name.ID.' . $id . ']');
        $this->form_validation->set_rules('category', 'Select category', 'required');
        $this->form_validation->set_message('required', 'Please %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_skill();
        } else {

            $data = array(
                'name' => $this->input->post('skill_name'),
                'category' => $this->input->post('category'),
                'status' => $this->input->post('skill_status'),
            );

            if ($id > 0) {
                $this->skill_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Skill Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->skill_model->insert($data);
                $this->session->set_flashdata('msg', "Skill Insert SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
            }
            return redirect('skill', 'redirect');
        }
    }

    public function skill_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
            );

            $this->session->set_flashdata('msg', "Your Skill succesfilly Deactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
            );
            $this->session->set_flashdata('msg', "Your Skill succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->skill_model->edit($id, $data);
        return redirect('skill', 'redirect');
    }

    public function delete_skill() {
        $id = (int) $this->input->get('id');
        $this->skill_model->delete($id);
        $this->session->set_flashdata('msg', "Your Skill succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('skill', 'redirect');
    }

}
