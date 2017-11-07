<?php
$avg_rating = isset($reputation->avg_rating) ? $reputation->avg_rating : 0;
$avg_recommandation = isset($reputation->avg_recommanded) ? round($reputation->avg_recommanded) : 0;
$main_category_type = $this->general->slugify($product_details->item_main_category);


$item_parent_category = $this->general->slugify($product_details->p_catagory);
$item_sub_category = $this->general->slugify($product_details->c_category);
$root_cat_array = array("web", "android", "ios", "iOs");
if (!in_array($main_category_type, $root_cat_array)) {
    redirect(base_url());
}
$main_category_type_title = ($main_category_type == "ios") ? "iOs" : ucfirst($main_category_type);

?>
<input type="hidden" name="avg_recommandation" id="avg_recommandation" value="<?php echo $avg_recommandation; ?>"/>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="container">
        <div class="section-headline">
            <h2><?php echo $product_details->item_name; ?></h2> 
            <p><a href="<?php echo base_url(); ?>">Home</a><span class="separator">/</span>
                <a href="<?php echo base_url('products/' . $main_category_type . '.jsf'); ?>"><span class="current-section">  <?php echo ($main_category_type_title); ?></span></a>
                <?php if ($item_parent_category != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('products/' . $main_category_type . '/' . $item_parent_category . '.jsf'); ?>"> <span class="current-section">  <?php echo ucfirst($item_parent_category); ?></span></a>
                <?php }
                ?>
                <?php if ($item_sub_category != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('products/' . $main_category_type . '/' . $item_parent_category . '/' . $item_sub_category . '.jsf'); ?>"><span class="current-section">  <?php echo ucfirst($item_sub_category); ?></span></a>
                <?php }
                ?>
            </p>
        </div>
    </div>
