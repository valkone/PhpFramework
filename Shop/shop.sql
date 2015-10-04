-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Структура на таблица `banned_ips`
--

CREATE TABLE IF NOT EXISTS `banned_ips` (
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Схема на данните от таблица `categories`
--

INSERT INTO `categories` (`id`, `name`, `isDeleted`) VALUES
(1, 'Laptop', 0),
(2, 'Phone', 0),
(3, 'Fashion', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `category_product`
--

CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `added_on` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `condition` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `added_on`, `description`, `quantity`, `condition`, `picture`, `owner`, `isDeleted`) VALUES
(1, 'Produkt', '100', 1443881180, 'desc', 119, 1, '', 0, 0),
(2, 'Produkt', '20', 1443881209, 'sh', 20, 2, 'https://www.hama.com/pics/category/index/specials/Anfrage_Produkt_14.png', 0, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `product_user`
--

CREATE TABLE IF NOT EXISTS `product_user` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `reviews`
--

INSERT INTO `reviews` (`review`, `product_id`, `user_id`) VALUES
('Review1', 2, 1),
('dqwdq', 1, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `registered_on` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `cash` int(11) NOT NULL DEFAULT '1000',
  `isBanned` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `registered_on`, `password`, `role`, `cash`, `isBanned`) VALUES
(1, 'admin', 'admin@abv.bg', 1443881093, '21232f297a57a5a743894a0e4a801fc3', 0, 11900, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
