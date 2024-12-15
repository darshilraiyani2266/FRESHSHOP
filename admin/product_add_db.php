<?php
include('config.php');
extract($_POST);
$filename=time()."_".$_FILES['image']['name'];
$path="../images/products/".$filename;
$productdescription = mysqli_real_escape_string($conn , $productdescription);
if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
    // $qry = "INSERT INTO products (catid, subcatid, productname, productdescription, productprice, image) 
    // VALUES ('".$catid."', '".$subcatid."', '".$productname."', '".$productdescription."', '".$productprice."', '".$filename."')";
    $qry = "INSERT INTO products (catid, subcatid, productname, productdescription, productprice, image) 
    VALUES ('".$catid."', '".$subcatid."', '".$productname."', '".$productdescription."', '".$productprice."', '".$filename."')";

    mysqli_query($conn,$qry) or exit(" product insert fail".mysqli_error($conn));
    $_SESSION['error']="product Added Successfdully";
     header("location: products_add.php");  
}else{
    $_SESSION['error'] = "file upload fail";
     header("location: products_add.php");
}



?>