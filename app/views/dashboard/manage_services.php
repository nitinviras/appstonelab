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
            <h4>Manage Services (<?php echo $services; ?>)</h4>
        </div>
        <!-- /HEADLINE -->

        <!-- PRODUCT LIST -->
        <?php $this->load->view('templates/message') ?>
        <div class="product-list grid column4-wrap">
            <div class="row">
                <div class="col-md-4">
                    <div class="card my-3 p-2 product-box_shadow">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <a href="<?php echo base_url('add_service'); ?>">
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
                                <p class="text-header">Upload New Services</p>
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
                    $services_image_trending = isset($row->main_image) ? $row->main_image : "";
                    $servicefolder = sha1("service_" . $row->ID);

                    if (file_exists(FCPATH . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending) && $services_image_trending != "") {
                        $service_image_url = base_url() . uploads_path . '/services/' . $servicefolder . '/' . $services_image_trending;
                    } else {
                        $service_image_url = base_url() . img_path . "/user.png";
                    }
                    ?>
                    <div class="col-md-4">
                        <div class="card my-3 p-2 product-box_shadow">
                            <!-- PRODUCT PREVIEW ACTIONS -->
                            <div class="product-preview-actions">
                                <!-- PRODUCT PREVIEW IMAGE -->
                                <figure class="product-preview-image">
                                    <img src="<?php echo $service_image_url; ?>" alt="product-image" height="163px">
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
                                        <a href="<?php echo base_url('add_service') . "?token=" . $encrypted_id; ?>">Edit Service</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo base_url('service_delete') . "?token=" . $encrypted_id; ?>">Delete</a>
                                    </li>
                                </ul>
                                <!-- /DROPDOWN -->
                            </div>
                            <!-- /PRODUCT PREVIEW ACTIONS -->
                            <!-- PRODUCT ITEM -->
                            <div class="product-item column">
                                <!-- PRODUCT INFO -->
                                <div class="product-info">
                                    <a href="<?php echo base_url('service_details') . "?token=" . $encrypted_id; ?>">
                                        <p class="text-header"><?php echo $this->general->add3dots($row->service_name, "...", 30); ?></p>
                                    </a>
                                </div>
                                <hr class="line-separator">
                                <div class="category primary"><span class="text-header">Status&nbsp;:&nbsp;</span><?php echo isset($row->service_status) && $row->service_status == 'A' ? 'Approve' : 'Pending'; ?></div>
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