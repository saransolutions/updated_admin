-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 10:45 PM
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
-- Database: `saransol_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookies`
--

CREATE TABLE `bookies` (
  `bid` mediumint(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `jdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookies`
--

INSERT INTO `bookies` (`bid`, `username`, `password`, `role`, `jdate`) VALUES
(1, 'admin', 'welcome', 'admin', '2014-07-10'),
(2, 'saran', 'welcome3ibm', NULL, '2014-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` mediumint(9) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `ort` varchar(25) DEFAULT NULL,
  `pin_code` mediumint(9) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `product_type` varchar(25) DEFAULT NULL,
  `website_name` varchar(25) DEFAULT NULL,
  `supported_language` varchar(25) DEFAULT NULL,
  `total_pages` smallint(6) DEFAULT NULL,
  `media_support` varchar(50) DEFAULT NULL,
  `domain_hosting` varchar(30) DEFAULT NULL,
  `mail_support` varchar(30) DEFAULT NULL,
  `mail_advertisement` varchar(30) DEFAULT NULL,
  `user_feedback` varchar(30) DEFAULT NULL,
  `seo_support` varchar(30) DEFAULT NULL,
  `google_business_support` varchar(30) DEFAULT NULL,
  `cookies_support` varchar(30) DEFAULT NULL,
  `google_check_activation` varchar(30) DEFAULT NULL,
  `advance_paid` varchar(5) DEFAULT NULL,
  `advance_amount` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `warranty_period` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `address`, `ort`, `pin_code`, `mobile`, `email`, `company_name`, `service_type`, `product_type`, `website_name`, `supported_language`, `total_pages`, `media_support`, `domain_hosting`, `mail_support`, `mail_advertisement`, `user_feedback`, `seo_support`, `google_business_support`, `cookies_support`, `google_check_activation`, `advance_paid`, `advance_amount`, `total_price`, `balance`, `delivery_date`, `warranty_period`) VALUES
(2, 'Sulakshan', 'Uthaya Kumar', 'Weibelackerweg 1', 'Roggwil', 4914, '0799292428', 'sulakshangmbh@gmail.com', 'Sulakshan GmbH', 'Reinigung, Logistik & Transport', 'Website', 'sulakshangmbh.ch', '4 (Du, En, Fr, It)', 50, 'Yes (Facebook, Youtube, Google Maps)', 'New Domain + Hoststar', 'Yes', 'No', 'Yes', 'No', 'No', 'No', 'No', 'Yes', 200, 1000, 0, '2024-04-01', '1 Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookies`
--
ALTER TABLE `bookies`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookies`
--
ALTER TABLE `bookies`
  MODIFY `bid` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
