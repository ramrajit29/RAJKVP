<?php
include 'header.php';
extract($_POST);

if(isset($prod_id) && $prod_id!=''){
    $product_ids = array();
    $product_ids[] = $prod_id;
}
if(isset($prodIds) && $prodIds!=''){
    $product_ids = explode(',',$prodIds);
}

if(sizeof($product_ids)>0){
    $product_ids_list = implode(',',$product_ids);
    $sql = "SELECT * FROM products WHERE product_id IN ($product_ids_list)";
    $result=mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)) 
    {
        $get_prod_id = $row['product_id'];
        if($row['product_image']!=''){
            $prod_image = 'uploads/'.$row['product_image'];
            @unlink($prod_image);
        }
        $delete_sql = "DELETE FROM products WHERE product_id=".$get_prod_id;
        mysqli_query($con,$delete_sql);
    }

    echo 'Product(s) deleted';
}
?>