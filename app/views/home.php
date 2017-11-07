<style>
    .category-nav.primary .slide-controltab {
        background-color: #00d7b3;
    }.slide-controltab.left {
        float: left;
    }.slide-controltab {
        width: 30px;
        height: 30px;
        border-radius: 4px;
        background-color: #535d5f;
        cursor: pointer;
        position: relative;
    }.slide-controltab:hover {
        background-color: #647072;
    }
    .slide-controltab.right {
        float: right;
    }
    .slide-controltab.left .svg-arrow {
        left: 11px;
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }.slide-controltab .svg-arrow {
        fill: #fff;
        width: 8px;
        height: 12px;
        position: absolute;
        top: 9px;
        pointer-events: none;
        cursor: pointer;
    }.slide-controltab.right .svg-arrow {
        left: 12px;
    }
    .preview-action{
        position: absolute;
        width: 100%;
    }
    @media (max-width:767px){
        .preview-action{        
            top: 40px !important;
        }
    }
</style>
<!-- BANNER -->
<div class="banner-wrap">
    <?php $this->load->view('templates/message') ?>
    <section class="banner" >
        <h5>Welcome to</h5>
        <h1>The Biggest <span>Marketplace</span></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
        <img src="<?php echo base_url() . img_path ?>/top_items.png" alt="banner-img">
    </section>
