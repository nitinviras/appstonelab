<!DOCTYPE html>
<html>
    <head>
        <title><?php echo MY_SITE_NAME; ?> | Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <meta name="viewport" content="width=device-width">

        <link href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('css_url'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('css_url'); ?>animate.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('css_url'); ?>style.css" rel="stylesheet">
        <!-- Mainly scripts -->
        <script src="<?php echo $this->config->item('js_url'); ?>jquery-3.1.1.min.js"></script>
        <script src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>
    </head>

    <?php //include APPPATH . '/modules/views/notification_message.php'; ?>
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <img src="<?php echo $this->config->item('images_url'); ?>logo.png"/>
                </div>
                <h3>Welcome to <?php echo MY_SITE_NAME; ?></h3>

                <p>Login in. To see it in action.</p>
                <?php
                $attributes = array('id' => 'LoginForm', 'name' => 'LoginForm', 'method' => "post");
                echo form_open('login_action', $attributes);
                ?>
                <div class="form-group">
                    <input type="email" required="" id="username" name="username" value="developer@mail.com" class="form-control">
                    <?php echo form_error('username'); ?>
                </div>
                <div class="form-group">
                    <input type="password"  id="password" value="developer" name="password" required=""  class="form-control">
                    <span class="material-input"></span>
                    <?php echo form_error('username'); ?>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="<?php echo base_url("forgot_password"); ?>" style="color: #000;font-weight: bold;text-align: right">Forgot Password?</a>
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
</html>
