<?php
$service_category_type = $this->uri->segment(2);
$service_sub_category = $this->uri->segment(3);
?>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap v3">
    <div class="container">
        <div class="section-headline">
            <h2>Services</h2>
            <p>
                <a href="<?php echo base_url(); ?>">Home</a>
                <span class="separator">/</span>
                <a  href="<?php echo base_url('services.jsf'); ?>"><span class="current-section">Services</span></a>
                <?php if ($service_category_type != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('services/' . $service_category_type . '.jsf'); ?>"><span class="current-section"> <?php echo ucfirst($service_category_type); ?></span></a>
                    <?php
                }
                if ($service_sub_category != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('services/' . $service_category_type . "/" . $service_sub_category . '.jsf'); ?>"><span class="current-section"> <?php echo ucfirst($service_sub_category); ?></span></a>
                <?php }
                ?>
            </p>
        </div>
        <?php
        if ($this->uri->segment(1) != 'home' && $this->uri->segment(1) != '') {

            $attributes = array('name' => 'frmSearch', 'class' => 'search-form', 'id' => 'frmSearch', 'onsubmit' => 'return false');
            echo form_open('', $attributes);
            ?>
            <input type="hidden" name="service_category_type" id="service_category_type" value="<?php echo $service_category_type; ?>">
            <input type="hidden" name="service_sub_category" id="service_sub_category" value="<?php echo $service_sub_category; ?>">
            <input type="hidden" name="service_status" id="service_status" value="A">
            <input type="text" class="rounded" name="search_text" id="search_text" placeholder="Search services here...">
            <input type="image" src="<?php echo base_url() . img_path ?>/search-icon.png" alt="search-icon">
            <span class="icon-refresh refresh_icon" onclick="get_clear();"></span>
            <?php
            echo form_close();
        }
        ?>
    </div>
</div>
<!-- /SECTION HEADLINE -->

<!-- SECTION -->
<div class="section-wrap">
    <div class="container">
        <div class="section"  data-sticky_parent>
            <div class="row">
                <div class="col-md-3">
                    <!-- SIDEBAR -->
                    <div class="sidebar" id="mysticky" data-sticky_column>
                        <!-- DROPDOWN -->

                        <?php
                        if ($services_category && !empty($services_category)) {
                            ?>
                            <div>
                                <ul class="dropdown hover-effect secondary">
                                    <?php
                                    foreach ($services_category as $row) {
                                        if ($service_category_type == strtolower($this->general->slugify($row->name))) {
                                            $main_class = 'active';
                                        } else {
                                            $main_class = '';
                                        }
                                        ?>
                                        <li class="dropdown-item service <?php echo $main_class; ?>" data-id="<?php echo $row->ID; ?>">
                                            <?php
                                            if (isset($service_category_type) && $service_category_type == strtolower($this->general->slugify($row->name))) {
                                                $cls_show = 'show';
                                                $icon = 'icon-minus';
                                                $float = 'float:left';
                                            } else {
                                                $cls_show = '';
                                                $icon = 'icon-plus';
                                            }
                                            ?>
                                            <a href = "<?php echo base_url("services/" . strtolower($this->general->slugify($row->name)) . '.jsf'); ?>"><span style="width: 90%;float:left"><?php echo ucfirst($row->name); ?></span><span style="width: 10%;" class="sl-icon <?php echo $icon; ?>" data-toggle="collapse" data-target="#submenu_<?php echo $row->ID; ?>"></span></a>
                                            <ul class="collapse submenu <?php echo $cls_show; ?>" id="submenu_<?php echo $row->ID; ?>">
                                                <?php
                                                if (isset($services_sub_category) && $services_sub_category > 0) {
                                                    foreach ($services_sub_category as $value) {
                                                        if ($service_sub_category == strtolower($this->general->slugify($value->name))) {
                                                            $sub_class = 'active';
                                                        } else {
                                                            $sub_class = '';
                                                        }
                                                        if ($row->ID == $value->category) {
                                                            ?>
                                                            <li class="dropdown-item service <?php echo $sub_class; ?>" data-id="<?php echo $value->ID; ?>">
                                                                <a href="<?php echo base_url("services/" . strtolower($this->general->slugify($row->name)) . "/" . strtolower($this->general->slugify($value->name)) . '.jsf'); ?>"><?php echo ucfirst($value->name); ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!-- /SIDEBAR -->
                </div>
                <div class="col-md-9">
                    <div id="no_result" style="display: none">
                        <img src="<?php echo base_url() . img_path . "/noresultsfound.png"; ?>" class="img-responsive"/>
                    </div>
                    <div class="content">
                        <div class="product-showcase">
                            <div id="result"></div>
                            <div id="pagination"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . js_path ?>/module/service_list.js" type="text/javascript"></script>