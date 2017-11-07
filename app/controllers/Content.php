<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('oauth_clients_model');
        $this->load->model('user_advertisement_model');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login', 'redirect');
    }

    public function register_success() {
        $data['title'] = 'Register';
        $this->template->load('page', 'register_success', $data);
    }

    public function forgot_password() {
        $data['title'] = 'Forgot Password';
        $this->template->load('root_page', 'forgot_password', $data);
    }

    public function feedback() {
        $data['title'] = 'Feedback';
        $this->template->load('root_page', 'feedback', $data);
    }
    public function advertisement() {
        $data['title'] = 'Advertisement';
        $this->template->load('root_page', 'advertisement', $data);
    }


    public function check_email() {

        $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->forgot_password();
        } else {
            $user_email = $this->input->post('email_address');
            $row_search = array('user_email' => $user_email);
            $result = $this->content_model->get(FALSE, $row_search, array());
            if (!empty($result)) {
                $user_status = $result->user_status;
                if ($user_status == 'A') {
                    $id = $result->ID;
                    $this->load->helper('string');
                    $code = random_string('numeric', 6);
                    $data = array(
                        'reset_password_code' => $code,
                        'reset_password_date' => date("Y-m-d H:i:s")
                    );
                    $this->content_model->edit($id, $data);
                    if ($user_email == $result->user_email) {
                        $enc_id = $this->encryption->encrypt($result->ID);
                        $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
                        $hidenuseremail = $user_email;
                        $hidenusername = $result->user_login;
                        $message = "account password reset";
                        $url = base_url() . "forgot_password_link?token=$encrypted_id";
                        $html = $this->load->view("mail/user_forgot_password", '', true);

                        $html = str_replace('%username%', $hidenusername, $html);
                        $html = str_replace('%message%', $message, $html);
                        $html = str_replace('%code%', $code, $html);
                        $html = str_replace('%url%', $url, $html);
                        $subject = "Reset Password";
                        $define_param['to_name'] = $hidenusername;
                        $define_param['to_email'] = $hidenuseremail;
                        $send = $this->sendmail->send($define_param, $subject, $html);
                        $this->session->set_flashdata('msg', "Reset password link has been sent.Please check your email box.");
                        $this->session->set_flashdata('msg_class', 'success');
                        redirect('forgot_password', 'redirect');
                    }
                } else {
                    $this->session->set_flashdata('msg', "Your email is not verified yet. Please verify now.");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect('forgot_password', 'redirect');
                }
            } else {
                $this->session->set_flashdata('msg', "Your email address not register with the system.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('forgot_password', 'redirect');
            }
        }
    }

    public function forgot_password_link() {
        $page_data['title'] = 'Reset Password';
        $get_id = $this->input->get('token');
        $dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = (int) $this->encryption->decrypt($dec_id);
        if ($id) {
            $result = $this->content_model->get($id);

            if (count($result) > 0) {
                $add_min = date("Y-m-d H:i:s", strtotime($result->reset_password_date . forgot));
                if ($add_min > date("Y-m-d H:i:s")) {
                    $this->template->load('root_page', 'forgot_link', $page_data);
                } else {
                    $this->session->set_flashdata('msg', "Reset password link has been expired. Please try again.");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect('forgot_password', 'redirect', $page_data);
                }
            } else {
                $this->session->set_flashdata('msg', "Invalid request. Please try again.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('login');
        }
    }

    public function forgot_password_save() {

        $this->form_validation->set_rules('code', 'Reset Code', 'required|min_length[6]|max_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id');
            $this->forgot_password_link($id);
        } else {
            $id = (int) $this->input->post('id');
            if ($id) {
                $result = $this->content_model->get($id);
                $code = $this->input->post('code');
                if ($code == $result->reset_password_code) {
                    $password = $this->input->post('password');
                    $data = array(
                        'user_pass' => md5($password),
                        'reset_password_code' => ''
                    );
                    $query = $this->content_model->edit($id, $data);
                    $client['client_secret'] = $password;
                    $this->oauth_clients_model->edit($id, $client);
                    $user_id = $id;
                    $activity = 'Change Password';
                    $location = $this->location->map();
                    $this->logmaster->save_log($user_id, $activity, $location);
                    $this->session->set_flashdata('msg', "Your password change successfully. Please log in now.");
                    $this->session->set_flashdata('msg_class', 'success');
                    redirect('login', 'redirect');
                } else {

                    $enc_id = $this->encryption->encrypt($id);
                    $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
                    $this->session->set_flashdata('msg', "Code is invalid.Please check your code.");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect('forgot_password_link?token=' . $encrypted_id, 'redirect');
                }
            } else {
                $this->session->set_flashdata('msg', "Invalid request. Please try again.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('login');
            }
        }
    }

    public function verification_link() {
        $activation_key = $this->input->get('activation');
        $row_search = array('user_activation_key' => $activation_key);
        $result = $this->content_model->get(FALSE, $row_search, array());
        if (count($result) > 0 && !empty($result)) {
            if ($result->user_status == 'A') {
                $this->session->set_flashdata('msg', "Your account has been already verified. Please Login.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('login', 'redirect');
            } else {
                $add_min = date("Y-m-d H:i:s", strtotime($result->user_registered . veri_link));
                if ($add_min > date("Y-m-d H:i:s")) {
                    $data['user_status'] = 'A';
                    $this->content_model->edit($result->ID, $data);
                    $data = array(
                        'user_id' => $result->ID,
                        'username' => $result->user_login,
                        'user_email' => $result->user_email,
                        'validated' => true
                    );
                    $this->session->set_userdata($data);
                    $user_id = $result->ID;
                    $activity = 'User Verified to Login';
                    $location = $this->location->map();
                    $this->logmaster->save_log($user_id, $activity, $location);
                    redirect('autologin_timer', 'redirect');
                    return true;
                } else {
                    $del_result = $this->content_model->delete($result->ID);
                    $this->session->set_flashdata('msg', "Your activation code has been expired. Please try again.");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect('content/register', 'redirect');
                }
            }
        }
    }

    public function autologin_timer() {
        $data['title'] = 'Redirection';
        $this->load->view('autologin_timer', $data);
    }

    public function save_feedback() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone no', 'numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->feedback();
        } else {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $html = $this->load->view("mail/user_feedback", '', true);

            $html = str_replace('%title%', $title, $html);
            $html = str_replace('%description%', $description, $html);
            $html = str_replace('%phone%', $phone, $html);
            $html = str_replace('%email%', $email, $html);
            $subject = "User Feedback";
            $define_param['to_name'] = "Admin";
            $define_param['to_email'] = ADMIN_EMAIL;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('msg', "Your feedack has been send successfully");
            $this->session->set_flashdata('msg_class', 'success');
            redirect('feedback', 'redirect');
        }
    }
    public function save_advertisement() {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'numeric');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('requirement', 'Requirement', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->feedback();
        } else {
            $company_name = $this->input->post('company_name');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $city = $this->input->post('city');
            $address = $this->input->post('address');
            $requirement = $this->input->post('requirement');
            
            $data['company_name'] = $company_name;
            $data['name'] = $name;
            $data['email'] = $email;
            $data['mobile'] = $mobile;
            $data['city'] = $city;
            $data['address'] = $address;
            $data['requirement'] = $requirement;
            $data['created_on'] = date('Y-m-d h:i:s');
            
            $this->user_advertisement_model->insert($data);
            
            $html = $this->load->view("mail/user_advertisement", '', true);

            $html = str_replace('%company_name%', $company_name, $html);
            $html = str_replace('%name%', $name, $html);
            $html = str_replace('%email%', $email, $html);
            $html = str_replace('%mobile%', $mobile, $html);
            $html = str_replace('%city%', $city, $html);
            $html = str_replace('%requirement%', $requirement, $html);
           
            $subject = "User Advertisement";
            $define_param['to_name'] = "Admin";
            $define_param['to_email'] = ADMIN_EMAIL;
            $send = $this->sendmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('msg', "Your advertisement request has been send successfully");
            $this->session->set_flashdata('msg_class', 'success');
            redirect('advertisement', 'redirect');
        }
    }

}

?>