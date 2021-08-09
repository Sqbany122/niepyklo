<?php 
$uri =  $_SERVER['REQUEST_URI'];

/* Przkierowanie domeny na jedną wersję https://niepyklo.pl */
// if ($_SERVER['HTTPS'] == "off" || $_SERVER['HTTP_HOST'] == '46.41.137.18') {
// 	header("HTTP/1.1 301 Moved Permanently");
// 	header("Location: http://46.41.137.18".$uri);
// 	exit();
// }
/* END */

function set_redirect($uri){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://46.41.137.18".$uri);
	exit();
}

/* Przekierowania paginacji */
	if (preg_match('@\/themes/\?page=([0-9]+$)@Usmi', $uri, $pageNr)) {
		set_redirect('/page/'.$pageNr[1]);
	}
	elseif (preg_match('@\/[^<>]*\/([^<>]*).php\?page=([0-9]+$)@Usmi', $uri, $pageNr)) {
		set_redirect('/'.$pageNr[1].'/'.$pageNr[2]);
	}

	if ($uri == '/page/1') {
		set_redirect('/');
	}
	if ($uri == '/poczekalnia/1') {
		set_redirect('/poczekalnia');
	}
/* END */

/* Przekierowanie podstrony discord na adres /discord po przepisaniu go w .htaccess */
	if ($uri == '/themes/discord/examples/send-message/index.php') {
		set_redirect('/discord');
	}
/* END */

/* Przekierowanie na / kiedy w adresie pojawi się index.php */
	if (preg_match('@([^<>]*)\/index.php@Usmi', $uri, $indexRedirect)) {
		if (empty($indexRedirect[1])) {
			set_redirect('/');
		} else {
			set_redirect($indexRedirect[1]);
		}
	}
/* END */

/* Przekierowanie na podstronie wyszukiwania tagu */
	if (preg_match('@[^<>]*wynik_wyszukiwania\.php\?hashtag=([^<>]+$)@Usmi', $uri, $tagUrl)) {
		if (preg_match('@([^<>]*)&@Usmi', $tagUrl[1], $tagName)) {
			 
			if (preg_match('@[^<>]*%23[^<>]*@Usmi', $tagName[1])) {
				$tagName[1] = str_replace('%23', '', $tagName[1]);
			}
			set_redirect('/tag/'.$tagName[1].'');
		} elseif (empty($tagUrl[1])) {
			set_redirect('/');
		} else {
			if (preg_match('@[^<>]*%23[^<>]*@Usmi', $tagUrl[1])) {
				$tagUrl[1] = str_replace('%23', '', $tagUrl[1]);
			}
			set_redirect('/tag/'.$tagUrl[1].'');
		}
	} elseif (preg_match('@\/themes\/wyszukiwarka\/wynik_wyszukiwania\.php\?hashtag=([^<>]*)&szukaj=&page=([0-9]+$)@Usmi', $uri, $tagName)) {
		set_redirect('/tag/'.$tagName[1].'/'.$tagName[2].'');
	} elseif ($uri == '/wynik_wyszukiwania.php?hashtag=') {
		set_redirect('/');
	}

	if (preg_match('@\/tag\/([^\/]*)\/1@Usmi', $uri, $tagName)) {
		set_redirect('/tag/'.$tagName[1].'');
	}

	if (strstr($uri,'/wynik_wyszukiwania.php/')) {
		set_redirect('/');
	}
/* END */

/* Przekierowania podstrony profilu użytkownika */
	if ($uri == '/themes/user_profile/settings/settings.php') {
		set_redirect('/ustawienia');
	}

	if ($uri == '/themes/user_profile/settings/my_acc_settings.php') {
		set_redirect('/ustawienia/awatar');
	}

	if ($uri == '/themes/user_profile/settings/access.php') {
		set_redirect('/ustawienia/dostep');
	}

	if (preg_match('@\/themes\/user_profile\/moje_konto\.php\?user=([^<>]+$)@Usmi', $uri, $userName)) {
		set_redirect('/profil/'.$userName[1]);
	}
/* END */

/* Przekierowania podstron z końcówką .php na ich odpowiedniki bez końcówki */
	if ($uri == '/themes/') {
		set_redirect('/');
	}

	if ($uri == '/themes/poczekalnia.php') {
		set_redirect('/poczekalnia');
	}
	if ($uri == '/themes/losuj.php') {
		set_redirect('/losowanie');
	}
	if ($uri == '/themes/dodaj.php') {
		set_redirect('/dodawanie-mema');
	}
	if ($uri == '/themes/contact.php') {
		set_redirect('/formularz-kontaktowy');
	}
	if ($uri == '/themes/changelog.php') {
		set_redirect('/opis-zmian');
	}
	if ($uri == '/themes/ranking.php') {
		set_redirect('/ranking');
	}
/* END */

/* Przekierowania panelu administracyjnego */
	if ($uri == '/admin/poczekalnia.php') {
		set_redirect('/admin/poczekalnia');
	}
	if ($uri == '/admin/report_page.php') {
		set_redirect('/admin/zgloszenia-uzytkownikow');
	}
/* END */

/* Przkierowanie dla podstron logowania i rejestracji */
	if ($uri == '/login.php') {
		set_redirect('/logowanie');
	}
	if ($uri == '/rejestracja.php') {
		set_redirect('/rejestracja');
	}
/* END */

	if ($uri == '/themes/wyszukiwarka/wynik_wyszukiwania.php'
		|| $uri == '/themes/user_profile/moje_konto.php'
		) {
		set_redirect('/');
	}

?>