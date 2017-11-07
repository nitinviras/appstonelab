<?php
$username = $this->session->userdata('username');
$user_id = (int) $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);

//get user details
$this->db->where('user_id', $user_id);
$result = $this->db->get('theme_user_details')->row_array();
$profile_image = isset($result['profile_photo']) ? $result['profile_photo'] : "";

if (file_exists(FCPATH . uploads_path . '/profiles/' . $foldername . '/' . $profile_image) && $profile_image != "") {
    $profile_image_url = base_url() . uploads_path . '/profiles/' . $foldername . '/' . $profile_image;
} else {
    $profile_image_url = base_url() . img_path . "/user.png";
}
//count unread message
$this->db->where('msg_to_id', $user_id);
$this->db->where('status', "U");
$msg_result = $this->db->get('theme_messages')->result_array();
/* CODE SET ACTIVE MENU */
$url_segment = trim($this->uri->segment(1));

$corporate_web_class = $change_password_class = $biling_details_class = $service_inquiry_class = $manage_services_class = $add_service_class = $product_inquiry_class = $manage_items_class = $upload_item_class = $profile_setting_class = $message_class = $user = $service = $product = $message = $account_class = $support_class = "";

$userArr = array("account", "profile_setting", "biling_details", "corporate_web", 'save_profile', 'save_profile_setting', 'change_password', 'save_change_password', 'save_biling_info', 'save_corporate_web');
$productArr = array("web_upload_product", "android_upload_product", "ios_upload_product", 'manage_products', 'product_inquiry', 'product_inquiry_details', 'web_save_uploadproduct', 'android_save_uploadproduct', 'ios_save_uploadproduct');
$servicesArr = array("add_service", "manage_services", 'service_inquiry', 'service_inquiry_details', 'save_uploadservice');
$manage_msgsArr = array("message", "message_details");
$change_passwordArr = array("change_password", "save_change_password");
$upload_itemArr = array("web_upload_product", "android_upload_product", "ios_upload_product", "web_save_uploadproduct", 'ios_save_uploadproduct', 'android_save_uploadproduct');
$messageArr = array('message', 'message_details');
$profile_settingArr = array('profile_setting', 'save_profile_setting');
$biling_detailsArr = array('biling_details', 'save_biling_info');
$accountArr = array('account', 'save_profile');
$add_serviceArr = array('add_service', 'save_uploadservice');
$supportArr = array('support', 'support_details', 'add_support');
$corporate_webArr = array('corporate_web', 'save_corporate_web');

