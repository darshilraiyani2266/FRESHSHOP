<?php
// session_start(); // Ensure session is started
include('config.php'); // Include your database connection

// Initialize variables for cart details
$totalItems = 0; // To hold the total count of items in the cart
$totalPrice = 0; // To hold the total price of items in the cart

// Check if user is logged in
$isUserLoggedIn = isset($_SESSION['email']);

if ($isUserLoggedIn) {
    // Fetch cart items from the database based on user email
    $userEmail = $_SESSION['email'];
    // $username = $_SESSION['name']; // Fetch username from session


    // Prepare statement to fetch cart items based on the user's email
    $stmt = $conn->prepare("SELECT SUM(c.quantity) AS total_quantity, SUM(c.quantity * p.productprice) AS total_price 
                            FROM cart c 
                            JOIN products p ON c.product_id = p.id 
                            WHERE c.email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // If cart items are found, calculate totals
    if ($result->num_rows > 0) {
        $cartData = $result->fetch_assoc();
        $totalItems = $cartData['total_quantity'] ? $cartData['total_quantity'] : 0;
        $totalPrice = $cartData['total_price'] ? $cartData['total_price'] : 0;
    }

    $stmt->close(); // Close statement
}
?>

<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <!-- Left side with contact info -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>Call Us: <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        <li>
                            <?php if (!$isUserLoggedIn): ?>
                                <a href="login-register.php"><p>My Account</p></a>
                            <?php else: ?>
                                <a href="logout.php"><p>Account Logout</p></a>
                            <?php endif; ?>
                        </li>
                        <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                        <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Right side with promotional offers -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li><i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80</li>
                            <li><i class="fab fa-opencart"></i> 50% - 80% off on Vegetables</li>
                            <li><i class="fab fa-opencart"></i> Off 10%! Shop Vegetables</li>
                            <li><i class="fab fa-opencart"></i> Off 50%! Shop Now</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top Navigation -->
<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Header logo -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php"><img src="images/logo1.png" style="width:150px" class="logo" alt="Logo"></a>
            </div>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="shop.php">Sidebar Shop</a></li>
                            <li><a href="shop-detail.php">Shop Detail</a></li>
                            <li><a href="cart.php">Cart</a></li>
                            <li><a href="checkout.php">Checkout</a></li>
                            <li><a href="login-register.php">My Account</a></li>
                            <li><a href="wishlist.php">Wishlist</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                </ul>
            </div>

            <!-- Cart and Search -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu">
                        <a href="cart.php"><i class="fa fa-shopping-bag"></i>
                            <span class="badge"><?php echo $totalItems; ?></span>
                            <p>My Cart</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Cart details in the sidebar -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <?php if ($totalItems > 0): ?>
                        <?php
                        // Fetch cart items to display in the sidebar
                        $stmt = $conn->prepare("SELECT c.quantity, p.id, p.productname, p.productprice, p.image 
                                                FROM cart c 
                                                JOIN products p ON c.product_id = p.id 
                                                WHERE c.email = ?");
                        $stmt->bind_param("s", $userEmail);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($product = $result->fetch_assoc()):
                            ?>
                            <li>
                                <a href="#"><img class="img-fluid" src="images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="" /></a>
                                <h6><a href="#"><?php echo htmlspecialchars($product['productname']); ?></a></h6>
                                <p><?php echo $product['quantity']; ?>x - <span class="price">₹<?php echo number_format($product['productprice'] * $product['quantity'], 2); ?></span></p>
                            </li>
                        <?php endwhile; ?>
                        <li class="total">
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: ₹<?php echo number_format($totalPrice, 2); ?></span>
                        </li>
                    <?php else: ?>
                        <li><p>No items in cart.</p></li>
                    <?php endif; ?>
                </ul>
            </li>
        </div>

        <!-- Display Username at the End of Navigation -->
        <?php if ($isUserLoggedIn): ?>
            <div class="navbar-text ml-auto">
                <p class="mb-0">Welcome, <?php echo $userEmail ?>!</p>
            </div>
        <?php endif; ?>
    </nav>
</header>
<!-- End Main Top Navigation -->
