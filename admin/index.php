<?php 
	require_once('naglowek_admin.php');
?>
<?php 
$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
if( isset($_SESSION['user_id']) and isset($_SESSION['login']) and $spr_rangi['ranga']==1 || $spr_rangi['ranga']==2 ) {
?>
<div class="container text-left">
<?php	
list($wrzuconych_memów) = mysqli_fetch_row(mysqli_query($mysqli,"SELECT  count(*) FROM shity WHERE `upload_date` LIKE '%-".date('m')."-%'"));
list($wrzuconych_wszystkich) = mysqli_fetch_row(mysqli_query($mysqli,"SELECT  count(*) FROM shity"));
list($na_glownej)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM shity WHERE czeka='0'"));
list($w_poczekalni)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM shity WHERE czeka='1'"));


list($users)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM user"));
list($users_monthly) = mysqli_fetch_row(mysqli_query($mysqli,"SELECT  count(*) FROM user WHERE `data_zalozenia` LIKE '%-".date('m')."-%'"));

list($report_count)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM contact_case"));

$admin_mod = "SELECT login FROM user WHERE ranga = 1";
$show_admin_mod = mysqli_query($mysqli, $admin_mod);
$print_admin_mod = mysqli_fetch_assoc($show_admin_mod);
?>


<div class="flex-container">
	<div class="flex-item">
		<div class="flex-item-inside">
			<h2>Informacje o memach</h2>
			<div class="flex-item-inside-content">
				<p>Memów w tym miesiącu: <span><?php echo $wrzuconych_memów; ?></span></p>
				<p>Memy na NiePykło: <span><?php echo $wrzuconych_wszystkich; ?></span></p>
				<p>Memy na stronie głownej: <span><?php echo $na_glownej; ?></span></p>
				<p>Memy w poczekalni: <span><?php echo $w_poczekalni; ?></span></p>
			</div>
		</div>
	</div>

	<div class="flex-item">
		<div class="flex-item-inside">
			<h2>Informacje o użytkownikach</h2>
			<div class="flex-item-inside-content">
				<p>Zarejestrownych w tym miesiącu: <span><?php echo $users_monthly; ?></span></p>
				<p>Zarejestrowanych użytkowników <span><?php echo $users; ?></span></p>
			</div>
		</div>
	</div>
 
	<div class="flex-item">
		<div class="flex-item-inside">
			<h2>Zgłoszenia użytkowników</h2>
			<div class="flex-item-inside-content">
				<p>Ilość zgłoszeń: <span><?php echo $report_count; ?></span></p>
			</div>
		</div>
	</div>

	<div class="flex-item">
		<div class="flex-item-inside">
			<h2>Administratorzy</h2>
			<div class="flex-item-inside-content">
				<?php 
					foreach ($show_admin_mod as $row_admin) {
						echo '<p>'.$row_admin['login'].'</p>';
					}
				?>
			</div>
		</div>
	</div>

</div> 


</div>
<?php
}else{ 
	?>
 		<script>
 			window.location = "/login.php";
 		</script>
	<?php
}
?>

<?php require_once(__MAIN_PATH__.'themes/inc/footer.php'); ?>