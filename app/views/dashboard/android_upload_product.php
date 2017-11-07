<link href="<?php echo base_url() . css_path ?>/select2.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() . js_path ?>/select2.min.js" type="text/javascript"></script>
<?php
$free = $paid = '';
$browsers = $tag = $fileincluded = $skill_options = array();
$type_category = $this->uri->segment(2);
if ($type_category == '') {
    $type_category = isset($type) ? $type : '';
}
$cat_arr = array('ios', 'android', 'web');
if (!in_array($type_category, $cat_arr)) {
    redirect('manage_products');
}
$cond = 'category = "android" AND status ="A"';
$this->db->where($cond, FALSE, FALSE);
$query = $this->db->get('theme_user_parent_category');
$parent_category_res = $query->result();

$this->db->where($cond, FALSE, FALSE);
$skill_query = $this->db->get('theme_category_skill');
$category_skill = $skill_query->result();

$this->db->where($cond, FALSE, FALSE);
$browser_query = $this->db->get('theme_user_compatible_browsers');
$category_browser = $browser_query->result();

$this->db->where($cond, FALSE, FALSE);
$fileincluded_query = $this->db->get('theme_themeforest_file');
$category_fileincluded = $fileincluded_query->result();

$attributes = array(
    'class' => 'rl-label required'
);
$attri = array(
    'class' => 'rl-label'
);
$sub_options[''] = 'Select Category';
if (isset($parent_category_res) && !empty($parent_category_res)) {
    foreach ($parent_category_res as $row) {
        $sub_options[$row->ID] = $row->title;
    }
}

if (isset($category_skill) && !empty($category_skill)) {
    foreach ($category_skill as $row) {
        $skill_options[$row->ID] = $row->name;
    }
}

