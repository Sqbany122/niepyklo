<?php

require_once('/var/www/html/config/connect.php');

if ($mysqli->connect_error){
		die('Failed: '. $mysqli->connect_error);
}

	$json = file_get_contents('php://input');
	$object = json_decode($json, true);
	$user_id = $_SESSION['user_id'];
	
	if ($user_id) {
		if ($object['type'] == 'increment') {
			$increment = mysqli_query($mysqli, "
				UPDATE images
				SET upvote_count = upvote_count + 1 
				WHERE id = ".$object['id']."
			");

			$insertUserPlus = mysqli_query($mysqli, "
				INSERT INTO plus_count (id_image, id_user)
				VALUES (".$object['id'].", ".$user_id.")
			");
		} elseif ($object['type'] == 'decrement') {
			$increment = mysqli_query($mysqli, "
				UPDATE images 
				SET upvote_count = upvote_count - 1 
				WHERE id= ".$object['id']."
			");

			$deleteUserPlus = mysqli_query($mysqli, "
				DELETE FROM plus_count
				WHERE id_image = ".$object['id']."
				AND id_user = ".$user_id."
			");
		}

		$getMemePlusCount = $default_db->query("
			SELECT upvote_count
			FROM images
			WHERE id = ".$object['id']."
		");

		echo json_encode(array(
			'plus_count' => $getMemePlusCount[0]['upvote_count'],
			'status' => 1
		));
	} else {
		echo json_encode(array(
			'info' => "Zaloguj się aby polubić mema!",
			'status' => 0
		));
	}

mysqli_close($mysqli);	
	
?>

