<?php
$curr_page = trim($this->uri->segment(1));
$add_browser_active = '';
$add_page_active = "";
$add_file_active = "";
$add_faq_active = "";
$add_tag_active = "";
$add_skills_active = "";
$Dashboard = '';
$user_active = '';
$support_active = '';
$product_active = '';
$master_active = '';
$product_inquiry_active = '';
$service_active = '';
$service_category_active = '';
$insert_service_subcategory_active='';
$insert_service_category_active='';
$add_service_category_active = "";
$service_inquiry_active = '';
$tags_active = '';
$skills_active = '';
$setting_active = '';
$browser_active = '';
$file_active = '';
$pages_active = '';
$faq_active = "";
$message_active = '';
$web_active = "";
$android_active = "";
$ios_active = "";
$web_active_insert = "";
$android_active_insert = "";
$ios_active_insert = "";
$web_active_subinsert = "";
$android_active_subinsert = "";
$ios_active_subinsert = "";
$url_segment = trim($this->uri->segment(1));
$userArr = array("user", "user_details");
$supportArr = array("support", "support_detail");
$product_activeArr = array("product", "pending");
$browser_activeArr = array("browser");
$file_activeArr = array("file");
$tag_activeArr = array("tag");
$skill_activeArr = array("skill");
$pages_activeArr = array("pages");
$faq_activeArr = array("faq");
$add_page_arr = array("insert_pages", "save_pages");
$add_faq_arr = array("insert_faq", "save_faq");
$add_file_arr = array("insert_file", "save_file");
$add_browser_arr = array("insert_browser", "save_browser");
$add_tag_arr = array("insert_tag", "save_tag");
$add_skills_arr = array("insert_skill", "save_skill");
$web_category_activeArr = array("web");
$web_category_insertArr = array("insert_web_category", "save_web_category",);
$web_category_insertsubArr = array("insert_web_subcategory", 'save_web_subcategory');
$android_category_activeArr = array("android");
$android_category_insertArr = array("insert_android_category", "save_android_category",);
$android_category_insertsubArr = array("insert_android_subcategory", 'save_android_subcategory');
$ios_category_activeArr = array("ios");
$ios_category_insertArr = array("insert_ios_category", "save_ios_category",);
$ios_category_insertsubArr = array("insert_ios_subcategory", 'save_ios_subcategory');
$product_inquiry_activeArr = array("product_inquiry");
$service_activeArr = array("services", "service", "service_pending");
/////////////////////////////////////////////////////////////
$service_category_activeArr = array("service_category");
$add_service_category_activeArr = array("insert_service_category", "save_service_category");
$add_service_subcategory_activeArr=array("insert_service_subcategory", "save_service_subcategory");
/////////////////////////////////////////////////////////////////
$service_inquiry_activeArr = array("service_inquiry");
$reportArr = array("report");
$message_activeArr = array("message", "insert_message");
$master_activeArr = array("pages", "file", "tag", "browser", "insert_pages", "insert_file", "insert_browser", "insert_tag", "skill", "insert_skill");
if (isset($url_segment) && $url_segment == "dashboard")
    $Dashboard = "active";
if (isset($url_segment) && in_array($url_segment, $userArr)) {
    $user_active = "active";
} if (isset($url_segment) && in_array($url_segment, $supportArr)) {
    $support_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $product_activeArr)) {
    $product_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $product_activeArr)) {
    $product_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $web_category_activeArr)) {
    $web_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $ios_category_activeArr)) {
    $ios_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $ios_category_insertArr)) {
    $ios_active_insert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $web_category_insertArr)) {
    $web_active_insert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $android_category_insertArr)) {
    $android_active_insert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $web_category_insertsubArr)) {
    $web_active_subinsert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $ios_category_insertsubArr)) {
    $ios_active_subinsert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $android_category_insertsubArr)) {
    $android_active_subinsert = "active";
} elseif (isset($url_segment) && in_array($url_segment, $android_category_activeArr)) {
    $android_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $product_inquiry_activeArr)) {
    $product_inquiry_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $service_activeArr)) {
    $service_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $service_category_activeArr)) {
    $service_category_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_service_category_activeArr)) {
    $insert_service_category_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_service_subcategory_activeArr)) {
    $insert_service_subcategory_active = "active";
}elseif (isset($url_segment) && in_array($url_segment, $service_inquiry_activeArr)) {
    $service_inquiry_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $tag_activeArr)) {
    $tags_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $skill_activeArr)) {
    $skills_active = "active";
} elseif (isset($url_segment) && $url_segment == "setting") {
    $setting_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $browser_activeArr)) {
    $browser_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $file_activeArr)) {
    $file_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $pages_activeArr)) {
    $pages_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $message_activeArr)) {
    $message_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_browser_arr)) {
    $add_browser_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_tag_arr)) {
    $add_tag_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_skills_arr)) {
    $add_skills_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_file_arr)) {
    $add_file_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_page_arr)) {
    $add_page_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $add_faq_arr)) {
    $add_faq_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $faq_activeArr)) {
    $faq_active = "active";
} elseif (isset($url_segment) && in_array($url_segment, $master_activeArr)) {
    $master_active = "active";
}
?>



