<button id="ham_but" class="hamburger hamburger--spin" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
<div id="menu" class="menu_main">
<ul id="menu_ul" class="">
<?php
if (isset($_SESSION['user_id']) and isset($_SESSION['login'])){
	$avatar=mysqli_fetch_array(mysqli_query($mysqli,"SELECT user_avatar FROM user WHERE login='".$_SESSION['login']."'"));
	$users=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM user WHERE login='".$_SESSION['login']."'"));
	echo '<li><img id="profile_pic" src="../img/ico/profile_ico.png" class="my_acc_menu"/>
	<ul id="expand_menu" class="submenu">';

			if ($users['ranga'] == 1){
				echo '<li class="expand-item-other"><a href="/admin/"><i class="fas fa-atom expand_ico"></i>Admin</a></li>';
			}

			echo '<li class="expand-item-other"><a href="/profil/'.$users['login'].'"><img src="img/ico/profile_ico.png" class="expand_menu_profile_ico"/><span>Profil</span></a></li>
			<li class="expand-item-other"><a href="/opis-zmian"><i class="fas fa-info-circle expand_ico"></i></i>Opis zmian</a></li>
			<li class="expand-item-other"><a href="themes/ranking.php"><i class="fas fa-trophy expand_ico_trophy"></i>Ranking</a></li>
			<li class="expand-item-other"><a href="/ustawienia"><i class="fas fa-cog expand_ico_trophy"></i>Ustawienia</a></li>
			<li class="expand-item-other"><a href="/formularz-kontaktowy"><i class="fas fa-phone expand_ico"></i></i>Kontakt</a></li>
			<li class="expand-item" style="text-align: center"><a href="/wyloguj.php"><i class="fas fa-power-off expand_ico"></i>Wyloguj się</a></li>
		</ul></li>';
}
else
{
	echo'<li><a href="/logowanie" title="Logowanie"><i style="color: #ff5917; margin-right: 5px !important" class="fas fa-sign-in-alt ikony_menu"></i></a></li>';
}

if (isset($_SESSION['user_id']) and isset($_SESSION['login'])){
	echo '<li><a href="/dodawanie-mema" title="Dodaj zdjęcie"><i class="fas fa-camera-retro ikony_menu"></i></a></li>';
}else{
	echo '<li><a href="/logowanie" title="Dodaj zdjęcie"><i class="fas fa-camera-retro ikony_menu"></i></a></li>';
}
?>
<li><a href="/losowanie" title="Losowe"><i class="fas fa-atom ikony_menu"></i></a></li>
<li><a href="/poczekalnia" title="Poczekalnia"><i class="fas fa-meteor ikony_menu"></i></a></li>
<li><a href="/" title="Strona główna"><i class="fas fa-rocket ikony_menu"></i></a></li>
</ul>
<script>
$("#ham_but").click(function(){
var classList = $("#ham_but").attr('class').split(/\s+/);
	$.each(classList, function(index, item) {
		if (item === 'is-active') {
			$("#ham_but").removeClass('is-active');
		}else{
			$("#ham_but").addClass('is-active');
		}
	});			
});

$('#profile_pic').click(function () {
	$('#expand_menu').animate({
	height: 'toggle'
	}, 0)
})

</script>
</div>
