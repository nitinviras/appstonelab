<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('support_model');
    }

    public function index() {
        $data['title'] = "Support Ticket";
        $data['tickets'] = $this->support_model->get();
        $this->load->view('index', $data);
    }

    public function support_detail($ticket_id,$user_id) {
        $data['title'] = "Support Ticket Detail";
        $admin_data = $this->support_model->admin_detail();
        $data['message_data'] = $this->support_model->get_ticket_detail($ticket_id);
        $data['user_id']=$user_id;
        $data['admin_data'] = $admin_data;
        $this->load->view('support_detail', $data);
    }
    public function save_send_message() {
        $ticket_id =$this->input->post('msg_ticket_id');
        $send_user_id =$this->input->post('token_from');
        $user_id =$this->input->post('user_id');
        $this->form_validation->set_rules('message_text', 'Type Message','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this-> support_detail($ticket_id,$user_id);
        } else {
            $data = array(
                'ticket_id'=>$ticket_id,
                'summary' => $this->input->post('message_text'),
                'type'=>0
                );
            if ($ticket_id  > 0) {
                
            $user_record=$user_record=$this->support_model->email_user_data($user_id);
            $user_email =$user_record[0]->user_email;
            $name= ucfirst($user_record[0]->first_name) . " " . ucfirst($user_record[0]->last_name);
            $message =$this->input->post('message_text');
            $html = $this->load->view("mail/support_mail", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $subject = "Ticket details notification";
            $define_param['to_name'] = $name;
            $define_param['to_email'] = $user_email;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $data['created_on'] = date("Y-m-d H:i:s");
            $this->support_model->insert($data);
            $this->session->set_flashdata('msg', "Message Send SuccessFully.");
            $this->session->set_flashdata('msg_class', 'success');
                 } 
               
        return redirect('support/support_detail/'.$ticket_id.'/'.$user_id,'redirect');
        }
    }

}
