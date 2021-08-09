<?php require_once('/var/www/html/themes/inc/naglowek.php'); ?> 

<div id="main" class="row justify-content-center" style="margin:0 10px 0 10px;"> 
    <div class="fd-flex p-6 meme_height">
        <div class="col-md-12 p-0">
            <?php
                error_reporting (E_ALL ^ E_NOTICE);
                $memes = new ShowMemes($default_db, $_SESSION['user_id']);
                $memes->showMemesInWaitingRoom();
            ?>
            <div class="col-md-16">
                <?php
                list($records) = mysqli_fetch_row(mysqli_query($mysqli, "SELECT count(*) FROM shity WHERE czeka='1'"));

                if($records>=1)
                {
                $ile = $records/8;
                $minus_strona = $_GET['page']-1;
                $plus_strona = $_GET['page']+1;
                $pierwsza_strona = $_GET['page']+2;
                $rekordy = $records/$ustawienia['img_na_strone'];

                $pagination = new PaginationDB('page', ceil($ile), 1);  
                $pagination->setLimitResults(10); //2
                $pagination->definePattern('<a class="active_pg" href="/poczekalnia/{LP}">{LP}</a> ', 0);
                $pagination->definePattern('<span class="orange" class="activeLink">{LP}</span> ', 1);
                $query = $mysqli->query("SELECT obrazek LIMIT {$pagination->sqlLimit()}");

                if (ceil($ile) == '1' AND $_GET['page'] == '1' || !isset($_GET['page'])) {
                echo '<a href="/poczekalnia" class="col-md-12 button_next_first"><i class="fas fa-rocket"></i></a>'; 
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif (isset($_GET['page']) AND ceil($ile) == $_GET['page']) {
                echo '<a href="/poczekalnia/'.$minus_strona.'" class="col-md-12 button_next" style="width: 80%;"><i class="fas fa-arrow-left"></i></a>';
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif (!isset($_GET['page']) AND ceil($ile) != '1'){     
                echo '<a href="/poczekalnia/'.$pierwsza_strona.'" class="col-md-12 button_next_first"><i class="fas fa-arrow-right"></i></a>'; 
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';            
                echo $pagination->display();      
                } elseif($_GET['page'] > 1 AND $_GET['page'] < ceil($ile)){
                echo '<a href="/poczekalnia/'.$minus_strona.'" class="col-md-12 button_next"><i class="fas fa-arrow-left"></i></a>';
                echo '<a href="/poczekalnia/'.$plus_strona.'" class="col-md-12 button_back"><i class="fas fa-arrow-right"></i></a>';
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif(isset($_GET['page']) AND $_GET['page'] > ceil($ile)){  
                echo '<div class="col-lg-12 mt-5 noMemeInfo">
                    <h1 class="admin_h1 pb-2">Nie ma więcej memów :(</h1>
                    <h5 class="pb-4">Wróć na pierwszą stronę poczekalni</h5>
                    <a href="/poczekalnia" class="col-md-12 button_next_first" style="width: 100%;"><i class="fas fa-rocket"></i></a>
                    </div>';
                }
                ?>
                <?php
                }
                else {
                echo '<div class="col-lg-12 mt-5 noMemeInfo">
                    <h1 class="admin_h1 pb-4">Brak memów w poczekalni</h1>
                    <a href="/" class="col-md-12 button_next_first" style="width: 100%;"><i class="fas fa-rocket"></i></a>
                </div>';
                }
                ?>
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
