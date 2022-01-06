-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2021 at 10:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtttn1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `pass`) VALUES
('hongminh', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `passWord` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID`, `username`, `email`, `passWord`, `fullname`, `phonenumber`, `address`) VALUES
(1, 'hongminh', 'minh@gmail.com', '202cb962ac59075b964b07152d234b70', 'Nguyễn Hồng Minh', 987654321, 'Khanhs An'),
(5, 'minhbaka', 'minh@gmail.com', '202cb962ac59075b964b07152d234b70', 'Nguyễn Văn A', 987654321, 'Khanhs An,U Minh, Ca Mau'),
(6, 'minhlua', 'minh@gmail.com', '202cb962ac59075b964b07152d234b70', 'Nguyễn Văn Minh Lúa', 987654321, 'Khanhs An'),
(7, 'minhlua123', 'gianglao31@gmail.com', '202cb962ac59075b964b07152d234b70', 'Nguyễn Hồng Giang', 912232323, 'Caan Thow'),
(8, 'bwinminh991', 'minhbaka@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Nguyễn Hồng Giang', 912232323, 'Can Tho'),
(9, 'minhlua111', 'minhbaka@gmail.com', '202cb962ac59075b964b07152d234b70', 'Nguyễn Hồng Khang', 967545454, 'Cà Mau'),
(10, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `membercatogery`
--

CREATE TABLE `membercatogery` (
  `ID` int(11) NOT NULL,
  `typeMember` text COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `ID` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `createdDate` date DEFAULT NULL,
  `receivedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`ID`, `idmember`, `total`, `status`, `createdDate`, `receivedDate`) VALUES
(71, 1, '264000', 'Processed', '2021-12-25', '2021-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `typeID` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `trademark` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `priceSale` decimal(11,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `catogeryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `name`, `typeID`, `status`, `trademark`, `price`, `priceSale`, `quantity`, `image`, `description`, `discount`, `catogeryID`) VALUES
(16, 'Bún tươi', 1, 1, 'Ba Khánh', '150000', '135000', 10, 'buntuoisoinho.png', 'chưa có mô tả', 10, 2),
(19, 'Bún tươi', 2, 1, 'Ba Khánh', '100000', '88000', 10, 'bunsoitrung.webp', 'null', 12, 2),
(20, 'Bún tươi', 3, 1, 'Ba Khánh', '130000', '115700', 10, 'buntuoisoilon.webp', 'null', 11, 2),
(26, 'Bún Bò', 6, 1, 'Ba Khánh', '134000', '116580', 12, 'bunbo-front_large.png', 'hong co', 13, 3),
(27, 'Bánh Ướt', 6, 1, 'Ba Khánh', '129000', '116100', 10, 'banhuotgao.png', 'hong co', 10, 6),
(35, 'Bánh Phở Tươi', 4, 1, 'Ba Khánh', '110000', '106700', 15, 'banhpho.png', 'Khoong cos', 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`ID`, `name`) VALUES
(2, 'Bún Tươi'),
(3, 'Bún Bò Huế'),
(4, 'Hủ Tiếu'),
(5, 'Bánh Canh'),
(6, 'Bánh Ướt'),
(7, 'Bánh Hỏi'),
(8, 'Bánh Phở Tươi');

-- --------------------------------------------------------

--
-- Table structure for table `productoder`
--

CREATE TABLE `productoder` (
  `oderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `priceProduct` decimal(10,0) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `productoder`
--

INSERT INTO `productoder` (`oderID`, `productID`, `quantity`, `priceProduct`, `name`, `image`) VALUES
(71, 19, 3, '88000', 'Bún tươi', 'bunsoitrung.webp');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`ID`, `name`) VALUES
(1, 'sợi nhỏ'),
(2, 'sợi trung'),
(3, 'sợi lớn'),
(4, 'Sợi Nhuyễn'),
(5, 'Sợi To'),
(6, 'Không có');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `membercatogery`
--
ALTER TABLE `membercatogery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idmember` (`idmember`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `trademarkID` (`trademark`),
  ADD KEY `typeID` (`typeID`),
  ADD KEY `categoryId` (`catogeryID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `productoder`
--
ALTER TABLE `productoder`
  ADD KEY `oderID` (`oderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `membercatogery`
--
ALTER TABLE `membercatogery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membercatogery`
--
ALTER TABLE `membercatogery`
  ADD CONSTRAINT `membercatogery_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `member` (`ID`);

--
-- Constraints for table `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `oder_ibfk_1` FOREIGN KEY (`idmember`) REFERENCES `member` (`ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`typeID`) REFERENCES `producttype` (`ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`catogeryID`) REFERENCES `productcategory` (`id`);

--
-- Constraints for table `productoder`
--
ALTER TABLE `productoder`
  ADD CONSTRAINT `productoder_ibfk_1` FOREIGN KEY (`oderID`) REFERENCES `oder` (`ID`),
  ADD CONSTRAINT `productoder_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
