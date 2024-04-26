-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 11:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog-forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user_id`, `content`, `created_at`, `idPost`) VALUES
(1, 1, 'hello', '2024-04-21 19:23:40', 1),
(2, 1, 'heeee', '2024-04-21 19:23:49', 1),
(3, 1, 'heeee', '2024-04-21 19:26:48', 1),
(4, 1, 'heeee', '2024-04-21 19:27:01', 1),
(5, 1, 'heeee', '2024-04-21 19:27:15', 1),
(6, 1, 'heeee', '2024-04-21 19:27:34', 1),
(7, 1, 'heeee', '2024-04-21 19:27:50', 1),
(8, 1, 'heeee', '2024-04-21 19:33:52', 1),
(9, 1, 'hellooooo ', '2024-04-21 19:34:52', 1),
(10, 1, 'hellooooo ', '2024-04-21 19:35:22', 1),
(11, 1, 'hellooooo ', '2024-04-21 19:38:39', 1),
(12, 1, 'hey melek ', '2024-04-21 19:39:02', 2),
(13, 1, 'hey melek ', '2024-04-21 19:39:20', 2),
(14, 1, 'hey melek ', '2024-04-21 19:41:13', 2),
(15, 1, 'heyy its farouk', '2024-04-21 19:41:24', 2),
(16, 1, 'heyy its farouk', '2024-04-21 19:43:32', 2),
(17, 1, 'heyy its farouk', '2024-04-21 19:43:48', 2),
(18, 1, 'heyy its farouk', '2024-04-21 21:35:31', 2),
(19, 1, 'heyy its farouk', '2024-04-21 21:36:35', 2),
(20, 1, 'heyy its farouk', '2024-04-21 21:38:20', 2),
(21, 1, 'hello malek this is a good post', '2024-04-21 21:41:04', 4),
(22, 1, 'hellooooo ', '2024-04-21 21:41:19', 4),
(23, 1, 'hellooooo ', '2024-04-21 21:43:29', 4),
(24, 1, 'hellooooo ', '2024-04-21 21:44:43', 4);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `user_id` int(11) DEFAULT NULL,
  `idPost` int(11) NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL,
  `Create_At` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `Updated_At` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `Upvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`user_id`, `idPost`, `TITRE`, `content`, `Create_At`, `Updated_At`, `Upvote`) VALUES
(1, 1, 'aaa', 'helooheloohelooheloohelooheloohelooheloohelooheloohelooheloohelooheloohelooheloohelooheloo', '2022-04-16 10:00:00', '2024-04-21 16:56:22', 12),
(NULL, 2, 'hahahah', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '2022-04-16 10:00:00', '2024-04-21 19:20:31', 11),
(NULL, 3, 'hello new post', 'I need a flutter developer and design for my hotel inbox me urgently......................................................', '2022-04-16 10:00:00', '2024-04-21 21:36:22', 1),
(NULL, 4, 'The Benefits of Daily Meditation', 'Meditation has been shown to reduce stress, improve focus, and increase feelings of well-being. ', '2024-04-21 21:39:26', '2024-04-21 21:39:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `imgURL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `imgURL`) VALUES
(1, 'Melek', 'melek.png'),
(2, 'Ahmed', 'ahmed.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC29773213` (`idPost`),
  ADD KEY `IDX_67F068BCA76ED395` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `IDX_5A8A6C8DA76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC29773213` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`),
  ADD CONSTRAINT `FK_67F068BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
