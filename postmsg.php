<?php
include 'db_connect.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO `messages` ( `msg`, `room`, `ip`, `ctime`) VALUES ( '$msg', '$room', '$ip', current_timestamp());";
mysqli_query($con,$sql);
mysqli_close($con);


?>