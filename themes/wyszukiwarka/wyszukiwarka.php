<?php 

	if (isset($_GET['hashtag'])){
		$keyword = $_GET['hashtag'];
	}

	$category_question = "SELECT tag FROM tagi LIMIT 5";
	$result = mysqli_query($mysqli, $category_question);

?>
<form method="get" class="wyszukiwarka" action="themes/wyszukiwarka/wynik_wyszukiwania.php">
	<div class="search w-75">
		<label><i class="fas fa-search"></i></label>
		<input list="mylist" class="search_input w-100 h-100 awesomplete rounded" name="hashtag" type="text" placeholder="#" autocomplete="off" />
		<datalist id="mylist" class="dropdown_list">
			<?php
				if ($category_question){
					while ($tag = mysqli_fetch_assoc($result)){
							echo '<option>#'.$tag['tag'].'</option>';
					}
				}
			?>
		</datalist>
		<input class="szukaj" type="submit" name="szukaj" value="" />
	</div>
</form>