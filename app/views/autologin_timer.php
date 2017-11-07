<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
        <link href="<?php echo base_url() . css_path ?>/vendor/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/themeshub.css" rel="stylesheet" type="text/css"/>
        <!-- favicon -->
        <link rel="icon" href="<?php echo base_url() . img_path ?>/favicon.ico">
        <!-- jQuery -->
        <script src="<?php echo base_url() . js_path ?>/vendor/jquery-3.1.0.min.js" type="text/javascript"></script>
        <title>Themeshub | <?php echo isset($title) && !empty($title) ? $title : 'Home'; ?></title>

    </head>
    <body>
        <div class="autologin_wrapper">
        <div class="row">
            <div class="col-md-12 autologin_wrapper_text">
                <h3 class=" page-title text-center">
                    <span class="timer_lbl"> Your account has been verified successfully.Give us a moment to setup your account! </span>
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
                gjCountAndRedirect(10, site_url + "account");
            });
        </script>
    </body>
</html>