<nav class="navbar-default navbar-static-side " role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="<?php echo $this->config->item('images_url'); ?>logo.png" style="width: 90%" />
                    </span>
                </div>
                <div class="logo-element">
                    THUB
                </div>
            </li>
            <li class="<?php echo $Dashboard; ?>">
                <a href="<?php echo base_url(); ?>"><i class="fa fa-th-large"></i><span class="nav-label">Dashboards</span></a>
            </li>

            <li class="<?php echo $user_active; ?>">
                <a href="<?php echo base_url("user"); ?>"><i class="fa fa-user-circle-o"></i><span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $user_active; ?>"><a href="<?php echo base_url("user"); ?>">Manage User</a></li>
                </ul>
            </li>
            
            <li class="<?php echo $product_active . $product_inquiry_active; ?>">
                <a href="<?php echo base_url("product"); ?>"><i class="fa fa-italic"></i><span class="nav-label">Product</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $product_active; ?>"><a href="<?php echo base_url("product"); ?>">Manage Product</a></li>
                    <li class="<?php echo $product_inquiry_active; ?>"><a href="<?php echo base_url("product_inquiry"); ?>">Product Inquiry </a></li>
                </ul>
            </li>


            <li class="<?php echo $service_active . $service_category_active . $service_inquiry_active . $insert_service_category_active.$insert_service_subcategory_active; ?>">
                <a href="<?php echo base_url("service"); ?>"><i class="fa fa-server"></i><span class="nav-label">Service</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $service_active; ?>"><a href="<?php echo base_url("service"); ?>">Manage Service</a></li>
                    <li class="<?php echo $service_category_active . $insert_service_category_active.$insert_service_subcategory_active; ?>"><a href="<?php echo base_url("service_category"); ?>"><i class="fa fa-server"></i><span class="nav-label">Service Category</span><span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="<?php echo $service_category_active; ?>"><a href="<?php echo base_url("service_category"); ?>">Manage Category </a></li>
                            <li class="<?php echo $insert_service_category_active; ?>"><a href="<?php echo base_url("insert_service_category"); ?>">Add  Category</a></li>
                            <li class="<?php echo $insert_service_subcategory_active; ?>"><a href="<?php echo base_url("insert_service_subcategory"); ?>">Add  SubCategory</a></li>
                        </ul> 
                    </li>

                    <li class="<?php echo $service_inquiry_active; ?>"><a href="<?php echo base_url("service_inquiry"); ?>">Service Inquiry</a></li>
                </ul>
            </li>



            <li class="<?php echo $web_active . '' . $web_active_insert . '' . $web_active_subinsert; ?>">
                <a href="<?php echo base_url("web"); ?>"><i class="fa fa-server"></i><span class="nav-label">Web</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $web_active; ?>"><a href="<?php echo base_url("web"); ?>">Manage Web</a></li>
                    <li class="<?php echo $web_active_insert; ?>"><a href="<?php echo base_url("insert_web_category"); ?>">Add Category</a></li>
                    <li class="<?php echo $web_active_subinsert; ?>"><a href="<?php echo base_url("insert_web_subcategory"); ?>">Add SubCategory</a></li>
                </ul>
            </li>


            <li class="<?php echo $ios_active . '' . $ios_active_insert . '' . $ios_active_subinsert ?>">
                <a href="<?php echo base_url("ios"); ?>"><i class="fa fa-server"></i><span class="nav-label">iOS</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $ios_active; ?>"><a href="<?php echo base_url("ios"); ?>">Manage iOS</a></li>
                    <li class="<?php echo $ios_active_insert; ?>"><a href="<?php echo base_url("insert_ios_category"); ?>">Add Category</a></li>
                    <li class="<?php echo $ios_active_subinsert; ?>"><a href="<?php echo base_url("insert_ios_subcategory"); ?>">Add SubCategory</a></li>
                </ul>
            </li>

            <li class="<?php echo $android_active . '' . $android_active_insert . '' . $android_active_subinsert; ?>">
                <a href="<?php echo base_url("android"); ?>"><i class="fa fa-server"></i><span class="nav-label">Android</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $android_active; ?>"><a href="<?php echo base_url("android"); ?>">Manage Android</a></li>
                    <li class="<?php echo $android_active_insert; ?>"><a href="<?php echo base_url("insert_android_category"); ?>">Add Category</a></li>
                    <li class="<?php echo $android_active_subinsert; ?>"><a href="<?php echo base_url("insert_android_subcategory"); ?>">Add SubCategory</a></li>
                </ul>
            </li>



            <li class="<?php echo $message_active; ?>">
                <a href="<?php echo base_url("message"); ?>"><i class="fa fa-gears"></i><span class="nav-label">Message</span></a>
            </li>

            <li class="<?php echo $setting_active; ?>">
                <a href="<?php echo base_url("setting"); ?>"><i class="fa fa-gears"></i><span class="nav-label">Setting</span></a>
            </li>
            <li class="<?php echo $support_active; ?>">
               <a href="<?php echo base_url("support"); ?>"><i class="fa fa-gears"></i><span class="nav-label">Support</span></a>
            </li>
            <li class=" <?php echo $browser_active . $add_browser_active . $add_file_active . $add_page_active . $add_tag_active . $tags_active . $pages_active . $file_active . $faq_active . $add_faq_active . $skills_active . $add_skills_active ?>">
                <a href="#"><i class="fa fa-server"></i><span class="nav-label">Master</span><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li class="<?php echo $browser_active . $add_browser_active; ?>">
                        <a href="<?php echo base_url("browser"); ?>"><i class="fa fa-server"></i><span class="nav-label">Browser</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $browser_active; ?>"><a href="<?php echo base_url("browser"); ?>">Manage Browser</a></li>
                            <li class="<?php echo $add_browser_active; ?>"><a href="<?php echo base_url("insert_browser"); ?>">Add Browser</a></li>
                        </ul>
                    </li>
                </ul> 
                <ul class="nav nav-second-level">
                    <li class="<?php echo $tags_active . $add_tag_active; ?>">
                        <a href="<?php echo base_url("tag"); ?>"><i class="fa fa-server"></i><span class="nav-label">Tags</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $tags_active; ?>"><a href="<?php echo base_url("tag"); ?>">Manage Tags</a></li>
                            <li class="<?php echo $add_tag_active; ?>"><a href="<?php echo base_url("insert_tag"); ?>">Add Tags</a></li>
                        </ul>
                    </li>
                </ul>  
                <ul class="nav nav-second-level">
                    <li class="<?php echo $skills_active . $add_skills_active; ?>">
                        <a href="<?php echo base_url("skill"); ?>"><i class="fa fa-server"></i><span class="nav-label">Skills</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $skills_active; ?>"><a href="<?php echo base_url("skill"); ?>">Manage Skill</a></li>
                            <li class="<?php echo $add_skills_active; ?>"><a href="<?php echo base_url("insert_skill"); ?>">Add Skill</a></li>
                        </ul>
                    </li>
                </ul>  
                <ul class="nav nav-second-level">
                    <li class="<?php echo $pages_active . $add_page_active; ?>">
                        <a href="<?php echo base_url("pages"); ?>"><i class="fa fa-server"></i><span class="nav-label">Pages</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $pages_active; ?>"><a href="<?php echo base_url("pages"); ?>">Manage Pages</a></li>
                            <li class="<?php echo $add_page_active; ?>"><a href="<?php echo base_url("insert_pages"); ?>">Add Pages</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $file_active . $add_file_active; ?>">
                        <a href="<?php echo base_url("file"); ?>"><i class="fa fa-server"></i><span class="nav-label">File</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $file_active; ?>"><a href="<?php echo base_url("file"); ?>">Manage File</a></li>
                            <li class="<?php echo $add_file_active; ?>"><a href="<?php echo base_url("insert_file"); ?>">Add File</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $faq_active . $add_faq_active; ?>">
                        <a href="<?php echo base_url("faq"); ?>"><i class="fa fa-server"></i><span class="nav-label">Faq</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo $faq_active; ?>"><a href="<?php echo base_url("faq"); ?>">Manage Faq</a></li>
                            <li class="<?php echo $add_faq_active; ?>"><a href="<?php echo base_url("insert_faq"); ?>">Add Faq</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>