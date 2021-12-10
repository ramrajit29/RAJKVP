<?php
include 'logChecker.php';
extract($_POST);

$prod_name 			= $con -> real_escape_string(remove_slashes($prod_name));
$prod_price 		= $con -> real_escape_string(remove_slashes($prod_price));
$upc_num 		    = $con -> real_escape_string(remove_slashes($upc_num));
$prod_status	    = $con -> real_escape_string(remove_slashes($prod_status));

if($prod_name=='' || $prod_price=='' || $upc_num==''){
    echo json_encode(array("success"=>false,"response"=>"Please give all required details"));
    exit;
}

$image_path_str = $file_name = '';
if($prod_photo_path!=''){
    $info = pathinfo($prod_photo_path);
    $file_name = $image_path_str = $info['basename'];
    @copy('temp/'.$file_name,'uploads/'.$file_name);    
}

$sql = "UPDATE `products` SET`product_name` = '$prod_name', `product_price` = '$prod_price', `product_upc_number` = '$upc_num', `product_status` = '$prod_status'";

if($file_name!=''){
    $sql .= " , `product_image` = '$file_name'";
}
$sql.= " WHERE product_id = '$edit_prod_id'";

$con -> query($sql);
$con -> close();

if($image_path_str!=''){
    @unlink('temp/'.$image_path_str);
    if($old_prod_photo_path!=''){
        @unlink('uploads/'.$old_prod_photo_path);
    }
}

echo json_encode(array("success"=>true,"response"=>"Updated successfully"));