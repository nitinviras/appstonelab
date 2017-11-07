<?php
include APPPATH . '/modules/views/header.php';
$active=array('checked' => TRUE);
$inactive = '';
if(isset($web_update[0])&&!empty($web_update[0])){
 $web_category_name = isset($web_update[0]->name) && $web_update[0]->name!='' ? $web_update[0]->name : '';
 $web_category_status = isset($web_update[0]->status) && $web_update[0]->status!='' ? $web_update[0]->status : '';
 $web_category_title= isset($web_update[0]->title) && $web_update[0]->title!='' ? trim($web_update[0]->title) : '';
 $web_id = isset($web_update[0]->parent_category)  ? $web_update[0]->parent_category :0;
}else{
   $web_category_name= $this->input->post('web_category_name');
   $web_category_status=$this->input->post('web_category_status');
   $web_category_title=$this->input->post('web_select');
   $web_id=$this->input->post('id');       
}
if (isset($web_category_status) &&$web_category_status == 'I') {
    $inactive = array('checked' => TRUE);
    $active="";
} 
if(!empty($subcategory)){
     $formname='save_web_subcategory';
     $title='Add Web SubCategory Details';
 }else{
     $formname='save_web_category';
     $title='Add Web Category Details';
 }
 
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $title ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open($formname,array('name' => 'status_form', 'id' => 'status_form')); ?>
                      <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($id) ? $id : 0)); ?>
                        <div class="col-sm-6 b-r">

                            <div class="form-group">
                                <?php echo form_label('','web_category_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'web_category_name', 'class' => 'form-control', 'name' => 'web_category_name', 'placeholder' => "Enter Web Name", 'value' =>$web_category_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('web_category_name'); ?>
                            </div>
                             <?php if(isset($subcategory) && !empty($subcategory)){ ?>
                             <div class="form-group">
                              <?php
                               $options[''] = 'Select Category';
                                if(isset($subcategory) && !empty($subcategory)){
                                    foreach ($subcategory as $row){
                                        $options[$row->ID] = $row->title;
                                    }
                                }
                                echo form_dropdown('web_select',$options,$web_id,'class="form-control m-b"');
                                            ?>
                                <span class="material-input"></span>
                                <?php echo form_error('web_select'); ?>
                             </div>
                             <?php }   ?>
                            

                            <div class="form-group">
                                <?php
                                 $active_radio = array(
                                    'name' => 'web_category_status',
                                    'id' => 'active',
                                    'value' => 'A',
                                    'checked' => TRUE
                                );
                                echo form_radio($active_radio, '', $active);
                                ?>
                                <label for="active" class="label-check radio-cover">
                                    <span class="radio primary"><span></span></span>
                                    Active
                                </label></td>
                                <?php
                                $inactive_radio = array(
                                        'name' => 'web_category_status',
                                        'id' => 'inactive',
                                        'value' => 'I',
                                    );
                                echo form_radio($inactive_radio, '', $inactive);
                                ?>  
                                <label for="inactive" class="label-check radio-cover">
                                    <span class="radio primary"><span></span></span>
                                    Deactive
                                </label>
                            </div>  
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-wd btn-lg">save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APPPATH . '/modules/views/footer.php';
?>