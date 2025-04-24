
<?php
// Start session

session_start();
include_once('includes/config.php');
    $id=$_REQUEST['id'];
    // echo $id;
    // die();
// Check if user is not logged in
if (isset($_SESSION['uname'])) {
    // dd()
    //echo $id;
    // die();
    $qry="delete from subcategories where id=$id";
    mysqli_query($conn,$qry)or exit("delete fail".mysqli_error($conn));
    $_SESSION['error']="subcategory delete successfully";
    header("Location:subcategory.php");
}else{
    $_SESSION['error']="file upload fail";
    header("Location:dashboard.php");
    // Redirect to login page
    
}
?>
