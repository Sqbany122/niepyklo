<?php 

	$uri = $_SERVER['REQUEST_URI'];

	echo '<link rel="stylesheet" href="/themes/assets/css/main_style.css" type="text/css" />
		<link rel="stylesheet" href="/themes/assets/css/style_menu.css" type="text/css" />
		<link rel="stylesheet" href="/themes/assets/css/memesStyles.css" type="text/css" />
		<link rel="stylesheet" href="/themes/assets/css/pagination_styles.css" type="text/css" />';

	if (strstr($uri,'/poczekalnia')){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_waiting_room.css" type="text/css" />';
	}
	if (strstr($uri,'dodawanie-mema')){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_add_page.css" type="text/css" />';
	}
	if (strstr($uri,'/losowanie')){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_roll_page.css" type="text/css" />';
	}
	if (strstr($uri,'/logowanie')){
		echo '<link rel="stylesheet" type="text/css" href="themes/assets/css/style_login.css" />';
	}
	if (strstr($uri,'/rejestracja')){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_registration.css" type="text/css" />';
	}
	if (strstr($uri,'/profil') || strstr($uri,'ustawienia')){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_my_account.css" type="text/css" />';
	}
	if ((strstr($uri,'obrazek.php')) || (strstr($_SERVER['REQUEST_URI'],'tag'))){
		echo '<link rel="stylesheet" href="/themes/assets/css/style_img_page.css" type="text/css" />';
	}
	if ($uri == '/discord') {
		echo '<link rel="stylesheet" href="/themes/discord/examples/send-message/style.css" type="text/css" />';
	}
	if ($uri == '/opis-zmian') {
		echo '<link rel="stylesheet" href="/themes/assets/css/styleChangelog.css" type="text/css" />';
	} if (strstr($uri,'ranking')) {
		echo '<link rel="stylesheet" href="/themes/assets/css/styleRankingPage.css" type="text/css" />';
	}

?>