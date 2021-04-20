-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2021 at 06:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `claireli`
--

-- --------------------------------------------------------

--
-- Table structure for table `finalProjectUser`
--

CREATE TABLE `finalProjectUser` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finalProjectUser`
--

INSERT INTO `finalProjectUser` (`id`, `username`, `password`, `email`) VALUES
(6, 'john', '$2y$10$lHwemLqGCYGTAWFNZcbdJ.w9NHMln.t48bMt2u5yZz6EFjlmB8Cxe', 'john@gmail.com'),
(15, 'claire', '$2y$10$EOEhItp.ZwDYJ9qeFZNKvOe3Lmvlgeq6kWbAKdvaPWX9coG/HvfPG', 'lxhclaire@gmail.com'),
(18, 'aaaa', '$2y$10$HgBPX5V6mihM7gqzLVR6DuZHG/KJuCcUqLp7pZCr1BRFukd7cEr7a', 'caaa@gmail.com'),
(19, 'abc', '$2y$10$l6Ag5DmHL7MKPWIIurqUqeT0fN3OObF.ECS5LM1alMuV1eGTQZs3C', 'abc@gmail.com'),
(21, 'kkk', '$2y$10$gZlSL6ed45DekXfmniBXrO89crzWmElSfGnQsXP1vSAqlxevrKQGi', 'kkk@gmail.com'),
(22, 'bcd', '$2y$10$L8BamKk8q5rIdqYa3Oo.buR9TCmX1mumrrcrZSI6HIjKQJ7y8aUYe', 'bcdddd@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finalProjectUser`
--
ALTER TABLE `finalProjectUser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finalProjectUser`
--
ALTER TABLE `finalProjectUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
