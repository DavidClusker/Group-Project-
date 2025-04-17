-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 06:24 AM
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
-- Database: `giftbarks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Password`, `Username`) VALUES
(2, 'Frog', '1fd7e899549552aa15350d6b5c2c5ea9', 'Frog'),
(5, 'man1', '', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drink_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`drink_id`, `name`, `price`) VALUES
(1, 'Singing Scotch', 7),
(2, 'Mario Martini', 6),
(3, 'Minecraft Potion', 10),
(4, 'Luigi Lager', 7),
(5, 'The Perkymon', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(10) NOT NULL,
  `Drinks` varchar(150) NOT NULL,
  `RoomNum` int(10) NOT NULL,
  `Amount` int(10) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `Drinks`, `RoomNum`, `Amount`, `Name`, `Email`, `Cost`) VALUES
(3, 'Test Drink', 101, 1, 'Test User', 'test@example.com', 10),
(4, 'Test Drink', 101, 1, 'Test User', 'test@example.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `type` varchar(200) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `price`, `is_available`, `type`, `img_src`, `name`, `description`) VALUES
(1, 26, 1, 'Karaoke', 'images/70s.png', '70s', 'This Karaoke game will contain iconic songs from the 70s and gotta continue singing the lyrics until the music in the background stops.\r\nThis includes movies from the 80s where you need to guess the character speaking a famous line.'),
(2, 26, 1, 'Karaoke', 'images/80s.png', '80s', 'This Karaoke game will contain iconic songs from the 80s and gotta continue singing the lyrics until the music in the background stops.\r\nThis includes movies from the 80s where you need to guess the character speaking a famous line.'),
(3, 26, 1, 'Karaoke + Gaming', 'images/GH.png', 'Guitar Hero', 'This Karaoke game is based of the popular Rythme Game, Guitar Hero, making the players play the guitar in the exact rythme the game is showing.\r\nThe music you select varies from many popular guitar songs.\r\n'),
(4, 26, 1, 'Karaoke + Gaming', 'images/LD.png', 'Lets Dance', 'This Karaoke game allows the players to dance and mimic what they are seeing on the display, the more accurate you are to mimic\r\nthe dancer, the more points you score!'),
(5, 26, 1, 'Gaming', 'images/price.png', 'Call Of Duty', 'This Karaoke game will contain iconic lines from all of the call of duty games, all the way\r\nfrom World At War up to the newest game in the franchise, Black Ops 6.This room will include as well, guns that you need to guess there name and characters as wel'),
(6, 26, 1, 'Gaming', 'images/minecraft.png', 'Minecraft', 'This karaoke game will contain sound effects from the game, such as, the sheep, zombie and villager,etc.\r\nThe room will be themed in a minecraft themed atmosphere.\r\nThe room will also have a minigame to correctly guess the crafting recipes of any kind of\r');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `points`) VALUES
(1, 'man1', 'man1@gmail.com', 'test', 0),
(2, 'dan', 'dan@gmail.com', '$2y$10$u7eKEgO2ybOeoYsYZq7KROMS08AKGZB./ueLxeoyanyKmrO9RW90.', 1213),
(3, 'bob', 'bob2025@gmail.com', '$2y$10$d2p29e95.9wR65EaND2Vmuhfm3kfiiE33Kw6/eISqj9fBRHRj2Lha', 0),
(4, 'David', 'David2025@gmail.com', '$2y$10$wlwW6sRH2x4Q5f.esHw/8usll5Li3j9YvnCPjzDi64.7GVu6kDWmO', 0),
(5, 'david', 'david1@gmail.com', '$2y$10$avlFrW33GQm0TgV57sMjPeooBRhh6wI2n7OuJmSuwPcqcCpuBUh2C', 0),
(6, 'jay', 'jay1@gmail.com', '$2y$10$/OvHXKMABAvoHgsfc0qPpu/akQf94NnmdyAPD5jUotLKu8ST.8TI.', 0),
(7, 'man2', 'man2@gmail.com', '$2y$10$.C6i5jYpA2YIrPSZMN8zwuewtWL1nWQW99ctKIaoCEHm4SL6ggp2O', 0),
(8, 'bab', 'bab@gmail.com', '$2y$10$PU3rh5SzgiUjXEM9.YuuEu7sc69fDkWN2ZJ5jyFL4In.oU.wqLoCi', 0),
(9, 'testman', 'testman@gmail.com', '$2y$10$cWw.H0fVNA0HtGFvRAxLOeVGwNTDFQXvofd11dHBBihbiMiAUHQkW', 0),
(10, 'tester', 'tester@gmail.com', '$2y$10$puyrRcgUvCQdNsuAcilyIuH6uurYc43WAQJzN7ZomOCb/sSmz//Fa', 0),
(11, 'Grob', 'grob@gmail.com', '$2y$10$fw10olLPCvKl..nj3awp5.MkiFKSy0GMaAaymmK4iJJbPGWifipBC', 0),
(14, 'frogman', 'frogman@gmail.com', '$2y$10$qJeEP3Gmb3sbFL2Ejn/AjOMvjnckmXBNZCEsoEgMGGT5b1rsnapHW', 0),
(15, 'nero', 'nero@gmail.com', '$2y$10$K8POd9ibyUC8g56cl.5fr.3QkLViiA4R5kYfb.nmH2dk6ron9CFM6', 4730),
(16, 'new', 'new@gmail.com', '$2y$10$26dq02ECrIpXJFfCwhM.EeRXQk6LvMXHa94kSIjO4ouoStF7Whtue', 0),
(28, 'existinguser', 'existinguser@example.com', '$2y$10$YUC8ey3beEtid86/8vm4i.G3FCxFlbv.KSIW2klXr2ArKXCrhgzmK', 0),
(29, 'existinguser', 'existinguser@example.com', '$2y$10$KIb5AhC4mYRlnJH8j9m25.6TqMfOM4BTWO.NnxMEdPMnvZEz2.hMi', 0),
(30, 'existinguser', 'existinguser@example.com', '$2y$10$XygtP72wSeP/vYqHVczqke6uD20I38wQq2.WeRT3HK5r1u1GA243i', 0),
(31, 'existinguser', 'existinguser@example.com', '$2y$10$TFrMwUV7ouKr9NyqY4WYRuGpWH9cdRS9ND71qn16eJFGPAZ/vBuk2', 0),
(32, 'existinguser', 'existinguser@example.com', '$2y$10$5BEiYizjsjnwiowzq/FB2eAk7y77V3NCyjWZIhyl4quUO/tPJPxvq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
