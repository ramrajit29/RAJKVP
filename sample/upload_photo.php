<?php
include 'logChecker.php';
extract($_POST);
$targetDir = "temp" ;
$filename=$_FILES["post_image"]["name"];
$info = pathinfo($filename);
$user_id = $uid;

$file_text_name =  basename($filename,'.'.$info['extension']);
if(check_valid_file($_FILES["post_image"]["tmp_name"])){
    $file_path = md5($file_text_name.date('dmyhis').rand().$user_id).'.'.$info['extension'];
    move_uploaded_file($_FILES["post_image"]["tmp_name"],$targetDir.'/'.$file_path);
    echo 'temp/'.$file_path;
}

?>