<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* USER Controler */
$route['register'] = "user_login/register";
$route['save_register'] = "user_login/save_register";
$route['login'] = "user_login/login";
$route['save_login'] = "user_login/save_login";

/* Content Controler */
$route['logout'] = "content/logout";
$route['register_success'] = "content/register_success";
$route['feedback'] = "content/feedback";
$route['save_feedback'] = "content/save_feedback";
$route['forgot_password'] = "content/forgot_password";
$route['forgot_password_link'] = "content/forgot_password_link";
$route['check_email'] = "content/check_email";
$route['forgot_password_save'] = "content/forgot_password_save";
$route['autologin_timer'] = "content/autologin_timer";
