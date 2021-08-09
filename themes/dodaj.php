<?php require_once('/var/www/html/themes/inc/naglowek.php'); error_reporting (E_ALL ^ E_NOTICE); ?>
<div class="container">
	<div id="main" class="row justify-content-center">
		<div class="col-lg-12 dodaj">
			<div class="col-lg-8 pl-0 centerDiv">
				<div id="preview_div" class="w-100 border border-dark preview_div">
					<span id="preview">Wybierz mema, a w tym miejscu pojawi się jego podgląd.</span>
					<img class="img-fluid img_preview" id="output_image"/>
				</div>
				<div class="dodaj_btn">
					<form id="request" action="/dodawanie-mema" method="post" enctype="multipart/form-data" onsubmit="test()">	
						<div class="w-100 adult">
							<input id="adult" type="checkbox" value="1" name="adult"/>
							<label for="adult">NSFW</label>
							<header>Oznacz treści nieodpowiednie</header>
						</div>
						<textarea class="addImageTextarea w-100 border-dark p-3" placeholder="Tekst pod memem..." rows="6" name="image_description"></textarea>
						<div id="tags" class="w-100">

						</div>
						<input id="tagsAdded" name="tagsAdded" type="hidden" value="" />
						<input class="addPageTagInput w-100 border border-dark p-3 mb-2 mt-2" autocomplete="off" type="text" name="tag" maxlength="24" placeholder="Wpisz tagi...">
							<div class="upload border border-dark">
								<label for="dodawanie"><i class="fas fa-camera"></i></label>
								<input type="hidden" name="MAX_FILE_SIZE" value="41000000000" />
								<input id="dodawanie" name="image" type="file" onchange="preview_image(event)" />
							</div>
						<button class="addPageSubmitBtn border border-dark" name="submit"><i class="fas fa-check-square"></i></button>	
					</form>
				</div>
			</div>
			<div class="tagColumn rounded">
				<?php 
					$right = new Meme($default_db, (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL));
					$right->add_right_column();
				?>
			</div>
		</div>
	</div>
</div>
<?php 

if (isset($_POST['submit'])) {
	if (!$_FILES['image']['name']) {
		print_r("Dodaj obrazek");
		die;
	} else {
		$image_extenstion = explode(".",($_FILES['image']['name']));
		if (
			$image_extenstion[1] == "gif" or 
			$image_extenstion[1] == "jpg" or
			$image_extenstion[1] == "JPG" or 
			$image_extenstion[1] == "GIF" or 
			$image_extenstion[1] == "jpeg" or 
			$image_extenstion[1] == "JPEG" or 
			$image_extenstion[1] == "png" or
			$image_extenstion[1] == "PNG"
		) {
			$randomStringForImageName = bin2hex(openssl_random_pseudo_bytes(10)).".jpg";
			$destination_image = "/var/www/html/img/upload/".$randomStringForImageName;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $destination_image)) {
				$tags = str_replace(',', '', $_POST['tagsAdded']);
				$tags = array_filter(explode('#', $tags));
				$json_image_info = (object)[];

				$json_image_info->image_src = $randomStringForImageName;
				$json_image_info->tags = array_values($tags);
				$json_image_info->adult_check = (isset($_POST['adult']) ? 1 : 0);
				$json_image_info->image_description = $_POST['image_description'];

				$default_db->execute("
					INSERT INTO images (id_user, json_image_info, upload_date)
					VALUES (".$_SESSION['user_id'].", '".json_encode($json_image_info)."', NOW())
				");
			}
		}
	}
}

require_once(__THEMES_PATH__.'inc/footer.php'); 
?>
<script>
	$('#adult').click(function() { 
		var classList = $("#adult").attr('class').split(/\s+/);
		$.each(classList, function(index, item) {
			if (item === 'adult_unclicked'){
				$('#adult').removeClass('adult_unclicked');
				$('#adult').addClass('adult_clicked');
			}
			else{
				$('#adult').removeClass('adult_clicked');				
				$('#adult').addClass('adult_unclicked');
			}
		});
	});

	function preview_image(event) {
		$('#preview').hide();
		var reader = new FileReader();
		reader.onload = function()
		{
		var output = document.getElementById('output_image');
		$("#output_image").addClass("width");
		$("#preview_div").removeClass("preview_div");
		output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}
</script>