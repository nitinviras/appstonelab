<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Oauther extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_upload_item_model');
        $this->load->model('user_services_model');
        $this->load->model('user_followers_model');
        $this->load->model('user_details_model');
        $this->load->model('content_model');
        $this->load->model('user_profile_model');
    }

    public function profile() {
        $get_username = $this->uri->segment(2);
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
            $follow_id = $user_record->user_id;
            if ($this->session->userdata('username')) {
                $follow_record = $this->user_followers_model->selete($follow_id, $user_id);
                $data['follow_record'] = $follow_record['last_row'];
            }
            // Get login user details
            $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
            if ($user_id > 0 && count($user_data) > 0) {
                $data['login_user_data'] = $user_data;
            }
            $count_record = array('user_id' => $follow_id);
            $product_record = $this->user_upload_item_model->get(FALSE, $count_record, array());
            $data['product_record'] = $product_record['count'];

            //$services_record = array('theme_user_services.user_id' => $follow_id,"theme_user_services.service_status"=>"A");
            $service_record = $this->user_services_model->service_count($follow_id);

            $data['service_record'] = $service_record;
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];

            //reputation section
            $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
            $this->db->join('theme_user_upload_item', 'theme_user_upload_item.id = theme_product_rating.product_id', 'INNER');
            $this->db->where('theme_user_upload_item.user_id', $user_record->user_id);
            $query = $this->db->get('theme_product_rating');
            $data['reputation'] = $query->row();


            $count_follower = array('follow_id' => $follow_id);
            $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
            $data['follower_record'] = $follower_record['count'];
            $profile_home = array('user_id' => $follow_id);
            $profile_record = $this->user_profile_model->get(FALSE, $profile_home, array());
            $data['user_data'] = $profile_record['last_row'];
            $data['user_record'] = $user_record;
            $data['title'] = 'User Profile Details';
            $this->template->load('defaults', 'profile', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details Are Not Available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function profile_items() {
        if ($this->input->is_ajax_request()) {
            $get_username = $this->uri->segment(2);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
            $data = $this->input->post();
            $data['start'] = ($page - 1) * Perpage_record;
            $data['created_by'] = $get_username;
            $result = $this->user_upload_item_model->get(NULL, $data);
            $this->getListing($result);
        } else {
            $get_username = $this->uri->segment(2);
            $check_user_record = array('user_login' => $get_username);
            $user_record = $this->content_model->get(FALSE, $check_user_record, array());
            if (count($user_record) > 0 && $user_record->profile_completed == 1) {
                $follow_id = $user_record->user_id;
                $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
                if ($this->session->userdata('username')) {
                    $follow_record = $this->user_followers_model->selete($follow_id, $user_id);
                    $data['follow_record'] = $follow_record['last_row'];
                }
                // Get login user details
                $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
                if ($user_id > 0 && count($user_data) > 0) {
                    $data['login_user_data'] = $user_data;
                }
                $product_count = ("user_id = $follow_id AND item_status = 'A'");
                $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
                $service_count = ("user_id = $follow_id AND service_status = 'A'");
                $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
                $count_record = array('user_id' => $follow_id);
                $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
                $data['following_record'] = $following_record['count'];

                //reputation section
                $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
                $this->db->join('theme_user_upload_item', 'theme_user_upload_item.id = theme_product_rating.product_id', 'INNER');
                $this->db->where('theme_user_upload_item.user_id', $user_record->user_id);
                $query = $this->db->get('theme_product_rating');
                $data['reputation'] = $query->row();

                $count_follower = array('follow_id' => $follow_id);
                $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
                $data['follower_record'] = $follower_record['count'];
                $data['user_record'] = $user_record;
                $data['title'] = 'User Profile Items';
                $user_product = array('created_by' => $get_username);
                $data["rows"] = count($this->user_upload_item_model->get(FALSE, $user_product, array()));
                $this->template->load('defaults', 'profile_items', $data);
            }
        }
    }

    public function profile_service() {
        if ($this->input->is_ajax_request()) {
            $get_username = $this->uri->segment(2);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
            $data = $this->input->post();
            $data['start'] = ($page - 1) * Perpage_record;
            $data['created_by'] = $get_username;
            $result = $this->user_services_model->get(NULL, $data);
            $this->getserviceListing($result);
        } else {
            $get_username = $this->uri->segment(2);
            $check_user_record = array('user_login' => $get_username);
            $user_record = $this->content_model->get(FALSE, $check_user_record, array());
            if (count($user_record) > 0 && $user_record->profile_completed == 1) {
                $follow_id = $user_record->user_id;
                $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
                if ($this->session->userdata('username')) {
                    $follow_record = $this->user_followers_model->selete($follow_id, $user_id);
                    $data['follow_record'] = $follow_record['last_row'];
                }
                // Get login user details
                $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
                if ($user_id > 0 && count($user_data) > 0) {
                    $data['login_user_data'] = $user_data;
                }
                $product_count = ("user_id = $follow_id AND item_status = 'A'");
                $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
                $service_count = ("user_id = $follow_id AND service_status = 'A'");
                $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
                $count_record = array('user_id' => $follow_id);
                $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
                $data['following_record'] = $following_record['count'];

                //reputation section
                $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
                $this->db->join('theme_user_upload_item', 'theme_user_upload_item.id = theme_product_rating.product_id', 'INNER');
                $this->db->where('theme_user_upload_item.user_id', $user_record->user_id);
                $query = $this->db->get('theme_product_rating');
                $data['reputation'] = $query->row();

                $count_follower = array('follow_id' => $follow_id);
                $follower_record = $this->user_followers_model->get(FALSE, $count_follower, array());
                $data['follower_record'] = $follower_record['count'];
                $data['user_record'] = $user_record;
                $data['title'] = 'User Profile Services';
                $user_product = array('created_by' => $get_username);
                $this->template->load('defaults', 'profile_service', $data);
            } else {
                $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('home', 'redirect');
            }
        }
    }

    public function profile_followers() {
        $get_username = $this->uri->segment(2);
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
            if ($this->session->userdata('username')) {
                $follow_record = $this->user_followers_model->selete($follow_id, $user_id);
                $data['follow_record'] = $follow_record['last_row'];
            }
            // Get login user details
            $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
            if ($user_id > 0 && count($user_data) > 0) {
                $data['login_user_data'] = $user_data;
            }
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            
            //reputation section
            $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
            $this->db->join('theme_user_upload_item', 'theme_user_upload_item.id = theme_product_rating.product_id', 'INNER');
            $this->db->where('theme_user_upload_item.user_id', $user_record->user_id);
            $query = $this->db->get('theme_product_rating');
            $data['reputation'] = $query->row();
            
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
            $config["base_url"] = base_url('profile_products/' . $get_username);
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
            $this->template->load('defaults', 'profile_followers', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function profile_following() {
        $get_username = $this->uri->segment(2);
        $check_user_record = array('user_login' => $get_username);
        $user_record = $this->content_model->get(FALSE, $check_user_record, array());
        if (count($user_record) > 0 && $user_record->profile_completed == 1) {
            $follow_id = $user_record->user_id;
            $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
            if ($this->session->userdata('username')) {
                $follow_record = $this->user_followers_model->selete($follow_id, $user_id);
                $data['follow_record'] = $follow_record['last_row'];
            }
            // Get login user details
            $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
            if ($user_id > 0 && count($user_data) > 0) {
                $data['login_user_data'] = $user_data;
            }
            $product_count = ("user_id = $follow_id AND item_status = 'A'");
            $data['product_record'] = $this->user_upload_item_model->countActiveRow('theme_user_upload_item', $product_count);
            $service_count = ("user_id = $follow_id AND service_status = 'A'");
            $data['service_record'] = $this->user_services_model->countActiveRow('theme_user_services', $service_count);
            $count_record = array('user_id' => $follow_id);
            $following_record = $this->user_followers_model->get(FALSE, $count_record, array());
            $data['following_record'] = $following_record['count'];
            
            //reputation section
            $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
            $this->db->join('theme_user_upload_item', 'theme_user_upload_item.id = theme_product_rating.product_id', 'INNER');
            $this->db->where('theme_user_upload_item.user_id', $user_record->user_id);
            $query = $this->db->get('theme_product_rating');
            $data['reputation'] = $query->row();
            
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
            $config["base_url"] = base_url('profile_products/' . $get_username);
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
            $this->template->load('defaults', 'profile_following', $data);
        } else {
            $this->session->set_flashdata('msg', "Sorry This User Details are not available.");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('home', 'redirect');
        }
    }

    public function user_follow() {
        $follow_id = $this->input->get('follow_id');
        $id = $this->input->get('id');
        if ($id > 0) {
            $del_result = $this->user_followers_model->delete($id);
        } else {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'follow_id' => $follow_id,
                'created_date' => date("Y-m-d H:i:s")
            );
            $this->user_followers_model->insert($data);
        }
    }

    public function getListing($result = array()) {

        $user = $this->uri->segment(2);
        $config = array();
        $config['per_page'] = Perpage_record;
        $config['uri_segment'] = 3;


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

        $config['base_url'] = base_url() . "profile_products/$user/";


//        $config['total_rows'] =  count($result['allrecord']);
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
        $main_category = $this->uri->segment(2);

        $config = array();
        $config['per_page'] = Perpage_record;
        if ($main_category != '' && !(is_numeric($main_category))) {
            $config['uri_segment'] = 3;
        } else {
            $config['uri_segment'] = 2;
        }


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

        $config['base_url'] = base_url() . "services";


//        $config['total_rows'] =  count($result['allrecord']);
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