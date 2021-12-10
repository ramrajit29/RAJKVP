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

$image_path_str = '';
if($prod_photo_path!=''){
    $info = pathinfo($prod_photo_path);
    $file_name = $image_path_str = $info['basename'];
    @copy('temp/'.$file_name,'uploads/'.$file_name);
}
$sql = "INSERT INTO `products` (`product_name`, `product_price`, `product_upc_number`, `product_status`, `product_image`) VALUES ('$prod_name', '$prod_price', '$upc_num', '$prod_status', '$image_path_str');";
$con -> query($sql);
$con -> close();

if($image_path_str!=''){
    @unlink('temp/'.$image_path_str);
}

echo json_encode(array("success"=>true,"response"=>"Added successfully"));
?>