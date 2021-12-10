<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
include("includes/config_class.php");

if(isset($_SESSION['admin_loggedin_id'])){
	$current_session 				= session_id();
	
	
	$loggedin_id 					= $_SESSION['admin_loggedin_id']; //MD5 ENCRYPTED VALUE
	$loggedin_ip 					= $_SERVER['REMOTE_ADDR']; //IP ADDRESS
	
	$loggedin_id 					= $con -> real_escape_string($loggedin_id);
	$loggedin_ip 					= $con -> real_escape_string($loggedin_ip);	
	
	$session_chk = "SELECT * FROM `validate_sessions` WHERE `session_id` = '$current_session' AND `user_logged_enc` = '$loggedin_id' AND `user_ip` = '$loggedin_ip' AND `user_logged_level` = '1'";
	
	$result=mysqli_query($con,$session_chk);
		
	if((mysqli_num_rows($result))>0)	
	{		
        $session_row                = $result -> fetch_assoc();
		$rowID 						= $session_row['log_id'];
		$lastActivity 				= $session_row['last_activity'];
		$session_datetime 			= date('Y-m-d H:i:s');
		$time_since_last_activity 	= timeDiff($lastActivity, $session_datetime);
		
		if($time_since_last_activity<$timeout_duration){
            
			$update_sql = "UPDATE `validate_sessions` SET `last_activity` = '$session_datetime' WHERE `log_id` = '$rowID'";
            $con -> query($update_sql);
            
			
			$person_loggedin 		= $session_row['user_name'];
			$person_loggedin_email 	= $session_row['user_email'];
			$uid 					= $session_row['user_logged_id'];
			$uid 					= $con -> real_escape_string($uid);
		}
		else{
			//SESSION TIMED OUT
			session_destroy();
			echo '<script>window.top.window.window.location="index.php";</script>';
			exit();
		}
	}
	else{
		//INVALID SESSION
		session_destroy();
		echo '<script>window.top.window.window.location="index.php";</script>';
		exit();
	}	
}
else{
	//SESSION DOES NOT EXIST
	session_destroy();
	echo '<script>window.top.window.window.location="index.php";</script>';
	exit();
}
?>