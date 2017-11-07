<style>
    .category-nav .category-tabs {
        width: 400px;
    }
    .live-rating {
        font-size: 43px;
        margin-left: 10px;
        color: hotPink;
        top: -3px;
        position: relative;
    }

    pre.prettyprint {
        font-family: "Lucida Console", Monaco, monospace;
        display: block;
        margin: 20px 0;
        font-size: 13px;
        line-height: 20px;;
        padding: 20px;
        background: #EEEEEE;
        border: 0;
    }.jq-stars {
        display: inline-block;
    }

    .jq-rating-label {
        font-size: 22px;
        display: inline-block;
        position: relative;
        vertical-align: top;
        font-family: helvetica, arial, verdana;
    }

    .jq-star {
        width: 100px;
        height: 100px;
        display: inline-block;
        cursor: pointer;
    }

    .jq-star-svg {
        padding-left: 3px;
        width: 100%;
        height: 100% ;
    }
    .jq-star-svg path {
        /* stroke: #000; */
        stroke-linejoin: round;
    }

    /* un-used */
    .jq-shadow {
        -webkit-filter: drop-shadow( -2px -2px 2px #888 );
        filter: drop-shadow( -2px -2px 2px #888 );
    }
    .rating-cover{
        margin-top: 20px;
    }
    .rating-cover i{
        color: #FFA500;
    }
</style>
<div id="service-recommendation-popup" class="form-popup new-message mfp-hide">
    <!-- FORM POPUP CONTENT -->
    <div class="form-popup-content">
        <h4 class="popup-title">Write Your Recommendation</h4>
        <!-- LINE SEPARATOR -->
        <hr class="line-separator">
        <?php
        $attributes = array('id' => 'service-recommendation-form', 'name' => 'service-recommendation-form', 'method' => "post", "class" => "");
        echo form_open('send_service_rating', $attributes);
        ?>
        <!-- INPUT CONTAINER -->
        <div class="recommendation-wrap">
            <div class="recommendation-item">
                <a href="#" class="recommendation good">
                    <span class="icon-like"></span>
                </a>
                <p class="text-header small">Recommended</p>
            </div>

            <div class="recommendation-item">
                <a href="#" class="recommendation bad hoverable">
                    <span class="icon-dislike"></span>
                </a>
                <p class="text-header small">Not Recommended</p>
            </div>
        </div>
        <input type="hidden" name="pid" id="pid"/>
        <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('user_id'); ?>"/>
        <input type="hidden" name="is_recommanded" id="is_recommanded" value="Y"/>
        <div class="input-container">
            <label for="comment" class="rl-label b-label">Your Comment:</label>
            <textarea name="comment" id="comment" placeholder="Write your message here..." required=""></textarea>

        </div>
        <div class="input-container">
            <label for="comment" class="rl-label b-label">Rating:</label>
            <span class="my-rating-9"></span>
            <input type="hidden" id="live-rating" name="live-rating" class="live-rating" value="5"/>
        </div>

        <!-- /INPUT CONTAINER -->
        <button type="button" id="service_rating_send" class="button mid dark">Save your <span class="primary">Recommendation</span></button>
        <?php echo form_close(); ?>
    </div>
    <!-- /FORM POPUP CONTENT -->
</div>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons two primary h_100">
            <h4>Your Service Inquiry</h4>
        </div>
        <!-- /HEADLINE -->

        <!-- CATEGORY NAV -->
        <div class="category-nav-wrap">
            <div class="category-nav primary">
                <div class="category-tabs">
                    <div class="category-tab">
                        <p>Receive Inquiry</p>
                    </div>
                    <div class="category-tab">
                        <p>Send Inquiry</p>
                    </div>
                </div>

                <!-- SLIDE CONTROLS -->
                <div class="slide-control-wrap primary">
                    <div class="slide-control left">
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </div>

                    <div class="slide-control right">
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </div>
                </div>
                <!-- /SLIDE CONTROLS -->
            </div>
        </div>
        <!-- /CATEGORY NAV -->

        <!-- PRODUCT SIDESHOW -->
        <div id="product-sideshow-wrap">
            <div id="product-sideshow" class="inquiry-product-sideshow">
                <!-- PRODUCT SHOWCASE -->
                <div class="product-showcase tabbed">
                    <!-- INBOX MESSAGES -->
                    <div class="inbox-messages">
                        <!-- INBOX MESSAGE -->
                        <?php
                        if (isset($service_inquiry) && count($service_inquiry) > 0):

                            foreach ($service_inquiry as $value):

                                $profile_user_id = isset($value['from_user_id']) ? $value['from_user_id'] : 0;
                                $details_user_fol_nm = sha1("profile_" . $profile_user_id);
                                $profile_image_details = isset($value['from_profile_photo']) ? trim($value['from_profile_photo']) : "";

                                if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                    $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                } else {
                                    $profile_image_url_details = base_url() . img_path . "/user.png";
                                }
                                $from_user_id = $this->encryption->encrypt($value['ID']);
                                $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);
                                ?>
                                <div class="inbox-message">
                                    <a href="<?php echo base_url('product_inquiry_details?token=' . $encrypted_from_id) ?>">
                                        <div class="inbox-message-author">

                                            <figure class="user-avatar">
                                                <img src="<?php echo $profile_image_url_details; ?>" alt="user-img">
                                            </figure>
                                            <p class="text-header">
                                                <?php echo ucfirst($value['from_first_name']) . " " . ucfirst($value['from_last_name']); ?>
                                                <span class="message-icon icon-envelope secondary"></span>
                                            </p>
                                        </div>
                                        <div class="inbox-message-content">
                                            <p class="text-header">Subject</p>
                                            <p class="description"><?php echo $this->general->add3dots($value['inquiry_subject'], "...", 50); ?></p>
                                        </div>
                                        <div class="inbox-message-type">

                                            <?php if ($value['status'] == 'U') { ?>
                                                <span class="message-icon icon-envelope secondary"></span>
                                            <?php } else { ?>
                                                <span  class="message-icon icon-envelope-open"></span>
                                            <?php } ?>

                                        </div>
                                        <div class="inbox-message-date">
                                            <p><?php echo date("F d,Y", strtotime($value['created_on'])); ?> |<b><?php echo date("H:i A", strtotime($value['created_on'])); ?></b> </p>
                                        </div>
                                    </a>
                                </div>
                                <!-- INBOX MESSAGE -->
                                <?php
                            endforeach;
                        else:
                            ?>
                            <div class="inbox-message">
                                <div class="inbox-message-author not_inquiry" style="width: 100%;text-align: center">
                                    <p class="text-header text-center">
                                        No receive service inquiry found.
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <!-- /INBOX MESSAGES -->
                </div>
                <!-- /PRODUCT SHOWCASE -->
                <!-- PRODUCT SHOWCASE -->
                <div class="product-showcase tabbed">
                    <!-- INBOX MESSAGES -->
                    <div class="inbox-messages">
                        <!-- INBOX MESSAGE -->
                        <?php
                        if (isset($send_service_inquiry) && count($send_service_inquiry) > 0):

                            foreach ($send_service_inquiry as $value):

                                $profile_user_id = isset($value['from_user_id']) ? $value['from_user_id'] : 0;
                                $details_user_fol_nm = sha1("profile_" . $profile_user_id);
                                $profile_image_details = isset($value['from_profile_photo']) ? trim($value['from_profile_photo']) : "";

                                if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                    $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                } else {
                                    $profile_image_url_details = base_url() . img_path . "/user.png";
                                }
                                $from_user_id = $this->encryption->encrypt($value['ID']);
                                $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);
                                ?>
                                <div class="inbox-message">
                                    <a href="<?php echo base_url('product_inquiry_details?token=' . $encrypted_from_id) ?>">
                                        <div class="inbox-message-author">

                                            <figure class="user-avatar">
                                                <img src="<?php echo $profile_image_url_details; ?>" alt="user-img">
                                            </figure>
                                            <p class="text-header">
                                                <?php echo ucfirst($value['from_first_name']) . " " . ucfirst($value['from_last_name']); ?>
                                                <span class="message-icon icon-envelope secondary"></span>
                                            </p>
                                        </div>
                                        <div class="inbox-message-content">
                                            <p class="text-header">Subject</p>
                                            <p class="description"><?php echo $this->general->add3dots($value['inquiry_subject'], "...", 50); ?></p>
                                        </div>
                                        <div class="inbox-message-type">

                                            <?php if ($value['status'] == 'U') { ?>
                                                <span class="message-icon icon-envelope secondary"></span>
                                            <?php } else { ?>
                                                <span  class="message-icon icon-envelope-open"></span>
                                            <?php } ?>

                                        </div>
                                        <div class="inbox-message-date">
                                            <p><?php echo date("F d,Y", strtotime($value['created_on'])); ?> |<b><?php echo date("H:i A", strtotime($value['created_on'])); ?></b> </p>
                                        </div>
                                    </a>
                                     <div class="inbox-recommand-content">
                                        <div class="recommendation-wrap">
                                            <?php
                                            if ($value['inquiry_from_id'] == $value['uid'] && $value['service_id'] == $value['sid']) {
                                                ?> 
                                                <div class="rating-cover">
                                                    <?php for ($j = 0; $j < $value['rating']; $j++) {
                                                        ?>
                                                        <i class="fa fa-star"></i> 
                                                    <?php } ?>
                                                </div>  
                                                <?php
                                            } else {
                                                ?>
                                                <a onclick="get_rating_detail(this);" href="#service-recommendation-popup" class="recommendation good open-recommendation-form service-recommendation-popup" data-id="<?php echo $value['service_id']; ?>">
                                                    <span class="icon-like"></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- INBOX MESSAGE -->
                                <?php
                            endforeach;
                        else:
                            ?>
                            <div class="inbox-message">
                                <div class="inbox-message-author not_inquiry" style="width: 100%;text-align: center">
                                    <p class="text-header text-center">
                                        No send service inquiry found.
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <!-- /INBOX MESSAGES -->
                </div>
                <!-- /PRODUCT SHOWCASE -->
            </div>
        </div>
        <!-- /PRODUCT SIDESHOW -->
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
<script src="<?php echo base_url() . js_path ?>/jquery.star-rating-svg.js" type="text/javascript"></script>
<script src="<?php echo base_url() . js_path ?>/inquirytab.js" type="text/javascript"></script>