<?php require_once('/var/www/html/themes/inc/naglowek.php'); ?>
<div id="main" class="row justify-content-center"  style="margin:0 10px 0 10px;"> 
    <div class="fd-flex p-6 meme_height">
        <div class="col-md-12" style="padding: 0;">
            <?php
                error_reporting (E_ALL ^ E_NOTICE);
                $memes = new ShowMemes($default_db, $_SESSION['user_id']);
                $memes->showMemesOnMainSite();
            ?>
            <div class="col-md-12 p-0">
                <a href="/" class="col-md-16 button_home"><i class="fas fa-rocket"></i></a>
                <a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>
            </div>
        </div>
    </div>
    <div id="right_box" class="right-first-box">
        <?php 
            $right = new Meme($default_db, (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL));
            $right->add_right_column();
        ?>
    </div>
</div>
<?php require_once(__THEMES_PATH__.'inc/footer.php'); ?>