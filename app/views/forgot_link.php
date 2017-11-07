<?php
$get_id = $this->input->get('token');
$dec_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $get_id);
$id = (int) $this->encryption->decrypt($dec_id);
?>
<body>
    <div id="loadingmessage" class="loadingmessage"></div>
    <div class="login_wrapper">
        <div class="login_sidebar">
            <div class="form-popup">


                <!--FORM POPUP HEADLINE--> 
                <div class="text-center login_logo">
                    <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url("assets/images/logo.png") ?>" alt="logo img"></a>
                </div>
                <div class="form-popup-headline">
                    <h2 >Reset your Password</h2>
                </div>
                <!--/FORM POPUP HEADLINE--> 
                <!--FORM POPUP CONTENT--> 
                <div class="form-popup-content">
                    <?php $this->load->view('templates/message') ?>
                    <?php
                    $attributes = array(
                        'class' => 'rl-label required'
                    );
                    ?>
                    <?php echo form_open('forgot_password_save', array('name' => 'forgot', 'id' => 'forgot_link_form')); ?>
                    <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'class' => 'lr_input', 'id' => 'id', 'value' => $id)); ?>
                    <?php echo form_label('Reset Code', 'code', $attributes); ?>
                    <?php echo form_error('code'); ?>
                    <?php echo form_input(array('type' => 'text', 'id' => 'code', 'class' => 'lr_input integer', 'maxlength' => "6", 'name' => 'code', 'placeholder' => 'Enter your reset code here...')); ?>
                    <?php echo form_label('New Password', 'password', $attributes); ?>
                    <?php echo form_error('password'); ?>
                    <?php echo form_input(array('type' => 'password', 'id' => 'password', 'class' => 'lr_input', 'name' => 'password', 'placeholder' => 'Enter your password here...')); ?>
                    <?php echo form_label('Repeat Password', 'repeat_password', $attributes); ?>
                    <?php echo form_error('repeat_password'); ?>
                    <?php echo form_input(array('type' => 'password', 'id' => 'repeat_password', 'class' => 'lr_input', 'name' => 'repeat_password', 'placeholder' => 'Repeat your password here...')); ?>

                    <button class="button mid dark no-space">Save your <span class="primary">Password</span></button>
                    <?php echo form_close(); ?>
                    <p class="retuen_login"><a href="<?php echo base_url('login.jsf') ?>">Return to login</a></p>
                    <!--LINE SEPARATOR--> 
                    <hr class="line-separator double">

                    <p class="login_footer"> &copy;<?php echo date("Y") ?> <span>All Rights Reserved. Themeshub is a registered trademark of Megh Infotech.</span>
                        <span class="nowrap link-underline"> 
                            <a class="textcolor" href="<?php echo base_url('privacy-policy.jsf'); ?>">Privacy</a> and 
                            <a class="textcolor" href="<?php echo base_url('terms-and-conditions.jsf'); ?>">Terms</a>
                        </span> 
                    </p>
                    <!--/LINE SEPARATOR--> 
                </div>
                <!--/FORM POPUP CONTENT--> 

            </div>
        </div>
    </div>
    <div class="login_content">
        <div class="c-billboard__image_forgot">
            <img src="<?php echo base_url("assets/images/background/forgot_background.jpg"); ?>" alt="forgot_link img" class="h-100 w-100 mw-100"/>
        </div>
    </div>
    <script>
        // Only Enter Number Check
        $(".integer").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode == 67 && e.ctrlKey === true) ||
                    (e.keyCode == 88 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $(document).ready(function () {

            $("#forgot_link_form").validate({
                rules: {
                    code: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 15
                    },
                    repeat_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    code: {
                        required: "Code is required.",
                        minlength: "Please enter minimum 6 characters",
                        maxlength: "Please enter maximum 6 characters"
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Please enter minimum 6 characters",
                        maxlength: "Please enter maximum 6 characters"
                    },
                    repeat_password: {
                        required: "Please Enter Repeat Password",
                        equalTo: "Password and confirm password must be same."
                    }
                }

            });

        });
        $("#forgot_link_form").submit(function () {
            if ($("#forgot_link_form").valid()) {
                $('#loadingmessage').show();
            }
        });
    </script>
</body>
</html>