<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
include("includes/config_class.php");
extract($_POST);

$user_name 			= $con -> real_escape_string(remove_slashes($user_name));
$user_email 		= $con -> real_escape_string(remove_slashes($user_email));
$user_phone 		= $con -> real_escape_string(remove_slashes($user_phone));
$password           = md5($_POST['user_desire_pwd']);

if($user_name=='' || $user_email=='' || $user_phone=='' || $password==''){
    echo json_encode(array("success"=>false,"response"=>"Please give all required details"));
    exit;
}

$str = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
$result=mysqli_query($con,$str);
		
if((mysqli_num_rows($result))>0)
{
    echo json_encode(array("success"=>false,"response"=>"User already exist"));
    exit;
}

if(!validate_email_id($user_email)){
    echo json_encode(array("success"=>false,"response"=>"Invalid email address"));
    exit;
}

$user_enc			= md5(date('dmYHis').$user_email);

$sql = "INSERT INTO `users`(`user_name`, `user_email`, `user_pass`, `user_phone`, `user_enc`) VALUES ('$user_name', '$user_email', '$password', '$user_phone', '$user_enc')";
$con -> query($sql);
$user_id = $con -> insert_id;
$con -> close();

echo json_encode(array("success"=>true,"response"=>"Added successfully"));
?>