<?php
$id = '';
$user_id = $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);
$username = $this->session->userdata('username');
if (count($user3) > 0 && !empty($user3)) {
    $id = isset($user3->ID) ? $user3->ID : 0;
    $first_name = isset($user3->first_name) ? $user3->first_name : '';
    $last_name = isset($user3->last_name) ? $user3->last_name : '';
    $company_name = isset($user3->company_name) ? $user3->company_name : '';
    $email_address2 = isset($user3->email) ? $user3->email : '';
    $zipcode = isset($user3->zipcode) ? $user3->zipcode : '';
    $city = isset($user3->city) ? $user3->city : '';
    $state = isset($user3->state) ? $user3->state : '';
    $country = isset($user3->country) ? $user3->country : '';
    $address = isset($user3->address) ? $user3->address : '';
    $notes = isset($user3->note) ? $user3->note : '';
    $first_name2 = isset($user4->first_name) ? $user4->first_name : '';
    $last_name2 = isset($user4->last_name) ? $user4->last_name : '';
    $company_name2 = isset($user4->company_name) ? $user4->company_name : '';
    $email_address3 = isset($user4->email) ? $user4->email : '';
    $zipcode2 = isset($user4->zipcode) ? $user4->zipcode : '';
    $city2 = isset($user4->city) ? $user4->city : '';
    $state2 = isset($user4->state) ? $user4->state : '';
    $country2 = isset($user4->country) ? $user4->country : '';
    $address2 = isset($user4->address) ? $user4->address : '';
    $notes2 = isset($user4->note) ? $user4->note : '';
    $statename = isset($user3->sname) ? $user3->sname : '';
    $stateid = isset($user3->sid) ? $user3->sid : '';
    $statename2 = isset($user4->sname) ? $user4->sname : '';
    $stateid2 = isset($user4->sid) ? $user4->sid : '';
    $cityname = isset($user3->cityname) ? $user3->cityname : '';
    $cityid = isset($user3->cityid) ? $user3->cityid : '';
    $cityname2 = isset($user4->cityname) ? $user4->cityname : '';
    $cityid2 = isset($user4->cityid) ? $user4->cityid : '';
} else {
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $company_name = $this->input->post('company_name');
    $email_address2 = $this->input->post('email_address2');
    $zipcode = $this->input->post('zipcode');
    $city = $this->input->post('city');
    $state = $this->input->post('state');
    $country = $this->input->post('country');
    $address = $this->input->post('address');
    $notes = $this->input->post('notes');
    $first_name2 = $this->input->post('first_name2');
    $last_name2 = $this->input->post('last_name2');
    $company_name2 = $this->input->post('company_name2');
    $email_address3 = $this->input->post('email_address3');
    $zipcode2 = $this->input->post('zipcode2');
    $city2 = $this->input->post('city2');
    $state2 = $this->input->post('state2');
    $country2 = $this->input->post('country2');
    $address2 = $this->input->post('address2');
    $notes2 = $this->input->post('notes2');
}
$options[''] = "Select Country";
if (isset($country_res) && !empty($country_res)) {
    foreach ($country_res as $row) {
        $options[$row->id] = $row->name;
    }
}
if (isset($state) && $state != '' && !empty($user1)) {
    $options2 = array($stateid => $statename);
} else {
    $options2 = array('' => 'Select Country First');
}
if (isset($state2) && $state2 != '' && !empty($user1)) {
    $options3 = array($stateid2 => $statename2);
} else {
    $options3 = array('' => 'Select Country First');
}
if (isset($city) && $city != '' && !empty($user1)) {
    $options4 = array($cityid => $cityname);
} else {

    $options4 = array('' => 'Select State First');
}
if (isset($city2) && $city2 != '' && !empty($user1)) {
    $options6 = array($cityid2 => $cityname2);
} else {

    $options6 = array('' => 'Select State First');
}
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons primary fixed-box">
            <h4>Biling & Shipping Details</h4>
            <button form="profile_info_form" class="button mid-short primary">Save Changes</button>
        </div>
        <?php
        $attributes = array(
            'class' => 'rl-label required'
        );
        $attri = array(
            'class' => 'rl-label'
        );
        ?>
        <?php echo form_open_multipart('save_biling_info', array('name' => 'profile_info_form', 'id' => 'profile_info_form')); ?>
        <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $id)); ?>
        <!-- /HEADLINE -->
        <?php $this->load->view('templates/message') ?>
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- ROW -->
            <div class="row">
                <!-- COL -->
                <div class="col-md-6"> 
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Biling Information</h4>
                        <hr class="line-separator">
                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('First Name', 'first_name', $attributes); ?>
                                    <?php echo form_input(array('id' => 'first_name', 'class' => ' lr_input', 'name' => 'first_name', 'value' => "$first_name", 'placeholder' => "First Name")); ?>
                                    <?php echo form_error('first_name'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Last Name', 'last_name', $attributes); ?>
                                    <?php echo form_input(array('id' => 'last_name', 'class' => ' lr_input', 'name' => 'last_name', 'value' => "$last_name", 'placeholder' => "Last Name")); ?>
                                    <?php echo form_error('last_name'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Company Name', 'company_name', $attri); ?>
                            <?php echo form_input(array('id' => 'company_name', 'class' => ' lr_input', 'name' => 'company_name', 'value' => "$company_name", 'placeholder' => "Company Name")); ?>
                            <?php echo form_error('company_name'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Email', 'email_address2', $attributes); ?>
                            <?php echo form_input(array('type' => 'email', 'class' => ' lr_input', 'id' => 'email_address2', 'name' => 'email_address2', 'value' => "$email_address2", 'placeholder' => "Email here...")); ?>
                            <?php echo form_error('email_address2'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('Country', 'country', $attributes); ?>
                                    <label for="country" class="select-block">
                                        <?php echo form_dropdown('country', $options, $country, 'class ="country" id="country"'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('country'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('State', 'state', $attributes); ?>
                                    <label for="state" class="select-block">
                                        <?php echo form_dropdown('state', $options2, '', 'class ="state" id="state"'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('state'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('City', 'city', $attributes); ?>
                                    <label for="city" class="select-block">
                                        <?php echo form_dropdown('city', $options4, '', 'class ="city" id="city"'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('city'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Zip Code', 'zipcode', $attributes); ?>
                                    <?php echo form_input(array('id' => 'zipcode', 'name' => 'zipcode', 'maxlength' => '6', 'class' => 'integer lr_input', 'value' => "$zipcode", 'placeholder' => "Zip Code")); ?>
                                    <?php echo form_error('zipcode'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Full Address', 'address', $attributes); ?>
                            <?php echo form_textarea(array('rows' => "5", 'id' => 'address', 'name' => 'address', 'class' => ' lr_input', 'value' => "$address", 'placeholder' => "Full Address")); ?>
                            <?php echo form_error('address'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Aditional Notes', 'notes', $attri); ?>
                            <?php echo form_textarea(array('rows' => "5", 'id' => 'notes', 'name' => 'notes', 'class' => ' lr_input', 'value' => "$notes", 'placeholder' => "Aditional Notes")); ?>
                            <?php echo form_error('notes'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <!-- CHECKBOX -->
                            <?php
                            $data = array(
                                'name' => 'copy_shipping',
                                'id' => 'copy_shipping',
                                'onclick' => 'Fillshipping(this.form)'
                            );
                            echo form_checkbox($data);
                            ?>
                            <label for="copy_shipping" class="label-check">
                                <span class="checkbox primary"><span></span></span>
                                Copy information to shipping
                            </label>
                            <!-- /CHECKBOX -->
                        </div>
                        <!-- /INPUT CONTAINER -->
                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /COL -->

                <!-- COL -->
                <div class="col-md-6"> 
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item padded">
                        <h4>Shipping Information</h4>
                        <hr class="line-separator">
                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('First Name', 'first_name2', $attributes); ?>
                                    <?php echo form_input(array('id' => 'first_name2', 'class' => ' lr_input', 'name' => 'first_name2', 'value' => "$first_name2", 'placeholder' => "First Name")); ?>
                                    <?php echo form_error('first_name2'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Last Name', 'last_name2', $attributes); ?>
                                    <?php echo form_input(array('id' => 'last_name2', 'class' => ' lr_input', 'name' => 'last_name2', 'value' => "$last_name2", 'placeholder' => "Last Name")); ?>
                                    <?php echo form_error('last_name2'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Company Name', 'company_name2', $attri); ?>
                            <?php echo form_input(array('id' => 'company_name2', 'class' => ' lr_input', 'name' => 'company_name2', 'value' => "$company_name2", 'placeholder' => "Company Name")); ?>
                            <?php echo form_error('company_name2'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Email', 'email_address3', $attributes); ?>
                            <?php echo form_input(array('type' => 'email', 'class' => ' lr_input', 'id' => 'email_address3', 'name' => 'email_address3', 'value' => "$email_address3", 'placeholder' => "Email here...")); ?>
                            <?php echo form_error('email_address3'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('Country', 'country2', $attributes); ?>
                                    <label for="country2" class="select-block">

                                        <?php
                                        echo form_dropdown('country2', $options, $country2, 'class ="country" id="country2"');
                                        ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('country2'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('State', 'state2', $attributes); ?>
                                    <label for="state2" class="select-block">
                                        <?php echo form_dropdown('state2', $options3, '', 'class ="state" id="state2"'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('state2'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="input-container half">
                                    <?php echo form_label('City', 'city2', $attributes); ?>
                                    <label for="city2" class="select-block">
                                        <?php echo form_dropdown('city2', $options6, '', 'class ="city" id="city2"'); ?>
                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                    </label>
                                    <?php echo form_error('city2'); ?>
                                </div>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="col-md-6">
                                <div class="input-container half">
                                    <?php echo form_label('Zip Code', 'zipcode2', $attributes); ?>
                                    <?php echo form_input(array('id' => 'zipcode2', 'name' => 'zipcode2', 'maxlength' => '6', 'class' => 'integer lr_input', 'value' => "$zipcode2", 'placeholder' => "Zip Code")); ?>
                                    <?php echo form_error('zipcode2'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Full Address', 'address2', $attributes); ?>
                            <?php echo form_textarea(array('rows' => "5", 'class' => ' lr_input', 'id' => 'address2', 'name' => 'address2', 'value' => "$address2", 'placeholder' => "Full Address")); ?>
                            <?php echo form_error('address2'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Aditional Notes', 'notes2', $attri); ?>
                            <?php echo form_textarea(array('rows' => "5", 'class' => ' lr_input', 'id' => 'notes2', 'name' => 'notes2', 'value' => "$notes2", 'placeholder' => "Aditional Notes")); ?>
                            <?php echo form_error('notes2'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->

                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /COL -->
            </div>
            <!-- /ROW -->
            <?php echo form_close(); ?>
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
<script>
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
        $(".country").on("change", function () {
            var countryid = $(this).val();
            var id = $(this).attr("id");
            var url = base_url + "profile_complete/state";
            if (countryid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {c_id: countryid, themes_access_token: csrf_token},
                    success: function (html) {
                        if (id == 'country2') {
                            $('#state2').html(html);
                            var selected_state = $("#state").val();
                            if ($("#state2 option[value='" + selected_state + "']").length > 0) {
                                $("#state2").val(selected_state);
                            }
                        } else if (id == 'country') {
                            $('#state').html(html);
                        }
                    }
                });
            } else {
                $('.state').html('<option value="">Select country first</option>');
            }
        });
    });
    $(document).ready(function () {
        $(".state").on("change", function () {
            var id = $(this).attr("id");
            alert();
            var stateid = $(this).val();
            var url = base_url + "profile_complete/city";
            if (stateid) {
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false, //blocks window close
                    data: {s_id: stateid, themes_access_token: csrf_token},
                    success: function (html) {
                        if (id == 'state2') {
                            $('#city2').html(html);
                            var selected_state = $("#city").val();
                            if ($("#city2 option[value='" + selected_state + "']").length > 0) {
                                $("#city2").val(selected_state);
                            }
                        } else if (id == 'state') {
                            $('#city').html(html);
                        }
                    }
                });
            } else {
                $('#city1').html('<option value="">Select State First</option>');
            }

        });
    });
    function Fillshipping(f) {
        if (f.copy_shipping.checked == true) {
            f.first_name2.value = f.first_name.value;
            f.last_name2.value = f.last_name.value;
            f.company_name2.value = f.company_name.value;
            f.email_address3.value = f.email_address2.value;
            $('#country2').val($('#country').val());
            f.zipcode2.value = f.zipcode.value;
            f.address2.value = f.address.value;
            f.notes2.value = f.notes.value;

            $("#country2").trigger("change");
            $("#state2").trigger("change");
        }
    }
    $(document).ready(function () {
        $("#profile_info_form").validate({
            rules: {
                first_name: {
                    maxlength: 50
                },
                last_name: {
                    maxlength: 50
                },
                email_address2: {
                    email: true,
                    maxlength: 50
                },
                zipcode: {
                    number: true,
                    minlength: 6,
                    maxlength: 6
                },
                first_name2: {
                    maxlength: 50
                },
                last_name2: {
                    maxlength: 50
                },
                email_address3: {
                    email: true,
                    maxlength: 50
                },
                zipcode2: {
                    number: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                first_name: {
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                last_name: {
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                email_address2: {
                    required: "Please Enter Email Address",
                    email: "Enter Valid Email Address",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                zipcode: {
                    number: "Please enter a valid Zipcode",
                    minlength: "Please Enter Minimum 6 Characters",
                    maxlength: "Please Enter Maximum 6 Characters"
                },
                first_name2: {
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                last_name2: {
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                email_address3: {
                    email: "Enter Valid Email Address",
                    maxlength: "Please Enter Maximum 50 Characters"
                },
                zipcode2: {
                    number: "Please enter a valid Zipcode",
                    minlength: "Please Enter Minimum 6 Characters",
                    maxlength: "Please Enter Maximum 6 Characters"
                }
            }
        });
    });
</script>
