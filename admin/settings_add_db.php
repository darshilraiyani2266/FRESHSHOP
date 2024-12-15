
<?php
session_start();
include('config.php');
$sitename = $_POST['sitename'];
$address = $_POST['text'];
$phoneno = $_POST['phoneno'];
$email = $_POST['email'];



$qry="UPDATE `sitesettings` SET `sitename`='$sitename',`address`='$address',`phoneno`='$phoneno',`email`='$email' WHERE id='6'";
$result=mysqli_query($conn,$qry) or exit("select user fail".mysqli_error($conn));

if($result>0){
    $_SESSION['uname']=$username;
    header("location:settings.php");
}else{
    $_SESSION["error"] = "username or password is incorrect";
 
}
?>
