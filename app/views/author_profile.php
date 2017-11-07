<style>
    .post {
        padding: 15px 15px 0;
    }
    .post .post-image {
        height: 300px;
        width: 590px;
    }
    .product-preview-image.large.liquid {
        width: 590px;
    }
    .product-preview-image.large {
        height: 300px;
    }

    .content.right {
        width: 59%;
    }
</style>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="container">
        <div class="section-headline">
            <h2><?php echo $this->session->userdata("username"); ?> Profile</h2>
            <p><a href="<?php echo base_url(); ?>">Home</a><span class="separator">/</span><span class="current-section">Profile</span></p>
        </div>
    </div>
</div>
<!-- /SECTION HEADLINE -->

<!-- AUTHOR PROFILE META -->
<div class="author-profile-meta-wrap"></div>
<!-- /AUTHOR PROFILE META -->

<!-- SECTION -->
<div class="section-wrap">
    <div class="container">
        <div class="section overflowable">
            <div class="row">
                <div class="col-md-3">
                    <div id="sidebar">
                        <!-- LEFT SIDEBAR -->
                        <div class="sidebar left author-profile sidebar__inner">
                            <!-- DROPDOWN -->
                            <ul class="dropdown hover-effect">
                                <li class="dropdown-item active">
                                    <a href="<?php echo base_url('author_profile.jsf'); ?>">Profile Page</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_products.jsf'); ?>">Author's Products (<?php echo $product_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_services.jsf'); ?>">Author's Services (<?php echo $service_record; ?>)</a>
                                </li>

                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_followers.jsf'); ?>">Followers (<?php echo $follower_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_following.jsf'); ?>">Following (<?php echo $following_record; ?>)</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /SIDEBAR -->
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- CONTENT -->
                    <div class="content center" id="content">
                        <!-- POST -->
                        <article class="post">
                            <!-- POST CONTENT -->
                            <div class="post-content">

                                <!-- POST PARAGRAPH -->
                                <div class="post-paragraph">
                                    <h3 class="post-title"><?php echo isset($user_data) && $user_data->profile_heading != '' ? $user_data->profile_heading : 'Themeshub Company'; ?></h3>
                                </div>
                                <!-- /POST PARAGRAPH -->
                            </div>
                            <!-- /POST CONTENT -->
                            <!-- POST IMAGE -->
                            <div class="post-image">
                                <figure class="product-preview-image large liquid">
                                    <?php
                                    $user_data_id = isset($user_data) && $user_data->user_id != '' ? $user_data->user_id : 0;
                                    $details_user_fol_nm = sha1("profile_" . $user_data_id);
                                    $profile_image_details = isset($user_data->profile_banner) ? trim($user_data->profile_banner) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                    } else {
                                        $profile_image_url_details = base_url() . img_path . "/items/funtendo_b01.jpg";
                                    }
                                    ?>
                                    <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
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

                            <!-- POST CONTENT -->
                            <div class="post-content">
                                <!-- POST PARAGRAPH -->
                                <div class="post-paragraph">
                                    <?php echo nl2br(isset($user_data) && $user_data->profile_text != '' ? $user_data->profile_text : 'Welcome To Themeshub. Support in 24*7 Times'); ?>
                                </div>
                                <!-- /POST PARAGRAPH -->
                            </div>
                            <!-- /POST CONTENT -->

                            <hr class="line-separator">

                            <!-- SHARE -->
                            <!--                            <div class="share-links-wrap">
                                                            <p class="text-header small">Share this:</p>
                                                             SHARE LINKS 
                                                            <ul class="share-links hoverable">
                                                                <li><a href="https://en-gb.facebook.com/login/" class="fb" target="_blank"></a></li>
                                                                <li><a href="https://twitter.com/login?lang=en" class="twt" target="_blank"></a></li>
                                                                <li><a href="https://plus.google.com/+googleplus" class="gplus" target="_blank"></a></li>
                                                            </ul>
                                                             /SHARE LINKS 
                                                        </div>-->
                            <!-- /SHARE -->
                        </article>
                        <!-- /POST -->
                    </div>
                    <!-- CONTENT -->
                </div>

                <div class="col-md-3">
                    <!-- RIGHT SIDEBAR -->
                    <div class="author-profile_top right">
                        <!-- SIDEBAR ITEM -->
                        <div class="sidebar-item author-bio">
                            <!-- USER AVATAR -->
                            <a href="<?php echo base_url('author_profile.jsf'); ?>" class="user-avatar-wrap medium">
                                <figure class="user-avatar medium">
                                    <?php
                                    $details_user_fol_nm = sha1("profile_" . $user_record->user_id);
                                    $profile_image_details = isset($user_record->profile_photo) ? trim($user_record->profile_photo) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                    } else {
                                        $profile_image_url_details = base_url() . img_path . "/user.png";
                                    }
                                    ?>
                                    <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                </figure>
                            </a>
                            <!-- /USER AVATAR -->
                            <p class="text-header"><?php echo $user_record->user_login; ?></p>
                            <p class="text-oneline"><?php echo $user_record->company_name; ?><br><?php echo $user_record->cityname; ?>,<?php echo $user_record->statename; ?><br><?php echo $user_record->countryname; ?></p>
                            <!-- SHARE LINKS -->
                            <ul class="share-links">
                                <li><a href="<?php echo $user_record->fb_link; ?>" class="fb" target="_blank"></a></li>
                                <li><a href="<?php echo $user_record->twt_link; ?>" class="twt" target="_blank"></a></li>
                                <li><a href="<?php echo $user_record->gplus_link; ?>" class="gplus" target="_blank"></a></li>
                            </ul>
                            <!-- /SHARE LINKS -->
                        </div>
                        <!-- /SIDEBAR ITEM -->
                        <!-- AUTHOR PROFILE INFO -->
                        <div class="author-profile-info">
                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item">
                                <p class="text-header">Member Since:</p>
                                <p><?php echo date("F d,Y", strtotime($user_record->user_registered)); ?></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <!--                            <div class="author-profile-info-item">
                                                            <p class="text-header">Total Sales:</p>
                                                            <p>820</p>
                                                        </div>-->
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item">
                                <p class="text-header">Freelance Work:</p>
                                <p><?php echo isset($user_record->freelancer_work) && $user_record->freelancer_work == 'A' ? 'Available' : 'Not Available'; ?></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item border-0">
                                <p class="text-header">Website:</p>
                                <p><a href="<?php echo $user_record->personal_website; ?>" class="primary" target="_blank"><?php echo $user_record->personal_website; ?></a></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->
                        </div>
                        <!-- /AUTHOR PROFILE INFO -->
                    </div>
                    <!-- /RIGHT SIDEBAR -->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->