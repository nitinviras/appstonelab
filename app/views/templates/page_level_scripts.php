<?php if ($c_view == 'templates/defaults') : ?>
    <!-- Magnific Popup -->
    <script src="<?php echo base_url() . js_path ?>/vendor/jquery.magnific-popup.min.js" type="text/javascript"></script>
<?php elseif ($c_view == 'templates/main_page') : ?>
    <script src="<?php echo base_url() . js_path ?>/vendor/jquery.magnific-popup.min.js" type="text/javascript"></script>
<?php elseif (($c_view == 'templates/page') || $c_view == 'templates/root_page') : ?>
    <script src="<?php echo base_url() . js_path ?>/vendor/jquery.magnific-popup.min.js" type="text/javascript"></script>
<?php elseif ($c_view == 'templates/author_page') : ?>
    <!-- ImgLiquid -->
    <script src="<?php echo base_url() . js_path ?>/vendor/imgLiquid-min.js"></script>
<?php endif; ?>