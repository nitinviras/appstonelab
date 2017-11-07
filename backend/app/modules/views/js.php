<?php
$curr_page = trim($this->uri->segment(1));
?>
<script src="<?php echo $this->config->item('js_url'); ?>jquery-3.1.1.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/metisMenu/jquery.metisMenu.js"></script>
<?php if ($curr_page != "support"): ?>
    <script src="<?php echo $this->config->item('js_url'); ?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
<?php endif; ?>


<!-- Flot -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo $this->config->item('js_url'); ?>inspinia.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?php echo $this->config->item('js_url'); ?>plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?php echo $this->config->item('js_url'); ?>demo/sparkline-demo.js"></script>
<script src="<?php echo $this->config->item('js_url'); ?>plugins/dataTables/datatables.min.js"></script>
