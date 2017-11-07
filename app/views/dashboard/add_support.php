<?php
$attributes = array(
    'class' => 'rl-label required'
);
?>
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline simple primary fixed-box upalode-service add_service-resp-chang">
            <h4>Add Ticket</h4>
            <button form="support_ticket" class="button big dark float-right upload_button">Add<span class="primary"> Ticket</span></button>
        </div>
        <!-- /HEADLINE -->


        <?php echo form_open_multipart('save_support_ticket', array('name' => 'support_ticket', 'id' => 'support_ticket')); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'token', 'id' => 'token', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'product_image', 'class' => ' lr_input', 'id' => 'product_image', 'value' => isset($service_image) && $service_image != '' ? $service_image : '')); ?>
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items wrap-3-1 left">
            <!-- FORM BOX ITEM -->
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-12">
                    <div class="form-box-item full">
                        <h4>Support Ticket</h4>
                        <hr class="line-separator"> 


                        <div class="input-container full">
                            <?php echo form_label('Select Topic', 'topic', $attributes); ?>
                            <label for="topic" class="select-block">
                                <?php
                                $options[''] = 'Select Topic';
                                $options['Feedback'] = 'Feedback';
                                $options['General Inquiry'] = 'General Inquiry';
                                $options['Report a Problem'] = 'Report a Problem';
                                $options['Report a Problem / Access issue'] = 'Report a Problem / Access issue';
                                ?>
                                <?php echo form_dropdown('topic', $options, '', array('id' => "topic", 'name' => "topic")) ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('topic'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container full">
                            <?php echo form_label('Summary', 'address', $attributes); ?>
                            <?php echo form_textarea(array('rows' => "13", 'id' => 'summary', 'name' => 'summary', 'class' => ' lr_input', 'placeholder' => "Summary")); ?>
                            <?php echo form_error('summary'); ?>
                        </div>

                        <!-- INPUT CONTAINER -->

                        <!-- /INPUT CONTAINER -->
                        <div class="input-container full">
                            <label class="rl-label required">Upload  Image</label>
                            <!--                             UPLOAD FILE -->
                            <div class="upload-file">
                                <div class="upload-file-actions">
                                    <a href="javascript:void(0)" class="button dark-light" id="main_browse">Upload File...</a>
                                </div>
                            </div>
                            <!--UPLOAD FILE--> 
                            <?php echo form_input(array("accept" => "image/x-png,image/gif,image/jpeg", 'type' => 'file', 'id' => 'main_image', 'class' => 'lr_input', 'name' => 'main_image', 'value' => "", 'display' => 'none')); ?>
                            <?php echo form_error('main_image'); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /COL -->

            </div>
            <!-- /ROW -->
<!--            <button class="button big dark">Upload<span class="primary"> Services</span></button>-->
            <!-- /FORM BOX ITEM -->           
        </div>
        <!-- /FORM BOX ITEMS -->
        <?php echo form_close(); ?>



        <div class="clearfix"></div>
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
<script>
    $("select").on("select2:close", function (e) {
        $(this).valid();
    });
    $(".integer").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(document).ready(function () {
        $("#support_ticket").validate({
            rules: {
                topic: {
                    required: true,
                },
                summary: {
                    required: true,
                },
            },
            messages: {
                topic: {
                    required: "Please select topic",
                },
                summary: {
                    required: "Please Enter summary",
                },
            }
        });
    });
    $('#main_browse').click(function () {
        $('#main_image').trigger('click');
    });
    $('#main_image').change(function () {
        var file = $('#main_image')[0].files[0].name;
        $(this).parent().find('#main_browse').text(file);
    });

</script>