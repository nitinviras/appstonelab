<?php
include APPPATH . '/modules/views/header.php';
$active = array('checked' => TRUE);
$inactive = '';
if(isset($ios_update[0])&&!empty($ios_update[0])){
 $ios_category_name = isset($ios_update[0]->name) && $ios_update[0]->name!='' ? $ios_update[0]->name : '';
 $ios_category_status = isset($ios_update[0]->status) && $ios_update[0]->status!='' ? $ios_update[0]->status : '';
 $ios_category_title= isset($ios_update[0]->title) && $ios_update[0]->title!='' ? trim($ios_update[0]->title) : '';
 $ios_id = isset($ios_update[0]->parent_category)  ? $ios_update[0]->parent_category :0;
}else{
   $ios_category_name= $this->input->post('ios_category_name');
   $ios_category_status=$this->input->post('ios_category_status');
   $ios_category_title=$this->input->post('ios_select');
   $ios_id=$this->input->post('id');       
}
if (isset($ios_category_status) &&$ios_category_status == 'I') {
    $inactive  = array('checked' => TRUE);
    $active="";
} 

if(!empty($subcategory)){
     $formname='save_ios_subcategory';
     $title='Add Ios SubCategory Details';
 }else{
     $formname='save_ios_category';
     $title='Add Ios Category Details';
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
                                <?php echo form_label('','ios_category_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'ios_category_name', 'class' => 'form-control', 'name' => 'ios_category_name', 'placeholder' => "Enter Ios Name", 'value' =>$ios_category_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('ios_category_name'); ?>
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
                                echo form_dropdown('ios_select',$options,$ios_id,'class="form-control m-b"');
                                            ?>
                                <span class="material-input"></span>
                                <?php echo form_error('ios_select'); ?>
                             </div>
                             <?php }   ?>
                            

                            <div class="form-group">
                                <?php
                                 $active_radio = array(
                                    'name' => 'ios_category_status',
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
                                        'name' => 'ios_category_status',
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