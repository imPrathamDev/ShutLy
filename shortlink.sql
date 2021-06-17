-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 08:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `shortlink`
--

CREATE TABLE `shortlink` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `short_link` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(10) NOT NULL DEFAULT 0,
  `count_hit` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shortlink`
--

INSERT INTO `shortlink` (`id`, `link`, `short_link`, `name`, `status`, `count_hit`, `date`, `username`) VALUES
(6, 'https://heroicons.com/', 'icon', 'Icon', 0, 0, '2021-06-14 15:37:01', 'admin'),
(7, 'https://tailblocks.cc/', 'TailWind', 'TailWind', 1, 1, '2021-06-14 16:16:45', 'admin2'),
(8, 'https://ongakugarage.in/', 'OngakuGarage', 'Ongaku Garage', 1, 0, '2021-06-14 17:29:09', 'Pratham Sharma'),
(9, 'https://ongakugarage.in/', 'yes no', 'MusicGarage2021', 1, 0, '2021-06-14 17:30:01', 'Pratham Sharma'),
(10, 'https://www.000webhost.com/forum/t/ip-address-of-my-website/56440', 'IP', 'IP', 1, 0, '2021-06-16 18:38:24', 'Naruto'),
(11, 'https://timesofindia.indiatimes.com/city/delhi/delhi-riots-student-activists-natasha-narwal-devangana-kalita-asif-iqbal-tanha-released-on-bail/articleshow/83607441.cms', 'shila', 'shila\'s frist link', 1, 1, '2021-06-17 18:04:11', 'Shila');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shortlink`
--
ALTER TABLE `shortlink`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shortlink`
--
ALTER TABLE `shortlink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
