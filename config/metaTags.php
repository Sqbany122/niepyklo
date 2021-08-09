<?php 
    $uri = $_SERVER['REQUEST_URI'];
    $brand = "NiePykło.pl - ";
    $title = $brand;
    $titleFromUrl = $uri;

    if (preg_match('@[^-]*-@Usmi', $titleFromUrl)) {
        $titleFromUrl = str_replace('-', ' ', $titleFromUrl);
    } elseif (preg_match('@[^.]*.php@Usmi', $titleFromUrl)) {
        $titleFromUrl = str_replace('.php', '', $titleFromUrl);
    } 

    if (strstr($uri, 'admin') || strstr($uri, 'profil') || strstr($uri, 'tag') || strstr($uri, 'ustawienia') || preg_match('@\/([0-9]+$)@Usmi', $titleFromUrl)) {    
        $titleFromUrl = explode('/', $titleFromUrl);
    } else{
        $titleFromUrl = str_replace('/', '', $titleFromUrl);   
    }
    
    if ($uri == '/') {
        $title .= "Strona z memami dla ludzi z RiGCzem";
    } elseif (strstr($uri, 'admin') || strstr($uri, 'profil') || strstr($uri, 'ustawienia')) {
        if (empty($titleFromUrl[2])) {
            $title .= ucfirst($titleFromUrl[1]);
        } else {
            $title .= ucfirst($titleFromUrl[1]) . " - " . ucfirst($titleFromUrl[2]);
        }     
    } elseif (strstr($uri, 'tag')) {
        if (empty($titleFromUrl[3])) {
            $title .= ucfirst($titleFromUrl[1]) . " - " . ucfirst($titleFromUrl[2]);
        } else {
            $title .= ucfirst($titleFromUrl[1]) . " - " . ucfirst($titleFromUrl[2]) . " - Strona " . $titleFromUrl[3];
        }      
    } elseif (preg_match('@\/([0-9]+$)@Usmi', $uri)) {
        if ($titleFromUrl[1] == 'page') {
            $title .= 'Strona głowna - Strona ' . $titleFromUrl[2];
        } else {
            $title .= ucfirst($titleFromUrl[1])  . ' - Strona ' . $titleFromUrl[2];
        }      
    } else {
        $title .= ucfirst($titleFromUrl);
    }
?>