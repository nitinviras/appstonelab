<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Main routes */
$route['about-us'] = "home/about_us";
$route['contact-us'] = "home/contact_us";
$route['service'] = "home/service";
$route['service-details'] = "home/service_details";
$route['portfolio'] = "home/portfolio";
$route['portfolio-details'] = "home/portfolio_details";
