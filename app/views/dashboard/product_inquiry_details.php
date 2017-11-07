<?php
//echo '<pre>';
//print_r($product_inquiry);
//exit;

$first_name = isset($product_inquiry->first_name) && $product_inquiry->first_name != '' ? $product_inquiry->first_name : '';
$last_name = isset($product_inquiry->last_name) && $product_inquiry->last_name != '' ? $product_inquiry->last_name : '';
$company_name = isset($product_inquiry->company_name) && $product_inquiry->company_name != '' ? $product_inquiry->company_name : '';
$inquiry_subject = isset($product_inquiry->inquiry_subject) && $product_inquiry->inquiry_subject != '' ? $product_inquiry->inquiry_subject : '';
$inquiry_description = isset($product_inquiry->inquiry_description) && $product_inquiry->inquiry_description != '' ? $product_inquiry->inquiry_description : '';
$product_name = isset($product_inquiry->item_name) && $product_inquiry->item_name != '' ? $product_inquiry->item_name : '';
$product_description = isset($product_inquiry->item_description) && $product_inquiry->item_description != '' ? nl2br(strip_tags($product_inquiry->item_description)) : '';
?>
<style>
    .profile-image .profile-image-data .text-header {
        margin-top: 25px;
        padding-top: 20px;
    }
    .post-image {
        margin-bottom: 10px;
    }
    .form-box-item.padded {
        padding-bottom: 24px;
    }

</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Product Inquiry Details</h4>
        </div>
        <?php
        $attributes = array(
            'class' => 'rl-label required'
        );
        $attri = array(
            'class' => 'rl-label'
        );
        ?>
        <!-- /HEADLINE -->
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <div class="row">
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>User Information</h4>
                        <hr class="line-separator">
                        <!-- PROFILE IMAGE UPLOAD -->
                        <div class="profile-image">
                            <div class="profile-image-data">
                                <figure class="user-avatar medium">
                                    <?php
                                    $user_id = $product_inquiry->inquiry_from_id;
                                    $details_user_fol_nm = sha1("profile_" . $user_id);
                                    $profile_image_details = isset($product_inquiry->profile_photo) ? trim($product_inquiry->profile_photo) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                    } else {
                                        $profile_image_url_details = base_url() . img_path . "/user.png";
                                    }
                                    ?>
                                    <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                </figure>
                                <p class="text-header"><?php echo ucfirst($first_name) . " " . ucfirst($last_name); ?></p>
                            </div>
                        </div>
                        <!-- PROFILE IMAGE UPLOAD -->


                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Company Name', 'company_name', $attri); ?>
                            <?php echo form_input(array('id' => 'company_name', 'class' => ' lr_input', 'name' => 'company_name', 'value' => "$company_name")); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Inquiry Subject', 'notes', $attri); ?>
                            <?php echo form_textarea(array('rows' => "4", 'id' => 'notes', 'name' => 'notes', 'class' => ' lr_input', 'value' => "$inquiry_subject")); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Inquiry Description', 'notes', $attri); ?>
                            <?php echo form_textarea(array('rows' => "8", 'id' => 'notes', 'name' => 'notes', 'class' => ' lr_input', 'value' => "$inquiry_description")); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>

                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item padded">
                        <h4>Product Information</h4>
                        <hr class="line-separator">
                        <div class="post-image">
                            <figure class="product-preview-image large liquid">
                                <?php
                                $user_data_id = $product_inquiry->product_id;
                                $details_user_fol_nm = sha1("product_" . $user_data_id);
                                $profile_image_details = isset($product_inquiry->main_image) ? trim($product_inquiry->main_image) : "";
                                if (file_exists(FCPATH . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                    $profile_image_url_details = base_url() . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details;
                                } else {
                                    $profile_image_url_details = base_url() . img_path . "/items/funtendo_b01.jpg";
                                }
                                ?>
                                <img src = "<?php echo $profile_image_url_details; ?>"  alt = "profile-default-image">
                            </figure>
                            <!-- IMAGE OVERLAY -->
                            <div class="image-overlay img-gallery">
                                <!-- GALLERY ITEMS -->
                                <div class="gallery-items">
                                    <span data-mfp-src="<?php echo base_url() . img_path ?>/items/funtendo_b01.jpg"></span>
                                </div>
                                <!-- /GALLERY ITEMS -->
                            </div>
                            <!-- /IMAGE OVERLAY -->
                        </div>
                        <!-- /POST IMAGE -->
                        <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <?php echo form_label('Product Name', 'first_name2', $attributes); ?>
                                <?php echo form_input(array('id' => 'first_name2', 'class' => ' lr_input', 'name' => 'first_name2', 'value' => "$product_name")); ?>
                            </div>
                            <!-- /INPUT CONTAINER -->


                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <?php echo form_label('Product Description', 'notes2', $attri); ?>
                                <?php echo form_textarea(array('rows' => "5", 'class' => ' lr_input', 'id' => 'notes2', 'name' => 'notes2', 'value' => "$product_description")); ?>
                            </div>
                            <!-- /INPUT CONTAINER -->

                        <!-- /FORM BOX ITEM -->
                    </div>
                    <!-- /FORM BOX -->
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTAINER FLUID -->
    <!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
