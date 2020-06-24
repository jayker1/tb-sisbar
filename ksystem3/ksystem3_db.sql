-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Feb 2020 pada 08.18
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksystem3_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(4, 'Abdul Gani', 'gani@gmail.com', '121312', '1018616.jpg', '$2y$10$3fa8usUUC6pJU3oSv3P1weqFtKjKFIy6XBILSd.RgRRziTBmMgoLa', 1, 1, 1574408209),
(5, 'Gani', 'gani123@gmail.com', '1213123', 'default.jpg', '$2y$10$9kckT3JFBADy4b8iKArr1OqrkO7QzcqFPjTftO7aEzBFcCl9lbTq.', 2, 1, 1574414934),
(23, 'Steven', 'steven@gmail.com', '1234567', 'default.jpg', '$2y$10$23nJpa9RYcjFaf.ZDgiJo.4Y/vznnlgW3KKyFjRY.wx9.pBJnm4xO', 3, 1, 1576475197),
(24, 'Dobleh', 'dobleh@gmail.com', '1234567', 'default.jpg', '$2y$10$Z8Pz9Zq5ThyqvivRWA7JZeJ3FwoLda2p6zoy6jn36CCWUyKJ0pyfq', 4, 1, 1576475242),
(52, 'Muhammad Abdul Gani Wijaya', 'muhamad.gani33@gmail.com', '1234567', 'default.jpg', '$2y$10$RJrHwxkLh/FGgd2.Rpl45OrT2be0MZ9LQaYBG6Ejs6/Mhzw0xefIC', 2, 1, 1578196098),
(53, 'alfadian', 'alfafianowen.ao@gmal.com', '081892389245972637923597a', 'default.jpg', '$2y$10$Y6m8pgWSCfZ/NZeU/aFcIu7fq1r49vsNSLAkZz9ac0WB9l4NP5cva', 2, 0, 1579618123),
(54, 'alfadian', 'alfafianowen.ao@gmail.com', '1223412312', 'default.jpg', '$2y$10$Y.Qs/BQ8HZq1MmWrkfuCD.QP9TfyO9yVfPitm3Syy8LpS47kBQPEa', 2, 0, 1579618284);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Finance'),
(4, 'Secretary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
