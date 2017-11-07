<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_support');
        $this->load->model('setting_model');
        //$this->load->library('upload');
        //$this->load->library('my_form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index() {
        $this->authenticate->check();
        redirect('dashboard');
    }

    public function login() {
        if (!$this->session->userdata('ADMIN_ID')) {
            $this->load->view('login', $data);
        } else {
            redirect('dashboard');
        }
    }

    public function login_action() {
        $username = $this->input->post("username", TRUE);
        $password = $this->input->post("password", TRUE);

        $data['username'] = $username;
        $data['password'] = $password;

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $users = $this->model_support->authenticate($username, $password);
            
            //Check for login
            if ($users['errorCode'] == 0) {
                $this->session->set_flashdata('failure', $users['errorMessage']);
                redirect("login");
            } else {
                $this->session->set_flashdata('success', 'Welcome to ' . MY_SITE_NAME);
                redirect("dashboard");
            }
        }
    }

    // Forgot Password

    public function forgot_password() {
        $this->load->view('forgot_password');
    }

    public function forgotpassword_action() {
        $postvar = $this->input->post();
        $rply = $this->model_support->check_username($postvar['Email']);

        $this->load->helper('string');
        $password = random_string('alnum', 10);

        if ($rply['errorCode'] == 1) {

            $define_param['to_name'] = ucfirst($rply['Firstname']) . " " . ucfirst($rply['Lastname']);
            $define_param['to_email'] = $rply['Email'];

            $userid = $rply['ID'];
            $hidenuseremail = $rply['Email'];
            $hidenusername = ucfirst($rply['Firstname']) . " " . ucfirst($rply['Lastname']);

            //Encryprt data
            $encid = $this->general->encryptData($userid);
            $encemail = $this->general->encryptData($hidenuseremail);
            $url = $this->config->item("site_url") . "reset_password_admin/?uemail=" . $encemail . "&encid=" . $encid;

            $update['reset_password_check'] = 0;
            $update['reset_password_requested_on'] = date("Y-m-d H:i:S");
            $result = $this->model_support->update("theme_admin", $update, "ID='" . $userid . "'");

            $image_url = $this->config->item("images_url");
            $message = "Need to reset your password?";
            $content = "We have received a request to reset your password. You can <br> change your password by hitting the button below.";

            $html = '<tr>';
            $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $message . '</h3>';
            $html .= '</td>';
            $html .= '</tr>';

            //content
            $html .= '<tr>';
            $html .= '<td align="center"><p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: -0.13px;line-height: 30px;">' . $content . '<br><br>
            <a href="' . $url . '"><img src="' . $image_url . 'btn_reset_password.png"  height="40px"></a></p>';
            $html .= '</td>';
            $html .= '</tr>';

            $subject = "Reset Password";
            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;

            $send = $this->sendmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('success', 'Reset password link has been sent successfully.');


            redirect('login');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('forgot_password');
        }
    }

    //Logout
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'logout successfully');
        redirect('login');
    }

    public function reset_password_admin() {
        $id = $this->input->get('encid');
        $email_ency = $this->input->get('uemail');

        $ID = (int) $this->general->decryptData($id);
        $Email = $this->general->decryptData($email_ency);
        $result = $this->model_support->getData("theme_admin", "*", "", "ID='" . $ID . "' AND Email='" . $Email . "'");

        if (count($result) > 0) {
            $h_id = $result[0]['ID'];
            $add_min = date("Y-m-d H:i:s", strtotime($result[0]['reset_password_requested_on'] . "+1 hour"));
            if ($add_min > date("Y-m-d H:i:s")) {
                if ($result[0]['reset_password_check'] != 1) {
                    $content_data['ID'] = $ID;
                    $this->load->view('reset_password', $content_data);
                } else {
                    $this->session->set_flashdata('failure', "Reset password link has been expired. Please try again.");
                    redirect('forgot_password');
                }
            } else {
                $this->session->set_flashdata('failure', "Reset password link has been expired. Please try again.");
                redirect('forgot_password');
            }
        } else {
            $this->session->set_flashdata('failure', "Invalid request. Please try again.");
            redirect('forgot_password');
        }
    }

    public function change_password_action() {
        $Password = $this->input->post('password');
        $ID = $this->input->post('ID');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('pass', 'Confirm Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $content_data['ID'] = $ID;
            $this->load->view('reset_password', $content_data);
        } else {
            $update['reset_password_check'] = 1;
            $update['reset_password_requested_on'] = "0000-00-00 00:00:00";
            $update['Password'] = md5($Password);
            $result = $this->model_support->update("theme_admin", $update, "ID='" . $ID . "'");
            $this->session->set_flashdata('success', "Your password has been changed successfully.");
            redirect('login');
        }
    }

    public function profile() {
        $this->authenticate->check();
        $data['title'] = "Profile";
        $this->load->view('profile', $data);
    }

    public function profile_save() {
        
        $user_id = $this->input->post('id');
        $upload_path = $this->config->item('upload_url');
        $this->form_validation->set_rules('Email', 'Enter Email Address', 'required');
        // $this->form_validation->set_rules('Email', 'Email Name', 'required|is_unique[theme_setting.email.user_id.'.$user_id.']');
        $this->form_validation->set_rules('Phone', ' Enter Phone number', 'required');
        $this->form_validation->set_rules('Facebook', ' Enter Facebook  link', 'required');
        $this->form_validation->set_rules('LinkedIn', ' Enter Linkedin  link', 'required');
        $this->form_validation->set_rules('Google', ' Enter Google  link', 'required');
        $this->form_validation->set_rules('Instagram', 'Enter Instagram link', 'required');
        $this->form_validation->set_rules('Twitter', ' Enter Twitter link', 'required');
        $this->form_validation->set_rules('Firstname', 'Enter Firstname Name', 'required');
        $this->form_validation->set_rules('Address', ' Enter Address Detail', 'required');

        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_message('is_unique', 'The %s Already Exists');
        if ($this->form_validation->run() == FALSE) {
            $this->setting();
        } else {
            
            $data = $this->setting_model->get($user_id);
            $profile_img = $data->logo_image;
            $config['upload_path'] = 'assets/upload/profile_image';
            $config['max_size'] = 1024 * 10;
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('Logo_image')) {
                $upload_data = $this->upload->data();
                $profile_img = $upload_data['file_name'];
                
               }
             
            $filename = array("");
            if (!empty($_FILES["Login_image"]['name'])) {
                array_push($filename, "login_background.jpg");
            }
            if (!empty($_FILES["Forgot_image"]['name'])) {
                array_push($filename, "forgot_background.jpg");
            }
            if (!empty($_FILES["Register_image"]['name'])) {
                array_push($filename, "register_background.jpg");
            }
           
            $path = $this->config->item('img_root_dir');
            foreach ($filename as $value) {
                chmod($path . $value, 0777);
                if (file_exists($path.$value)) {
                    unlink($path.$value);
                }
            }
            if (!empty($_FILES["Login_image"]['name'])) {
                $temp = explode(".", $_FILES["Login_image"]['name']);
                $new_name = 'login_background' . '.' . end($temp);
                $config['file_name'] = $new_name;
                $config['upload_path'] = $this->config->item('img_root_dir');
                $config['allowed_types'] = 'jpg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Login_image')) {
                    $upload_data = $this->upload->data();
                   
                }
            }
