<?php

require_once('/config/connect.php');

	if ($mysqli->connect_error){
			die('Failed: '. $mysqli->connect_error);
	}

	$id = $_POST['id'];

	$result = mysqli_query($mysqli, "	
		SELECT 
		plusy 
		FROM 
		shity 
		WHERE 
		id=$id LIMIT 1
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				echo strval($row['plusy']);
		}
	}

	mysqli_close($mysqli);
?>