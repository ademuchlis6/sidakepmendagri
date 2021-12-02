-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 10:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidakepmendagri`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `username`) VALUES
('vf6jnkmd3k14df1ho5ihgcmcj19n9nna', '::1', 1611739510, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631313733393237383b6964656e746974797c733a32373a226b656d656e6461677269406b656d656e64616772692e676f2e6964223b757365726e616d657c733a31303a226b656d656e6461677269223b656d61696c7c733a32373a226b656d656e6461677269406b656d656e64616772692e676f2e6964223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363131373339303133223b736573757365726e616d657c733a31303a226b656d656e6461677269223b7365736c6f6b6173697c733a313a2231223b616364656c7c623a303b, 'kemendagri');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'kemendagri', 'kemendagri'),
(2, 'ditjen', 'ditjen');

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id_lembaga` int(11) NOT NULL,
  `nama_lembaga` varchar(100) DEFAULT NULL,
  `nama_kepala` varchar(100) DEFAULT NULL,
  `status_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `nama_kepala`, `status_lembaga`) VALUES
(1, 'SEKRETARIAT JENDRAL', 'KEPALA 1', 1),
(2, 'INSPEKTORAT JENDRAL', 'KEPALA 1', 1),
(3, 'DITJEN POLITIK DAN PEMERINTAHAN UMUM', 'KEPALA 1', 1),
(4, 'DITJEN BINA ADMINISTRASI KEWILAYAHAN', 'KEPALA 1', 1),
(5, 'DITJEN OTONOMI DAERAH', 'KEPALA 1', 1),
(6, 'DITJEN BINA PEMBANGUNAN DAERAH', 'KEPALA 1', 1),
(7, 'DITJEN BINA PEMERINTAHAN DESA', 'KEPALA 1', 1),
(8, 'DITJEN BINA KEUANGAN DAERAH', 'KEPALA 1', 1),
(9, 'DITJEN KEPENDUDUKAN DAN PENCATATAN SIPIL', 'KEPALA 1', 1),
(10, 'BADAN PENELITIAN DAN PENGEMBANGAN', 'KEPALA 1', 1),
(11, 'BADAN PENGEMBANGAN SDM', 'KEPALA 1', 1),
(12, 'STAF KHUSUS MENTERI', 'KEPALA 1', 1),
(13, 'STAF AHLI MENTERI', 'KEPALA 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(22, 0x3a3a31, 'sads', 1611658090),
(23, 0x3a3a31, 'sa', 1611658141),
(26, 0x3132372e302e302e31, '55555555', 1611687431),
(27, 0x3132372e302e302e31, '55555555', 1611687437);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `id_seksi` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `nama_kepala` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seksi`
--

INSERT INTO `seksi` (`id_seksi`, `keterangan`, `nama_kepala`, `status`) VALUES
(1, 'Seksi A', 'Kepala 1', 1),
(2, 'Seksi B', NULL, 1),
(3, 'Seksi C', NULL, 1),
(4, 'Seksi D', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subdirektorat`
--

CREATE TABLE `subdirektorat` (
  `id_sub` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `nama_kepala` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subdirektorat`
--

INSERT INTO `subdirektorat` (`id_sub`, `keterangan`, `status`, `nama_kepala`) VALUES
(1, 'Sub A', 1, NULL),
(2, 'Sub B', 1, NULL),
(3, 'Sub C', 1, NULL),
(4, 'Sub D', 1, 'ADE');

-- --------------------------------------------------------

--
-- Table structure for table `tingkat`
--

CREATE TABLE `tingkat` (
  `id_tingkat` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tingkat`
--

INSERT INTO `tingkat` (`id_tingkat`, `keterangan`, `status`) VALUES
(1, 'Direktorat (eselon 2)', 1),
(2, 'Sub Direktorat/Bagian (eselon 3)', 1),
(3, 'Seksi/Sub Bagian (Eselon 4)', 1),
(4, 'Staf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `tingkat` int(11) DEFAULT NULL,
  `lembaga` int(11) DEFAULT NULL,
  `subdirektorat` int(11) DEFAULT NULL,
  `seksi` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `nama_pegawai`, `nip`, `tingkat`, `lembaga`, `subdirektorat`, `seksi`, `phone`) VALUES
(1, 0x3a3a31, 'kemendagri', '$2y$08$M0mKAwdVaNJb9VLpKS/bEORYV0i/vvwTFMH/8userOVkXNpdfNwrq', '', 'kemendagri@kemendagri.go.id', NULL, NULL, NULL, NULL, 1584069727, 1611739293, 1, 'nama 1', 12345, 0, 0, NULL, NULL, '0'),
(1044, 0x3a3a31, '198503302003121003', '$2y$08$dxArOVpkMHabcWQX2F/d3.xi6iCS3MWYfw8aoW78WD6AGjMz.cYl.', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738148, 1611738148, 1, 'MAULANA', NULL, 2, 1, 1, NULL, '082299222900'),
(1045, 0x3a3a31, '198503302003121004', '$2y$08$MiXEHupkqNComfoYtP4v6.UxUduPqxuBQrUm205Lz1/.GrvKZZmf2', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738170, 1611738170, 1, 'ANWAR', NULL, 2, 1, 2, NULL, '082299222900'),
(1046, 0x3a3a31, '198503302003121005', '$2y$08$MBYWR5f8ggJdPskAgP.r1u3mjpQevy9rSRZew1kb7ZeD0A5c.B38W', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738198, 1611738198, 1, 'CINTA', NULL, 3, 1, 1, 1, '082299222900'),
(1047, 0x3a3a31, '198503302003121006', '$2y$08$vRjBcGRyAY5grUFZyutImOYXd6GJK1RlG35.fdBaguRARUSM4icnG', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738224, 1611738224, 1, 'PUSPITA', NULL, 3, 1, 4, 3, '082299222900'),
(1048, 0x3a3a31, '198503302003121007', '$2y$08$cavU8ifG40dIwAQmVh9b3ODWJjfGXThFPVVdMMK75GHwfr0lHyNgO', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738259, 1611738259, 1, 'RUDIYANTI', NULL, 4, 1, 3, 3, '082299222900'),
(1049, 0x3a3a31, '198503302003121008', '$2y$08$eNxoz7typqHL8JIsHKnL5OwHRRJodqp/XRmUqwptELo/wJ1s2XLOC', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611738310, 1611738310, 1, 'RUDI', NULL, 4, 1, 1, 2, '082299222900'),
(1051, 0x3a3a31, '198503302003121002', '$2y$08$lkfqdUxJc6U36e7DMOqTTO.uOSo5dekzANWOrgiVf6Xvi4k9n6c56', '', 'ades.muchlis@gmail.com', NULL, NULL, NULL, NULL, 1611739088, 1611739117, 1, 'ADE', NULL, 1, 1, NULL, NULL, '082299222900');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id_lembaga`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id_seksi`) USING BTREE;

--
-- Indexes for table `subdirektorat`
--
ALTER TABLE `subdirektorat`
  ADD PRIMARY KEY (`id_sub`) USING BTREE;

--
-- Indexes for table `tingkat`
--
ALTER TABLE `tingkat`
  ADD PRIMARY KEY (`id_tingkat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id_seksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subdirektorat`
--
ALTER TABLE `subdirektorat`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tingkat`
--
ALTER TABLE `tingkat`
  MODIFY `id_tingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1053;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
