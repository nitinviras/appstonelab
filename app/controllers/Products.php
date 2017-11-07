<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_upload_item_model');
        $this->load->model('user_details_model');
        $this->load->model('content_model');
        $this->load->model('user_product_category_model');
    }

    public function index() {

        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $sub_category = $this->uri->segment(3);
            $product_category = $this->uri->segment(4);

            if ($sub_category != '' && !is_numeric($sub_category) && $product_category == '') {
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
            } else if ($product_category != '' && !is_numeric($product_category)) {
                $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
            } else {
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
            }
            $data['start'] = ($page - 1) * Perpage_record;
            $result = $this->user_upload_item_model->get(NULL, $data);
            $this->getListing($result);
        } else {
            $main_category = $this->uri->segment(2);
            $sub_category = $this->uri->segment(3);
            $product_category = $this->uri->segment(4);
            $main_condition = array('category' => $main_category);
            $sub_condition = array('item_main_category' => $main_category);
            $main_category_result = $this->user_product_category_model->get(FALSE, 'theme_user_parent_category', $main_condition, array());

            $data['main_category'] = $main_category_result['allrecord'];
            $sub_category_result = $this->user_product_category_model->get(FALSE, 'theme_user_product_category', $sub_condition, array());
            $data['sub_category'] = $sub_category_result['allrecord'];
            $data['title'] = 'Products';
            $this->template->load('page', 'products', $data);
        }
    }

    public function product_details() {
        $user_id = (int) trim(($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0);
        $get_id = $this->input->get('token');
        $dec_token = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
        $id = (int) $this->encryption->decrypt($dec_token);
        $this->insert_pview_entry($user_id, $id);

        if ($id) {
            $row_product = array('ID' => $id);
            $product_result = $this->user_upload_item_model->get(FALSE, $row_product, array());
            if (count($product_result) > 0) {
                // Get login user details
                $user_data = $this->general->getLoginUser("theme_users", "theme_users.ID=" . $user_id);
                if ($user_id > 0 && count($user_data) > 0) {
                    $data['login_user_data'] = $user_data;
                }
                $data['product_details'] = $product_result['last_row'];
                $data['title'] = $product_result['last_row']->item_name;
                //comment section
                $this->db->select('theme_user_comment_product.*,theme_user_details.first_name,theme_user_details.last_name,theme_user_details.profile_photo,theme_users.user_login', FALSE);
                $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_comment_product.user_id', 'left');
                $this->db->join('theme_users', 'theme_users.ID =theme_user_comment_product.user_id', 'left');
                $this->db->where('product_id', $id);
                $this->db->where('comment_perent_id', 0);
                $query = $this->db->get('theme_user_comment_product');
                $data['comment'] = $query->result();
                
                
                //reputation section
                $this->db->select('theme_user_upload_item.user_id, (5*COUNT(CASE WHEN rating = 5 THEN 1 END) + 4*COUNT(CASE WHEN rating = 4 THEN 1 END) + 3*COUNT(CASE WHEN rating = 3 THEN 1 END) +2*COUNT(CASE WHEN rating = 2 THEN 1 END) + 1*COUNT(CASE WHEN rating = 1 THEN 1 END)) / (count(theme_product_rating.id)) as avg_rating, (100 * COUNT(CASE WHEN is_recommanded = "Y" THEN 1 END) / count(theme_product_rating.id)) as avg_recommanded', FALSE);
                $this->db->join('theme_user_upload_item', 'theme_user_upload_item.ID = theme_product_rating.product_id', 'INNER');
                $this->db->where('theme_user_upload_item.id', $id);
                $query = $this->db->get('theme_product_rating');
                
                $data['reputation'] = $query->row();
                
    
                //more product get 
                $more_result = $this->content_model->more_product('theme_user_upload_item', 'theme_user_upload_item.user_id="' . $product_result['last_row']->user_id . '" AND item_status="A" AND theme_user_upload_item.ID !="' . $id . '"');
                $data['more_product'] = $more_result;
                $this->template->load('author_page', 'product_details', $data);
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

    public function send_message() {

        $token_from_dec = $this->input->post('token_from');
        $message_text = $this->input->post('message_text');
        $dash_msg_to_id = $this->input->post('token_to');

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
        $data['message_text'] = $message_text;
        $data['created_on'] = date("Y-m-d H:i:s");
        $data['ip'] = isset($location['ip']) ? $location['ip'] : "";
        $data['city'] = isset($location['city']) ? $location['city'] : "";
        $data['state'] = isset($location['region']) ? $location['region'] : "";
        $this->db->insert('theme_messages', $data);
        $id = $this->db->insert_id();

        if ($id) {
            $msg_to_id = (int) $msg_to_id;
            $count_record = array('ID' => $msg_to_id);
            $user_recordS = $this->content_model->getData("theme_users", "user_login,user_email", "ID=" . $msg_to_id);

            $hidenusername = isset($user_recordS[0]['user_login']) ? $user_recordS[0]['user_login'] : "nitinboricha91@gmail.com";
            $hidenuseremail = isset($user_recordS[0]['user_email']) ? $user_recordS[0]['user_email'] : "nitinboricha91@gmail.com";

            $details_record = array('user_id' => $msg_to_id);
            $user__details_record = $this->content_model->getData("theme_user_details", "first_name,last_name", "user_id=" . $msg_to_id);

            $sender = $this->session->userdata("username");
            $name = ucfirst(isset($user__details_record[0]['first_name']) ? $user__details_record[0]['first_name'] : "Admin") . " " . ucfirst(isset($user__details_record[0]['last_name']) ? $user__details_record[0]['last_name'] : "Admin");
            $message = "New message in your account";
            $html = $this->load->view("mail/user_message", '', true);
            $html = str_replace('%message%', $message, $html);
            $html = str_replace('%name%', $name, $html);
            $html = str_replace('%sender%', $sender, $html);
            $subject = "New Message";
            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;
            $send = $this->sendmail->send($define_param, $subject, $html);
            echo true;
            exit(0);
        } else {
            echo FALSE;
            exit(0);
        }
    }

    public function comment() {
        $comment = $this->input->get("comment");
        $perent_id = (int) $this->input->get("perent_id");
        $get_product_id = $this->input->get("product_id");
        $get_user_id = $this->input->get("user_id");
        $dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_product_id);
        $product_id = $this->encryption->decrypt($dec_username);
        $dec_user_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_user_id);
        $product_user_id = $this->encryption->decrypt($dec_user_id);
        $user_id = $this->session->userdata("user_id");
        $user_name = $this->session->userdata("username");
        $data = array(
            'user_id' => $user_id,
            'comment' => $comment,
            'product_id' => $product_id,
            'comment_perent_id' => $perent_id,
            'created_on' => date("Y-m-d H:i:s")
        );
        $this->db->insert('theme_user_comment_product', $data);
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
            if ($product_user_id == $user_id) {
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

    public function get_sub_category() {
        $cid = $this->input->post('c_id');
        $html = "<option value = ''>Select Sub Category</option>";
        if ($cid != '') {
            $cond = 'status = "A" and parent_category = ' . $cid;
            $res = $this->user_product_category_model->getallRow('theme_user_product_category', $cond);

            if (!empty($res)) {
                foreach ($res as $row) {
                    $html .= "<option value = '$row->ID'>$row->name</option>";
                }
            }
        }
        echo $html;
        exit;
    }

    public function getListing($result = array()) {

        $main_category = $this->uri->segment(2);
        $item_parent_category = $this->uri->segment(3);
        $item_sub_category = $this->uri->segment(4);
        $config = array();
        $config['per_page'] = Perpage_record;
        if ($item_parent_category != '' && !(is_numeric($item_parent_category)) && $item_sub_category == '') {
            $config['uri_segment'] = 4;
        } else if ($item_sub_category != '' && !(is_numeric($item_sub_category))) {
            $config['uri_segment'] = 5;
        } else {
            $config['uri_segment'] = 3;
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

        $config['base_url'] = base_url() . "products/$main_category/";


//        $config['total_rows'] =  count($result['allrecord']);
        $config['total_rows'] = $result['count'];

        $this->pagination->initialize($config);
        $tableData = array();
        foreach ($result['allrecord'] as $key => $row) {
            $enc_username = $this->encryption->encrypt($row->ID);
            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
            $productfolder = sha1("product_" . $row->ID);
            $product_image_trending = isset($row->main_image) ? $row->main_image : "";

            if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                $tableData[$key]['image'] = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
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

            $tableData[$key]['name'] = $this->general->add3dots($row->item_name, "...", 34);
            $tableData[$key]['p_category'] = $row->p_catagory;
            $tableData[$key]['p_category_link'] = base_url('products/' . $main_category . '/' . strtolower($this->general->slugify($row->p_catagory)) . '.jsf');
            $get_view = $this->content_model->getTotalView('theme_product_view', "p_view_pid = $row->ID");
            $tableData[$key]['total_view'] = $get_view;
            $get_comment = $this->content_model->getTotalView('theme_user_comment_product', "product_id = $row->ID AND comment_perent_id = 0");
            $tableData[$key]['total_comment'] = $get_comment;
            $tableData[$key]['created_by'] = $row->created_by;
            $tableData[$key]['profile_image'] = $profile_image_url_details;
            $tableData[$key]['profile_url'] = base_url('profile') . "/" . $row->created_by . '.jsf';
            $tableData[$key]['price'] = isset($row->item_type) && $row->item_type == "P" ? "<span>$</span>" . $row->item_price : 'Free';
            $tableData[$key]['url'] = base_url('product_details.jsf') . "?token=" . $encrypted_id;
        }

        $data['data'] = $tableData;
        $data['total_count'] = isset($result['count']) ? $result['count'] : 0;
        $data['pagination'] = $this->pagination->create_links();
        echo json_encode($data);
    }

    public function insert_pview_entry($uid = 0, $pid) {
        $location = $this->location->map();
        $data['p_view_pid'] = $pid;
        $data['p_view_uid'] = $uid;
        $data['p_view_ip_address'] = isset($location['ip']) ? $location['ip'] : "";
        $data['p_view_created_date'] = date('Y-m-d H:i:s');
        $res = $this->user_upload_item_model->insert_view_entry($data);
        return $res;
    }

}
