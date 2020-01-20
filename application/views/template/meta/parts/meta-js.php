<!-- BEGIN CORE PLUGINS -->
<script src="/assets/rest/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/rest/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/rest/global/plugins/bootstrap-sweetalert/js/sweetalert2.min.js" type="text/javascript"></script>

<?php if(isset($enable_charts) && $enable_charts == true) { ?>
	<script src="/assets/rest/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="/assets/rest/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
	<script src="/assets/rest/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
	<script src="/assets/rest/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>

	<script src="/assets/rest/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
	<script src="/assets/rest/global/plugins/flot/jquery.flot.stack.min.js" type="text/javascript"></script>

	<!--        <script src="/assets/global/plugins/highcharts/js/highcharts.js" type="text/javascript"></script>-->
<?php } ?>



<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/rest/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- Next script is only here for header on mobile find @handleMainMenu -->
<script src="/assets/rest/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="/assets/js/modules.js" type="text/javascript"></script>


<?php if(isset($additional_js)) { echo $additional_js;} ?>

<?php if(GOOGLEANAL) { ?>
    <!-- Google Analytics start-->

    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <!-- Google Analytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150213802-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-150213802-1');
    </script>

    <!-- Google Analytics end-->
<?php } ?>

