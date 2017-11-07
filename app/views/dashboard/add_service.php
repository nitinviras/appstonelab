<link href="<?php echo base_url() . css_path ?>/select2.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() . js_path ?>/select2.min.js" type="text/javascript"></script>
<?php
$tag = array();
$sub_category[''] = "Select Sub Category";
if (isset($s_category) && !empty($s_category)) {
    $sub_category[$s_category['ID']] = $s_category['name'];
}
$attributes = array(
    'class' => 'rl-label required'
);
$attri = array(
    'class' => 'rl-label'
);
if (isset($edit_item) && (count($edit_item)) == 1 && !empty($id)) {
    $service_image = isset($edit_item->main_image) ? $edit_item->main_image : '';
    $category = isset($edit_item->service_category) ? $edit_item->service_category : '';
    $get_sub_category = isset($edit_item->services_sub_category) ? $edit_item->services_sub_category : '';
    $service_name = isset($edit_item->service_name) ? $edit_item->service_name : '';
    $service_description = isset($edit_item->service_description) ? $edit_item->service_description : '';
    $service_price = isset($edit_item->service_price) ? $edit_item->service_price : '';
    $response_time = isset($edit_item->user_response_time) ? $edit_item->user_response_time : '';
    $service_tags = isset($edit_item->services_tag) ? $edit_item->services_tag : '';
    $service_tags_data = explode(",", $service_tags);
} else {
    $category = $this->input->post('category');
    $get_sub_category = $this->input->post('sub_category');
    $service_name = $this->input->post('service_name');
    $service_description = $this->input->post('service_description');
    $service_price = $this->input->post('service_price');
    $response_time = $this->input->post('response_time');
    $service_tags_data = $this->input->post('service_tags');
}
if (isset($service_tag) && !empty($service_tag)) {
    foreach ($service_tag as $row) {
        $tag[$row->name] = $row->name;
    }
}
$categorys[''] = 'Select Category';
if (isset($service_category) && !empty($service_category)) {
    foreach ($service_category as $row) {
        $categorys[$row->ID] = $row->name;
    }
}
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <div class="alert alert-info">
            <strong>Info!</strong> You should contact<a href="<?php echo base_url('support.jsf'); ?>" class="alert-link"> Support team</a> if you unable to find relevant data.
        </div>
        <!-- HEADLINE -->
        <div class="headline simple primary fixed-box upalode-service add_service-resp-chang">
            <h4>Upload Services</h4>
            <button form="upload_form" class="button big dark float-right upload_button">Upload<span class="primary"> Services</span></button>
        </div>
        <!-- /HEADLINE -->
        <?php echo form_open_multipart('save_uploadservice', array('name' => 'upload_form', 'id' => 'upload_form')); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'token', 'id' => 'token', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'product_image', 'class' => ' lr_input', 'id' => 'product_image', 'value' => isset($service_image) && $service_image != '' ? $service_image : '')); ?>
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items wrap-3-1 left">
            <!-- FORM BOX ITEM -->
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6">
                    <div class="form-box-item full">
                        <h4>Services Specifications</h4>
                        <hr class="line-separator"> 
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <?php echo form_label('Select Category', 'category', $attributes); ?>
                            <label for="category" class="select-block">
                                <?php echo form_dropdown('category', $categorys, $category, array('id' => "category", "onchange" => "get_subcat(this)")) ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('category'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <?php echo form_label('Select Sub Category', 'sub_category', $attributes); ?>
                            <label for="product_type" class="select-block">
                                <?php echo form_dropdown('sub_category', $sub_category, $get_sub_category, 'id="sub_category"'); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('sub_category'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->


                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <?php echo form_label('Service Delivery Time (Enter Days)', 'response_time', $attributes); ?>
                            <?php echo form_input(array('class' => ' lr_input integer', 'id' => 'response_time', 'maxlength' => "4", 'name' => 'response_time', 'value' => "$response_time", 'placeholder' => "User Response Time")); ?>
                            <?php echo form_error('response_time'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <?php echo form_label('Service Price ($)', 'service_price', $attributes); ?>
                            <?php echo form_input(array('id' => 'service_price', 'maxlength' => "4", 'class' => ' lr_input integer', 'name' => 'service_price', 'value' => "$service_price", 'placeholder' => "Service Price  ($)")); ?>
                            <?php echo form_error('service_price'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <div class="clearfix"></div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Service Tags', 'service_tags', $attributes); ?>
                            <label for="service_tags" class="select-block">
                                <?php echo form_dropdown('service_tags[]', $tag, $service_tags_data, array('id' => "service_tags", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('service_tags'); ?>
                        </div>
<!--                        <button class="button big dark">Upload<span class="primary"> Services</span></button>-->
                    </div>
                </div>
                <!-- /COL -->

                <!-- COL -->
                <div class="col-md-6">
                    <div class="form-box-item full">
                        <h4>Services Specifications</h4>
                        <hr class="line-separator"> 

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Name of the Service (Max 100 Characters)', 'item_name', $attributes); ?>
                            <?php echo form_input(array('id' => 'service_name', 'name' => 'service_name', 'class' => ' lr_input', 'value' => "$service_name", 'placeholder' => "Name of the Service (Max 100 Characters)")); ?>
                            <?php echo form_error('service_name'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Service Description', 'service_description', $attributes); ?>
                            <?php echo form_textarea(array('class' => ' lr_input', 'id' => 'service_description', 'name' => 'service_description', 'value' => "$service_description", 'placeholder' => "Service Description")); ?>
                            <?php echo form_error('service_description'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label class="rl-label required">Upload Main Image</label>
                            <!-- UPLOAD FILE -->
                            <div class="upload-file">
                                <div class="upload-file-actions">
                                    <a href="#" class="button dark-light" id="main_browse">Upload File...</a>
                                </div>
                            </div>
                            <!-- UPLOAD FILE -->
                            <?php echo form_input(array('type' => 'file', 'id' => 'main_image', 'name' => 'main_image', 'value' => "", 'display' => 'none')); ?>
                            <?php echo form_error('main_image'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <div class="clearfix"></div>

                        <hr class="line-separator">
                        <?php if (isset($edit_item->ID) && $edit_item->main_image != '') { ?>
                            <h4>Main Image</h4>
                            <?php
                            $details_user_fol_nm = sha1("service_" . $edit_item->ID);
                            $profile_image_details = isset($edit_item->main_image) ? trim($edit_item->main_image) : "";

                            if (file_exists(FCPATH . uploads_path . '/services/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                $profile_image_url_details = base_url() . uploads_path . '/services/' . $details_user_fol_nm . '/' . $profile_image_details;
                            }
                            ?>
                            <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image" width="250px" height="200px">
                        <?php } ?>
                        <!--<hr class="line-separator">-->
                        <!--<button class="button big dark">Upload<span class="primary"> Services</span></button>-->
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
        $("#upload_form").validate({
            rules: {
                service_name: {
                    required: true,
                },
                service_description: {
                    required: true,
                },
                category: {
                    required: true
                },
                product_type: {
                    required: true
                },
                service_price: {
                    required: true
                },
                response_time: {
                    required: true
                },
                'service_tags[]': {
                    required: true
                }
            },
            messages: {
                service_name: {
                    required: "Please Enter Item Name",
                },
                service_description: {
                    required: "Please Enter Item Descripation",
                },
                category: {
                    required: "Please Select Category"
                },
                product_type: {
                    required: "Please Select Product Type"
                },
                service_price: {
                    required: "Please Enter Service Price"
                },
                response_time: {
                    required: "Please Enter Response Time"
                },
                'service_tags[]': {
                    required: "Please Select Item Tags"
                }
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
    function get_subcat(element) {
        var catid = $(element).val();
        var url = base_url + "get_category"
        if (catid) {
            $.ajax({
                type: "POST",
                url: url,
                data: {c_id: catid, themes_access_token: csrf_token},
                success: function (html) {
                    $('#sub_category').html(html);
                }
            });
        } else {
            $('#sub_category').html('<option value="">Select category first</option>');
        }
    }
</script>
<script src = "<?php echo base_url() . js_path; ?>/vendor/tinymce/js/tinymce/tinymce.min.js" ></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: "lists searchreplace",
        toolbar: "redo undo bullist numlist outdent indent searchreplace bold italic alignleft aligncenter alignright sizeselect fontselect fontsizeselect",
        height: "250",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });
    tinymce.triggerSave();
    $('#service_tags').select2({
        placeholder: 'Select Tags'
    });
</script>