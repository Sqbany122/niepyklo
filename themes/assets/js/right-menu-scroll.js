var $header = $('.right-second-box'),
    scrollClass = 'right-on-scroll';

var $header_second = $('.right-first-box'),
    scrollClass2 = 'right-on-scroll-second';

var $logo = $('.none'),
    scrollClassLogo = 'display',
    activateAtY = 20;

var $logo_pl = $('.pl'),
    scrollClassLogo = 'display',
    activateAtY = 20;

var $logo_img = $('.logo_box'),
    scrollClassLogoImg = 'logo_img_2',
    activateAtY = 20;          

var $naglowek = $('.naglowek-main'),
    scrollClassNaglowek = 'naglowek-main-scroll',
    activateAtY = 20;   

var $menu = $('.menu_main'),
    scrollClassMenu = 'menu_main_scroll',
    activateAtY = 20;

var $search = $('.search'),
    scrollClasssSearch = 'search_scroll',
    activateAtY = 20;   

var $submenu = $('.submenu'),
    scrollClasssSubmenu = 'submenu-scroll',
    scrollClassTransition = 'transition'
    activateAtY = 20;       
  
function deactivateHeader() {
    if (!$logo.hasClass(scrollClassLogo)){
        $logo.addClass(scrollClassLogo);
        $logo_pl.addClass(scrollClassLogo);
    }
    if (!$logo_img.hasClass(scrollClassLogoImg)){
        $logo_img.addClass(scrollClassLogoImg)
    }
    if (!$naglowek.hasClass(scrollClassNaglowek)){
        $naglowek.addClass(scrollClassNaglowek);
    }
    if (!$menu.hasClass(scrollClassMenu)){
        $menu.addClass(scrollClassMenu);
    }
    if (!$search.hasClass(scrollClasssSearch)){
        $search.addClass(scrollClasssSearch);
    }
    if (!$submenu.hasClass(scrollClasssSubmenu)){
        $submenu.addClass(scrollClasssSubmenu);
    }
}

function activateHeader() {
    if ($logo.hasClass(scrollClassLogo)){
        $logo.removeClass(scrollClassLogo);
        $logo_pl.removeClass(scrollClassLogo);
    }
    if ($logo_img.hasClass(scrollClassLogoImg)){
        $logo_img.removeClass(scrollClassLogoImg)
    }
    if ($naglowek.hasClass(scrollClassNaglowek)){
        $naglowek.removeClass(scrollClassNaglowek);
    }
    if ($menu.hasClass(scrollClassMenu)){
        $menu.removeClass(scrollClassMenu);
    }
    if ($search.hasClass(scrollClasssSearch)){
        $search.removeClass(scrollClasssSearch);
    }
    if ($submenu.hasClass(scrollClasssSubmenu)){
        $submenu.removeClass(scrollClasssSubmenu);
    }
}

$(window).scroll(function() {
    if($(window).scrollTop() > activateAtY) {
        deactivateHeader();
    } else {
        activateHeader();
    }
});

function right_box_add_class(){
    if (!$header.hasClass(scrollClass)) {
        $header.addClass(scrollClass);
    }
    if (!$header_second.hasClass(scrollClass2)) {
        $header_second.addClass(scrollClass2);
    }
}

function right_box_delete_class(){
    if ($header.hasClass(scrollClass)) {
        $header.removeClass(scrollClass);
    } 
    if ($header_second.hasClass(scrollClass2)) {
        $header_second.removeClass(scrollClass2);
    }
}

var windowHeight = $(document).height();
if (windowHeight > 1100) {
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 85) {
            right_box_add_class();
        }else{
            right_box_delete_class();
        }
    });
}
