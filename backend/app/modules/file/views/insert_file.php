<?php
include APPPATH . '/modules/views/header.php';
$cat = unserialize(MASTER_CATEGORY);
$active = array('checked' => TRUE);
$inactive = '';
if (isset($File) && !empty($File)) {
    $file_category = isset($File->category) && $File->category != '' ? $File->category : '';
    $file_name = isset($File->file_name) && $File->file_name != '' ? $File->file_name : '';
    $file_status = isset($File->status) && $File->status != '' ? $File->status : '';
} else {
     $file_name = $this->input->post('file_name');
     $file_status = $this->input->post('file_status');
     $file_category = $this->input->post('category');
}
if (isset($file_status) && $file_status == 'I') {
    $inactive  = array('checked' => TRUE);
    $active="";
} 
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add File Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_file', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($File->ID) && $File->ID != '' ? $File->ID : 0)); ?>
                        <div class="col-sm-6 b-r">
                               <div class="form-group">

                                <?php
                                $options[''] = 'Select Category';
                                if (isset($cat) && !empty($cat)) {
                                    foreach ($cat as $key=>$val) {
                                        $options[$key] = $val;
                                    }
                                }

                                echo form_dropdown('category', $options, $file_category, 'class="form-control m-b"');
                                ?>
                                <span class="material-input"></span>
                                <?php echo form_error('category'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'file_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'file_name', 'class' => 'form-control', 'name' => 'file_name', 'placeholder' => "Enter file Name", 'value' => $file_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('file_name'); ?>
                            </div>

                            
                            

                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'file_status',
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
                                    'name' => 'file_status',
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