-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 03:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*! NOMES */;

--
-- Database: `auth_db`
--

-- --------------------------------------------------------

--
-- Estrutura da table 'users'
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar (255) NOT NULL,
  `email` varchar (255) NOT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Index para table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


--
-- AUTO INCREMENTO para table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

