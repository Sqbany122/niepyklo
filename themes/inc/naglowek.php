<?php 
	ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1); 
	error_reporting(E_ALL); 
	require_once('/var/www/html/config/connect.php');
	require_once(__MAIN_PATH__.'classes/all_classes.php');
	require_once(__MAIN_PATH__.'config/redirects.php');
	require_once(__MAIN_PATH__.'config/metaTags.php');?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="themes/assets/css/hamburger.css" rel="stylesheet">
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<link href="https://fonts.googleapis.com/css?family=Pacifico|Ubuntu+Condensed&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/favicon.ico"/>
	<?php 
		require_once(__THEMES_PATH__.'assets/css/all_css.php');
	?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<script type="text/javascript" src="themes/assets/js/expand.js"></script>
	<script type="text/javascript" src="themes/assets/js/plusSystem/plusBtn.js"></script>
	<script type="text/javascript" src="themes/assets/js/expandSystem/expandSystem.js"></script>
	<script type="text/javascript" src="themes/assets/js/expandSystem/expandAdultImg.js"></script>
</head>
<body>
	<?php 
	if ((!strstr($_SERVER['REQUEST_URI'],'logowanie')) && (!strstr($_SERVER['REQUEST_URI'],'rejestracja'))){ ?>
		<div id="naglowek" class="naglowek-main">
			<div class="naglowek_inside">
				<script>
				$(document).ready(function(){
				$('#ham_but').click(function(){
					$('#menu').stop().slideToggle(200);
				});
				}); 

				</script>


				<div class="logo">
				<div class="logo_box w-100 h-75 ">	
					<a href="/"><img src="/themes/img/logo.png" class="logo_img" /></a><a class="none" href="/">NiePykło<span class="pl">.pl</span></a>
				</div>
				</div>

				<?php require_once(__THEMES_PATH__.'wyszukiwarka/wyszukiwarka.php'); ?>

				<?php require_once(__THEMES_PATH__.'inc/menu.php') ?>
			</div>
		</div>
	<?php 
		} 
	?>