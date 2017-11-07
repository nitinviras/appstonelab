<link href="<?php echo base_url() . css_path ?>/select2.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() . js_path ?>/select2.min.js" type="text/javascript"></script>
<?php
$options = $browsers = $fileincluded = $tag = $skill_options = '';
$type_category = $this->uri->segment(2);
if ($type_category == '') {
    $type_category = isset($type) ? $type : '';
}
$cat_arr = array('ios', 'android', 'web');
if (!in_array($type_category, $cat_arr)) {
    redirect('manage_products');
}
if ($type_category == 'ios') {
    $action = 'ios_save_uploadproduct';
    $disp_img = base_url() . img_path . "/ios.png";
    $disp_cat = "Ios";
    $cond = 'category = "ios" AND status ="A"';
} else if ($type_category == 'android') {
    $action = 'android_save_uploadproduct';
    $disp_img = base_url() . img_path . "/android.png";
    $disp_cat = "Android";
    $cond = 'category = "android" AND status ="A"';
} else {
    $action = 'web_save_uploadproduct';
    $disp_img = base_url() . img_path . "/web.png";
    $disp_cat = "Web";
    $cond = 'category = "web" AND status ="A"';
}
$this->db->where($cond, FALSE, FALSE);
$query = $this->db->get('theme_user_parent_category');
$parent_category_res = $query->result();

$this->db->where($cond, FALSE, FALSE);
$skill_query = $this->db->get('theme_category_skill');
$category_skill = $skill_query->result();

$yes = $no = $na = '';
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

$options[''] = "Select Sub Category";
if (isset($product_category) && !empty($product_category)) {
    foreach ($product_category as $row) {
        $options[$row->ID] = $row->name;
    }
}
if (isset($category_skill) && !empty($category_skill)) {
    foreach ($category_skill as $row) {
        $skill_options[$row->ID] = $row->name;
    }
}

