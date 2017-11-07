<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('web_model');
    }

   public function index() {
       $title='web';
       $data['Web_category'] = $this->web_model->get_web_category();
       $data['Web_value'] = $this->web_model->get(FALSE,$title);
       $this->load->view('index',$data);
    }
    public function select_web_category(){
       //theme_user_parent_category
    $this->load->view('index');    
   }
    public function insert_web_category() {
//        $id = (int) $this->input->get_post('id');
//        if ($id > 0) {
//            $data['Product_category'] = $this->web_model->get($id);
//        }
        $data['title'] = "web Category";
        $this->load->view('insert_web_category',$data);
    }
       public function insert_web_subcategory() {
        $id = (int) $this->input->get('id');
        $value='web';   
        $data['subcategory'] = $this->web_model->get($value);  
        $data['title']="web sub-Category";
        if(!empty($id)){
        $data['web_update'] = $this->web_model->get(FALSE,FALSE,$id);
        $data['id']= $id;
        }
        $data['id']= $id;
        $this->load->view('insert_web_category',$data);
    }

    public function save_web_category() {
        
        $this->form_validation->set_rules('web_category_name', 'Enter Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_web_category();
        } else {
            $data = array(
                'title' => $this->input->post('web_category_name'),
                'status' => $this->input->post('web_category_status'),
                
                'category' => 'web',
            );
            
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->web_model->insert($data);
        $this->session->set_flashdata('msg', " Web sub-Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('web', 'redirect');
        }
    }
    public function save_web_subcategory() {
        $id =$this->input->post('id');
        
        
        $this->form_validation->set_rules('web_category_name', 'Enter Category','required');
        $this->form_validation->set_rules('web_select', 'Select Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_web_subcategory();
        } else {
            $data = array(
                'name' => $this->input->post('web_category_name'),
                'status' => $this->input->post('web_category_status'),
               'parent_category' =>$this->input->post('web_select'),
            );
            
          
       if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                
               
                $this->web_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Web Category Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
                 } 
                else{
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->web_model->insert_subcategory($data);
        $this->session->set_flashdata('msg', " Web Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        
            }
        return redirect('web', 'redirect');
        }
    }

    public function web_category_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Web Category succesfilly Inactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Web Category succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->web_model->edit($id, $data);
        return redirect('web', 'redirect');
    }

    public function delete_web_category() {
        $id = (int) $this->input->get('id');
        $this->web_model->delete($id);
        $this->session->set_flashdata('msg', "Your Web Category succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('web', 'redirect');
    }

}
