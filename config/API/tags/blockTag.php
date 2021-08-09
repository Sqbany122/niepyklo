<?php 
require_once('/config/connect.php');
if ($mysqli->connect_error){
    die('Failed: '. $mysqli->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($obj['blockTag']) && $obj['blockTag'] === true) {

    $check = mysqli_query($mysqli, "
        SELECT * 
        FROM blocked_tagi
        WHERE user_id = ".$_SESSION['user_id']."
        AND tag_id = ".$obj['tag_id']."
    ");

    if (mysqli_num_rows($check) < 1) {

        $insert = mysqli_query($mysqli, "
            INSERT INTO blocked_tagi (user_id, tag_id)
            VALUES (".$_SESSION['user_id'].", ".$obj['tag_id'].")
        ");

        $select = mysqli_query($mysqli, "
            SELECT tag
            FROM tagi
            WHERE id = ".$obj['tag_id']."
        ");

        foreach ($select as $value) {
            $tagName = $value['tag'];
        }

        echo json_encode($tagName);

    } else {

        $delete = mysqli_query($mysqli, "
            DELETE FROM blocked_tagi
            WHERE user_id = ".$_SESSION['user_id']."
            AND tag_id = ".$obj['tag_id']."
        ");

        $select = mysqli_query($mysqli, "
            SELECT tag
            FROM tagi
            WHERE id = ".$obj['tag_id']."
        ");

        foreach ($select as $value) {
            $tagName = $value['tag'];
        }

        echo json_encode($tagName);
    }
}