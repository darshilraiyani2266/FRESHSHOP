<?php
session_start();
include 'config.php';

// Check if order_id is set in the URL
if (!isset($_GET['order_id'])) {
    header("Location: index.php?message=Invalid order!");
    exit();
}

// Get the order ID from the URL
$orderId = $_GET['order_id'];

// Fetch order details
$orderSql = "SELECT o.id, o.user_email, o.total_amount, o.order_date 
              FROM orders o 
              WHERE o.id = ?";
$orderStmt = $conn->prepare($orderSql);
$orderStmt->bind_param("i", $orderId);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();

// Check if the order exists
if ($orderResult->num_rows === 0) {
    header("Location: index.php?message=Order not found!");
    exit();
}

$order = $orderResult->fetch_assoc();

// Fetch order items
$orderItemsSql = "SELECT oi.quantity, p.productname, p.productprice, oi.subtotal 
                   FROM order_item oi 
                   JOIN products p ON oi.product_id = p.id 
                   WHERE oi.order_id = ?";
$orderItemsStmt = $conn->prepare($orderItemsSql);
$orderItemsStmt->bind_param("i", $orderId);
$orderItemsStmt->execute();
$orderItemsResult = $orderItemsStmt->get_result();

$orderItems = [];
while ($item = $orderItemsResult->fetch_assoc()) {
    $orderItems[] = $item;
}

// Close statements
$orderStmt->close();
$orderItemsStmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="styles.css"> 
    <?php include_once('includes/style.php'); ?>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #28a745;
    text-align: center;
}

h2 {
    border-bottom: 2px solid #28a745;
    padding-bottom: 10px;
}

h3 {
    margin-top: 20px;
    color: #343a40;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #dee2e6;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #e9ecef;
}

/* Button Styles */
a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    color: white;
    background-color: #007bff;
    border-radius: 5px;
    text-decoration: none;
}

a:hover {
    background-color: #0056b3;
}

    </style><!-- Add your CSS file here -->
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Order!</h1>
        <p>Your order has been placed successfully.</p>
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p><strong>User Email:</strong> <?php echo $order['user_email']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
        <p><strong>Order Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></p>

        <h3>Items in Your Order:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?php echo $item['productname']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['productprice'], 2); ?></td>
                        <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php">Continue Shopping</a>
    </div>
</body>
</html>
