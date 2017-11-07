<!-- FORM POPUP -->
<div id="upload_new_item" class="form-popup new-message mfp-hide">
    <!-- FORM POPUP CONTENT -->
    <div class="form-popup-content">
        <h4 class="popup-title">Select a Category</h4>
        <!-- LINE SEPARATOR -->
        <hr class="line-separator">
        <!-- /LINE SEPARATOR -->
        <!-- INPUT CONTAINER -->
        <?php
        $attributes = array('id' => 'product_upload_from', 'name' => 'product_upload_from', 'method' => "post", "class" => "");
        echo form_open('dashboard/product_upload_from', $attributes);
        ?>
        <div class="alert alert-info">
            <p>Please select one category.</p>
        </div>
        <div class="input-container">
            <div class="row text-center">
                <div class="col-md-4 my-2">
                    <label>
                        <a href="<?php echo base_url('web_upload_product/web.jsf'); ?>"><img src="<?php echo base_url() . img_path . "/web.png" ?>" alt="web" /></a>
                    </label>
                </div>
                <div class="col-md-4 my-2">
                    <label>
                        <a href="<?php echo base_url('android_upload_product/android.jsf'); ?>"><img src="<?php echo base_url() . img_path . "/android.png" ?>" alt="android" /></a>
                    </label>
                </div>
                <div class="col-md-4 my-2">
                    <label>
                        <a href="<?php echo base_url('ios_upload_product/ios.jsf'); ?>"><img src="<?php echo base_url() . img_path . "/ios.png" ?>" alt="ios"/></a>
                    </label>
                </div>
            </div>
        </div>
        <!-- INPUT CONTAINER -->

        <?php echo form_close(); ?>
    </div>
    <!-- /FORM POPUP CONTENT -->
</div>
<!-- /FORM POPUP -->
<div class="shadow-film closed"></div>
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
    <div class="modal-dialog w-100 mw-100 m-0" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Here is a Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="frame_preview">

            </div>            
        </div>
    </div>
</div>
<!-- Back to Top -->
<a id="toTop" class="animated lightSpeedIn" title="Back to Top">
    <i class="icon-arrow-up"></i>
</a>
<!-- /Back to Top -->

<!-- SVG ARROW -->
<svg style="display: none;">	
<symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
    <path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
          L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"/>
</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG PLUS -->
<svg style="display: none;">
<symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
    <rect x="5" width="3" height="13"/>
    <rect y="5" width="13" height="3"/>
</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- SVG MINUS -->
<svg style="display: none;">
<symbol id="svg-minus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
    <rect y="5" width="13" height="3"/>
</symbol>
</svg>
<!-- /SVG MINUS -->


<!-- Magnific Popup -->
<script src="<?php echo base_url() . js_path ?>/vendor/jquery.magnific-popup.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="<?php echo base_url() . js_path ?>/vendor/bootstrap-datepicker.min.js"></script>
<!-- Side Menu -->
<script src="<?php echo base_url() . js_path ?>/side-menu.js"></script>
<!-- Dashboard Header -->
<script src="<?php echo base_url() . js_path ?>/dashboard-header.js"></script>
<!-- Dashboard Inbox -->
<script src="<?php echo base_url() . js_path ?>/dashboard-inbox.js"></script>
<!-- Dashboard Statement -->
<script src="<?php echo base_url() . js_path ?>/dashboard-statement.js"></script>
<!-- Popper -->
<script src="<?php echo base_url() . js_path ?>/vendor/popper.min.js"></script>
<!-- Dashboard Statement -->
<script src="<?php echo base_url() . js_path ?>/vendor/bootstrap.min.js"></script>
<!-- Extra js -->
<?php $this->load->view('dashboard/templates/page_level_scripts'); ?>
</body>
</html>
<script>
    window.setTimeout(function () {
        $(".alert-message").fadeTo(1500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
    function ssnav() {
        $('.snav span').click(function () {
            $(this).addClass('active').siblings().removeClass();
            var index = $(this).index();
            $('.ssnav ul').hide().eq(index).show();
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 200) {
                $('.fixed-box').addClass('fix-snav');
            } else {
                $('.fixed-box').removeClass('fix-snav');
            }
            if ($(".fix-snav").length <= 0) {
                $(".dashboard-header").css("position", "fixed");
            } else {
                $(".dashboard-header").css("position", "absolute");
            }
        });
    }
    ssnav();
    function get_url(element) {
        var url = $(element).data("url");
        $("#preview").find('#frame_preview').html('<iframe height="650px" width="100%" src="' + url + '"></iframe>');
    }
</script>