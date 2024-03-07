-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 01:16 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flydreamair`
--

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_brands`
--

CREATE TABLE `flydreamair_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_brands`
--

INSERT INTO `flydreamair_brands` (`id`, `name`, `handle`) VALUES
(1, 'Dior', 'dior'),
(2, 'Fenty Beauty', 'fenty-beauty'),
(3, 'Rare Beauty', 'rare-beauty'),
(4, 'Huda Beauty', 'huda-beauty'),
(5, 'Innoxa', 'innoxa'),
(6, 'Fitbit', 'fitbit'),
(7, 'Homedics', 'homedics'),
(8, 'Dove', 'dove'),
(9, 'Gillette', 'gillette'),
(10, 'Johnsons', 'johnsons'),
(11, 'Skin Proud', 'skin-proud'),
(12, 'SkinB5', 'skinb5'),
(13, 'Hugo Boss', 'hugo-boss'),
(14, 'Giorgio Armani', 'giorgio-armani'),
(15, 'Yves Saint Laurent', 'yves-saint-laurent'),
(16, 'Garmin', 'garmin'),
(17, 'Renpho', 'renpho');

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_cart`
--

CREATE TABLE `flydreamair_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_categories`
--

CREATE TABLE `flydreamair_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_page` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_categories`
--

INSERT INTO `flydreamair_categories` (`id`, `name`, `handle`, `image`, `home_page`) VALUES
(1, 'Airline Exclusives', 'airline-exclusives', '', 0),
(2, 'Beauty', 'beauty', 'makeup.jpg', 1),
(3, 'Fashion', 'fashion', '', 0),
(4, 'Food', 'food', '', 0),
(5, 'Health & Wellness', 'health-and-wellness', 'fitness.jpg', 1),
(6, 'Home', 'home', 'kitchen.jpg', 1),
(7, 'Kids', 'kids', '', 0),
(8, 'Pets', 'pets', '', 0),
(9, 'Travel', 'travel', 'travel.jpg', 1),
(10, 'Wines & Spirits', 'wines-and-spirts', 'wine-bottle.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_levels`
--

CREATE TABLE `flydreamair_levels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_levels`
--

INSERT INTO `flydreamair_levels` (`id`, `name`, `handle`, `goal`) VALUES
(1, 'Bronze', 'bronze', 0),
(2, 'Silver', 'silver', 5000),
(3, 'Gold', 'gold', 15000),
(4, 'Diamond', 'diamond', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_orders`
--

CREATE TABLE `flydreamair_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment` int(11) NOT NULL COMMENT '0 = points | 1 = card',
  `order_placed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipping` int(11) NOT NULL COMMENT '0 = standard | 1 = express'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_orders`
--

INSERT INTO `flydreamair_orders` (`id`, `user_id`, `product_id`, `quantity`, `payment`, `order_placed`, `shipping`) VALUES
(1, 1, 1, 2, 0, '2023-05-26 01:21:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_products`
--

CREATE TABLE `flydreamair_products` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `results_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_products`
--

INSERT INTO `flydreamair_products` (`id`, `brand_id`, `description`, `price`, `points`, `image`, `category_id`, `subcategory_id`, `results_page`) VALUES
(1, 2, 'Pro Filt\'r Soft Matte Longwear Foundation 32ml - 125 Neutral', '59.00', '6313', 'fb-foundation.webp', 2, 2, 0),
(2, 3, 'Soft Pinch Liquid Blush 7.5ml - Encourage', '39.00', '4173', 'rb-blush.png', 2, 2, 1),
(3, 1, 'Rouge Dior Couture Finish Refillable Lipstick - #028 Actrice', '66.00', '7062', 'dior-lipstick.webp', 2, 2, 0),
(4, 4, 'Wild Obsessions Eyeshadow Palette Mini (Limited Edition) - Python', '44.00', '4708', 'hb-eyeshadow.webp', 2, 2, 0),
(5, 5, 'Anti-Redness Foundation 30ml - Beige', '22.00', '2354', 'i-foundation.jpg', 2, 2, 0),
(6, 6, 'Sense 2 Smart Watch - Black', '445.00', '47615', 'fitbit.jpg', 5, 5, 0),
(7, 7, 'Therapist Select Plus Percussion Massage Gun', '149.00', '15943', 'massage.webp', 5, 6, 1),
(8, 8, 'Beauty Cream Bar Original Soap 360g 4 Bars', '7.75', '829', 'dove.jpg', 2, 3, 1),
(9, 9, 'Venus Extra Smooth Green Disposable Women\'s Razors - 2 Count', '36.31', '3885', 'venus.jpg', 2, 3, 0),
(10, 9, 'Mach3 Mens Razor with 1 Handle and 2 Razor Blade Refills', '24.99', '2674', 'gillette.jpg', 2, 3, 0),
(11, 10, 'Adult Body Care Moisturising Body Wash 1 Litre', '6.49', '694', 'johnsons.jpg', 2, 3, 0),
(12, 11, 'Sorbet Skin Moisturiser 50 ml', '25.99', '2781', 'skin-proud.jpg', 2, 1, 0),
(13, 12, 'Skin Purifying Mask 100 ml', '29.95', '3205', 'skinb5.jpg', 2, 1, 0),
(14, 13, 'Man Jeans Eau De Toilette 125ml Spray', '89.99', '9629', 'hugo-boss.jpg', 2, 4, 0),
(15, 14, 'SI Eau De Parfum 100ml', '139.99', '14979', 'armani.jpg', 2, 4, 0),
(16, 15, 'Opium Black Eau de Parfum 90ml', '149.99', '16049', 'yves.jpg', 2, 4, 0),
(17, 16, 'Vivofit 4 Fitness Tracker (Black) [Large]', '139.00', '14873', 'garmin.webp', 5, 5, 0),
(18, 17, 'Massage Gun with Heat, Percussion Muscle Mini', '189.00', '20223', 'renpho.webp', 5, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_subcategories`
--

CREATE TABLE `flydreamair_subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_subcategories`
--

INSERT INTO `flydreamair_subcategories` (`id`, `category_id`, `name`, `handle`) VALUES
(1, 2, 'Skin Care', 'skin-care'),
(2, 2, 'Makeup', 'makeup'),
(3, 2, 'Body Care', 'body-care'),
(4, 2, 'Fragrances', 'fragrances'),
(5, 5, 'Accessories', 'accessories'),
(6, 5, 'Equipment', 'equipment'),
(7, 5, 'Supplements', 'supplements');

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_user_addresses`
--

CREATE TABLE `flydreamair_user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = shipping || 1 = billing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_user_levels`
--

CREATE TABLE `flydreamair_user_levels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flydreamair_user_levels`
--

INSERT INTO `flydreamair_user_levels` (`id`, `user_id`, `level_id`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `flydreamair_wishlist`
--

CREATE TABLE `flydreamair_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_number` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `lifetime_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `dob`, `created_at`, `phone_number`, `points`, `lifetime_points`) VALUES
(1, 'John', 'Doe', 'john_doe', 'johndoe@gmail.com', '$2y$10$V2MNKhSuY5lISH65yYX5qOFy4lWnRTcIkXJIke.dJdCnXUJU1kAVy', '1976-01-01', '2021-12-28 05:14:21', '+64 1234 5678', 374, 13000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flydreamair_brands`
--
ALTER TABLE `flydreamair_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_cart`
--
ALTER TABLE `flydreamair_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_categories`
--
ALTER TABLE `flydreamair_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_levels`
--
ALTER TABLE `flydreamair_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_orders`
--
ALTER TABLE `flydreamair_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_products`
--
ALTER TABLE `flydreamair_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `flydreamair_subcategories`
--
ALTER TABLE `flydreamair_subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `flydreamair_user_addresses`
--
ALTER TABLE `flydreamair_user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_user_levels`
--
ALTER TABLE `flydreamair_user_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flydreamair_wishlist`
--
ALTER TABLE `flydreamair_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flydreamair_brands`
--
ALTER TABLE `flydreamair_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `flydreamair_cart`
--
ALTER TABLE `flydreamair_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `flydreamair_categories`
--
ALTER TABLE `flydreamair_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flydreamair_levels`
--
ALTER TABLE `flydreamair_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flydreamair_orders`
--
ALTER TABLE `flydreamair_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flydreamair_products`
--
ALTER TABLE `flydreamair_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `flydreamair_subcategories`
--
ALTER TABLE `flydreamair_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `flydreamair_user_addresses`
--
ALTER TABLE `flydreamair_user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flydreamair_user_levels`
--
ALTER TABLE `flydreamair_user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flydreamair_wishlist`
--
ALTER TABLE `flydreamair_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flydreamair_products`
--
ALTER TABLE `flydreamair_products`
  ADD CONSTRAINT `flydreamair_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `flydreamair_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flydreamair_products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `flydreamair_subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flydreamair_products_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `flydreamair_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flydreamair_subcategories`
--
ALTER TABLE `flydreamair_subcategories`
  ADD CONSTRAINT `flydreamair_subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `flydreamair_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
