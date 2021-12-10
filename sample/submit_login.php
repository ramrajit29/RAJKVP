<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
include("includes/config_class.php");
extract($_POST);

$email 	= $con -> real_escape_string(remove_slashes($username));
$password	= 	md5($_POST['pass_word']);

$sql = "SELECT * FROM `users` WHERE `user_email`='$email' and `user_pass`='$password'";
$result=mysqli_query($con,$sql);

if((mysqli_num_rows($result))>0)	
{        
    $row = $result -> fetch_assoc();
    $userenc 							= $row['user_enc'];
	$userid 							= $row['user_id'];
	$username 							= $row['user_name'];
	$useremail 							= $row['user_email'];
	$userip								= $_SERVER['REMOTE_ADDR'];

    $_SESSION['admin_loggedin_id']	= $userenc;
    session_regenerate_id(); 
	$current_session 					= session_id();
    $timestamp = date('Y-m-d H:i:s');
    $validate_sql = "INSERT INTO `validate_sessions` (`session_id`, `user_logged_enc`, `user_logged_id`, `user_logged_level`, `user_name`, `user_email`, `user_ip`, `last_activity`) VALUES 
    ('$current_session', '$userenc', '$userid', '1', '$username', '$useremail', '$userip', '$timestamp')";

    $con -> query($validate_sql);
    $con -> close();

    echo '<script>window.location="dashboard.php";</script>';    
}else{
    echo '<span style="text-align:center;color:#ff0000;padding-left:20px">Invalid login</span>';
}
?>