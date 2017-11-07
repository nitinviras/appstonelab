<?php
$email_address = $this->input->post('email_address');
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
                    <h2>Restore your Password</h2>
                    <p>Enter your email to get reset password link.</p>
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
                    <?php echo form_open('check_email', array('name' => 'forgot', 'id' => 'forgot_form')); ?>
                    <?php echo form_label('Email', 'email_address', $attributes); ?>
                    <?php echo form_input(array('id' => 'email_address', 'name' => 'email_address', 'class' => 'lr_input', 'value' => "$email_address", 'placeholder' => "Enter your email here...")); ?>
                    <?php echo form_error('email_address'); ?>
                    <!--CHECKBOX-->
                    <?php
                    $data = array(
                        'name' => 'remember',
                        'id' => 'remember',
                        'checked' => TRUE,
                    );
                    echo form_checkbox($data);
                    ?>
                    <!--/CHECKBOX--> 
                    <button class="button mid dark no-space mt-4">Restore your <span class="primary">Password</span></button>
                    <p class="retuen_login"><a href="<?php echo base_url('login.jsf') ?>">Return to login</a></p>
                    <?php echo form_close(); ?>
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

    <!-- /SECTION -->
    <script>
        $(document).ready(function () {

            $("#forgot_form").validate({
                rules: {
                    email_address: {
                        required: true,
                        email: true,
                    }
                },
                messages: {
                    email_address: {
                        required: "Please enter email",
                        email: "Please enter valid email"
                    }
                }

            });
            $("#forgot_form").submit(function () {
                if ($("#forgot_form").valid()) {
                    $('#loadingmessage').show();
                }
            });
        });
    </script>
</body>
</html>