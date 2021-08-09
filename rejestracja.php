<?php 
  include_once('themes/inc/naglowek.php'); 

  // function to check data passed from user in form.
  function checkTheData($info) {
    die('
      <div class="" style="margin-top: 180px;">
        <p>'.$info.'</p>
        <a class="go_back_btn" href="'.$_SERVER['HTTP_REFERER'].'">Wróć do rejestracji</a> 
      </div>
    ');
  }
?> 
<div class="clearfix bg">
  <div class="row justify-content-center"> 
    <div class="fd-flex pl-5 pr-5 pt-5 mobile_padding" style="margin-top: 150px;">
    <?php
      if (isset($_POST['submit'])) { // check if form is submited.
        if(!$_POST['login'] || !$_POST['password'] || !$_POST['password2'] || !$_POST['email']) { // check if the form isn't empty.
          echo '
          <div class="" style="margin-top: 180px;">
            <span>Nie wypełniono wszystkich pól!</span><br/>
            <a class="go_back_btn" href="'.$_SERVER['HTTP_REFERER'].'">Wróć do rejestracji</a>
          </div>
          ';
        } else {
          if (!empty($_POST)) {

            // user data.
            $userName = mysqli_real_escape_string($mysqli,trim($_POST['login']));   
            if (preg_match('@\s@Usmi', $userName)) {
              $userName = str_replace(" ","_", $userName);
            }  
            if (preg_match('@\s@Usmi', $_POST['password'])) {
              checkTheData('Hasło zawiera białe znaki! (Spacje)');
            }
            $password = sha1(mysqli_real_escape_string ($mysqli, trim($_POST['password'])));  
            $email = $_POST['email'];
            
            // $_SESSION['usernameCheck'] = check_for_valid_name($_POST['login']);
            // $_SESSION['emailCheck'] = check_for_valid_name($_POST['email']);
           
            if (strlen($userName) < 5 || strlen($userName) > 16) { // check if login has length between 5 - 16.
              checkTheData('Niepoprawna długość nazwy użytkownika (min. 5, max. 16).');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // check if email adress is valid.
              checkTheData('Podałeś nieprawidłowy adres email.');
            }

            if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 16) { // check if password has length between 8 - 16.
              checkTheData('Niepoprawna długość hasła (min. 8, max. 16).');
            }
            
            if ($_POST['password'] != $_POST['password2']) { // check if both passwords are the same.
              checkTheData('Hasła nie pasują do siebie.');
            }

            // check if user arleady exists in database.
            $sameUserRecords = mysqli_query($mysqli, "SELECT * FROM `user` WHERE login = '$userName'");
            $sameUserRecords = mysqli_num_rows($sameUserRecords);

            // add default avatar to new user.
            $uploaddir = './img/ico/default_user_ico.png';
            $default_avatar = $uploaddir;
            
              if ($sameUserRecords == 0) { // check if user does not exist.
                $zapytanie="INSERT INTO user (login,email,haslo,data_zalozenia,user_avatar) VALUES('$userName','$email','$password', NOW(),'$default_avatar')";
                mysqli_query($mysqli, $zapytanie) or die("Wystąpił błąd" );
                  echo '
                    <div class="" style="margin-top: 180px;">
                      <p>Konto <strong><i>'.$userName.'</i></strong> zostało utworzone!</p>
                      <a class="go_back_btn" href="login.php">Zaloguj się</a> 
                    </div> 
                  ';
              } else {  // if user already exists
                echo '
                  <div class="" style="margin-top: 180px;">
                    <p class="mb-4">Użytkownik o nazwie '.$userName.' już istnieje. Wymyśl inną nazwę.</p>
                    <a class="go_back_btn" href="/rejestracja">Wróć do rejestracji</a>
                  </div>
                ';
              }
            } else 
                echo 'Podane hasła nie zgadzają się.<br/><a href="/rejestracja">&laquo; Powrót</a>';
        }
      }
      else {
    ?>
    <form action="/rejestracja" method="post">
      <h1>Zarejestruj się</h1>
      <input class="td_input border border-dark" type="text" name="login" placeholder="Login">
      <input class="td_input border border-dark" type="text" name="email" placeholder="E-mail">
      <input class="td_input border border-dark" type="password" name="password" placeholder="Hasło">
      <input class="td_input border border-dark" type="password" name="password2" placeholder="Powtórz hasło">
      <div style="margin-bottom: 15px;">
        <button name="submit" class="td_input_logowanie">Zarejestruj</button>
      </div>
      <span class="regulamin">Masz już konto?<a href="/logowanie"> Zaloguj się</a></span>
    </form>              
    <?php
      }
    ?>
    </div>
  </div>
</div>
<div class="clearfix h-100 w-50 bg_2">
  <div class="w-100 h-50 mt-5 img_reje">
  <a href="/"><img style="margin-right: 200px; width:400px;" src="img/img_reje_2.png"/></a>
  </div>
</div>
<?php require_once('/themes/inc/footer.php'); ?>