if (isset($category_browser) && !empty($category_browser)) {
    foreach ($category_browser as $row) {
        $browsers[$row->browser_name] = $row->browser_name;
    }
}
if (isset($category_fileincluded) && !empty($category_fileincluded)) {
    foreach ($category_fileincluded as $row) {
        $fileincluded[$row->file_name] = $row->file_name;
    }
}
if (isset($product_tag) && !empty($product_tag)) {
    foreach ($product_tag as $row) {
        $tag[$row->name] = $row->name;
    }
}
if (isset($edit_item) && (count($edit_item)) == 1 && !empty($id)) {
    $product_image = isset($edit_item->main_image) ? $edit_item->main_image : '';
    $parent_category = isset($edit_item->item_parent_category) ? $edit_item->item_parent_category : '';
    $skill = isset($edit_item->item_skill) ? explode(",", $edit_item->item_skill) : '';
    $browser = isset($edit_item->item_browser) ? $edit_item->item_browser : '';
    $browser_data = explode(",", $browser);
    $file = isset($edit_item->item_file) ? $edit_item->item_file : '';
    $file_data = explode(",", $file);
    $item_name = isset($edit_item->item_name) ? $edit_item->item_name : '';
    $item_description = isset($edit_item->item_description) ? $edit_item->item_description : '';
    $item_price = isset($edit_item->item_price) ? $edit_item->item_price : '';
    $item_type = isset($edit_item->item_type) ? $edit_item->item_type : '';
    $demo_url = isset($edit_item->demo_url) ? $edit_item->demo_url : '';
    $download_url = isset($edit_item->download_url) ? $edit_item->download_url : '';
    $purchase_url = isset($edit_item->purchase_url) ? $edit_item->purchase_url : '';
    $item_tags = isset($edit_item->item_tag) ? $edit_item->item_tag : '';
    $item_tags_data = explode(",", $item_tags);
    if ($item_type == 'P') {
        $paid = array('checked' => TRUE);
    } else {
        $free = array('checked' => TRUE);
    }
} else {
    $parent_category = $this->input->post('parent_category');
    $browser_data = $this->input->post('browser');
    $skill = $this->input->post('skill');
    $file_data = $this->input->post('fileincluded');
    $item_name = $this->input->post('item_name');
    $item_description = $this->input->post('item_description');
    $item_price = $this->input->post('item_price');
    $demo_url = $this->input->post('demo_url');
    $download_url = $this->input->post('download_url');
    $purchase_url = $this->input->post('purchase_url');
    $item_tags_data = $this->input->post('item_tags');
    $yes = array('checked' => TRUE);
    $paid = array('checked' => TRUE);
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
        <div class="headline simple primary fixed-box upalode-service">
            <h4>Upload Product : Android</h4>
            <img src="<?php echo base_url() . img_path . "/android.png"; ?>" alt="category" width="50px" height="50px" class="pull-right" style="margin: 5px 10px 0px;"/>
            <button form="upload_form" class="button big dark full float-right upload_button">Upload<span class="primary"> Item</span></button>
        </div>
        <!-- /HEADLINE -->
        <?php echo form_open_multipart('android_save_uploadproduct', array('name' => 'upload_form', 'id' => 'upload_form')); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'token', 'id' => 'token', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'product_image', 'id' => 'product_image', 'value' => isset($product_image) && $product_image != '' ? $product_image : '')); ?>

        <div class="form-box-items">
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Product Specifications</h4>
                        <hr class="line-separator">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Select Category', 'parent_category', $attributes); ?>
                            <label for="parent_category" class="select-block">
                                <?php echo form_dropdown('parent_category', $sub_options, $parent_category, array('require' => '' ,"id" => "parent_category", "onchange" => "get_subcat(this)")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('parent_category'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Select Skill', 'skill', $attributes); ?>
                            <label for="skill" class="select-block">
                                <?php echo form_dropdown('skill[]', $skill_options, $skill, array('require' => '' ,'id' => "skill", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('skill[]'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Files Included', 'fileincluded', $attributes); ?>
                            <label for="fileincluded" class="select-block">
                                <?php echo form_dropdown('fileincluded[]', $fileincluded, $file_data, array('require' => '' ,'id' => "fileincluded", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('fileincluded[]'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Compatible Software Version', 'browser', $attributes); ?>
                            <label for="browser" class="select-block">
                                <?php echo form_dropdown('browser[]', $browsers, $browser_data, array('require' => '' ,'id' => "browser", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('browser[]'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Item Tags', 'item_tags', $attributes); ?>
                            <label for="item_tags" class="select-block">
                                <?php echo form_dropdown('item_tags[]', $tag, $item_tags_data, array('require' => '' ,'id' => "item_tags", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('item_tags'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Item Type:', '', $attributes); ?>
                            <?php
                            $paid_radio = array(
                                'name' => 'item_type',
                                'id' => 'paid',
                                'value' => 'P',
                            );
                            echo form_radio($paid_radio, '', $paid);
                            ?>
                            <label for="paid" class="label-check radio-cover">
                                <span class="radio primary"><span></span></span>
                                Paid
                            </label>
                            <?php
                            $free_radio = array(
                                'name' => 'item_type',
                                'id' => 'free',
                                'value' => 'F'
                            );
                            echo form_radio($free_radio, '', $free);
                            ?>
                            <label for="free" class="label-check radio-cover">
                                <span class="radio primary"><span></span></span>
                                Free
                            </label>
                        </div>
                        <div class="input-container item_price">
                            <?php echo form_label('Item Price ($)', 'item_price', $attributes); ?>
                            <?php echo form_input(array('require' => '' ,'id' => 'item_price', 'maxlength' => "4", 'name' => 'item_price', 'class' => 'lr_input integer', 'value' => "$item_price", 'placeholder' => "Item Price  ($)")); ?>
                            <?php echo form_error('item_price'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container download_url" style="display: none;">
                            <?php echo form_label('Download URL', 'download_url', $attributes); ?>
                            <?php echo form_input(array('require' => '' ,'id' => 'download_url', 'name' => 'download_url', 'onblur' => "checkURL(this)", 'class' => 'lr_input', 'value' => "$download_url", 'placeholder' => "Download URL")); ?>
                            <?php echo form_error('download_url'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container purchase_url">
                            <?php echo form_label('Purchase URL', 'purchase_url', $attributes); ?>
                            <?php echo form_input(array('require' => '' ,'id' => 'purchase_url', 'name' => 'purchase_url', 'onblur' => "checkURL(this)", 'class' => 'lr_input', 'value' => "$purchase_url", 'placeholder' => "Purchase URL")); ?>
                            <?php echo form_error('purchase_url'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->
                    </div>
                </div>
                <!-- /COL -->


                <!-- FORM BOX ITEMS -->
                <!--<div class="form-box-items half">-->
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Product Specifications</h4>
                        <hr class="line-separator">

                        <div class="input-container">
                            <?php echo form_label('Name of the Item (Max 100 Characters)', 'item_name', $attributes); ?>
                            <?php echo form_input(array('require' => '' ,'id' => 'item_name', 'name' => 'item_name', 'class' => 'lr_input', 'value' => "$item_name", 'placeholder' => "Name of the Item (Max 100 Characters)")); ?>
                            <?php echo form_error('item_name'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Item Description', 'item_description', $attributes); ?>
                            <?php echo form_textarea(array('require' => '' ,'id' => 'item_description', 'name' => 'item_description', 'value' => "$item_description", 'placeholder' => "Item Description")); ?>
                            <?php
                            if (form_error('item_description')) {
                                echo "<div class='error'>Please enter description</div>";
                            };
                            ?>
                            <?php // echo form_error('item_description');  ?>
                        </div>
                        <!-- INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Demo URL', 'demo_url', $attributes); ?>
                            <?php echo form_input(array('require' => '' ,'id' => 'demo_url', 'name' => 'demo_url', 'onblur' => "checkURL(this)", 'class' => 'lr_input', 'value' => "$demo_url", 'placeholder' => "Demo URL")); ?>
                            <?php echo form_error('demo_url'); ?>
                        </div>
                        <!-- INPUT CONTAINER -->


                        <div class="input-container">
                            <label class="rl-label required">Upload Main Image (Size 590 X 300)</label>
                            <!-- UPLOAD FILE -->
                            <div class="upload-file">
                                <div class="upload-file-actions">
                                    <a href="#" class="button dark-light" id="main_browse">Upload File...</a>
                                </div>
                            </div>
                            <!-- UPLOAD FILE -->
                            <?php echo form_input(array("accept" => "image/x-png,image/gif,image/jpeg", 'type' => 'file', 'id' => 'main_image', 'class' => 'lr_input', 'name' => 'main_image', 'value' => "", 'display' => 'none')); ?>
                            <?php echo form_error('main_image'); ?>
                        </div>
                        <?php
                        if (isset($edit_item->ID) && $edit_item->main_image != '') {
                            $details_user_fol_nm = sha1("product_" . $edit_item->ID);
                            $profile_image_details = isset($edit_item->main_image) ? trim($edit_item->main_image) : "";

                            if (file_exists(FCPATH . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                $profile_image_url_details = base_url() . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details;
                            } else {
                                $profile_image_url_details = base_url() . img_path . "/default.png";
                            }
                            ?>
                            <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image" width="250px" height="200px">
                        <?php }
                        ?>


                    </div>

                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->
<!--              <button class="button big dark full" style="width: 100%;">Upload<span class="primary"> Item</span></button>-->
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
            ignore: [],
            rules: {
                parent_category: {
                    required: true
                },
                'skill[]': {
                    required: true
                },
                'fileincluded[]': {
                    required: true
                },
                'browser[]': {
                    required: true
                },
                item_name: {
                    required: true,
                },
                item_description: {
                    required: true,
                },
                demo_url: {
                    required: true
                },
                'item_tags[]': {
                    required: true
                }

            },
            messages: {
                item_name: {
                    required: "Please Enter Item Name",
                },
                item_description: {
                    required: "Please Enter Item Descripation",
                },
                parent_category: {
                    required: "Please Select Category"
                },
                'skill[]': {
                    required: "Please Select Skill"
                },
                'browser[]': {
                    required: "Please Select Browser"
                },
                'item_tags[]': {
                    required: "Please Select Item Tag"
                },
                'fileincluded[]': {
                    required: "Please Select File"
                },
                download_url: {
                    required: "Please Enter Download URL"
                },
                purchase_url: {
                    required: "Please Enter purchase URL"
                },
                item_price: {
                    required: "Please Enter Price"
                },
                demo_url: {
                    required: "Please Enter Demo URL"
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
<script src = "<?php echo base_url() . js_path; ?>/vendor/tinymce/js/tinymce/tinymce.min.js" ></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: "lists searchreplace",
        toolbar: "redo undo bullist numlist outdent indent searchreplace bold italic alignleft aligncenter alignright sizeselect fontselect fontsizeselect",
        height: "430",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });
    tinymce.triggerSave();
    //Enter URL Check 
    function checkURL(abc) {
        var string = abc.value;
        if (!~string.indexOf("http")) {
            string = "http://" + string;
        }
        abc.value = string;
        return abc;
    }
    $('#browser').select2({
        placeholder: 'Select Browsers'
    });
    $('#skill').select2({
        placeholder: 'Select Skill'
    });
    $('#fileincluded').select2({
        placeholder: 'Select File Included'
    });
    $('#item_tags').select2({
        placeholder: 'Select Tags'
    });
    $(document).ready(function () {
        $("#paid").click(function () {
            $(".download_url").hide();
            $(".item_price").show();
            $(".purchase_url").show();
        });
        $("#free").click(function () {
            $(".download_url").show();
            $(".item_price").hide();
            $(".purchase_url").hide();
        });
        if ($("#paid").is(':checked')) {
            $('#item_price').attr('required', true);
            $('#purchase_url').attr('required', true);
            $('#download_url').attr('required', false);
            $(".purchase_url").show();
            $(".download_url").hide();
        } else {
            $('#item_price').attr('required', false);
            $('#item_price').removeAttr('required');
            $('#purchase_url').removeAttr('required');
            $('#download_url').attr('required', true);
            $(".purchase_url").hide();
            $(".item_price").hide();
            $(".download_url").show();
        }

        $('input[name="item_type"]').change(function () {
            if ($("#paid").is(':checked')) {
                $('#item_price').attr('required', true);
                $('#purchase_url').attr('required', true);
            } else {
                $('#item_price').removeAttr('required');
                $('#purchase_url').removeAttr('required');
                $('#download_url').attr('required', true);
            }
        });
    });
</script>