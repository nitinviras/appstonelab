<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons primary fixed-box">
            <h4>Change Password</h4>
            <button form="change_password_form" class="button mid-short primary">Save Changes</button>
        </div>
        <!-- /HEADLINE -->
        <?php $this->load->view('templates/message') ?>
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <?php
                        $attributes = array(
                            'class' => 'rl-label required'
                        );
                        ?>
                        <?php echo form_open_multipart('save_change_password', array('name' => 'change_password_form', 'id' => 'change_password_form')); ?>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Current Password', 'current_password', $attributes); ?>
                            <?php echo form_input(array('type' => 'password', 'id' => 'current_password', 'maxlength' => '18', 'name' => 'current_password', 'class' => 'lr_input', 'placeholder' => "Current Password")); ?>
                            <?php echo form_error('current_password'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('New Password', 'new_password', $attributes); ?>
                            <?php echo form_input(array('type' => 'password', 'id' => 'new_password', 'name' => 'new_password', 'maxlength' => '18', 'class' => 'lr_input', 'placeholder' => "New Password")); ?>
                            <?php echo form_error('new_password'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Conform Password', 'conform_password', $attributes); ?>
                            <?php echo form_input(array('type' => 'password', 'id' => 'conform_password', 'name' => 'conform_password', 'maxlength' => '18', 'class' => 'lr_input', 'placeholder' => "Conform Password")); ?>
                            <?php echo form_error('conform_password'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                    </div>
                    <!-- FORM BOX ITEM -->
                    <?php echo form_close(); ?>
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
<script>
                // Jquery Form, Validation
                    $(document).ready(function () {
                    $("#change_password_form").validate({
            rules: {
                current_password: {
                    required: true,
                    },                 new_password: {
                    required: true,
                    minlength: 6,
                maxlength: 15
            },
                conform_password: {
                    required: true,
                    minlength: 6,
                maxlength: 15,
                    equalTo: "#new_password"
                }

            },
                    messages: {
                current_password: {
                    required: "Please enter your current password",
                },
                new_password: {
                    required: "Please enter your new password",
                    minlength: "Please enter minimum 6 characters",
                    maxlength: "Please enter maximum 15 characters"},
                    conform_password: {
            required: "Please enter your conform password",
    minlength: "Please enter minimum 6 characters",
                    maxlength: "Please enter maximum 15 characters",
                    equalTo: "Conform password invalid"
                }
            }
        });
    });
</script>