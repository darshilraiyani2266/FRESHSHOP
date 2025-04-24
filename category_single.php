<?php
session_start(); // Start the session
include('config.php'); // Include the database connection file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Seeds Store - Category</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
        body {
            height: 200vh; /* For testing purposes */
        }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="custom-select-box"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box"></div>
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Header -->
    <?php include 'includes/header.php'; ?>
    <!-- End Header -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Category Products</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page -->
    <div class="container">
        <div class="row">
            <?php
            // Check if the category ID is set in the URL
            if (!isset($_GET['id'])) {
                redirect('index.php', 'Invalid Category ID');
            }

            // Get the category ID from the URL
            $categoryId = intval($_GET['id']);

            // Fetch the category details
            $categoryQuery = "SELECT * FROM categories WHERE id = $categoryId";
            $categoryResult = mysqli_query($conn, $categoryQuery);
            $category = mysqli_fetch_assoc($categoryResult);

            // If the category does not exist, redirect to home
            if (!$category) {
                redirect('index.php', 'Category not found');
            }

            // Fetch products from this category
            $productsQuery = "SELECT * FROM products WHERE catid = $categoryId";
            $productsResult = mysqli_query($conn, $productsQuery);

            // Check if query was successful
            if ($productsResult && mysqli_num_rows($productsResult) > 0) {
                // Fetch and display each product
                while ($row = mysqli_fetch_assoc($productsResult)) {
                    $productname = htmlspecialchars($row['productname']);
                    $productprice = htmlspecialchars($row['productprice']);
                    $image = htmlspecialchars($row['image']);
                    $productdescription = htmlspecialchars($row['productdescription']);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="images/products/<?php echo $image; ?>" class="img-fluid" alt="Product Image" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="add_to_cart.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4><?php echo $productname; ?></h4>
                        <h5>₹<?php echo $productprice; ?></h5>
                        <p><?php echo $productdescription; ?></p>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<div class="col-md-12">No products available in this category.</div>';
            }
            // Close the database connection
            mysqli_close($conn);
            ?>
        </div> <!-- End of row -->
    </div> <!-- End of container -->

    <!-- Modal for success message -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage">Product added to cart!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>
    
    <!-- Back to Top Button -->
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>

    <script>
        $(document).ready(function() {
            // Get the URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');

            // If there's a message, display the modal
            if (message) {
                $('#modalMessage').text(message); // Set the message
                $('#successModal').modal('show'); // Show the modal
            }
        });
    </script>
</body> 
</html>
