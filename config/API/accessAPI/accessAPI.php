<?php
require_once('/config/connect.php');
if ($mysqli->connect_error){
    die('Failed: '. $mysqli->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($obj['action']) && $obj['action'] === true) {
    $userLoginDataId = $obj['accessId'];

    $delete = mysqli_query($mysqli, "
        DELETE FROM user_login_data
        WHERE id = '".$userLoginDataId."'
    ");
} 

mysqli_close($mysqli);
