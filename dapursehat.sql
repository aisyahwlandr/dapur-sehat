-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 07:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dapursehat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '0a14de5a76e5e14758b04c209f266726'),
(2, 'aisyah', 'aisyah@gmail.com', 'bc4198de11411d350ffc03842ba22e80'),
(3, 'wulan', 'wulan@gmail.com', 'd826e9fe4d19cb77231c210f1109d46e'),
(4, 'aisyah wulandari', 'aisyahwulandari@gmail.com', '2939fddc39837743defe24f6864a428d'),
(5, 'yugen', 'yugen@gmail.com', '7ec02f01f0c3765ce14f088cf79281d2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `wilayah` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `mtdBayar` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Menunggu Bukti Pembayaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `nama`, `telepon`, `email`, `wilayah`, `alamat`, `mtdBayar`, `order_date`, `status`) VALUES
(1, 'Viko', '6281818181', 'viko@gmail.com', 'Kampus K Universitas Gunadarma', 'Perumnas 2, Jalan Rama Raya', 'OVO', '2024-06-07 14:54:03', 'Bukti Bayar Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_orders` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant`, `quantity`, `harga_orders`) VALUES
(1, 1, 3, 'Nugget Pisang', 1, '20000'),
(2, 1, 4, 'Bakso Sapi', 1, '25000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `photo1` varchar(225) NOT NULL,
  `photo2` varchar(225) NOT NULL,
  `photo3` varchar(225) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `isi` varchar(50) NOT NULL,
  `deskripsi` varchar(225) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `variant`, `photo1`, `photo2`, `photo3`, `harga`, `isi`, `deskripsi`, `stock`) VALUES
(1, 'Nugget Ayam Original', 'NuggetAyamPhoto1.jpg', 'NuggetUniversalPhoto2.jpg', 'NuggetAyamOriginal.png', '30000', '10 Pcs', 'Terbuat dari daging ayam pilihan yang telah digiling dan dibumbui tanpa menggunakan bahan pengawet, kemudian dibentuk menjadi potongan-potongan bundar dengan tekstur lembut di dalam dan lapisan renyah di luar', 10),
(2, 'Nugget Ayam Keju', 'NuggetKejuPhoto1.jpg', 'NuggetUniversalPhoto2.jpg', 'NuggetAyamKeju.png', '35000', '10 Pcs', 'Terbuat dari daging ayam pilihan yang telah digiling dan isian keju yang melimpah, kemudian dibentuk oval dengan tekstur lembut di dalam dan lapisan renyah di luar', 15),
(3, 'Nugget Pisang', 'NuggetPisangPhoto1.jpg', 'NuggetUniversalPhoto2.jpg', 'NuggetPisang.png', '20000', '10 Pcs', 'Terbuat dari pisang kepok berkualitas yang bercita rasa manis dan lembut, lalu dibalut dengan lapisan luar yang renyah, cocok untuk di tambahkan topping seperti saus coklat maupun keju', 7),
(4, 'Bakso Sapi', 'BaksoSapiPhoto1.jpg', 'BaksoSapiPhoto2.jpg', 'BaksoSapi.png', '25000', '10 Pcs', 'Terbuat dari daging sapi dengan memperhatikan kualitas dan kehigienisan daging yang dipilih, sehingga aman, halal, dan sehat untuk di konsumsi.', 14),
(5, 'Kentang Goreng Beku', 'KentangGorengPhoto1.jpg', 'KentangGorengPhoto2.jpg', 'KentangGoreng.png', '35000', '1 Kg', 'Terbuat dari kentang premium yang bercita rasa manis, kentang beku ini juga telah dibumbui dengan rasa yang gurih sehingga sangat nikmat setelah digoreng', 10);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bktBayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `telepon`, `createdAt`, `bktBayar`) VALUES
(1, '6281818181', '2024-06-07 15:00:57', '2024-06-07_22-00-57_WhatsApp Image 2024-06-07 at 21.56.00_be503d1e.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
