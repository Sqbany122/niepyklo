<?php

$json = file_get_contents('php://input');
$obj = json_decode($json, true);
var_dump($obj);
die;
if ($obj['delete'] === true) {
    require_once('/config/connect.php');
        if ($mysqli->connect_error){
                die('Failed: '. $mysqli->connect_error);
        }

    $userLoginDataUsername = $_SESSION['login'];

    $delete = mysqli_query($mysqli, "
        SELECT a.id, a.ip, a.login_date
        FROM user_login_data a
        LEFT JOIN user b ON b.id = a.id_user
        WHERE b.login = '".$userLoginDataUsername."'
        ORDER BY a.id DESC
        LIMIT 5
    ");

    var_dump($delete);
    die;

    mysqli_close($mysqli);
}
