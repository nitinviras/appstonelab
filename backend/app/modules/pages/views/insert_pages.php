<?php
include APPPATH . '/modules/views/header.php';
$active =array('checked' => TRUE);
$inactive = '';
if (isset($Pages) && !empty($Pages)) {
    $pages_name = isset($Pages->name) && $Pages->name != '' ? $Pages->name : '';
    $pages_status = isset($Pages->status) && $Pages->status != '' ? $Pages->status : '';
    $pages_slug = isset($Pages->slug) && $Pages->slug != '' ? $Pages->slug : '';
    $pages_description = isset($Pages->description) && $Pages->description != '' ? $Pages->description : '';
} else {
    $pages_name = $this->input->post('pages_name');
    $pages_status = $this->input->post('pages_status');
    $pages_slug = $this->input->post('pages_slug');
    $pages_description = $this->input->post('pages_description');
}
if (isset($pages_status) && $pages_status== 'I') {
    $inactive = array('checked' => TRUE);
    $active = '';
} 
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Pages Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_pages', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($Pages->ID) && $Pages->ID != '' ? $Pages->ID : 0)); ?>
                        <div class="col-sm-6 b-r">

                            <div class="form-group">
                                <?php echo form_label('', 'pages_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'pages_name', 'class' => 'form-control', 'name' => 'pages_name', 'placeholder' => "Enter pages Name", 'value' => $pages_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('pages_name'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_label('', 'pages_slug', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'pages_slug', 'class' => 'form-control', 'name' => 'pages_slug', 'placeholder' => "Enter pages slug", 'value' => $pages_slug)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('pages_slug'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'pages_description', array('class' => 'control-label')); ?>
                                <?php echo form_textarea(array('id' => 'pages_description', 'class' => 'form-control', 'name' => 'pages_description', 'placeholder' => "Enter pages description", 'value' => $pages_description)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('pages_description'); ?>
                            </div>

                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'pages_status',
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
                                    'name' => 'pages_status',
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