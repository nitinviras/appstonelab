<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Corporate Web Form</h4>
        </div>
        <!-- /HEADLINE -->
        <?php $this->load->view('templates/message') ?>
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">            
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <!-- ROW -->
                <div class="row">
                    <!-- COL -->
                    <div class="col-md-6 border-right">
                        <h3 class="mt-3 mb-4 fw-400">Maximize your Business with Maximiser</h3>
                        <?php
                        $attributes = array(
                            'class' => 'rl-label required'
                        );
                        ?>
                        <?php echo form_open('save_corporate_web', array('name' => 'corporate_web_form', 'id' => 'corporate_web_form')); ?>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <?php echo form_label('Corporate Web', 'corporate_web', $attributes); ?>
                            <div class="">                           
                                <?php echo form_input(array('id' => 'corporate_web', 'name' => 'corporate_web', 'class' => 'lr_input w-50 d-inline', 'placeholder' => "Corporate Web")); ?>
                                <span class="d-inline-block">.themeshub.tech</span>
                            </div>
                            <?php echo form_error('corporate_web'); ?>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <button form="corporate_web_form" class="button mid-short primary w-50 m-auto">Save Changes</button>
                    </div>
                    <!-- /COL -->

                    <!-- COL -->
                    <div class="col-md-6">
                        <div class="resp_px-3">
                            <h4 class="fw-600 text-left mb-3 mt-3">Features Available</h4>
                            <p class="corporate-featur_text">
                                <i class="fa fa-line-chart pr-3"></i>
                                Website on personalized domain
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-pie-chart pr-3"></i>
                                Add up to 400 products
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-cog pr-3"></i>
                                Website Control Panel
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-line-chart pr-3"></i>
                                Promotion across IndiaMART
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-mobile-phone pr-3"></i>
                                Preferred Number Service
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-line-chart pr-3"></i>
                                TrustSEAL
                            </p>
                            <p class="corporate-featur_text">
                                <i class="fa fa-rupee pr-3"></i>
                                15 Buy Leads FREE every week
                            </p>
                        </div>
                    </div>
                    <!-- /COL -->
                </div>
                <!-- /ROW -->
            </div>
            <!-- FORM BOX ITEM -->
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
    $('#corporate_web').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z0-9_]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });
    $(document).ready(function () {

        $("#corporate_web_form").validate({
            rules: {
                corporate_web: {
                    required: true,
                }

            },
            messages: {
                corporate_web: {
                    required: "Please enter corporate web",
                }

            }

        });

    });
</script>