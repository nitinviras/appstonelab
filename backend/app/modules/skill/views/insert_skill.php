<?php
include APPPATH . '/modules/views/header.php';
$cat = unserialize(MASTER_CATEGORY);
$active = array('checked' => TRUE);
$inactive = '';
if (isset($Skills) && !empty($Skills)) {
    $skill_name = isset($Skills->name) && $Skills->name != '' ? $Skills->name : '';
    $skill_status = isset($Skills->status) && $Skills->status != '' ? $Skills->status : '';
    $skill_category = isset($Skills->category) && $Skills->category != '' ? $Skills->category : '';
} else {
    $skill_name = $this->input->post('skill_name');
    $skill_status = $this->input->post('skill_status');
    $skill_category = $this->input->post('category');
}
if (isset($skill_status) && $skill_status == 'I') {
    $inactive = array('checked' => TRUE);
    $active = '';
} 
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Skill</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php echo form_open('save_skill', array('name' => 'status_form', 'id' => 'status_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($Skills->ID) && $Skills->ID != '' ? $Skills->ID : 0)); ?>
                        <div class="col-sm-6 b-r">
                            <div class="form-group">

                                <?php
                                $options[''] = 'Select Category';
                                if (isset($cat) && !empty($cat)) {
                                    foreach ($cat as $key => $val) {
                                        $options[$key] = $val;
                                    }
                                }

                                echo form_dropdown('category', $options, $skill_category, 'class="form-control m-b"');
                                ?>
                                <?php echo form_error('category'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'skill_name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'skill_name', 'class' => 'form-control', 'name' => 'skill_name', 'placeholder' => "Enter Skill Name", 'value' => $skill_name)); ?>

                                <?php echo form_error('skill_name'); ?>
                            </div>

                            <div class="form-group">
                                <?php
                                $active_radio = array(
                                    'name' => 'skill_status',
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
                                <td><?php
                                $inactive_radio = array(
                                    'name' => 'skill_status',
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