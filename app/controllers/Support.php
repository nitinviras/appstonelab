<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            return redirect('login', 'redirect');
        } else if ($this->session->userdata('profile_completed') == 0) {
            $this->session->set_flashdata('msg', "Please Complete Your Profile.");
            $this->session->set_flashdata('msg_class', 'failure');
            return redirect('account', 'redirect');
        }
        $this->load->model('support_model');
    }

    public function index() {

        $user_id = (int) $this->session->userdata('user_id');
        if ($user_id) {

            $message_data = $this->support_model->support_ticket();
            $data['message_data'] = $message_data;
            $data['title'] = "Support Ticket";
            $this->template->load('dashboard_page', 'dashboard/support', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function add_support() {
        $user_id = (int) $this->session->userdata('user_id');
        if ($user_id) {
            $data['title'] = "Add Support Ticket";
            $this->template->load('dashboard_page', 'dashboard/add_support', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function support_details() {
        $user_id = (int) $this->session->userdata('user_id');
        $id = $this->input->get_post('token');

        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);

        if ($get_id > 0) {

            $message_data = $this->support_model->support_detail($get_id);
            $admin_data = $this->support_model->admin_detail();

            $data['message_data'] = $message_data;
            $data['admin_data'] = $admin_data;

            $data['title'] = "Ticket Details";
            $data['other_id'] = $get_id;
            $this->template->load('dashboard_defaults', 'dashboard/support_details', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function send_ticket_replay() {

        $msg_ticket_id = $this->input->post('msg_ticket_id');
        $from_user_id = $this->encryption->encrypt($msg_ticket_id);
        $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);

        $this->form_validation->set_rules('message_text', 'Replay Message', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            redirect("support_details?token=$encrypted_from_id", 'redirect');
        } else {
            $token_from_dec = $this->input->post('token_from');
            $message_text = $this->input->post('message_text');
            //get msg from_id 

            $dec_token_from = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_from_dec);
            $msg_from_id = (int) $this->encryption->decrypt($dec_token_from);

            //get msg to 
            $msg_to_id = (int) 1;
            $location = $this->location->map();

            $data['ticket_id'] = $msg_ticket_id;
            $data['summary'] = $message_text;
            $data['type'] = 1;
            $data['created_on'] = date("Y-m-d H:i:s");
            $data['ip'] = isset($location['ip']) ? $location['ip'] : "";
            $id = $this->support_model->Add('theme_support_detail', $data);

            if ($id) {
                $ticket_res = $this->support_model->ticket_detail($msg_ticket_id);
                $topic = isset($ticket_res->topic) ? $ticket_res->topic : '';
                $sender = $this->session->userdata("username");

                $message = "Support Ticket Reply";
                $html = $this->load->view("mail/support_ticket_reply", '', true);
                $html = str_replace('%message%', $message, $html);
                $html = str_replace('%sender%', $sender, $html);
                $html = str_replace('%ticket_id%', $msg_ticket_id, $html);
                $html = str_replace('%topic%', $topic, $html);
                $html = str_replace('%summary%', $message_text, $html);
                $subject = "Support Ticket Reply";
                $define_param['to_name'] = MY_SITE_NAME;
                $define_param['to_email'] = ADMIN_EMAIL;
                $send = $this->sendmail->send($define_param, $subject, $html);

                $this->session->set_flashdata('msg', "Your reply has been send successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect("support");
            }
        }
    }

    public function save_support_ticket() {
        $this->load->helper('string');
        $get_id = $this->input->post('token');
        $this->form_validation->set_rules('topic', 'Topic', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('summary', 'Summary', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->add_service();
        } else {

            $random_ticket_id = random_string('numeric', 6);
            $topic = $this->input->post('topic');
            $data = array(
                'ticket_id' => $random_ticket_id,
                'user_id' => $this->session->userdata('user_id'),
                'topic' => $topic,
                'status' => 'A',
                'created_on' => date("Y-m-d H:i:s")
            );
            $id = $this->support_model->Add('theme_support_master', $data);

            if ($id) {

                $location = $this->location->map();
                $summary = $this->input->post('summary');
                $data = array(
                    'ticket_id' => $random_ticket_id,
                    'summary' => $summary,
                    'type' => '1',
                    'ip' => isset($location['ip']) ? $location['ip'] : "",
                    'created_on' => date("Y-m-d H:i:s")
                );
                $sid = $this->support_model->Add('theme_support_detail', $data);
                $foldername = sha1("support_" . $random_ticket_id);
                if (!is_dir(uploads_path . '/support/' . $foldername)) {
                    mkdir(uploads_path . '/support/' . $foldername);
                    chmod(uploads_path . '/support/' . $foldername, 0777);
                }
                $config['upload_path'] = uploads_path . '/support/' . $foldername;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $temp = explode(".", $_FILES["main_image"]['name']);
                $new_name = 'main_image' . '.' . end($temp);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $data['upload_data'] = '';
                if (isset($_FILES['main_image']) && $_FILES['main_image'] != '') {
                    $this->upload->do_upload('main_image');
                    $data['upload_data'] = $this->upload->data();
                }
                $file['upload'] = $this->upload->data('file_type');
                $file['upload_data'] = $this->upload->data('file_name');
                if ($file['upload'] && $file['upload'] != '') {
                    $main_image['image'] = $file['upload_data'];
                    $cond = 'ID =' . $sid;
                    $this->support_model->edit('theme_support_detail', $cond, $main_image);
                }

                $sender = $this->session->userdata("username");

                $message = "New Support Ticket";
                $html = $this->load->view("mail/new_support_ticket", '', true);
                $html = str_replace('%message%', $message, $html);
                $html = str_replace('%sender%', $sender, $html);
                $html = str_replace('%ticket_id%', $random_ticket_id, $html);
                $html = str_replace('%topic%', $topic, $html);
                $html = str_replace('%summary%', $summary, $html);
                $subject = "New Support Ticket";
                $define_param['to_name'] = MY_SITE_NAME;
                $define_param['to_email'] = ADMIN_EMAIL;
                $send = $this->sendmail->send($define_param, $subject, $html);
            }

            if ($sid > 0 && !empty($sid)) {
                $this->session->set_flashdata('msg', "Your support ticket been generated.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('support', 'redirect');
            }
        }
    }

}
