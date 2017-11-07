<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('oauth_clients_model');
        $this->load->model('user_details_model');
    }

    public function register() {
        $data['title'] = 'Register';
        $this->template->load('root_page', 'register', $data);
    }

    public function save_register() {
        $this->form_validation->set_rules('username', 'username', 'required|min_length[6]|max_length[50]|is_unique[theme_users.user_login]');
        $this->form_validation->set_message('required', 'Please enter your %s');
        $this->form_validation->set_message('min_length', ' Please enter minimum 6 characters');
        $this->form_validation->set_message('max_length', ' Please enter maximum 50 characters');

        $this->form_validation->set_message('is_unique', 'The %s is already exists');
        $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|max_length[50]|is_unique[theme_users.user_email]');
        $this->form_validation->set_message('required', 'Please enter your %s');
        $this->form_validation->set_message('valid_email', ' Please enter valid email');
        $this->form_validation->set_message('max_length', ' Please enter maximum 50 characters');
        $this->form_validation->set_message('is_unique', 'The %s is already exists');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[35]|callback_valid_password');
        $this->form_validation->set_message('required', 'Please enter your %s');
        $this->form_validation->set_message('min_length', ' Please enter minimum 6 characters');
        $this->form_validation->set_message('max_length', ' Please enter maximum 35 characters');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = array(
                'user_login' => $this->input->post('username'),
                'user_email' => $this->input->post('email_address')
            );
            $password = $this->input->post('password');
            $data['user_pass'] = md5($password);
            $data['user_registered'] = date("Y-m-d H:i:s");
            $activation = md5(microtime());
            $data['user_activation_key'] = $activation;
            $result = $this->content_model->insert($data);
            $hidenuseremail = $this->input->post('email_address');
            $hidenusername = $this->input->post('username');
            $message = 'account verification';
            $url = base_url() . "content/verification_link?activation=" . $activation . "";
            $html = $this->load->view("mail/user_register", '', true);
            $html = str_replace('%username%', $hidenusername, $html);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%url%', $url, $html);

            $subject = "Verify Your Account";
            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $clients = array(
                'client_id' => $this->input->post('email_address'),
                'client_secret' => $this->input->post('password'),
                'user_id' => $result
            );
            $this->oauth_clients_model->insert($clients);
            $user_id = $result;
            $activity = 'User Register';
            $location = $this->location->map();
            $this->logmaster->save_log($user_id, $activity, $location);
            //admin mail
            $message = 'New user account has been created in themeshub';
            $html = $this->load->view("mail/admin_register", '', true);
            $html = str_replace('%username%', $hidenusername, $html);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%email%', $hidenuseremail, $html);


            $subject = "New User Register";
            $define_param['to_name'] = MY_SITE_NAME;
            $define_param['to_email'] = ADMIN_EMAIL;
            $send = $this->sendmail->send($define_param, $subject, $html);

            $this->session->set_flashdata('msg', "Your account has been register successfully. Please check your email to verify your account.");
            $this->session->set_flashdata('msg_class', 'success');
            redirect('register_success', 'redirect');
        }
    }

    public function login() {
        $data['title'] = 'Login';
        $this->template->load('root_page', 'login', $data);
    }

    public function valid_password($password = '') {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password)) {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        return TRUE;
    }

    public function save_login($activation_key = NULL) {
        $this->form_validation->set_rules('username', 'username or email', 'required');
        $this->form_validation->set_message('required', 'Please enter your %s');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', 'Please enter your %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $check = $this->content_model->validate();
            if ($check != FALSE) {
                $user_status = $check->user_status;
                if ($user_status == 'A') {
                    $data = array(
                        'user_id' => $check->ID,
                        'username' => $check->user_login,
                        'user_email' => $check->user_email,
                        'profile_completed' => $check->profile_completed,
                        'validated' => true
                    );
                    $this->session->set_userdata($data);
                    $user_id = $check->ID;
                    $activity = 'User Login';
                    $location = $this->location->map();
                    $this->logmaster->save_log($user_id, $activity, $location);
                    $row_search = array('user_id' => $check->ID);
                    $result = $this->user_details_model->get(FALSE, $row_search, array());
                    if (count($result) == 1) {
                        $this->session->set_userdata('profile_image', $result->profile_photo);
                    }
                    redirect('author_profile', 'redirect');
                } else {
                    $this->session->set_flashdata('msg', "Your email is not verified yet. Please verify now.");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect('login', 'redirect');
                }
            } else {
                $this->session->set_flashdata('msg', "Invalid login credential. Please try again");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('login', 'redirect');
            }
        }
    }

}

?>