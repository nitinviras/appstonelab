<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = "content/login";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*
 *  Frontend Routes
 */
$route['password'] = 'password/reset_password';
$route['login'] = 'content/login';
$route['logout'] = 'content/logout';
$route['reset_password'] = 'content/reset_password';
$route['reset_password_admin'] = 'content/reset_password_admin';
$route['profile'] = 'content/profile';
$route['dashboard'] = 'content/dashboard';
$route['profile_save'] = 'content/profile_save';
$route['forgot_password'] = 'content/forgot_password';
$route['setting'] = 'content/setting';
$route['setting_save'] = 'content/setting_save';
$route['login_action'] = 'content/login_action';
$route['forgotpassword_action'] = 'content/forgotpassword_action';
$route['change_password_action'] = 'content/change_password_action';


/* dashboard */
$route['dashboard'] = 'dashboard/index';
/* product */
$route['index'] = 'product/index';
$route['pending'] = 'product/pending';
$route['save_review'] = 'product/save_review';
$route['delete_product'] = 'product/delete_product';
/* user */
$route['user'] = 'user/index';
$route['user_details'] = 'user/user_details';
$route['user_delete'] = 'user/user_delete';
/* service */
$route['services'] = 'service/index';
$route['service_pending'] = 'service/service_pending';
$route['save_service_review'] = 'service/save_service_review';
$route['delete_service'] = 'service/delete_service';
/* TAGs */
$route['tag'] = 'tag/index';
$route['insert_tag'] = 'tag/insert_tag';
$route['save_tag'] = 'tag/save_tag';
$route['tag_status'] = 'tag/tag_status';
$route['delete_tag'] = 'tag/delete_tag';
/*  browser*/
$route['browser'] = 'browser/index';
$route['insert_browser'] = 'browser/insert_browser';
$route['save_browser'] = 'browser/save_browser';
$route['browser_status'] = 'browser/browser_status';
$route['delete_browser'] = 'browser/delete_browser';
/* Skill category*/
$route['skill'] = 'skill/index';
$route['insert_skill'] = 'skill/insert_skill';
$route['save_skill'] = 'skill/save_skill';
$route['skill_status'] = 'skill/skill_status';
$route['delete_skill'] = 'skill/delete_skill';
/* file category*/
$route['file'] = 'file/index';
$route['insert_file'] = 'file/insert_file';
$route['save_file'] = 'file/save_file';
$route['file_status'] = 'file/file_status';
$route['delete_file'] = 'file/delete_file';
/* Pages*/
$route['pages'] = 'pages/index';
$route['insert_pages'] = 'pages/insert_pages';
$route['save_pages'] = 'pages/save_pages';
$route['pages_status'] = 'pages/pages_status';
$route['delete_pages'] = 'pages/delete_pages';
/* FTP*/
$route['faq'] = 'faq/index';
$route['insert_faq'] = 'faq/insert_faq';
$route['save_faq'] = 'faq/save_faq';
$route['faq_status'] = 'faq/faq_status';
$route['delete_faq'] = 'faq/delete_faq';
/* Meassage*/
$route['message'] = 'message/index';
/*Product  inquiry*/
$route['product_inquiry'] = 'product_inquiry/index';
/*services  inquiry*/
$route['service_inquiry'] = 'service_inquiry/index';
/* service_category */
$route['service_category'] = 'service_category/index';
$route['insert_service_category'] = 'service_category/insert_service_category';
$route['insert_service_subcategory'] = 'service_category/insert_service_subcategory';
$route['save_service_category'] = 'service_category/save_service_category';
$route['save_service_subcategory'] = 'service_category/save_service_subcategory';
$route['service_category_status'] = 'service_category/service_category_status';
$route['delete_service_category'] = 'service_category/delete_service_category';
/* Web_category */
$route['web_category'] = 'web/index';
$route['insert_web_category'] = 'web/insert_web_category';
$route['insert_web_subcategory']='web/insert_web_subcategory';
$route['save_web_category'] = 'web/save_web_category';
$route['save_web_subcategory'] = 'web/save_web_subcategory';
$route['web_category_status'] = 'web/web_category_status';
$route['delete_web_category'] = 'web/delete_web_category';
/* ios_category */
$route['ios_category'] = 'ios/index';
$route['insert_ios_category'] = 'ios/insert_ios_category';
$route['insert_ios_subcategory']='ios/insert_ios_subcategory';
$route['save_ios_category'] = 'ios/save_ios_category';
$route['save_ios_subcategory'] = 'ios/save_ios_subcategory';
$route['ios_category_status'] = 'ios/ios_category_status';
$route['delete_ios_category'] = 'ios/delete_ios_category';
/* android_category */
$route['android'] = 'android/index';
$route['insert_android_category'] = 'android/insert_android_category';
$route['insert_android_subcategory']='android/insert_android_subcategory';
$route['save_android_category'] = 'android/save_android_category';
$route['save_android_subcategory'] = 'android/save_android_subcategory';
$route['android_category_status'] = 'android/android_category_status';
$route['delete_android_category'] = 'android/delete_android_category';
