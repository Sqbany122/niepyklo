<?php 
require_once('/var/www/html/themes/inc/naglowek.php'); 

$userName = $_GET['user'];

list($userExists) = mysqli_fetch_row(mysqli_query($mysqli, "
	SELECT count(*) 
	FROM user 
	WHERE login='$userName'
"));

if ($userName != NULL && $userExists < 1) {
	?>
		<script>
			window.location = "/404.php";
		</script>
	<?php
}

$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"
	SELECT * 
	FROM user 
	WHERE login='".$_SESSION['login']."'
"));

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
	?>
	<script>
	$(document).ready(function(){
		$('#myForm').on('change', "input#MyFile", function (e) {
			$('#save_btn').show();

		});
	});
	</script> 
	<?php 
	if(isset($_POST['submit'])) {
		if(!$_FILES['obrazek']['name']) {
			echo 'Nie wypełniono pola z tytułem lub obrazkiem!<br/><a href="dodaj.php">Powrót</a>';
		} else {
			$sp1 = explode(".",($_FILES['obrazek']['name']));
			if($sp1[1] == "jpg" or $sp1[1] == "JPG" or $sp1[1] == "jpeg" or $sp1[1] == "JPEG" or $sp1[1] == "png" or $sp1[1] == "PNG") {
				$data_img=date('dmYHi');
				$uploaddir_avatar = './img/avatar/'.$data_img.'-';
				$_FILES['obrazek']['name'] = przyjazny_string($_FILES['obrazek']['name']);
					if(move_uploaded_file($_FILES['obrazek']['tmp_name'], $uploaddir_avatar.$_FILES['obrazek']['name'])) {
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
$email=mysqli_fetch_array(mysqli_query($mysqli,"SELECT email FROM user WHERE login='$userName'"));
$data_zal=mysqli_fetch_array(mysqli_query($mysqli,"SELECT data_zalozenia FROM user WHERE login='$userName'"));
	
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
} else {
	$username = $_SESSION['login'];

	if ($userName != NULL) {
		$user_db = mysqli_query($mysqli, "
			SELECT * 
			FROM user 
			WHERE login='$userName'
		"); 

		$mem_db	= mysqli_query($mysqli, "
			SELECT a.*, b.login
			FROM shity a
			LEFT JOIN user b ON b.id = a.user_id
			WHERE czeka = 0
			AND b.login = '$userName' 
			ORDER BY upload_date DESC 
			LIMIT 10
		");
	}

	foreach ($user_db as $row_user){
		$avatar = $row_user['user_avatar'];
		$user_id = $row_user['id'];
	}
	
	list($ilosc_wrzuconych) = mysqli_fetch_row(mysqli_query($mysqli, "
		SELECT count(*) 
		FROM shity
		WHERE czeka = 0
		AND user_id = ".$user_id."
	"));	


	list($otrzymanychPlusow) = mysqli_fetch_row(mysqli_query($mysqli, "
		SELECT count(*)
		FROM plus_count
		WHERE id_image_user = ".$user_id."
	"));

	list($followingCount) = mysqli_fetch_row(mysqli_query($mysqli, "
		SELECT count(*)
		FROM followed_users
		WHERE id_user = ".$user_id."
	"));

	list($followedCount) = mysqli_fetch_row(mysqli_query($mysqli, "
		SELECT count(*)
		FROM followed_users
		WHERE id_followed_user = ".$user_id."
	"));

	$followedTags = mysqli_query($mysqli, "
		SELECT b.tag
		FROM followed_tagi a
		LEFT JOIN tagi b ON b.id = a.tag_id
		WHERE a.user_id = ".$user_id."
	");

	foreach ($followedTags as $key => $value) {
		$tags[$key] = $value['tag'];
	}

	$followed_users=mysqli_query($mysqli,"
		SELECT * 
		FROM followed_users 
		WHERE id_user = ".$_SESSION['user_id']." 
		AND id_followed_user = ".$user_id."
	");

	?>
	<div class="container my-acc-main">   
		<div class="fd-flex my-acc-user-box">
			<div class="fd-flex my-acc-info-first">
				<img class="change_avatar_img" src="<?php echo $avatar; ?>" width="150px"/>
				<a href="/ustawienia/awatar"><div class="middle">
					<i class="fas fa-camera-retro"></i>
				</div></a>				
			</div>
			<div class="fd-flex my-acc-info-second">	
				<span class="my-acc-info-span"><?php echo $userName; ?></span>
				<span style="display: block;">na NiePykło od <?php echo $data; ?></span>
				<?php 
					if ( isset($_SESSION['user_id']) && $user_id != $_SESSION['user_id'] && isset($_SESSION['login'])) {
						if (mysqli_num_rows($followed_users) < 1) {
							echo '
								<button id="btnFollow" class="btn mt-3 rounded-0 unfollowed" data-id="'.$user_id.'"> Obserwuj</button>
							';
						} else {
							echo '
								<button id="btnFollow" class="btn mt-3 rounded-0 followed" data-id="'.$user_id.'"> Przestań obserwować</button>								
							';
						}
						echo '<button id="btnBlockUser" class="btn mt-3 rounded-0" data-id="'.$user_id.'"></button>';
					}	
				?>
			</div>
			<div class="fd-flex my-acc-info-third">
				<a href="/wyloguj.php"><i class="fas fa-power-off"></i></a>
			</div>
		</div>
		
		<div class="fd-flex my-acc-menu">
			<div class="my-acc-menu-item">
				<span><a href="/profil/<?php echo $userName; ?>">Profil</a></span>
			</div>
			<?php
			if ($_SESSION['login'] == $userName) {
				echo '
					<div class="my-acc-menu-item">
						<span><a href="/ustawienia">Ustawienia</a></span>
					</div>
				';
			} 
			?>
		</div>
		
		<div class="fd-flex my-acc-display-container">
			<div class="fd-flex my-acc-sidebar">
				<h4>Statystyki</h4>
				<div class="my-acc-sidebar-section">
					<h6>Memy</h6>
					<?php echo $ilosc_wrzuconych; ?><span> wrzuconych memów</span><br/>
					<?php echo $otrzymanychPlusow; ?><span> otrzymanych plusów</span><br/>
					0<span> danych plusów</span><br/>
					0<span> dodanych komentarzy</span>
				</div>
				<div class="my-acc-sidebar-section">
					<h6>Społeczność</h6>
					<?php echo $followedCount; ?><span> obserwujących</span><br/>
					<?php echo $followingCount; ?><span> obserwowanych</span>
				</div>
				<div class="my-acc-sidebar-section">
					<h6>Odznaki</h6>
					<img src="/img/odznaki/badge1.png" style="width: 50px; margin-right: 10px;" title="Odznaka przydzielona za dodanie pierwszego mema!"/>
					<img src="/img/odznaki/badge2.png" style="width: 45px;" title="Odznaka przydzielona za dodanie pierwszego mema!"/>
				</div>
				<div class="my-acc-sidebar-section">
					<h6>Obserwowane tagi</h6>
					<div class="d-flex justify-content-start flex-wrap">
						<?php 
							if (!empty($tags)) {
								foreach ($tags as $tag) {
									echo '<div class="flex-item mb-2"><span class="mr-1"><a class="profileFollowedTags pt-1 pr-2 pb-1 pl-2" href="/tag/'.$tag.'">#'.$tag.'</a></span></div>';
								} 
							} else {
								echo '<span>Brak obserwowanych tagów</span>';
							}	
						?>
					</div>
				</div>
			</div>
			<div class="my-acc-meme-section">
				<?php foreach ($mem_db as $row_obrazek){ ?>
				<div class="my-acc-meme-box">
					<div class="flexbox my-acc-meme-box-flex">
						<div class="my-acc-under-meme-info">
							<span class="hoverSpan"><span><?php echo ' '.$row_obrazek['plusy']; ?></span></span>
						</div>
					<div class="my-acc-meme-box-flex-inside">
						<img src="<?php echo $row_obrazek['obrazek']; ?>" />
					</div>
				</div>
			</div> 
			<?php } ?>
		</div>
	</div>

<?php
}
?>

<?php require_once(__THEMES_PATH__.'inc/footer.php'); ?>