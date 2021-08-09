<?php 
require_once('/config/connect.php');
if ($mysqli->connect_error){
    die('Failed: '. $mysqli->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($obj['follow']) && $obj['follow'] === true) {
    $check = mysqli_query($mysqli, "
        SELECT a.id_user
        FROM followed_users a
        WHERE a.id_user = ".$_SESSION['user_id']."
        AND a.id_followed_user = ".$obj['followed_user_id']."
    ");

    if (mysqli_num_rows($check) < 1) {
        $insert = mysqli_query($mysqli, "
            INSERT INTO followed_users (id_user, id_followed_user)
            VALUES (".$_SESSION['user_id'].", ".$obj['followed_user_id'].")
        ");

        $followedUserName = mysqli_query($mysqli, "
            SELECT login
            FROM user
            WHERE id = ".$obj['followed_user_id']."
        ");

        foreach ($followedUserName as $userName) {
            $name = $userName['login'];
        }

        echo json_encode('Obserwujesz użytkownika <span class="followedUser">'.$name.'</span>');
    } else {
        $followedUserName = mysqli_query($mysqli, "
            SELECT login
            FROM user
            WHERE id = ".$obj['followed_user_id']."
        ");

        foreach ($followedUserName as $userName) {
            $name = $userName['login'];
        }

        $delete = mysqli_query($mysqli, "
            DELETE FROM followed_users
            WHERE id_user = ".$_SESSION['user_id']."
            AND id_followed_user = ".$obj['followed_user_id']."
        ");

        echo json_encode('Przestajesz obserwować użytkownika <span class="followedUser">'.$name.'</span>');
    }
} else {
    echo json_encode('Wystąpił nieoczekiwany błąd...');
}