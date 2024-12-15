<?php
session_start();

if (isset($_SESSION['uname'])) {
    include 'config.php';

    if (isset($_REQUEST["id"]) && is_numeric($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM subcategories WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['error'] = "Subcategory deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete Subcategory: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid Subcategory ID";
    }

    $conn->close();
    header("Location: Subcategory.php");
    exit();
} else {
    $_SESSION['error'] = "You are not authorized to access this page without logging in";
    header("Location: index.php");
    exit();
}
?>
