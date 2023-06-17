-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2023 at 07:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JewelryShop`
--
CREATE DATABASE IF NOT EXISTS `JewelryShop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `JewelryShop`;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `AdminFirstName` varchar(20) NOT NULL,
  `AdminLastName` varchar(20) NOT NULL,
  `AdminUserName` varchar(20) NOT NULL,
  `AdminPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`AdminFirstName`, `AdminLastName`, `AdminUserName`, `AdminPassword`) VALUES
('Bayan', 'Alhumaidan', 'Bahumaidan', 'Ba2001hu'),
('Najla', 'Almajed', 'Najlamajed', 'Na219almaj'),
('Shahad', 'Alghofaily', 'Shghofaily', 'Sh22ghofaily');

-- --------------------------------------------------------

--
-- Table structure for table `Products_`
--

CREATE TABLE `Products_` (
  `Pid` int(5) NOT NULL,
  `ProductsName` varchar(50) NOT NULL,
  `ProductPrice` double NOT NULL,
  `ProductDescription` varchar(1000) DEFAULT NULL,
  `ProductCategory` varchar(20) DEFAULT NULL,
  `ProductsImage` varchar(200) NOT NULL,
  `Stock` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products_`
--

INSERT INTO `Products_` (`Pid`, `ProductsName`, `ProductPrice`, `ProductDescription`, `ProductCategory`, `ProductsImage`, `Stock`) VALUES
(1, 'White Gold Pink Tourma line', 6500, 'This Pink Tourmaline and Diamond ring features an oval cut, pink tourmaline surrounded by a halo of white diamonds. This elegant ring has a regal appeal, like the gems on a crown. This is set in 14K white gold.', 'Ring', 'Picture1.jpeg', 16),
(2, 'Karat White Gold', 3700, 'This 14 Karat White Gold ring is set with a full half carat of G Color, VS Clarity diamonds.\r\nThis ring measure 1.8mm in width.', 'Ring', 'Picture2.jpeg', 8),
(3, 'Karat Rose Gold Lotus Color Sapphire Diamond Ring', 5095, 'This beautiful natural sapphire is a beautiful lotus color, and handset in 14 karat rose gold to accentuate the pink and orange tones. Sapphire is 0.65ct, and champagne diamonds are 0.32cts Sapphire is 4x6mm, halo is 7.5x8mm', 'Ring', 'Picture3.jpeg', 170),
(4, 'Yellow Gold Diamond Earring', 2600, 'This pair of champagne diamond earrings hang on 14 karat yellow gold earring. These simple, timeless earrings are understated, and a great compliment to your other gold jewelry pieces. The earring size is 6mm.', 'Earring', 'Picture4.webp', 149),
(5, 'Rose Gold Earring', 1500, '14K yellow gold.\r\nThe total carat weight of the earring is 0.85 mm', 'Earring', 'Picture5.webp', 50),
(6, 'Diamo nd Earring', 9700, 'This 14K Rose Gold. These emerald cut diamonds are prong set, showing off the sharp clean edges of the champagne diamond. The total carat weight of these diamonds is 0.84 mm.', 'Earring', 'Picture6.jpeg', 73),
(7, 'Butterfly y wings Necklace', 8300, 'This natural pink tourmaline is hand carved into butterfly wings. Each natural stone is uniquely set into 14 karat white gold, and a halo of white diamonds are set around the wings. This 14 karat white gold necklace is on a 16-18” adjustable chain, so it can be worn at any length. The necklace is 23x25mm. Total tourmaline carat weight is 3.00ct. Total diamond carat weight is 0.44ct', 'Necklace', 'Picture7.jpeg', 98),
(8, 'Yellow Gold Diamond and Labradorite Necklace', 7490, 'This labradorite is set in 14 karat yellow gold, with a halo of white diamonds around the center stone. This necklace is adjustable, 16-18 inches in length. Diamond weight is 0.40ct.', 'Necklace', 'Picture8.jpeg', 37),
(9, 'Karat Yellow Gold Diamond Bangle', 6200, 'This micro pave white diamond bangle set in solid 14 karat yellow gold. Adjustable lobster clasp attaching from the bottom for optimal security.\r\nTotal weight of the diamonds is 0.25 carat. The bracelet is 1.5mm thick. The diamond ID bar is 26mm long.', 'Bracelet', 'Picture9.jpeg', 40),
(10, 'White Gold Multi Color Sapphire Tennis Bracelet', 9500, 'This beautiful 14K white gold tennis bracelet features graduated, pink, purple, and blue sapphires. These sapphires are emerald cut, bringing out the gorgeous fire in the stones. The bracelet is 5.5mm wide and 7 inches long. The sapphires weigh 11.92 carats in total. This bracelet can be a great standalone piece or the perfect addition to your bracelet stack. Sapphire is the birthstone of September.', 'Bracelet', 'Picture10.jpeg', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdminUserName`);

--
-- Indexes for table `Products_`
--
ALTER TABLE `Products_`
  ADD PRIMARY KEY (`Pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Products_`
--
ALTER TABLE `Products_`
  MODIFY `Pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
