<div id="menu">
<ul id="menu_ul">
<?php
require('../connect.php');
if (isset($_SESSION['user_id']) and isset($_SESSION['login']))
{
	$spr_rangi=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
	if($spr_rangi['ranga']==1||$spr_rangi['ranga']==2)
	{
	list($w_poczekalni)=mysqli_fetch_row(mysqli_query($mysqli,"SELECT count(*) FROM shity WHERE czeka='1'"));
	echo'<li><a href="wyloguj.php"><i class="fas fa-sign-out-alt ikony_menu"></i></a></li>
	<li><a href="ustawienia.php"><i class="fas fa-cog ikony_menu"></i></a></li>
	<li><a href="poczekalnia.php"><i class="fas fa-clock ikony_menu"></i></a></li>
	<li><a href="index.php"><i class="fas fa-chart-line ikony_menu"></i></a></li>
	<li><a href="/imperiummemow"><i class="fas fa-home ikony_menu"></i></a></li>';
    }
}
else
{
	echo'<li><a href="login.php"><i class="fas fa-sign-in-alt ikony_menu"></i></a></li>';
}
?>
</ul>
</div>
