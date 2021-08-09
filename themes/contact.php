<?php 
    require_once('/var/www/html/themes/inc/naglowek.php');

    // adding form message to database.
	if (isset($_POST['submit']) && isset($_SESSION['login'])) {

		$user = $mysqli->real_escape_string(htmlentities($_SESSION['login'], ENT_QUOTES, "UTF-8"));
		$case = $mysqli->real_escape_string(htmlentities($_POST['case'], ENT_QUOTES, "UTF-8"));

		$send_case = "INSERT INTO contact_case (id, single_case, user, add_date) VALUES ('', '$case', '$user', NOW())";
		$do = mysqli_query($mysqli, $send_case);
		?>
			<script>
				window.location = "/formularz-kontaktowy";
			</script>
		<?php
	}
?>

<div class="container containerContact">
    <h1 style="text-align: center;">Formularz kontaktowy</h1> 
	<div class="list_tdch">
		<form method="post" action="/formularz-kontaktowy">
			<div class="row justify-content-center">
				<div class="col-lg-10 p-0">
				<textarea name="case" class="contactTextarea border border-dark" placeholder="Opisz błąd jaki napotkałeś."></textarea>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10 text-left p-0">
					<button class="contactBtn border border-dark" name="submit">Wyśli zgłoszenie</button>
				</div>
			</div>
		</form>
	</div>
</div>	

<?php require_once('/var/www/html/themes/inc/footer.php'); ?>