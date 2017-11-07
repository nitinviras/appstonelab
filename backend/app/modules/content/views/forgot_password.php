<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Forgot Password</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <meta name="viewport" content="width=device-width">

        <!-- Bootstrap core CSS     -->
        <link type="text/css" href="<?php echo $this->config->item('css_url'); ?>/bootstrap.min.css" rel="stylesheet">
        <!--  Material Dashboard CSS    -->
        <link type="text/css" href="<?php echo $this->config->item('css_url'); ?>/boulderweb.css" rel="stylesheet">
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link type="text/css" href="<?php echo $this->config->item('css_url'); ?>/custom.css" rel="stylesheet">
        <!--     Fonts and icons     -->
        <link type="text/css" href="<?php echo $this->config->item('css_url'); ?>/font-awesome.min.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>material.min.js"></script>

        <script src="<?php echo $this->config->item('js_url'); ?>/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <!-- Forms Validations Plugin -->
        <script src="<?php echo $this->config->item('js_url'); ?>/jquery.validate.min.js"></script>
        <!-- TagsInput Plugin -->
        <script src="<?php echo $this->config->item('js_url'); ?>/jquery.tagsinput.js"></script>
        <!-- Material Dashboard javascript methods -->
        <script src="<?php echo $this->config->item('js_url'); ?>/material-dashboard.js"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?php echo $this->config->item('js_url'); ?>/demo.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                demo.checkFullPageBackgroundImage();

                setTimeout(function () {
                    // after 1000 ms we add the class animated to the login/register card
                    $('.card').removeClass('card-hidden');
                }, 700)
            });
        </script>
    </head>

    <?php include APPPATH . '/modules/views/notification_message.php'; ?>
    <body>
        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" filter-color="black" data-image="<?php echo $this->config->item('images_url'); ?>back.png">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                    <?php
                                    $attributes = array('id' => 'ForgotPassword', 'name' => 'ForgotPassword', 'method' => "post");
                                    echo form_open('forgotpassword_action', $attributes);
                                    ?>
                                    <div class="card card-login">
                                        <div class="card-header text-center" data-background-color="rose">
                                            <h3 class="card-title">Forgot Password</h3>
                                        </div>

                                        <div class="card-content">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" required="" id="Email" value="" name="Email" value="<?php echo set_value('Email'); ?>" class="form-control">
                                                    <span class="material-input"></span>
                                                    <?php echo form_error('Email'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer text-center">
                                            <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                                <a href="<?php echo base_url("login"); ?>" style="color: #fff;font-weight: bold;text-align: right">Login Now?</a>
                            </div>

                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container">
                        <p class="copyright text-center">
                            © <?php echo date("Y") ?><a href="http://www.bouldercigs.com"> <?php echo MY_SITE_NAME; ?></a>
                        </p>
                    </div>
                </footer>
                <div class="full-page-background" style="background-image: url(<?php echo $this->config->item('images_url'); ?>login.jpg)"></div></div>
        </div>
    </body>
</html>
