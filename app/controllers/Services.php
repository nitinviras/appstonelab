<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_services_model');
        $this->load->model('user_details_model');
        $this->load->model('content_model');
    }

    public function index() {
        if ($this->input->is_ajax_request()) {

            $data = $this->input->post();

            $sub_category = $this->uri->segment(2);
            $parent_category = $this->uri->segment(3);


            if ($sub_category != '' && !is_numeric($sub_category) && $parent_category == '') {
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
            } else
            if ($parent_category != '' && !is_numeric($parent_category)) {
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
            } else {
                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
            }

            $data['title'] = 'Service';
            $data['start'] = ($page - 1) * Perpage_record;
            $result = $this->user_services_model->get(NULL, $data);
            $this->getListing($result);
        } else {
            $data['title'] = 'Services';
            $data["services_category"] = $this->user_services_model->get_category();
            $data["services_sub_category"] = $this->user_services_model->get_sub_category();
            $this->template->load('author_page', 'services', $data);
        }
    }

    public function service_details() {
        $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
        $get_id = $this->input->get('token');
        $dec_token = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = (int) $this->encryption->decrypt($dec_token);
        $this->insert_sview_entry($user_id, $id);
        if ($id) {
            $row_product = array('ID' => $id);
            $product_result = $this->user_services_model->get(FALSE, $row_product, array());
            if (count($product_result) > 0) {
// Get login user details
                $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
                if ($user_id > 0 && count($user_data) > 0) {
                    $data['login_user_data'] = $user_data;
                }
                $data['service_details'] = $product_result['last_row'];
                $data['title'] = $product_result['last_row']->service_name;
//comment section
                $this->db->select('theme_user_comment_service.*,theme_user_details.first_name,theme_user_details.last_name,theme_user_details.profile_photo,theme_users.user_login', FALSE);
                $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_comment_service.user_id', 'left');
                $this->db->join('theme_users', 'theme_users.ID =theme_user_comment_service.user_id', 'left');
                $this->db->where('service_id', $id);
                $this->db->where('comment_perent_id', 0);
                $query = $this->db->get('theme_user_comment_service');
                $data['comment'] = $query->result();
                
                //reputation section
                $this->db->select('theme_user_services.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_service_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_service_rating.id)) as avg_recommanded', FALSE);
                $this->db->join('theme_user_services', 'theme_user_services.ID = theme_service_rating.service_id', 'INNER');
                $this->db->where('theme_user_services.id', $id);
                $query = $this->db->get('theme_service_rating');
                $data['reputation'] = $query->row();

                //more service get 
                $more_result = $this->content_model->more_service('theme_user_services', 'theme_user_services.user_id="' . $product_result['last_row']->user_id . '" AND service_status="A" AND theme_user_services.ID !="' . $id . '"');
                $data['more_service'] = $more_result;
                $this->template->load('author_page', 'service_details', $data);
            } else {
                $this->session->set_flashdata('msg', "Invalid request. Please try again");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('msg', "Invalid request. Please try again");
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url());
        }
    }

    public function comment_service() {
        $comment = $this->input->get("comment");
        $perent_id = (int) $this->input->get("perent_id");
        $get_service_id = $this->input->get("service_id");
        $get_user_id = $this->input->get("user_id");
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_service_id);
        $service_id = $this->encryption->decrypt($dec_username);
        $dec_user_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_user_id);
        $service_user_id = $this->encryption->decrypt($dec_user_id);
        $user_id = $this->session->userdata("user_id");
        $user_name = $this->session->userdata("username");
        $data = array(
            'user_id' => $user_id,
            'comment' => $comment,
            'service_id' => $service_id,
            'comment_perent_id' => $perent_id,
            'created_on' => date("Y-m-d H:i:s")
        );
        $this->db->insert('theme_user_comment_service', $data);
        $id = $this->db->insert_ID();
        if ($id) {
            $check_user_record = array('user_id' => $user_id);
            $user_record = $this->user_details_model->get(FALSE, $check_user_record, array());
            $productfolder = sha1("profile_" . $user_id);
            $product_main_image = isset($user_record->profile_photo) ? $user_record->profile_photo : "";

            if (file_exists(FCPATH . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image) && $product_main_image != "") {
                $product_image_url_details = base_url() . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image;
            } else {
                $product_image_url_details = base_url() . img_path . "/user.png";
            }
            $profile_url = base_url('profile') . "/" . $user_name;
            $user = ucfirst($user_record->first_name) . " " . ucfirst($user_record->last_name);
            $date = date(date_formate);
            $html = "<div class ='comment-wrap'>";
            $html .= "<a href=" . $profile_url . ">";
            $html .= " <figure class = 'user-avatar medium'>";
            $html .= "<img src =" . $product_image_url_details . " >";
            $html .= "</figure>";
            $html .= " </a>";
            $html .= "<div class = 'comment' id = 'comment_box'>";
            $html .= "<p class = 'text-header'>" . $user . "</p>";
            if ($service_user_id == $user_id) {
                $html .= "<span class='pin greyed'>Author</span>";
            }
            $html .= "<p class = 'timestamp'>" . $date . "</p>";
            $html .= "<p>" . $comment . "</p>";
            $html .= "</div>";
            $html .= "</div >";
            echo $html;
            exit(0);
        } else {
            echo FALSE;
            exit(0);
        }
    }

    public function getListing($result = array()) {

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

            //profile image

            $details_user_fol_nm = sha1("profile_" . $row->user_id);
            $profile_image_details = isset($row->profile_photo) ? trim($row->profile_photo) : "";

            if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
            } else {
                $profile_image_url_details = base_url() . img_path . "/user.png";
            }

            $tableData[$key]['name'] = $this->general->add3dots($row->service_name, "...", 34);
            $tableData[$key]['p_category'] = $row->s_category;
            $tableData[$key]['p_category_link'] = base_url('services/' . strtolower($this->general->slugify($row->s_category)) . '.jsf');
            $tableData[$key]['price'] = $row->service_price;
            $get_view = $this->content_model->getTotalView('theme_service_view', "s_view_sid = $row->ID");
            $tableData[$key]['total_view'] = $get_view;
            $get_comment = $this->content_model->getTotalView('theme_user_comment_service', "service_id = $row->ID AND comment_perent_id = 0");
            $tableData[$key]['total_comment'] = $get_comment;
            $tableData[$key]['created_by'] = $row->created_by;
            $tableData[$key]['profile_image'] = $profile_image_url_details;
            $tableData[$key]['profile_url'] = base_url('profile') . "/" . $row->created_by . '.jsf';
            $tableData[$key]['url'] = base_url('service_details.jsf') . "?token=" . $encrypted_id;
        }

        $data['data'] = $tableData;
        $data['pagination'] = $this->pagination->create_links();
        echo json_encode($data);
    }

    public function insert_sview_entry($uid = 0, $pid) {
        $location = $this->location->map();
        $data['s_view_sid'] = $pid;
        $data['s_view_uid'] = $uid;
        $data['s_view_ip_address'] = isset($location['ip']) ? $location['ip'] : "";
        $data['s_view_created_date'] = date('Y-m-d H:i:s');
        $res = $this->user_services_model->insert_view_entry($data);
        return $res;
    }

    public function get_category() {
        $cid = $this->input->post('c_id');
        $html = "<option value = ''>Select Sub Category</option>";
        if ($cid != '') {
            $cond = 'status = "A" and category = ' . $cid;
            $res = $this->user_services_model->getallRow('theme_service_sub_category', $cond);

            if (!empty($res)) {
                foreach ($res as $row) {
                    $html .= "<option value = '$row->ID'>" . ucfirst($row->name) . "</option>";
                }
            }
        }
        echo $html;
        exit;
    }

}

?>
