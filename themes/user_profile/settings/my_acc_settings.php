<?php include(__THEMES_PATH__.'inc/naglowek.php'); ?> 
<?php
$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
//UPLOAD OBRAZKA
if (isset($_SESSION['user_id']) and isset($_SESSION['login'])){
function przyjazny_string($string){
   $string = strtr($string, 'ĘęÓóĄąŚśŁłŹźŻżĆćŃń', 'EeOoAaSsLlZzZzCcNn');
   $string = strtr($string, 'ˇ¦¬±¶Ľ','ASZasz');
   $string = preg_replace("'[[:punct:][:space:]]'",'-',$string);
   $string = strtolower($string);
   $znaki = '-'; 
   $powtorzen = 1;
   $string = preg_replace_callback('#(['.$znaki.'])\1{'.$powtorzen.',}#', function($a){return substr($a[0], 0,'.$powtorzen.');}, $string);
   return $string;
}
if(isset($_POST['submit'])) {
if(!$_FILES['obrazek']['name']) {
	echo 'Nie wypełniono pola z tytułem lub obrazkiem!<br/><a href="dodaj.php">Powrót</a>';
	}
	else {
		$sp1 = explode(".",($_FILES['obrazek']['name']));
        if($sp1[1] == "jpg" or $sp1[1] == "JPG" or $sp1[1] == "jpeg" or $sp1[1] == "JPEG" or $sp1[1] == "png" or $sp1[1] == "PNG"){
			$data_img=date('dmYHi');
			$uploaddir_avatar = '/img/avatar/'.$data_img.'-';
			$_FILES['obrazek']['name'] = przyjazny_string($_FILES['obrazek']['name']);
				if(move_uploaded_file($_FILES['obrazek']['tmp_name'], $uploaddir_avatar.$_FILES['obrazek']['name'])){
				$obrazek=$uploaddir_avatar.$_FILES['obrazek']['name'];
				$id_user = $_SESSION['user_id'];	
				$zapytanie = "UPDATE user SET user_avatar='$obrazek' WHERE id=$id_user";
			    $wykonaj = mysqli_query($mysqli,$zapytanie); 
				}
				else {
				echo 'Wystąpił błąd podczas dodawania obrazka.<br>';
				echo '<a href="dodaj.php">Powrót</a>';
				}
		}
		else {
		echo 'Nie wybrano żadnego obrazka bądź jego format jest niedozwolony!<br/><a href="dodaj.php">&laquo; Powrót</a>';
		}

	}
}
}
//KONIEC UPLOAD OBRAZKA
$email=mysqli_fetch_array(mysqli_query($mysqli,"SELECT email FROM user WHERE login='".$_SESSION['login']."'"));
$data_zal=mysqli_fetch_array(mysqli_query($mysqli,"SELECT data_zalozenia FROM user WHERE login='".$_SESSION['login']."'"));
	
$target = new DateTime($data_zal[0]);
$today = new DateTime(date('Y-m-d\TH:i'));
$interval= $today->diff($target);

if ($interval->m < 1 && $interval->y < 1){
	$data = $interval->format('%d dni');
}elseif ($interval->m >= 1 && $interval->y < 1){
	$data = $interval->format('%m miesięcy');
}elseif ($interval->m < 1 && $interval->y >= 1){
	$data = $interval->format('%y lat');
}else{
	$data = $interval->format('%y lat %m miesięcy');
}

if (!isset($_SESSION['user_id']) and !isset($_SESSION['login']) and (!$spr_rangi['ranga']==1||!$spr_rangi['ranga']==2)){
	?>	
		<script type="text/javascript">
			window.location = "/login.php";
		</script>
	<?php
}else{
list($ilosc_wrzuconych) = mysqli_fetch_row(mysqli_query($mysqli, "SELECT count(*) FROM shity WHERE czeka='0' AND autor='".$_SESSION['login']."'"));

$username = $_SESSION['login'];

$user_db = mysqli_query($mysqli, "SELECT * FROM user WHERE login='$username'"); 
$mem_db	= mysqli_query($mysqli, "SELECT * FROM shity WHERE czeka='0' AND autor='$username' ORDER BY upload_date DESC LIMIT 10");
 
	foreach ($user_db as $row_user){
		$avatar = $row_user['user_avatar'];
	}

?>
	<div class="container my-acc-main">   
	<div class="fd-flex my-acc-user-box">
		<div class="fd-flex my-acc-info-first">
			<img src="<?php echo $avatar; ?>" class="change_avatar_img" width="150px"/>
		</div>
		<div class="fd-flex my-acc-info-second">	
			<span class="my-acc-info-span"><?php echo $username; ?></span><br/>
			<span>na NiePykło od <?php echo $data; ?></span>
		</div>
		<div class="fd-flex my-acc-info-third">
			<a href="/wyloguj.php"><i class="fas fa-power-off"></i></a>
		</div>
	</div>
	
	<div class="fd-flex my-acc-menu">
		<div class="my-acc-menu-item">
			<span><a href="/profil/<?php echo $username; ?>">Profil</a></span>
		</div>
		<div class="my-acc-menu-item">
			<span><a href="/ustawienia">Ustawienia</a></span>
		</div>
	</div>
	

	<div class="fd-flex my-acc-avatar-change-box">
		<div class="my-acc-form-box">
			<form action="/ustawienia/awatar" method="post" enctype="multipart/form-data">
			  	<div class="upload">
					<input type="hidden" name="MAX_FILE_SIZE" value="41000000000" />
					<input class="td_input_dodaj" id="dodawanie" name="obrazek" type="file" onchange="preview_image(event)" />
					<label for="dodawanie">Wybierz avatar</label>
					<div style="clear: both;"></div>
					<button class="avatar_btn" name="submit">Zapisz</button>
				 </div>
			</form>
		</div>
		<div class="my-acc-preview-box">
			<div class="my-acc-preview-box-inside">
				<span id="preview">Wybierz avatar, a wyświetli się na podglądzie.<br /><br />Najlepszą jakość uzyskać można wybierając avatar o rozmarach 150 x 150px.</span>
				<img class="img_preview" id="output_image"/>
			</div>
		</div>
	</div> 
	<script type='text/javascript'>
		function preview_image(event) 
		{
		$('#preview').hide();
		 var reader = new FileReader();
		 reader.onload = function()
		 {
		  var output = document.getElementById('output_image');
		  $("#output_image").addClass("width");
		  output.src = reader.result;
		 }
		 reader.readAsDataURL(event.target.files[0]);
		}
	</script>
<?php
}
?>

<?php require_once(__THEMES_PATH__.'inc/footer.php'); ?>