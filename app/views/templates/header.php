<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");


$username = $this->session->userdata('username');
$user_id = (int) $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);

//get user details
$this->db->select('*');
$this->db->where('user_id', $user_id);
$result = $this->db->get('theme_user_details')->row_array();
$profile_image = isset($result['profile_photo']) ? $result['profile_photo'] : "";

if (file_exists(FCPATH . uploads_path . '/profiles/' . $foldername . '/' . $profile_image) && $profile_image != "") {
    $profile_image_url = base_url() . uploads_path . '/profiles/' . $foldername . '/' . $profile_image;
} else {
    $profile_image_url = base_url() . img_path . "/user.png";
}


//set selected menu
$url_segment = trim($this->uri->segment(1));
$home = $shop = $products = $services = "";

$productArr = array("product_details", "products");
$serviceArr = array("service_details", "services");

if (isset($serviceArr) && in_array($url_segment, $serviceArr)) {
    $services = "front_active";
} else if ($url_segment == "shop") {
    $shop = "front_active";
} else if (isset($url_segment) && in_array($url_segment, $productArr)) {
    $products = "front_active";
} else if ($url_segment == "how-it-work") {
    $shop = "front_active";
} else {
    $home = "front_active";
}
// last new message display     
if ($user_id) {
    $query = "SELECT t1.user_id as from_user_id,t1.first_name as from_first_name,t1.last_name as from_last_name,t1.profile_photo as from_profile_photo,";
    $query .= "t2.user_id as to_user_id,t2.first_name as to_first_name,t2.last_name as to_last_name,tm.message_text,t2.profile_photo as to_profile_photo,";
    $query .= "tm.status,tm.message_text,tm.created_on,tm.ID as mid ";
    $query .= " FROM theme_user_details as t1 ";
    $query .= " INNER JOIN theme_messages as tm ON tm.msg_from_id=t1.user_id";
    $query .= " INNER JOIN theme_user_details as t2 ON tm.msg_to_id=t2.user_id";
    $query .= " WHERE tm.msg_to_id=" . $user_id . " ORDER BY tm.created_on desc";
    $query .= " LIMIT 0,4";
    $query_rws = $this->db->query($query);
    $message_data = $query_rws->result_array();
}
//count unread message
$this->db->select('*');
$this->db->where('msg_to_id', $user_id);
$this->db->where('status', "U");
$msg_result = $this->db->get('theme_messages')->result_array();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
        <link href="<?php echo base_url() . css_path ?>/vendor/simple-line-icons.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/vendor/tooltipster.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . css_path ?>/vendor/jquery.range.css">
        <link href="<?php echo base_url() . css_path ?>/vendor/magnific-popup.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/vendor/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/vendor/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . css_path ?>/themeshub.css" rel="stylesheet" type="text/css"/>
        <!-- favicon -->
        <link rel="icon" href="<?php echo base_url() . icon_path; ?>/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() . icon_path; ?>/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url() . icon_path; ?>/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() . icon_path; ?>/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() . icon_path; ?>/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() . icon_path; ?>/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() . icon_path; ?>/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() . icon_path; ?>/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() . icon_path; ?>/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() . icon_path; ?>/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url() . icon_path; ?>/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() . icon_path; ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() . icon_path; ?>/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . icon_path; ?>/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url() . icon_path; ?>/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url() . icon_path; ?>/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- jQuery -->
        <script src="<?php echo base_url() . js_path ?>/vendor/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . js_path ?>/vendor/jquery.validate.min.js" type="text/javascript"></script>
        <script>
            var base_url = '<?php echo base_url() ?>';
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <title>Themeshub | <?php echo isset($title) && !empty($title) ? $title : 'Home'; ?></title>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109065055-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109065055-1');
</script>

    </head>

    <body>
        <!--LOADER-->
        <div class="loader"></div>
        <div id='loadingmessage'  class="loadingmessage"></div>
        <!--/LOADER-->

        <!-- HEADER -->
        <div class="header-wrap">
            <header>
                <nav class="navbar navbar-expand-lg fixed-top">
                    <div class="container">
                        <!-- LOGO -->
                        <a href="<?php echo base_url() ?>" class="navbar-brand">
                            <figure class="logo">
                                <img src="<?php echo base_url() . img_path ?>/logo.png" alt="logo">
                            </figure>
                        </a>
                        <!-- /LOGO -->

                        <!-- MOBILE MENU HANDLER -->
                        <div class="mobile-menu-handler left primary">
                            <img src="<?php echo base_url() . img_path ?>/pull-icon.png" alt="pull-icon">
                        </div>
                        <!-- /MOBILE MENU HANDLER -->

                        <!-- LOGO MOBILE -->
                        <a href="<?php echo base_url() ?>">
                            <figure class="logo-mobile">
                                <img src="<?php echo base_url() . img_path ?>/logo_mobile.png" alt="logo-mobile">
                            </figure>
                        </a>
                        <!-- /LOGO MOBILE -->

                        <!-- MOBILE ACCOUNT OPTIONS HANDLER -->
                        <div class="mobile-account-options-handler right secondary">
                            <span class="icon-user"></span>
                        </div>
                        <!-- /MOBILE ACCOUNT OPTIONS HANDLER -->

                        <!-- MAIN MENU -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!--<div class="main-menu-wrap fixed-box">-->
                            <!--<div class="menu-bar">-->
                            <ul class="navbar-nav menu-bar ml-auto main-menu mr-11">
                                <!-- MENU ITEM -->
                                <li class="nav-item menu-item <?php echo $home ?>">
                                    <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
                                </li>
                                <!-- /MENU ITEM -->

                                <!-- MENU ITEM -->
                                <li class="nav-item menu-item <?php echo $shop ?>">
                                    <a class="nav-link" href="<?php echo base_url('how-it-work.jsf') ?>">How It Work</a>
                                </li>
                                <!-- /MENU ITEM -->

                                <!-- MENU ITEM -->
                                <li class="nav-item menu-item <?php echo $products ?>">
                                    <a class="nav-link">Products</a>
                                    <div class="content-dropdown">
                                        <!-- FEATURE LIST BLOCK -->
                                        <div class="feature-list-block">
                                            <a href="<?php echo base_url('products/web.jsf') ?>">
                                                <figure>
                                                    <img src="<?php echo base_url() . img_path . "/web.png" ?>" alt="web">
                                                </figure>
                                                <p align="center">Web</p>
                                            </a>
                                        </div>
                                        <!-- /FEATURE LIST BLOCK -->

                                        <!-- FEATURE LIST BLOCK -->
                                        <div class="feature-list-block">
                                            <a href="<?php echo base_url('products/android.jsf') ?>">
                                                <figure>
                                                    <img src="<?php echo base_url() . img_path . "/android.png" ?>" alt="android">
                                                </figure>
                                                <p align="center">Android</p>
                                            </a>
                                        </div>
                                        <!-- /FEATURE LIST BLOCK -->

                                        <!-- FEATURE LIST BLOCK -->
                                        <div class="feature-list-block">
                                            <a href="<?php echo base_url('products/iOs.jsf') ?>">
                                                <figure>
                                                    <img src="<?php echo base_url() . img_path . "/ios.png" ?>" alt="ios">
                                                </figure>
                                                <p align="center">iOs</p>
                                            </a>
                                        </div>
                                        <!-- /FEATURE LIST BLOCK -->
                                    </div>
                                </li>
                                <!-- /MENU ITEM -->

                                <!-- MENU ITEM -->
                                <li class="nav-item menu-item <?php echo $services ?>">
                                    <a class="nav-link" href="<?php echo base_url('services.jsf') ?>">Services</a>
                                </li>
                                <!-- /MENU ITEM -->

                            </ul>
                            <!--</div>-->
                            <!--</div>-->
                            <!-- /MAIN MENU -->

                            <!-- USER BOARD -->
                            <div class="user-board">
                                <?php if ($this->session->userdata('username')) { ?>
                                    <!-- USER QUICKVIEW -->
                                    <div class="user-quickview">
                                        <!-- USER AVATAR -->
                                        <a href="<?php echo base_url('author_profile.jsf'); ?>">
                                            <div class="outer-ring">
                                                <div class="inner-ring"></div>
                                                <figure class="user-avatar">
                                                    <img src = "<?php echo $profile_image_url; ?>" alt = "profile-default-image">
                                                </figure>
                                            </div>
                                        </a>
                                        <!-- /USER AVATAR -->

                                        <!-- USER INFORMATION -->
                                        <p class="user-name"><?php echo isset($result['first_name']) && !empty($result['first_name']) ? ucfirst($result['first_name']) . " " . ucfirst($result['last_name'][0]) . "." : $username; ?></p>                                        <!-- SVG ARROW -->
                                        <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                        </svg>
                                        <!-- /SVG ARROW -->
                                        <!-- /USER INFORMATION -->

                                        <!-- DROPDOWN -->
                                        <ul class="dropdown small hover-effect closed">
                                            <li class="dropdown-item">
                                                <div class="dropdown-triangle"></div>
                                                <a href="<?php echo base_url('author_profile.jsf'); ?>">Profile Page</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('account.jsf'); ?>">Account Settings</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('manage_products.jsf'); ?>">Upload Product</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('manage_products.jsf'); ?>">Manage Products</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('add_service.jsf'); ?>">Add Services</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('manage_services.jsf'); ?>">Manage Services</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo base_url('logout.jsf') ?>">Logout</a>
                                            </li>
                                        </ul>
                                        <!-- /DROPDOWN -->
                                    </div>
                                    <!-- /USER QUICKVIEW -->

                                    <!-- ACCOUNT INFORMATION -->
                                    <?php if (count($message_data) > 0) { ?>
                                        <div class="account-information">
                                            <div class="account-email-quickview">
                                                <span class="icon-envelope">
                                                    <!-- SVG ARROW -->
                                                    <svg class="svg-arrow">
                                                    <use xlink:href="#svg-arrow"></use>
                                                    </svg>
                                                    <!-- /SVG ARROW -->
                                                </span>
                                                <!-- PIN -->
                                                <?php if (count($msg_result) > 0) { ?>
                                                    <span class="pin soft-edged secondary">!</span>
                                                <?php } ?>
                                                <!-- /PIN -->
                                                <!-- DROPDOWN NOTIFICATIONS -->
                                                <ul class="dropdown notifications closed">
                                                    <?php foreach ($message_data as $value) { ?>

                                                        <!-- DROPDOWN ITEM -->
                                                        <li class="dropdown-item">
                                                            <div class="dropdown-triangle"></div>
                                                            <?php
                                                            $from_user_id = $this->encryption->encrypt($value['from_user_id']);
                                                            $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);
                                                            ?>
                                                            <a href="<?php echo base_url('message_details.jsf?token=' . $encrypted_from_id) ?>" class="link-to"></a>
                                                            <figure class="user-avatar">
                                                                <?php
                                                                $profile_user_id = isset($value['from_user_id']) ? $value['from_user_id'] : 0;
                                                                $details_user_fol_nm = sha1("profile_" . $profile_user_id);
                                                                $profile_image_details = isset($value['from_profile_photo']) ? trim($value['from_profile_photo']) : "";

                                                                if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                                                    $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                                                } else {
                                                                    $profile_image_url_details = base_url() . img_path . "/user.png";
                                                                }
                                                                ?>
                                                                <img src="<?php echo $profile_image_url_details; ?>" alt="">
                                                            </figure>
                                                            <p class="text-header tiny mb-2"><span><?php echo isset($value['from_first_name']) ? $value['from_first_name'] . " " . $value['from_last_name'] : ''; ?></span></p>
                                                            <p class="subject  mb-1"><?php echo $this->general->add3dots(isset($value['message_text']) ? $value['message_text'] : '', "...", 36); ?></p>
                                                            <p class="timestamp"><?php echo date("d F , Y h:i:s a", strtotime(isset($value['created_on']) ? $value['created_on'] : '')); ?></p>
                                                            <?php if (isset($value['status']) && $value['status'] == 'U') { ?>
                                                                <span class="notification-type secondary-new icon-envelope"></span>
                                                            <?php } else { ?>
                                                                <span class="notification-type icon-envelope-open"></span>
                                                            <?php } ?>
                                                        </li>
                                                        <!-- /DROPDOWN ITEM -->
                                                    <?php } ?>
                                                </ul>
                                                <!-- /DROPDOWN NOTIFICATIONS -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- /ACCOUNT INFORMATION -->
                                <?php } ?>
                                <!-- ACCOUNT ACTIONS -->
                                <div class="account-actions">
                                    <?php if ($this->session->userdata('username') == '') { ?>
                                        <a href="<?php echo base_url('login.jsf') ?>" class="button primary">Login</a>
                                        <a href="<?php echo base_url('register.jsf') ?>" class="button secondary">Register Now</a>
                                    <?php } ?>

                                </div>
                                <!-- /ACCOUNT ACTIONS -->
                            </div>
                            <!-- /USER BOARD -->
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <!-- /HEADER -->

        <!-- SIDE MENU -->
        <div id="mobile-menu" class="side-menu left closed">
            <!-- SVG PLUS -->
            <svg class="svg-plus">
            <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SVG PLUS -->

            <!-- SIDE MENU HEADER -->
            <div class="side-menu-header">
                <figure class="logo small">
                    <img src="<?php echo base_url() . img_path ?>/logo.png" alt="logo">
                </figure>
            </div>
            <!-- /SIDE MENU HEADER -->

            <!-- SIDE MENU TITLE -->
            <p class="side-menu-title">Main Links</p>
            <!-- /SIDE MENU TITLE -->

            <!-- DROPDOWN -->
            <ul class="dropdown dark hover-effect interactive dropdown-menu1">
                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item">
                    <a href="<?php echo base_url() ?>">Home</a>
                </li>
                <!-- /DROPDOWN ITEM -->

                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item">
                    <a href="<?php echo base_url('how-it-work.jsf') ?>">How It Work</a>
                </li>
                <!-- /DROPDOWN ITEM -->

                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item">
                    <a>Products</a>
                    <div class="content-dropdown1">
                        <!-- FEATURE LIST BLOCK -->
                        <div class="feature-list-block">
                            <a href="<?php echo base_url('products/web.jsf') ?>">
                                <figure>
                                    <img src="<?php echo base_url() . img_path . "/web.png" ?>" alt="web">
                                </figure>
                                <p align="center">Web</p>
                            </a>
                        </div>
                        <!-- /FEATURE LIST BLOCK -->

                        <!-- FEATURE LIST BLOCK -->
                        <div class="feature-list-block">
                            <a href="<?php echo base_url('products/android.jsf') ?>">
                                <figure>
                                    <img src="<?php echo base_url() . img_path . "/android.png" ?>" alt="android">
                                </figure>
                                <p align="center">Android</p>
                            </a>
                        </div>
                        <!-- /FEATURE LIST BLOCK -->

                        <!-- FEATURE LIST BLOCK -->
                        <div class="feature-list-block">
                            <a href="<?php echo base_url('products/ios.jsf') ?>">
                                <figure>
                                    <img src="<?php echo base_url() . img_path . "/ios.png" ?>" alt="ios">
                                </figure>
                                <p align="center">iOs</p>
                            </a>
                        </div>
                        <!-- /FEATURE LIST BLOCK -->
                    </div>
                </li>
                <!-- /DROPDOWN ITEM -->

                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item">
                    <a href="<?php echo base_url('services.jsf') ?>">Services</a>
                </li>
                <!-- /DROPDOWN ITEM -->

            </ul>
            <!-- /DROPDOWN -->
        </div>
        <!-- /SIDE MENU -->

        <!-- SIDE MENU -->
        <div id="account-options-menu" class="side-menu right closed">
            <!-- SVG PLUS -->
            <svg class="svg-plus">
            <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SVG PLUS -->
            <?php if ($this->session->userdata('username')) { ?>
                <!-- SIDE MENU HEADER -->
                <div class="side-menu-header">
                    <!-- USER QUICKVIEW -->
                    <div class="user-quickview">
                        <!-- USER AVATAR -->
                        <a href="<?php echo base_url('author_profile'); ?>">
                            <div class="outer-ring">
                                <div class="inner-ring"></div>
                                <figure class="user-avatar">
                                    <img src = "<?php echo $profile_image_url; ?>" alt = "profile-default-image">
                                </figure>
                            </div>
                        </a>
                        <!-- /USER AVATAR -->

                        <!-- USER INFORMATION -->
                        <p class="user-name"><?php echo isset($result['first_name']) && !empty($result['first_name']) ? ucfirst($result['first_name']) . " " . ucfirst($result['last_name'][0]) . "." : $username; ?></p>  
                        <!-- /USER INFORMATION -->
                    </div>
                    <!-- /USER QUICKVIEW -->
                </div>
                <!-- /SIDE MENU HEADER -->
                <?php if (count($message_data) > 0) { ?>
                    <!-- SIDE MENU TITLE -->
                    <p class="side-menu-title">Your Account</p>
                    <!-- /SIDE MENU TITLE -->

                    <!-- DROPDOWN -->

                    <ul class="dropdown dark hover-effect">
                        <!-- DROPDOWN ITEM -->
                        <li class="dropdown-item">
                            <a href="<?php echo base_url('message'); ?>">Messages</a>
                        </li>
                        <!-- /DROPDOWN ITEM -->
                    </ul>
                <?php } ?>
                <!-- /DROPDOWN -->

                <!-- SIDE MENU TITLE -->
                <p class="side-menu-title">Dashboard</p>
                <!-- /SIDE MENU TITLE -->

                <!-- DROPDOWN -->
                <ul class="dropdown dark hover-effect">
                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('author_profile'); ?>">Profile Page</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->

                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('account'); ?>">Account Settings</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->

                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('manage_products'); ?>">Upload Product</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->

                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('manage_products'); ?>">Manage Products</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->

                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('add_service'); ?>">Add Services</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->

                    <!-- DROPDOWN ITEM -->
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('manage_services'); ?>">Manage Services</a>
                    </li>
                    <!-- /DROPDOWN ITEM -->
                </ul>
                <!-- /DROPDOWN -->
            <?php } ?>
            <?php if ($this->session->userdata('username') == '') { ?>
                <a href="<?php echo base_url('login') ?>" class="button primary">Login</a>
                <a href="<?php echo base_url('register') ?>" class="button secondary">Register Now</a>
            <?php } ?>
            <?php if ($this->session->userdata('username') != '') { ?>
                <a href="<?php echo base_url('logout') ?>" class="button primary">Logout</a>
            <?php } ?>

        </div>
        <!-- /SIDE MENU -->
