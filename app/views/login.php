<?php
$username = $this->input->post('username');
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
                    <h2>Log In</h2>
                    <p><span>Need a Themeshub account? </span>
                        <a href="<?php echo base_url('register.jsf'); ?>"> Create an account </a>
                    </p>
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
                    <?php echo form_open('save_login', array('name' => 'login', 'id' => 'login_form')); ?>
                    <?php echo form_label('Username / Email', 'username', $attributes); ?>
                    <?php echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'integer lr_input', 'value' => "$username", 'placeholder' => "Username / Email here...")); ?>
                    <?php echo form_error('username'); ?>
                    <?php echo form_label('Password', 'password', $attributes); ?>
                    <?php echo form_input(array('type' => 'password', 'id' => 'password', 'name' => 'password', 'class' => 'lr_input', 'placeholder' => 'Password here...')); ?>
                    <?php echo form_error('password'); ?>
                    <button class="button mid dark">Login <span class="primary">Now!</span></button>
                    <!--CHECKBOX--> 
                    <?php
                    $data = array(
                        'name' => 'remember',
                        'id' => 'remember',
                        'checked' => TRUE,
                    );
                    echo form_checkbox($data);
                    ?>
                    <label for="remember" class="label-check"></label>
                    <!--/CHECKBOX--> 
                    <p class="account_link pull-right"><span></span> <a href="<?php echo base_url('forgot_password.jsf') ?>" class="primary">Forgot Password? </a></p>
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
        <div class="c-billboard__image">
            <img src="<?php echo base_url("assets/images/background/login_background.jpg"); ?>" alt="login_bg img" class="h-100 w-100 mw-100"/>
<!--<img src="../../assets/images/background/login_background.jpg" alt=""/>-->
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#login_form").validate({
                rules: {
                    username: {
                        required: true,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        maxlength: 15
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username or email"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                }

            });
            $("#login_form").submit(function () {
                if ($("#login_form").valid()) {
                    $('#loadingmessage').show();
                }
            });

        });
    </script>
</body>
</html>