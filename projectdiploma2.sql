-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 05:56 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdiploma2`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `ExpensesID` int(10) NOT NULL,
  `VehicleID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Mileage` int(11) NOT NULL,
  `Cost` float NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Expense_Type_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`ExpensesID`, `VehicleID`, `UserID`, `Date`, `Mileage`, `Cost`, `Description`, `Expense_Type_ID`) VALUES
(28, 35, 32, '2024-12-01', 500, 40, 'Motul 3100 10W40', 1),
(31, 36, 29, '2024-12-24', 1000, 10, 'Original', 2),
(32, 36, 29, '2024-12-24', 1000, 40, 'Motul 3100 10W40', 1),
(33, 36, 29, '2025-01-08', 2000, 60, 'Diamond', 3),
(34, 36, 29, '2025-01-19', 3000, 20, 'Bulb pecah', 4),
(35, 36, 32, '2025-01-21', 4000, 60, 'Fully Synthetic', 1),
(37, 37, 35, '2024-12-14', 5000, 40, 'Motul 3100 10W40', 1),
(38, 37, 35, '2024-12-14', 5000, 10, 'Original', 2),
(39, 37, 35, '2024-12-05', 4500, 60, 'Corsa sport rain', 3),
(40, 37, 35, '2025-01-21', 8500, 40, 'Motul 3100 10W40', 1),
(41, 35, 32, '2025-01-08', 4500, 40, 'Motul 3100 10W40', 1),
(42, 35, 32, '2025-01-16', 8000, 40, 'Castrol 10W40 1 Botol', 1),
(43, 35, 32, '2025-01-09', 2000, 20, 'Depan', 10),
(44, 35, 32, '2025-01-06', 2800, 40, 'DIY Samurai', 6),
(45, 38, 29, '2025-01-09', 1000, 10, 'Ori Honda', 13),
(46, 38, 29, '2025-01-16', 2500, 60, 'YSS', 15);

-- --------------------------------------------------------

--
-- Table structure for table `expenses_type`
--

CREATE TABLE `expenses_type` (
  `Expense_Type_ID` int(10) NOT NULL,
  `Expenses_Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_type`
--

INSERT INTO `expenses_type` (`Expense_Type_ID`, `Expenses_Name`) VALUES
(1, 'Oil Change'),
(2, 'Oil Filter'),
(3, 'Tyre Change'),
(4, 'Bulb'),
(6, 'Wiper'),
(7, 'Air conditioning'),
(8, 'Air filter'),
(9, 'Battery'),
(10, 'Brake Pad'),
(11, 'Brake Fluid'),
(12, 'Exhause Change'),
(13, 'Fuel Filter'),
(14, 'Rotate Tires'),
(15, 'Suspension');

-- --------------------------------------------------------

--
-- Table structure for table `refueling`
--

CREATE TABLE `refueling` (
  `RefuelingID` int(10) NOT NULL,
  `VehicleID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Mileage` int(10) NOT NULL,
  `Refulieng_Cost` float NOT NULL,
  `priceperlitre` float NOT NULL,
  `Refueling_Amount` float NOT NULL,
  `Fuel_Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refueling`
--

INSERT INTO `refueling` (`RefuelingID`, `VehicleID`, `UserID`, `Date`, `Mileage`, `Refulieng_Cost`, `priceperlitre`, `Refueling_Amount`, `Fuel_Type`) VALUES
(4, 35, 32, '2025-01-01', 1500, 20, 2.15, 9.3, 'RON95'),
(5, 35, 32, '2025-01-04', 2000, 20, 2.15, 9.3, 'RON95'),
(6, 35, 32, '2025-01-07', 2500, 25, 2.15, 11.63, 'RON95'),
(7, 35, 32, '2025-01-10', 3100, 20, 2.15, 9.3, 'RON95'),
(8, 35, 32, '2025-01-13', 4000, 30, 2.15, 13.95, 'RON95'),
(9, 35, 32, '2025-01-17', 5200, 30, 2.15, 13.9535, 'RON95'),
(12, 36, 29, '2024-12-15', 1500, 5, 2.05, 2.44, 'RON95'),
(13, 36, 29, '2024-12-18', 1650, 5, 2.05, 2.44, 'RON95'),
(14, 36, 29, '2024-12-21', 1750, 9, 3, 3, 'RON97'),
(15, 37, 35, '2024-12-18', 5000, 5, 2.15, 2.33, 'RON95'),
(16, 37, 35, '2024-12-05', 5000, 5, 5, 1, 'RON95'),
(17, 38, 29, '2025-01-09', 2000, 5, 2.15, 2.33, 'RON95'),
(18, 38, 29, '2025-01-11', 2600, 6, 2.15, 2.79, 'RON95'),
(19, 38, 29, '2025-01-19', 3000, 6, 3.15, 1.9, 'RON97');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` int(11) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `SecurityAnswer1` varchar(250) NOT NULL,
  `SecurityAnswer2` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Name`, `Username`, `Password`, `Email`, `Phone`, `usertype`, `SecurityAnswer1`, `SecurityAnswer2`) VALUES
(29, 'Zikry Fahmi', 'Zikryfahmi', '$2y$10$opcnWMn1w5Zq9rS0iWOFyOzxxwMeGbjFnklaWO.iAWxZuopzpDA46', 'zikryfahmi@gmail.com', 18234421, 'user', 'cat', 'skpm'),
(31, 'admin', 'admin', '$2y$10$C2JTx9L8Pun/avhcPqr0tuzzDvEwrEQSheuSN4gEZTDbFF9P1ZUB2', 'admin@gmail.com', 99999, 'admin', 'cat', 'skpm'),
(32, 'Aniq Azfar Z', 'Aniqazfar', '$2y$10$dOgTbUpFKImsv4E90CZ4kuBWLAvNAHSb4QsnM0oFbOfVEc2yNw6ha', 'aniqazfar709@gmail.com', 182864221, 'user', 'cat', 'skpm'),
(33, 'Nauhfhal Fawwaz', 'Fawwaz123', '$2y$10$qdd06bY1fDlP44QWAVvU6uP3RRLgVb6/kxUzyZ3cK36uEOCRMRU3.', 'fawwaz123@gmail.com', 19233221, 'user', 'cat', 'skpm'),
(34, 'Thaqif Sinin', 'Thaqifsinin', '$2y$10$YROeephaeK5D.BXnPkaZkOI0AblQusJ/h3/2fUiT1DexeNZsZfNRO', 'thaqifsinin@gmail.com', 128322112, 'admin', 'cat', 'skpm'),
(35, 'Danish Aiman', 'Danishaiman', '$2y$10$miguYmBQJqt6TQl7NvUH1OLXGVvD0xOdsQOZMSEDMc.fjiJhm6Ufm', 'danishaiman@gmail.com', 127325212, 'user', 'cat', 'skpm'),
(36, 'Nabil Ilham', 'Nabililham', '$2y$10$jW8Sy8X2vJyrJyVvAcv1cuI/zCvHN3Jay/5YYpbVYX2Z0EGJ7r.4C', 'nabililham@gmail.com', 18233212, 'admin', 'cat', 'skpm');

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicle`
--

