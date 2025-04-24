<?php
include'config.php';
extract($_POST);
$filename=time()."_".$_FILES['image']['name'];
$path="../images/subcategories/".$filename;
$subcatdescription = mysqli_real_escape_string($conn , $subcatdescription);
if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
    $qry="insert into subcategories(catid,subcatname,subcatdescription,image) values('".$catid."','".$subcatname."','".$subcatdescription."','".$filename."')";  
    mysqli_query($conn,$qry) or exit("Sub Category insert fail".mysqli_error($conn));
    $_SESSION['error']="Sub Category Added Successfdully";
     header("location:subcategory_add.php");  
}else{
    $_SESSION['error'] = "file upload fail";
     header("location:subcategory_add.php");
}



?>