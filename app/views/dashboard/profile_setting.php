<?php
$yes = $no = '';
$work = isset($work->freelancer_work) && $work->freelancer_work != '' ? $work->freelancer_work : '';
if ($work == 'N') {
    $no = array('checked' => TRUE);
} else {
    $yes = array('checked' => TRUE);
}
$id = isset($user_data->ID) && $user_data->ID != '' ? $user_data->ID : 0;
$profile_banner = isset($user_data->profile_banner) && $user_data->profile_banner != '' ? $user_data->profile_banner : '';
$user_id = $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);
if (isset($user_data) && !empty($user_data)) {
    $profile_heading = isset($user_data->profile_heading) && $user_data->profile_heading != '' ? $user_data->profile_heading : '';
    $profile_text = isset($user_data->profile_text) && $user_data->profile_text != '' ? $user_data->profile_text : '';
} else {
    $profile_heading = $this->input->post('profile_heading');
    $profile_text = $this->input->post('profile_text');
}
?>
<style>
    .post-image {
        height: 300px;
        width: 590px;
    }
    .image-overlay {
        height: 300px;
        width: 590px;
    }
    .product-preview-image.large.liquid {
        width: 590px;
    }
    .product-preview-image.large {
        height: 300px;
    }
    .post-paragraph{
        margin-bottom: 20px;
        font-size: 20px;
    }
    .content.right {
        /*width: 59%;*/
    }

</style>
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <div class="headline buttons primary fixed-box">
            <h4>Profile Settings</h4>
            <button form="profile_info_form" class="button mid-short primary">Save Changes</button>
        </div>
        <!-- FORM BOX ITEM -->
        <div class="form-box-item">
            <h4>Profile Information</h4>
            <hr class="line-separator">
            <!-- PROFILE IMAGE UPLOAD -->
            <!-- CONTENT -->
            <div class="content right"><!-- POST CONTENT -->
                <div class="post-content">
                    <!-- POST PARAGRAPH -->
                    <div class="post-paragraph text-header">
                        Homepage Image
                    </div>
                    <!-- /POST PARAGRAPH -->
                </div>
                <!-- /POST CONTENT -->

                <!-- POST IMAGE -->
                <?php
                $user_id = isset($user_data->user_id) ? $user_data->user_id : 0;
                $details_user_fol_nm = sha1("profile_" . $user_id);
                $profile_image_details = isset($user_data->profile_banner) ? trim($user_data->profile_banner) : "";

                if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                    $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                } else {
                    $profile_image_url_details = base_url() . img_path . "/items/funtendo_b01.jpg";
                }
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image" class="proflie_setting-img">
                        <!-- IMAGE OVERLAY -->
                    </div>
                </div>
                <div class="image-overlay img-gallery">
                    <!-- GALLERY ITEMS -->
                    <div class="gallery-items">
                        <span data-mfp-src="<?php echo base_url() . img_path ?>/items/funtendo_b01.jpg"></span>
                    </div>
                    <!-- /GALLERY ITEMS -->
                </div>

            </div>
            <!-- CONTENT -->
            <div class="profile-image">
                <p class="text-header mt-2">Upload Homepage Image</p>
                <a href="#" class="button mid-short dark-light mt-3 w100" id="OpenImgUpload">Upload Image...</a>
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
            <?php echo form_open_multipart('save_profile_setting', array('name' => 'profile_info_form', 'id' => 'profile_info_form')); ?>
            <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id)); ?>
            <?php echo form_input(array('type' => 'hidden', 'name' => 'banner_image', 'id' => 'banner_image', 'value' => $profile_banner)); ?>
            <?php echo form_input(array('type' => 'file', 'id' => 'profile_banner', 'name' => 'profile_banner', 'class' => 'form-control lr_input', 'value' => "", 'display' => 'none')); ?>
            <?php echo form_error('profile_banner'); ?>
            <!-- INPUT CONTAINER -->
            <div class="input-container">
                <?php echo form_label('Profile Heading', 'profile_heading', $attri); ?>
                <?php echo form_input(array('require' => '' ,'id' => 'profile_heading', 'name' => 'profile_heading', 'class' => 'lr_input', 'value' => "$profile_heading", 'placeholder' => "Profile Heading")); ?>
                <?php echo form_error('profile_heading'); ?>
            </div>
            <!-- /INPUT CONTAINER -->

            <!-- INPUT CONTAINER -->
            <div class="input-container">
                <?php echo form_label('Profile Text', 'profile_text', $attri); ?>
                <?php echo form_textarea(array('require' => '' ,'rows' => "15", 'id' => 'profile_text', 'name' => 'profile_text', 'class' => 'lr_input', 'value' => "$profile_text", 'placeholder' => "Profile Text")); ?>
                <?php echo form_error('profile_text'); ?>
            </div>
            <!-- /INPUT CONTAINER -->
            <?php echo form_close(); ?>

            <?php echo form_open_multipart('save_freelance', array('name' => 'freelance_form', 'id' => 'freelance_form')); ?>
            <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id)); ?>            
            <div class="input-container" id="freelance">
                <?php echo form_label('Freelance Work:', '', $attri); ?>
                <?php
                $yes_radio = array(
                    'name' => 'work',
                    'id' => 'yes',
                    'value' => 'A',
                );
                echo form_radio($yes_radio, '', $yes);
                ?>
                <label for="yes" class="label-check radio-cover">
                    <span class="radio primary"><span></span></span>
                    Yes
                </label>
                <?php
                $no_radio = array(
                    'name' => 'work',
                    'id' => 'no',
                    'value' => 'N'
                );
                echo form_radio($no_radio, '', $no);
                ?>
                <label for="no" class="label-check radio-cover">
                    <span class="radio primary"><span></span></span>
                    No
                </label>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- FORM BOX ITEM -->
<script>
    // Custome File Browse Button
    $('#OpenImgUpload').click(function () {
        $('#profile_banner').trigger('click');
    });
    // Jquery Form, Validation
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $(document).ready(function () {
        $("#profffile_info_form").validate({
            rules: {
                profile_banner: {
                    required: true,
                    accept: "image/*"
                },
                profile_heading: {
                    required: true,
                    maxlength: 50
                },
                profile_text: {
                    required: true
                }
            },
            messages: {
                profile_banner: {
                    required: "Please Select Profile Banner",
                    accept: "Please Select Profile Banner Only Image File"
                },
                profile_heading: {
                    required: "Please Enter Profile Heading",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                profile_text: {
                    required: "Please Enter Profile Text"
                }
            }
        });
    });
    // File Browse to Change Button Name
    $('#profile_banner').change(function () {
        var file = $('#profile_banner')[0].files[0].name;
        $('.profile-image').parent().find('#OpenImgUpload').text(file);
    });
    $('input[type=radio][name=work]').change(function () {
        var url = base_url + "save_freelance";
        //Ajax code to send
        $.ajax({
            url: url,
            type: "POST",
            data: $("#freelance_form").serialize(),
            beforeSend: function () {
                $('.loader').show();
            },
            success: function (data) {
                $('.loader').hide();
                if (data == true) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    });
</script>
<script src = "<?php echo base_url() . js_path; ?>/vendor/tinymce/js/tinymce/tinymce.min.js" ></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: "lists searchreplace",
        toolbar: "redo undo bullist numlist outdent indent searchreplace bold italic alignleft aligncenter alignright sizeselect fontselect fontsizeselect",
        height: "400",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });
    tinymce.triggerSave();
</script>