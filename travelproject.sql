-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 07:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password_` text NOT NULL,
  `username` text NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password_`, `username`, `registertime`) VALUES
(1, 'kanakarncha@gmail.com', 'kanakarn20', 'Foamkrab', '2022-08-22 06:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `place_travel`
--

CREATE TABLE `place_travel` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `title` text NOT NULL,
  `picture` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `place_travel`
--

INSERT INTO `place_travel` (`id`, `name`, `title`, `picture`, `address`) VALUES
(1, 'Bangkok', 'Bangkok title test', 'ImageTest/imgbangkok.jpg', 'null'),
(2, 'Ayotthaya', 'Test Ayotthaya', 'ImageTest/imgAyutthaya.jpg', 'dd'),
(10, 'time_update TESTTTWE', 'ss', 'Image/imgSukhothai.jpg', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `top_ten_best`
--

CREATE TABLE `top_ten_best` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `time_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `top_ten_best`
--

INSERT INTO `top_ten_best` (`id`, `name`, `title`, `image`, `address`, `time_update`) VALUES
(1, 'Bangkok', 'กรุงเทพมหานคร เป็นเมืองหลวงและนครที่มีประชากรมากที่สุดของประเทศไทย เป็นศูนย์กลางการปกครอง การศึกษา การคมนาคมขนส่ง การเงินการธนาคาร การพาณิชย์ การสื่อสาร และความเจริญของประเทศ ตั้งอยู่บนสามเหลี่ยมปากแม่น้ำเจ้าพระยา มีแม่น้ำเจ้าพระยาไหลผ่านและแบ่งเมืองออกเป', 'ImageTest/imgbangkok.jpg', '', '2022-08-09 16:15:13'),
(3, 'Ayutthaya', 'lorem test', 'ImageTest/imgAyutthaya.jpg', '', '0000-00-00 00:00:00'),
(9, 'test', 'wew', 'Image/imgbangkok.jpg', 'test', '0000-00-00 00:00:00'),
(10, 'time_update 555qq', 'dd', 'Image/imgKaoSamRoiYotNationalPark.jpg', 'test', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_travel`
--
ALTER TABLE `place_travel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_ten_best`
--
ALTER TABLE `top_ten_best`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `place_travel`
--
ALTER TABLE `place_travel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `top_ten_best`
--
ALTER TABLE `top_ten_best`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
