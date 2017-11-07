<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Myst</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>animate.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>custom.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>green.css"/>

        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>

    </head>
    <body style="background:#F7F7F7;">
        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="POST" name="resetpass" id="resetpass" action="<?php echo $this->config->item("site_url") . 'content/forgot_password_action' ?>"  role="form">      
                        <h1>Forgot Password</h1>
                        <input type="hidden" id="id" name="id" value="1"/>
                        <div>
                            <input placeholder="Password"  type="password" class="form-control" name="password" id="password" />
                        </div>
                        <div>
                            <input placeholder="Confirm Password"  type="password" class="form-control" name="pass" id="pass" />
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Submit" />                            
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>  
        </div>
        <script>
            $(document).ready(function () {
                $.validator.addMethod("passwordRule", function (value, element) {
                    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/.test(value);
                }, "Password between 6 and 20 characters; must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character, but cannot contain whitespace.");
                /* $.validator.addMethod("passwordRule", function(value, element) {
                 return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/.test(value);
                 }, */
                $("#resetpass").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8,
                            passwordRule: false
                        },
                        pass: {
                            required: true,
                            minlength: 8,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        password: {
                            required: "Please enter a password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        pass: {
                            required: "Please enter a confirm password",
                            minlength: "Your password must be at least 8 characters long",
                            equalTo: "Please enter same password to confirm"
                        }
                    },
                    errorPlacement: function (error, e) {
                        error.css('color', 'red');
                        error.css('font-size', '13px');
                        error.css('font-weight', 'normal');

                        e.parent().before(error);

                    },
                    highlight: function (e) {
                        $(e).closest('.validate').removeClass('has-success has-error').addClass('has-error');
                    }
                });
            });
        </script>
    </body>
</html>
