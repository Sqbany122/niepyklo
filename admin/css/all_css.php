<?php 
    echo '<link rel="stylesheet" href="css/style_admin_main.css" type="text/css" />
            <link href="css/hamburger.css" rel="stylesheet">
            <link rel="stylesheet" href="css/style_admin_menu.css" type="text/css" />
            <link rel="stylesheet" href="/themes/assets/js/lytebox/lytebox.css" type="text/css" media="screen" />';

	if (strstr($_SERVER['REQUEST_URI'],'/admin/poczekalnia')) {
		echo '<link rel="stylesheet" href="css/style_admin_waiting_room.css" type="text/css" />';
	}
	if (strstr($_SERVER['REQUEST_URI'],'/admin/ustawienia.php')) {
		echo '<link rel="stylesheet" href="css/style_admin_settings.css" type="text/css" />';
	}
	if (strstr($_SERVER['REQUEST_URI'],'/admin/zgloszenia-uzytkownikow')) {
		echo '<link rel="stylesheet" href="css/style_report_page.css" type="text/css" />';
	}
?>