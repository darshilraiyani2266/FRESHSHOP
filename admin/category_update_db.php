<?php
session_start();

if (isset($_SESSION['uname'])) {
    include 'config.php';

    // Sanitize and validate input
    $catname = mysqli_real_escape_string($conn, $_POST['catname']);
    $catdescription = mysqli_real_escape_string($conn, $_POST['catdescription']);
    
    // Check if file was uploaded and if there's no upload error
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Generate a unique filename
        $filename = time() . "_" . basename($_FILES['image']['name']);
        $path = "../images/categories/" . $filename;

        // Ensure the directory exists
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            // Prepare and execute the SQL query using a prepared statement
            $stmt = $conn->prepare("INSERT INTO categories (catname, catdescription, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $catname, $catdescription, $filename);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Category added successfully";
            } else {
                $_SESSION['error'] = "Failed to add category: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "File upload failed";
        }
    } else {
        $_SESSION['error'] = "No file uploaded or upload error";
    }

    header("Location: category_add.php");
    exit;
} else {
    $_SESSION['error'] = "You are not authorized to access this page without login";
    header("Location: index.php");
    exit;
}
?>
