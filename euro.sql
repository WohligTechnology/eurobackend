-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 02:04 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `euro`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `euro_category`
--

CREATE TABLE IF NOT EXISTS `euro_category` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pdfdownload` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_category`
--

INSERT INTO `euro_category` (`id`, `order`, `status`, `name`, `banner`, `image`, `pdfdownload`) VALUES
(1, 1, 1, 'demo', '1d371c0545608418618d48f1d897cb664.jpg', '2e6cdf3e95c62c3d9dd5a21d96a307f31.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `euro_exclusiveproduct`
--

CREATE TABLE IF NOT EXISTS `euro_exclusiveproduct` (
  `id` int(11) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_exclusiveproduct`
--

INSERT INTO `euro_exclusiveproduct` (`id`, `image1`, `image2`) VALUES
(1, '', ''),
(2, 'about_us.jpg', 'plant_page.jpg'),
(3, 'homepage.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `euro_gallery`
--

CREATE TABLE IF NOT EXISTS `euro_gallery` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_gallery`
--

INSERT INTO `euro_gallery` (`id`, `category`, `order`, `status`, `image`) VALUES
(1, 1, 1, 1, '1d371c0545608418618d48f1d897cb665.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `euro_homepageimage`
--

CREATE TABLE IF NOT EXISTS `euro_homepageimage` (
  `id` int(11) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_homepageimage`
--

INSERT INTO `euro_homepageimage` (`id`, `image1`, `image2`, `image3`) VALUES
(1, '93591384d5bc6d2bb264db68e4efc40d.jpg', 'add-item.png', '2ec4813d7890a273c7676a54c9ceaf50.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `euro_homeslider`
--

CREATE TABLE IF NOT EXISTS `euro_homeslider` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_homeslider`
--

INSERT INTO `euro_homeslider` (`id`, `order`, `status`, `image`) VALUES
(1, 1, 1, '2stscreeshot.png');

-- --------------------------------------------------------

--
-- Table structure for table `euro_popularproduct`
--

CREATE TABLE IF NOT EXISTS `euro_popularproduct` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_popularproduct`
--

INSERT INTO `euro_popularproduct` (`id`, `order`, `status`, `image`) VALUES
(1, 1, 1, '1d371c0545608418618d48f1d897cb663.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `euro_product`
--

CREATE TABLE IF NOT EXISTS `euro_product` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_product`
--

INSERT INTO `euro_product` (`id`, `category`, `subcategory`, `name`, `image`, `size`) VALUES
(1, 1, 1, 'demo', '2ec4813d7890a273c7676a54c9ceaf501.jpg', '56');

-- --------------------------------------------------------

--
-- Table structure for table `euro_subcategory`
--

CREATE TABLE IF NOT EXISTS `euro_subcategory` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `euro_subcategory`
--

INSERT INTO `euro_subcategory` (`id`, `order`, `status`, `category`, `name`) VALUES
(1, 1, 1, 1, 'demo1');

-- --------------------------------------------------------

--
-- Table structure for table `euro_subscribe`
--

CREATE TABLE IF NOT EXISTS `euro_subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `linktype` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Home Slider', '', '', 'site/viewhomeslider', '1', 0, 1, 1, 'icon-dashboard'),
(2, 'Subscribe', '', '', 'site/viewsubscribe', '1', 0, 1, 1, 'icon-dashboard'),
(3, 'Home Page Image', '', '', 'site/viewhomepageimage', '1', 0, 1, 1, 'icon-dashboard'),
(4, 'Exclusive Product', '', '', 'site/viewexclusiveproduct', '1', 0, 1, 1, 'icon-dashboard'),
(5, 'Popular Product', '', '', 'site/viewpopularproduct', '1', 0, 1, 1, 'icon-dashboard'),
(6, 'Category', '', '', 'site/viewcategory', '1', 0, 1, 1, 'icon-dashboard'),
(7, 'Gallery', '', '', 'site/viewgallery', '1', 0, 1, 1, 'icon-dashboard'),
(8, 'Sub Category', '', '', 'site/viewsubcategory', '1', 0, 1, 1, 'icon-dashboard'),
(9, 'Product', '', '', 'site/viewproduct', '1', 0, 1, 1, 'icon-dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(0, 'Choose Status'),
(1, 'Enable'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `name`, `logo`) VALUES
(1, '', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `billingaddress` text NOT NULL,
  `billingcity` varchar(255) NOT NULL,
  `billingstate` varchar(255) NOT NULL,
  `billingcountry` varchar(255) NOT NULL,
  `billingcontact` varchar(255) NOT NULL,
  `billingpincode` varchar(255) NOT NULL,
  `shippingaddress` text NOT NULL,
  `shippingcity` varchar(255) NOT NULL,
  `shippingcountry` varchar(255) NOT NULL,
  `shippingstate` varchar(255) NOT NULL,
  `shippingpincode` varchar(255) NOT NULL,
  `shippingname` varchar(255) NOT NULL,
  `shippingcontact` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `registrationno` varchar(255) NOT NULL,
  `vatnumber` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `firstname`, `lastname`, `phone`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `billingcontact`, `billingpincode`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `shippingname`, `shippingcontact`, `currency`, `credit`, `companyname`, `registrationno`, `vatnumber`, `country`, `fax`, `gender`, `facebook`, `google`, `twitter`, `street`, `address`, `dob`, `city`, `state`, `pincode`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, 'images_(2)1.jpg', '', '', 'Facebook', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '0000-00-00', '', '', ''),
(6, 'Pooja Thakare', '', 'pooja.wohlig@gmail.com', 3, '2015-12-09 06:02:37', 1, 'https://lh5.googleusercontent.com/-5B1PwZZrwdI/AAAAAAAAAAI/AAAAAAAAABw/J3Hf871N8IE/photo.jpg', '', '103402210128529539675', 'Google', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '103402210128529539675', '', '', '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `euro_category`
--
ALTER TABLE `euro_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_exclusiveproduct`
--
ALTER TABLE `euro_exclusiveproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_gallery`
--
ALTER TABLE `euro_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_homepageimage`
--
ALTER TABLE `euro_homepageimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_homeslider`
--
ALTER TABLE `euro_homeslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_popularproduct`
--
ALTER TABLE `euro_popularproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_product`
--
ALTER TABLE `euro_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_subcategory`
--
ALTER TABLE `euro_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `euro_subscribe`
--
ALTER TABLE `euro_subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `euro_category`
--
ALTER TABLE `euro_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_exclusiveproduct`
--
ALTER TABLE `euro_exclusiveproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `euro_gallery`
--
ALTER TABLE `euro_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_homepageimage`
--
ALTER TABLE `euro_homepageimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_homeslider`
--
ALTER TABLE `euro_homeslider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_popularproduct`
--
ALTER TABLE `euro_popularproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_product`
--
ALTER TABLE `euro_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_subcategory`
--
ALTER TABLE `euro_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `euro_subscribe`
--
ALTER TABLE `euro_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
