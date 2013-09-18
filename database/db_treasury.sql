-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2013 at 09:46 Chi?u/T?i
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `treasury`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 0, 'One', 'one\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 0, 'Two', 'two', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 0, 'Three', 'threee', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'owner', 'Shop Owner');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--


-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `my_stores`
--

CREATE TABLE IF NOT EXISTS `my_stores` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_stores`
--


-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` text NOT NULL,
  `auto_load` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`, `auto_load`) VALUES
(1, 'site_name', 'Treasury''s Project', 1),
(2, 'site_description', 'Description of here', 1),
(3, 'meta_keywords', 'new keywords', 1),
(4, 'meta_description', 'new description', 1),
(5, 'meta_author', 'Long Nguyen', 1),
(6, 'meta_generator', 'Generator', 1),
(7, 'google_analytic', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `code` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `date_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_changed_by` int(11) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `gender_limit` varchar(50) NOT NULL,
  `age_limit` varchar(50) NOT NULL,
  `member_limit` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `cat_id`, `location_id`, `created_by`, `title`, `code`, `content`, `date_from`, `date_to`, `created_at`, `updated_at`, `last_changed_by`, `latitude`, `longitude`, `gender_limit`, `age_limit`, `member_limit`, `views`, `status`) VALUES
(8, 0, 0, 4, 'New promotion', '', 'dadasdasd', '2013-05-30 00:00:00', '2013-05-31 00:00:00', '2013-05-30 12:57:42', '2013-05-30 17:34:11', 4, '49.008150004996644', '2.366180419921875', 'male', '25-30', '0', 0, 0),
(9, 0, 0, 4, 'New promotion', '', 'dasdasd', '2013-05-30 00:00:00', '2013-05-31 00:00:00', '2013-05-30 14:53:02', '2013-05-30 17:34:08', 4, '48.90444878143716', '2.02423095703125', 'female', '30-40', '0', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) NOT NULL,
  `forgotten_password_code` varchar(40) NOT NULL,
  `forgotten_password_time` int(11) unsigned NOT NULL,
  `remember_code` varchar(40) NOT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `zip` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `public_text` text NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `website` varchar(200) NOT NULL,
  `total_rating` int(11) NOT NULL,
  `avg_rating` decimal(10,2) NOT NULL,
  `qr_code` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cat_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `gender`, `zip`, `city`, `avatar`, `address`, `public_text`, `latitude`, `longitude`, `website`, `total_rating`, `avg_rating`, `qr_code`) VALUES
(1, 0, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '973039ed76ae42844c66195757ba6bcf87988174', '', 0, '', 1268889823, 1378832799, 1, 'Administrator', '', 'ADMIN', '0', '', '', '', '', '', '', '', '', '', 0, '0.00', ''),
(4, 0, '\0\0', 'owner', 'dffc4d11fc4dfece4af207979aeab7ee035fd072', '', 'owner@admin.com', '8a4d9fa304200a09fc19b464b8b6a645fa5f2660', '', 0, '', 1369583000, 1378233844, 1, 'Shop', 'Owner', 'Company edited', 'Phone', '', 'b', 'b', '', 'b', '<p>Public text<br></p>', '51.51216124955517', '-0.11260986328125', '', 0, '0.00', 'www.google.nl'),
(5, 0, '\0\0', 'user', 'dffc4d11fc4dfece4af207979aeab7ee035fd072', '', 'user@admin.com', '607e51d30277530f07475ee633b472a37b729836', '', 0, '', 1369583000, 1375112545, 1, 'Normal', 'User', '', '', '', '', '', '', '', '', '', '', '', 0, '0.00', ''),
(6, 0, 'SS™', 'las3r', '3d91eb3b97c2f6af1ba533e681a8d130902afc33', '', 'erik.hoeksma@gmail.com', '', '', 0, '', 1378233023, 1378233024, 1, 'Erik', 'Hoeksma', '', '52342342424', 'Male', '', '', '', '', '', '', '', '', 0, '0.00', ''),
(7, 0, '\0\0', 'forusertest', '5ed20e9e139d0a8bef3252cee771461bba48c91f', '', 'fortest@email.com', '', '', 0, '', 1378821543, 1378821543, 1, 'For', 'Test', 'Company', 'phone', 'Male', '', '', '', '', '', '', '', '', 0, '0.00', ''),
(8, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'testuser2', '0ead371f0d26d08a9b424ed4b50c6581e79c9f3a', '', 'testuser@email.com.vn', '', '', 0, '', 1378831227, 1378831227, 1, 'For', 'Test', 'Company', 'phone', 'Male', '', '', '', '', '', '', '', '', 0, '0.00', ''),
(9, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'testuser3', 'f9e753389b52da9795b1d1f6e6c5693897769e9f', '', 'admin@test.com', '', '', 0, '', 1378831271, 1378831271, 1, 'For', 'Test', '', '', '', '100101', 'City', '', 'adias', '', '', '', '', 0, '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_favorites`
--

CREATE TABLE IF NOT EXISTS `users_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_user_promotion_id` (`user_id`,`promotion_id`),
  KEY `fk_user_id` (`user_id`) USING BTREE,
  KEY `fk_promotion_id` (`promotion_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users_favorites`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(4, 4, 3),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_shop_favorites`
--

CREATE TABLE IF NOT EXISTS `user_shop_favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_shop_favorites`
--

INSERT INTO `user_shop_favorites` (`id`, `user_id`, `shop_id`) VALUES
(0, 5, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
