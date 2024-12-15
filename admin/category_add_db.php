<?php
session_start();

// Ensure user is logged in
if(isset($_SESSION['uname'])) {
    include('config.php');

    // Check if the required fields and file are provided
    if (isset($_POST['catname'], $_POST['catdescription'], $_FILES['image'])) {
        $catname = mysqli_real_escape_string($conn, $_POST['catname']);
        $catdescription = mysqli_real_escape_string($conn, $_POST['catdescription']);
        $filename = time() . "_" . basename($_FILES['image']['name']);
        $path = "../images/category/" . $filename;

        // Check for successful file upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            // Use a prepared statement to prevent SQL injection
            $qry = $conn->prepare("INSERT INTO categories (catname, catdescription, image) VALUES (?, ?, ?)");
            $qry->bind_param("sss", $catname, $catdescription, $filename);

            if ($qry->execute()) {
                $_SESSION['success'] = "Category added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add category: " . $conn->error;
            }
        } else {
            $_SESSION['error'] = "File upload failed.";
        }
    } else {
        $_SESSION['error'] = "Please provide all required fields.";
    }

    // Redirect to category_add.php
    header("Location: category_add.php");
    exit();
} else {
    $_SESSION['error'] = "You are not authorized to access this page without logging in.";
    header("Location: index.php");
    exit();
}
?>
