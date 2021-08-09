<?php 
	error_reporting (E_ALL ^ E_NOTICE);
	require_once('naglowek_admin.php'); 
	require_once('class/waitingRoom.php');
	$memes = new WaitingRoom($default_db);
?> 

<div class="mainDiv w-100 h-100 p-4">
	<div class="waitingRoom-imagesBox">
		<?php
			$memes->showMemesAdminWaitingRoom();
		?>
	</div>
</div>

<script src="assets/js/waitingRoom.js"></script>
<?php require_once(__THEMES_PATH__.'inc/footer.php'); ?>