<?php
$main_category_type = $this->uri->segment(2);
$item_parent_category = $this->uri->segment(3);
$item_sub_category = $this->uri->segment(4);

$root_cat_array = array("web", "android", "ios", "iOs");
if (!in_array($main_category_type, $root_cat_array)) {
    redirect(base_url());
}
$main_category_type_title = ($main_category_type == "iOs") ? $main_category_type : ucfirst($main_category_type);
?>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap v2">
    <div class="container">
        <div class="section-headline">
            <h2>Products</h2>
            <p><a href="<?php echo base_url(); ?>">Home</a><span class="separator">/</span>
                <a href="<?php echo base_url('products/' . $main_category_type . '.jsf'); ?>"><span class="current-section">  <?php echo $main_category_type_title; ?></span></a>
                <?php if ($item_parent_category != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('products/' . $main_category_type . '/' . $item_parent_category . '.jsf'); ?>"> <span class="current-section">  <?php echo ucfirst($item_parent_category); ?></span></a>
                <?php }
                ?>
                <?php if ($item_sub_category != '') {
                    ?>
                    <span class="separator">/</span>
                    <a href="<?php echo base_url('products/' . $main_category_type . '/' . $item_parent_category . '/' . $item_sub_category . '.jsf'); ?>"><span class="current-section">  <?php echo ucfirst($item_sub_category); ?></span></a>
                <?php }
                ?>
            </p>
        </div>
        <?php if ($this->uri->segment(1) != 'home' && $this->uri->segment(1) != '') { ?>
            <?php
            $attributes = array('name' => 'frmSearch', 'class' => 'search-form', 'id' => 'frmSearch', 'onsubmit' => 'return false');
            echo form_open('', $attributes);
            ?>
            <input type="hidden" name="item_main_category" id="item_main_category" value="<?php echo $main_category_type; ?>">
            <input type="hidden" name="price_sort" id="price_sort" value="">
            <input type="hidden" name="item_parent_category" id="item_parent_category" value="<?php echo $item_parent_category; ?>">
            <input type="hidden" name="item_sub_category" id="item_sub_category" value="<?php echo $item_sub_category; ?>">
            <input type="text" class="rounded" name="search_text" id="search_text" placeholder="Search products here...">
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
        <div class="section" data-sticky_parent>
            <div class="row">
<!--                <div id="no_result_full_width" class="col-md-12"></div>-->
                <div class="col-md-3">
                    <!-- SIDEBAR -->
                    <div class="sidebar" id="mysticky" data-sticky_column>
                        <!-- DROPDOWN -->
                        <div>
                        <ul class = "dropdown hover-effect tertiary">
                            <?php
                            $get_main_category = $this->uri->segment(2);
                            $get_perent_category = $this->uri->segment(3);
                            $get_sub_category = $this->uri->segment(4);
                            if (isset($main_category) && $main_category > 0) {
                                foreach ($main_category as $row) {
                                    if ($get_perent_category == strtolower($this->general->slugify($row->title))) {
                                        $main_class = ' active';
                                    } else {
                                        $main_class = '';
                                    }
                                    ?>
                                    <li class = "dropdown-item<?php echo $main_class; ?>" data-id="<?php echo $row->ID; ?>">
                                        <?php
                                        $icon = $cls_show = $float = '';
                                        if (isset($get_perent_category) && $get_perent_category == strtolower($this->general->slugify($row->title)) && $this->uri->segment(2) == 'web') {
                                            $cls_show = 'show';
                                            $icon = 'icon-minus';
                                            $float = 'float:left';
                                        } else if ($this->uri->segment(2) == 'web') {
                                            $cls_show = '';
                                            $icon = 'icon-plus';
                                            $float = 'float:left';
                                        }
                                        ?>
                                        <a href = "<?php echo base_url("products/" . $get_main_category . "/" . strtolower($this->general->slugify($row->title)) . '.jsf'); ?>"><span style="width: 90%;<?php echo $float; ?>"><?php echo ucfirst($row->title); ?></span><span style="width: 10%;" class="sl-icon <?php echo $icon; ?>" data-toggle="collapse" data-target="#submenu_<?php echo $row->ID; ?>"></span></a>
                                        <ul class="collapse submenu <?php echo $cls_show; ?>" id="submenu_<?php echo $row->ID; ?>">
                                            <?php
                                            if (isset($sub_category) && $sub_category > 0) {
                                                foreach ($sub_category as $value) {
                                                    if ($get_sub_category == strtolower($this->general->slugify($value->name))) {
                                                        $sub_class = 'active';
                                                    } else {
                                                        $sub_class = '';
                                                    }
                                                    if ($row->ID == $value->parent_category) {
                                                        ?>

                                                        <li class="dropdown-item <?php echo $sub_class; ?>" data-id="<?php echo $value->ID; ?>">
                                                            <a href="<?php echo base_url("products/" . $get_main_category . "/" . strtolower($this->general->slugify($row->title)) . "/" . strtolower($this->general->slugify($value->name)) . '.jsf'); ?>"><?php echo ucfirst($value->name); ?></a>
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
                            }
                            ?>
                        </ul>
                        </div>
                        <!-- /DROPDOWN -->
                    </div>
                    <!-- /SIDEBAR -->
                </div>

                <div class="col-md-9">
                    <!-- CONTENT -->
                    <div class="content">
                        <div class="headline primary product_count_block">
                            <h4><span id="product_count_id"></span> Products Found</h4>
                            <form id="shop_filter_form" name="shop_filter_form">
                                <label for="price_filter" class="select-block">
                                    <select name="price_filter" id="price_filter" onchange="sort_by(this.value)">
                                        <option value="">All</option>
                                        <option value="F">Free</option>
                                        <option value="H">Price (High to Low)</option>
                                        <option value="L">Price (Low to High)</option>
                                    </select>
                                    <!-- SVG ARROW -->
                                    <svg class="svg-arrow">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow"></use>
                                    </svg>
                                    <!-- /SVG ARROW -->
                                </label>
                            </form>
                        </div>
                        <!-- PRODUCT SHOWCASE -->
                        <div class="product-showcase">
                            <div id="result"></div>
                            <div id="pagination"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- CONTENT -->
                    <div id="no_result_product_width" style="display: none">
                        <img src="<?php echo base_url() . img_path . "/noresultsfound.png"; ?>" class="img-responsive"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->
<script src="<?php echo base_url() . js_path ?>/module/product_list.js" type="text/javascript"></script>