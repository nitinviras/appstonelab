<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Android extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('android_model');
    }

   public function index() {
       $title='android';
       $data['Android_category'] = $this->android_model->get_android_category();
       $data['Android_value'] = $this->android_model->get(FALSE,$title);
       
       $this->load->view('index',$data);
    }
    public function select_android_category(){
       //theme_user_parent_category
    $this->load->view('index');    
   }
    public function insert_android_category() {
//        $id = (int) $this->input->get_post('id');
//        if ($id > 0) {
//            $data['Product_category'] = $this->android_model->get($id);
//        }
        $data['title'] = "android Category";
        $this->load->view('insert_android_category',$data);
    }
       public function insert_android_subcategory() {
        $id = (int) $this->input->get('id');
        $value='android';   
        $data['subcategory'] = $this->android_model->get($value);  
        $data['title']="android sub-Category";
        if(!empty($id)){
        $data['android_update'] = $this->android_model->get(FALSE,FALSE,$id);
        $data['id']= $id;
        }
        $data['id']= $id;
        $this->load->view('insert_android_category',$data);
    }

    public function save_android_category() {
        
        $this->form_validation->set_rules('android_category_name', ' Enter Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_android_category();
        } else {
            $data = array(
                'title' => $this->input->post('android_category_name'),
                'status' => $this->input->post('android_category_status'),
                
                'category' => 'android',
            );
            
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->android_model->insert($data);
        $this->session->set_flashdata('msg', " Android sub-Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('android', 'redirect');
        }
    }
    public function save_android_subcategory() {
        $id =$this->input->post('id');
        
        
        $this->form_validation->set_rules('android_category_name', 'Enter Category','required');
        $this->form_validation->set_rules('android_select', 'Select Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_android_subcategory();
        } else {
            $data = array(
                'name' => $this->input->post('android_category_name'),
                'status' => $this->input->post('android_category_status'),
               'parent_category' =>$this->input->post('android_select'),
            );
            
          
       if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                
               
                $this->android_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Android Category Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
                 } 
                else{
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->android_model->insert_subcategory($data);
        $this->session->set_flashdata('msg', " Android Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        
            }
        return redirect('android', 'redirect');
        }
    }

    public function android_category_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Android Category succesfilly Inactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Android Category succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->android_model->edit($id, $data);
        return redirect('android', 'redirect');
    }

    public function delete_android_category() {
        $id = (int) $this->input->get('id');
        $this->android_model->delete($id);
        $this->session->set_flashdata('msg', "Your Android Category succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('android', 'redirect');
    }

}
