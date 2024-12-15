-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 05:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `product_id`, `quantity`) VALUES
(17, 'raiyanidarshil660@gmail.com', 2, 1),
(18, 'raiyanidarshil660@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL,
  `catname` varchar(100) NOT NULL,
  `catdescription` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catname`, `catdescription`, `image`) VALUES
(7, 'Oraganic Vegetable Seeds', 'Rainy Season Specials', '1728791750_vagitablescategory.jpg'),
(8, 'Fruit Seeds', 'all season fruit Seeds', '1728791878_fruitcategory.jpg'),
(12, 'Flower Seeds', 'All Season Flower Seeds', '1728792462_flowerscategories.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `payment_method` enum('Credit Card','Debit Card','PayPal','Bank Transfer') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `first_name`, `last_name`, `address`, `address2`, `country`, `state`, `zip`, `payment_method`, `total_amount`, `order_date`) VALUES
(1, 'raiyanidarshil660@gmail.com', '', '', '', '', '', '', '', '', 470.00, '2024-10-13 16:56:53'),
(8, 'raiyanidarshil660@gmail.com', '', '', '', '', '', '', '', '', 370.00, '2024-10-14 04:46:13'),
(9, 'raiyanidarshil660@gmail.com', '', '', '', NULL, '', '', '', 'Credit Card', 52.00, '2024-10-14 04:54:28'),
(10, 'raiyanidarshil660@gmail.com', '', '', '', NULL, '', '', '', 'Credit Card', 248.00, '2024-10-14 04:56:29'),
(11, 'raiyanidarshil660@gmail.com', '', '', '', NULL, '', '', '', 'Credit Card', 150.00, '2024-10-14 04:58:25'),
(12, 'raiyanidarshil660@gmail.com', '', '', '', NULL, '', '', '', 'Credit Card', 170.00, '2024-10-14 05:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`) VALUES
(1, 9, 1, 1, 100.00, 0.00, '2024-10-14 04:54:28'),
(2, 10, 2, 2, 98.00, 0.00, '2024-10-14 04:56:29'),
(3, 10, 1, 1, 100.00, 0.00, '2024-10-14 04:56:29'),
(4, 11, 1, 1, 100.00, 0.00, '2024-10-14 04:58:25'),
(5, 11, 2, 1, 98.00, 0.00, '2024-10-14 04:58:25'),
(6, 12, 2, 1, 98.00, 0.00, '2024-10-14 05:03:49'),
(7, 12, 3, 1, 120.00, 0.00, '2024-10-14 05:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `catid` int(100) NOT NULL,
  `subcatid` varchar(100) NOT NULL,
  `productname` varchar(150) NOT NULL,
  `productdescription` varchar(150) NOT NULL,
  `productprice` int(10) NOT NULL,
  `image` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catid`, `subcatid`, `productname`, `productdescription`, `productprice`, `image`) VALUES
(1, 7, '1', 'Organic tomato Seeds', 'tomato seeds', 100, '1728803872_tomato.jpg'),
(2, 7, '1', 'organic brocolli seeds', 'Brocolli Seeds', 98, 'new_image.jpg'),
(3, 7, '1', 'Oraganic okra Seeds', 'okra Seeds', 120, '1728803961_okra.jpg'),
(4, 7, '1', 'organic cucumber seeds', 'cucumber seeds', 85, '1728832316_cucumber.jpg'),
(5, 7, '1', 'Organic Green Chily Seeds', 'Green chily Seeds', 155, '1728832461_chily.jpg'),
(6, 8, '2', ' Organic lemon Seeds', '', 100, '1728833796_LIMON-snature.webp');

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE `sitesettings` (
  `id` int(5) NOT NULL,
  `sitename` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`id`, `sitename`, `address`, `phoneno`, `email`, `image`) VALUES
(6, 'Seeds Store', 'rajkot gujrat,\r\nmunjka rajkot,\r\nrajkot-360405\r\n', '7862092691', 'darshilraiyani@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(5) NOT NULL,
  `catid` varchar(100) NOT NULL,
  `subcatname` varchar(100) NOT NULL,
  `subcatdescription` varchar(150) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `catid`, `subcatname`, `subcatdescription`, `image`) VALUES
(1, '7', 'All Season vegetable Seeds', 'Organic Tomato Seeds', '1728794722_tomatoseeds.jpg'),
(2, '8', 'All  Season Fruit Seeds', 'Organic Passion Fruit Red And Yellow Seeds', '1728800858_img-pro-04.jpg'),
(3, '8', 'All  Season Fruit Seeds', '', '1728833687_1728791878_fruitcategory.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `city`) VALUES
(1, 'admin@gmail.com', 'd47268e9db2e9aa3827bba3afb7ff94a', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `name`, `gender`, `dob`, `phone`, `email`, `password`) VALUES
(2, 'ankur', 'Male', '2005-07-01', 2147483647, 'ankur@gmail.com', '2005'),
(3, 'darshil', 'Male', '2005-02-10', 2147483647, 'raiyanidarshil660@gmail.com', 'darshil@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitesettings`
--
ALTER TABLE `sitesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sitesettings`
--
ALTER TABLE `sitesettings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
