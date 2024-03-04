-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 07:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crflm`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrival`
--

CREATE TABLE `arrival` (
  `ar_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `cr_id` int(11) NOT NULL,
  `arrive` datetime NOT NULL,
  `startwork` datetime NOT NULL,
  `leave` datetime NOT NULL,
  `bag_id` int(11) NOT NULL,
  `ret_kaset_id` int(11) NOT NULL,
  `kaset_id` int(11) NOT NULL,
  `bilicount_start` int(11) NOT NULL,
  `bilicount_end` int(11) NOT NULL,
  `ret_bag_id` int(11) NOT NULL,
  `suspend` int(11) NOT NULL,
  `suspend_reason` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `atm_id` int(11) NOT NULL,
  `customer` varchar(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kanwil` varchar(50) NOT NULL,
  `film_vendor` varchar(50) NOT NULL,
  `install_date` date NOT NULL,
  `warranty_start` date NOT NULL,
  `warranty_end` date NOT NULL,
  `warranty_id` int(11) NOT NULL,
  `contarct_id` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lon` varchar(100) NOT NULL,
  `pic_id` varchar(10) NOT NULL,
  `service_hour_start` time NOT NULL,
  `service_hour_end` time NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guard_key`
--

CREATE TABLE `guard_key` (
  `gk_id` int(11) NOT NULL,
  `guard_id` int(11) NOT NULL,
  `key_owner` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `atm_id` varchar(20) NOT NULL,
  `take_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `load_bag`
--

CREATE TABLE `load_bag` (
  `ib_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `cpc_id` int(11) NOT NULL,
  `bag_id` int(11) NOT NULL,
  `ret_bag_id` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `load_kaset`
--

CREATE TABLE `load_kaset` (
  `lk_id` int(11) NOT NULL,
  `sc-Id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `cpc_id` int(11) NOT NULL,
  `kaset_id` int(11) NOT NULL,
  `denom` int(11) NOT NULL,
  `qyt` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE `pickup` (
  `pu_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `cr_id` varchar(10) NOT NULL,
  `bag_id` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pic_atm`
--

CREATE TABLE `pic_atm` (
  `id` int(11) NOT NULL,
  `ar_id` int(11) NOT NULL,
  `pic_atm_admin` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pic_bilicount`
--

CREATE TABLE `pic_bilicount` (
  `id` int(11) NOT NULL,
  `ar_id` int(11) NOT NULL,
  `pic_bilicount_start` int(11) NOT NULL,
  `pic_bilicount_end` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pic_kaset`
--

CREATE TABLE `pic_kaset` (
  `id` int(11) NOT NULL,
  `ar_id` int(11) NOT NULL,
  `pic_kaset` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pic_key_return`
--

CREATE TABLE `pic_key_return` (
  `id` int(11) NOT NULL,
  `gk_id` int(11) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `pic_return` int(10) NOT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pic_key_take`
--

CREATE TABLE `pic_key_take` (
  `id` int(11) NOT NULL,
  `gk_id` int(11) NOT NULL,
  `guard_id` int(11) NOT NULL,
  `pic_take` int(11) NOT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `rc_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `cpc_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `denom` bigint(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` bigint(18) NOT NULL,
  `cit_denom` bigint(18) NOT NULL,
  `cit_qty` bigint(18) NOT NULL,
  `cit_total` bigint(18) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `regional`
--

CREATE TABLE `regional` (
  `regional_id` int(11) NOT NULL,
  `regional` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `user_create` varchar(15) NOT NULL,
  `change_date` date NOT NULL,
  `user_change` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regional`
--

INSERT INTO `regional` (`regional_id`, `regional`, `create_date`, `user_create`, `change_date`, `user_change`) VALUES
(1, 'JAKARTA', '2020-08-19', 'Budi Susanto', '0000-00-00', ''),
(2, 'BANDUNG', '2020-08-19', 'Budi Susanto', '0000-00-00', ''),
(3, 'JOGJAKARTA', '2020-08-19', 'Budi Susanto', '0000-00-00', ''),
(4, 'BEKASI1', '2020-08-19', 'Budi Susanto', '2020-08-19', 'ADMIN'),
(5, 'DENPASAR', '2020-08-19', 'Budi Susanto', '0000-00-00', ''),
(6, 'BINTARO', '2020-08-19', 'ADMIN', '2020-08-19', 'ADMIN'),
(7, 'TANGGERANG1', '2020-08-19', 'ADMIN', '2020-08-19', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `regional` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_pengisian` date NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`req_id`, `user_id`, `regional`, `nominal`, `tanggal_pengisian`, `create_date`) VALUES
(2, 'ADMIN', 0, 100000000, '2020-08-18', '2020-08-18'),
(3, 'ADMIN', 0, 2147483647, '2020-08-21', '2020-08-21'),
(4, 'ADMIN', 0, 2147483647, '2020-08-21', '2020-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `r_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `cpc_id` varchar(10) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_bag`
--

CREATE TABLE `return_bag` (
  `rk_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `bag_id` date NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_kaset`
--

CREATE TABLE `return_kaset` (
  `rk_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `kaset_id` int(11) NOT NULL,
  `denom` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sc_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `atm_id` varchar(10) NOT NULL,
  `user_create` varchar(10) NOT NULL,
  `denom` int(11) NOT NULL,
  `qty` bigint(22) NOT NULL,
  `total` bigint(18) NOT NULL,
  `create_date` date NOT NULL,
  `cpc_id` varchar(10) NOT NULL,
  `guard_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `assign_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `create_date` date NOT NULL,
  `user_create` varchar(15) NOT NULL,
  `user_change` varchar(15) NOT NULL,
  `change_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `regional_id`, `sector`, `create_date`, `user_create`, `user_change`, `change_date`) VALUES
(1, 1, 'JAKARTA BARAT', '2020-08-19', 'ADMIN', 'ADMIN', '2020-08-19'),
(2, 2, 'BANDUNG BARAT', '2020-08-19', 'ADMIN', '', '0000-00-00'),
(3, 1, 'JAKARTA TIMUR', '2020-08-19', 'ADMIN', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `regional_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` date NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_level` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` date NOT NULL,
  `change_date` varchar(15) NOT NULL,
  `user_change` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `telp`, `regional_id`, `sector_id`, `username`, `password`, `email`, `join_date`, `user_type`, `user_level`, `lat`, `lon`, `status`, `create_date`, `change_date`, `user_change`) VALUES
('ADMIN', 'BUDI SUSANTO', '081281168635', 1, 3, 'BUDI SUSANTO', '1', 'Budisusanto40bs@gmail.com', '2020-08-03', 2, 1, '1', '1', 1, '0000-00-00', '2020-08-21', 'ADMIN'),
('Kudil', 'NURFADILAH', '0898876663', 2, 2, 'NURFADILAH', '123456', 'kudil@gmail.com', '2020-08-21', 3, 7, '', '', 1, '2020-08-21', '', ''),
('yyy', 'NANA', '098888', 2, 2, 'NANA', '52', '1234', '2020-08-21', 1, 8, '', '', 0, '2020-08-21', '2020-08-21', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `ul_id` int(11) NOT NULL,
  `level_varchar` varchar(30) NOT NULL,
  `create_date` date NOT NULL,
  `user_create` varchar(15) NOT NULL,
  `user_change` varchar(15) NOT NULL,
  `change_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`ul_id`, `level_varchar`, `create_date`, `user_create`, `user_change`, `change_date`) VALUES
(1, 'Admin', '2020-08-19', '', '', '0000-00-00'),
(2, 'Super Admin', '2020-08-19', '', '', '0000-00-00'),
(3, 'Sceduler', '2020-08-19', '', '', '0000-00-00'),
(4, 'CPC1', '2020-08-19', '', '', '0000-00-00'),
(5, 'Security', '2020-08-19', '', 'ADMIN', '2020-08-19'),
(6, 'CR', '2020-08-19', '', 'ADMIN', '2020-08-19'),
(7, 'CPC2', '2020-08-19', 'ADMIN', '', '0000-00-00'),
(8, 'Kuncen', '2020-08-19', 'ADMIN', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `up_id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ut_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `create_date` date NOT NULL,
  `user_create` varchar(15) NOT NULL,
  `user_change` varchar(15) NOT NULL,
  `change_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ut_id`, `type`, `create_date`, `user_create`, `user_change`, `change_date`) VALUES
(1, 'Admin', '2020-08-19', '', 'ADMIN', '2020-08-19'),
(2, 'Super Admin', '2020-08-19', 'ADMIN', '', '0000-00-00'),
(3, 'PEGAWAI', '2020-08-19', 'ADMIN', 'ADMIN', '2020-08-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrival`
--
ALTER TABLE `arrival`
  ADD PRIMARY KEY (`ar_id`);

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`atm_id`);

--
-- Indexes for table `guard_key`
--
ALTER TABLE `guard_key`
  ADD PRIMARY KEY (`gk_id`);

--
-- Indexes for table `load_bag`
--
ALTER TABLE `load_bag`
  ADD PRIMARY KEY (`ib_id`);

--
-- Indexes for table `load_kaset`
--
ALTER TABLE `load_kaset`
  ADD PRIMARY KEY (`lk_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`pu_id`);

--
-- Indexes for table `pic_atm`
--
ALTER TABLE `pic_atm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic_bilicount`
--
ALTER TABLE `pic_bilicount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic_kaset`
--
ALTER TABLE `pic_kaset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`rc_id`);

--
-- Indexes for table `regional`
--
ALTER TABLE `regional`
  ADD PRIMARY KEY (`regional_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `return_bag`
--
ALTER TABLE `return_bag`
  ADD PRIMARY KEY (`rk_id`);

--
-- Indexes for table `return_kaset`
--
ALTER TABLE `return_kaset`
  ADD PRIMARY KEY (`rk_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`ul_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`up_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ut_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regional`
--
ALTER TABLE `regional`
  MODIFY `regional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `ul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
