-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2023 at 04:16 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `date`, `status`) VALUES
(19, 'Bella Finley\n', 'bellafinley@hotmail.com', 'I finally found the perfect pair of headphones at this webshop - they drowned out my terrible singing beautifully.', '2023-01-10', 'Read'),
(21, 'Susan Crowley ', 'sussie@hotmail.com', 'I ordered headphones from this webshop and they arrived in record time! Now I can finally block out the sound of my partner\'s snoring and get a good night\'s sleep.\n', '2023-01-17', 'Read'),
(22, 'Sian Merritt\n', 'sian546@hotmail.com', 'I purchased headphones from this webshop and they\'re so comfortable, I forgot they were on and walked into a wall. But, totally worth it.', '2023-01-18', 'Read'),
(25, 'Selene Krauss', 'selenekrauss@gmail.com', 'I got my headphones from this webshop and they\'re so good, I can finally block out my boss\'s voice during Zoom meetings.', '2023-01-19', 'Read'),
(26, 'Frankie Bush\n', 'frankie666@gmail.com', 'I bought headphones from this webshop and they\'re so good, I can finally listen to my guilty pleasure music without anyone judging me.', '2023-01-19', 'Unread'),
(29, 'Henrik Andersson', 'henrik_andersson@hotmail.com', 'I just got my headphones from your webshop and they\'re so good, my dog stopped barking and my neighbors stopped complaining. 10/10 would buy again.', '2023-01-20', 'Unread'),
(30, 'Patrik Stjärna', 'patrik_stjarna@hotmail.com', 'I am beyond impressed with the selection and customer service at Matley. They have the best deals and my order arrived quickly.\n', '2023-01-23', 'Unread'),
(31, 'Zach Collins', 'zach.collins@gmail.com', 'This is me saying hello!', '2023-01-24', 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user-id` int(11) NOT NULL,
  `status` text NOT NULL,
  `order-date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user-id`, `status`, `order-date`) VALUES
(75, 82, 'Canceled', '2023-01-03'),
(74, 81, 'Sent', '2023-01-12'),
(73, 80, 'Sent', '2023-01-13'),
(72, 79, 'Sent', '2023-01-13'),
(71, 86, 'Sent', '2023-01-14'),
(70, 3, 'Pending', '2023-01-15'),
(69, 3, 'Sent', '2023-01-16'),
(68, 3, 'Pending', '2023-01-18'),
(67, 1, 'Canceled', '2023-01-19'),
(60, 1, 'Sent', '2023-01-19'),
(61, 77, 'Sent', '2023-01-19'),
(62, 3, 'Canceled', '2023-01-20'),
(63, 3, 'Sent', '2023-01-21'),
(64, 76, 'Sent', '2023-01-22'),
(65, 78, 'Sent', '2023-01-22'),
(66, 1, 'Pending', '2023-01-23'),
(76, 83, 'Pending', '2023-01-23'),
(77, 84, 'Pending', '2023-01-23'),
(78, 85, 'Pending', '2023-01-24'),
(79, 3, 'Pending', '2023-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `img-url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img-url`) VALUES
(17, 'BT Headset', 'The BT Headset is a sleek and stylish wireless headset that comes in a classic white and gold color combination. It offers clear, high-quality sound for music, phone calls, and more. The headset features Bluetooth connectivity, allowing you to easily connect to your phone, tablet, or computer. It also includes a built-in microphone and control buttons for adjusting volume and managing calls. With a comfortable fit and long battery life, the BT Headset is perfect for everyday use.', 110, '/exa/assets/uploads/1674569037.jpg'),
(18, 'HP BTP1 Headset', 'The HP BTP1 Headset is a sleek and stylish wireless headset that comes in a classic black color. Made with a high-quality fake leather, it offers a comfortable fit and clear, high-quality sound for music, phone calls, and more. It features Bluetooth connectivity and a built-in microphone for easy use. With a long battery life, the HP BTP1 Headset is perfect for all day use.', 89, '/exa/assets/uploads/1674569306.jpg'),
(19, 'X2 Noise Isolated', 'The X2 Noise Isolated headphones are a retro-looking, cream white and black color combination. Made with high-quality, fake leather ear pads, they offer a comfortable fit and noise isolation for clear, high-quality sound. They come with wire for a wired connection and are perfect for all day use.', 130, '/exa/assets/uploads/1674569516.jpg'),
(20, 'Stereo Bass', 'The Stereo Bass headphones are a black and silver color combination. They offer both wired and wireless connectivity, providing powerful stereo bass sound. They are perfect for all day use and provide great sound quality for music and calls.', 79, '/exa/assets/uploads/1674569770.jpg'),
(21, 'X2 Stereo', 'The X2 Stereo headphones are a white and beige color combination. Made with high-quality ear puffs, they offer a comfortable fit and clear, high-quality sound. They are wireless and perfect for all day use, whether you\'re listening to music or making calls.', 299, '/exa/assets/uploads/1674569883.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productsorders`
--

DROP TABLE IF EXISTS `productsorders`;
CREATE TABLE IF NOT EXISTS `productsorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product-id` int(11) NOT NULL,
  `order-id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productsorders`
--

INSERT INTO `productsorders` (`id`, `product-id`, `order-id`) VALUES
(164, 17, 60),
(173, 18, 64),
(172, 18, 63),
(171, 19, 62),
(170, 21, 62),
(169, 21, 61),
(168, 20, 61),
(167, 19, 61),
(166, 18, 61),
(165, 17, 61),
(174, 20, 64),
(199, 21, 75),
(198, 21, 75),
(197, 19, 74),
(196, 20, 73),
(195, 17, 72),
(194, 18, 72),
(193, 19, 71),
(192, 20, 70),
(191, 21, 70),
(190, 19, 70),
(189, 18, 70),
(188, 17, 70),
(187, 18, 69),
(186, 21, 69),
(185, 20, 69),
(184, 21, 68),
(183, 18, 67),
(182, 17, 67),
(181, 19, 66),
(180, 18, 66),
(179, 17, 66),
(178, 19, 65),
(177, 18, 65),
(200, 21, 76),
(176, 17, 65),
(201, 18, 76),
(175, 19, 64),
(203, 18, 78),
(204, 17, 79),
(205, 19, 79),
(202, 18, 77);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password-hash` text,
  `role` text,
  `firstname` text,
  `lastname` text,
  `email` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password-hash`, `role`, `firstname`, `lastname`, `email`) VALUES