CREATE TABLE `user_vehicle` (
  `UserVehicleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `AccessPassword` varchar(200) NOT NULL,
  `AccessRole` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_vehicle`
--

INSERT INTO `user_vehicle` (`UserVehicleID`, `UserID`, `VehicleID`, `AccessPassword`, `AccessRole`) VALUES
(18, 32, 35, 'MCG9445', 'Owner'),
(22, 35, 37, 'JUP435', 'Owner'),
(23, 29, 38, 'JWE123', 'Owner'),
(24, 29, 35, 'MCG9445', 'Authorized');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VehicleID` int(10) NOT NULL,
  `Make` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `License_Plate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VehicleID`, `Make`, `Model`, `License_Plate`) VALUES
(35, 'Perodua', 'Viva', 'MCG9445'),
(37, 'Honda', 'RS150', 'JUP435'),
(38, 'Honda', 'Dash 125', 'JWE123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ExpensesID`);

--
-- Indexes for table `expenses_type`
--
ALTER TABLE `expenses_type`
  ADD PRIMARY KEY (`Expense_Type_ID`);

--
-- Indexes for table `refueling`
--
ALTER TABLE `refueling`
  ADD PRIMARY KEY (`RefuelingID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD PRIMARY KEY (`UserVehicleID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`VehicleID`),
  ADD UNIQUE KEY `License_Plate` (`License_Plate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `ExpensesID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `expenses_type`
--
ALTER TABLE `expenses_type`
  MODIFY `Expense_Type_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `refueling`
--
ALTER TABLE `refueling`
  MODIFY `RefuelingID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  MODIFY `UserVehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `VehicleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