if (isset($url_segment) && in_array($url_segment, $productArr)) {
    $product = "active";
}
if (isset($url_segment) && in_array($url_segment, $userArr)) {
    $user = "active";
}
if (isset($url_segment) && in_array($url_segment, $servicesArr)) {
    $service = "active";
}
if (isset($url_segment) && in_array($url_segment, $manage_msgsArr)) {
    $message = "active";
}
if (isset($url_segment) && in_array($url_segment, $accountArr)) {
    $account_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $biling_detailsArr)) {
    $biling_details_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $profile_settingArr)) {
    $profile_setting_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $corporate_webArr)) {
    $corporate_web_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $messageArr)) {
    $message_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $upload_itemArr)) {
    $upload_item_class = "active";
} elseif ($url_segment == "manage_products") {
    $manage_items_class = "active";
} elseif ($url_segment == "product_inquiry") {
    $product_inquiry_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_serviceArr)) {
    $add_service_class = "active";
} elseif ($url_segment == "manage_services") {
    $manage_services_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $change_passwordArr)) {
    $change_password_class = "active";
} elseif (isset($url_segment) && in_array($url_segment, $supportArr)) {
    $support_class = "active";
} else {
    $service_inquiry_class = "active";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, minimum-scale = 1.0, maximum-scale = 1.0">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/vendor/bootstrap-datepicker3.standalone.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/vendor/simple-line-icons.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/vendor/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/vendor/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/vendor/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path; ?>/style.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() . css_path ?>/themeshub.css"  type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() . css_path ?>/dashboard.css"  type="text/css"/>
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


        <script src="<?php echo base_url() . js_path ?>/vendor/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . js_path ?>/vendor/jquery.validate.min.js" type="text/javascript"></script>
        <script>
            var base_url = '<?php echo base_url() ?>';
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <title>Themeshub | <?php echo isset($title) && !empty($title) ? $title : ''; ?></title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109065055-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-109065055-1');
        </script>

    </head>
    <body>
        <div id='loadingmessage' class="loadingmessage"></div>

        <!-- SIDE MENU -->
        <div id="dashboard-options-menu" class="side-menu dashboard left closed">
            <!-- SVG PLUS -->
            <svg class="svg-plus">
            <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SVG PLUS -->

            <!-- SIDE MENU HEADER -->
            <div class="side-menu-header">
                <!-- USER QUICKVIEW -->
                <div class="user-quickview">
                    <!-- USER AVATAR -->
                    <a href="<?php echo base_url('author_profile.jsf'); ?>">
                        <div class="outer-ring">
                            <div class="inner-ring"></div>
                            <figure class="user-avatar">
                                <?php if (!empty($profile_image_url)) { ?>
                                    <img src = "<?php echo $profile_image_url; ?>" alt = "profile-default-image">
                                <?php } else { ?>
                                    <img src="<?php echo $profile_image_url; ?>" alt="user-avatar">
                                <?php } ?>
                            </figure>
                        </div>
                    </a>
                    <!-- /USER AVATAR -->

                    <!-- USER INFORMATION -->
                    <p class="user-name"><?php echo isset($result['first_name']) && !empty($result['first_name']) ? ucfirst($result['first_name']) . " " . ucfirst($result['last_name'][0]) . "." : $username; ?></p>
                    <p><?php echo date("d/m/Y"); ?></p>
                    <!-- /USER INFORMATION -->
                </div>
                <!-- /USER QUICKVIEW -->
            </div>
            <!-- /SIDE MENU HEADER -->

            <!-- SIDE MENU TITLE -->
            <p class="side-menu-title mb-0">Your Account</p>
            <!-- /SIDE MENU TITLE -->

            <!-- DROPDOWN -->
            <ul class="dropdown dark hover-effect interactive mb-0">
                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item interactive <?php echo $user; ?>">
                    <a href="javascript:void(0)">
                        <span class="sl-icon icon-user"></span>
                        User Settings
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </a>

                    <!-- INNER DROPDOWN -->
                    <ul class="inner-dropdown <?php echo $user; ?>">
                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $account_class; ?>">
                            <a href="<?php echo base_url('account.jsf') ?>"><span class="sl-icon icon-settings"></span>Personal Details</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $profile_setting_class; ?>">
                            <a href="<?php echo base_url('profile_setting.jsf') ?>"><span class="sl-icon icon-user"></span>Business Profile</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $change_password_class; ?>">
                            <a href="<?php echo base_url('change_password.jsf') ?>"><span class="sl-icon icon-book-open"></span>Change Password</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $corporate_web_class; ?>">
                            <a href="<?php echo base_url('corporate_web') ?>"><span class="sl-icon icon-globe"></span>Corporate Web</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->
                    </ul>
                    <!-- INNER DROPDOWN -->
                </li>
                <!-- /DROPDOWN ITEM -->

                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item interactive <?php echo $message; ?>">
                    <a href="javascript:void(0)">
                        <span class="sl-icon icon-envelope"></span>
                        Messages
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </a>

                    <!-- INNER DROPDOWN -->
                    <ul class="inner-dropdown <?php echo $message; ?>">
                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $message_class; ?>">
                            <a href="<?php echo base_url('message.jsf') ?>"><span class="sl-icon icon-envelope-letter"></span>Your Inbox (<?php echo isset($msg_result) ? count($msg_result) : 0; ?>)</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->
                    </ul>
                    <!-- INNER DROPDOWN -->

                    <!-- PIN -->
                    <?php if (count($msg_result) > 0) { ?>
                        <span class="pin soft-edged big secondary">!</span>
                    <?php } ?>
                    <!-- /PIN -->
                </li>
                <!-- /DROPDOWN ITEM -->
            </ul>

            <!-- SIDE MENU TITLE -->
            <p class="side-menu-title mb-0">Author Tools</p>
            <!-- /SIDE MENU TITLE -->

            <!-- DROPDOWN -->
            <ul class="dropdown dark hover-effect interactive mb-0">
                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item interactive <?php echo $product; ?>">
                    <a href="javascript:void(0)">
                        <span class="sl-icon icon-bag"></span>
                        Product
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </a>

                    <!-- INNER DROPDOWN -->
                    <ul class="inner-dropdown <?php echo $product; ?>">
                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $upload_item_class; ?>">
                            <a href="#upload_new_item" class="upload_new_item"><span class="sl-icon icon-arrow-up-circle"></span>Upload Product</a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $manage_items_class; ?>">
                            <a href="<?php echo base_url('manage_products.jsf') ?>">
                                <span class="sl-icon icon-folder-alt"></span>
                                Manage Product
                            </a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $product_inquiry_class; ?>">
                            <a href="<?php echo base_url('product_inquiry.jsf') ?>">
                                <span class="sl-icon icon-info"></span>
                                Product Inquiry
                            </a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->
                    </ul>
                    <!-- INNER DROPDOWN -->
                </li>
                <!-- /DROPDOWN ITEM -->

                <!-- DROPDOWN ITEM -->
                <li class="dropdown-item interactive <?php echo $service; ?>">
                    <a href="javascript:void(0)">
                        <span class="sl-icon icon-support"></span>
                        Service
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                        <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </a>

                    <!-- INNER DROPDOWN -->
                    <ul class="inner-dropdown <?php echo $service; ?>">
                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $add_service_class; ?>">
                            <a href="<?php echo base_url('add_service.jsf') ?>">
                                <span class="sl-icon icon-plus"></span>
                                Add Services
                            </a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->

                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $manage_services_class; ?>">
                            <a href="<?php echo base_url('manage_services.jsf') ?>">
                                <span class="sl-icon icon-folder-alt"></span>
                                Manage Services
                            </a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->
                        <!-- INNER DROPDOWN ITEM -->
                        <li class="inner-dropdown-item <?php echo $service_inquiry_class; ?>">
                            <a href="<?php echo base_url('service_inquiry.jsf') ?>">
                                <span class="sl-icon icon-info"></span>
                                Service Inquiry
                            </a>
                        </li>
                        <!-- /INNER DROPDOWN ITEM -->
                    </ul>
                    <!-- INNER DROPDOWN -->
                </li>
                <li class="dropdown-item <?php echo $support_class; ?>">
                    <a href="<?php echo base_url('support.jsf'); ?>"><span class="sl-icon icon-info"></span>Support</a>
                </li>

                <!-- /DROPDOWN ITEM -->
            </ul>
            <!-- /DROPDOWN -->
        </div>
        <!-- /SIDE MENU -->