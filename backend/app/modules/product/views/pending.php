<?php
include APPPATH . '/modules/views/header.php';
?>
<!-- PRODUCT LIST -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-md-12">
            <?php $this->load->view('message') ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pending Product</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-8 b-r">
                                    <div class="form-group">
                                        <div style="">
                                            <?php $productfolder = sha1("product_" . $pending->ID); ?>
                                            <img width="550" height="350" src="<?php echo admin_url . uploads_path . '/products/' . $productfolder . "/" . $pending->main_image; ?>" alt="product-image">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label readonly">Title</label>
                                        <input id="Title" name="Title" type="text" readonly="" class="readonly form-control" value="<?php echo isset($pending->item_name) ? $pending->item_name : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label readonly">Description</label>
                                        <textarea id="desc" name="desc"><?php echo $pending->item_description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label readonly">created_by</label>
                                        <input id="created_by" name="created_by" type="text" readonly="" class="readonly form-control" value="<?php echo isset($pending->created_by) ? $pending->created_by : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_open('save_review', array('name' => 'status_form', 'id' => 'status_form')); ?>
                                        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
                                        <?php echo form_input(array('type' => 'hidden', 'name' => 'user_id', 'id' => 'user_id', 'value' => isset($user_id) && $user_id != '' ? $user_id : 0)); ?>
                                        <?php
                                        $approve_radio = array(
                                            'name' => 'status',
                                            'id' => 'approve',
                                            'value' => 'Approve',
                                            'checked' => TRUE
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
                                                'value' => 'Reject'
                                            );
                                            echo form_radio($pending_radio);
                                            ?>
                                            <label for="reject" class="label-check radio-cover">
                                                <span class="radio primary"><span></span></span>
                                                Reject
                                            </label>
                                    </div>
                                    <div class="form-group review" style="display: none">
                                        <?php echo form_label('Why Reject Product??', 'item_description', array('class' => 'title')); ?>
                                        <?php echo form_textarea(array('id' => 'item_description', 'name' => 'item_description', 'placeholder' => "Why Reject Product")); ?>
                                        <?php echo form_error('item_description'); ?>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-round">Submit Review<div class="ripple-container"></div></button>
                                            <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include APPPATH . '/modules/views/footer.php'; ?>
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