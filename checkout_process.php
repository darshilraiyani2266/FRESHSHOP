<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php?message=Please log in to view your cart!");
    exit();
}

// Get user email
$userEmail = $_SESSION['email'];

// Fetch cart items for the logged-in user
$sql = "SELECT c.quantity, p.id as product_id, p.productname, p.productprice 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

$orderItems = [];
$subTotal = 0;

// Loop through results and calculate totals
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPrice = $row['productprice'] * $row['quantity'];
        $row['totalPrice'] = $totalPrice;
        $orderItems[] = $row; // Store order items
        $subTotal += $totalPrice;
    }
}

// Calculate total amounts
$discount = 40; // Fixed discount
$couponDiscount = 10; // Fixed coupon
$tax = 2; // Fixed tax
$grandTotal = $subTotal - $discount - $couponDiscount + $tax;

// Insert order into order table
$orderSql = "INSERT INTO `orders` (user_email, total_amount) VALUES (?, ?)";
$orderStmt = $conn->prepare($orderSql);
$orderStmt->bind_param("sd", $userEmail, $grandTotal);
$orderStmt->execute();
$orderId = $orderStmt->insert_id; // Get last inserted order ID

// Insert order items into order_item table
foreach ($orderItems as $item) {
    $orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $orderItemStmt = $conn->prepare($orderItemSql);
    $orderItemStmt->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['productprice']);
    $orderItemStmt->execute();
}

$orderStmt->close();
$stmt->close();

// Clear cart after successful order placement
$clearCartSql = "DELETE FROM cart WHERE email = ?";
$clearCartStmt = $conn->prepare($clearCartSql);
$clearCartStmt->bind_param("s", $userEmail);
$clearCartStmt->execute();
$clearCartStmt->close();

header("Location: order_success.php?order_id=" . $orderId); // Redirect to a success page
exit();
