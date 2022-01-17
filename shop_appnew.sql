-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 07:49 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `cat_name`, `date`) VALUES
(30, 'catOne', '2020-11-06 21:51:01'),
(31, 'cat3', '2020-10-04 14:35:57'),
(32, 'cat4', '2020-10-04 14:39:15'),
(33, 'cat5', '2020-10-29 18:05:31'),
(35, 'cat7', '2020-10-04 18:39:29'),
(40, 'cat9', '2020-10-04 19:53:26'),
(42, 'gamcha', '2022-01-13 17:45:02'),
(43, 'shawl', '2022-01-13 17:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL DEFAULT '0',
  `c_phone` varchar(255) NOT NULL DEFAULT '0',
  `c_address` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`c_id`, `c_name`, `c_phone`, `c_address`) VALUES
(1, 'customer 1', '', 'test'),
(2, 'customer 2', '014747455555', 'test 2'),
(3, 'Maria', '01717xxxxxxx', 'test address'),
(4, 'test', '055555555555', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_cat` int(255) NOT NULL,
  `p_code` varchar(255) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `p_date` date NOT NULL,
  `p_img` varchar(255) DEFAULT NULL,
  `p_des` varchar(300) NOT NULL,
  `p_sub_cat` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `p_cat`, `p_code`, `p_price`, `p_date`, `p_img`, `p_des`, `p_sub_cat`) VALUES
(11, 'saree', 41, '0100', '1500', '2022-01-14', NULL, '', '23'),
(12, 'monipuri saree', 33, '1005', '1500', '2022-01-13', 'uploads/8d3197ca45.jpg', '', '0'),
(13, 'komor tat shawl', 43, '05s', '850', '2022-01-13', 'uploads/67832e9413.jpg', 'buy price 500', 'komor tat shawl');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell`
--

CREATE TABLE `tbl_sell` (
  `id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_cat` varchar(255) NOT NULL,
  `s_code` varchar(255) NOT NULL,
  `s_price` varchar(255) NOT NULL,
  `s_paid` int(11) NOT NULL,
  `s_total` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell`
--

INSERT INTO `tbl_sell` (`id`, `s_name`, `s_cat`, `s_code`, `s_price`, `s_paid`, `s_total`, `sold`) VALUES
(67, 'this is new product', '30', '001', '2500', 0, 0, 0),
(68, 'product 2', '30', '002', '1120', 0, 0, 0),
(69, 'Product three', '31', '003', '2200', 0, 0, 0),
(70, 'pro 2', '34', '005', '1000', 0, 0, 0),
(71, 'product eight', '36', '008', '2000', 0, 0, 0),
(72, 'pro 2', '34', '005', '1000', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sold`
--

CREATE TABLE `tbl_sold` (
  `sl_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `sl_name` varchar(255) NOT NULL,
  `sl_cat` varchar(255) NOT NULL,
  `sl_code` varchar(255) NOT NULL,
  `sl_price` varchar(255) NOT NULL,
  `sl_discount` varchar(255) DEFAULT NULL,
  `sl_total` varchar(255) NOT NULL,
  `sl_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sl_token` varchar(255) NOT NULL,
  `sl_sub_cat` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  `cart_comment` varchar(255) NOT NULL,
  `sl_qty` varchar(120) NOT NULL,
  `p_id` int(11) NOT NULL,
  `sl_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sold`
--

INSERT INTO `tbl_sold` (`sl_id`, `c_id`, `sl_name`, `sl_cat`, `sl_code`, `sl_price`, `sl_discount`, `sl_total`, `sl_datetime`, `sl_token`, `sl_sub_cat`, `status`, `cart_comment`, `sl_qty`, `p_id`, `sl_date`) VALUES
(92, NULL, 'pro-1', '30', '001', '1000', '', '2100', '2022-01-10 17:27:11', '7fd34', '0', 'paid', 'gghfh', '2', 9, '2022-01-10'),
(93, NULL, 'pro-5', '33', '005', '100', '', '2100', '2022-01-10 17:27:11', '7fd34', '0', 'paid', 'gghfh', '1', 10, '2022-01-10'),
(94, NULL, 'pro-1', '30', '001', '1000', '100', '900', '2022-01-14 17:28:00', 'eea26', '0', 'paid', 'ddddd', '1', 9, '2022-01-14'),
(95, NULL, 'pro-5', '33', '005', '100', '11', '89', '2022-01-14 17:28:19', '8b2f4', '0', 'paid', 'hh', '1', 10, '2022-01-14'),
(96, NULL, 'pro-1', '30', '001', '1000', '100', '900', '2022-01-12 17:28:38', '526bc', '0', 'paid', '', '1', 9, '2022-01-12'),
(97, NULL, 'pro-5', '33', '005', '100', '', '100', '2022-01-12 17:28:55', 'ef746', '0', 'paid', 'gjgjgjg', '1', 10, '2022-01-12'),
(98, NULL, 'pro-1', '30', '001', '1000', '', '1200', '2022-01-12 17:42:19', 'ef8a9', '0', 'paid', 'ggdgdg', '1', 9, '2022-01-12'),
(99, NULL, 'pro-5', '33', '005', '100', '', '1200', '2022-01-12 17:42:19', 'ef8a9', '0', 'paid', 'ggdgdg', '2', 10, '2022-01-12'),
(100, NULL, 'pro-1', '30', '001', '1000', '50', '1050', '2022-01-13 14:55:29', '5d65d', '0', 'paid', 'adadad', '1', 9, '2022-01-13'),
(101, NULL, 'pro-5', '33', '005', '100', '50', '1050', '2022-01-13 14:55:29', '5d65d', '0', 'paid', 'adadad', '1', 10, '2022-01-13'),
(102, NULL, 'saree', '41', '0100', '1500', '200', '2800', '2022-01-13 17:40:06', '786d8', '23', 'paid', 'test', '2', 11, '2022-01-13'),
(103, 4, 'monipuri saree', '41', '1005', '1500', '250', '7250', '2022-01-13 17:49:37', 'b345f', '', 'paid', '', '5', 12, '2022-01-13'),
(104, NULL, 'komor tat shawl', '43', '05s', '850', '', '850', '2022-01-13 18:03:52', '285ea', 'komor tat shawl', 'paid', '', '1', 13, '2022-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `sub_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `sub_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`sub_id`, `id`, `sub_name`) VALUES
(13, 33, 't shart'),
(16, 30, 'testcatOne'),
(17, 33, 'test5'),
(18, 30, 'ssssOne'),
(19, 33, 'sss5'),
(20, 35, 'subcat77'),
(21, 35, 'subcatSeven'),
(26, 42, 'short gamcha'),
(27, 43, 'komor tat shawl');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(350) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `name`, `username`, `password`, `level`) VALUES
(24, 'test', 'test', '$2y$10$NPmlRwEkLFxYSYsNbc5KnOBvcNqgC20Pq6XuTX4PTjWFQAc0ewiCW', 'editor'),
(26, 'maria posoda', 'maria', '$2y$10$mUxEd0aGr6baYFlZTSQbGuJF3xgU4Ebn/NBb7QAI1B/S7DD3eUXVu', 'editor'),
(27, 'admin', 'admin', '$2y$10$Ok2RX7rV9U/35Om3OQjBOOXOELM5PHK3jJ9Ppg5Ogkm2Y798FNhee', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sold`
--
ALTER TABLE `tbl_sold`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_sold`
--
ALTER TABLE `tbl_sold`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD CONSTRAINT `tbl_subcategory_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
