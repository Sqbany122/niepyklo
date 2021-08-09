<?php
require_once('/config/connect.php');
if ($mysqli->connect_error){
    die('Failed: '. $mysqli->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($obj !== NULL) {
    $memeId = $obj['id'];
}

if (isset($obj['add']) && $obj['add'] === true) {
    $update = mysqli_query($mysqli, "
        UPDATE shity 
        SET czeka='0', upload_date=NOW() 
        WHERE id = ".$memeId."
    ");
}

if (isset($obj['delete']) && $obj['delete'] === true) {
    $filename=mysqli_fetch_array(mysqli_query($mysqli,"
        SELECT obrazek 
        FROM shity 
        WHERE id = ".$memeId."
    "));
    $delete = mysqli_query($mysqli, "
        DELETE FROM shity 
        WHERE id = ".$memeId."
    ");
    @unlink($filename['obrazek']);
}

mysqli_close($mysqli);