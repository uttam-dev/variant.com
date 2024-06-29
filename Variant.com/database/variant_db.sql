-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2024 at 06:31 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `variant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE IF NOT EXISTS `category_tbl` (
  `cate_id` int(3) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `cate_name` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`cate_id`, `image`, `cate_name`, `status`) VALUES
(1, 't-shirt-1557.webp', 't shirt', 1),
(2, 'shirt-11562.jpg', 'shirt', 1),
(3, 'hoodies-27253.webp', 'hoodies', 1),
(4, 'jackets-15718.jpg', 'jackets', 1),
(5, 'blazer-20664.jpg', 'blazer', 1),
(6, 'pants-30634.jpg', 'pant''s', 1),
(7, 'jeans-6501.jpg', 'jeans', 1),
(8, 'jogger-597.jpg', 'jogger', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE IF NOT EXISTS `feedback_tbl` (
  `feed_id` int(2) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `massage` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`feed_id`, `email`, `massage`, `time`) VALUES
(2, 'prajapatiuttam@gmail.com', 'dfdasfdfds', '2024-03-08 11:28:07'),
(4, 'prajapatiuttam@gmail.com', 'dfdsfdsfdsf', '2024-03-10 10:02:11'),
(5, 'prajapatiuttam@gmail.com', 'asxdsadsa', '2024-03-10 10:09:39'),
(6, 'sonip1280@gmail.com', 'nice good website.', '2024-03-10 13:10:40'),
(7, 'soni@gmail.com', 'best product in site', '2024-03-10 16:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE IF NOT EXISTS `order_tbl` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(2) NOT NULL,
  `pro_id` varchar(20) NOT NULL,
  `sizes` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `total_price` int(5) NOT NULL,
  `address` text NOT NULL,
  `pincode` bigint(6) NOT NULL,
  `delivery_status` tinyint(1) NOT NULL,
  `confirm_status` tinyint(1) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `user_id`, `pro_id`, `sizes`, `qty`, `total_price`, `address`, `pincode`, `delivery_status`, `confirm_status`, `order_date`) VALUES
(11, 1, '5', '5', '3', 3597, 'deesa', 22222, 1, 0, '2024-03-10 17:01:16'),
(12, 1, '16', '6', '1', 1399, 'prajapati vas , bhoyan ,deesa', 33555, 1, 1, '2024-03-08 23:54:36'),
(13, 1, '4', '6', '3', 3597, 'deesa', 385535, 0, 0, '2024-03-10 17:04:06'),
(28, 2, '3,17', '6,6', '1,1', 4297, 'ranpur road jalaram bangloz rijment', 321456, 1, 1, '2024-03-10 16:11:17'),
(30, 15, '20', '4', '1', 1799, 'palanpur', 355535, 0, 0, '2024-03-10 16:39:55'),
(37, 3, '12,8', '6,5', '3,3', 9192, 'deesa', 321456, 0, 1, '2024-03-10 19:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE IF NOT EXISTS `payment_tbl` (
  `payment_id` int(2) NOT NULL AUTO_INCREMENT,
  `order_id` int(2) NOT NULL,
  `payment_method` varchar(5) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `order_id`, `payment_method`, `payment_status`) VALUES
(11, 11, 'COD', 0),
(12, 12, 'COD', 0),
(13, 13, 'COD', 1),
(14, 14, 'COD', 0),
(15, 15, 'COD', 0),
(16, 16, 'COD', 0),
(17, 17, 'COD', 0),
(18, 18, 'COD', 0),
(19, 19, 'COD', 0),
(20, 20, 'COD', 0),
(21, 21, 'COD', 0),
(22, 22, 'COD', 0),
(23, 23, 'COD', 0),
(24, 24, 'COD', 0),
(25, 25, 'COD', 0),
(26, 26, 'COD', 0),
(27, 27, 'COD', 0),
(28, 28, 'COD', 1),
(29, 29, 'COD', 0),
(30, 30, 'COD', 0),
(31, 31, 'COD', 0),
(32, 32, 'COD', 0),
(33, 33, 'COD', 0),
(34, 34, 'COD', 0),
(35, 35, 'COD', 0),
(36, 36, 'COD', 0),
(37, 37, 'COD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE IF NOT EXISTS `products_tbl` (
  `pro_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cate_id` int(2) NOT NULL,
  `sub_cate_id` int(3) NOT NULL,
  `org_price` int(5) NOT NULL,
  `dis_price` int(5) NOT NULL,
  `discount` int(3) NOT NULL,
  `size` varchar(11) NOT NULL,
  `color` varchar(10) NOT NULL,
  `stock` int(5) NOT NULL,
  `discription` varchar(80) NOT NULL,
  `image` text,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`pro_id`, `name`, `cate_id`, `sub_cate_id`, `org_price`, `dis_price`, `discount`, `size`, `color`, `stock`, `discription`, `image`, `status`) VALUES
(1, 'white full sleeve printed t shirt', 1, 1, 1499, 1199, 20, '1,2,3,4,5', 'white', 100, 'white full sleeve printed t shirt 100% cotton for men', '31377.webp', 1),
(2, 'black full sleeve printed t shirt', 1, 1, 1499, 1199, 20, '1,2,3,4,5', 'black', 200, 'black full sleeve printed t shirt 100% cotton for men', '14546.webp', 1),
(3, 'black casual polo t shirt', 1, 2, 1399, 1099, 21, '1,2,3,4,5,6', 'black', 400, 'black casual polo t shirt 100% cotton for men', '10926.webp', 1),
(4, 'grey printed polo cotton t shirt', 1, 2, 1399, 1199, 14, '1,3,4,5,6', 'grey', 200, 'grey printed polo cotton t shirt 100% cotton for men', '24655.webp', 1),
(5, 'navy blue printed polo t shirt', 1, 2, 1399, 1199, 14, '1,2,3,4,5', 'blue', 200, 'navy blue printed polo t shirt 100% cotton for men', '17372.webp', 1),
(6, 'green polo collar t shirt', 1, 2, 1399, 1000, 29, '1,2,3,4,5,6', 'green', 111, 'green polo collar t shirt 100% cotton for men', '7397.webp', 1),
(7, 'slim fit turtle neck jumper', 1, 3, 1699, 1499, 12, '1,2,3,4,5', 'black', 100, 'black slim fit fine knit turtle neck jumper for men 100% cotton', '2674.jpg', 1),
(8, 'slim fit turtle neck jumper', 1, 3, 1599, 1299, 19, '1,2,4,5,6', 'greige', 1000, 'slim fit fine knit turtle neck jumper greige color for men', '17338.jpg', 1),
(9, 'regular fit turtle neck jumper', 1, 3, 2000, 1499, 25, '1,2,3,4,5,6', 'back', 400, 'regular fit turtle neck jumper for men in black color', '13708.jpg', 1),
(10, 'batman outline logo t shirt', 1, 4, 1499, 1000, 33, '1,2,3,4,5', 'black', 1000, 'men''s black batman outline logo t shirt ', '21591.webp', 1),
(11, 'purple graphic printed t shirt', 1, 4, 1499, 1099, 27, '1,2,3,4,6', 'purple', 1000, 'men''s purple beast within graphic printed oversized t-shirt', '5623.webp', 1),
(12, 'batman printed oversized t shirt', 1, 4, 1499, 1099, 27, '1,2,3,4,5,6', 'red', 1000, 'men''s red the batman graphic printed oversized t-shirt', '19556.webp', 1),
(13, 'loose fit short sleeved oxford shirt', 2, 6, 1699, 899, 47, '1,2,3,4,5,6', 'beige', 1000, 'loose fit short-sleeved oxford shirt for men in beige', '15231.jpg', 1),
(14, 'loose fit short sleeved shirt', 2, 6, 1399, 899, 36, '1,2,3,4,5,6', 'black', 500, 'loose fit short sleeved oxford shirt for men in black', '5344.jpg', 1),
(15, 'loose fit short sleeved oxford shirt', 2, 6, 1399, 999, 29, '2,3,4,5,6', 'light blue', 100, 'loose fit short sleeved oxford shirt for men in light blue', '14156.jpg', 1),
(16, 'abstract print shirt', 2, 7, 2000, 1399, 30, '1,2,3,4,5,6', 'printed', 100, 'abstract print shirt for men', '21401.jpg', 1),
(17, 'geometric print seersucker shirt', 2, 7, 2000, 1399, 30, '1,2,3,4,5,6', 'printed', 500, 'geometric print seersucker shirt for men ', '25493.jpg', 1),
(18, 'loose fit hoodie', 3, 9, 1999, 1399, 30, '1,2,3,4,5,6', 'light grei', 500, 'loose fit hoodie for men ', '31914.jpg', 1),
(19, 'loose fit hoodie ', 3, 9, 1999, 1499, 25, '1,2,4,5,6', 'dark brown', 400, 'loose fit hoodie for men', '4251.jpg', 1),
(20, 'oversized fit printed hoodie', 3, 9, 2199, 1799, 18, '1,2,3,4,5,6', 'blue', 500, 'oversized fit printed hoodie for men', '31800.jpg', 1),
(21, 'panel denim jacket', 4, 10, 4905, 1250, 75, '2,4,5,6', 'olive', 200, 'dennis lingo men''s regular fit long sleeve button down', '19916.jpg', 1),
(22, 'dark blue denim jacket', 4, 10, 1800, 1200, 33, '2,3,4', 'black', 500, 'this stylish denim jacket from jack&jones is perfect for a casual, yet fashionab', '7031.webp', 1),
(23, 'blue denim jacket', 4, 10, 4999, 1749, 65, '1,2,3,4,5', 'blue', 300, 'a denim jacket with a regular fit thatâ€™s perfect over a sweater or t-shirt.', '24224.webp', 1),
(24, 'dark purple zip-up polyfill jacket', 4, 11, 12000, 7599, 37, '2,3,4,5', 'purple', 300, 'this produkt by jack&jones puffer jacket is the perfect addition to any outfit.', '608.webp', 1),
(25, 'high neck puffer jacket', 4, 11, 5000, 3999, 20, '2,3,5', 'brown', 300, 'classic brown puffer jacket designed with a high neck.', '14937.webp', 1),
(26, 'print high neck puffer jacket', 4, 11, 6000, 4999, 17, '2,3,5,6', 'blue', 300, 'take on the cold looking fly af wearing this super cosy and edgy puffer jacket f', '14122.webp', 1),
(27, 'varsity bomber jacket', 4, 12, 16000, 9000, 44, '2,3,4,5', 'purple', 200, 'featuring a varsity styled design', '15798.webp', 1),
(28, 'stardew blazer', 5, 14, 4999, 3999, 20, '1,2,3,4,5,6', 'grey', 200, 'stardew blazer formal brazer for men in grey', '29465.webp', 1),
(29, 'boppin tune blazer', 5, 14, 4999, 3499, 30, '1,2,3,4,6', 'khakhi', 200, 'boppin tune blazer for men in khakhi color', '24090.webp', 1),
(30, 'forever young blazer', 5, 14, 4999, 3699, 26, '3,4,5,6', 'green', 100, 'forever young blazer for men in green color', '20446.webp', 1),
(31, 'royal print blazer', 5, 15, 5999, 3599, 40, '2,3,4,5,6', 'blue', 50, 'royal print blazer for men in blue color', '21951.webp', 1),
(32, 'grayman blazer', 5, 15, 4899, 3999, 18, '2,3,4,5,6', 'grey', 60, 'grayman printed blazer for men in grey color ', '11595.webp', 1),
(33, 'trailblaze black cargo pant', 6, 16, 2000, 1399, 30, '1,2,3,4', 'black', 30, 'trailblaze black cargo pant for men\r\n', '9188.webp', 1),
(34, 'hexa-pocket black cargo pant', 6, 16, 2300, 1799, 22, '1,2,3,4,5', 'black', 50, 'hexa-pocket black cargo pant for men', '9758.webp', 1),
(35, 'hexa-pocket olive cargo pant', 6, 16, 2199, 1799, 18, '1,2,3,4,6', 'olive', 40, 'hexa-pocket olive cargo pant for men', '28749.webp', 1),
(36, 'traverse olive cargo pant', 6, 16, 2199, 1799, 18, '3,4,5,6', 'olive', 60, 'traverse olive cargo pant for men', '30466.webp', 1),
(37, 'grey super slim cotton pant', 6, 17, 2000, 1399, 30, '1,2,3,4,6', 'grey', 40, 'grey super slim cotton pant for men in grey', '30739.jpg', 1),
(38, 'super slim stretch pants ', 6, 17, 2199, 1399, 36, '1,2,3,4,6', 'off white', 30, 'off white super slim stretch pants  for men', '6736.jpg', 1),
(39, 'maroon slim fit pant', 6, 17, 2899, 1999, 31, '2,3,4,5,6', 'maroon', 70, 'maroon slim fit pant for man', '3050.jpg', 1),
(40, 'rich black formal pant ', 6, 18, 2000, 1599, 20, '2,3,4,5,6', 'black', 80, 'rich black formal pant for men', '31003.jpg', 1),
(41, 'midnight blue formal pant', 6, 18, 1999, 1599, 20, '1,2,3,4,5,6', 'blue', 20, 'midnight blue formal pant for men', '25124.jpg', 1),
(42, 'hip hop ice blue baggy cargo jeans', 7, 19, 2000, 1600, 20, '3,4,5,6', 'ice blue', 30, 'hip hop ice blue baggy cargo jeans for men', '17481.webp', 1),
(43, 'vintage ice blue cargo skinny jeans', 7, 19, 3000, 1500, 50, '2,3,4,6', 'blue', 30, 'vintage ice blue cargo skinny jeans for men', '3839.webp', 1),
(44, 'dazzle denim blue bootcut jeans', 7, 20, 3000, 1999, 33, '2,3,4,5', 'blue', 40, 'dazzle denim blue bootcut jeans for men', '31416.webp', 1),
(45, 'drift shaded blue skinny jeans', 7, 20, 3999, 2000, 50, '2,3,4,6', 'blue', 30, 'drift shaded blue skinny jeans for men', '32578.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_tbl`
--

