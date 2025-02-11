-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 12:56 PM
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
-- Database: `accounts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `id_pwd_tb`
--

CREATE TABLE `id_pwd_tb` (
  `id` varchar(9) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_pwd_tb`
--

INSERT INTO `id_pwd_tb` (`id`, `pwd`) VALUES
('111111111', '$2y$10$r6yNuyQPy/iwbClUfvyZgOdtXLDWGab31AqsGNNN6ba1iKIQvWDV6'),
('111403508', '$2y$10$BKIyjmeopGpbuTCfoGSm.e1aSjII/TsRJo7mLzPTvsN8cRGa15TmW');

-- --------------------------------------------------------

--
-- Table structure for table `reset_pwd_tokens_tb`
--

CREATE TABLE `reset_pwd_tokens_tb` (
  `token` varchar(64) NOT NULL,
  `user_id` varchar(9) NOT NULL,
  `used` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_pwd_tokens_tb`
--

INSERT INTO `reset_pwd_tokens_tb` (`token`, `user_id`, `used`) VALUES
('15888191ab5ee16c7edfae9c83ebacae1cd0327b44f44077fafd8d305152aa1e', '111403508', '1'),
('4cc856c46d4a177eca74d9ebf3ce63902ec1ef555c907ca9bfad455598dd4eab', '111403508', '1'),
('d86f185de8664ebb340857cec47e48d80c6d38c6dcc39367a59ca998396faae2', '111111111', '1');

-- --------------------------------------------------------

--
-- Table structure for table `verification_tokens_tb`
--

CREATE TABLE `verification_tokens_tb` (
  `token` varchar(64) NOT NULL,
  `user_id` varchar(9) NOT NULL,
  `used` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_tokens_tb`
--

INSERT INTO `verification_tokens_tb` (`token`, `user_id`, `used`) VALUES
('357f6976d30cfbe7812390e9fa3711804a2646e5f7979e771ad7422cebd88723', '111403508', '1'),
('dc38d60fbb6e23e29f0b93dae3c5c60ef73eaf7c590a66f9aa21eabb7cbea9e7', '111111111', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `id_pwd_tb`
--
ALTER TABLE `id_pwd_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_pwd_tokens_tb`
--
ALTER TABLE `reset_pwd_tokens_tb`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `verification_tokens_tb`
--
ALTER TABLE `verification_tokens_tb`
  ADD PRIMARY KEY (`token`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
