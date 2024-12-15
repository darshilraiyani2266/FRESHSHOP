<?php
include_once('config.php');
session_start(); // Start the session if not already started

// Extract form data
extract($_POST);

// Sanitize inputs
$productdescription = mysqli_real_escape_string($conn, $productdescription);
$productname = mysqli_real_escape_string($conn, $productname);
$productprice = mysqli_real_escape_string($conn, $productprice);
$catid = mysqli_real_escape_string($conn, $catid);
$subcatid = mysqli_real_escape_string($conn, $subcatid);
$id = mysqli_real_escape_string($conn, $id);

// Initialize a variable to check for errors
$updateSuccess = false;

// Handle image upload
if ($_FILES['image']['error'] == 0) {
    $filename = time() . "_" . basename($_FILES['image']['name']);
    $path = "../images/products/" . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        $qry = "UPDATE products SET catid = '$catid', subcatid = '$subcatid', productname = '$productname', productdescription = '$productdescription', productprice = '$productprice', image = '$filename' WHERE id = $id";
        if (mysqli_query($conn, $qry)) {
            $_SESSION['message'] = "product updated successfully";
            $updateSuccess = true;
        } else {
            $_SESSION['error'] = "Database error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error'] = "File upload failed. Please check the permissions for the directory.";
    }
} else {
    $qry = "UPDATE products SET catid = '$catid', subcatid = '$subcatid', productname = '$productname', productdescription = '$productdescription', productprice = '$productprice' WHERE id = $id";
    if (mysqli_query($conn, $qry)) {
        $_SESSION['message'] = "product updated successfully";
        $updateSuccess = true;
    } else {
        $_SESSION['error'] = "Database error: " . mysqli_error($conn);
    }
}

// Redirect based on success
if ($updateSuccess) {
    header("Location: product.php");
    exit;
} else {
    header("Location: product_edit.php?id=$id");
    exit;
}

// Close the database connection

?>