(3, 'Zarha', '$2y$10$Od5Sk6z1bxGxuN3JE22XhOkaVL7aOIBw6aqE1FLwgkJP3B/bxLGxO', 'admin', 'Zarha', 'Buske', 'zarhabuske@hotmail.com'),
(86, 'selenekrauss@gmail.com', NULL, 'customer', 'Selene', 'Krauss', 'selenekrauss@gmail.com'),
(79, 'Bellamie88', '$2y$10$qTel6E/Z99xup85kYhIZheCt0L/MKUOWTN29YH2N7bUHnrRoTVn.i', 'customer', 'Bella', 'Finley', 'bellafinley@hotmail.com'),
(1, 'admin', '$2y$10$TFxdZChxxxItaD5AFiv8e.wMHe1OuV.Ad4eLYCTCYaTny5j3X3O4S', 'admin', NULL, NULL, NULL),
(77, 'Maria599', '$2y$10$e7SKPZyrjiN5uTix1a3EBe6DKkKt8t5edHfdMeQoJ1IqFvc5nGPGS', 'customer', 'Maria', 'Frank', 'maria.frank@outlook.com'),
(76, 'Sebastian', '$2y$10$v8qURi1AMdTY7Km1BSUjo.sPRby.iq0X0ESDTHDdRVCbRcz8esw..', 'customer', 'Sebastian', 'J', 'sebbe@hotmail.com'),
(80, 'Susan_C', '$2y$10$enQtJpHZRuX.yGpqsCb5LeXfDcZkvINfNStyh8fA/pKRE1d4.WyH2', 'customer', 'Susan', 'Crowley', ''),
(81, 'Sian', '$2y$10$4Zw/4kLi/xge8y4eI4SOeO2mrgk65D9hB2SoZQ58aHoQH36HNnGBm', 'customer', NULL, NULL, NULL),
(82, 'Frankie', '$2y$10$Q4r3BPlQKLvKVRa5wPfgYe0Oolywass5YmSXW6rczlEZjS9TRMZiW', 'customer', NULL, NULL, NULL),
(83, 'henke86', '$2y$10$l7vpXaVycLoTIXpE5Aw/I.Ptj3Kj9acTzNra6s1.SG1KI2d1Ybgc6', 'customer', NULL, NULL, NULL),
(84, 'Patrik552', '$2y$10$mSz49r2z0Mwh7MYfIJG3quBYB5bW/ib.HLLQAdME.vTSvHkTcjNeG', 'customer', NULL, NULL, NULL),
(85, 'Zach_the_man', '$2y$10$s5saSodAa.jAv6pI.rZ.OefT9B42KoTxYmdof1awj1ifz7Q6Enkp2', 'customer', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