CREATE TABLE IF NOT EXISTS `sub_category_tbl` (
  `sub_cate_id` int(3) NOT NULL AUTO_INCREMENT,
  `sub_cate_name` varchar(25) NOT NULL,
  `cate_id` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`sub_cate_id`),
  KEY `uniqe` (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `sub_category_tbl`
--

INSERT INTO `sub_category_tbl` (`sub_cate_id`, `sub_cate_name`, `cate_id`, `status`) VALUES
(1, 'oversized full-sleeve', 1, 1),
(2, 'polo t shirt', 1, 1),
(3, 'turtleneck t shirt', 1, 1),
(4, 'printed t shirt', 1, 1),
(6, 'formal shirt', 2, 1),
(7, 'printed shirt', 2, 1),
(8, 'oversized shirt', 2, 1),
(9, 'oversized hoodies', 3, 1),
(10, 'denim jacket', 4, 1),
(11, 'puffer jacket', 4, 1),
(12, 'varsity jacket', 4, 1),
(14, 'formal blazer', 5, 1),
(15, 'print blazer', 5, 1),
(16, 'cargo pant', 6, 1),
(17, 'cotton pant', 6, 1),
(18, 'formal pant', 6, 1),
(19, 'cargo jeans', 7, 1),
(20, 'denim jeans', 7, 1),
(21, 'skinny fit jeans', 7, 1),
(22, 'enduro joggers', 8, 1),
(23, 'denim joggers', 8, 1),
(24, 'plain shirt', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` int(2) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `full_name`, `email`, `password`, `address`, `phone_number`, `reg_date`, `active_status`) VALUES
(1, 'uttam prajapati', 'uttam@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 1234567897, '2024-03-08 13:12:23', 1),
(2, 'raval sharad kumar', 'sharad@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ranpur road jalaram bangloz rijment', 9876543211, '2024-03-06 21:02:47', 1),
(3, 'krishna patel', 'krishna@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 7654321734, '2024-03-08 12:59:43', 1),
(4, 'kiran sundesha', 'kiran@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'malgadh', 9871236543, '2024-03-08 13:00:55', 1),
(5, 'rudra gelot', 'rudra@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'ambika chowk , scw road , dessa', 9876123476, '2024-03-08 13:01:52', 1),
(6, 'haresh prajapati', 'hp@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'ranaji vas, samdhi , palanpur', 7654321967, '2024-03-08 13:02:57', 1),
(7, 'rohit thakkar', 'rohitthakkar@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'aakash vila near i mata tample ,bhoyan ,deesa', 1209763456, '2024-03-08 13:04:19', 1),
(8, 'paawan mavada', 'paawan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'sargam society , gayatri mandir ,deesa', 9845762314, '2024-03-08 13:05:19', 1),
(9, 'prakash soni', 'prakash@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 7654123987, '2024-03-08 13:06:15', 1),
(10, 'gudiya khatri', 'gudiya@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 9812093487, '2024-03-08 13:06:58', 1),
(11, 'yashvi saini', 'yashvi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'swaminarayan society at patan high way , deesa', 8912096523, '2024-03-08 13:08:10', 1),
(12, 'nandani bosiya', 'nandani@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'maruti park jalaram madir ,deesa', 8712435465, '2024-03-08 13:09:07', 1),
(13, 'dinkal verma', 'dinkal@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 7645342312, '2024-03-08 13:09:41', 1),
(14, 'mitwa thakkar', 'mitwa@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'deesa', 8712096754, '2024-03-08 13:10:13', 1),
(15, 'soni prakash', 'soni@gmail.com', '202cb962ac59075b964b07152d234b70', 'palanpur', 8141412049, '2024-03-10 16:29:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tbl`
--

CREATE TABLE IF NOT EXISTS `wishlist_tbl` (
  `wishlist_id` int(2) NOT NULL AUTO_INCREMENT,
  `user_id` int(2) NOT NULL,
  `pro_id` varchar(50) NOT NULL,
  PRIMARY KEY (`wishlist_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `wishlist_tbl`
--

INSERT INTO `wishlist_tbl` (`wishlist_id`, `user_id`, `pro_id`) VALUES
(1, 9, '17,27'),
(2, 2, '17,27'),
(3, 15, '17,27'),
(4, 11, '17,27'),
(5, 3, ',12');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_category_tbl`
--
ALTER TABLE `sub_category_tbl`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`cate_id`) REFERENCES `category_tbl` (`cate_id`);
