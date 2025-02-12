-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 08:40 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_contracktor`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctt_admin`
--

CREATE TABLE `ctt_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_id` varchar(30) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_phone` varchar(30) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_admin`
--

INSERT INTO `ctt_admin` (`id`, `user_type_id`, `admin_name`, `admin_id`, `admin_email`, `admin_phone`, `admin_pwd`, `is_active`, `is_delete`, `created_date`, `updated_date`) VALUES
(1, 1, 'ctt-admin', 'ctt-admin', 'ctt-admin@gmail.com', '1234567890', '67dd14f1c773aa5e74e332ea1999a7e1', 1, 0, '2021-02-13 12:27:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctt_centralised_department`
--

CREATE TABLE `ctt_centralised_department` (
  `id` int(11) UNSIGNED NOT NULL,
  `sbu_details_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `is_value` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1. Yes\r\n2. No',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_centralised_department`
--

INSERT INTO `ctt_centralised_department` (`id`, `sbu_details_id`, `department_id`, `is_value`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 10, 1, 1, 0, 1, '2021-10-14 15:53:33', '2021-10-14 15:53:33'),
(2, 10, 2, 1, 0, 1, '2021-10-14 15:53:33', '2021-10-14 15:53:33'),
(3, 10, 3, 1, 0, 1, '2021-10-14 15:53:33', '2021-10-14 15:53:33'),
(4, 10, 4, 1, 0, 1, '2021-10-14 15:53:33', '2021-10-14 15:53:33'),
(5, 11, 1, 1, 0, 1, '2021-10-18 07:26:00', '2021-10-18 07:26:00'),
(6, 11, 2, 1, 0, 1, '2021-10-18 07:26:00', '2021-10-18 07:26:00'),
(7, 11, 3, 1, 0, 1, '2021-10-18 07:26:00', '2021-10-18 07:26:00'),
(8, 11, 4, 1, 0, 1, '2021-10-18 07:26:00', '2021-10-18 07:26:00'),
(9, 27, 1, 1, 0, 1, '2021-10-18 09:10:24', '2021-10-18 09:10:24'),
(10, 27, 2, 1, 0, 1, '2021-10-18 09:10:24', '2021-10-18 09:10:24'),
(11, 27, 3, 1, 0, 1, '2021-10-18 09:10:25', '2021-10-18 09:10:25'),
(12, 27, 4, 1, 0, 1, '2021-10-18 09:10:25', '2021-10-18 09:10:25'),
(13, 28, 1, 0, 0, 1, '2021-10-18 10:03:49', '2021-10-18 10:03:49'),
(14, 28, 2, 0, 0, 1, '2021-10-18 10:03:50', '2021-10-18 10:03:50'),
(15, 28, 3, 0, 0, 1, '2021-10-18 10:03:50', '2021-10-18 10:03:50'),
(16, 28, 4, 0, 0, 1, '2021-10-18 10:03:50', '2021-10-18 10:03:50'),
(33, 33, 1, 1, 0, 1, '2021-10-18 10:23:52', '2021-10-18 10:23:52'),
(34, 33, 2, 1, 0, 1, '2021-10-18 10:23:52', '2021-10-18 10:23:52'),
(35, 33, 3, 1, 0, 1, '2021-10-18 10:23:53', '2021-10-18 10:23:53'),
(36, 33, 4, 1, 0, 1, '2021-10-18 10:23:53', '2021-10-18 10:23:53'),
(37, 34, 1, 1, 0, 1, '2021-10-18 10:25:07', '2021-10-18 10:25:07'),
(38, 34, 2, 1, 0, 1, '2021-10-18 10:25:07', '2021-10-18 10:25:07'),
(39, 34, 3, 1, 0, 1, '2021-10-18 10:25:07', '2021-10-18 10:25:07'),
(40, 34, 4, 1, 0, 1, '2021-10-18 10:25:08', '2021-10-18 10:25:08'),
(41, 35, 1, 1, 0, 1, '2021-10-18 10:29:24', '2021-10-18 10:29:24'),
(42, 35, 2, 1, 0, 1, '2021-10-18 10:29:24', '2021-10-18 10:29:24'),
(43, 35, 3, 1, 0, 1, '2021-10-18 10:29:24', '2021-10-18 10:29:24'),
(44, 35, 4, 1, 0, 1, '2021-10-18 10:29:24', '2021-10-18 10:29:24'),
(61, 32, 1, 0, 0, 1, '2021-10-18 11:42:33', '2021-10-18 11:42:33'),
(62, 32, 2, 0, 0, 1, '2021-10-18 11:42:33', '2021-10-18 11:42:33'),
(63, 32, 3, 1, 0, 1, '2021-10-18 11:42:33', '2021-10-18 11:42:33'),
(64, 32, 4, 0, 0, 1, '2021-10-18 11:42:33', '2021-10-18 11:42:33'),
(81, 43, 1, 0, 0, 1, '2021-10-18 11:45:28', '2021-10-18 11:45:28'),
(82, 43, 2, 1, 0, 1, '2021-10-18 11:45:28', '2021-10-18 11:45:28'),
(83, 43, 3, 0, 0, 1, '2021-10-18 11:45:28', '2021-10-18 11:45:28'),
(84, 43, 4, 1, 0, 1, '2021-10-18 11:45:28', '2021-10-18 11:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_contract`
--

CREATE TABLE `ctt_contract` (
  `id` int(11) UNSIGNED NOT NULL,
  `contract_type` varchar(200) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctt_department`
--

CREATE TABLE `ctt_department` (
  `id` int(11) UNSIGNED NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_code` varchar(30) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_department`
--

INSERT INTO `ctt_department` (`id`, `department_name`, `department_code`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 'Operational', 's', 0, 1, '2021-10-12 06:08:45', '2021-10-11 18:30:00'),
(2, 'HR & Compliance', 'dept-2', 0, 1, '2021-10-12 09:42:33', '2021-10-12 09:42:33'),
(3, 'Department-3', 'dept-3', 0, 1, '2021-10-12 09:42:47', '2021-10-12 09:42:47'),
(4, 'Department-4', 'dept-4', 0, 1, '2021-10-12 09:42:59', '2021-10-12 09:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_employee`
--

CREATE TABLE `ctt_employee` (
  `id` int(11) UNSIGNED NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `organisation_sbu_id` int(11) NOT NULL,
  `employee_name` varchar(200) NOT NULL,
  `employee_email` varchar(250) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_employee`
--

INSERT INTO `ctt_employee` (`id`, `organisation_id`, `organisation_sbu_id`, `employee_name`, `employee_email`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 1, 4, 'Rajesh Panda', 'rajesh@gmail.com', 0, 1, '2021-10-19 04:58:10', '2021-10-19 04:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_industry`
--

CREATE TABLE `ctt_industry` (
  `id` int(11) UNSIGNED NOT NULL,
  `industry_name` varchar(200) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_industry`
--

INSERT INTO `ctt_industry` (`id`, `industry_name`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 'Steel', 0, 1, '2021-10-05 06:34:03', '2021-10-05 06:34:03'),
(2, 'Cement', 0, 1, '2021-10-05 06:34:27', '2021-10-05 06:34:27'),
(3, 'Pharma', 0, 1, '2021-10-05 06:34:47', '2021-10-05 06:34:47'),
(4, 'Coal', 0, 1, '2021-10-05 06:34:59', '2021-10-05 06:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_organisation`
--

CREATE TABLE `ctt_organisation` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `corporate_address` text DEFAULT NULL,
  `correspondence_address` text DEFAULT NULL,
  `contact_name` varchar(200) DEFAULT NULL,
  `contact_mobile` varchar(15) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `company_type` varchar(200) DEFAULT NULL,
  `industry_id` int(11) UNSIGNED DEFAULT NULL,
  `organisation_id` varchar(20) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_organisation`
--

INSERT INTO `ctt_organisation` (`id`, `company_name`, `company_logo`, `landline`, `mobile`, `email`, `corporate_address`, `correspondence_address`, `contact_name`, `contact_mobile`, `contact_email`, `company_type`, `industry_id`, `organisation_id`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 'sdfg', '1633966869_6406baf1916bd85d1c7d.jpg', '0674232997', '7008081245', 'aa@gmail.com', 'sdfg', 'sdfg', 'dfgh', '9861488587', 'asdf@gmail.com', 'dfgh', 1, 'dfgh', 0, 1, '2021-10-11 10:15:33', '2021-10-11 10:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_other_operational_department`
--

CREATE TABLE `ctt_other_operational_department` (
  `id` int(11) UNSIGNED NOT NULL,
  `sbu_details_id` int(11) UNSIGNED NOT NULL,
  `department_name` varchar(200) DEFAULT NULL,
  `department_code` varchar(250) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_other_operational_department`
--

INSERT INTO `ctt_other_operational_department` (`id`, `sbu_details_id`, `department_name`, `department_code`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(5, 32, 'sdfsaf sdfsadfsa', 'dddfff', 0, 1, '2021-10-18 11:42:33', '2021-10-18 11:42:33'),
(13, 43, 'ffff', 'ffff', 0, 1, '2021-10-18 11:45:28', '2021-10-18 11:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_parameter`
--

CREATE TABLE `ctt_parameter` (
  `id` int(11) NOT NULL,
  `parameter_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_parameter`
--

INSERT INTO `ctt_parameter` (`id`, `parameter_name`, `is_active`, `updated_date`) VALUES
(1, 'Copyright', 1, '2021-08-26'),
(2, 'Facebook Link', 1, '2021-04-05'),
(3, 'Twitter Link', 1, '2021-04-05'),
(4, 'Google Link', 1, '2021-04-05'),
(5, 'YouTube Link', 1, '2021-04-05'),
(6, 'Instagram Link', 1, '2021-04-05'),
(7, 'Email', 1, '2021-04-05'),
(8, 'Phone', 1, '2021-04-05'),
(9, 'Address', 1, '2021-04-05'),
(10, 'Whatsapp Phones', 1, '2021-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_sbu`
--

CREATE TABLE `ctt_sbu` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `sbu_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_sbu`
--

INSERT INTO `ctt_sbu` (`id`, `company_id`, `sbu_name`, `location`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(2, 1, 'sdf', ' zsdf', 0, 1, '2021-10-11 15:08:34', '2021-10-11 15:08:34'),
(3, 1, 'aaaaaaaaa', 'bbbbbbbbbbb', 0, 1, '2021-10-11 15:08:34', '2021-10-11 15:08:34'),
(4, 1, 'ccccccccc', 'ddddddddddd', 0, 1, '2021-10-11 15:08:34', '2021-10-11 15:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_sbu_details`
--

CREATE TABLE `ctt_sbu_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `sbu_id` int(11) UNSIGNED NOT NULL,
  `land_line` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `corporate_address` text DEFAULT NULL,
  `correspondence_address` text DEFAULT NULL,
  `contact_name` varchar(250) DEFAULT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `contact_email` varchar(250) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_sbu_details`
--

INSERT INTO `ctt_sbu_details` (`id`, `sbu_id`, `land_line`, `mobile`, `corporate_address`, `correspondence_address`, `contact_name`, `contact_phone`, `contact_email`, `is_delete`, `is_active`, `created_date`, `updated_date`) VALUES
(3, 3, '5646456646545', '565456444646546', 'safsadfsa', 'safsadfsadf', 'safsadfs', '56464564646546', 'asdfsdfsad@gmail.com', 0, 1, '2021-10-14 14:54:41', '2021-10-14 14:54:41'),
(4, 3, '65456456464', '464646464646465', 'sadfsadfasd', 'safsadfsad', 'asfsda', '546445646464646', 'safsadfads@gmail.com', 0, 1, '2021-10-14 15:34:00', '2021-10-14 15:34:00'),
(5, 3, '3135465464654', '6464646464646', 'sadfsdafads', 'safasdf', 'asfsadfsa', '213111654644466', 'safdsfdas@gmail.com', 0, 1, '2021-10-14 15:42:14', '2021-10-14 15:42:14'),
(6, 3, '3135465464654', '6464646464646', 'sadfsdafads', 'safasdf', 'asfsadfsa', '213111654644466', 'safdsfdas@gmail.com', 0, 1, '2021-10-14 15:42:46', '2021-10-14 15:42:46'),
(7, 3, '54545464646456', '646465464646456', 'sadfsadfsadf', 'asdfasdfasf', 'asfsadfsad', '545664456464564', 'safsdafadsf@gmail.com', 0, 1, '2021-10-14 15:44:45', '2021-10-14 15:44:45'),
(8, 3, '444641634165465', '341341334131314', 'sadfasdfasd', 'asdfasdfasd', 'asdfasdf', '554456464646465', 'sadfs@gmail.com', 0, 1, '2021-10-14 15:47:03', '2021-10-14 15:47:03'),
(9, 3, '6445464546', '646616313123131', 'sadfdsafad', 'safsadfsadfsd', 'ffff', '213123113131311', 'afdsf@gmail.com', 0, 1, '2021-10-14 15:51:26', '2021-10-14 15:51:26'),
(10, 4, '5655565555655', '55556565656556', 'sadfsadfsd', 'asdfsad', 'asfsdsdfas', '621611221313121', 'asdfsda@gmail.com', 0, 1, '2021-10-14 15:53:33', '2021-10-14 15:53:33'),
(11, 3, '511313133121321', '31313131313131', 'safasfas', 'asfsafasd', 'Jiggy lal Set', '445464454646464', 'safsadfa@gmail.com', 0, 1, '2021-10-18 07:26:00', '2021-10-18 07:26:00'),
(12, 4, '313131313134013', '667466464324324', 'safsafa', 'asfasfas', 'fsdaf', '126542354613115', 'testtieal@gmail.com', 0, 1, '2021-10-18 07:39:48', '2021-10-18 07:39:48'),
(13, 4, '313131313134013', '667466464324324', 'safsafa', 'asfasfas', 'fsdaf', '126542354613115', 'testtieal@gmail.com', 0, 1, '2021-10-18 07:40:04', '2021-10-18 07:40:04'),
(14, 3, '313131313134013', '667466464324324', 'safsafa', 'asfasfas', 'fsdaf', '126542354613115', 'testtieal@gmail.com', 0, 1, '2021-10-18 07:40:23', '2021-10-18 07:40:23'),
(15, 4, '313131313134013', '667466464324324', 'safsafa', 'asfasfas', 'fsdaf', '126542354613115', 'testtieal@gmail.com', 0, 1, '2021-10-18 07:42:15', '2021-10-18 07:42:15'),
(16, 3, '456465464654564', '613131132121131', 'sfsfsa', 'asfasf', 'ffcsddf', '964946848649648', 'sfacddfs@gmail.com', 0, 1, '2021-10-18 07:48:33', '2021-10-18 07:48:33'),
(19, 4, '616131311201321', '313130023484848', 'safsffs fsfdfsa', 'dfd', 'fffcsfade', '12545461611', 'sfasccceeee@gmail.com', 0, 1, '2021-10-18 07:51:03', '2021-10-18 07:51:03'),
(20, 4, '616131311201321', '313130023484848', 'safsffs fsfdfsa', 'dfd', 'fffcsfade', '12545461611', 'sfasccceeee@gmail.com', 0, 1, '2021-10-18 07:51:49', '2021-10-18 07:51:49'),
(22, 4, '616131311201321', '313130023484848', 'safsffs fsfdfsa', 'dfd', 'fffcsfade', '12545461611', 'sfasccceeee@gmail.com', 0, 1, '2021-10-18 07:53:56', '2021-10-18 07:53:56'),
(23, 4, '616131311201321', '313130023484848', 'safsffs fsfdfsa', 'dfd', 'fffcsfade', '12545461611', 'sfasccceeee@gmail.com', 0, 1, '2021-10-18 07:54:18', '2021-10-18 07:54:18'),
(24, 3, '616131311201321', '313130023484848', 'safsffs fsfdfsa', 'dfd', 'fffcsfades', '12545461611', 'sfasccddddceeee@gmail.com', 0, 1, '2021-10-18 07:54:56', '2021-10-18 07:54:56'),
(27, 4, '555555555512001', '555555555555555', 'ssss', 'ssss', 'ffffffeeee', '444444444222222', 'ccdeeeeeee@gmail.com', 0, 1, '2021-10-18 09:10:24', '2021-10-18 09:10:24'),
(28, 2, '222254415455555', '524236666235544', 'csdfsd', 'dfsdasdasdee', 'sdccdee', '454555221556333', 'dcsseee@gmail.com', 0, 1, '2021-10-18 10:03:49', '2021-10-18 10:03:49'),
(29, 2, '544444444422222', '555555511111111', 'ccbbbbbbb', 'ddddeeeeeeeee', 'ffffffffeeeee', '666666666555555', 'eeedddd@gmail.com', 0, 1, '2021-10-18 10:12:21', '2021-10-18 10:12:21'),
(30, 2, '555555555555222', '333333336666666', 'cccee', 'dddd', 'fffffeeee', '522221111111144', 'xxxxxxe@gmail.com', 0, 1, '2021-10-18 10:14:25', '2021-10-18 10:14:25'),
(31, 3, '215236652245633', '555465416546464', 'cceerffeee', 'casfsdafsadfs', 'nnnrrrrffff', '558888444566663', 'rrttt@gmail.com', 0, 1, '2021-10-18 10:17:52', '2021-10-18 10:17:52'),
(32, 3, '111111111111111', '111111111111111', '1111111111111', '1111111111111', '111111111111111', '111111111111111', '1111111111rryyyuuuu@gmail.com', 0, 1, '2021-10-18 10:20:06', '2021-10-18 10:20:06'),
(33, 2, '223333333333333', '222222211111111', 'ddceeeeee', 'ffffffff', 'eeeeettttttt', '444444441111111', 'ggggggg@gmail.com', 0, 1, '2021-10-18 10:23:52', '2021-10-18 10:23:52'),
(34, 2, '111122222222333', '555555544444412', 'eeeeeee', 'ttttttttt', 'hhhhhhhhhhh', '222288888888888', 'eyyyyyyyy@gmail.com', 0, 1, '2021-10-18 10:25:07', '2021-10-18 10:25:07'),
(35, 2, '333222222144442', '464655555555555', 'ddddddddddd', 'ffffffffff', 'eeeeeeeeeeeee', '2222222222222', 'aaaacccccccc@gmail.com', 0, 1, '2021-10-18 10:29:24', '2021-10-18 10:29:24'),
(36, 2, '222222222223333', '545646465465888', 'dadfas', 'asfsaf', 'eeeeeetyyyyyy', '4425555555555', 'yyyyyyyyrrrrrr@gmail.com', 0, 1, '2021-10-18 10:31:42', '2021-10-18 10:31:42'),
(37, 2, '696666666336969', '263464646464648', 'sadfsdeeee', 'sdfasde', 'sadttttt', '2223333333333', 'ewerwerw@gmail.com', 0, 1, '2021-10-18 10:32:49', '2021-10-18 10:32:49'),
(38, 2, '646464646446466', '646987987989988', 'dfssfsfasdf', 'asfsfasf', 'asdfseeeeeeeee', '65866778789797', 'adfassafttttttta@gmail.com', 0, 1, '2021-10-18 10:34:04', '2021-10-18 10:34:04'),
(39, 2, '464646546464646', '646464646464', 'sadfsafsaf', 'asfsadfas', 'asfewerwr', '3146466464', 'safeeetw@gmail.com', 0, 1, '2021-10-18 10:34:56', '2021-10-18 10:34:56'),
(40, 2, '464646546464646', '646464646464', 'sadfsafsaf', 'asfsadfas', 'asfewerwr', '3146466464', 'safeeetw@gmail.com', 0, 1, '2021-10-18 10:35:17', '2021-10-18 10:35:17'),
(41, 2, '56456464644', '994984949646944', 'safsadfsa', 'safsaf', 'asdfasf', '967467967979797', 'afsfsa555@gmail.com', 0, 1, '2021-10-18 10:35:54', '2021-10-18 10:35:54'),
(42, 2, '6476746769', '66746946946464', 'safsfsa', 'asfsadf', 'epppp', '7879678449449', 'puiouui@gmail.com', 0, 1, '2021-10-18 10:36:34', '2021-10-18 10:36:34'),
(43, 2, '6476746769', '66746946946464', 'safsfsa', 'asfsadf', 'epppp', '7879678449449', 'puiouui@gmail.com', 0, 1, '2021-10-18 10:38:34', '2021-10-18 10:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_setting`
--

CREATE TABLE `ctt_setting` (
  `id` int(11) NOT NULL,
  `parameter_id` int(11) NOT NULL,
  `parameter_value` varchar(250) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_setting`
--

INSERT INTO `ctt_setting` (`id`, `parameter_id`, `parameter_value`, `is_active`, `updated_date`) VALUES
(1, 1, '&copy; Copyright 2021 Contracktor. All Rights Reserved.', 1, '2021-07-06'),
(2, 2, 'https://www.facebook.com/', 1, '2021-03-30'),
(3, 3, 'https://help.twitter.com/', 1, '2021-04-01'),
(4, 4, 'http://www.google.com/', 1, '2021-03-30'),
(5, 5, 'https://www.youtube.com/', 1, '2021-04-05'),
(6, 6, 'https://www.instagram.com/', 1, '2021-04-05'),
(7, 7, 'info@contracktor.com', 1, '2021-05-14'),
(8, 8, '1234567890', 1, '2021-05-14'),
(9, 9, 'Jagannath Vihar, Baramunda, Bhubaneswar - 751003, Odisha,  India', 1, '2021-08-26'),
(10, 10, '1234567890', 1, '2021-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `ctt_state`
--

CREATE TABLE `ctt_state` (
  `id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `state_code` varchar(5) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt_state`
--

INSERT INTO `ctt_state` (`id`, `country_id`, `state_code`, `state_name`, `is_active`, `is_delete`) VALUES
(1, 1, '', 'Andaman & Nicobar Islands', 1, 0),
(2, 1, '', 'Andhra Pradesh', 1, 0),
(3, 1, '', 'Arunachal Pradesh', 1, 0),
(4, 1, '', 'Assam', 1, 0),
(5, 1, '', 'Bihar', 1, 0),
(6, 1, '', 'Chandigarh', 1, 0),
(7, 1, '', 'Chattisgarh', 1, 0),
(8, 1, '', 'Dadra & Nagar Haveli', 1, 0),
(9, 1, '', 'Daman & Diu', 1, 0),
(10, 1, '', 'Delhi', 1, 0),
(11, 1, '', 'Goa', 1, 0),
(12, 1, '', 'Gujarat', 1, 0),
(13, 1, '', 'Haryana', 1, 0),
(14, 1, '', 'Himachal Pradesh', 1, 0),
(15, 1, '', 'Jammu & Kashmir', 1, 0),
(16, 1, '', 'Jharkhand', 1, 0),
(17, 1, '', 'Karnataka', 1, 0),
(18, 1, '', 'Kerala', 1, 0),
(19, 1, '', 'Lakshadweep', 1, 0),
(20, 1, '', 'Madhya Pradesh', 1, 0),
(21, 1, '', 'Maharashtra', 1, 0),
(22, 1, '', 'Manipur', 1, 0),
(23, 1, '', 'Meghalaya', 1, 0),
(24, 1, '', 'Mizoram', 1, 0),
(25, 1, '', 'Nagaland', 1, 0),
(26, 1, '', 'Odisha', 1, 0),
(27, 1, '', 'Poducherry', 1, 0),
(28, 1, '', 'Punjab', 1, 0),
(29, 1, '', 'Rajasthan', 1, 0),
(30, 1, '', 'Sikkim', 1, 0),
(31, 1, '', 'Tamil Nadu', 1, 0),
(32, 1, '', 'Telangana', 1, 0),
(33, 1, '', 'Tripura', 1, 0),
(34, 1, '', 'Uttar Pradesh', 1, 0),
(35, 1, '', 'Uttarakhand', 1, 0),
(36, 99, '', 'West Bengal', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ctt_vendor`
--

CREATE TABLE `ctt_vendor` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `phone_landline` varchar(30) DEFAULT NULL,
  `phone_mobile` varchar(30) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address_corporate` text DEFAULT NULL,
  `address_correspondence` text DEFAULT NULL,
  `single_contact_name` varchar(250) DEFAULT NULL,
  `single_contact_phone` varchar(30) DEFAULT NULL,
  `single_contact_email` varchar(30) DEFAULT NULL,
  `company_type` varchar(250) DEFAULT NULL,
  `cin_no` varchar(30) DEFAULT NULL,
  `company_cin_no_file` varchar(250) DEFAULT NULL,
  `gst_no` varchar(30) DEFAULT NULL,
  `company_gst_no_file` varchar(250) DEFAULT NULL,
  `industries_operating` varchar(250) DEFAULT NULL,
  `state_id` varchar(30) DEFAULT NULL COMMENT 'state_id',
  `areas_of_expertise` varchar(250) DEFAULT NULL,
  `ims_certifications` varchar(250) DEFAULT NULL,
  `awards_recognitions` varchar(250) DEFAULT NULL,
  `technical_collaborations` varchar(250) DEFAULT NULL,
  `member_of_industry_association` int(11) DEFAULT NULL,
  `turn_over_year_one` date DEFAULT NULL,
  `turn_over_year_two` date DEFAULT NULL,
  `turn_over_year_three` date DEFAULT NULL,
  `turn_over_one` varchar(250) DEFAULT NULL,
  `turn_over_two` varchar(250) DEFAULT NULL,
  `turn_over_three` varchar(250) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctt_vendor_master`
--

CREATE TABLE `ctt_vendor_master` (
  `id` int(11) UNSIGNED NOT NULL,
  `sbu_details_id` int(11) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `vendor_email` varchar(250) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ctt_admin`
--
ALTER TABLE `ctt_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`,`admin_phone`),
  ADD UNIQUE KEY `admin_phone` (`admin_phone`);

--
-- Indexes for table `ctt_centralised_department`
--
ALTER TABLE `ctt_centralised_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctt_contract`
--
ALTER TABLE `ctt_contract`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contract_type` (`contract_type`);

--
-- Indexes for table `ctt_department`
--
ALTER TABLE `ctt_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `ctt_employee`
--
ALTER TABLE `ctt_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctt_industry`
--
ALTER TABLE `ctt_industry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industry_name` (`industry_name`);

--
-- Indexes for table `ctt_organisation`
--
ALTER TABLE `ctt_organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD KEY `industry_id_fk_industry` (`industry_id`);

--
-- Indexes for table `ctt_other_operational_department`
--
ALTER TABLE `ctt_other_operational_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD KEY `sbu_details_id_fk_sbu_details` (`sbu_details_id`);

--
-- Indexes for table `ctt_parameter`
--
ALTER TABLE `ctt_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctt_sbu`
--
ALTER TABLE `ctt_sbu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sbu_name` (`sbu_name`),
  ADD KEY `company_id_fk_sbu` (`company_id`);

--
-- Indexes for table `ctt_sbu_details`
--
ALTER TABLE `ctt_sbu_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sbu_id_fk_sbu` (`sbu_id`);

--
-- Indexes for table `ctt_setting`
--
ALTER TABLE `ctt_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parameter_id` (`parameter_id`);

--
-- Indexes for table `ctt_state`
--
ALTER TABLE `ctt_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctt_vendor`
--
ALTER TABLE `ctt_vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indexes for table `ctt_vendor_master`
--
ALTER TABLE `ctt_vendor_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_email` (`vendor_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ctt_admin`
--
ALTER TABLE `ctt_admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctt_centralised_department`
--
ALTER TABLE `ctt_centralised_department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `ctt_contract`
--
ALTER TABLE `ctt_contract`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctt_department`
--
ALTER TABLE `ctt_department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ctt_employee`
--
ALTER TABLE `ctt_employee`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ctt_industry`
--
ALTER TABLE `ctt_industry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ctt_organisation`
--
ALTER TABLE `ctt_organisation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctt_other_operational_department`
--
ALTER TABLE `ctt_other_operational_department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ctt_parameter`
--
ALTER TABLE `ctt_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ctt_sbu`
--
ALTER TABLE `ctt_sbu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ctt_sbu_details`
--
ALTER TABLE `ctt_sbu_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ctt_setting`
--
ALTER TABLE `ctt_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ctt_state`
--
ALTER TABLE `ctt_state`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ctt_vendor`
--
ALTER TABLE `ctt_vendor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctt_vendor_master`
--
ALTER TABLE `ctt_vendor_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctt_organisation`
--
ALTER TABLE `ctt_organisation`
  ADD CONSTRAINT `industry_id_fk_industry` FOREIGN KEY (`industry_id`) REFERENCES `ctt_industry` (`id`);

--
-- Constraints for table `ctt_other_operational_department`
--
ALTER TABLE `ctt_other_operational_department`
  ADD CONSTRAINT `sbu_details_id_fk_sbu_details` FOREIGN KEY (`sbu_details_id`) REFERENCES `ctt_sbu_details` (`id`);

--
-- Constraints for table `ctt_sbu`
--
ALTER TABLE `ctt_sbu`
  ADD CONSTRAINT `company_id_fk_sbu` FOREIGN KEY (`company_id`) REFERENCES `ctt_organisation` (`id`);

--
-- Constraints for table `ctt_sbu_details`
--
ALTER TABLE `ctt_sbu_details`
  ADD CONSTRAINT `sbu_id_fk_sbu` FOREIGN KEY (`sbu_id`) REFERENCES `ctt_sbu` (`id`);

--
-- Constraints for table `ctt_setting`
--
ALTER TABLE `ctt_setting`
  ADD CONSTRAINT `ctt_setting_ibfk_1` FOREIGN KEY (`parameter_id`) REFERENCES `ctt_parameter` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
