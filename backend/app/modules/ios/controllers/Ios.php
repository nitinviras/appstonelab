<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ios extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ios_model');
    }

   public function index() {
       $title='ios';
       $data['Ios_category'] = $this->ios_model->get_ios_category();
       $data['Ios_value'] = $this->ios_model->get(FALSE,$title);
       $this->load->view('index',$data);
    }
    public function select_ios_category(){
       //theme_user_parent_category
    $this->load->view('index');    
   }
    public function insert_ios_category() {
//        $id = (int) $this->input->get_post('id');
//        if ($id > 0) {
//            $data['Product_category'] = $this->ios_model->get($id);
//        }
        $data['title'] = "ios Category";
        $this->load->view('insert_ios_category',$data);
    }
       public function insert_ios_subcategory() {
        $id = (int) $this->input->get('id');
        $value='ios';   
        $data['subcategory'] = $this->ios_model->get($value);  
        $data['title']="ios sub-Category";
        if(!empty($id)){
        $data['ios_update'] = $this->ios_model->get(FALSE,FALSE,$id);
        $data['id']= $id;
        }
        $data['id']= $id;
        $this->load->view('insert_ios_category',$data);
    }

    public function save_ios_category() {
        
        $this->form_validation->set_rules('ios_category_name', ' Enter Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_ios_category();
        } else {
            $data = array(
                'title' => $this->input->post('ios_category_name'),
                'status' => $this->input->post('ios_category_status'),
                
                'category' => 'ios',
            );
            
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->ios_model->insert($data);
        $this->session->set_flashdata('msg', " Ios sub-Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('ios', 'redirect');
        }
    }
    public function save_ios_subcategory() {
        $id =$this->input->post('id');
        
        
        $this->form_validation->set_rules('ios_category_name', 'Enter Category','required');
        $this->form_validation->set_rules('ios_select', 'Select Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_ios_subcategory();
        } else {
            $data = array(
                'name' => $this->input->post('ios_category_name'),
                'status' => $this->input->post('ios_category_status'),
               'parent_category' =>$this->input->post('ios_select'),
            );
            
          
       if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                
               
                $this->ios_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Ios Category Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
                 } 
                else{
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->ios_model->insert_subcategory($data);
        $this->session->set_flashdata('msg', " Ios Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        
            }
        return redirect('ios', 'redirect');
        }
    }

    public function ios_category_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Ios Category succesfilly Inactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Ios Category succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->ios_model->edit($id, $data);
        return redirect('ios', 'redirect');
    }

    public function delete_ios_category() {
        $id = (int) $this->input->get('id');
        $this->ios_model->delete($id);
        $this->session->set_flashdata('msg', "Your Ios Category succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('ios', 'redirect');
    }

}
