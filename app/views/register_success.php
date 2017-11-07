<!--<h2 class="autologin_wrapper_text text-center"><?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : "Your account has been register successfully. Please check your email to verify your account."; ?></h2>-->
<div class="autologin_wrapper">
        <div class="row">
            <div class="col-md-12 autologin_wrapper_text">
                <h3 class=" page-title text-center">
                    <span class="timer_lbl"> <?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : "Your account has been register successfully. Please check your email to verify your account."; ?> </span>
                </h3>
            </div>
            <div class="col-md-12 text-center">
                <div id="gj-counter-box">
                    <h1 id="gj-counter-num"></h1>
                </div>
            </div>
        </div>
        </div>
<script>
    site_url = '<?php echo base_url(); ?>';
    function gjCountAndRedirect(secounds, url) {

        $('#gj-counter-num').text(secounds);

        $('#gj-counter-box').show();

        var interval = setInterval(function () {

            secounds = secounds - 1;

            $('#gj-counter-num').text(secounds);

            if (secounds == 0) {

                clearInterval(interval);
                window.location = url;
                $('#gj-counter-box').hide();

            }

        }, 1000);
    }

    $(document).ready(function () {
        //call
        gjCountAndRedirect(10, site_url + "home");
    });
</script>