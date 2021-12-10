<?php
if($_SERVER['SERVER_NAME'] == 'localhost'){
	date_default_timezone_set('Asia/Calcutta');
	$con= new mysqli('localhost','root','','sample_db')or die("Could not connect to mysql".mysqli_error($con));
}
else{
	date_default_timezone_set('Europe/London');
	$con= new mysqli('localhost','root','','sample_db')or die("Could not connect to mysql".mysqli_error($con));
}

$timeout_duration = 60000;
$current_date_time = date("Y-m-d H:i:s");
$current_date = date("Y-m-d");
include_once('functions.php');
?>