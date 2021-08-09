<?php include_once('../inc/header.php'); ?>

<div class="clearfix main ">
<?php 
$data=date('d-m-Y H:i');
$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
if (!isset($_SESSION['user_id']) and !isset($_SESSION['login']) and (!$spr_rangi['ranga']==1||!$spr_rangi['ranga']==2)){
?>
	<script>
 		window.location = "/niepyklo/login.php";
 	</script>
<?php
}else{
list($w_poczekalni)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM shity WHERE czeka='1'"));
if($w_poczekalni==0){
	echo '<p style="position: absolute;">Brak memów do zaakceptowania</p>';
}else{
?>
<div class="row w-100 m-0 img_accept_first_box justify-content-center">
<?php 
$zapytanie = mysqli_query($mysqli, "SELECT * FROM shity WHERE czeka='1' ORDER BY upload_date DESC");
if ($zapytanie) {  
while ($shit = mysqli_fetch_array($zapytanie)) {
$shit['obrazek'] = str_replace('.','/niepyklo', $shit['obrazek']);
echo $shit['obrazek'];
    echo '<div class="d-flex p-4 justify-content-center">
		<div class="w-100 h-100 img_all_box">	
		<div class="p-2 w-100 img_acept_third_box">
			<div class="img_acept_fourth_box">
				<a href=".'.$shit['obrazek'].'" rel="lytebox"><img class="img-fluid img_accept" src=".'.$shit['obrazek'].'" /></a>
			</div>				
		</div>
			<div class="w-100 h-100">
				<div class="w-75 h-25 p-2 float">
					<span>Autor: '.$shit['autor'].'</span><br/>
					<span>Tagi: '.$shit['category'].'</span>
				</div>
				<div class="w-25 h-25 pt-2 pb-2 float">
					<div class="w-50 h-100 float pt-2" style="text-align: center;">
						<a style="text-decoration: none;" href="?akcept=tak&id='.$shit['id'].'"><i class="fas fa-check-circle ikony_poczekalnia"></i>
					</div>
					<div class="w-50 h-100 float pt-2" style="text-align: center;">
						<a style="text-decoration: none;" href="?usun=tak&id='.$shit['id'].'")"><i class="fas fa-times-circle ikony_poczekalnia"></i>
					</div>
				</div>
			</div>
		</div>		
	  </div>';
}
}
?>
</div>
<?php

if($_GET['akcept']=='tak') {
    mysqli_query($mysqli,"UPDATE shity SET czeka='0', upload_date=NOW() WHERE id='".$_GET['id']."';");
}
if($_GET['usun']=='tak') {
   $filename=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM shity WHERE id='".$_GET['id']."';"));
   mysqli_query($mysqli,"DELETE FROM shity WHERE id='".$_GET['id']."';");
   @unlink('../'.$filename['obrazek']);
}
}
}
?>
</div>

<?php include_once('../inc/footer.php'); ?>