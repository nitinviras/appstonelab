<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="container">
        <div class="section-headline">
            <h2><?php echo $this->session->userdata("username"); ?> Profile</h2>
            <p><a href="<?php echo base_url(); ?>">Home</a><span class="separator">/</span><span class="current-section">Profile</span></p>
        </div>
        <?php
        $attributes = array('name' => 'frmSearch', 'class' => 'search-form', 'id' => 'frmSearch', 'onsubmit' => 'return false');
        echo form_open('', $attributes);
        ?>
        <input type="text" class="rounded" name="search_text" id="search_text" placeholder="Search services here...">
        <input type="image" src="<?php echo base_url() . img_path ?>/search-icon.png" alt="search-icon">
        <span class="icon-refresh refresh_icon" onclick="get_clear();"></span>
        <?php echo form_close();
        ?>
    </div>
</div>
<!-- /SECTION HEADLINE -->

<!-- SECTION -->
<div class="section-wrap">
    <div class="container">
        <div class="section overflowable">
            <div class="row">
                <div class="col-md-3">
                    <div id="sidebar">
                        <!-- SIDEBAR -->
                        <div class="sidebar left author-profile sidebar__inner">

                            <!-- DROPDOWN -->
                            <ul class="dropdown hover-effect">
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile.jsf'); ?>">Profile Page</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_products.jsf'); ?>">Author's Products (<?php echo $product_record; ?>)</a>
                                </li>
                                <li class="dropdown-item active">
                                    <a href="<?php echo base_url('author_profile_services.jsf'); ?>">Author's Services (<?php echo $service_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_followers.jsf'); ?>">Followers (<?php echo $follower_record; ?>)</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('author_profile_following.jsf'); ?>">Following (<?php echo $following_record; ?>)</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /SIDEBAR -->
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- CONTENT -->
                    <div class="content center" id="content">
                        <!-- HEADLINE -->
                        <div class="headline primary">
                            <h4>Author's Services (<span id="product_count_id"></span>)</h4>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /HEADLINE -->
                            <div id="result"></div>
                            <div id="pagination"></div>
                            <div class="clearfix"></div>
                    </div>
                    <!-- CONTENT -->
                </div>

                <div class="col-md-3">
                    <!-- RIGHT SIDEBAR -->
                    <div class="author-profile_top right">
                        <!-- SIDEBAR ITEM -->
                        <div class="sidebar-item author-bio">
                            <!-- USER AVATAR -->
                            <a href="<?php echo base_url('profile') . "/" . $user_record->user_login . '.jsf'; ?>" class="user-avatar-wrap medium">
                                <figure class="user-avatar medium">
                                    <?php
                                    $details_user_fol_nm = sha1("profile_" . $user_record->user_id);
                                    $profile_image_details = isset($user_record->profile_photo) ? trim($user_record->profile_photo) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                                    } else {
                                        $profile_image_url_details = base_url() . img_path . "/user.png";
                                    }
                                    ?>
                                    <img src = "<?php echo $profile_image_url_details; ?>" alt = "profile-default-image">
                                </figure>
                            </a>
                            <!-- /USER AVATAR -->
                            <p class="text-header"><?php echo $user_record->user_login; ?></p>
                            <p class="text-oneline"><?php echo $user_record->company_name; ?><br><?php echo $user_record->cityname; ?>,<?php echo $user_record->statename; ?><br><?php echo $user_record->countryname; ?></p>
                            <!-- SHARE LINKS -->
                            <ul class="share-links">
                                <li><a href="<?php echo $user_record->fb_link; ?>" class="fb" target="_blank"></a></li>
                                <li><a href="<?php echo $user_record->twt_link; ?>" class="twt"target="_blank"></a></li>
                                <li><a href="<?php echo $user_record->gplus_link; ?>" class="gplus" target="_blank"></a></li>
                            </ul>
                            <!-- /SHARE LINKS -->
                        </div>
                        <!-- /SIDEBAR ITEM -->
                        <!-- AUTHOR PROFILE INFO -->
                        <div class="author-profile-info">
                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item">
                                <p class="text-header">Member Since:</p>
                                <p><?php echo date("F d,Y", strtotime($user_record->user_registered)); ?></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <!--                            <div class="author-profile-info-item">
                                                            <p class="text-header">Total Sales:</p>
                                                            <p>820</p>
                                                        </div>-->
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item">
                                <p class="text-header">Freelance Work:</p>
                                <p><?php echo isset($user_record->freelancer_work) && $user_record->freelancer_work == 'A' ? 'Available' : 'Not Available'; ?></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->

                            <!-- AUTHOR PROFILE INFO ITEM -->
                            <div class="author-profile-info-item border-0">
                                <p class="text-header">Website:</p>
                                <p><a href="<?php echo $user_record->personal_website; ?>" class="primary" target="_blank"><?php echo $user_record->personal_website; ?></a></p>
                            </div>
                            <!-- /AUTHOR PROFILE INFO ITEM -->
                        </div>
                        <!-- /AUTHOR PROFILE INFO -->
                    </div>
                    <!-- /RIGHT SIDEBAR -->
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->
<script>
    $(document).ready(function () {
        get_result($("#frmSearch").attr('action'));
        $("#product-info").find('li').css({"color": "#888", "font-size": "0.9em", "font-weight": "600", "line-height": "1.71429em"});
    });

    $('#pagination').on('click', '.pagination a', function (e) {
        e.preventDefault();
        get_result($(this).attr('href'));
        $("html, body").animate({scrollTop: "10px"});
    });
    $("#frmSearch #search_text").change(function () {
        get_result($("#frmSearch").attr('action'));
    });
    function get_result(url) {
        var parent_id = $("ul.dropdown > li.active").attr("data-id");

        var sub_id = $("ul.submenu > li.active").attr("data-id");
        if (parent_id != '' || typeof parent_id != 'undefined') {
            $("#service_category_type").val(parent_id);
        }
        if (sub_id != '' || typeof sub_id != 'undefined') {
            $("#service_sub_category").val(sub_id);
        }
        $.ajax({
            url: url,
            data: $("#frmSearch").serialize(),
            type: "POST",
            beforeSend: function () {
                $('#loadingmessage').show();
            },
            success: function (responseJSON) {
                $('#no_result').html("");
                $('#loadingmessage').hide();
                $('#result').empty();
                var response = JSON.parse(responseJSON);
                $("#product_count_id").text(response.total_count);
                if (response.data.length > 0) {
                    var cnt = 0;
                    var full_html = '';

                    for (var k in response.data) {
                        var html = '';
                        if (cnt % 3 == 0) {
                            html += '<div class="row s1">';
                            html += '<div class="col-md-6">';
                        } else {
                            html += '<div class="col-md-6">';
                        }

                        html += '<div class="card mt-3">';
                        html += '<div class="product-list grid column3-4-wrap product-box_shadow p-2">';
                        html += '<div class="product-preview-actions">';
                        html += '<figure class="product-preview-image">';
                        html += '<img src="' + response.data[k].image + '" alt="product-image" height="163px">';
                        html += '</figure>';
                        html += '<div class="preview-actions">';
                        html += '<div class="preview-action">';
                        html += '<a href="' + response.data[k].url + '">';
                        html += '<div class="circle tiny primary">';
                        html += '<span class="icon-tag"></span>';
                        html += '</div>';
                        html += '</a>';
                        html += '<a href="' + response.data[k].url + '">';
                        html += '<p>Go to Item</p>';
                        html += '</a>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="product-item column margin_bottom_zero">';
                        html += '<div class="product-info">';
                        html += '<a href="' + response.data[k].url + '">';
                        html += '<p class="text-header">' + response.data[k].name + '</p>';
                        html += '</a>';
                        html += '</div>';
                        html += '<hr class="line-separator">';
                        html += '<div class="product-info margin_bottom_zero">';
                        html += '<p class="category primary"><a href=' + response.data[k].p_category_link + '>' + jsUcfirst(response.data[k].p_category) + '</a></p>';
                        html += '<p class="price"><span>$</span>' + response.data[k].price + '</p>';
                        html += '<p class="price user_view"><span class="sl-icon icon-eye weye"></span>' + response.data[k].total_view + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';

                        cnt = cnt + 1;
                        if (cnt % 3 == 0) {
                            html += '</div>';
                        } else if (response.data.length == cnt) {
                            html += '</div>';
                        }
                        full_html += html;
//                         $('#result').append(html);
                    }
                    $('#result').append(full_html);
                } else {
                    $('#no_result').append("<h4 class='text-center product_alert'>No records found.</h4>");
                }
                $('#pagination').html(response.pagination);
            }
        });
    }
    $('.dropdown-item').on('hidden.bs.collapse', function () {
        $(this).find(".sl-icon").removeClass("icon-minus");
        $(this).find(".sl-icon").addClass("icon-plus");
    });
    $('.dropdown-item').on('shown.bs.collapse', function () {
        $(this).find(".sl-icon").removeClass("icon-plus");
        $(this).find(".sl-icon").addClass("icon-minus");
    });
    function get_clear() {
        $("#search_text").val("");
        $("#search_text").trigger("change");

    }
    function jsUcfirst(string) {
        if (string == null) {
            return null;
        }
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>