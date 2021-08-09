<?php
require_once('/config/connect.php');
if ($mysqli->connect_error){
    die('Failed: '. $mysqli->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($obj['add_tag']) && $obj['add_tag'] === true) {

    $check = mysqli_query($mysqli, "
        SELECT tag
        FROM tagi
        WHERE tag = '".$obj['tag_name']."'
    ");

    if (mysqli_num_rows($check) < 1) {

        $insert = mysqli_query($mysqli, "
            INSERT INTO tagi (id, tag, followers)
            VALUES ('', '".$obj['tag_name']."', 0)
        ");

        $last_id = $mysqli->insert_id;

        $array = [
            'id' => $last_id,
            'name' => $obj['tag_name']
        ];

        echo json_encode($array);
    } else {
        echo json_encode(500);
    }
} elseif (isset($obj['follow_tag']) && $obj['follow_tag'] === true) {

    $check = mysqli_query($mysqli, "
        SELECT *
        FROM followed_tagi
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
    
    if (mysqli_num_rows($check) < 1) {

        $insert = mysqli_query($mysqli, "
            INSERT INTO followed_tagi (user_id, tag_id)
            VALUES ('".$_SESSION['user_id']."', '".$obj['tag_id']."')
        ");

        $update = mysqli_query($mysqli, "
            UPDATE tagi
            SET followers = followers + 1
            WHERE id = ".$obj['tag_id']."
        ");

        $select = mysqli_query($mysqli, "
            SELECT followers
            FROM tagi
            WHERE id = ".$obj['tag_id']."
        ");

        foreach ($select as $value) {
            $tagFollowers = $value["followers"];
        }
        
        $tagInfo = [
            'name' => $tagName,
            'followers' => $tagFollowers
        ];

        echo json_encode($tagInfo);

    } else {
        $delete = mysqli_query($mysqli, "
            DELETE
            FROM followed_tagi
            WHERE user_id = ".$_SESSION['user_id']."
            AND tag_id = ".$obj['tag_id']." 
        ");

        $update = mysqli_query($mysqli, "
            UPDATE tagi
            SET followers = followers - 1
            WHERE id = ".$obj['tag_id']."
        ");

        $select = mysqli_query($mysqli, "
            SELECT followers
            FROM tagi
            WHERE id = ".$obj['tag_id']."
        ");

        foreach ($select as $value) {
            $tagFollowers = $value["followers"];
        }

        $tagInfo = [
            'name' => $tagName,
            'followers' => $tagFollowers
        ];

        echo json_encode($tagInfo);
    }
}

mysqli_close($mysqli);