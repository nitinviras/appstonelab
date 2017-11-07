<?php
include APPPATH . '/modules/views/header.php';
$cat = unserialize(MASTER_CATEGORY);
$active =array('checked' => TRUE);
$inactive = '';
if (isset($Browser) && !empty($Browser)) {
    $browser_category = isset($Browser->category) && $Browser->category != '' ? $Browser->category : '';
    $browser_name = isset($Browser->browser_name) && $Browser->browser_name != '' ? $Browser->browser_name : '';
    $browser_status = isset($Browser->status) && $Browser->status != '' ? $Browser->status : '';
} else {
    $browser_name = $this->input->post('browser_name');
    $browser_status = $this->input->post('browser_status');
    $browser_category = $this->input->post('category');
}
if (isset($browser_status) && $browser_status == 'I') {
    $inactive = array('checked' => TRUE);
    $active='';
} 
?>

<!--//////////////////////////////////////////////////////////////////////////////////-->


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Browser Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_browser', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($Browser->ID) && $Browser->ID != '' ? $Browser->ID : 0)); ?>
                        <div class="col-sm-6 b-r">
                            <div class="form-group">
                                <?php
                                $options[''] = 'Select Category';
                                if (isset($cat) && !empty($cat)) {
                                    foreach ($cat as $key=>$val) {
                                        $options[$key] = $val;
                                    }
                                }

                                echo form_dropdown('category', $options, $browser_category, 'class="form-control m-b"');
                                ?>
                                <span class="material-input"></span>
                                <?php echo form_error('category'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'browser_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'browser_name', 'class' => 'form-control', 'name' => 'browser_name', 'placeholder' => "Enter browser Name", 'value' => $browser_name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('browser_name'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'browser_status',
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
                                    'name' => 'browser_status',
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