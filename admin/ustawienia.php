<?php require('../connect.php'); ?>
<?php include('naglowek_admin.php'); ?> 
<div id="kontener">
<h1 class="admin_h1">Ustawienia</h1>
<?php
$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
if (isset($_SESSION['user_id']) and isset($_SESSION['login']) and $spr_rangi['ranga']==2)
{
if(isset($_POST['zapisz'])) { 
$zapytanie_update = mysqli_query($mysqli,"UPDATE `conf` SET `tytul` = '".$_POST['tytul_strony']."', `slogan` = '".$_POST['slogan']."', `logo` = '".$_POST['kod_logo']."', `description` = '".$_POST['opis']."', `tags` = '".$_POST['tagi']."', `img_na_strone` = '".$_POST['na_jednej_stronie']."', `regulamin` = '".$_POST['regulamin']."', `email` = '".$_POST['email']."' WHERE id='1';");
echo '<h1 class="admin_h1">Zaktualizowano<h1>
<a href="ustawienia.php" class="button_next_first"><i class="fas fa-arrow-left"></i></a>'; 
}
else {
?>
<form action="ustawienia.php" method="post">
<table>
						
					<tr>
						<td class="td_ustawienia">Tytuł strony</td>
						<td>
							<input class="td_input" type="text" name="tytul_strony" value="<?php echo $ustawienia['tytul']; ?>">
						</td>
					</tr> 
					<tr>
						<td class="td_ustawienia">Memów na jednej stronie:</td>
						<td>
							<input class="td_input" type="text" name="na_jednej_stronie" value="<?php echo $ustawienia['img_na_strone']; ?>">
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button name="zapisz" class="td_input"><i class="fas fa-save"></i></button>
						</td>
					</tr>
				</table>
				</form>
<?php
}
}
else {
header('Location: /niepyklo/login.php');
}
?>
</div>
<div class="social">
	<?php include_once('sociale.php'); ?>
</div>
</body>
</html>