///////////////////////////////////////////////////////////////    
            if (!empty($_FILES['Register_image']['name'])) {
                $temp = explode(".", $_FILES["Register_image"]['name']);
                $new_name = 'register_background' . '.' . end($temp);
                $config['file_name'] = $new_name;

                $config['upload_path'] = $this->config->item('img_root_dir');
                $config['allowed_types'] = 'jpg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('Register_image')) {
                    $upload_data = $this->upload->data();
                }
            }
///////////////////////////////////////////////////////////////////
            if (!empty($_FILES["Forgot_image"]['name'])) {
                $temp = explode(".", $_FILES["Forgot_image"]['name']);
                $new_name = 'forgot_background' . '.' . end($temp);
                $config['file_name'] = $new_name;
                $config['upload_path'] = $this->config->item('img_root_dir');
                $config['allowed_types'] = 'jpg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('Forgot_image')) {
                    $upload_data = $this->upload->data();
                }
            }
///////////////////////////////////////////////////////////////////////////////////////
            $data = array(
                'name' => $this->input->post('Firstname'),
                'email' => $this->input->post('Email'),
                'phone' => $this->input->post('Phone'),
                'address'=> $this->input->post('Address'),
                'facebook' => $this->input->post('Facebook'),
                'google' => $this->input->post('Google'),
                'twitter' => $this->input->post('Twitter'),
                'linkedin' => $this->input->post('LinkedIn'),
                'instagram' => $this->input->post('Instagram'),
                'logo_image'=> $profile_img,
            );
            if ($user_id > 0) {

                $this->setting_model->edit($user_id, $data);
                $this->session->set_flashdata('msg', "Setting SuccessFully updated!!.");
                $this->session->set_flashdata('msg_class', 'success');
            }
//             else {
//                
//                $this->setting_model->insert($data);
//                $this->session->set_flashdata('msg', "User Insert SuccessFully.");
//                $this->session->set_flashdata('msg_class', 'success');
//            }
            return redirect('setting', 'redirect');
        }
    }
    
    

    public function setting() {
        
        $this->authenticate->check();
        $user_id = $this->session->userdata('ADMIN_ID');
        
        $row_approve = array('user_id' => $user_id);
        $data['User'] = $this->setting_model->get($user_id);
        $data['title'] = "Setting Page";
        $filename= array("login_background.jpg","forgot_background.jpg","register_background.jpg");
        $data['image']=array('');
        $path = $this->config->item('img_root_dir');
        foreach ($filename as $value) {
                if (file_exists($path . $value)) {
                    array_push($data['image'],$value);
                }
              }
        $this->load->view('setting', $data);
    }

}
