<?php
session_start(); // Start the session
include('config.php'); // Database connection

// Check if email is stored in session (user must be logged in)
if (!isset($_SESSION['email'])) {
    header("Location: shop.php?message=Please log in to add items to your cart!");
    exit();
}

// Check if product ID is set
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $userEmail = $_SESSION['email']; // Email from session

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM cart WHERE product_id = ? AND email = ?");
    $stmt->bind_param("is", $productId, $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if product is already in the cart
    if ($result->num_rows > 0) {
        // Product is already in cart, increment quantity
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + 1;

        // Update quantity in cart table
        $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND email = ?");
        $updateStmt->bind_param("iis", $newQuantity, $productId, $userEmail);
        
        if (!$updateStmt->execute()) {
            // Error handling
            echo "Error updating quantity: " . $updateStmt->error;
        }
    } else {
        // Add new product to cart
        $insertStmt = $conn->prepare("INSERT INTO cart (product_id, email, quantity) VALUES (?, ?, ?)");
        $quantity = 1; // default quantity
        $insertStmt->bind_param("isi", $productId, $userEmail, $quantity);
        
        if (!$insertStmt->execute()) {
            // Error handling
            echo "Error inserting into cart: " . $insertStmt->error;
        }
    }

    // Close statements
    $stmt->close();
    if (isset($updateStmt)) {
        $updateStmt->close();
    }
    if (isset($insertStmt)) {
        $insertStmt->close();
    }

    // Redirect back to shop page or wherever you want
    header("Location: shop.php?message=Product added to cart!");
    exit();
} else {
    // Redirect if no ID is provided
    header("Location: shop.php?message=No product ID provided!");
    exit();
}
?>
