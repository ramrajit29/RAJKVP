<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
include("includes/config_class.php");
extract($_POST);
$user_email 		= $con -> real_escape_string(remove_slashes($email_id));

if($user_email!=''){
    if(!validate_email_id($user_email)){
        echo json_encode(array("success"=>false,"response"=>"Invalid email address"));
        exit;
    }

    $str = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $result=mysqli_query($con,$str);
            
    if((mysqli_num_rows($result))>0)
    {
        $get_row            = $result -> fetch_assoc();
		$user_id 			= $get_row['user_id'];

        $new_password = random_int(100000, 999999);
        $pass = md5($new_password);

        $update_sql = "UPDATE `users` SET `user_pass` = '$pass' WHERE `user_id` = '$user_id'";
        $con -> query($update_sql);

        $message = 'Hi,<br><br>Your password has been reset<br><br>Your new password is : '.$new_password.'<br><br>Regards';

        $message = wordwrap($message,70);
        mail($user_email,"Your password has been changed",$message);
        echo json_encode(array("success"=>true,"response"=>'Password has been reset and emailed'));
        exit;
    }else{
        echo json_encode(array("success"=>false,"response"=>"Email address not exist in the system"));
        exit;
    }
}else{
    echo json_encode(array("success"=>false,"response"=>"Eemail address field empty"));
}
?>