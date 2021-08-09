<?php
	ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1); 
	error_reporting(E_ALL); 
	require_once('/var/www/html/config/connect.php');
	include_once(__MAIN_PATH__.'config/redirects.php');
	include_once('class/report_class.php');
	include_once(__MAIN_PATH__.'config/metaTags.php');
?>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<?php include_once('css/all_css.php'); ?>
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<script type="text/javascript" language="javascript" src="/themes/assets/js/lytebox/lytebox.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<div id="naglowek">
	<div class="admin_expand_sidebar">
		<button id="ham_but" class="hamburger hamburger--spin" type="button">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
		</button>
	</div>
		<script>
		$("#ham_but").click(function(){
		var classList = $("#ham_but").attr('class').split(/\s+/);
			$.each(classList, function(index, item) {
				if (item === 'is-active') {
					$("#ham_but").removeClass('is-active');
				}else{
					$("#ham_but").addClass('is-active');
				}
			});			
		});

			$('#ham_but').click(function () {
				$('#sidebar').animate({
					width: 'toggle'
				}, 0)
			});
		</script>
	<div class="logo">
		<div class="logo_box w-100 h-75 ">	
			<a href="/"><img src="/themes/img/logo.png" class="logo_img" /></a><a class="none" href="/">NiePykło<span class="pl">.pl</span></a>
		</div>
	</div>
</div>
<?php include_once('tpl/admin_menu.php');?>
