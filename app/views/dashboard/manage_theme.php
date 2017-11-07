<style>
    .button.theme {
        font-size: 1em;
        line-height: 35px;
        width: 95px;
        display: inline-block;
    }
    .theme_active{
        float: right;
    }

</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline filter primary">
            <h4>Manage Themes (4)</h4>
        </div>
        <!-- /HEADLINE -->

        <!-- PRODUCT LIST -->
        <?php $this->load->view('templates/message') ?>
        <div class="product-list grid column4-wrap">
            <!-- ROW -->
            <div class="row my-3">
                <!-- COL -->
                <div class="col-md-4">  
                    <div class="card my-3 p-2">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image">
                                <?php
                                $row = '';
                                $productfolder = sha1("product_" . $row);
                                $product_image_trending = isset($row) ? $row : "";

                                if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                    $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                                } else {
                                    $product_image_url = base_url() . img_path . "/default.png";
                                }
                                ?>
                                <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->
                        <!-- PRODUCT ITEM -->
                        <div class="product-item column">

                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <p class="text-header">Theme1</p>
                            </div>
                            <hr class="line-separator">
                            <!--<span class="theme_active"><button class="button theme primary th_preview" data-toggle="modal" data-url="http://theme1.themeshub.site/" onclick="get_url(this);" data-target="#preview">Preview</button></span>-->
                            <span class="theme_active"><a class="button theme primary th_preview" href="http://theme1.themeshub.site/" target="_blank">Preview</a></span>
                            <span>
                                <?php
                                if ($activation->theme_name == 'theme1') {
                                    $disp_button_text = 'Activated!';
                                } else {
                                    $disp_button_text = 'Active';
                                }
                                ?>
                                <button class="button theme primary th_active" data-theme="theme1" data-user_id="<?php echo $this->session->userdata('user_id')  ?>"><?php echo $disp_button_text;  ?></button>
                            </span>
                            <!-- /PRODUCT INFO -->

                        </div>
                        <!-- /PRODUCT ITEM -->
                    </div>
                </div>
                <!-- /COL -->
                <!-- COL -->
                <div class="col-md-4">
                    <div class="card my-3 p-2">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image">
                                <?php
                                $row = '';
                                $productfolder = sha1("product_" . $row);
                                $product_image_trending = isset($row) ? $row : "";

                                if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                    $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                                } else {
                                    $product_image_url = base_url() . img_path . "/default.png";
                                }
                                ?>
                                <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->
                        <!-- PRODUCT ITEM -->
                        <div class="product-item column">

                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <p class="text-header">Theme2</p>
                            </div>
                            <hr class="line-separator">
                            <!--<span class="theme_active"><button class="button theme primary th_preview" data-toggle="modal" data-target="#preview" data-url="http://theme2.themeshub.site/" onclick="get_url(this);">Preview</button></span>-->
                            <span class="theme_active"><a class="button theme primary th_preview" href="http://theme2.themeshub.site/" target="_blank">Preview</a></span>
                            <span>
                                <?php
                                if ($activation->theme_name == 'theme2') {
                                    $disp_button_text = 'Activated!';
                                } else {
                                    $disp_button_text = 'Active';
                                }
                                ?>
                                <button class="button theme primary th_active" data-theme="theme2" data-user_id="<?php echo $this->session->userdata('user_id') ?>"><?php echo $disp_button_text; ?></button>
                            </span>
                            <!-- /PRODUCT INFO -->

                        </div>
                        <!-- /PRODUCT ITEM -->
                    </div>
                </div>
                <!-- /COL -->
                <!-- COL -->
                <div class="col-md-4">
                    <div class="card my-3 p-2">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image">
                                <?php
                                $row = '';
                                $productfolder = sha1("product_" . $row);
                                $product_image_trending = isset($row) ? $row : "";

                                if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                    $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                                } else {
                                    $product_image_url = base_url() . img_path . "/default.png";
                                }
                                ?>
                                <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->
                        <!-- PRODUCT ITEM -->
                        <div class="product-item column">

                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <p class="text-header">Theme3</p>
                            </div>
                            <hr class="line-separator">
                            <?php $class = 'themes1'; ?>
                            <!--<span class="theme_active"><button class="button theme primary th_preview" data-toggle="modal" data-target="#preview" data-url="http://theme3.themeshub.site/" onclick="get_url(this);">Preview</button></span>-->
                            <span class="theme_active"><a class="button theme primary th_preview" href="http://theme3.themeshub.site/" target="_blank">Preview</a></span>
                            <span>
                                <?php
                                if ($activation->theme_name == 'theme3') {
                                    $disp_button_text = 'Activated!';
                                } else {
                                    $disp_button_text = 'Active';
                                }
                                ?>
                                <button class="button theme primary th_active" data-theme="theme3" data-user_id="<?php echo $this->session->userdata('user_id') ?>"><?php echo $disp_button_text; ?></button>
                            </span>
                            <!-- /PRODUCT INFO -->

                        </div>
                        <!-- /PRODUCT ITEM -->
                    </div>
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->

            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-4">
                    <div class="card my-3 p-2">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image">
                                <?php
                                $row = '';
                                $productfolder = sha1("product_" . $row);
                                $product_image_trending = isset($row) ? $row : "";

                                if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                    $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                                } else {
                                    $product_image_url = base_url() . img_path . "/default.png";
                                }
                                ?>
                                <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->
                        <!-- PRODUCT ITEM -->
                        <div class="product-item column">

                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <p class="text-header">Theme4</p>
                            </div>
                            <hr class="line-separator">
                            <!--<span class="theme_active"><button class="button theme primary th_preview" data-toggle="modal" data-target="#preview" data-url="http://theme4.themeshub.site/" onclick="get_url(this);">Preview</button></span>-->
                            <span class="theme_active"><a class="button theme primary th_preview" href="http://theme4.themeshub.site/" target="_blank">Preview</a></span>
                            <span>
                                <?php
                                if ($activation->theme_name == 'theme4') {
                                    $disp_button_text = 'Activated!';
                                } else {
                                    $disp_button_text = 'Active';
                                }
                                ?>
                                <button class="button theme primary th_active" data-theme="theme4" data-user_id="<?php echo $this->session->userdata('user_id') ?>"><?php echo $disp_button_text; ?></button>
                            </span>
                            <!-- /PRODUCT INFO -->

                        </div>
                        <!-- /PRODUCT ITEM -->
                    </div>
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->
        </div>
        <!-- /PRODUCT LIST -->

        <div class="clearfix"></div>
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
<script src="<?php echo base_url() . js_path; ?>/managethemes.js" type="text/javascript"></script>