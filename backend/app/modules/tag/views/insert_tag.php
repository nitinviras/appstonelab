
<?php
include  APPPATH . '/modules/views/header.php';
$active =array('checked' => TRUE);
$inactive = '';
if (isset($Tags) && !empty($Tags)) {
    $tag_name = isset($Tags->name) && $Tags->name != '' ? $Tags->name : '';
    $tag_status = isset($Tags->status) && $Tags->status != '' ? $Tags->status : '';
} else {
    $tag_name = $this->input->post('tag_name');
    $tag_status = $this->input->post('tag_status');
}
if (isset($tag_status) && $tag_status == 'I') {
   $inactive = array('checked' => TRUE);
   $active="";
} 
?>






<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Tag Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_tag', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($Tag->ID) && $Tag->ID != '' ? $Tag->ID : 0)); ?>
                        <div class="col-sm-6 b-r">

                            <div class="form-group">
                                <?php echo form_label('', 'tag_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'tag_name', 'class' => 'form-control', 'name' => 'tag_name', 'placeholder' => "Enter tag Name", 'value' => $tag_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('tag_name'); ?>
                            </div>

                            
                            

                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'tag_status',
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
                                    'name' => 'tag_status',
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