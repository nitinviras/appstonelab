<?php
include APPPATH . '/modules/views/header.php';
$active =array('checked' => TRUE);
$inactive = '';
if (isset($Faq) && !empty($Faq)) {
    $faq_name = isset($Faq->title) && $Faq->title != '' ? $Faq->title : '';
    $faq_status = isset($Faq->status) && $Faq->status != '' ? $Faq->status : '';
    $faq_description = isset($Faq->description) && $Faq->description != '' ? $Faq->description : '';
} else {
    $faq_name = $this->input->post('faq_name');
    $faq_status = $this->input->post('faq_status');
    $faq_slug = $this->input->post('faq_slug');
    $faq_description = $this->input->post('faq_description');
}
if (isset($faq_status) && $faq_status == 'I') {
    $inactive  = array('checked' => TRUE);
    $active="";
} 
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Faq Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_faq', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($Faq->ID) && $Faq->ID != '' ? $Faq->ID : 0)); ?>
                        <div class="col-sm-6 b-r">

                            <div class="form-group">
                                <?php echo form_label('', 'faq_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'faq_name', 'class' => 'form-control', 'name' => 'faq_name', 'placeholder' => "Enter faq Name", 'value' => $faq_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('faq_name'); ?>
                            </div>

                            
                            <div class="form-group">
                                <?php echo form_label('', 'faq_description', array('class' => 'control-label')); ?>
                                <?php echo form_textarea(array('id' => 'faq_description', 'class' => 'form-control', 'name' => 'faq_description', 'placeholder' => "Enter faq description", 'value' => $faq_description)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('faq_description'); ?>
                            </div>

                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'faq_status',
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
                                    'name' => 'faq_status',
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