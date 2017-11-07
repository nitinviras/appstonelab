<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_complete extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            return redirect('login', 'redirect');
        }
        $this->load->model('content_model');
        $this->load->model('user_details_model');
        $this->load->model('user_social_link_model');
    }

    public function account() {
        $id = $this->session->userdata('user_id');
        $row_search = array('user_id' => $id);
        $user_detail = $state_res = $city_res = array();
        if ($id > 0) {
            $user_detail = $this->user_details_model->select($id);
            $country_id = isset($user_detail->country) ? $user_detail->country : '';
            $state_id = isset($user_detail->state) ? $user_detail->state : '';
            $state_res = $this->content_model->state($country_id);
            $city_res = $this->content_model->city($state_id);
        }
        $data = array(
            'title' => 'Acoount setting',
            'country_res' => $this->content_model->country(),
            'user' => $this->content_model->get($id),
            'user1' => $user_detail,
            'user2' => $this->user_social_link_model->get(FALSE, $row_search, array()),
            'state_res' => $state_res,
            'city_res' => $city_res,
        );
        $this->template->load('dashboard_defaults', 'dashboard/account', $data);
    }

    public function save_profile() {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('profile', 'Profile image', 'callback_check_profile_image_size');
        $this->form_validation->set_rules('first_name1', 'First Name', 'required|max_length[50]');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('last_name1', 'Last Name', 'required|max_length[50]');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('date', 'Date of Birth', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required|numeric|min_length[10]|max_length[13]|is_unique[theme_user_details.mobile_no.ID.' . $id . ']');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('min_length', ' Please Enter Minimum 10 Characters');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 13 Characters');
        $this->form_validation->set_message('is_unique', 'The %s is already exists');
        $this->form_validation->set_rules('mobile_no2', 'New Mobile Number', 'numeric|min_length[10]|max_length[13]|is_unique[theme_user_details.alternate_mobile_no.ID.' . $id . ']');
        $this->form_validation->set_message('min_length', ' Please Enter Minimum 10 Characters');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 13 Characters');
        $this->form_validation->set_message('is_unique', 'The %s is already exists');
        $this->form_validation->set_rules('address1', 'Address1', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('country1', 'Country', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('state1', 'State', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('city1', 'City', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('zipcode1', 'Zip Code', 'required|numeric|min_length[6]');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('numeric', 'Please Enter Only Number');
        $this->form_validation->set_message('min_length', ' Please Enter 6 Digit Zip Code');
        $this->form_validation->set_rules('social_fb_link', 'Facebook URL', 'valid_url');
        $this->form_validation->set_message('valid_url', 'Please Enter Valid %s');
        $this->form_validation->set_rules('social_twt_link', 'Twiiter URL', 'valid_url');
        $this->form_validation->set_message('valid_url', 'Please Enter Valid %s');
        $this->form_validation->set_rules('social_gplus_link', 'Google Plus URL', 'valid_url');
        $this->form_validation->set_message('valid_url', 'Please Enter Valid %s');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->account();
        } else {

            $user_id = (int) $this->session->userdata('user_id');
            $date = $this->input->post('date');
            $username = $this->session->userdata('username');
            $foldername = sha1("profile_" . $user_id);
            if (!is_dir(uploads_path . '/profiles/' . $foldername)) {
                mkdir(uploads_path . '/profiles/' . $foldername);
                chmod(uploads_path . '/profiles/' . $foldername, 0777);
            }
            $config['upload_path'] = uploads_path . '/profiles/' . $foldername;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $temp = explode(".", $_FILES["profile"]['name']);
            $new_name = 'profile' . '.' . end($temp);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $data['upload_data'] = '';
            if (isset($_FILES['profile']) && $_FILES['profile'] != '') {
                $this->upload->do_upload('profile');
                $data['upload_data'] = $this->upload->data();
            }
            $file['upload_data'] = $this->upload->data('file_name');
            $file['upload_file_type'] = $this->upload->data('file_type');
            if ($file['upload_file_type'] && $file['upload_file_type'] != '') {
                $profile_photo = $file['upload_data'];
            } else {
                $profile_photo = $this->input->post('profile_image');
            }
            $user_details = array(
                'user_id' => $user_id,
                'profile_photo' => $profile_photo,
                'first_name' => $this->input->post('first_name1'),
                'last_name' => $this->input->post('last_name1'),
                'date_of_birth' => date("Y-m-d", strtotime($date)),
                'gender' => $this->input->post('gender'),
                'mobile_no' => $this->input->post('mobile_no'),
                'alternate_mobile_no' => $this->input->post('mobile_no2'),
                'personal_website' => $this->input->post('website_url'),
                'company_name' => $this->input->post('company_name1'),
                'company_no' => $this->input->post('company_no'),
                'address_one' => $this->input->post('address1'),
                'address_two' => $this->input->post('address3'),
                'zipcode' => $this->input->post('zipcode1'),
                'city' => $this->input->post('city1'),
                'state' => $this->input->post('state1'),
                'country' => $this->input->post('country1'),
                'created_date' => date("Y-m-d H:i:s")
            );
            $user_social = array(
                'user_id' => $user_id,
                'fb_link' => $this->input->post('social_fb_link'),
                'twt_link' => $this->input->post('social_twt_link'),
                'gplus_link' => $this->input->post('social_gplus_link'),
                'created_date' => date("Y-m-d H:i:s")
            );
            $data1 = array(
                'profile_completed' => '1'
            );
            $row_search = array('user_id' => $user_id);
            $result = $this->user_details_model->get(FALSE, $row_search, array());
            if (count($result) > 0 && !empty($result)) {
                $this->user_details_model->edit($user_id, $user_details);
                $this->user_social_link_model->edit($user_id, $user_social);
                $activity = 'User Account Setting Update';
                $location = $this->location->map();
                $this->logmaster->save_log($user_id, $activity, $location);
                $this->session->set_userdata('profile_image', $profile_photo);
                $this->session->set_flashdata('msg', "Your account setting updated successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('account', 'redirect');
            } else {
                $this->user_details_model->insert($user_details);
                $this->user_social_link_model->insert($user_social);
                $this->content_model->edit($user_id, $data1);
                $session = array(
                    'profile_completed' => 1,
                    'profile_image' => $profile_photo
                );
                $this->session->set_userdata($session);
                $activity = 'User Account Setting Complate';
                $location = $this->location->map();
                $this->logmaster->save_log($user_id, $activity, $location);
                $this->session->set_flashdata('msg', "Your account setting updated successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('account', 'redirect');
            }
        }
    }

    public function state() {
        $cid = $this->input->post('c_id');
        $html = "<option value = ''>Select State</option>";
        if ($cid != '') {
            $state_res = $this->content_model->state($cid);

            if (!empty($state_res)) {
                foreach ($state_res as $row) {
                    $html .= "<option value = '$row->id'>$row->name</option>";
                }
            }
        }
        echo $html;
    }

    public function city() {
        $sid = $this->input->post('s_id');
        $html = "<option value = ''>Select City</option>";
        if ($sid != '') {
            $city_res = $this->content_model->city($sid);
            if (!empty($city_res)) {
                foreach ($city_res as $row) {
                    $html .= "<option value = '$row->id'>$row->name</option>";
                }
            }
        }
        echo $html;
    }

    public
            function check_profile_image_size() {
        if (isset($_FILES['profile']['tmp_name'])) {
            $data = getimagesize($_FILES['profile']['tmp_name']);
            $width = isset($data[0]) ? (int) $data[0] : 0;
            $height = isset($data[1]) ? (int) $data[1] : 0;
            if ($width == PROFILE_WIDTH && $height == PROFILE_HEIGHT) {
                return TRUE;
            } else {
                $this->form_validation->set_message('check_profile_image_size', 'Please check your image. It must be in dimension of ' . PROFILE_WIDTH . '*' . PROFILE_HEIGHT);
                return FALSE;
            }
        }
    }

}

?>