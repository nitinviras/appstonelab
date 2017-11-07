<?php
$feedback_title = $this->input->post('title');
$feedback_email = $this->input->post('email');
$feedback_phone = $this->input->post('phone');
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
                <div class="form-popup-headline pb-0">
                    <h2 >Feedback</h2>
                    <p>Please use the form below to send us your comments and feedback. We appreciate you taking the
                        time to provide us with your views so that we can best meet the needs of users.
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
                    <?php echo form_open('save_feedback', array('name' => 'feedback', 'id' => 'feedback_form')); ?>
                    <?php echo form_label('Feedback Title:', 'title', $attributes); ?>
                    <?php echo form_input(array('id' => 'title', 'name' => 'title', 'class' => 'lr_input', 'value' => "$feedback_title", 'placeholder' => "Feedback title")); ?>
                    <?php echo form_error('title'); ?>
                    <?php
                    echo form_label('Email:', 'email', $attributes);
                    ?>
                    <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'lr_input', 'value' => "$feedback_email", 'placeholder' => "Email")); ?>
                    <?php echo form_error('email'); ?>
                    <?php
                    echo form_label('Phone no:', 'phone', array(
                        'class' => 'rl-label'
                    ));
                    ?>
                    <?php echo form_input(array('id' => 'phone', 'name' => 'phone', 'class' => 'integer lr_input', 'value' => "$feedback_phone", 'placeholder' => "Phone no")); ?>
                    <?php echo form_error('phone'); ?>
                    <?php echo form_label('Feedback Description', 'description', $attributes); ?>
                    <?php echo form_textarea(array('rows' => "13", 'id' => 'description', 'name' => 'description', 'class' => ' lr_input', 'placeholder' => "Feedback Description")); ?>
                    <?php echo form_error('description'); ?>
                    <button class="button mid dark">Submit <span class="primary">Feedback</span></button>
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
            <img src="<?php echo base_url("assets/images/background/feedback.png"); ?>" alt="Feedback" class="h-100 w-100 mw-100 img-responsive"/>
        </div>
    </div>
    <script src="<?php echo base_url() . js_path ?>/module/login.js" type="text/javascript"></script>
    <script>
        $("#feedback_form").submit(function () {
            if ($("#feedback_form").valid()) {
                $('#loadingmessage').show();
            }
        });
    </script>
</body>
</html>