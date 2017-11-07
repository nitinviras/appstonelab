<?php
$username = $this->input->post('username');
$mobile_no = $this->input->post('mobile_no');
$email_address = $this->input->post('email_address');
?>
<body>
    <div class="loadingmessage" id="loadingmessage"></div>
    <div class="login_wrapper">
        <div class="login_sidebar">
            <div class="form-popup">
                <!--FORM POPUP HEADLINE--> 
                <div class="text-center login_logo">
                    <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url("assets/images/logo.png") ?>" alt="logo img"></a>
                </div>
                <div class="form-popup-headline">
                    <h2>Register Now</h2>
                    <p>Register now to make your presence!</p>
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
                    <?php echo form_open('save_register', array('name' => 'register', 'id' => 'register_form')); ?>
                    <?php echo form_label('Username', 'username', $attributes); ?>
                    <?php echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'lr_input', 'value' => "$username", 'placeholder' => "Enter your username here...")); ?>
                    <?php echo form_error('username'); ?>
                    <?php echo form_label('Email', 'email_address', $attributes); ?>
                    <?php echo form_input(array('type' => 'email', 'id' => 'email_address', 'name' => 'email_address', 'class' => 'lr_input', 'value' => "$email_address", 'placeholder' => "Enter your email here...")); ?>
                    <?php echo form_error('email_address'); ?>
                    <?php echo form_label('Password', 'password', $attributes); ?>
                    <?php echo form_input(array('type' => 'password', 'id' => 'password', 'name' => 'password', 'class' => 'lr_input', 'placeholder' => 'Enter your password here...')); ?>
                    <?php echo form_error('password'); ?>
                    <button type="submit" class="button mid dark mt-4">Register <span class="primary">Now!</span></button>

                    <br/><p class="create_account">Already Created Account? <a href="<?php echo base_url('login.jsf') ?>" class="primary">Click here!</a></p><br/>
                    <?php echo form_close(); ?>
                    <!--LINE SEPARATOR--> 
                    <hr class="line-separator double my-0">
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
        <div class="c-billboard__image_register">
            <img src="<?php echo base_url("assets/images/background/register_background.jpg"); ?>" alt="register_bg img" class="h-100 w-100 mw-100"/>
        </div>
    </div>
    <script src="<?php echo base_url() . js_path ?>/module/login.js" type="text/javascript"></script>
    <script>
        $("#register_form").submit(function () {
            if ($("#register_form").valid()) {
                $('#loadingmessage').show();
            }
        });
    </script>
</body>
</html>