if (isset($compatible_browsers) && !empty($compatible_browsers)) {
    foreach ($compatible_browsers as $row) {
        $browsers[$row->browser_name] = $row->browser_name;
    }
}
if (isset($themeforest_file) && !empty($themeforest_file)) {
    foreach ($themeforest_file as $row) {
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
    $category = isset($edit_item->item_category) ? $edit_item->item_category : '';
    $skill = isset($edit_item->item_skill) ? explode(",", $edit_item->item_skill) : '';
    $browser = isset($edit_item->item_browser) ? $edit_item->item_browser : '';
    $browser_data = explode(",", $browser);
    $column = isset($edit_item->item_column) ? $edit_item->item_column : '';
    $resolution = isset($edit_item->item_resolution) ? $edit_item->item_resolution : '';
    $file = isset($edit_item->item_file) ? $edit_item->item_file : '';
    $file_data = explode(",", $file);
    $layout = isset($edit_item->item_layout) ? $edit_item->item_layout : '';
    $item_name = isset($edit_item->item_name) ? $edit_item->item_name : '';
    $item_description = isset($edit_item->item_description) ? $edit_item->item_description : '';
    $item_price = isset($edit_item->item_price) ? $edit_item->item_price : '';
    $demo_url = isset($edit_item->demo_url) ? $edit_item->demo_url : '';
    $item_tags = isset($edit_item->item_tag) ? $edit_item->item_tag : '';
    $item_tags_data = explode(",", $item_tags);
    if ($resolution == 'yes') {
        $yes = array('checked' => TRUE);
    } elseif ($resolution == 'no') {
        $no = array('checked' => TRUE);
    } else {
        $na = array('checked' => TRUE);
    }
} else {
    $category = $this->input->post('category');
    $parent_category = $this->input->post('parent_category');
    $browser_data = $this->input->post('browser');
    $skill = $this->input->post('skill');
    $column = $this->input->post('columns');
    $resolution = $this->input->post('resolution');
    $file_data = $this->input->post('fileincluded');
    $layout = $this->input->post('layout');
    $item_name = $this->input->post('item_name');
    $item_description = $this->input->post('item_description');
    $item_price = $this->input->post('item_price');
    $demo_url = $this->input->post('demo_url');
    $item_tags_data = $this->input->post('item_tags');
    $yes = array('checked' => TRUE);
}
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline simple primary fixed-box">
            <h4>Upload Item : <?php echo $disp_cat; ?></h4>
            <img src="<?php echo $disp_img; ?>" alt="category" width="50px" height="50px" class="pull-right" style="margin: 5px 10px 0px;"/>
            <button form="upload_form" class="button big dark full float-right upload_button">Upload<span class="primary"> Product</span></button>
        </div>
        <!-- /HEADLINE -->
        <?php echo form_open_multipart($action, array('name' => 'upload_form', 'id' => 'upload_form')); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'token', 'id' => 'token', 'value' => isset($id) && $id != '' ? $id : 0)); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'product_image', 'id' => 'product_image', 'value' => isset($product_image) && $product_image != '' ? $product_image : '')); ?>

        <div class="form-box-items">
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Item Specifications</h4>
                        <hr class="line-separator">

                        <div class="input-container">
                            <?php echo form_label('Select Category', 'parent_category', $attributes); ?>
                            <label for="parent_category" class="select-block">
                                <?php echo form_dropdown('parent_category', $sub_options, $parent_category, array("id" => "parent_category", "onchange" => "get_subcat(this)")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('parent_category'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Select Sub Category', 'category', $attributes); ?>
                            <label for="category" class="select-block">
                                <?php echo form_dropdown('category', $options, $category, 'id="category"'); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('category'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Select Skill', 'skill', $attributes); ?>
                            <label for="skill" class="select-block">
                                <?php echo form_dropdown('skill[]', $skill_options, $skill, array('id' => "skill", 'multiple' => "multiple")); ?>
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
                                <?php echo form_dropdown('fileincluded[]', $fileincluded, $file_data, array('id' => "fileincluded", 'multiple' => "multiple")); ?>
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
                            <?php echo form_label('Compatible Browsers', 'browser', $attributes); ?>
                            <label for="browser" class="select-block">
                                <?php echo form_dropdown('browser[]', $browsers, $browser_data, array('id' => "browser", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('browser[]'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('High Resolution:', '', $attributes); ?>
                            <?php
                            $yes_radio = array(
                                'name' => 'resolution',
                                'id' => 'yes',
                                'value' => 'yes',
                            );
                            echo form_radio($yes_radio, '', $yes);
                            ?>
                            <label for="yes" class="label-check radio-cover">
                                <span class="radio primary"><span></span></span>
                                Yes
                            </label>
                            <?php
                            $no_radio = array(
                                'name' => 'resolution',
                                'id' => 'no',
                                'value' => 'no'
                            );
                            echo form_radio($no_radio, '', $no);
                            ?>
                            <label for="no" class="label-check radio-cover">
                                <span class="radio primary"><span></span></span>
                                No
                            </label>
                            <?php
                            $none_radio = array(
                                'name' => 'resolution',
                                'id' => 'none',
                                'value' => 'n/a'
                            );
                            echo form_radio($none_radio, '', $na);
                            ?>
                            <label for="none" class="label-check radio-cover">
                                <span class="radio primary"><span></span></span>
                                N/A
                            </label>
                        </div>
                        <div class="input-container">
                            <?php
                            $layouts = array(
                                '' => 'Select Layout',
                                'Fixed' => 'Fixed',
                                'Liquid' => 'Liquid',
                                'Responsive' => 'Responsive',
                                'N/A' => 'N/A'
                            );
                            echo form_label('Layout', 'layout', $attributes);
                            ?>
                            <label for="layout" class="select-block">
                                <?php echo form_dropdown('layout', $layouts, $layout, 'id="layout"'); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('layout'); ?>
                        </div>

                        <!-- /INPUT CONTAINER -->
                        <div class="input-container">
                            <?php
                            $columns = array(
                                '' => 'Select Columns',
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4+' => '4+',
                                'N/A' => 'N/A'
                            );
                            echo form_label('Columns', 'columns', $attributes);
                            ?>
                            <label for="columns" class="select-block">
                                <?php echo form_dropdown('columns', $columns, $column, 'id="columns"'); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('columns'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Item Price ($)', 'item_price', $attributes); ?>
                            <?php echo form_input(array('id' => 'item_price', 'maxlength' => "4", 'name' => 'item_price', 'class' => 'lr_input integer', 'value' => "$item_price", 'placeholder' => "Item Price  ($)")); ?>
                            <?php echo form_error('item_price'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Item Tags', 'item_tags', $attributes); ?>
                            <label for="item_tags" class="select-block">
                                <?php echo form_dropdown('item_tags[]', $tag, $item_tags_data, array('id' => "item_tags", 'multiple' => "multiple")); ?>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                            <?php echo form_error('item_tags'); ?>
                        </div>
                    </div>
                </div>
                <!-- /COL -->


                <!-- FORM BOX ITEMS -->
                <!--<div class="form-box-items half">-->
                <!-- COL -->
                <div class="col-md-6">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Item Specifications</h4>
                        <hr class="line-separator">

                        <div class="input-container">
                            <?php echo form_label('Name of the Item (Max 100 Characters)', 'item_name', $attributes); ?>
                            <?php echo form_input(array('id' => 'item_name', 'name' => 'item_name', 'class' => 'lr_input', 'value' => "$item_name", 'placeholder' => "Name of the Item (Max 100 Characters)")); ?>
                            <?php echo form_error('item_name'); ?>
                        </div>
                        <div class="input-container">
                            <?php echo form_label('Item Description', 'item_description', $attributes); ?>
                            <?php echo form_textarea(array('id' => 'item_description', 'name' => 'item_description', 'value' => "$item_description", 'placeholder' => "Item Description")); ?>
                            <?php
                            if (form_error('item_description')) {
                                echo "<div class='error'>Please enter description</div>";
                            };
                            ?>
                            <?php // echo form_error('item_description');  ?>
                        </div>
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
                        <!-- INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Demo URL', 'demo_url', $attributes); ?>
                            <?php echo form_input(array('id' => 'demo_url', 'name' => 'demo_url', 'onblur' => "checkURL(this)", 'class' => 'lr_input', 'value' => "$demo_url", 'placeholder' => "Demo URL")); ?>
                            <?php echo form_error('demo_url'); ?>
                        </div>

                        <?php
                        if (isset($edit_item->ID) && $edit_item->main_image != '') {
                            $details_user_fol_nm = sha1("product_" . $edit_item->ID);
                            $profile_image_details = isset($edit_item->main_image) ? trim($edit_item->main_image) : "";

                            if (file_exists(FCPATH . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                $profile_image_url_details = base_url() . uploads_path . '/products/' . $details_user_fol_nm . '/' . $profile_image_details;
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
<!--              <button class="button big dark full" style="width: 100%;">Upload<span class="primary"> Product</span></button>-->
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
                category: {
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
                    minlength: 6,
                    maxlength: 50
                },
                item_description: {
                    required: true,
                    minlength: 6,
                    maxlength: 100
                },
                columns: {
                    required: true
                },
                layout: {
                    required: true
                },
                item_price: {
                    required: true
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
                    minlength: "Please Enter Minimum 6 Characters",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                item_description: {
                    required: "Please Enter Item Descripation",
                    minlength: "Please Enter Minimum 6 Characters",
                    maxlength: "Please Enter Maximum 100 Characters"
                },
                parent_category: {
                    required: "Please Select Category"
                },
                category: {
                    required: "Please Select Sub Category"
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
                columns: {
                    required: "Please Select Columns"
                },
                'fileincluded[]': {
                    required: "Please Select File"
                },
                layout: {
                    required: "Please Select Layout"
                },
                item_price: {
                    required: "Please Enter Product Price"
                },
                demo_url: {
                    required: "Please Enter Demo URL"
                },
                item_tags: {
                    required: "Please Enter Item Tags"
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
    function get_subcat(element) {
        var catid = $(element).val();
        var url = base_url + "get_sub_category"
        if (catid) {
            $.ajax({
                type: "POST",
                url: url,
                data: {c_id: catid, themes_access_token: csrf_token},
                success: function (html) {
                    $('#category').html(html);
                }
            });
        } else {
            $('#category').html('<option value="">Select category first</option>');
        }
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
</script>