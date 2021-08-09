<?php require_once('/var/www/html/themes/inc/naglowek.php'); ?>

<div class="clearfix bg">
    <div class="row justify-content-center"> 
        <div class="fd-flex pl-5 pr-5 pt-5 mobile_padding">

        <?php
        if (isset($_POST['login']) and isset($_POST['password'])) {
            if(!$_POST['login'] || !$_POST['password']) {
                echo '
                    <div class="col-lg-12" style="padding-top: 100px;">
                    <p class="mb-4">Podane dane są nieprawidłowe.</hp>
                    <a class="go_back_btn" href="/logowanie">Spróbuj ponownie</a>
                    </div>
                ';
            }
            else {
                $konto=mysqli_real_escape_string($mysqli,trim($_POST['login']));
                $password=mysqli_real_escape_string($mysqli,trim($_POST['password']));

                if ($konto!="" and $password!="") {
                    $password = sha1($password);
                    $zapytanie="SELECT id FROM user WHERE login='$konto' and haslo ='$password'";
                    $temp=mysqli_query($mysqli,$zapytanie) or die("Wystąpił błąd!");
                    $ile=mysqli_num_rows($temp);
                    $temp=mysqli_fetch_array($temp);
                    $id=$temp['id'];

                    if ($ile==1) {
                        $user_ip = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_id']=$id;
                        $_SESSION['login']=$konto;

                        $userLoginData = new UserLoginData($default_db, $id, $user_ip);

                        ?>
                            <script type="text/javascript">
                                window.location = "/";
                            </script>
                        <?php
                    }
                    else {
                        echo ('<div class="login_incorrect_data"><hp class="mb-4">Podane dane są nieprawidłowe.</hp><form action="/logowanie"><button class="td_input_logowanie" colspan="2" name="submit" >Spróbuj ponownie</button></form></div>');
                    }
                    
                }
            }
        }
        else{
            echo '
                <form action="/logowanie" method="post">
                    <h1>Logowanie</h1>
                    <input class="td_input border border-dark" type="text" name="login" autocomplete="off" placeholder="Login" />
                    <input class="td_input_dodaj border border-dark" type="password" name="password" autocomplete = "new-password" placeholder="Hasło" />
                    <div style="margin-bottom: 15px;">
                        <button class="td_input_logowanie" colspan="2" name="submit" >Zaloguj</button>
                    </div>
                    <span class="regulamin">Nie masz jescze konta?<a href="/rejestracja"> Zarejestruj się</a></span>
                </form>
            ';
        }
        ?>
        </div>
    </div>
</div>
<div class="clearfix h-100 w-50 bg_2">
  <div class="w-100 h-50 mt-5 img_reje">
  <a href="/"><img style="margin-right: 200px; width: 400px;" src="img/img_reje_2.png"/></a>
  </div>
</div>
<?php require_once('/var/www/html/themes/inc/footer.php'); ?>