

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
        .img-container {
    position: relative; /* Needed for positioning the overlay */
}

.img-container img {
    display: block; /* Ensures that the image takes up the full width */
}

.action-icons {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
    opacity: 0; /* Initially hidden */
    transition: opacity 0.3s ease; /* Fade effect */
}

.img-container:hover .action-icons {
    opacity: 1; /* Show on hover */
}

.action-icons ul {
    list-style: none;
    padding: 0;
    display: flex;
    margin-bottom: 10px;
}

.action-icons ul li {
    margin: 0 5px; /* Space between icons */
}

.cart {
    background-color: #007bff; /* Change as per your theme */
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
}

    </style>