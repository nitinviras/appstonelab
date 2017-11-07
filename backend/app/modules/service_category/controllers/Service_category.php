<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_category extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('service_category_model');
    }

   public function index() {
      
       $data['Service_category'] = $this->service_category_model->get_service_category();
       $data['Service_value'] = $this->service_category_model->get(FALSE,1);
       $this->load->view('index',$data);
    }
    public function select_service_category(){
      
    $this->load->view('index');    
   }
    public function insert_service_category() {
      
        $data['title'] = "service Category";
        $this->load->view('insert_service_category',$data);
    }
       public function insert_service_subcategory() {
        $id = (int) $this->input->get('id');
        $data['subcategory'] = $this->service_category_model->get(1);
        
        $data['title']="service sub-Category";
        if(!empty($id)){
        $data['service_update'] = $this->service_category_model->get(FALSE,FALSE,$id);
        $data['id']= $id;
        }
        $data['id']= $id;
        $this->load->view('insert_service_category',$data);
    }

    public function save_service_category() {
        
        $this->form_validation->set_rules('service_category_name', 'Enter Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_service_category();
        } else {
            $data = array(
                'name' => $this->input->post('service_category_name'),
                'status' => $this->input->post('service_category_status'),
                
                
            );
            
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->service_category_model->insert($data);
        $this->session->set_flashdata('msg', " Service sub-Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('service_category', 'redirect');
        }
    }
    public function save_service_subcategory() {
        $id =$this->input->post('id');
        
        
        $this->form_validation->set_rules('service_category_name', 'Enter Category','required');
        $this->form_validation->set_rules('service_select', 'Select Category','required');
        $this->form_validation->set_message('required', 'Please  %s');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert_service_subcategory();
        } else {
            $data = array(
                'name' => $this->input->post('service_category_name'),
                'status' => $this->input->post('service_category_status'),
               'category' =>$this->input->post('service_select'),
            );
            
          
       if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                
               
                $this->service_category_model->edit($id, $data);
                $this->session->set_flashdata('msg', "Service Category Edit SuccessFully.");
                $this->session->set_flashdata('msg_class', 'success');
                 } 
                else{
        $data['created_on'] = date("Y-m-d H:i:s");
        $this->service_category_model->insert_subcategory($data);
        $this->session->set_flashdata('msg', " Service Category Inserting SuccessFully.");
        $this->session->set_flashdata('msg_class', 'success');
        
            }
        return redirect('service_category', 'redirect');
        }
    }

    public function service_category_status() {
        $id = (int) $this->input->get('id');
        $status = $this->input->get('status');
        if (isset($status) && $status == 'A') {
            $data = array(
                'status' => 'I',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Service Category succesfilly Inactive.");
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            $data = array(
                'status' => 'A',
                'updated_on' => date("Y-m-d H:i:s")
            );
            $this->session->set_flashdata('msg', "Your Service Category succesfilly Active.");
            $this->session->set_flashdata('msg_class', 'success');
        }
        $this->service_category_model->edit($id, $data);
        return redirect('service_category', 'redirect');
    }

    public function delete_service_category() {
        $id = (int) $this->input->get('id');
        $this->service_category_model->delete($id);
        $this->session->set_flashdata('msg', "Your Service Category succesfilly Deleted.");
        $this->session->set_flashdata('msg_class', 'success');
        return redirect('service_category', 'redirect');
    }

}
