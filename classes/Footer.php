<?php

class Footer {

    public function showFooter () {
        $output = "";
        $output .= "
            <div class='w-100'>
                <div class='stopka'>
                    <div class='footerItemDiv'>
                        <a href='' class=''><i class='fab fa-facebook-square fa-2x'></i></a>
                        <a href=''><i class='fab fa-instagram fa-2x'></i></a>
                        <a href='/formularz-kontaktowy' class=''><i class='fas fa-phone-square fa-2x'></i></a>
                        <a href='/ranking' class=''><i class='fas fa-trophy fa-2x'></i></a>
                        <a href='https://github.com/Sqbany122/Niepyklo'><i class='fab fa-github-square fa-2x'></i></a>
                        <a href='#' class=''><i class='fas fa-book fa-2x'></i></a>
                    </div>
                </div>
            </div>
        ";

        echo $output;
    }
    
}