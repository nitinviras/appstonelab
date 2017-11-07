<?php
$company_name = $this->input->post('company_name');
$name = $this->input->post('name');
$email = $this->input->post('email');
$mobile = $this->input->post('mobile');
$city = $this->input->post('city');
$address = $this->input->post('address');
$requirement = $this->input->post('requirement');
?>
<body>
    <div id="loadingmessage" class="loadingmessage"></div>
    <div class="login_wrapper">
        <div class="login_sidebar advertisement_content">
            <div class="form-popup advertisement_form">
                <!--FORM POPUP HEADLINE--> 
                <div class="text-center login_logo">
                    <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url("assets/images/logo.png") ?>" alt="logo img"></a>
                </div>
                <div class="form-popup-headline">
                    <h2>Banner Advertising</h2>
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
                    <?php echo form_open('save_advertisement', array('name' => 'advertisement', 'id' => 'advertisement_form')); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo form_label('Company Name:', 'title', $attributes); ?>
                            <?php echo form_input(array('id' => 'company_name', 'name' => 'company_name', 'class' => 'lr_input', 'value' => "$company_name", 'placeholder' => "Company Name")); ?>
                            <?php echo form_error('company_name'); ?>
                            <?php
                            echo form_label('Email:', 'email', $attributes);
                            ?>
                            <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'lr_input', 'value' => "$email", 'placeholder' => "Email")); ?>
                            <?php echo form_error('email'); ?>
                            <?php
                            echo form_label('City:', 'city', $attributes);
                            ?>
                            <?php echo form_input(array('id' => 'city', 'name' => 'city', 'class' => 'lr_input', 'value' => "$city", 'placeholder' => "City")); ?>
                            <?php echo form_error('city'); ?>

                        </div>
                        <div class="col-md-6">
                            <?php
                            echo form_label('Name:', 'name', $attributes);
                            ?>
                            <?php echo form_input(array('id' => 'name', 'name' => 'name', 'class' => 'lr_input', 'value' => "$name", 'placeholder' => "Name")); ?>
                            <?php echo form_error('name'); ?>
                            <?php
                            echo form_label('Mobile:', 'mobile', $attributes);
                            ?>
                            <?php echo form_input(array('id' => 'mobile', 'name' => 'mobile', 'class' => 'integer lr_input', 'value' => "$mobile", 'placeholder' => "Mobile")); ?>
                            <?php echo form_error('mobile'); ?>


                            <?php
                            echo form_label('Address:', 'address', array(
                                'class' => 'rl-label'
                            ));
                            ?>
                            <?php echo form_input(array('id' => 'address', 'name' => 'address', 'class' => 'lr_input', 'value' => "$address", 'placeholder' => "Address")); ?>
                            <?php echo form_error('address'); ?>


                        </div>
                        <div class="col-md-12">
                            <?php echo form_label('Requirement', 'requirement', $attributes); ?>
                            <?php echo form_textarea(array('class' => 'lr_input', 'id' => 'requirement', 'name' => 'requirement', 'placeholder' => "Requirement")); ?>
                            <?php echo form_error('requirement'); ?>

                            <button class="button mid dark mt-4">Submit <span class="primary">Feedback</span></button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

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
    <div class="login_content advertisement_content">
        <div class="c_advertisement_image">
            <img src="<?php echo base_url("assets/images/background/advertisement_background.jpg"); ?>" alt="feedback_bg img" class="h-100 w-100 mw-100"/>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#advertisement_form").validate({
                rules: {
                    company_name: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        digits: true,
                        required: true
                    },
                    city: {
                        required: true
                    },
                    requirement: {
                        required: true
                    }
                },
                messages: {
                    company_name: {
                        required: "Please enter company name"
                    },
                    name: {
                        required: "Please enter name"
                    },
                    email: {
                        required: "Please enter email"
                    },
                    mobile: {
                        required: "Please enter mobile"
                    },
                    city: {
                        required: "Please enter city"
                    },
                    requirement: {
                        required: "Please enter requirement"
                    }
                }

            });

        });
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
        $("#advertisement_form").submit(function () {
            if ($("#advertisement_form").valid()) {
                $('#loadingmessage').show();
            }
        });
    </script>
</body>
</html>