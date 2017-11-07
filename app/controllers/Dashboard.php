<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            return redirect('login', 'redirect');
        } else if ($this->session->userdata('profile_completed') == 0) {
            $this->session->set_flashdata('msg', "Please Complete Your Profile.");
            $this->session->set_flashdata('msg_class', 'failure');
            return redirect('account', 'redirect');
        }
        $this->load->model('user_followers_model');
        $this->load->model('user_details_model');
        $this->load->model('content_model');
        $this->load->model('user_upload_item_model');
        $this->load->model('user_services_model');
        $this->load->model('user_biling_details_model');
        $this->load->model('user_shipping_details_model');
        $this->load->model('user_profile_model');
        $this->load->model('user_profile_model');
        $this->load->model('user_product_category_model');
        $this->load->model('oauth_clients_model');
    }

    public function biling_details() {
        $id = $this->session->userdata('user_id');
        $row_search = array('user_id' => $id);
        $data = array(
            'title' => 'Biling & Shipping Details',
            'country_res' => $this->content_model->country(),
            'user' => $this->content_model->get($id),
            'user3' => $this->user_biling_details_model->select($id),
            'user4' => $this->user_shipping_details_model->select($id)
        );
        $this->template->load('dashboard_defaults', 'dashboard/biling', $data);
    }

    public function save_biling_info() {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('first_name', 'First Name', 'max_length[50]');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('last_name', 'Last Name', 'max_length[50]');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('email_address2', 'Email Address', 'valid_email|max_length[50]');
        $this->form_validation->set_message('valid_email', ' Please Enter Valid Email');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'numeric|min_length[6]');
        $this->form_validation->set_message('numeric', 'Please Enter Only Number');
        $this->form_validation->set_message('min_length', ' Please Enter 6 Digit Zip Code');

        $this->form_validation->set_rules('first_name2', 'First Name', 'max_length[50]');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('last_name2', 'Last Name', 'max_length[50]');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('email_address3', 'Email Address', 'valid_email|max_length[50]');
        $this->form_validation->set_message('valid_email', ' Please Enter Valid Email');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('zipcode2', 'Zip Code', 'numeric|min_length[6]');
        $this->form_validation->set_message('numeric', 'Please Enter Only Number');
        $this->form_validation->set_message('min_length', ' Please Enter 6 Digit Zip Code');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->biling_details();
        } else {

            $user_id = $this->session->userdata('user_id');
            $date = $this->input->post('date');
            $username = $this->session->userdata('username');

            $user_biling = array(
                'user_id' => $user_id,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company_name' => $this->input->post('company_name'),
                'email' => $this->input->post('email_address2'),
                'zipcode' => $this->input->post('zipcode'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'address' => $this->input->post('address'),
                'note' => $this->input->post('notes'),
                'created_date' => date("Y-m-d H:i:s")
            );
            $user_shipping = array(
                'user_id' => $user_id,
                'first_name' => $this->input->post('first_name2'),
                'last_name' => $this->input->post('last_name2'),
                'company_name' => $this->input->post('company_name2'),
                'email' => $this->input->post('email_address3'),
                'zipcode' => $this->input->post('zipcode2'),
                'city' => $this->input->post('city2'),
                'state' => $this->input->post('state2'),
                'country' => $this->input->post('country2'),
                'address' => $this->input->post('address2'),
                'note' => $this->input->post('notes2'),
                'created_date' => date("Y-m-d H:i:s")
            );
            $row_search = array('user_id' => $user_id);
            $result = $this->user_biling_details_model->get(FALSE, $row_search, array());
            if (count($result) > 0 && !empty($result)) {
                $this->user_biling_details_model->edit($user_id, $user_biling);
                $this->user_shipping_details_model->edit($user_id, $user_shipping);
                $activity = 'User Biling & Shipping Details Update';
                $location = $this->location->map();
                $this->logmaster->save_log($user_id, $activity, $location);
                $this->session->set_flashdata('msg', "Your Biling & Shipping Details successfully Edited.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('biling_details', 'redirect');
            } else {
                $this->user_biling_details_model->insert($user_biling);
                $this->user_shipping_details_model->insert($user_shipping);
                $activity = 'User Biling & Shipping Details Complate';
                $location = $this->location->map();
                $this->logmaster->save_log($user_id, $activity, $location);
                $this->session->set_flashdata('msg', "Your Biling & Shipping Details successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('biling_details', 'redirect');
            }
        }
    }

    public function profile_setting() {
        $user_id = $this->session->userdata('user_id');
        $row_search = array('user_id' => $user_id);
        $result = $this->user_profile_model->get(FALSE, $row_search, array());
        $result_work = $this->user_details_model->get(FALSE, $row_search, array());
        $data['user_data'] = $result['last_row'];
        $data['work'] = $result_work;
        $data['title'] = 'Profile Setting';
        $this->template->load('dashboard_defaults', 'dashboard/profile_setting', $data);
    }

    public function save_profile_setting() {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('profile_banner', 'Profile Banner', 'callback_check_banner_image_size');
        $this->form_validation->set_rules('profile_heading', 'Profile Heading', 'required|max_length[50]');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('max_length', ' Please Enter Maximum 50 Characters');
        $this->form_validation->set_rules('profile_text', 'Profile Text', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        if (empty($_FILES['profile_banner']['name']) && empty($id)) {
            $this->form_validation->set_rules('profile_banner', 'Upload Homepage Image', 'required');
            $this->form_validation->set_message('required', 'Please %s');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->profile_setting();
        } else {
            $user_id = $this->session->userdata('user_id');
            $date = $this->input->post('date');
            $username = $this->session->userdata('username');
            $foldername = sha1("profile_" . $user_id);
            if (!is_dir(uploads_path . '/profiles/' . $foldername)) {
                mkdir(uploads_path . '/profiles/' . $foldername);
                chmod(uploads_path . '/profiles/' . $foldername, 0777);
            }
            $config['upload_path'] = uploads_path . '/profiles/' . $foldername;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $temp = explode(".", $_FILES["profile_banner"]['name']);
            $new_name = 'banner' . '.' . end($temp);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $data['upload_data'] = '';
            if (isset($_FILES['profile_banner']) && $_FILES['profile_banner'] != '') {
                $this->upload->do_upload('profile_banner');
                $data['upload_data'] = $this->upload->data();
                //resize image
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'] . '/' . $this->upload->data('file_name');
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 590;
                $config['height'] = 300;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
            $file['upload_data'] = $this->upload->data('file_name');
            $file['upload_file_type'] = $this->upload->data('file_type');
            if ($file['upload_file_type'] && $file['upload_file_type'] != '') {
                $profile_banner = $file['upload_data'];
            } else {
                $profile_banner = $this->input->post('banner_image');
            }
            $data = array(
                'user_id' => $user_id,
                'profile_banner' => $profile_banner,
                'profile_heading' => $this->input->post('profile_heading'),
                'profile_text' => $this->input->post('profile_text'),
            );
            if ($id > 0) {
                $data['updated_date'] = date("Y-m-d H:i:s");
                $this->user_profile_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Your Profile Information Save successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('author_profile', 'redirect');
            } else {
                $data['created_date'] = date("Y-m-d H:i:s");
                $this->user_profile_model->insert($data);
                $this->session->set_flashdata('msg', "Your Profile Information insert successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('author_profile', 'redirect');
            }
        }
    }

    public function message_details() {
        $user_id = (int) $this->session->userdata('user_id');
        $id = $this->input->get_post('token');

        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);

        if ($get_id > 0) {
            $query = "SELECT tm.*, t1.profile_photo, t1.first_name, t1.last_name,theme_users.user_login";
            $query .= " FROM theme_messages as tm ";
            $query .= " INNER JOIN theme_user_details as t1 ON t1.user_id =tm.msg_from_id ";
            $query .= " INNER JOIN theme_users on theme_users.ID=t1.user_id ";
            $query .= " WHERE (`msg_from_id` = " . $get_id . " OR msg_from_id=" . $user_id . ") AND (msg_to_id=" . $get_id . " OR msg_to_id=" . $user_id . ") ORDER BY created_on";
            $query_rws = $this->db->query($query);

            $message_data = $query_rws->result_array();
            $data['message_data'] = $message_data;
            $data['title'] = "Message Details";
            $data['other_id'] = $get_id;
            $this->template->load('dashboard_defaults', 'dashboard/message_details', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function web_upload_product($type = FALSE) {
        if ($type) {
            $category = $type;
        }
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);
        $result['allrecord'] = $item_data = array();
        if ($get_id > 0) {
            $item_data = $this->user_upload_item_model->get($get_id);
            $item_parent_cat = $item_data->item_parent_category;
            $cond = array('parent_category' => $item_parent_cat);
            $result = $this->user_product_category_model->get(FALSE, 'theme_user_product_category', $cond, array());
        }

        $data = array(
            'title' => 'Web Product Upload',
            'product_category' => $result['allrecord'],
            'compatible_browsers' => $this->content_model->compatible_browsers(),
            'themeforest_file' => $this->content_model->themeforest_file(),
            'product_tag' => $this->content_model->tag(),
            'id' => $id,
            'edit_item' => $item_data,
            'type' => isset($category) ? $category : ''
        );
        $this->template->load('dashboard_page', 'dashboard/web_upload_product', $data);
    }

    public function android_upload_product($type = FALSE) {
        if ($type) {
            $category = $type;
        }
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);
        $result['allrecord'] = $item_data = array();
        if ($get_id > 0) {
            $item_data = $this->user_upload_item_model->get($get_id);
            $item_parent_cat = $item_data->item_parent_category;
            $cond = array('parent_category' => $item_parent_cat);
            $result = $this->user_product_category_model->get(FALSE, 'theme_user_product_category', $cond, array());
        }

        $data = array(
            'title' => 'Android Product Upload',
            'product_category' => $result['allrecord'],
            'product_tag' => $this->content_model->tag(),
            'id' => $id,
            'edit_item' => $item_data,
            'type' => isset($category) ? $category : ''
        );
        $this->template->load('dashboard_page', 'dashboard/android_upload_product', $data);
    }

    public function ios_upload_product($type = FALSE) {
        if ($type) {
            $category = $type;
        }
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);
        $result['allrecord'] = $item_data = array();
        if ($get_id > 0) {
            $item_data = $this->user_upload_item_model->get($get_id);
            $item_parent_cat = $item_data->item_parent_category;
            $cond = array('parent_category' => $item_parent_cat);
            $result = $this->user_product_category_model->get(FALSE, 'theme_user_product_category', $cond, array());
        }

        $data = array(
            'title' => 'Ios Product Upload',
            'product_category' => $result['allrecord'],
            'compatible_browsers' => $this->content_model->compatible_browsers(),
            'themeforest_file' => $this->content_model->themeforest_file(),
            'product_tag' => $this->content_model->tag(),
            'id' => $id,
            'edit_item' => $item_data,
            'type' => isset($category) ? $category : ''
        );
        $this->template->load('dashboard_page', 'dashboard/ios_upload_product', $data);
    }

    public function uploadproduct_delete() {
        $get_id = $this->input->get('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = $this->encryption->decrypt($dec_username);
        $username = $this->session->userdata('username');
        $foldername = sha1("product_" . $id);
        $dirPath = uploads_path . '/products/' . $foldername;
        $this->user_upload_item_model->delete($id);
        if (is_dir($dirPath))
            $dir_handle = opendir($dirPath);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirPath . "/" . $file))
                    unlink($dirPath . "/" . $file);
                else
                    delete_directory($dirPath . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirPath);
        $this->session->set_flashdata('msg', "Delete Your Product.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('manage_products', 'redirect');
    }

    public function web_save_uploadproduct() {
        $get_id = $this->input->post("token");
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = $this->encryption->decrypt($dec_username);
        $this->form_validation->set_rules('main_image', 'Main image', 'callback_check_image_size');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('browser[]', 'Compatible Browsers', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('columns', 'Columns', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('fileincluded[]', 'Fileincluded', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('layout', 'Layout', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('demo_url', 'Demo URL', 'required|callback_urlcheck');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
        if ($this->input->post('item_type') == 'P') {
            $this->form_validation->set_rules('item_price', 'Item Price', 'required');
            $this->form_validation->set_message('required', 'Please Enter %s');
            $this->form_validation->set_rules('purchase_url', 'purchase URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        } else {
            $this->form_validation->set_rules('download_url', 'Download URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        }
        $this->form_validation->set_rules('item_tags[]', 'Item Tags', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        if (empty($_FILES['main_image']['name']) && empty($id)) {
            $this->form_validation->set_rules('main_image', 'Product Main Image', 'required');
            $this->form_validation->set_message('required', 'Please Select %s');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->web_upload_product("web");
        } else {
            $browser = $this->input->post('browser');
            $fileincluded = $this->input->post('fileincluded');
            $tags = $this->input->post('item_tags');
            $skill = $this->input->post('skill');
            $item_browser = implode(",", $browser);
            $item_file = implode(",", $fileincluded);
            $item_tag = implode(",", $tags);
            $item_skill = implode(",", $skill);
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'item_name' => $this->input->post('item_name'),
                'item_description' => $this->input->post('item_description'),
                'item_main_category' => 'web',
                'item_parent_category' => $this->input->post('parent_category'),
                'item_category' => $this->input->post('category'),
                'item_skill' => $item_skill,
                'item_browser' => $item_browser,
                'item_resolution' => $this->input->post('resolution'),
                'item_type' => $this->input->post('item_type'),
                'item_column' => $this->input->post('columns'),
                'item_file' => $item_file,
                'item_layout' => $this->input->post('layout'),
                'demo_url' => $this->input->post('demo_url'),
                'download_url' => $this->input->post('download_url'),
                'purchase_url' => $this->input->post('purchase_url'),
                'item_tag' => $item_tag,
                'item_price' => $this->input->post('item_price'),
                'created_by' => $this->session->userdata('username'),
                'created_date' => date("Y-m-d H:i:s")
            );
            if ($id > 0) {
                $image_id = $id;
                $this->user_upload_item_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Your product has been updated.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $this->session->set_flashdata('msg', "Your product has been uploaded successfully and waiting for approval.");
                $this->session->set_flashdata('msg_class', 'success');
                $image_id = $this->user_upload_item_model->insert($data);
                if ($image_id) {
                    $count_record = array('ID' => $this->session->userdata('user_id'));
                    $user_record = $this->content_model->get(FALSE, $count_record, array());
                    $details_record = array('user_id' => $this->session->userdata('user_id'));
                    $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
                    $hidenusername = $user_record->user_login;
                    $hidenuseremail = $user_record->user_email;
                    $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
                    $html = $this->load->view("mail/new_product", '', true);
                    $html = str_replace('%name%', $name, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = $hidenusername;
                    $define_param['to_email'] = $hidenuseremail;
                    $send = $this->sendmail->send($define_param, $subject, $html);
//            admin inquiry mail
                    $message = "New product upload.";
                    $html = $this->load->view("mail/admin_new_product", '', true);
                    $html = str_replace('%message%', $message, $html);
                    $html = str_replace('%title%', $this->input->post('item_name'), $html);
                    $html = str_replace('%name%', $hidenusername, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = MY_SITE_NAME;
                    $define_param['to_email'] = ADMIN_EMAIL;
                    $send = $this->sendmail->send($define_param, $subject, $html);
                }
            }
            $row_search = array('ID' => $image_id);
            $result = $this->user_upload_item_model->get(FALSE, $row_search, array());
            if ($result > 0 && !empty($result)) {
                $product_id = $image_id;
                $username = $this->session->userdata('username');
                $foldername = sha1("product_" . $product_id);
                if (!is_dir(uploads_path . '/products/' . $foldername)) {
                    mkdir(uploads_path . '/products/' . $foldername);
                    chmod(uploads_path . '/products/' . $foldername, 0777);
                }
                $config['upload_path'] = uploads_path . '/products/' . $foldername;
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

                    //resize image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $config['upload_path'] . '/' . $this->upload->data('file_name');
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 590;
                    $config['height'] = 300;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                $file['upload'] = $this->upload->data('file_type');
                $file['upload_data'] = $this->upload->data('file_name');
                if ($file['upload'] && $file['upload'] != '') {
                    $main_image['main_image'] = $file['upload_data'];
                    $this->user_upload_item_model->edit($product_id, $main_image);
                } else {
                    $main_image['main_image'] = $this->input->post('product_image');
                    $this->user_upload_item_model->edit($product_id, $main_image);
                }
            }
            redirect('manage_products', 'redirect');
        }
    }

    public function android_save_uploadproduct() {
        $get_id = $this->input->post("token");
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = $this->encryption->decrypt($dec_username);
        $this->form_validation->set_rules('main_image', 'Main image', 'callback_check_image_size');
        $this->form_validation->set_rules('parent_category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('skill[]', 'Skill', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('browser[]', 'Compatible Browsers', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('fileincluded[]', 'Fileincluded', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('demo_url', 'Demo URL', 'required|callback_urlcheck');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
        if ($this->input->post('item_type') == 'P') {
            $this->form_validation->set_rules('item_price', 'Item Price', 'required');
            $this->form_validation->set_message('required', 'Please Enter %s');
            $this->form_validation->set_rules('purchase_url', 'purchase URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        } else {
            $this->form_validation->set_rules('download_url', 'Download URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        }
        $this->form_validation->set_rules('item_tags[]', 'Item Tags', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        if (empty($_FILES['main_image']['name']) && empty($id)) {
            $this->form_validation->set_rules('main_image', 'Product Main Image', 'required');
            $this->form_validation->set_message('required', 'Please Select %s');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->android_upload_product("android");
        } else {
            $browser = $this->input->post('browser');
            $fileincluded = $this->input->post('fileincluded');
            $tags = $this->input->post('item_tags');
            $skill = $this->input->post('skill');
            $item_browser = implode(",", $browser);
            $item_file = implode(",", $fileincluded);
            $item_tag = implode(",", $tags);
            $item_skill = implode(",", $skill);

            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'item_name' => $this->input->post('item_name'),
                'item_description' => $this->input->post('item_description'),
                'item_main_category' => 'android',
                'item_parent_category' => $this->input->post('parent_category'),
                'item_skill' => $item_skill,
                'item_browser' => $item_browser,
                'item_file' => $item_file,
                'item_type' => $this->input->post('item_type'),
                'demo_url' => $this->input->post('demo_url'),
                'download_url' => $this->input->post('download_url'),
                'purchase_url' => $this->input->post('purchase_url'),
                'item_tag' => $item_tag,
                'item_price' => $this->input->post('item_price'),
                'created_by' => $this->session->userdata('username'),
                'created_date' => date("Y-m-d H:i:s")
            );
            if ($id > 0) {
                $image_id = $id;
                $this->user_upload_item_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Your product has been updated successfully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $image_id = $this->user_upload_item_model->insert($data);
                $this->session->set_flashdata('msg', "Your product has been uploaded successfully and waiting for approval.");
                $this->session->set_flashdata('msg_class', 'success');
                if ($image_id) {
                    $count_record = array('ID' => $this->session->userdata('user_id'));
                    $user_record = $this->content_model->get(FALSE, $count_record, array());
                    $details_record = array('user_id' => $this->session->userdata('user_id'));
                    $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
                    $hidenusername = $user_record->user_login;
                    $hidenuseremail = $user_record->user_email;
                    $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
                    $html = $this->load->view("mail/new_product", '', true);
                    $html = str_replace('%name%', $name, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = $hidenusername;
                    $define_param['to_email'] = $hidenuseremail;
                    $send = $this->sendmail->send($define_param, $subject, $html);
//            admin inquiry mail
                    $message = "New product upload.";
                    $html = $this->load->view("mail/admin_new_product", '', true);
                    $html = str_replace('%message%', $message, $html);
                    $html = str_replace('%title%', $this->input->post('item_name'), $html);
                    $html = str_replace('%name%', $hidenusername, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = MY_SITE_NAME;
                    $define_param['to_email'] = ADMIN_EMAIL;
                    $send = $this->sendmail->send($define_param, $subject, $html);
                }
            }
            $row_search = array('ID' => $image_id);
            $result = $this->user_upload_item_model->get(FALSE, $row_search, array());
            if ($result > 0 && !empty($result)) {
                $product_id = $image_id;
                $username = $this->session->userdata('username');
                $foldername = sha1("product_" . $product_id);
                if (!is_dir(uploads_path . '/products/' . $foldername)) {
                    mkdir(uploads_path . '/products/' . $foldername);
                    chmod(uploads_path . '/products/' . $foldername, 0777);
                }
                $config['upload_path'] = uploads_path . '/products/' . $foldername;
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


                    //resize image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $config['upload_path'] . '/' . $this->upload->data('file_name');
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 590;
                    $config['height'] = 300;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                $file['upload'] = $this->upload->data('file_type');
                $file['upload_data'] = $this->upload->data('file_name');
                if ($file['upload'] && $file['upload'] != '') {
                    $main_image['main_image'] = $file['upload_data'];
                    $this->user_upload_item_model->edit($product_id, $main_image);
                } else {
                    $main_image['main_image'] = $this->input->post('product_image');
                    $this->user_upload_item_model->edit($product_id, $main_image);
                }
            }
            redirect('manage_products', 'redirect');
        }
    }

    public function ios_save_uploadproduct() {
        $get_id = $this->input->post("token");
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = $this->encryption->decrypt($dec_username);
        $this->form_validation->set_rules('main_image', 'Main image', 'callback_check_image_size');
        $this->form_validation->set_rules('parent_category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('skill[]', 'Skill', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('browser[]', 'Compatible Browsers', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('fileincluded[]', 'Fileincluded', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        if ($this->input->post('item_type') == 'P') {
            $this->form_validation->set_rules('item_price', 'Item Price', 'required');
            $this->form_validation->set_message('required', 'Please Enter %s');
            $this->form_validation->set_rules('purchase_url', 'purchase URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        } else {
            $this->form_validation->set_rules('download_url', 'Download URL', 'required|callback_urlcheck');
            $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
            $this->form_validation->set_message('required', 'Please Enter %s');
        }
        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('demo_url', 'Demo URL', 'required|callback_urlcheck');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_message('urlcheck', 'Please enter valid %s');
        $this->form_validation->set_rules('item_tags[]', 'Item Tags', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        if (empty($_FILES['main_image']['name']) && empty($id)) {
            $this->form_validation->set_rules('main_image', 'Product Main Image', 'required');
            $this->form_validation->set_message('required', 'Please Select %s');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->ios_upload_product("ios");
        } else {
            $browser = $this->input->post('browser');
            $fileincluded = $this->input->post('fileincluded');
            $tags = $this->input->post('item_tags');
            $skill = $this->input->post('skill');
            $item_browser = implode(",", $browser);
            $item_file = implode(",", $fileincluded);
            $item_tag = implode(",", $tags);
            $item_skill = implode(",", $skill);
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'item_name' => $this->input->post('item_name'),
                'item_description' => $this->input->post('item_description'),
                'item_main_category' => 'ios',
                'item_parent_category' => $this->input->post('parent_category'),
                'item_skill' => $item_skill,
                'item_browser' => $item_browser,
                'item_file' => $item_file,
                'item_type' => $this->input->post('item_type'),
                'demo_url' => $this->input->post('demo_url'),
                'download_url' => $this->input->post('download_url'),
                'purchase_url' => $this->input->post('purchase_url'),
                'item_tag' => $item_tag,
                'item_price' => $this->input->post('item_price'),
                'created_by' => $this->session->userdata('username'),
                'created_date' => date("Y-m-d H:i:s")
            );
            if ($id > 0) {
                $image_id = $id;
                $this->user_upload_item_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Your product has been updated successfully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $image_id = $this->user_upload_item_model->insert($data);
                $this->session->set_flashdata('msg', "Your product has been uploaded successfully and waiting for approval.");
                $this->session->set_flashdata('msg_class', 'success');
                if ($image_id) {
                    $count_record = array('ID' => $this->session->userdata('user_id'));
                    $user_record = $this->content_model->get(FALSE, $count_record, array());
                    $details_record = array('user_id' => $this->session->userdata('user_id'));
                    $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
                    $hidenusername = $user_record->user_login;
                    $hidenuseremail = $user_record->user_email;
                    $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
                    $html = $this->load->view("mail/new_product", '', true);
                    $html = str_replace('%name%', $name, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = $hidenusername;
                    $define_param['to_email'] = $hidenuseremail;
                    $send = $this->sendmail->send($define_param, $subject, $html);
//            admin inquiry mail
                    $message = "New product upload.";
                    $html = $this->load->view("mail/admin_new_product", '', true);
                    $html = str_replace('%message%', $message, $html);
                    $html = str_replace('%title%', $this->input->post('item_name'), $html);
                    $html = str_replace('%name%', $hidenusername, $html);
                    $subject = "New Product Upload";
                    $define_param['to_name'] = MY_SITE_NAME;
                    $define_param['to_email'] = ADMIN_EMAIL;
                    $send = $this->sendmail->send($define_param, $subject, $html);
                }
            }
            $row_search = array('ID' => $image_id);
            $result = $this->user_upload_item_model->get(FALSE, $row_search, array());
            if ($result > 0 && !empty($result)) {
                $product_id = $image_id;
                $username = $this->session->userdata('username');
                $foldername = sha1("product_" . $product_id);
                if (!is_dir(uploads_path . '/products/' . $foldername)) {
                    mkdir(uploads_path . '/products/' . $foldername);
                    chmod(uploads_path . '/products/' . $foldername, 0777);
                }
                $config['upload_path'] = uploads_path . '/products/' . $foldername;
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
                    //resize image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $config['upload_path'] . '/' . $this->upload->data('file_name');
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 590;
                    $config['height'] = 300;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                $file['upload'] = $this->upload->data('file_type');
                $file['upload_data'] = $this->upload->data('file_name');
                if ($file['upload'] && $file['upload'] != '') {
                    $main_image['main_image'] = $file['upload_data'];
                    $this->user_upload_item_model->edit($product_id, $main_image);
                } else {
                    $main_image['main_image'] = $this->input->post('product_image');
                    $this->user_upload_item_model->edit($product_id, $main_image);
                }
            }
            redirect('manage_products', 'redirect');
        }
    }

    public function product_inquiry() {
        $user_id = (int) $this->session->userdata('user_id');
        if ($user_id) {
            $query = "SELECT t1.*,t2.user_id as from_user_id,t2.first_name as from_first_name,t2.last_name as from_last_name,t2.profile_photo as from_profile_photo";
            $query .= " FROM theme_user_product_inquiry as t1 ";
            $query .= " INNER JOIN theme_user_details as t2 ON t1.inquiry_from_id=t2.user_id";
            $query .= " WHERE t1.inquiry_to_id=" . $user_id . " ORDER BY t1.created_on desc";
            $query_rws = $this->db->query($query);
            $product_inquiry = $query_rws->result_array();
            $data['product_inquiry'] = $product_inquiry;
//            $send_query = "SELECT t1.*,t2.user_id as from_user_id,t2.first_name as from_first_name,t2.last_name as from_last_name,t2.profile_photo as from_profile_photo, pr.user_id as uid, pr.product_id as pid, pr.rating";
//            $send_query .= " FROM theme_user_product_inquiry as t1 ";
//            $send_query .= " INNER JOIN theme_user_details as t2 ON t1.inquiry_from_id=t2.user_id";
//            $send_query .= " LEFT JOIN theme_product_rating as pr ON pr.user_id=t2.user_id AND pr.product_id=t1.product_id";
//            $send_query .= " WHERE t1.inquiry_from_id=" . $user_id . " ORDER BY t1.created_on desc";
            
            $send_query = "SELECT t1.*,t2.user_id as from_user_id,t2.first_name as from_first_name,t2.last_name as from_last_name,t2.profile_photo as from_profile_photo, pr.user_id as uid, pr.product_id as pid, pr.rating";
            $send_query .= " FROM theme_user_product_inquiry as t1 ";
            $send_query .= " INNER JOIN theme_user_details as t2 ON t1.inquiry_to_id=t2.user_id";
            $send_query .= " LEFT JOIN theme_product_rating as pr ON pr.user_id=t2.user_id AND pr.product_id=t1.product_id";
            $send_query .= " WHERE t1.inquiry_from_id=" . $user_id . " ORDER BY t1.created_on desc";
            $send_query_rws = $this->db->query($send_query);
            $send_product_inquiry = $send_query_rws->result_array();
            $data['send_product_inquiry'] = $send_product_inquiry;
            $data['title'] = 'Product Inquiry';
            $this->template->load('dashboard_page', 'dashboard/product_inquiry', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function product_inquiry_details() {
        $user_id = (int) $this->session->userdata('user_id');
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);
        if ($get_id > 0) {
            $value['status'] = 'R';
            $this->db->where('ID', $get_id);
            $this->db->update('theme_user_product_inquiry', $value);
            $query = "SELECT t1.*, t2.profile_photo, t2.first_name, t2.last_name, t2.company_name, t3.main_image, t3.item_name, t3.item_description";
            $query .= " FROM theme_user_product_inquiry as t1 ";
            $query .= " LEFT JOIN theme_user_details as t2 ON t1.inquiry_from_id =t2.user_id";
            $query .= " LEFT JOIN theme_user_upload_item as t3 ON t1.product_id =t3.ID";
            $query .= " WHERE t1.ID = $get_id";
            $query_rws = $this->db->query($query);
            $product_inquiry = $query_rws->row();
            $data['product_inquiry'] = $product_inquiry;
            $data['title'] = 'Products Inquiry Details';
            $this->template->load('dashboard_defaults', 'dashboard/product_inquiry_details', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function product_inquiry_save() {
        $token_from_dec = $this->input->post('token_from');
        $get_product_id = $this->input->post('product_id');
        $inq_subject = $this->input->post('inq_subject');
        $inq_text = $this->input->post('inq_text');
        $token_to_dec = $this->input->post('token_to');
        //get product id 
        $dec_get_product_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_product_id);
        $product_id = (int) $this->encryption->decrypt($dec_get_product_id);

        //get inquiry from id 
        $dec_token_from = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_from_dec);
        $inq_from_id = (int) $this->encryption->decrypt($dec_token_from);

        //get inquiry to  id
        $dec_token_to = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_to_dec);
        $inq_to_id = (int) $this->encryption->decrypt($dec_token_to);


        $data['inquiry_from_id'] = $inq_from_id;
        $data['inquiry_to_id'] = $inq_to_id;
        $data['product_id'] = $product_id;
        $data['inquiry_subject'] = $inq_subject;
        $data['inquiry_description'] = $inq_text;
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->db->insert('theme_user_product_inquiry', $data);
        $id = $this->db->insert_ID();
        if ($id) {
            $count_record = array('ID' => $inq_to_id);
            $user_record = $this->content_model->get(FALSE, $count_record, array());
            $details_record = array('user_id' => $inq_to_id);
            $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
            $hidenusername = $user_record->user_login;
            $hidenuseremail = $user_record->user_email;
            $sender = $this->session->userdata("username");
            $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
            $message = "New product inquiry in your account";
            $html = $this->load->view("mail/user_inquiry", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $html = str_replace('%sender%', $sender, $html);
            $subject = "New Product Inquiry";
            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;
            $send = $this->sendmail->send($define_param, $subject, $html);
//            admin inquiry mail
            $message = "new product inquiry notification";
            $html = $this->load->view("mail/admin_inquiry", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%reciver%', $hidenusername, $html);
            $html = str_replace('%sender%', $sender, $html);
            $subject = "New Product Inquiry";
            $define_param['to_name'] = MY_SITE_NAME;
            $define_param['to_email'] = ADMIN_EMAIL;
            $send = $this->sendmail->send($define_param, $subject, $html);
            echo true;
            exit(0);
        } else {
            echo FALSE;
            exit(0);
        }
    }

    public function service_inquiry_save() {
        $token_from_dec = $this->input->post('token_from');
        $get_service_id = $this->input->post('service_id');
        $inq_subject = $this->input->post('inq_subject');
        $inq_text = $this->input->post('inq_text');
        $token_to_dec = $this->input->post('token_to');
        //get product id 
        $dec_get_product_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_service_id);
        $service_id = (int) $this->encryption->decrypt($dec_get_product_id);

        //get inquiry from id 
        $dec_token_from = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_from_dec);
        $inq_from_id = (int) $this->encryption->decrypt($dec_token_from);

        //get inquiry to  id
        $dec_token_to = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_to_dec);
        $inq_to_id = (int) $this->encryption->decrypt($dec_token_to);


        $data['inquiry_from_id'] = $inq_from_id;
        $data['inquiry_to_id'] = $inq_to_id;
        $data['service_id'] = $service_id;
        $data['inquiry_subject'] = $inq_subject;
        $data['inquiry_description'] = $inq_text;
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->db->insert('theme_user_service_inquiry', $data);
        $id = $this->db->insert_ID();
        if ($id) {
            $count_record = array('ID' => $inq_to_id);
            $user_record = $this->content_model->get(FALSE, $count_record, array());
            $details_record = array('user_id' => $inq_to_id);
            $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
            $hidenusername = $user_record->user_login;
            $hidenuseremail = $user_record->user_email;
            $sender = $this->session->userdata("username");
            $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
            $message = "New sewrvice inquiry in your account";
            $html = $this->load->view("mail/user_inquiry", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $html = str_replace('%sender%', $sender, $html);
            $subject = "New Service Inquiry";
            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;
            $send = $this->sendmail->send($define_param, $subject, $html);
            //            admin inquiry mail
            $message = "new service inquiry notification";
            $html = $this->load->view("mail/admin_inquiry", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%reciver%', $hidenusername, $html);
            $html = str_replace('%sender%', $sender, $html);
            $subject = "New Service Inquiry";
            $define_param['to_name'] = MY_SITE_NAME;
            $define_param['to_email'] = ADMIN_EMAIL;
            $send = $this->sendmail->send($define_param, $subject, $html);
            echo true;
            exit(0);
        } else {
            echo FALSE;
            exit(0);
        }
    }

    public function service_inquiry() {
        $user_id = (int) $this->session->userdata('user_id');
        if ($user_id) {
            $query = "SELECT t1.*,t2.user_id as from_user_id,t2.first_name as from_first_name,t2.last_name as from_last_name,t2.profile_photo as from_profile_photo";
            $query .= " FROM theme_user_service_inquiry as t1 ";
            $query .= " INNER JOIN theme_user_details as t2 ON t1.inquiry_from_id=t2.user_id";
            $query .= " WHERE t1.inquiry_to_id=" . $user_id . " ORDER BY t1.created_on desc";
            $query_rws = $this->db->query($query);
            $service_inquiry = $query_rws->result_array();
            $data['service_inquiry'] = $service_inquiry;
            $send_query = "SELECT t1.*,t2.user_id as from_user_id,t2.first_name as from_first_name,t2.last_name as from_last_name,t2.profile_photo as from_profile_photo,  sr.user_id as uid, sr.service_id as sid, sr.rating";
            $send_query .= " FROM theme_user_service_inquiry as t1 ";
            $send_query .= " INNER JOIN theme_user_details as t2 ON t1.inquiry_to_id=t2.user_id";
            $send_query .= " LEFT JOIN theme_service_rating as sr ON sr.user_id=t2.user_id AND sr.service_id=t1.service_id";
            $send_query .= " WHERE t1.inquiry_from_id=" . $user_id . " ORDER BY t1.created_on desc";
            $send_query_rws = $this->db->query($send_query);
            $send_service_inquiry = $send_query_rws->result_array();
            $data['send_service_inquiry'] = $send_service_inquiry;
            $data['title'] = 'Services Inquiry';
            $this->template->load('dashboard_page', 'dashboard/service_inquiry', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function service_inquiry_details() {
        $user_id = (int) $this->session->userdata('user_id');
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = (int) $this->encryption->decrypt($dec_username);
        if ($get_id > 0) {
            $value['status'] = 'R';
            $this->db->where('ID', $get_id);
            $this->db->update('theme_user_service_inquiry', $value);
            $query = "SELECT t1.*, t2.profile_photo, t2.first_name, t2.last_name, t2.company_name, t3.main_image, t3.service_name, t3.service_description";
            $query .= " FROM theme_user_service_inquiry as t1 ";
            $query .= " LEFT JOIN theme_user_details as t2 ON t1.inquiry_from_id =t2.user_id";
            $query .= " LEFT JOIN theme_user_services as t3 ON t1.service_id =t3.ID";
            $query .= " WHERE t1.ID = $get_id";
            $query_rws = $this->db->query($query);
            $service_inquiry = $query_rws->row();
            $data['service_inquiry'] = $service_inquiry;
            $data['title'] = 'Products Inquiry Details';
            $this->template->load('dashboard_defaults', 'dashboard/product_inquiry_details', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function manage_products() {
        $user_id = $this->session->userdata('user_id');
        $row_search = array('user_id' => $user_id);
        $result = $this->user_upload_item_model->get(FALSE, $row_search, array());
        $data = array(
            'title' => 'Manage Items',
            'products' => $result['count'],
            'allrecord' => $result['allrecord']
        );
        $this->template->load('dashboard_defaults', 'dashboard/manage_items', $data);
    }

    public function corporate_web() {
        $user_id = (int) $this->session->userdata('user_id');
        $row_search = array('user_id' => $user_id);
        $result = $this->user_details_model->get(FALSE, $row_search, array());
        if (empty($result->corporate_web)) {
            $data = array(
                'title' => 'Corporate Web',
            );
            $this->template->load('dashboard_defaults', 'dashboard/corporate_web', $data);
        } else {
            $data = array(
                'title' => 'Manage Themes',
                'activation' => $result
            );
            $this->template->load('dashboard_defaults', 'dashboard/manage_theme', $data);
        }
    }

    public function save_corporate_web() {
        $this->form_validation->set_rules('corporate_web', 'corporate web', 'required|callback_alpha_dash|is_unique[theme_user_details.corporate_web]');
        $this->form_validation->set_message('required', 'Please enter %s');
        $this->form_validation->set_message('alpha_dash', 'Please enter only  alpha-numeric characters and underscores');
        $this->form_validation->set_message('is_unique', 'This corporate web domain already exist.Please enter another domain');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->corporate_web();
        } else {
            $user_id = (int) $this->session->userdata('user_id');
            $data['corporate_web'] = $this->input->post('corporate_web');
            $this->user_details_model->edit($user_id, $data);
            $this->session->set_flashdata('msg', "Your data successfully edited");
            $this->session->set_flashdata('msg_class', 'success');
            redirect(base_url("corporate_web"));
        }
    }

    public function alpha_dash($str) {
        return (!preg_match("/^([-a-z0-9_])+$/i", $str)) ? FALSE : TRUE;
    }

    public function theme_name() {
        $user_id = (int) $this->input->get('user_id');
        $data['theme_name'] = $this->input->get('theme');
        $result = $this->user_details_model->edit($user_id, $data);
    }

    public function add_service() {
        $id = $this->input->get_post('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
        $get_id = $this->encryption->decrypt($dec_username);
        $result = $service_data = array();
        if ($get_id > 0) {
            $service_data = $this->user_services_model->get($get_id);
            $service_parent_cat = $service_data->services_sub_category;
            $cond = array('ID' => $service_parent_cat);
            $result = $this->user_services_model->getSingleRow('theme_service_sub_category', $cond);
        }
        $data = array(
            'title' => 'Add Services',
            's_category' => $result,
            'id' => $id,
            'edit_item' => $this->user_services_model->get($get_id),
            'service_tag' => $this->content_model->tag(),
            'service_category' => $this->user_services_model->get_category()
        );
        $this->template->load('dashboard_defaults', 'dashboard/add_service', $data);
    }

    public function save_uploadservice() {
        $get_id = $this->input->post('token');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('sub_category', 'Sub Category', 'required');
        $this->form_validation->set_message('required', 'Please Select %s');
        $this->form_validation->set_rules('service_price', 'Service Price', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('service_name', 'Service Name', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('service_description', 'Service Description', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('response_time', 'Response Time', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_rules('service_tags[]', 'Service Tags', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        if (empty($_FILES['main_image']['name']) && empty($get_id)) {
            $this->form_validation->set_rules('main_image', 'Product Main Image', 'required');
            $this->form_validation->set_message('required', 'Please Select %s');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->add_service();
        } else {
            $tags = $this->input->post('service_tags');
            $service_tags = implode(",", $tags);
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'service_name' => $this->input->post('service_name'),
                'service_description' => $this->input->post('service_description'),
                'service_price' => $this->input->post('service_price'),
                'service_category' => $this->input->post('category'),
                'services_sub_category' => $this->input->post('sub_category'),
                'user_response_time' => $this->input->post('response_time'),
                'services_tag' => $service_tags,
                'created_by' => $this->session->userdata('username'),
                'created_date' => date("Y-m-d H:i:s")
            );
            $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
            $id = $this->encryption->decrypt($dec_username);
            if ($id > 0) {
                $image_id = $id;
                $this->user_services_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Your service has been updated successfully.");
                $this->session->set_flashdata('msg_class', 'success');
            } else {
                $image_id = $this->user_services_model->insert($data);
                $this->session->set_flashdata('msg', "Your service has been uploaded successfully and waiting for approval.");
                $this->session->set_flashdata('msg_class', 'success');
                if ($image_id) {
                    $count_record = array('ID' => $this->session->userdata('user_id'));
                    $user_record = $this->content_model->get(FALSE, $count_record, array());
                    $details_record = array('user_id' => $this->session->userdata('user_id'));
                    $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
                    $hidenusername = $user_record->user_login;
                    $hidenuseremail = $user_record->user_email;
                    $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
                    $html = $this->load->view("mail/new_product", '', true);
                    $html = str_replace('%name%', $name, $html);
                    $subject = "New Service Upload";
                    $define_param['to_name'] = $hidenusername;
                    $define_param['to_email'] = $hidenuseremail;
                    $send = $this->sendmail->send($define_param, $subject, $html);
//            admin inquiry mail
                    $message = "New service upload.";
                    $html = $this->load->view("mail/admin_new_product", '', true);
                    $html = str_replace('%message%', $message, $html);
                    $html = str_replace('%title%', $this->input->post('service_name'), $html);
                    $html = str_replace('%name%', $hidenusername, $html);
                    $subject = "New Service Upload";
                    $define_param['to_name'] = MY_SITE_NAME;
                    $define_param['to_email'] = ADMIN_EMAIL;
                    $send = $this->sendmail->send($define_param, $subject, $html);
                }
            }
            $row_search = array('ID' => $image_id);
            $result = $this->user_services_model->get(FALSE, $row_search, array());
            if ($result > 0 && !empty($result)) {
                $service_id = $image_id;
                $username = $this->session->userdata('username');
                $foldername = sha1("service_" . $service_id);
                if (!is_dir(uploads_path . '/services/' . $foldername)) {
                    mkdir(uploads_path . '/services/' . $foldername);
                    chmod(uploads_path . '/services/' . $foldername, 0777);
                }
                $config['upload_path'] = uploads_path . '/services/' . $foldername;
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
                    //resize image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $config['upload_path'] . '/' . $this->upload->data('file_name');
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 590;
                    $config['height'] = 300;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                $file['upload'] = $this->upload->data('file_type');
                $file['upload_data'] = $this->upload->data('file_name');
                if ($file['upload'] && $file['upload'] != '') {
                    $main_image['main_image'] = $file['upload_data'];
                    $this->user_services_model->edit($service_id, $main_image);
                } else {
                    $main_image['main_image'] = $this->input->post('product_image');
                    $this->user_services_model->edit($service_id, $main_image);
                }
                redirect('manage_services', 'redirect');
            }
        }
    }

    public function manage_services() {
        $user_id = $this->session->userdata('user_id');
        $row_search = array('user_id' => $user_id);
        $result = $this->user_services_model->get(FALSE, $row_search, array());
        $data = array(
            'title' => 'Manage Services',
            'services' => $result['count'],
            'allrecord' => $result['allrecord']
        );
        $this->template->load('dashboard_defaults', 'dashboard/manage_services', $data);
    }

    public function service_delete() {
        $get_id = $this->input->get('token');
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = $this->encryption->decrypt($dec_username);
        $username = $this->session->userdata('username');
        $foldername = sha1("service_" . $id);
        $dirPath = (uploads_path . '/services/' . $foldername);
        $this->user_services_model->delete($id);
        if (is_dir($dirPath))
            $dir_handle = opendir($dirPath);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirPath . "/" . $file))
                    unlink($dirPath . "/" . $file);
                else
                    delete_directory($dirPath . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirPath);
        $this->session->set_flashdata('msg', "Delete Your Services.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('manage_services', 'redirect');
    }

    public function author_profile() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            $count_follower = array('follow_id' => $follow_id);
            $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
            $data['follower_record'] = $follower_record['count'];
            $profile_home = array('user_id' => $follow_id);
            $profile_record = $this->user_profile_model->get(FALSE, $profile_home, array());
            $data['user_data'] = $profile_record['last_row'];
            $data['user_record'] = $user_record;
            $data['title'] = 'Author Profile Details';
            $this->template->load('defaults', 'author_profile', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details Are Not Available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function author_profile_items() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if ($this->input->is_ajax_request()) {
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
            $data = $this->input->post();
            $data['start'] = ($page - 1) * Profile_perpage_record;
            $data['created_by'] = $get_username;
            $result = $this->user_upload_item_model->get(NULL, $data);
            $this->getListing($result);
        } else {
            if (count($user_record) > 0 && $user_record->profile_completed == 1) {
                $follow_id = $user_record->user_id;
                $product_count = ("user_id = $follow_id AND item_status = 'A'");
                $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
                $service_count = ("user_id = $follow_id AND service_status = 'A'");
                $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
                $count_record = array('user_id' => $follow_id);
                $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
                $data['following_record'] = $following_record['count'];
                $count_follower = array('follow_id' => $follow_id);
                $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
                $data['follower_record'] = $follower_record['count'];
                $data['user_record'] = $user_record;
                $data['title'] = 'User Profile Items';
                $user_product = array('created_by' => $get_username);

                $data["rows"] = count($this->user_upload_item_model->get(FALSE, $user_product, array()));
                $data['title'] = 'Author Profile Products';
                $this->template->load('defaults', 'author_profile_items', $data);
            } else {
                $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('home', 'redirect');
            }
        }
    }

    public function author_profile_services() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if ($this->input->is_ajax_request()) {
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
            $data = $this->input->post();
            $data['start'] = ($page - 1) * Profile_perpage_record;
            $data['created_by'] = $get_username;
            $result = $this->user_services_model->get(NULL, $data);
            $this->getserviceListing($result);
        } else {
            if (count($user_record) > 0 && $user_record->profile_completed == 1) {
                $follow_id = $user_record->user_id;
                $product_count = ("user_id = $follow_id AND item_status = 'A'");
                $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
                $service_count = ("user_id = $follow_id AND service_status = 'A'");
                $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
                $count_record = array('user_id' => $follow_id);
                $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
                $data['following_record'] = $following_record['count'];
                $count_follower = array('follow_id' => $follow_id);
                $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
                $data['follower_record'] = $follower_record['count'];
                $data['user_record'] = $user_record;
                $data['title'] = 'Author Profile Services';
                $this->template->load('defaults', 'author_profile_services', $data);
            } else {
                $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('home', 'redirect');
            }
        }
    }

    public function author_profile_reviews() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            $count_follower = array('follow_id' => $follow_id);
            $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
            $data['follower_record'] = $follower_record['count'];
            $profile_home = array('user_id' => $follow_id);
            $profile_record = $this->user_profile_model->get(FALSE, $profile_home, array());
            $data['user_data'] = $profile_record['last_row'];
            $data['user_record'] = $user_record;
            $data['title'] = 'Author Profile Review';
            $this->template->load('defaults', 'author_profile_reviews', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details Are Not Available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function author_profile_followers() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            $count_follower = array('follow_id' => $follow_id);
            $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
            $data['follower_record'] = $follower_record['count'];
            $data['user_record'] = $user_record;
            $data['title'] = 'User Profile Follwers';
            $config = array();
            $config['full_tag_open'] = "<div class='pagination'>";
            $config['full_tag_close'] = '</div>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config["base_url"] = base_url('author_profile_followers');
            $data["rows"] = count($this->user_followers_model->get(FALSE, $count_follower, array()));
            $allrecord = $this->user_followers_model->get(FALSE, $count_follower, array());
            $config["total_rows"] = count($allrecord['allrecord']);
            $config["per_page"] = Profile_perpage_record;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["followers"] = $this->user_followers_model->fetch_record($config["per_page"], $page, $follow_id);
            $data["links"] = $this->pagination->create_links();
            $data['title'] = 'Author Profile Follwers';
            $this->template->load('defaults', 'author_profile_followers', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function author_profile_following() {
        $get_username = $this->session->userdata('username');
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            $count_follower = array('follow_id' => $follow_id);
            $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
            $data['follower_record'] = $follower_record['count'];
            $data['user_record'] = $user_record;
            $data['title'] = 'User Profile Follwing';
            $config = array();
            $config['full_tag_open'] = "<div class='pagination'>";
            $config['full_tag_close'] = '</div>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config["base_url"] = base_url('author_profile_following');
            $data["rows"] = count($this->user_followers_model->get(FALSE, $count_follower, array()));
            $allrecord = $this->user_followers_model->get(FALSE, $count_follower, array());
            $config["total_rows"] = count($allrecord['allrecord']);
            $config["per_page"] = Profile_perpage_record;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["followings"] = $this->user_followers_model->fetch_record($config["per_page"], $page, $follow_id);
            $data["links"] = $this->pagination->create_links();
            $data['title'] = 'Author Profile Follwing';
            $this->template->load('defaults', 'author_profile_following', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function message() {

        $user_id = (int) $this->session->userdata('user_id');
        if ($user_id) {
            $query = "select * from (SELECT DISTINCT(t1.user_id) as from_user_id,t1.first_name as from_first_name,t1.last_name as from_last_name,t1.profile_photo as from_profile_photo,";
            $query .= "t2.user_id as to_user_id,t2.first_name as to_first_name,t2.last_name as to_last_name,tm.message_text,t2.profile_photo as to_profile_photo,";
            $query .= "tm.status,tm.created_on,tm.ID as mid ";
            $query .= " FROM theme_user_details as t1 ";
            $query .= " INNER JOIN theme_messages as tm ON tm.msg_from_id=t1.user_id";
            $query .= " INNER JOIN theme_user_details as t2 ON tm.msg_to_id=t2.user_id";
            $query .= " WHERE tm.msg_to_id=" . $user_id . " ORDER BY tm.created_on desc) as datas GROUP BY datas.from_user_id  ORDER BY datas.created_on desc";
            $query_rws = $this->db->query($query);

            $message_data = $query_rws->result_array();
            $data['message_data'] = $message_data;
            $data['title'] = "Inbox";
            $this->template->load('dashboard_page', 'dashboard/message', $data);
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function send_message_replay() {
        $msg_perent_id = $this->input->post('msg_perent_id');
        $from_user_id = $this->encryption->encrypt($msg_perent_id);
        $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);

        $this->form_validation->set_rules('message_text', 'Replay Message', 'required');
        $this->form_validation->set_message('required', 'Please Enter %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            redirect("message_details?token=$encrypted_from_id", 'redirect');
        } else {
            $token_from_dec = $this->input->post('token_from');
            $message_text = $this->input->post('message_text');
            //get msg from_id 
            $token_from_dec = $this->input->post('token_from');
            $dec_token_from = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_from_dec);
            $msg_from_id = (int) $this->encryption->decrypt($dec_token_from);

            //get msg to 
            $token_to_dec = $this->input->post('token_to');
            $dec_token_to = str_replace(array('-', '_', '~'), array('+', '/', '='), $token_to_dec);
            $msg_to_id = (int) $this->encryption->decrypt($dec_token_to);

            $location = $this->location->map();

            $data['msg_from_id'] = $msg_from_id;
            $data['msg_to_id'] = $msg_to_id;
            $data['msg_perent_id'] = $msg_perent_id;
            $data['message_text'] = $message_text;
            $data['created_on'] = date("Y-m-d H:i:s");
            $data['ip'] = isset($location['ip']) ? $location['ip'] : "";
            $data['city'] = isset($location['city']) ? $location['city'] : "";
            $data['state'] = isset($location['region']) ? $location['region'] : "";
            $this->db->insert('theme_messages', $data);
            $id = $this->db->insert_ID();
            if ($id) {
                $this->session->set_flashdata('msg', "Your message has been send successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect("message");
                //redirect("message_details?token=$dec_token_to", 'redirect');

                exit;
            }
        }
    }

    public function change_password() {
        $data['title'] = "Change Password";
        $this->template->load('dashboard_defaults', 'dashboard/change_password', $data);
    }

    public function save_change_password() {
        $this->form_validation->set_rules('current_password', 'current password', 'required');
        $this->form_validation->set_rules('new_password', 'new password', 'required|min_length[6]|max_length[15]|callback_valid_password');
        $this->form_validation->set_rules('conform_password', 'conform password', 'required|min_length[6]|max_length[15]|matches[new_password]');
        $this->form_validation->set_message('required', 'Please enter %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->change_password();
        } else {
            $user_id = (int) $this->session->userdata('user_id');
            $count_record = array('ID' => $user_id);
            $user_record = $this->content_model->get(FALSE, $count_record, array());
            $details_record = array('user_id' => $user_id);
            $user__details_record = $this->user_details_model->get(FALSE, $details_record, array());
            $current_password = md5($this->input->post('current_password'));
            $new_password = $this->input->post('new_password');
            if ($current_password == $user_record->user_pass) {
                $hidenusername = $user_record->user_login;
                $hidenuseremail = $user_record->user_email;

                $data['user_pass'] = md5($new_password);
                $user_record = $this->content_model->edit($user_id, $data);

                $original['client_secret'] = $new_password;
                $user_record = $this->oauth_clients_model->edit($user_id, $original);

                $name = ucfirst($user__details_record->first_name) . " " . ucfirst($user__details_record->last_name);
                $message = "account password change";
                $forgot_url = base_url("forgot_password");
                $html = $this->load->view("mail/user_change_password", '', true);
                $html = str_replace('%username%', $hidenusername, $html);
                $html = str_replace('%message%', $message, $html);
                $html = str_replace('%name%', $name, $html);
                $html = str_replace('%forgot_url%', $forgot_url, $html);
                $subject = "Change Password";
                $define_param['to_name'] = $hidenusername;
                $define_param['to_email'] = $hidenuseremail;
                $send = $this->sendmail->send($define_param, $subject, $html);
                $this->session->set_flashdata('msg', "Your password is change successfully.");
                $this->session->set_flashdata('msg_class', 'success');
                redirect('account');
            } else {
                $this->session->set_flashdata('msg', "Your current password Invalid.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('change_password');
            }
        }
    }

    public function urlcheck($url) {
        if ($url != '') {
            if (@file_get_contents($url, false, NULL, 0, 1)) {
                return true;
            }
            return false;
        }
        return true;
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

    public function send_product_rating() {
        $pid = $this->input->post('pid');
        $uid = $this->input->post('uid');
        $comment = $this->input->post('comment');
        $live_rating = $this->input->post('live-rating');
        $is_recommanded = $this->input->post('is_recommanded');


        $data['user_id'] = $uid;
        $data['product_id'] = $pid;
        $data['rating'] = $live_rating;
        $data['comment'] = $comment;
        $data['is_recommanded'] = $is_recommanded;
        $data['created_on'] = date("Y-m-d H:i:s");

        $this->db->insert('theme_product_rating', $data);
        $id = $this->db->insert_ID();
        if ($id) {
            echo true;
            exit(0);
        }
    }

    public function save_freelance() {
        $user_id = (int) $this->session->userdata('user_id');
        $data['freelancer_work'] = $this->input->post('work');
        $this->user_details_model->edit($user_id, $data);
        echo true;
        exit(0);
    }

    public function check_image_size() {
        if (isset($_FILES['main_image']['tmp_name']) && $_FILES['main_image']['tmp_name'] != "") {
            $data = getimagesize($_FILES['main_image']['tmp_name']);
            $width = isset($data[0]) ? (int) $data[0] : 0;
            $height = isset($data[1]) ? (int) $data[1] : 0;
            if ($width == PRODUCT_WIDTH && $height == PRODUCT_HEIGHT) {
                return TRUE;
            } else {
                $this->form_validation->set_message('check_image_size', 'Please check your image. It must be in dimension of ' . PRODUCT_WIDTH . '*' . PRODUCT_HEIGHT);
                return FALSE;
            }
        }
    }

    public function check_banner_image_size() {
        if (isset($_FILES['profile_banner']['tmp_name']) && $_FILES['main_image']['tmp_name'] != "") {
            $data = getimagesize($_FILES['profile_banner']['tmp_name']);
            $width = isset($data[0]) ? (int) $data[0] : 0;
            $height = isset($data[1]) ? (int) $data[1] : 0;
            if ($width == PRODUCT_WIDTH && $height == PRODUCT_HEIGHT) {
                return TRUE;
            } else {
                $this->form_validation->set_message('check_banner_image_size', 'Please check your image. It must be in dimension of ' . PRODUCT_WIDTH . '*' . PRODUCT_HEIGHT);
                return FALSE;
            }
        }
    }

    public function send_service_rating() {
        $pid = $this->input->post('pid');
        $uid = $this->input->post('uid');
        $comment = $this->input->post('comment');
        $live_rating = $this->input->post('live-rating');
        $is_recommanded = $this->input->post('is_recommanded');


        $data['user_id'] = $uid;
        $data['service_id'] = $pid;
        $data['rating'] = $live_rating;
        $data['comment'] = $comment;
        $data['is_recommanded'] = $is_recommanded;
        $data['created_on'] = date("Y-m-d H:i:s");

        $this->db->insert('theme_service_rating', $data);
        $id = $this->db->insert_ID();
        if ($id) {
            echo true;
            exit(0);
        }
    }

    public function getListing($result = array()) {

        $user = $this->uri->segment(2);
        $config = array();
        $config['per_page'] = Profile_perpage_record;
        $config['uri_segment'] = 2;


        $config['num_links'] = 9;
        $config['page_query_string'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = "<div class='pagination'>";
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="' . current_url() . '">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['base_url'] = base_url() . "author_profile_products/";

        $config['total_rows'] = $result['count'];

        $this->pagination->initialize($config);
        $tableData = array();
        foreach ($result['allrecord'] as $key => $row) {
            $enc_username = $this->encryption->encrypt($row->ID);
            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
            $productfolder = sha1("product_" . $row->ID);
            $product_image_trending = isset($row->main_image) ? $row->main_image : "";
            $main_category = $row->category;
            if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                $tableData[$key]['image'] = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
            } else {
                $tableData[$key]['image'] = base_url() . img_path . "/default.png";
            }
            if (file_exists(FCPATH . img_path . "/" . $main_category . ".png")) {
                $tableData[$key]['cat_image'] = base_url() . img_path . "/" . $main_category . ".png";
            } else {
                $tableData[$key]['cat_image'] = base_url() . img_path . "/default.png";
            }

            $tableData[$key]['name'] = $this->general->add3dots($row->item_name, "...", 34);
            $tableData[$key]['p_category'] = $row->p_catagory;
            $tableData[$key]['p_category_link'] = base_url('products/' . $main_category . '/' . strtolower($this->general->slugify($row->p_catagory)) . '.jsf');
            $get_view = $this->content_model->getTotalView('theme_product_view', "p_view_pid = $row->ID");
            $tableData[$key]['total_view'] = $get_view;
            $tableData[$key]['price'] = isset($row->item_type) && $row->item_type == "P" ? "<span>$</span>" . $row->item_price : 'Free';
            $tableData[$key]['url'] = base_url('product_details.jsf') . "?token=" . $encrypted_id;
        }

        $data['data'] = $tableData;
        $data['total_count'] = isset($result['count']) ? $result['count'] : 0;
        $data['pagination'] = $this->pagination->create_links();
        echo json_encode($data);
    }

    public function getserviceListing($result = array()) {
        $config['uri_segment'] = 2;
        $config['per_page'] = Profile_perpage_record;
        $config['num_links'] = 9;
        $config['page_query_string'] = FALSE;
        $config['use_page_numbers'] = TRUE;

        $config['full_tag_open'] = "<div class='pagination'>";
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="' . current_url() . '">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['base_url'] = base_url() . "author_profile_services/";

        $config['total_rows'] = $result['count'];

        $this->pagination->initialize($config);
        $tableData = array();
        $data = $result['allrecord'];
        foreach ($result['allrecord'] as $key => $row) {
            $enc_username = $this->encryption->encrypt($row->ID);
            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
            $services_image_trending = isset($row->main_image) ? $row->main_image : "";
            $servicefolder = sha1("service_" . $row->ID);


            if (file_exists(FCPATH . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending) && $services_image_trending != "") {
                $tableData[$key]['image'] = base_url() . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending;
            } else {
                $tableData[$key]['image'] = base_url() . img_path . "/default.png";
            }

            $tableData[$key]['name'] = $this->general->add3dots($row->service_name, "...", 34);
            $tableData[$key]['p_category'] = $row->s_category;
            $tableData[$key]['p_category_link'] = base_url('services/' . strtolower($this->general->slugify($row->s_category)) . '.jsf');
            $tableData[$key]['price'] = $row->service_price;
            $get_view = $this->content_model->getTotalView('theme_service_view', "s_view_sid = $row->ID");
            $tableData[$key]['total_view'] = $get_view;
            $tableData[$key]['url'] = base_url('service_details.jsf') . "?token=" . $encrypted_id;
        }

        $data['data'] = $tableData;
        $data['total_count'] = isset($result['count']) ? $result['count'] : 0;
        $data['pagination'] = $this->pagination->create_links();
        echo json_encode($data);
    }

}

?>