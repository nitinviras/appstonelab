<?php
$user_id = (int) $this->session->userdata('user_id');
$this->db->where('user_id', $user_id);
$this->db->where('item_status', "A");
$product_result = $this->db->get('theme_user_upload_item')->result_array();
$this->db->where('user_id', $user_id);
$this->db->where('service_status', "A");
$service_result = $this->db->get('theme_user_services')->result_array();

$this->db->where('follow_id', $user_id);
$follower_result = $this->db->get('theme_user_followers')->result_array();
?>
<style>
    .dashboard-header .dashboard-header-item {
        width: 17.5%;
    }
</style>
<!-- DASHBOARD BODY -->
<div class="dashboard-body">
    <!-- DASHBOARD HEADER -->
    <div class="dashboard-header retracted">
        <!-- SING OUT BUTTON -->
        <a href="<?php echo base_url('logout.jsf') ?>" class="db-logout-button">
            <img src="<?php echo base_url() . img_path ?>/dashboard/sign-out.jpg" alt="sing-out">
        </a>
        <!-- SING OUT BUTTON -->

        <!-- DB CLOSE BUTTON -->
        <a href="<?php echo base_url() ?>" class="db-close-button">
            <img src="<?php echo base_url() . img_path ?>/dashboard/back-icon.png" alt="back-icon">
        </a>
        <!-- DB CLOSE BUTTON -->

        <!-- DB OPTIONS BUTTON -->
        <div class="db-options-button">
            <img src="<?php echo base_url() . img_path ?>/dashboard/db-list-right.png" alt="db-list-right">
            <img src="<?php echo base_url() . img_path ?>/dashboard/close-icon.png" alt="close-icon">
        </div>
        <!-- DB OPTIONS BUTTON -->

        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item title">
            <!-- DB SIDE MENU HANDLER -->
            <div class="db-side-menu-handler">
                <img src="<?php echo base_url() . img_path ?>/dashboard/db-list-left.png" alt="db-list-left">
            </div>
            <!-- /DB SIDE MENU HANDLER -->
            <h6>Your Dashboard</h6>
        </div>
        <!-- /DASHBOARD HEADER ITEM -->



        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item stats">
            <!-- STATS META -->
            <div class="stats-meta">
                <h6><?php echo isset($follower_result) ? count($follower_result) : 0; ?></h6>
                <p>Followers</p>
            </div>
            <!-- /STATS META -->
        </div>
        <!-- /DASHBOARD HEADER ITEM -->

        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item stats">
            <!-- STATS META -->
            <div class="stats-meta">
                <h6><?php echo isset($service_result) ? count($service_result) : 0; ?></h6>
                <p>Total Services</p>
            </div>
            <!-- /STATS META -->
        </div>
        <!-- /DASHBOARD HEADER ITEM -->

        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item stats">
            <!-- STATS META -->
            <div class="stats-meta">
                <h6><?php echo isset($product_result) ? count($product_result) : 0; ?></h6>
                <p>Total Products</p>
            </div>
            <!-- /STATS META -->
        </div>
        <!-- /DASHBOARD HEADER ITEM -->

        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item logout-button">
            <a href="<?php echo base_url('logout.jsf') ?>" class="button mid dark-light">
                <img class="logout_button_img" src="<?php echo base_url() . img_path ?>/dashboard/sign-out.jpg" alt="sing-out">
                Back to Login Page
            </a>
        </div>
        <!-- /DASHBOARD HEADER ITEM -->
        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item back-button">
            <a href="<?php echo base_url() ?>" class="button mid dark-light">Back to Homepage</a>
        </div>
        <!-- DASHBOARD HEADER ITEM -->
        <div class="dashboard-header-item stats">
            <!-- STATS META -->
            <div class="stats-meta">
                <h6>&nbsp;</h6>
                <p>&nbsp;</p>
            </div>
            <!-- /STATS META -->
        </div>
        <!-- /DASHBOARD HEADER ITEM -->
        <!-- /DASHBOARD HEADER ITEM -->
    </div>
    <!-- DASHBOARD HEADER -->
