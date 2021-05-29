<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<base href="<?php echo base_url() ?>">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" /> 
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div style="margin-top: 10px;">
	<ul data-role="listview" data-inset="true">
		<li><a href="#" id="jadwal_satpam">Buat Jadwal Satpam</a></li>
		<li><a href="#" id="data_satpam">Data Satpam</a></li>
		<li><a href="#" id="jadwal_satpam_now">Jadwal Satpam Hari ini</a></li>
		<li><a href="#" id="lokasi_semua_satpam">Lihat Semua Posisi Satpam (Sedang Jaga)</a></li>
	</ul>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#jadwal_satpam").click(function(event) {
			window.location="jadwal_satpam?<?php echo param_get() ?>";
		});

		$("#data_satpam").click(function(event) {
			window.location="satpam/view?<?php echo param_get() ?>";
		});

		$("#jadwal_satpam_now").click(function(event) {
			window.location="satpam/hari_ini?<?php echo param_get() ?>";
		});

		$("#lokasi_semua_satpam").click(function(event) {
			window.location="satpam/all_jaga?<?php echo param_get() ?>";
		});
	});
</script>

</body>
</html>