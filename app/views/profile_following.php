<?php
$avg_rating = isset($reputation->avg_rating) ? $reputation->avg_rating : 0;
$avg_recommandation = isset($reputation->avg_recommanded) ? round($reputation->avg_recommanded) : 0;
?>
<input type="hidden" name="avg_recommandation" id="avg_recommandation" value="<?php echo $avg_recommandation; ?>"/>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="container">
        <div class="section-headline">
            <h2><?php echo $this->uri->segment(2); ?> Profile</h2>
            <p><a href="<?php echo base_url(); ?>">Home</a><span class="separator">/</span><span class="current-section">Profile</span></p>
        </div>

    </div>
</div>
<!-- /SECTION HEADLINE -->


<!-- SECTION -->
<div class="section-wrap">
    <div class="container">
        <div class="section overflowable">
            <div class="row">
                <div class="col-md-3">
                    <div id="sidebar">
                        <!-- SIDEBAR -->
                        <div class="sidebar left author-profile sidebar__inner">

                            <!-- DROPDOWN -->
                            <ul class="dropdown hover-effect">
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('profile') . "/" . $user_record->user_login . '.jsf'; ?>">Profile Page</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('profile_products') . "/" . $user_record->user_login . '.jsf'; ?>">Author's Products (<?php echo $product_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('profile_service') . "/" . $user_record->user_login . '.jsf'; ?>">Author's Services (<?php echo $service_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('profile_followers') . "/" . $user_record->user_login . '.jsf'; ?>">Followers (<?php echo $follower_record; ?>)</a>
                                </li>
                                <li class="dropdown-item active">
                                    <a href="<?php echo base_url('profile_following') . "/" . $user_record->user_login . '.jsf'; ?>">Following (<?php echo $following_record; ?>)</a>
                                </li>
                            </ul>

                            <?php if ($avg_recommandation > 0 && !is_null($avg_recommandation)) { ?>
                                <div class="sidebar-item author-reputation full">
                                    <h4>Author's Recommendation</h4>
                                    <hr class="line-separator">
                                    <!-- PIE CHART -->
                                    <div class="pie-chart pie-chart1">
                                        <p class="text-header percent">24<span>%</span></p>
                                        <p class="text-header percent-info">Recommended</p>
                                        <!-- RATING -->

                                        <!-- /RATING -->
                                    </div>
                                    <!-- /PIE CHART -->
                                </div>
                            <?php
                            }
                            if ($avg_rating > 0 && !is_null($avg_rating)) {
                                ?>
                                <div class="sidebar-item author-reputation full">
                                    <h4>Author's Rating</h4>
                                    <hr class="line-separator"> 
                                    <ul class="rating">
                                        <?php
                                        for ($j = 0; $j < $avg_rating; $j++) {
                                            ?>
                                            <li class="rating-item">
                                                <!-- SVG STAR -->
                                                <svg class="svg-star">
                                                <use xlink:href="#svg-star"></use>
                                                </svg>
                                                <!-- /SVG STAR -->
                                            </li>
    <?php } ?>
                                    </ul>
                                </div>
                            <?php }
                            ?>

                        </div>
                        <!-- /SIDEBAR -->
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- CONTENT -->
                    <div class="content center" id="content">
                        <!-- HEADLINE -->
                        <div class="headline simple primary">
                            <h4>Following (<?php echo $following_record; ?>)</h4>
                        </div>
                        <!-- /HEADLINE -->

                        <!-- FOLLOW LIST -->
                        <div class="follow-list">
                            <?php
                            if (isset($followings) && $followings != '') {
                                foreach ($followings as $row) {
                                    ?>
                                    <!-- FOLLOW LIST ITEM -->
                                    <div class="follow-list-item">
                                        <a href="<?php echo base_url('profile') . "/" . $row->user_login . '.jsf'; ?>">
                                            <figure class="user-avatar medium liquid">
                                                <?php
                                                $details_user_fol_nm = sha1("profile_" . $row->follow_id);
                                                $profile_image_details = isset($row->profile_photo) ? trim($row->profile_photo) : "";

                                                if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                                    $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                                } else {
                                                    $profile_image_url_details = base_url() . img_path . "/user.png";
                                                }
                                                ?>
                                                <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                            </figure>
                                        </a>

                                        <!-- FL ITEM INFO -->
                                        <div class="fl-item-info fl-description">
                                            <p class="text-header"><a href="<?php echo base_url('profile') . "/" . $row->user_login . '.jsf'; ?>"><?php echo $row->user_login; ?></a></p>
                                            <p class="mb-2">Member since <?php echo date("F d,Y", strtotime($row->user_registered)); ?></p>
                                            <p><?php echo $row->countryname; ?></p>
                                        </div>
                                        <!-- /FL ITEM INFO -->

                                    </div>
                                    <!-- /FOLLOW LIST ITEM -->
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- /FOLLOW LIST -->
                        <!-- PAGER -->
<?php echo $links; ?>
                        <!-- /PAGER -->
                    </div>
                    <!-- CONTENT -->
                </div>

                <div class="col-md-3">
                    <!-- RIGHT SIDEBAR -->
                    <div class="author-profile_top right">
                        <!-- SIDEBAR ITEM -->
                        <div class="sidebar-item author-bio">
                            <!-- USER AVATAR -->
                            <a href="<?php echo base_url('profile') . "/" . $user_record->user_login . '.jsf'; ?>" class="user-avatar-wrap medium">
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
                                <li><a href="<?php echo $user_record->twt_link; ?>" class="twt"target="_blank"></a></li>
                                <li><a href="<?php echo $user_record->gplus_link; ?>" class="gplus" target="_blank"></a></li>
                            </ul>
                            <!-- /SHARE LINKS -->
                            <?php if ($this->session->userdata('username') && $this->session->userdata('username') != $this->uri->segment(2)) { ?>
                                <button class="button mid dark spaced follow" data-id="<?php echo isset($follow_record) && $follow_record != '' ? $follow_record->ID : 0; ?>"  data-follow_id="<?php echo $user_record->user_id; ?>" data-user_id="<?php echo $this->session->userdata('user_id'); ?>"><span class="primary">Follow</span></button>
                            <?php } ?>
                            <?php
                            $user_id = (int) trim($this->session->userdata('user_id'));
                            $pro_user_id = (int) $user_record->user_id;


                            $message_from_encry = $this->encryption->encrypt($user_id);
                            $msg_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_from_encry);

                            $message_to_encry = $this->encryption->encrypt($pro_user_id);
                            $msg_to_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_to_encry);



                            $login_first_name = isset($login_user_data['first_name']) ? $login_user_data['first_name'] : "";
                            $login_last_name = isset($login_user_data['last_name']) ? $login_user_data['last_name'] : "";
                            $login_user_email = isset($login_user_data['user_email']) ? $login_user_data['user_email'] : "";
                            if ($user_id > 0) {
                                if ($user_id !== $pro_user_id) {
                                    ?>
                                    <a href="#send_message_popup" class="button mid dark send_message_popup">
                                        Send <span class="primary">Private Message</span>
                                    </a>
                                    <!-- FORM POPUP -->
                                    <div id="send_message_popup" class="form-popup promo mfp-hide">
                                        <!-- CLOSE BTN -->
                                        <div class="close-btn">
                                            <!-- SVG PLUS -->
                                            <svg class="svg-plus">
                                            <use xlink:href="#svg-plus"></use>
                                            </svg>
                                            <!-- /SVG PLUS -->
                                        </div>
                                        <!-- /CLOSE BTN -->

                                        <!-- PROMO BG -->
                                        <div class="promo-bg"></div>
                                        <!-- /PROMO BG -->

                                        <!-- FORM POPUP CONTENT -->
                                        <div class="form-popup-content">
                                            <p class="popup-title">Send Message</p>
                                            <!-- LINE SEPARATOR -->
                                            <hr class="line-separator">
                                            <!-- /LINE SEPARATOR -->
                                            <?php
                                            $hidden = array('token_from' => trim($msg_from_id), 'token_to' => trim($msg_to_id));
                                            $attributes = array('id' => 'private_message_from', 'name' => 'private_message_from', 'method' => "post", "class" => "");
                                            echo form_open('products/send_message', $attributes, $hidden);
                                            ?>
                                            <label for="message_text" class="rl-label">Message*</label>
                                            <textarea id="message_text" placeholder="Message" required="" name="message_text" maxlength="144" style="height: 125px"></textarea>
                                            <p id="textarea_feedback"></p>
                                            <button type="button" id="private_msg_Send" class="button mid dark">Send <span class="primary">Now!</span></button>
        <?php echo form_close(); ?>
                                        </div>
                                        <!-- /FORM POPUP CONTENT -->
                                    </div>
                                    <!-- /FORM POPUP -->
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="#promo-popup-login" class="button mid dark promo-popup-login">
                                    Send <span class="primary">Private Message</span>
                                </a>
                                <div id="promo-popup-login" class="form-popup promo mfp-hide">
                                    <!-- CLOSE BTN -->
                                    <div class="close-btn">
                                        <!-- SVG PLUS -->
                                        <svg class="svg-plus">
                                        <use xlink:href="#svg-plus"></use>
                                        </svg>
                                        <!-- /SVG PLUS -->
                                    </div>
                                    <!-- /CLOSE BTN -->

                                    <!-- PROMO BG -->
                                    <div class="promo-bg"></div>
                                    <!-- /PROMO BG -->

                                    <!-- FORM POPUP CONTENT -->
                                    <div class="form-popup-content">
                                        <h4 class="popup-title">Only registered user can send messages.</h4>
                                        <div class="account-actions">
                                            <a href="<?php echo base_url("login.jsf"); ?>" class="button primary" style="margin-bottom:10px;">Login</a>
                                            <a href="<?php echo base_url("register.jsf"); ?>" class="button secondary"  style="margin-bottom: 10px;">Register Now</a>
                                        </div>
                                    </div>
                                    <!-- /FORM POPUP CONTENT -->
                                </div>
<?php } ?>
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
                            <div class="author-profile-info-item">
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
<script src="<?php echo base_url() . js_path; ?>/themeshub.js" type="text/javascript"></script>