</div>
<!-- /BANNER -->
<div class="clearfix"></div>
<!-- CATEGORY NAV -->
<div class="container">
    <div class="category-nav-wrap">
        <div class="category-nav primary">
            <div class="category-tabs">
                <div class="category-tab">
                    <p>Web</p>
                </div>
                <div class="category-tab">
                    <p>Android</p>
                </div>

                <div class="category-tab">
                    <p>iOs</p>
                </div>

                <div class="category-tab">
                    <p>Services</p>
                </div>
            </div>

            <!-- SLIDE CONTROLS -->
            <div class="slide-control-wrap primary">
                <div class="slide-controltab left">
                    <!-- SVG ARROW -->
                    <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                    </svg>
                    <!-- /SVG ARROW -->
                </div>

                <div class="slide-controltab right">
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
        <div id="product-sideshow">
            <!-- PRODUCT SHOWCASE -->
            <div class="product-showcase tabbed">
                <div class="row">
                    <!-- PRODUCT LIST -->
                    <?php
                    if (isset($web_products) && $web_products > 0) {
                        foreach ($web_products as $row) {
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
                            <div class="col-md-3">
                                <div class="card my-3">
                                    <div class="product-list grid column4-wrap product-box_shadow">
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
                                </div>
                            </div>
                            <!-- /PRODUCT LIST -->
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /PRODUCT SHOWCASE -->
            <!-- PRODUCT SHOWCASE -->
            <div class="product-showcase tabbed">
                <div class="row">
                    <!-- PRODUCT LIST -->
                    <?php
                    if (isset($android_products) && $android_products > 0) {
                        foreach ($android_products as $row) {
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
                            <div class="col-md-3">
                                <div class="card my-3">
                                    <div class="product-list grid column4-wrap product-box_shadow">
                                        <!-- PRODUCT PREVIEW ACTIONS -->
                                        <div class="product-preview-actions">
                                            <!-- PRODUCT PREVIEW IMAGE -->
                                            <figure class="product-preview-image">
                                                <img src="<?php echo $product_image_url_one; ?>" alt="product-image" height="163px" data-name="product"  data-id="<?php echo $row->ID; ?>" >
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
                                        <div class="product-item column" data-name="product"  data-id="<?php echo $row->ID; ?>" >

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
                                </div>
                            </div>
                            <!-- /PRODUCT LIST -->
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /PRODUCT SHOWCASE -->

            <!-- PRODUCT SHOWCASE -->
            <div class="product-showcase tabbed">
                <div class="row">
                    <!-- PRODUCT LIST -->
                    <?php
                    if (isset($ios_products) && $ios_products > 0) {
                        foreach ($ios_products as $row) {
                            $enc_username = $this->encryption->encrypt($row->ID);
                            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                            $productfolder = sha1("product_" . $row->ID);
                            $product_image_trending = isset($row->main_image) ? $row->main_image : "";

                            if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                            } else {
                                $product_image_url = base_url() . img_path . "/default.png";
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="card my-3">
                                    <div class="product-list grid column4-wrap product-box_shadow">
                                        <!-- PRODUCT PREVIEW ACTIONS -->
                                        <div class="product-preview-actions">
                                            <!-- PRODUCT PREVIEW IMAGE -->
                                            <figure class="product-preview-image">
                                                <?php ?>
                                                <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px" data-name="product"  data-id="<?php echo $row->ID; ?>" >
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
                                        <div class="product-item column" data-name="product"  data-id="<?php echo $row->ID; ?>" >
                                            <!-- PRODUCT INFO -->
                                            <div class="product-info">
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
                                    <!-- /PRODUCT LIST -->
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /PRODUCT SHOWCASE -->

            <!-- SERVICE SHOWCASE -->
            <div class="product-showcase tabbed">
                <div class="row">
                    <?php
                    if (isset($new_services) && $new_services > 0) {
                        foreach ($new_services as $row) {
                            $enc_username = $this->encryption->encrypt($row->ID);
                            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                            $services_image_trending = isset($row->main_image) ? $row->main_image : "";
                            $servicefolder = sha1("service_" . $row->ID);

                            if (file_exists(FCPATH . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending) && $services_image_trending != "") {
                                $service_image_url = base_url() . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending;
                            } else {
                                $service_image_url = base_url() . img_path . "/default.png";
                            }
                            ?>
                            <!-- PRODUCT LIST -->
                            <div class="col-md-3">
                                <div class="card my-3">
                                    <div class="product-list grid column4-wrap product-box_shadow">
                                        <!-- PRODUCT PREVIEW ACTIONS -->
                                        <div class="product-preview-actions">
                                            <!-- PRODUCT PREVIEW IMAGE -->
                                            <figure class="product-preview-image mb-0">
                                                <img src="<?php echo $service_image_url; ?>" alt="product-image" height="163px" data-name="service"  data-id="<?php echo $row->ID; ?>" >
                                            </figure>
                                            <!-- /PRODUCT PREVIEW IMAGE -->
                                            <!-- PREVIEW ACTIONS -->
                                            <div class="preview-actions">
                                                <!-- PREVIEW ACTION -->
                                                <div class="preview-action">
                                                    <a href="<?php echo base_url('service_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                        <div class="circle tiny primary">
                                                            <span class="icon-tag"></span>
                                                        </div>
                                                    </a>
                                                    <a href="<?php echo base_url('service_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                        <p>Go to Item</p>
                                                    </a>
                                                </div>
                                                <!-- /PREVIEW ACTION -->
                                            </div>
                                            <!-- /PREVIEW ACTIONS -->
                                        </div>
                                        <!-- /PRODUCT PREVIEW ACTIONS -->
                                        <!-- PRODUCT ITEM -->
                                        <div class="product-item column" data-name="service"  data-id="<?php echo $row->ID; ?>" >
                                            <!-- PRODUCT INFO -->
                                            <div class="product-info">
                                                <a href="<?php echo base_url('service_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                    <p class="text-header"><?php echo $this->general->add3dots($row->service_name, "...", 30); ?></p>
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <p class="category primary"><a href="<?php echo base_url('services/' . strtolower($this->general->slugify($row->s_category)) . '.jsf'); ?>"><?php echo ucfirst($row->s_category); ?></a></p>
                                                <a href="<?php echo base_url('service_details.jsf') . "?token=" . $encrypted_id; ?>">
                                                    <p class="price"><span>$</span><?php echo $row->service_price; ?></p>
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
                                                <?php $get_comment = $this->content_model->getTotalView('theme_user_comment_service', "service_id = $row->ID AND comment_perent_id = 0"); ?>
                                                <p class="price user_view"><span class="icon-bubble weye"></span><?php echo $get_comment; ?></p>
                                                <?php $get_view = $this->content_model->getTotalView('theme_service_view', "s_view_sid = $row->ID"); ?>
                                                <p class="price user_view"><span class="sl-icon icon-eye weye"></span><?php echo $get_view; ?></p>
                                            </div>
                                            <!-- /PRODUCT INFO -->
                                        </div>
                                        <!-- /PRODUCT ITEM -->
                                    </div>
                                </div>
                            </div>
                            <!-- /PRODUCT LIST -->
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /PRODUCT SHOWCASE -->
        </div>
        <?php if (count($web_products) > 18 || count($android_products) > 18 || count($ios_products) > 18 || count($new_services) > 18) { ?> 
            <div class="more_products" id="product-sideshow">

            </div>
        <?php } ?>
    </div>
</div>
<?php
if ($this->session->userdata("user_id")) {
    if (isset($follwer_feed) && count(array_filter($follwer_feed)) > 0) {
        ?>
        <div class="container">
            <div class="product-showcase">
                <!-- HEADLINE -->
                <div class="headline">
                    <h4>Your Followers Feed</h4>
                    <!-- SLIDE CONTROLS -->
                    <div class="slide-control-wrap">
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
                <!-- /HEADLINE -->

                <!-- PRODUCT LIST -->
                <div id="pl-5" class="product-list grid column4-wrap owl-carousel">
                    <?php
                    foreach ($follwer_feed as $value) {
                        foreach ($value as $row) {
                            $enc_username = $this->encryption->encrypt($row->ID);
                            $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                            $productfolder = sha1("product_" . $row->ID);
                            $product_image_trending = isset($row->main_image) ? $row->main_image : "";

                            if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                            } else {
                                $product_image_url = base_url() . img_path . "/default.png";
                            }
                            ?>
                            <!--PRODUCT ITEM -->
                            <div class = "product-list grid column4-wrap product-box_shadow foll_slider">
                                <!--PRODUCT PREVIEW ACTIONS -->
                                <div class = "product-preview-actions">
                                    <!--PRODUCT PREVIEW IMAGE -->
                                    <figure class = "product-preview-image">
                                        <?php ?>
                                        <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px" data-name="product"  data-id="<?php echo $row->ID; ?>" >
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
                                <div class="product-item column" data-name="product"  data-id="<?php echo $row->ID; ?>" >
                                    <!-- PRODUCT INFO -->
                                    <div class="product-info">
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
                            <!-- /PRODUCT ITEM -->
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- PRODUCT LIST -->
            </div>
        </div>
        <?php
    }
}
?>
<!-- /PRODUCT SIDESHOW -->