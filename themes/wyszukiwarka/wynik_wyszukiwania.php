<?php
include('themes/inc/naglowek.php');

$hashtag = $_GET['hashtag'];
if (preg_match('@[^<>]*#[^<>]*@Usmi', $hashtag)) {
  $hashtag = str_replace('#', '', $hashtag);
}
$hash = '[[:<:]]'.$hashtag.'[[:>:]]';

$dostepneTagi = mysqli_fetch_array(mysqli_query($mysqli,"
    SELECT * 
    FROM tagi 
    WHERE tag = '$hashtag'
"));

if (!$dostepneTagi) {
    $dostepneTagi['followers'] = 0;
}

if (!empty($dostepneTagi['id'])) {
    $dostepneTagiId = $dostepneTagi['id'];
} else {
    $dostepneTagiId = $hashtag;
}

$sprawdzCzyFollow = mysqli_query($mysqli,"
    SELECT * 
    FROM followed_tagi 
    WHERE user_id = ".$_SESSION['user_id']."
    AND tag_id = ".$dostepneTagi['id']."
");

$sprawdzCzyBlocked = mysqli_query($mysqli, "
    SELECT *
    FROM blocked_tagi
    WHERE user_id = ".$_SESSION['user_id']."
    AND tag_id = ".$dostepneTagi['id']."
");

?>
<div class="row justify-content-center" style="margin:0 10px 0 10px;"> 
    <div class="fd-flex p-6 meme_height">
        <div class="col-md-12 p-0">
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['login'])) { ?>
                <div class="w-100 mt-5 d-flex">
                    <div class="followTagBtn">
                        <?php  
                            if (!$sprawdzCzyFollow || mysqli_num_rows($sprawdzCzyFollow) < 1) {
                                echo '<button id="btnFollowTagId" title="Obserwuj tag" class="btn btnFollowTag w-100 rounded-0" data-id="'.$dostepneTagiId.'">Obserwuj tag - #'.$hashtag.' ( '.$dostepneTagi['followers'].' Obserwujący )</button>';
                            } else {
                                echo '<button id="btnFollowTagId" title="Przestań obserwować tag" class="btn btnFollowTagFollowed w-100 rounded-0" data-id="'.$dostepneTagiId.'">Przestań obserwować tag - #'.$hashtag.' ( '.$dostepneTagi['followers'].' Obserwujący )</button>';
                            }   
                        ?>
                    </div>
                    <div class="blockTagBtn ml-2">
                        <?php 
                            if (!$sprawdzCzyBlocked || mysqli_num_rows($sprawdzCzyBlocked) < 1) {
                                echo '<button id="blockTag" class="btn w-100 h-100 rounded-0 unblockedTag" title="Zablokuj tag" data-id-tag="'.$dostepneTagiId.'"></button>';
                            } else {
                                echo '<button id="blockTag" class="btn w-100 h-100 rounded-0 blockedTag" title="Zablokuj tag" data-id-tag="'.$dostepneTagiId.'"></button>';
                            }
                        ?>
                        
                    </div>
                </div>
            <?php } ?>
            <?php
            error_reporting (E_ALL ^ E_NOTICE);
            $plusy=mysqli_fetch_array(mysqli_query($mysqli,"SELECT id FROM shity"));
            $limit = $ustawienia['img_na_strone']; // Ilość pozycji na stronę...
            $pg = $_GET['page']; // Pobranie do zmiennej numeru strony...
                
            if(!isset($pg)) {    
            $l1 = 0;
            $l2 = $limit;  
            } else {
            $l1 = $limit * $pg - $limit;
            $l2 = $limit;  
            }

            $zapytanie = mysqli_query($mysqli,"
                SELECT * 
                FROM shity 
                WHERE category REGEXP '$hash' 
                AND czeka = '0' 
                ORDER BY upload_date DESC 
                LIMIT $l1,$l2
            ") or die("ERROR: Picture doesn't exist."); 

            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

            $ile=mysqli_num_rows($zapytanie);
            if ($zapytanie) { 
            while ($shit = mysqli_fetch_array($zapytanie)) { 

            $users=mysqli_fetch_array(mysqli_query($mysqli,"
                SELECT * 
                FROM user 
                WHERE id=".$shit['user_id']."
            "));

            $_SESSION['id'] = $shit['id'];
            $id = $_SESSION['id'];

            $data_time = new MemeData($default_db, $id);
                
            echo '<div class="fd-flex mt-5 mb-5">

                <div class="w-100">';

                if (isset($users)){
                    echo '<div class="avatar_user"><img src="'.$users['user_avatar'].'"/></div>';
                }
            
                $siema = explode('#', $shit['category']);
                $siema = str_replace(' ','',$siema);
                unset($siema[0]);
                
                echo  '<div class="col-md-12 p-0 naglowek_mema">';
                echo  '<span class="user_name">';
                    foreach ($siema as $tag) {
                    echo '<span class="tag_name"><a class="tagBtn" href="/tag/'.$tag.'">#'.$tag.'</a></span>';
                    }
                echo '</span>';
            
                    if (isset($_SESSION['user_id']) && isset($_SESSION['login'])){ 
                    $cliked_class = "";
                    $user_id = $_SESSION['user_id'];
                    $zapytanie_wyslij = "SELECT * FROM `plus_count` WHERE `plus_count`.`id_image` =$id AND `plus_count`.`id_user` =$user_id ";
                    $wynik_wyslij = mysqli_query($mysqli, $zapytanie_wyslij);
                        if(mysqli_num_rows($wynik_wyslij)){
                        
                
                        $cliked_class = " button-clicked";
                        }
                        echo '<button id="plus_button_'.$_SESSION['id'].'" class="plus_count'.$cliked_class.'" data-user-id="'.$users['id'].'">'.$shit['plusy'].'</button>';
                    }else{
                        echo  '<span id="count_'.$_SESSION['id'].'" class="plus_counter_logged_out">'.$shit['plusy'].'</span>'; 
                    }
                
                    echo '</div>';

                    echo '<div class="col-md-12 naglowek_autor">';
                        if ($users['ranga'] == 1){
                            $admin_username = " admin_username";
                            echo '<img src="../img/ico/profile_ico.png" class="admin_user_ico" /><span class="admin_username">'.$users['login'].'</span>';
                        }elseif ($wrzuconych_przez_uzywkownika == '30'){
                            echo '<img src="../img/ico/normal_user_upgrade_info.png" class="admin_user_ico" /><span class="autor">'.$users['login'].'</span>';
                        }else{
                            echo '<i class="fas fa-user-astronaut normal_user_ico"></i><span class="autor normal_user_ico_span">'.$users['login'].'</span>';
                        }
                        echo '<span class="upload_date">'.$data_time->showData().'</span>
                        <button class="btn rounded-0 reportBtn p-0" data-id="'.$_SESSION['id'].'" data-toggle="modal" data-target="#reportMemeModal"><i class="fas fa-flag"></i> Zgłoś</button>
                        </div>
                        <div style="clear: both;"></div>';

                    echo '<div id="rozw_'.$_SESSION['id'].'" class="obrazek_min">   
                        <div id="shit" class="w-100">';  
                        if ($shit['adult_check'] == 1){
                            echo '<img id="adult_'.$_SESSION['id'].'" class="img-fluid adult_img border border-dark" src="../img/adult/nsfw.png" />';            
                            echo '<img id="img_'.$_SESSION['id'].'" class="img-fluid obrazek adult_behind" src="'.$shit['obrazek'].'"/>';
                        }else{       
                            echo '<img id="img_'.$_SESSION['id'].'" class="img-fluid obrazek" src="'.$shit['obrazek'].'" />';
                        } 
                            echo '<span id="rozwin_'.$_SESSION['id'].'" class="expand"><i class="fas fa-chevron-down fa-2x"></i></span>';
                        echo '</div>
                        </div>
                </div>
                </div>'; 
            }
            } else {
            echo 'Nie można pobrać danych z tabeli "shity".'; 
            }

            ?>
            <div class="col-md-12 p-0">
                <?php

                list($records) = mysqli_fetch_row(mysqli_query($mysqli, "SELECT count(*) FROM shity WHERE category REGEXP '$hash' AND czeka = '0'"));

                if($records>=1) {
                $ile = $records/8;
                $minus_strona = $_GET['page']-1;
                $plus_strona = $_GET['page']+1;
                $pierwsza_strona = $_GET['page']+2;
                $rekordy = $records/$ustawienia['img_na_strone'];

                $pagination = new PaginationDB('page', ceil($ile), 1); 
                $pagination->setLimitResults(10); //2
                $pagination->definePattern('<a class="active_pg" href="/tag/'.$hashtag.'/{LP}">{LP}</a> ', 0);
                $pagination->definePattern('<span class="active_pg orange" class="activeLink">{LP}</span> ', 1);
                $query = $mysqli->query("SELECT obrazek LIMIT {$pagination->sqlLimit()}");

                if (ceil($ile) == '1' AND $_GET['page'] == '1' || !isset($_GET['page'])) {
                echo '<a href="/poczekalnia" class="col-md-12 button_next_first"><i class="fas fa-rocket"></i></a>'; 
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif (isset($_GET['page']) AND ceil($ile) == $_GET['page']) {
                echo '<a href="/tag/'.$hashtag.'/'.$minus_strona.'" class="col-md-12 button_next" style="width: 80%;"><i class="fas fa-arrow-left"></i></a>';
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif (!isset($_GET['page']) AND ceil($ile) != '1'){     
                echo '<a href="/tag/'.$hashtag.'/'.$pierwsza_strona.'" class="col-md-12 button_next_first"><i class="fas fa-arrow-right"></i></a>'; 
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';            
                echo $pagination->display();      
                } elseif($_GET['page'] > 1 AND $_GET['page'] < ceil($ile)){
                echo '<a href="/tag/'.$hashtag.'/'.$minus_strona.'" class="col-md-12 button_next"><i class="fas fa-arrow-left"></i></a>';
                echo '<a href="/tag/'.$hashtag.'/'.$plus_strona.'" class="col-md-12 button_back"><i class="fas fa-arrow-right"></i></a>';
                echo '<a href="/losowanie" class="col-md-12 przycisk_losowanie"><i class="fas fa-atom"></i></a>';
                echo $pagination->display();
                } elseif(isset($_GET['page']) AND $_GET['page'] > ceil($ile)){  
                echo '<div class="col-lg-12 mt-5 noMemeInfo">
                    <h1 class="admin_h1 pb-2">Nie ma więcej memów :(</h1>
                    <h5 class="pb-4">Wróć na pierwszą stronę</h5>
                    <a href="/tag/'.$hashtag.'" class="col-md-12 button_next_first" style="width: 100%;"><i class="fas fa-rocket"></i></a>
                </div>';
                }
                }
                else {
                echo '<div class="col-lg-12 mt-5 noMemeInfo">
                    <h1 class="admin_h1">Brak memów pod tagiem <br/> - '.$hashtag.' -</h1>
                    <h5 class="text-center pt-2 pb-4">Wróć na stronę głowną</h5>
                    <a href="/" class="col-md-12 button_home" style="width: 100%;"><i class="fas fa-rocket"></i></a>
                </div>';
                }
                
                ?>
            </div>
        </div>
    </div>
  <div id="right_box" class="right-first-box">
    <?php 
      $username = $_SESSION['login'];
      $right = new Meme($default_db);
      $right->add_right_column();
    ?>
  </div>
</div>
<?php require_once('/themes/inc/footer.php');?>