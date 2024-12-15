<?php
session_start();
include('config.php');

// Check if user is logged in by checking the session for email
if (!isset($_SESSION['email'])) {
    header("Location: login.php?message=Please log in to view your cart!");
    exit();
}

// Fetch user email from session
$userEmail = $_SESSION['email'];

// Fetch cart items from the database based on user email
$cartProducts = []; // Array to hold product details
$totalAmount = 0; // Variable to hold the total amount

// Prepare statement to fetch cart items based on the user's email
$stmt = $conn->prepare("SELECT c.quantity, p.id, p.productname, p.productprice, p.image 
                        FROM cart c 
                        JOIN products p ON c.product_id = p.id 
                        WHERE c.email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

// Loop through the cart items and calculate totals
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $totalPrice = $product['productprice'] * $product['quantity'];
        $product['totalPrice'] = $totalPrice; // Store total price for each product
        $cartProducts[] = $product; // Add product details to the cart array
        $totalAmount += $totalPrice; // Calculate total cart amount
    }
} else {
    $cartProducts = []; // Empty cart
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seeds Store</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="custom-select-box"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <?php include 'includes/header.php'; ?>

    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Cart -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cartProducts)) : ?>
                                    <?php foreach ($cartProducts as $product) : ?>
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid" src="images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">
                                                    <?php echo htmlspecialchars($product['productname']); ?>
                                                </a>
                                            </td>
                                            <td class="price-pr">
                                                <p>₹<?php echo htmlspecialchars($product['productprice']); ?></p>
                                            </td>
                                            <td class="quantity-box">
                                                <input type="number" size="4" value="<?php echo $product['quantity']; ?>" min="0" step="1" class="c-input-text qty text" readonly>
                                            </td>
                                            <td class="total-pr">
                                                <p>₹<?php echo $product['totalPrice']; ?></p>
                                            </td>
                                            <td class="remove-pr">
                                                <a href="remove_from_cart.php?id=<?php echo $product['id']; ?>">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Your cart is empty!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold">₹<?php echo $totalAmount; ?></div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5">₹<?php echo $totalAmount; ?></div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <a href="checkout.php" class="ml-auto btn hvr-hover">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <?php include("includes/footer.php"); ?>
    <?php include("includes/script.php"); ?>

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
