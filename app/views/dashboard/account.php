<!--database to fetch data-->
<?php
$id = $profile_image = '';
$username = $this->session->userdata('username');
$user_name = isset($user->user_login) ? $user->user_login : '';
$email_address = isset($user->user_email) ? $user->user_email : '';
if (count($user1) > 0 && !empty($user1)) {
    $id = isset($user1->ID) ? $user1->ID : 0;
    $profile_image = isset($user1->profile_photo) ? $user1->profile_photo : '';
    $first_name1 = isset($user1->first_name) ? $user1->first_name : '';
    $last_name1 = isset($user1->last_name) ? $user1->last_name : '';
    $ddate = isset($user1->date_of_birth) ? $user1->date_of_birth : '';
    $date = date("m/d/Y", strtotime($ddate));
    $mobile_no = isset($user1->mobile_no) ? $user1->mobile_no : '';
    $mobile_no2 = isset($user1->alternate_mobile_no) ? $user1->alternate_mobile_no : '';
    $website_url = isset($user1->personal_website) ? $user1->personal_website : '';
    $company_name1 = isset($user1->company_name) ? $user1->company_name : '';
    $company_no = isset($user1->company_no) ? $user1->company_no : '';
    $address1 = isset($user1->address_one) ? $user1->address_one : '';
    $address3 = isset($user1->address_two) ? $user1->address_two : '';
    $zipcode1 = isset($user1->zipcode) ? $user1->zipcode : '';
    $city1 = isset($user1->city) ? $user1->city : '';
    $state1 = isset($user1->state) ? $user1->state : '';
    $country1 = isset($user1->country) ? $user1->country : '';
    $social_fb_link = isset($user2->fb_link) ? $user2->fb_link : '';
    $social_twt_link = isset($user2->twt_link) ? $user2->twt_link : '';
    $social_gplus_link = isset($user2->gplus_link) ? $user2->gplus_link : '';
    $statename1 = isset($user1->sname) ? $user1->sname : '';
    $stateid1 = isset($user1->sid) ? $user1->sid : '';
    $cityname1 = isset($user1->cityname) ? $user1->cityname : '';
    $cityid1 = isset($user1->cityid) ? $user1->cityid : '';
} else {
    $first_name1 = $this->input->post('first_name1');
    $last_name1 = $this->input->post('last_name1');
    $date = $this->input->post('date');
    $mobile_no = $this->input->post('mobile_no');
    $mobile_no2 = $this->input->post('mobile_no2');
    $website_url = $this->input->post('website_url');
    $company_name1 = $this->input->post('company_name1');
    $company_no = $this->input->post('company_no');
    $address1 = $this->input->post('address1');
    $address3 = $this->input->post('address3');
    $zipcode1 = $this->input->post('zipcode1');
    $city1 = $this->input->post('city1');
    $state1 = $this->input->post('state1');
    $country1 = $this->input->post('country1');
    $social_fb_link = $this->input->post('social_fb_link');
    $social_twt_link = $this->input->post('social_twt_link');
    $social_gplus_link = $this->input->post('social_gplus_link');
}
$options[''] = "Select Country";
if (isset($country_res) && !empty($country_res)) {
    foreach ($country_res as $row) {
        $options[$row->id] = $row->name;
    }
}
if (isset($state_res) && $state_res != '' && !empty($state_res)) {
    foreach ($state_res as $row) {
        $state_options[$row->id] = $row->name;
    }
} else {
    $state_options[''] = 'Select Country First';
}
if (isset($city_res) && $city_res != '' && !empty($city_res)) {
    foreach ($city_res as $row) {
        $city_options[$row->id] = $row->name;
    }
} else {
    $city_options[''] = 'Select State First';
}
?>
<!--End fetch data-->
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons primary fixed-box">
            <h4>Account Settings</h4>
            <button form="profile_info_form" class="button mid-short primary">Save Changes</button>
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
                        <h4>Profile Information</h4>
                        <hr class="line-separator">
                        <!-- PROFILE IMAGE UPLOAD -->
                        <div class="profile-image">
                            <div class="profile-image-data">
                                <figure class="user-avatar medium">
                                    <?php
                                    $user_id = $this->session->userdata('user_id');
                                    $details_user_fol_nm = sha1("profile_" . $user_id);
                                    $profile_image_details = isset($user1->profile_photo) ? trim($user1->profile_photo) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                    } else {
                                        $profile_image_url_details = base_url() . img_path . "/user.png";
                                    }
                                    ?>
                                    <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                </figure>
                                <p class="text-header">Profile Photo</p>
                                <p class="upload-details">Minimum size 80x80px</p>
                            </div>
                            <a href="javascript:void(0)" class="button mid-short dark-light profile_upload_image" id="OpenImgUpload">Upload Image...</a>
                            <?php echo form_error('profile'); ?>
                        </div>
                        <!-- PROFILE IMAGE UPLOAD -->
                        <?php
                        $attributes = array(
                            'class' => 'rl-label required'
                        );
                        $attri = array(
                            'class' => 'rl-label'
                        );
                        ?>
                        <?php echo form_open_multipart('save_profile', array('name' => 'profile_info_form', 'id' => 'profile_info_form')); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id)); ?>
                        <?php echo form_input(array('type' => 'hidden', 'name' => 'profile_image', 'id' => 'profile_image', 'value' => $profile_image)); ?>
                        <?php echo form_input(array('type' => 'file', 'id' => 'profile', 'name' => 'profile', 'class' => 'form-control lr_input', 'value' => "", 'display' => 'none')); ?>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('User Name', 'username', $attri); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'username', 'name' => 'username', 'readonly' => '', 'class' => 'readonly lr_input', 'value' => "$user_name", 'placeholder' => "User Name")); ?>
                            <?php echo form_error('username'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Email', 'email_address', $attri); ?>
                            <?php echo form_input(array('require' => '', 'type' => 'email', 'id' => 'email_address', 'name' => 'email_address', 'readonly' => '', 'class' => 'readonly lr_input', 'value' => "$email_address", 'placeholder' => "Email Address")); ?>
                            <?php echo form_error('email_address'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('First Name', 'first_name1', $attributes); ?>
                                    <?php echo form_input(array('require' => '' ,'id' => 'first_name1', 'name' => 'first_name1', 'class' => 'lr_input', 'value' => "$first_name1", 'placeholder' => "First Name")); ?>
                                    <?php echo form_error('first_name1'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Last Name', 'last_name1', $attributes); ?>
                                    <?php echo form_input(array('require' => '', 'id' => 'last_name1', 'name' => 'last_name1', 'class' => 'lr_input', 'value' => "$last_name1", 'placeholder' => "Last Name")); ?>
                                    <?php echo form_error('last_name1'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="datepicker-wrap input-container half">
                                    <?php echo form_label('Date of Birth', 'date', $attributes); ?>
                                    <?php echo form_input(array('require' => '', 'id' => 'date', 'name' => 'date', 'class' => "datepicker lr_input", 'value' => "$date", 'placeholder' => "mm/dd/yyyy")); ?>
                                    <?php echo form_error('date'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Gender:', '', $attributes); ?>
                                    <?php
                                    $male_radio = array(
                                        'name' => 'gender',
                                        'value' => 'Male',
                                    );
                                    $male = $Female = $gender = '';
                                    if ($gender == 'M') {
                                        $male = array('checked' => TRUE);
                                    } else {
                                        $Female = array('checked' => TRUE);
                                    }
                                    $female_radio = array(
                                        'name' => 'gender',
                                        'value' => 'Female',
                                    );
                                    ?>
                                    <?php
                                    $male_radio = array(
                                        'name' => 'gender',
                                        'id' => 'male',
                                        'value' => 'Male',
                                        'checked' => TRUE,
                                    );
                                    echo form_radio($male_radio);
                                    ?>
                                    <label for="male" class="label-check radio-cover">
                                        <span class="radio primary"><span></span></span>
                                        Male
                                    </label>
                                    <?php
                                    $female_radio = array(
                                        'name' => 'gender',
                                        'id' => 'female',
                                        'value' => 'Female'
                                    );
                                    echo form_radio($female_radio);
                                    ?>
                                    <label for="female" class="label-check radio-cover">
                                        <span class="radio primary"><span></span></span>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Website', 'website_url', $attri); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'website_url', 'name' => 'website_url', 'onblur' => "checkURL(this)", 'class' => 'lr_input', 'value' => "$website_url", 'placeholder' => "Website")); ?>
                            <?php echo form_error('website_url'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Mobile Number', 'mobile_no', $attributes); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'mobile_no', 'name' => 'mobile_no', 'maxlength' => '13', 'class' => 'integer lr_input', 'value' => "$mobile_no", 'placeholder' => "Mobile Number")); ?>
                            <?php echo form_error('mobile_no'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                    </div>
                </div>
                <!-- /COL -->

                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Profile Information</h4>
                        <hr class="line-separator">

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('New Mobile Number', 'mobile_no2', $attri); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'mobile_no2', 'name' => 'mobile_no2', 'maxlength' => '13', 'class' => 'integer lr_input', 'value' => "$mobile_no2", 'placeholder' => "New Mobile Number")); ?>
                            <?php echo form_error('mobile_no2'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('Company Name', 'company_name1', $attri); ?>
                                    <?php echo form_input(array('require' => '', 'id' => 'company_name1', 'name' => 'company_name1', 'value' => "$company_name1", 'class' => 'lr_input', 'placeholder' => "Company Name")); ?>
                                    <?php echo form_error('company_name1'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <div class="input-container half">
                                        <?php echo form_label('Company No', 'company_no', $attri); ?>
                                        <?php echo form_input(array('require' => '', 'id' => 'company_no', 'name' => 'company_no', 'value' => "$company_no", 'class' => 'lr_input', 'placeholder' => "Company No")); ?>
                                        <?php echo form_error('company_no'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Address1', 'address1', $attributes); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'address1', 'class' => ' lr_input', 'name' => 'address1', 'value' => "$address1", 'placeholder' => "Address1")); ?>
                            <?php echo form_error('address1'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Address2', 'address3', $attri); ?>
                            <?php echo form_input(array('require' => '', 'id' => 'address3', 'class' => ' lr_input', 'name' => 'address3', 'value' => "$address3", 'placeholder' => "Address2")); ?>
                            <?php echo form_error('address3'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('Country', 'country1', $attributes); ?>
                                    <label for="country1" class="select-block">
                                        <?php echo form_dropdown('country1', $options, $country1, 'class ="country" id="country1" require = ""'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('country1'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('State', 'state1', $attributes); ?>
                                    <label for="state1" class="select-block">
                                        <?php echo form_dropdown('state1', $state_options, $state1, 'class ="state" id="state1" require = ""'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('state1'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('City', 'city1', $attributes); ?>
                                    <label for="city1" class="select-block">
                                        <?php echo form_dropdown('city1', $city_options, $city1, 'class ="city" id="city1" require = ""'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('city1'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Zip Code', 'zipcode1', $attributes); ?>
                                    <?php echo form_input(array('require' => '', 'id' => 'zipcode1', 'name' => 'zipcode1', 'maxlength' => '6', 'class' => 'integer lr_input', 'value' => "$zipcode1", 'placeholder' => "Zip Code")); ?>
                                    <?php echo form_error('zipcode1'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->
                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->

            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item spaced">
                        <h4>Social Media</h4>
                        <hr class="line-separator">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <ul class="share-links">
                                <li><a href="javascript:void(0)" class="fb"></a></li>
                            </ul>
                            <?php echo form_input(array('require' => '', 'id' => 'social_fb_link', 'class' => ' lr_input', 'name' => 'social_fb_link', 'value' => "$social_fb_link", 'onblur' => "checkURL(this)", 'placeholder' => "Enter your social link here...")); ?>
                            <?php echo form_error('social_fb_link'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <ul class="share-links">
                                <li><a href="javascript:void(0)" class="twt"></a></li>
                            </ul>
                            <?php echo form_input(array('require' => '', 'id' => 'social_twt_link', 'class' => ' lr_input', 'name' => 'social_twt_link', 'value' => "$social_twt_link", 'onblur' => "checkURL(this)", 'placeholder' => "Enter your social link here...")); ?>
                            <?php echo form_error('social_twt_link'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <ul class="share-links">
                                <li><a href="javascript:void(0)" class="gplus"></a></li>
                            </ul>
                            <?php echo form_input(array('require' => '', 'id' => 'social_gplus_link', 'class' => ' lr_input', 'name' => 'social_gplus_link', 'value' => "$social_gplus_link", 'onblur' => "checkURL(this)", 'placeholder' => "Enter your social link here...")); ?>
                            <?php echo form_error('social_gplus_link'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->

            <?php echo form_close(); ?>        
        </div>
        <!-- /FORM BOX -->   
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
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
    // Ajax To Sate And City Fetch
    $(document).ready(function () {
        $(".country").on("change", function () {
            var countryid = $(this).val();
            var url = base_url + "profile_complete/state"
            if (countryid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {c_id: countryid, themes_access_token: csrf_token},
                    success: function (html) {

                        $('#state1').html(html);
                    }
                });
            } else {
                $('.state').html('<option value="">Select country first</option>');
            }
        });
    });
    $(document).ready(function () {
        $(".state").on("change", function () {
            var stateid = $(this).val();
            var url = base_url + "profile_complete/city";
            if (stateid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {s_id: stateid, themes_access_token: csrf_token},
                    success: function (html) {
                        $('#city1').html(html);
                    }
                });
            } else {
                $('#city1').html('<option value="">Select State First</option>');
            }
        });
    });
    // Custome File Browse Button
    $('#OpenImgUpload').click(function () {
        $('#profile').trigger('click');
    });
    // Jquery Form, Validation
    $(document).ready(function () {
        $("#profile_info_form").validate({
            rules: {
                first_name1: {
                    required: true,
                    maxlength: 50
                },
                last_name1: {
                    required: true,
                    maxlength: 50
                },
                date: {
                    required: true
                },
                mobile_no: {
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 13
                },
                address1: {
                    required: true
                },
                country1: {
                    required: true
                },
                state1: {
                    required: true
                },
                city1: {
                    required: true
                },
                zipcode1: {
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 6
                },
                social_fb_link: {
                    url: true
                },
                social_twt_link: {
                    url: true
                },
                social_gplus_link: {
                    url: true
                }

            },
            messages: {
                first_name1: {
                    required: "Please Enter Firstname",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                last_name1: {
                    required: "Please Enter Lastname",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                date: {
                    required: "Please Select D.O.B"
                },
                mobile_no: {
                    required: "Please Enter Your Mobile Number",
                    number: "Please Enter Valid Mobile Number",
                    minlength: "Please Enter Minimum 10 Characters",
                    maxlength: "Please Enter Maximum 13 Characters"
                },
                address1: {
                    required: "Please Enter Address"
                },
                country1: {
                    required: "Please Select Country"
                },
                state1: {
                    required: "Please Select State"
                },
                city1: {
                    required: "Please Select City"
                },
                zipcode1: {
                    required: "Please Enter Zipcode",
                    number: "Please Enter a valid Zipcode",
                    minlength: "Please Enter Minimum 6 Characters",
                    maxlength: "Please Enter Maximum 6 Characters"
                },
                social_fb_link: {
                    url: "Please Enter a valid Facebook URL"
                },
                social_twt_link: {
                    url: "Please Enter a valid Twitter URL"
                },
                social_gplus_link: {
                    url: "Please Enter a valid Google Plus URL"
                }
            }
        });
    });
    // File Browse to Change Button Name
    $('#profile').change(function () {
        var file = $('#profile')[0].files[0].name;
        $('.profile-image').parent().find('#OpenImgUpload').text(file);
    });
    //Enter URL Check 
    function checkURL(abc) {
        var string = abc.value;
        if (!~string.indexOf("http")) {
            string = "http://" + string;
        }
        abc.value = string;
        return abc
    }
</script>