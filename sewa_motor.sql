-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2024 pada 13.57
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa_motor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `electric_motorcycles`
--

CREATE TABLE `electric_motorcycles` (
  `motorcycle_id` int(11) NOT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `hourly_rental_price` decimal(10,0) DEFAULT NULL,
  `image_url` text NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `electric_motorcycles`
--

INSERT INTO `electric_motorcycles` (`motorcycle_id`, `merk`, `model`, `year`, `hourly_rental_price`, `image_url`, `status`, `location_id`) VALUES
(67, 'Super Soco', 'TC Max', 2023, 2000, '1475812276_images.jpg', 0, 21),
(69, 'Gogoro', 'Gogoro 2 Series', 2023, 10000, '1791693601_download.jpg', 1, 19),
(70, 'Gogoro', 'Gogoro 3 Series', 2023, 16000, '203439462_Screenshot 2024-06-26 215358.png', 1, 19),
(71, 'NIU', 'NIU NQi GT', 2023, 13000, '26645217_Screenshot 2024-06-26 215435.png', 1, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(100) DEFAULT NULL,
  `location_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_address`) VALUES
(19, 'Jakarta', 'Jl. Sudirman No. 1, Jakarta'),
(20, 'Bandung', 'Jl. Asia Afrika No. 2, Bandung'),
(21, 'Surabaya', 'Jl. Raya Darmo No. 3, Surabaya'),
(22, 'Yogyakarta', 'Jl. Malioboro No. 4, Yogyakarta'),
(23, 'Semarang', 'Jl. Pahlawan No. 5, Semarang'),
(24, 'Medan', 'Jl. Merdeka No. 6, Medan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `jumlah_pembayaran` decimal(10,2) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `rental_id`, `jumlah_pembayaran`, `tanggal_pembayaran`) VALUES
(52, 83, 13.00, '2024-06-20'),
(53, 84, 13.00, '2024-06-20'),
(54, 85, 1274.00, '2024-06-24'),
(55, 86, 15.00, '2024-06-26'),
(56, 87, 16.00, '2024-06-26'),
(57, 88, 14.00, '2024-06-26'),
(58, 89, 13.00, '2024-06-26'),
(59, 90, 16000.00, '2024-06-26'),
(60, 91, 2000.00, '2024-06-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `motorcycle_id` int(11) DEFAULT NULL,
  `waktu_sewa` datetime DEFAULT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `total_biaya` decimal(10,2) DEFAULT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `motorcycle_id`, `waktu_sewa`, `waktu_kembali`, `total_biaya`, `status_pembayaran`) VALUES
(83, 49, 71, '2024-06-20 18:51:10', '2024-06-20 18:51:58', 13.00, 'berhasil'),
(84, 8, 71, '2024-06-20 18:52:53', '2024-06-20 18:56:10', 13.00, 'berhasil'),
(85, 8, 71, '2024-06-20 21:41:34', '2024-06-24 22:56:52', 1274.00, 'berhasil'),
(86, 49, 67, '2024-06-26 19:56:06', '2024-06-26 19:59:03', 15.00, 'berhasil'),
(87, 8, 70, '2024-06-26 21:23:20', '2024-06-26 21:55:20', 16.00, 'berhasil'),
(88, 49, 69, '2024-06-26 21:28:46', '2024-06-26 21:29:45', 14.00, 'berhasil'),
(89, 49, 71, '2024-06-26 22:02:22', '2024-06-26 22:02:29', 13.00, 'berhasil'),
(90, 8, 70, '2024-06-26 23:17:03', '2024-06-26 23:20:08', 16000.00, 'berhasil'),
(91, 49, 67, '2024-06-27 08:47:57', '2024-06-27 08:50:17', 2000.00, 'berhasil'),
(92, 49, 67, '2024-06-27 08:53:16', '2024-06-27 08:54:04', 2000.00, 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `fullname`, `address`, `phone`, `role`) VALUES
(8, 'Ravindra', 'ravindraviswanatha@gmail.com', '$2y$10$qxy5PqG0F5T.0KQngsiq2eTrDyrioFQzdpPEVj8NM31SbK16db2/q', 'Putu Ravindra Viswanatha', 'jl. lol', '087777231004', 1),
(49, 'JroDatuk', 'datukputra23@gmail.com', '$2y$10$YBbn3maq8fXAlCw9bUeuw.J8Yb5nIuNixFXGgTgxyF1ZChtSb9y1W', 'Jro Datuk Putra LOL', 'JL. Kocak', '1029384756', 2),
(54, 'Komang', 'Komang@gmail.com', '$2y$10$54IqRc6zHdbtJd/v.2yWYe0edgedlAISZlrR/F2BpOOrLhAaGdd.2', 'Komang GG', '', '12321313123213123', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `electric_motorcycles`
--
ALTER TABLE `electric_motorcycles`
  ADD PRIMARY KEY (`motorcycle_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `rental_id` (`rental_id`);

--
-- Indeks untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `motor_id` (`motorcycle_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `electric_motorcycles`
--
ALTER TABLE `electric_motorcycles`
  MODIFY `motorcycle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `electric_motorcycles`
--
ALTER TABLE `electric_motorcycles`
  ADD CONSTRAINT `electric_motorcycles_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_rental` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`);

--
-- Ketidakleluasaan untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `fk_motorcycle` FOREIGN KEY (`motorcycle_id`) REFERENCES `electric_motorcycles` (`motorcycle_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`motorcycle_id`) REFERENCES `electric_motorcycles` (`motorcycle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
