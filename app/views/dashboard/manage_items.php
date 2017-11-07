<?php
$username = $this->session->userdata('username');
$user_id = $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline filter primary">
            <h4>Manage Items (<?php echo $products; ?>)</h4>
        </div>
        <!-- /HEADLINE -->

        <!-- PRODUCT LIST -->
        <?php $this->load->view('templates/message') ?>
        <div class="product-list grid column4-wrap">
            <div class="row">
                <div class="col-md-4">
                    <div class="card my-3 p-2 product-box_shadow">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <a href="#upload_new_item" class="upload_new_item">

                            <div class="product-preview-actions">
                                <!-- PRODUCT PREVIEW IMAGE -->
                                <figure class="product-preview-image">
                                    <img src="<?php echo base_url() . img_path ?>/dashboard/uploadnew-bg.jpg" alt="product-image">
                                </figure>
                                <!-- /PRODUCT PREVIEW IMAGE -->
                            </div>
                        </a>
                        <!-- /PRODUCT PREVIEW ACTIONS -->
                        <!-- PRODUCT ITEM -->
                        <div class="product-item upload-new column">
                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <p class="text-header">Upload New Item</p>
                            </div>
                            <!-- /PRODUCT INFO -->
                        </div>
                        <!-- /PRODUCT ITEM -->
                    </div>
                </div>


                <?php
                foreach ($allrecord as $row) {
                    $enc_username = $this->encryption->encrypt($row->ID);
                    $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                    ?>
                    <div class="col-md-4">
                        <div class="card my-3 p-2 product-box_shadow">
                            <!-- PRODUCT PREVIEW ACTIONS -->
                            <div class="product-preview-actions">
                                <!-- PRODUCT PREVIEW IMAGE -->
                                <figure class="product-preview-image">
                                    <?php
                                    $productfolder = sha1("product_" . $row->ID);
                                    $product_image_trending = isset($row->main_image) ? $row->main_image : "";
                                    $product_parent_category = isset($row->item_main_category) ? $row->item_main_category : "";
                                    if ($product_parent_category == 'web') {
                                        $form_url = 'web_upload_product';
                                    } else if ($product_parent_category == 'android') {
                                        $form_url = 'android_upload_product';
                                    } else {
                                        $form_url = 'ios_upload_product';
                                    }
                                    if (file_exists(FCPATH . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending) && $product_image_trending != "") {
                                        $product_image_url = base_url() . uploads_path . '/products/' . $productfolder . '/' . $product_image_trending;
                                    } else {
                                        $product_image_url = base_url() . img_path . "/default.png";
                                    }
                                    ?>
                                    <img src="<?php echo $product_image_url; ?>" alt="product-image" height="163px">
                                </figure>
                                <!-- /PRODUCT PREVIEW IMAGE -->

                                <!-- PRODUCT SETTINGS -->
                                <div class="product-settings primary dropdown-handle">
                                    <span class="sl-icon icon-settings"></span>
                                </div>
                                <!-- /PRODUCT SETTINGS -->

                                <!-- DROPDOWN -->
                                <ul class="dropdown small hover-effect closed">
                                    <li class="dropdown-item">
                                        <!-- DP TRIANGLE -->
                                        <div class="dp-triangle"></div>
                                        <!-- DP TRIANGLE -->
                                        <?php
                                        $enc_username = $this->encryption->encrypt($row->ID);
                                        $encrypted_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
                                        ?>
                                        <a href="<?php echo base_url($form_url) . "/" . $product_parent_category . "?token=" . $encrypted_id; ?>">Edit Product</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo base_url('uploadproduct_delete') . "?token=" . $encrypted_id; ?>">Delete</a>
                                    </li>
                                </ul>
                                <!-- /DROPDOWN -->
                            </div>
                            <!-- /PRODUCT PREVIEW ACTIONS -->
                            <!-- PRODUCT ITEM -->
                            <div class="product-item column">

                                <!-- PRODUCT INFO -->
                                <div class="product-info">
                                    <a href="<?php echo base_url('product_details') . "?token=" . $encrypted_id; ?>">
                                        <p class="text-header"><?php echo $this->general->add3dots($row->item_name, "...",30); ?></p>
                                    </a>
                                </div>
                                <hr class="line-separator">
                                <div class="product-info">
                                    <div class="category primary" style="margin-top: 10px;"><span class="text-header">Status&nbsp;:&nbsp;</span><?php echo isset($row->item_status) && $row->item_status == 'A' ? 'Approve' : 'Pending'; ?></div>
                                    <p class="price"><span><img src="<?php echo base_url() . img_path . "/" . $row->item_main_category . ".png"; ?>" alt="category" width="28px" height="28px" class="pull-right" /></span></p>
                                </div>
                                <!-- /PRODUCT INFO -->

                            </div>
                            <!-- /PRODUCT ITEM -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /PRODUCT LIST -->

        <div class="clearfix"></div>
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->

<script>
    $(document).ready(function () {
        $("#product-info").find('li').css({"color": "#888", "font-size": "0.9em", "font-weight": "600", "line-height": "1.71429em"});
    });
</script>