<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('user_details_model');
        $this->load->model('user_upload_item_model');
        $this->load->model('user_services_model');
    }

    public function error_page() {
        $this->load->view('error_page');
    }

    public function index() {
        
        $result_pro = array();
        $get_user_id = array();
        //web product
        $web_row_product = array('item_main_category' => 'web', 'item_status' => 'A');
        $web_result = $this->user_upload_item_model->get(FALSE, $web_row_product, array());
        //android
        $android_row_product = array('item_main_category' => 'android', 'item_status' => 'A');
        $android_result = $this->user_upload_item_model->get(FALSE, $android_row_product, array());
        //ios
        $iso_row_product = array('item_main_category' => 'ios', 'item_status' => 'A');
        $iso_result = $this->user_upload_item_model->get(FALSE, $iso_row_product, array());

        //get all service list
        $row_service = array('service_status' => 'A');
        $service_result = $this->user_services_model->get(FALSE, $row_service, array());

        //follwer_feed product get
        $user_id = (int) $this->session->userdata("user_id");

        $follwers_result = $this->content_model->getdata('theme_user_followers', '', 'follow_id="' . $user_id . '"');
        foreach ($follwers_result as $value) {
            $get_user_id[] = $value['user_id'];
        }
        $add_min = date("Y-m-d H:i:s", strtotime(FOLLWER_PRODUCTS));

        foreach ($get_user_id as $row) {
            $result_pro[] = $this->content_model->follwer_feeddata('theme_user_upload_item', 'theme_user_upload_item.user_id="' . $row . '" AND item_status="A" AND theme_user_upload_item.created_date >="' . $add_min . '"');
        }
        $data["follwer_feed"] = $result_pro;
        $data['web_products'] = $web_result['allrecord'];
        $data['android_products'] = $android_result['allrecord'];
        $data['ios_products'] = $iso_result['allrecord'];
        $data['new_services'] = $service_result['allrecord'];
        $this->template->load('main_page', 'home', $data);
    }

    public function modal_value() {
//        fetch data
        $get_id = (int) $this->input->get('id');
        $get_name = $this->input->get('name');
        if ($get_name == 'product') {
            $this->db->select('theme_user_upload_item.*,theme_users.user_registered,theme_users.user_login,theme_user_details.first_name,theme_user_details.last_name,theme_user_details.personal_website,theme_user_details.profile_photo,theme_user_details.company_name,theme_user_social_link.fb_link,theme_user_social_link.gplus_link,theme_user_social_link.twt_link,theme_cities.name AS cityname,theme_countries.name AS countryname,theme_states.name AS statename', FALSE);
            $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_upload_item.user_id', 'left');
        } else {
            $this->db->select('theme_user_services.*,theme_users.user_registered,theme_users.user_login,theme_user_details.first_name,theme_user_details.last_name,theme_user_details.personal_website,theme_user_details.profile_photo,theme_user_details.company_name,theme_user_social_link.fb_link,theme_user_social_link.gplus_link,theme_user_social_link.twt_link,theme_cities.name AS cityname,theme_countries.name AS countryname,theme_states.name AS statename', FALSE);
            $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_services.user_id', 'left');
        }
        $this->db->join('theme_users', 'theme_users.ID =theme_user_details.user_id', 'left');
        $this->db->join('theme_user_social_link', 'theme_user_social_link.user_id =theme_user_details.user_id', 'left');
        $this->db->join('theme_cities', 'theme_cities.id =theme_user_details.city', 'left');
        $this->db->join('theme_states', 'theme_states.id =theme_user_details.state', 'left');
        $this->db->join('theme_countries', 'theme_countries.id =theme_user_details.country', 'left');
        if ($get_name == 'product') {
            $this->db->where('theme_user_upload_item.item_status', 'A');
            $this->db->where('theme_user_upload_item.ID', $get_id);
            $query = $this->db->get('theme_user_upload_item');
        } else {
            $this->db->where('theme_user_services.service_status', 'A');
            $this->db->where('theme_user_services.ID', $get_id);
            $query = $this->db->get('theme_user_services');
        }
        $last_row = $query->row();
//      fetch  product and service main image
        $image_trending = isset($last_row->main_image) ? $last_row->main_image : "";
        if ($get_name == 'product') {
            $title = $last_row->item_name;
            $description = $last_row->item_description;
            $productfolders = sha1("product_" . $last_row->ID);
            if (file_exists(FCPATH . uploads_path . '/products/' . $productfolders . '/' . $image_trending) && $image_trending != "") {
                $main_image = base_url() . uploads_path . '/products/' . $productfolders . '/' . $image_trending;
            } else {
                $main_image = base_url() . img_path . "/user.png";
            }
        } else {
            $title = $last_row->service_name;
            $description = $last_row->service_description;
            $servicefolder = sha1("service_" . $last_row->ID);
            if (file_exists(FCPATH . uploads_path . '/services/' . $servicefolder . '/' . $image_trending) && $image_trending != "") {
                $main_image = base_url() . uploads_path . '/services/' . $servicefolder . '/' . $image_trending;
            } else {
                $main_image = base_url() . img_path . "/user.png";
            }
        }
//        fetch profile image
        $profilefolder = sha1("profile_" . $last_row->user_id);
        $profile_main_image = isset($last_row->profile_photo) ? $last_row->profile_photo : "";

        if (file_exists(FCPATH . uploads_path . '/profiles/' . $profilefolder . '/' . $profile_main_image) && $profile_main_image != "") {
            $profile_image = base_url() . uploads_path . '/profiles/' . $profilefolder . '/' . $profile_main_image;
        } else {
            $profile_image = base_url() . img_path . "/user.png";
        }
        $details_link_enc = $this->encryption->encrypt($last_row->ID);
        $details_link_encrypted = str_replace(array('+', '/', '='), array('-', '_', '~'), $details_link_enc);
        $details_link = base_url('product_details') . "?token=" . $details_link_encrypted;
        $profile_link = base_url('profile') . "/" . $last_row->user_login;
//        popup html
        $html = "<div class='modal-header p-4'>";
        $html .= "<button type='button' class='close1' data-dismiss='modal' aria-label='Close'>";
        $html .= "<span class='arrow_close' aria-hidden='true'>&#60;</span><span class='text_close'>Back To Page</span>";
        $html .= "</button>";
        $html .= "<div class='float-right'> ";
        $html .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $html .= "<span aria-hidden='true'>&times;</span>";
        $html .= "</button>";
        $html .= "<a href=" . $details_link . " type='button' class='btn btn-secondary float-right'>";
        $html .= "Details";
        $html .= "</a>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class='modal-body bggrey'>";
        $html .= "<div class='card'>";
        $html .= "<div class='card-block'>";
        $html .= "<div class='row'>";
        $html .= " <div class='col-md-12'>";
        $html .= " <p class='title_name'>$title</p>";
        $html .= " </div>";
        $html .= " <div class='col-md-6'>";
        $html .= " <div class='image_content'>";
        $html .= " <figure>";
        $html .= " <a href=" . $details_link . ">";
        $html .= " <img src=" . $main_image . " alt='modal_image' class='img-fluid img-thumbnail'>";
        $html .= " </a>";
        $html .= " </figure>";
        $html .= "</div>";
        $html .= " <div class='user_details'>";
        $html .= "<div class='row'>";
        $html .= "<div class='col-md-6'>";
        $html .= " <div class='text-center'>";
        $html .= " <figure class='user-avatar modal_profile'>";
        $html .= " <a href=" . $profile_link . ">";
        $html .= "   <img src=" . $profile_image . " alt='modal_image' class='img-fluid img-thumbnail'>";
        $html .= "</a>";
        $html .= "</figure>";
        $html .= " </div>";
        $html .= " </div>";
        $html .= " <div class='col-md-6'>";
        $html .= "  <div class='user'>";
        $html .= " <h6>" . ucfirst($last_row->first_name) . " " . ucfirst($last_row->last_name) . "</h6>";
        $html .= "<p>$last_row->company_name <br/> $last_row->cityname,$last_row->statename $last_row->countryname</p>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= " </div>";
        $html .= "<div class='mt-4'>";
        $html .= "<div class='author-profile-info py-0 mb-0 pl-0'>";

        $html .= "<div class='row'>";
        $html .= "<div class='col-md-6'>";
        $html .= "  <div class='author-profile-info-item'>";
        $html .= "   <h6 class='text-header'>Member Since:</h6>";
        $html .= "  <p>" . date('F d,Y', strtotime($last_row->user_registered)) . "</p>";
        $html .= "</div>";
        $html .= "</div>";

        $html .= "<div class='col-md-6'>";
        $html .= "<div class='author-profile-info-item'>";
        $html .= " <h6 class='text-header'>Freelance Work:</h6>";
        $html .= " <p>Available</p>";
        $html .= " </div>";
        $html .= " </div>";

        $html .= "<div class='col-md-6'>";
        $html .= "<div class='author-profile-info-item border-0'>";
        $html .= "<h6 class='text-header'>Website:</h6>";
        $html .= "<p><a href=" . $last_row->personal_website . " class='primary' target='_blank'>$last_row->personal_website</a></p>";
        $html .= "</div>";
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div>";
        $html .= "<ul class='share-links'>";
        $html .= "<li><a  class='fb' target='_blank' href=" . $last_row->fb_link . "></a></li>";
        $html .= "<li><a  class='twt' target='_blank' href=" . $last_row->twt_link . "></a></li>";
        $html .= " <li><a  class='gplus' target='_blank' href=" . $last_row->gplus_link . "></a></li>";
        $html .= "</ul>";
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class='col-md-6 details_modal_page'>";
        $html .= "$description";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
    }

    public function faq() {
        $faq_result = $this->user_upload_item_model->getAllRow('theme_faq', 'status="A"');
        $data['title'] = "FAQ";
        $data['faq_list'] = $faq_result;
        $this->template->load('defaults', 'faq', $data);
    }

    public function terms_conditions() {
        $data['title'] = "Terms & Conditions";
        $this->template->load('defaults', 'terms_conditions', $data);
    }

    public function privacy_policy() {
        $data['title'] = "Privacy Policy";
        $this->template->load('defaults', 'privacy_policy', $data);
    }

    public function how_it_work() {
        $data['title'] = "How it Work";
        $this->template->load('defaults', 'how-it-work', $data);
    }

    public function disclaimer() {
        $data['title'] = "Disclaimer";
        $this->template->load('defaults', 'disclaimer', $data);
    }

    public function intellectual() {
        $data['title'] = "Intellectual Property Claims";
        $this->template->load('defaults', 'intellectual', $data);
    }

}

?>