<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");


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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      

        <meta name="description" content="CorporateWorld Responsive web template, Bootstrap Web Templates">
        <meta name="author" content="CorporateWorld">
        <meta name="keywords" content="CorporateWorld Responsive web template, Bootstrap Web Templates">  
        <!-- favicon -->
        <link rel="icon" href="<?php echo base_url() . ICON_PATH; ?>/favicon.ico">

        <!-- CSS FILE -->
        <title><?php echo MY_SITE_NAME; ?> | <?php echo isset($title) && !empty($title) ? $title : 'Home'; ?></title>
        <link href="<?php echo base_url() . CSS_PATH; ?>compiled.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS_PATH; ?>mdb.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS_PATH; ?>slick.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS_PATH; ?>custtom.css" rel="stylesheet" type="text/css"/>       

        <!-- FONT STYLES -->
        <link href="<?php echo base_url() . CSS_PATH; ?>font-awesome.css" rel="stylesheet" type="text/css"/> 
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto+Slab" rel="stylesheet">

        <!-- jQuery -->
        <script src="<?php echo base_url() . JS_PATH; ?>jquery-3.1.1.min.js" type="text/javascript"></script>
        <script>
            var base_url = '<?php echo base_url() ?>';
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- [if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif] -->
    </head>
    <body>
        <header class="transparent-header">
            <!-- start header -->
<!--            <nav class="navbar fixed-top scrolling-navbar navbar-expand-lg navbar-dark gindigo">-->
            <nav class="navbar fixed-top scrolling-navbar navbar-expand-lg navbar-dark gindigo">
                <div class="container-fluid">
                    <!-- Navbar brand -->
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo MY_SITE_NAME; ?></a>
                    <!-- Collapse button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <!-- Collapsible content -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Links -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mx-1 ">
                                <a class="nav-link active" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-1 ">
                                <a class="nav-link " href="<?php echo base_url('service'); ?>">Services <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-1 ">
                                <a class="nav-link " href="<?php echo base_url('portfolio'); ?>">Portfolio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-1 ">
                                <a class="nav-link " href="<?php echo base_url('about-us'); ?>">About <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mx-1 popup-trigger">
                                <a class="nav-link" href="#popup-estimate">Get Estimate</a>
                            </li>
                            <li class="nav-item mx-1 ">
                                <a class="nav-link" href="<?php echo base_url('contact-us'); ?>">Contact Us <span class="sr-only">(current)</span></a>
                            </li>
                            <!-- Dropdown -->
                        </ul>
                    </div>
                    <!-- Collapsible content -->
                </div>
            </nav>
            <!-- /.Navbar -->
            <?php if ($url_segment == NULL): ?>
                <!-- Slider -->
                <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                    </ol>
                    <!-- /.Indicators -->
                    <!-- Slides -->
                    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="<?php echo base_url() . IMAGES_PATH; ?>slider/banner_1.png" alt="banner img" class="w-100"/>
                            </div>
                        </div>
                    </div>
                    <!-- /.Slides -->
                </div>
                <!-- Slider -->
            <?php endif; ?>
        </header>
        <!-- /header -->