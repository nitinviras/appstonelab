<?php
include APPPATH . '/modules/views/header.php';
?>
<!-- PRODUCT LIST -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mycard">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Pending Product</h4>
                    <div class="card-content">
                        <!-- PRODUCT ITEM -->
                        <div class="product-item column">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <?php $servicefolder = sha1("service_" . $pending->ID);
                            ?>
                            <img src="<?php echo admin_url . uploads_path . '/services/' . $servicefolder . "/" . $pending->main_image; ?>" alt="product-image">
                            <!-- /PRODUCT PREVIEW IMAGE -->

                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <a href="<?php echo admin_url . "item_page_v1"; ?>">
                                    <p class="text-header"><?php echo $pending->service_name; ?></p>
                                </a>
                                <p class="product-description"><?php echo $pending->service_description; ?></p>
                            </div>
                            <div>
                                <p> <span class="text-header">Category&nbsp;:&nbsp;</span><span class="category primary"><?php echo $pending->services_file_type; ?></span></p>
                            </div>
                            <div class="category primary"><span class="text-header">Status&nbsp;:&nbsp;</span><?php echo isset($pending->service_status) && $pending->service_status == 'A' ? 'Approve' : 'Pending'; ?><span class="price"><span>$</span><?php echo $pending->service_price; ?></span></div>
                        </div>
                        <!-- /PRODUCT INFO -->
                        <hr class="line-separator">

                        <!-- USER RATING -->
                        <div class="user-rating">
                            <div class="col-sm-6">
                                <a href="<?php echo admin_url . "author_profile"; ?>">
                                    <figure class="user-avatar small">
                                        <?php
                                        $details_user_fol_nm = sha1("profile_" . $pending->user_id);
                                        $profile_image_details = isset($user_details->profile_photo) ? trim($user_details->profile_photo) : "";
                                        if ($profile_image_details != "") {
                                            $profile_image_url_details = admin_url . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                        } else {
                                            $profile_image_url_details = admin_url . img_path . "/avatars/avatar_01.png";
                                        }
                                        ?>
                                        <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                    </figure>
                                    <p class="text-header tiny"><?php echo $pending->created_by; ?></p>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <?php echo form_open('save_service_review', array('name' => 'status_form', 'id' => 'status_form')); ?>
                                <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
                                <?php echo form_input(array('type' => 'hidden', 'name' => 'user_id', 'id' => 'user_id', 'value' => isset($user_id) && $user_id != '' ? $user_id : 0)); ?>
                                <table>
                                    <tr>
                                        <td><?php
                                            $approve_radio = array(
                                                'name' => 'status',
                                                'id' => 'approve',
                                                'value' => 'Approve',
                                            );
                                            echo form_radio($approve_radio);
                                            ?>
                                            <label for="approve" class="label-check radio-cover">
                                                <span class="radio primary"><span></span></span>
                                                Approve
                                            </label></td>
                                        <td><?php
                                            $pending_radio = array(
                                                'name' => 'status',
                                                'id' => 'reject',
                                                'value' => 'Reject',
                                                'checked' => TRUE
                                            );
                                            echo form_radio($pending_radio);
                                            ?>
                                            <label for="reject" class="label-check radio-cover">
                                                <span class="radio primary"><span></span></span>
                                                Reject
                                            </label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button class="btn btn-primary btn-round">Submit Review<div class="ripple-container"></div></button></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="review col-sm-12 col-xs-12">
                                <?php echo form_label('Why Reject Product??', 'item_description', array('class' => 'title')); ?>
                                <?php echo form_textarea(array('id' => 'item_description', 'name' => 'item_description', 'placeholder' => "Why Reject Product")); ?>
                                <?php echo form_error('item_description'); ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <!-- /USER RATING -->
                    </div>
                    <!-- /PRODUCT ITEM -->
                </div>
                <!-- /PRODUCT LIST -->
            </div>
            <!-- /PRODUCT LIST -->
        </div>
    </div>
</div>
</div>
<?php include APPPATH . '/modules/views/footer.php';
?>
<script src = "<?php echo base_url() . js_path; ?>/tinymce/js/tinymce/tinymce.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#reject").click(function () {
            $(".review").show();
        });
        $("#approve").click(function () {
            $(".review").hide();
        });
    });
    tinymce.init({
        selector: 'textarea',
        plugins: "lists searchreplace",
        toolbar: "redo undo bullist numlist outdent indent searchreplace bold italic alignleft aligncenter alignright sizeselect fontselect fontsizeselect",
        height: "400",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });
    tinymce.triggerSave();
</script>