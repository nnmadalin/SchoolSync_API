-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2023 at 03:17 PM
-- Server version: 5.7.42-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nnmadali_schoolsync`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `token` varchar(1000) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `skills` text NOT NULL,
  `chatgpt_message` json NOT NULL,
  `chatgpt_time` text NOT NULL,
  `invataunit_moderator` tinyint(1) NOT NULL DEFAULT '0',
  `edumentor_moderator` tinyint(1) NOT NULL DEFAULT '0',
  `administrator_app` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chatgpt`
--

CREATE TABLE `chatgpt` (
  `token_api` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `educlass`
--

CREATE TABLE `educlass` (
  `token` varchar(500) NOT NULL,
  `token_user` varchar(500) NOT NULL,
  `created` varchar(500) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `color` varchar(500) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `admins` text NOT NULL,
  `pending` text NOT NULL,
  `students` text NOT NULL,
  `materials` json NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `edumentor`
--

CREATE TABLE `edumentor` (
  `token` varchar(256) NOT NULL,
  `token_user` varchar(256) NOT NULL,
  `created` varchar(500) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(128) NOT NULL,
  `color` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `files` text NOT NULL,
  `reading_time` int(11) NOT NULL,
  `favourites` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted_by` varchar(500) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `token_user` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flowtalk`
--

CREATE TABLE `flowtalk` (
  `token` varchar(500) NOT NULL,
  `token_user` varchar(500) NOT NULL,
  `created` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(255) NOT NULL,
  `people` text NOT NULL,
  `messages` json NOT NULL,
  `seen` text NOT NULL,
  `admins` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invataunit`
--

CREATE TABLE `invataunit` (
  `token` varchar(256) NOT NULL,
  `token_user` varchar(256) NOT NULL,
  `created` varchar(500) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(128) NOT NULL,
  `question` text NOT NULL,
  `answers` longtext,
  `files` text,
  `favourites` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted_by` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timeplan`
--

CREATE TABLE `timeplan` (
  `token_user` varchar(256) NOT NULL,
  `calendar` json NOT NULL,
  `timetable` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `required_version_app` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `chatgpt`
--
ALTER TABLE `chatgpt`
  ADD PRIMARY KEY (`token_api`);

--
-- Indexes for table `educlass`
--
ALTER TABLE `educlass`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `edumentor`
--
ALTER TABLE `edumentor`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flowtalk`
--
ALTER TABLE `flowtalk`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `invataunit`
--
ALTER TABLE `invataunit`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `timeplan`
--
ALTER TABLE `timeplan`
  ADD PRIMARY KEY (`token_user`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`required_version_app`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
