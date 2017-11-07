<?php
include APPPATH . '/modules/views/header.php';
$active = array('checked' => TRUE);
$inactive = '';


 if(isset($android_update[0])&&!empty($android_update[0])){
 $android_category_name = isset($android_update[0]->name) && $android_update[0]->name!='' ? $android_update[0]->name : '';
 $android_category_status = isset($android_update[0]->status) && $android_update[0]->status!='' ? $android_update[0]->status : '';
 $android_category_title= isset($android_update[0]->title) && $android_update[0]->title!='' ? trim($android_update[0]->title) : '';
 $android_id = isset($android_update[0]->parent_category)  ? $android_update[0]->parent_category :0;
}else{
   $android_category_name= $this->input->post('android_category_name');
   $android_category_status=$this->input->post('android_category_status');
   $android_category_title=$this->input->post('android_select');
   $android_id=$this->input->post('id');       
}
if (isset($android_category_status) &&$android_category_status == 'I') {
    $inactive = array('checked' => TRUE);
    $active="";
}


if(!empty($subcategory)){
     $formname='save_android_subcategory';
     $title='Add Android SubCategory Details';
 }else{
     $formname='save_android_category';
     $title='Add Android Category Details';
 }
  
?>

<!--//////////////////////////////////////////////////////////////-->

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
                                <?php echo form_label('','android_category_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'android_category_name', 'class' => 'form-control', 'name' => 'android_category_name', 'placeholder' => "Enter Android Name", 'value' =>$android_category_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('android_category_name'); ?>
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
                                
                                echo form_dropdown('android_select',$options, $android_id,'class="form-control m-b"');
                                            ?>
                                <span class="material-input"></span>
                                <?php echo form_error('android_select'); ?>
                             </div>
                              
                             <?php }   ?>
                            

                            <div class="form-group">
                                <?php
                                 $active_radio = array(
                                    'name' => 'android_category_status',
                                    'id' => 'active',
                                    'value' => 'A',
                                  
                                );
                                echo form_radio($active_radio, '',$active);
                                ?>
                                <label for="active" class="label-check radio-cover">
                                    <span class="radio primary"><span></span></span>
                                    Active
                                </label></td>
                                <?php
                                $inactive_radio = array(
                                        'name' => 'android_category_status',
                                        'id' => 'inactive',
                                        'value' => 'I',
                                    );
                                echo form_radio($inactive_radio,'',$inactive);
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