</div>
<!-- /SECTION HEADLINE -->
<!-- SECTION -->
<div class="section-wrap">
    <div class="container">
        <div class="section" data-sticky_parent>
            <div class="row">
                <div class="col-md-3">
                    <div id="mysticky" data-sticky_column>
                        <!-- SIDEBAR ITEM -->
                    <div class="sidebar-item void buttons">
                        <?php
                        if (isset($product_details->item_type) && $product_details->item_type == 'P') {
                            $get_inq_from_id = (int) $this->session->userdata('user_id');
                            $get_pro_user_id = (int) $product_details->user_id;
                            $get_product_id = (int) $product_details->ID;

                            $inquiry_from_encry = $this->encryption->encrypt($get_inq_from_id);
                            $inq_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $inquiry_from_encry);

                            $inquiry_to_encry = $this->encryption->encrypt($get_pro_user_id);
                            $inq_to_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $inquiry_to_encry);

                            $product_id_encry = $this->encryption->encrypt($get_product_id);
                            $product_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $product_id_encry);
                            if ($get_inq_from_id > 0) {
                                if ($get_inq_from_id != $get_pro_user_id) {
                                    ?>
                                    <a href="#send_product_inquiry" class="button big dark purchase send_product_inquiry">
                                        <span class="currency"><?php echo $product_details->item_price; ?></span>
                                        <span>Product Inquiry!</span>
                                    </a>
                                    <!-- FORM POPUP -->
                                    <div id="send_product_inquiry" class="form-popup new-message mfp-hide">
                                        <!-- FORM POPUP CONTENT -->
                                        <div class="form-popup-content">
                                            <h4 class="popup-title">Write a New Inquiry</h4>
                                            <!-- LINE SEPARATOR -->
                                            <hr class="line-separator">
                                            <!-- /LINE SEPARATOR -->
                                            <!-- INPUT CONTAINER -->
                                            <?php
                                            $hidden = array('token_from' => trim($inq_from_id), 'token_to' => trim($inq_to_id), 'product_id' => trim($product_id));
                                            $attributes = array('id' => 'product_inquiry_from', 'name' => 'product_inquiry_from', 'method' => "post", "class" => "");
                                            echo form_open('dashboard/product_inquiry_save', $attributes, $hidden);
                                            ?>
                                            <div class="input-container">
                                                <label for="inq_subject" class="rl-label">Subject*</label>
                                                <input type="text" id="inq_subject" placeholder="Subject" maxlength="100" required="" name="inq_subject"/>
                                                <p id="subject_feedback"></p>
                                            </div>
                                            <!-- INPUT CONTAINER -->

                                            <!-- INPUT CONTAINER -->
                                            <div class="input-container">
                                                <label for="inq_text" class="rl-label">Inquiry*</label>
                                                <textarea id="inq_text" placeholder="Inquiry" required="" name="inq_text" maxlength="500" style="height: 125px"></textarea>
                                                <p id="textarea_feedback"></p>
                                                <button type="button" id="product_inquiry_Send" class="button mid dark">Send <span class="primary">Now!</span></button>

                                            </div>
                                            <!-- INPUT CONTAINER -->
                                            <?php echo form_close(); ?>
                                        </div>
                                        <!-- /FORM POPUP CONTENT -->
                                    </div>
                                    <!-- /FORM POPUP -->
                                <?php } else {
                                    ?>
                                    <a  class="button big dark purchase">
                                        <span class="currency"><?php echo $product_details->item_price; ?></span>
                                        <span>Price!</span>
                                    </a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="#login_product_inquiry" class="button big dark purchase login_product_inquiry">
                                    <span class="currency"><?php echo $product_details->item_price; ?></span>
                                    <span>Product Inquiry!</span>
                                </a>
                                <div id="login_product_inquiry" class="form-popup promo mfp-hide">
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
                                        <h4 class="popup-title">Only registered user can send Inquiry.</h4>
                                        <div class="account-actions">
                                            <a href="<?php echo base_url("login.jsf"); ?>" class="button primary" style="margin-bottom:10px;">Login</a>
                                            <a href="<?php echo base_url("register.jsf"); ?>" class="button secondary"  style="margin-bottom: 10px;">Register Now</a>
                                        </div>
                                    </div>
                                    <!-- /FORM POPUP CONTENT -->
                                </div>
                            <?php } ?>
                            <a href="<?php echo $product_details->purchase_url; ?>" class="button big secondary wcart" target="_blank">
                                <span class="icon-basket-loaded product_button"></span>
                                Product Purchase
                            </a>
                        <?php } else {
                            ?>
                            <a href="<?php echo $product_details->download_url; ?>" class="button big dark wcart" target="_blank">
                                <span class="sl-icon icon-arrow-down-circle product_button"></span>
                                Download
                            </a>
                        <?php } ?>
                    </div>
                        <!-- SIDEBAR ITEM -->
                        <div class="sidebar-item product-info">
                            <h4>Product Information</h4>
                            <hr class="line-separator">
                            <!-- INFORMATION LAYOUT -->
                            <div class="information-layout">
                                <!-- INFORMATION LAYOUT ITEM -->
                                <div class="information-layout-item">
                                    <p class="text-header">Category:</p>
                                    <?php $c_category = isset($product_details->c_category) ? "," . ucfirst($product_details->c_category) : ''; ?>
                                    <p class="tags primary"><?php echo ucfirst($product_details->p_catagory) . $c_category; ?></p>
                                </div>
                                <!-- /INFORMATION LAYOUT ITEM -->

                                <!-- INFORMATION LAYOUT ITEM -->
                                <div class="information-layout-item">
                                    <p class="text-header">Upload Date:</p>
                                    <!--<p><?php // echo $product_details->created_date;                                                               ?></p>-->
                                    <p class="tags primary"><?php echo date(date_formate, strtotime($product_details->created_date)); ?></p>
                                </div>
                                <!-- /INFORMATION LAYOUT ITEM -->

                                <!-- INFORMATION LAYOUT ITEM -->
                                <div class="information-layout-item">
                                    <p class="text-header">Files Included:</p>
                                    <p class="tags primary"><?php echo $product_details->item_file; ?></p>
                                </div>
                                <!-- /INFORMATION LAYOUT ITEM -->

                                <!-- INFORMATION LAYOUT ITEM -->
                                <div class="information-layout-item">
                                    <p class="text-header">Browser / Software:</p>
                                    <p class="tags primary"><?php echo $product_details->item_browser; ?></p>
                                </div>
                                <!-- /INFORMATION LAYOUT ITEM -->
                                <!-- INFORMATION LAYOUT ITEM -->
                                <div class="information-layout-item">
                                    <p class="text-header">Tags:</p>
                                    <p class="tags primary"><?php echo $product_details->item_tag; ?></p>
                                </div>
                                <!-- /INFORMATION LAYOUT ITEM -->
                            </div>
                            <!-- INFORMATION LAYOUT -->
                        </div>
                        <!-- /SIDEBAR ITEM -->
                              <!-- SIDEBAR ITEM -->
                    <?php if ($avg_recommandation > 0 && !is_null($avg_recommandation)) { ?>
                        <div class="sidebar-item author-reputation full">
                            <h4>Product's Reputation</h4>
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
                    <?php }
                    if ($avg_rating > 0 && !is_null($avg_rating)) {
                        ?>
                        <div class="sidebar-item author-reputation full">
                            <h4>Product's Rating</h4>
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
                </div>

                    <div class="col-md-6">
                        <!-- CONTENT -->
                        <div class="content left">
                            <!-- POST -->
                            <article class="post">
                                <!-- POST IMAGE -->
                                <div class="post-image">
                                    <figure class="product-preview-image large liquid">
                                        <?php
                                        $productfolder = sha1("product_" . $product_details->ID);
                                        $product_main_image = isset($product_details->main_image) ? $product_details->main_image : "";

                                        if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_main_image) && $product_main_image != "") {
                                            $product_image_url_details = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_main_image;
                                        } else {
                                            $product_image_url_details = base_url() . img_path . "/default.png";
                                        }
                                        ?>
                                        <img class="main_img" src="<?php echo $product_image_url_details; ?>" alt="">
                                    </figure>
                                    <a href="<?php echo $product_details->demo_url; ?>" class="button mid primary" target="_balnk">Go to Live Demo</a>
                                </div>
                                <!-- POST IMAGE SLIDES -->

                                <!-- /POST IMAGE SLIDES -->

                                <hr class="line-separator">

                                <!-- POST CONTENT -->
                                <div class="post-content">
                                    <!-- POST PARAGRAPH -->
                                    <div class="post-paragraph">
                                        <?php echo $product_details->item_description; ?>
                                    </div>
                                    <!-- /POST PARAGRAPH -->
                                    <div class="clearfix"></div>
                                </div>
                                <!-- /POST CONTENT -->

                                <hr class="line-separator">

                                <!-- SHARE -->
                                <!--                            <div class="share-links-wrap">
                                                                <p class="text-header small">Share this:</p>
                                                                 SHARE LINKS 
                                                                <ul class="share-links hoverable">
                                                                    <li><a href="https://en-gb.facebook.com/login/" class="fb" target="_blank"></a></li>
                                                                    <li><a href="https://twitter.com/login?lang=en" class="twt"target="_blank"></a></li>
                                                                    <li><a href="https://plus.google.com/+googleplus" class="gplus" target="_blank"></a></li>
                                                                </ul>
                                                                 /SHARE LINKS 
                                                            </div>-->
                                <!-- /SHARE -->
                            </article>
                            <!-- /POST -->

                            <?php
                            $user_id = $this->session->userdata("user_id");
                            if (isset($user_id)) {
                                ?>
                                <!-- POST TAB -->
                                <div class="post-tab">
                                    <!--TAB CONTENT--> 
                                    <div class="tab-content void">
                                        <!--COMMENTS--> 
                                        <div class="comment-list detail_comment_cover">
                                            <div class="tab-item selected">
                                                <p class="text-header">Comments</p>
                                            </div>
                                            <div id="comment_list">
                                                <!--COMMENT--> 
                                                <?php
                                                if (isset($comment) && $comment != '') {
                                                    $reply_comment_cnt = 0;
                                                    foreach ($comment as $value) {
                                                        ?>
                                                        <!--COMMENT--> 
                                                        <div class="comment-wrap" id="reply_comment_display">
                                                            <!--USER AVATAR--> 
                                                            <a href="<?php echo base_url('profile') . "/" . $value->user_login; ?>">
                                                                <figure class="user-avatar medium">
                                                                    <?php
                                                                    $productfolder = sha1("profile_" . $value->user_id);
                                                                    $product_main_image = isset($value->profile_photo) ? $value->profile_photo : "";
                                                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image) && $product_main_image != "") {
                                                                        $product_image_url_details = base_url() . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image;
                                                                    } else {
                                                                        $product_image_url_details = base_url() . img_path . "/user.png";
                                                                    }
                                                                    ?>
                                                                    <img src="<?php echo $product_image_url_details; ?>" alt="">

                                                                </figure>
                                                            </a>
                                                            <!--/USER AVATAR--> 
                                                            <div class="comment" id="comment_box">
                                                                <p class="text-header"><?php echo ucfirst($value->first_name) . " " . ucfirst($value->last_name); ?></p>
                                                                <?php if ($product_details->user_id == $value->user_id) { ?>
                                                                    <span class='pin greyed'>Author</span>
                                                                <?php } ?>
                                                                <p class="timestamp"><?php echo date(date_formate, strtotime($value->created_on)); ?></p>
                                                                <p><?php echo $value->comment; ?></p>
                                                                <br/>
                                                                <button onclick="click_reply(this);" class="reply" id="reply">Replay</button>
                                                                <?php
                                                                $this->db->select('theme_user_comment_product.*,theme_user_details.first_name,theme_user_details.last_name,theme_user_details.profile_photo,theme_users.user_login', FALSE);
                                                                $this->db->join('theme_user_details', 'theme_user_details.user_id =theme_user_comment_product.user_id', 'left');
                                                                $this->db->join('theme_users', 'theme_users.ID =theme_user_comment_product.user_id', 'left');
                                                                $this->db->where('product_id', $product_details->ID);
                                                                $this->db->where('comment_perent_id', $value->ID);
                                                                $query = $this->db->get('theme_user_comment_product');
                                                                $reply_comment = $query->result();
                                                                ?>
                                                                <div id="display_reply">
                                                                    <?php
                                                                    if (isset($reply_comment) && $reply_comment > 0) {
                                                                        foreach ($reply_comment as $row) {
                                                                            if ($row->comment_perent_id == $value->ID) {
                                                                                ?>
                                                                                <div class="comment-wrap">
                                                                                    <!--USER AVATAR--> 
                                                                                    <a href="<?php echo base_url('profile') . "/" . $row->user_login; ?>">
                                                                                        <figure class="user-avatar medium">
                                                                                            <?php
                                                                                            $productfolder = sha1("profile_" . $row->user_id);
                                                                                            $product_main_image = isset($row->profile_photo) ? $row->profile_photo : "";
                                                                                            if (file_exists(FCPATH . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image) && $product_main_image != "") {
                                                                                                $product_image_url_details = base_url() . uploads_path . '/profiles/' . $productfolder . '/' . $product_main_image;
                                                                                            } else {
                                                                                                $product_image_url_details = base_url() . img_path . "/default.png";
                                                                                            }
                                                                                            ?>
                                                                                            <img src="<?php echo $product_image_url_details; ?>" alt="">
                                                                                        </figure>
                                                                                    </a>
                                                                                    <!--/USER AVATAR--> 
                                                                                    <div class="comment">
                                                                                        <p class="text-header"><?php echo ucfirst($row->first_name) . " " . ucfirst($row->last_name); ?></p>
                                                                                        <?php if ($product_details->user_id == $value->user_id) { ?>
                                                                                            <span class='pin greyed'>Author</span>
                                                                                        <?php } ?>
                                                                                        <p class="timestamp"><?php echo date(date_formate, strtotime($row->created_on)); ?></p>
                                                                                        <p><?php echo $row->comment; ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <!--COMMENT REPLY--> 
                                                            <div class="comment-wrap comment-reply" id="reply_box_<?php echo $reply_comment_cnt; ?>" style="display:none">
                                                                <!--COMMENT REPLY FORM--> 
                                                                <?php echo form_open('', array('name' => 'comment_reply_form', 'id' => 'comment_reply_form', 'class' => "comment_reply_form")); ?>
                                                                <textarea name="comment" id="comment" placeholder="Write your comment here..." required=""></textarea>
                                                                <?php
                                                                $dec_p_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $product_details->ID);
                                                                $p_id = $this->encryption->encrypt($dec_p_id);
                                                                $dec_u_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $product_details->user_id);
                                                                $u_id = $this->encryption->encrypt($dec_u_id);
                                                                ?>
                                                                <div class="d-flex">
                                                                    <button type="submit" onclick="return reply_comment(this);" class="button primary service_btn" data-token="<?php echo $p_id; ?>" data-u_token="<?php echo $u_id; ?>" data-perent="<?php echo $value->ID; ?>" id="post_reply_comment">Reply</button>
                                                                    <button type="button" class="button btn-dark service_btn" onclick="close_replay(this);">Close</button>
                                                                </div>
                                                                <?php echo form_close() ?>
                                                                <!--/COMMENT REPLY FORM--> 
                                                            </div>
                                                            <!--/COMMENT REPLY--> 
                                                        </div>
                                                        <!--/COMMENT--> 
                                                        <?php
                                                        $reply_comment_cnt++;
                                                    }
                                                }
                                                ?>
                                                <!--LINE SEPARATOR--> 
                                                <hr class="line-separator">
                                                <!--/LINE SEPARATOR--> 
                                            </div>


                                            <h3>Leave a Comment</h3>

                                            <!--COMMENT REPLY--> 
                                            <div class="comment-wrap comment-reply">
                                                <!--USER AVATAR--> 
                                                <a href="<?php echo base_url('profile') . "/" . $product_details->created_by; ?>">
                                                    <figure class="user-avatar medium">
                                                        <?php
                                                        $details_user_fol_nm = sha1("profile_" . $login_user_data['user_id']);
                                                        $profile_image_details = isset($login_user_data['profile_photo']) ? trim($login_user_data['profile_photo']) : "";

                                                        if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                                            $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                                        } else {
                                                            $profile_image_url_details = base_url() . img_path . "/user.png";
                                                        }
                                                        ?>
                                                        <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                                    </figure>
                                                </a>
                                                <!--/USER AVATAR--> 

                                                <!--COMMENT REPLY FORM--> 
                                                <?php echo form_open('', array('name' => 'comment_form', 'id' => 'comment_form', 'class' => "comment_form")); ?>
                                                <textarea name="comment" id="comment" placeholder="Write your comment here..." required=""></textarea>
                                                <?php
                                                $dec_p_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $product_details->ID);
                                                $p_id = $this->encryption->encrypt($dec_p_id);
                                                $dec_u_id = str_replace(array('-', '_', '~'), array('+', '/', '='), $product_details->user_id);
                                                $u_id = $this->encryption->encrypt($dec_u_id);
                                                ?>
                                                <button type="submit" class="button primary service_btn" onclick="return new_comment(this);" data-token="<?php echo $p_id; ?>" data-u_token="<?php echo $u_id; ?>" id="post_comment">Post Comment</button>
                                                <?php echo form_close() ?>
                                                <!--/COMMENT REPLY FORM--> 
                                            </div>
                                            <!--/COMMENT REPLY--> 
                                        </div>
                                        <!--/COMMENTS--> 
                                    </div>
                                    <!--/TAB CONTENT--> 
                                </div>
                                <!-- /POST TAB -->
                            <?php } ?>
                        </div>
                        <!-- CONTENT -->
                    </div>

                    <div class="col-md-3">
                        <!-- SIDEBAR -->
                        <div class="sidebar right" id="mysticky" data-sticky_column>


                            <!-- SIDEBAR ITEM -->
                            <div class="sidebar-item author-bio">
                                <h4>Product Author</h4>
                                <hr class="line-separator">
                                <!-- USER AVATAR -->
                                <a href="<?php echo base_url('profile') . "/" . $product_details->created_by; ?>" class="user-avatar-wrap medium">
                                    <figure class="user-avatar medium">
                                        <?php
                                        $details_user_fol_nm = sha1("profile_" . $product_details->user_id);
                                        $profile_image_details = isset($product_details->profile_photo) ? trim($product_details->profile_photo) : "";

                                        if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                            $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                        } else {
                                            $profile_image_url_details = base_url() . img_path . "/user.png";
                                        }
                                        ?>
                                        <img  src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                    </figure>
                                </a>
                                <!-- /USER AVATAR -->
                                <p class="text-header"><?php echo $product_details->created_by; ?></p>
                                <p class="text-oneline"><?php echo $product_details->company_name; ?><br><?php echo $product_details->cityname; ?>,<?php echo $product_details->statename; ?><br/><?php echo $product_details->countryname; ?></p>
                                <!-- SHARE LINKS -->
                                <ul class="share-links">
                                    <li><a href="<?php echo $product_details->fb_link; ?>" class="fb" target="_blank"></a></li>
                                    <li><a href="<?php echo $product_details->twt_link; ?>" class="twt" target="_blank"></a></li>
                                    <li><a href="<?php echo $product_details->gplus_link; ?>" class="gplus" target="_blank"></a></li>
                                </ul>
                                <!-- /SHARE LINKS -->
                                <a href="<?php echo base_url('profile') . "/" . $product_details->created_by; ?>" class="button mid dark spaced">Go to <span class="primary">Profile Page</span></a>
                                <?php
                                $user_id = (int) trim($this->session->userdata('user_id'));
                                $pro_user_id = (int) $product_details->user_id;


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
                                                echo form_open('send_message', $attributes, $hidden);
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

                            <!-- SIDEBAR ITEM -->
                            <?php if (isset($more_product) && count($more_product) > 0) { ?>

                                <div class="sidebar-item author-items">
                                    <h4>More Author's Products</h4>
                                    <?php
                                    foreach ($more_product as $row) {
                                        $enc_username = $this->encryption->encrypt($row->ID);
                                        $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                                        $productfolder_one = sha1("product_" . $row->ID);

                                        $product_image_trending_one = isset($row->main_image) ? $row->main_image : "";

                                        if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder_one . '/' . $product_image_trending_one) && $product_image_trending_one != "") {
                                            $product_image_url_one = base_url() . uploads_path . '/products/' . $productfolder_one . '/' . $product_image_trending_one;
                                        } else {
                                            $product_image_url_one = base_url() . img_path . "/default.png";
                                        }
                                        ?>
                                        <div class="product-list grid column4-wrap product-box_shadow more_product">
                                            <!-- PRODUCT PREVIEW ACTIONS -->
                                            <div class="product-preview-actions">
                                                <!-- PRODUCT PREVIEW IMAGE -->
                                                <figure class="product-preview-image">
                                                    <img src="<?php echo $product_image_url_one; ?>" alt="product-image" height="163px" data-name="product"  data-id="<?php echo $row->ID; ?>">
                                                </figure>
                                                <!-- /PRODUCT PREVIEW IMAGE -->
                                                <!-- PREVIEW ACTIONS -->
                                                <div class="preview-actions">
                                                    <!-- PREVIEW ACTION -->
                                                    <div class="preview-action">
                                                        <a href="<?php echo base_url('product_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                            <div class="circle tiny primary">
                                                                <span class="icon-tag"></span>
                                                            </div>
                                                        </a>
                                                        <a href="<?php echo base_url('product_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                            <p>Go to Item</p>
                                                        </a>
                                                    </div>
                                                    <!-- /PREVIEW ACTION -->

                                                </div>
                                                <!-- /PREVIEW ACTIONS -->
                                            </div>
                                            <!-- /PRODUCT PREVIEW ACTIONS -->

                                            <!-- PRODUCT ITEM -->
                                            <div class="product-item column" data-name="product"  data-id="<?php echo $row->ID; ?>">

                                                <!-- PRODUCT INFO -->
                                                <div class="product-info" id="product-info">
                                                    <a href="<?php echo base_url('product_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                        <p class="text-header"><?php echo $this->general->add3dots($row->item_name, "...", 30); ?></p>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <p class="category primary"><a href="<?php echo base_url('products/web/' . strtolower($this->general->slugify($row->p_catagory)) . '.jsf'); ?>"><?php echo ucfirst($row->p_catagory); ?></a></p>
                                                    <a href="<?php echo base_url('product_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                        <p class="price"><?php echo isset($row->item_type) && $row->item_type == "P" ? "<span>$</span>" . $row->item_price : 'Free'; ?></p>
                                                    </a>
                                                </div>
                                                <hr class="line-separator">
                                                <div class="user-rating">
                                                    <a href="<?php echo base_url('profile') . "/" . $row->created_by . '.jsf'; ?>">
                                                        <figure class="user-avatar small">
                                                            <?php
                                                            $details_user_fol_nm = sha1("profile_" . $row->user_id);
                                                            $profile_image_details = isset($row->profile_photo) ? trim($row->profile_photo) : "";

                                                            if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                                                $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                                            } else {
                                                                $profile_image_url_details = base_url() . img_path . "/user.png";
                                                            }
                                                            ?>
                                                            <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                                        </figure>
                                                        <p class="text-header tiny"><?php echo $row->created_by; ?></p>
                                                    </a>
                                                    <?php $get_comment = $this->content_model->getTotalView('theme_user_comment_product', "product_id = $row->ID AND comment_perent_id = 0"); ?>
                                                    <p class="price user_view"><span class="icon-bubble weye"></span><?php echo $get_comment; ?></p>
                                                    <?php $get_view = $this->content_model->getTotalView('theme_product_view', "p_view_pid = $row->ID"); ?>
                                                    <p class="price user_view"><span class="sl-icon icon-eye weye"></span><?php echo $get_view; ?></p>
                                                </div>
                                                <!-- /PRODUCT INFO -->
                                            </div>
                                            <!-- /PRODUCT ITEM -->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            <?php } ?>
                            <!-- /SIDEBAR ITEM -->
                        </div>
                        <!-- /SIDEBAR -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->
    <script>
        function click_reply(element) {
            $("[id^=reply_box]").hide();
            $(element).parents("#reply_comment_display").find('[id^=reply_box]').show();
        }
        function close_replay(element) {
            $(element).parents("[id^=reply_box]").hide();
            $(element).parents("#comment_reply_form")[0].reset();

        }

        function new_comment(element) {
            var valid = $("#comment_form").valid();
            if (valid) {
                var comment = $('#comment_form #comment').val();
                var product_id = $('#post_comment').data("token");
                var user_id = $('#post_comment').data("u_token");
                $.ajax({
                    url: base_url + "comment",
                    data: {comment: comment, product_id: product_id, user_id: user_id, themes_access_token: csrf_token},
                    cache: false,
                    async: false,
                    success: function (data) {
                        $("#comment_list").append(data);

                    },
                    error: function () {
                        alert('Ajax Submit Failed ...');
                    }

                });
                $("#comment_form")[0].reset();
                return false;
            }

        }
        function reply_comment(element) {
            var valid = $("#comment_reply_form").valid();
            if (valid) {
                var comment = $(element).parents("#comment_reply_form").find('#comment').val();
                var product_id = $(element).data("token");
                var user_id = $(element).data("u_token");
                var perent_id = $(element).data("perent");
                $.ajax({
                    url: base_url + "comment",
                    data: {comment: comment, product_id: product_id, user_id: user_id, perent_id: perent_id, themes_access_token: csrf_token},
                    cache: false,
                    async: false,
                    beforeSend: function () {
                        $('.loader').show();
                    },
                    success: function (data) {
                        $('.loader').hide();
                        $(element).parents("#reply_comment_display").find('#display_reply').append(data);

                    },
                    error: function () {
                        alert('Ajax Submit Failed ...');
                    }

                });
            }
            $(element).parents("#comment_reply_form")[0].reset();
            return false;
        }
        $(window).resize(function () {
            if ($(window).width() < 767) {
                $("#mysticky").removeAttr("data-sticky_column");
            } else {
                $("#mysticky").attr("data-sticky_column");
            }
        });
    </script>