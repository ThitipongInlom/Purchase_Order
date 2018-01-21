-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2015 at 02:30 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zorin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbmonth`
--

CREATE TABLE IF NOT EXISTS `tbmonth` (
  `sRoomNo` varchar(8) DEFAULT NULL,
  `sExtnNo` varchar(8) DEFAULT NULL,
  `sResponse` varchar(1) DEFAULT NULL,
  `sTranType` varchar(2) DEFAULT NULL,
  `sTranDate` varchar(8) DEFAULT NULL,
  `sTranTime` varchar(6) DEFAULT NULL,
  `lDuration` int(11) DEFAULT NULL,
  `bTransfer` tinyint(1) DEFAULT NULL,
  `nSmartFilter` int(11) DEFAULT NULL,
  `sTelNo` varchar(20) DEFAULT NULL,
  `sAuthCode` varchar(7) DEFAULT NULL,
  `sAcctCode` varchar(15) DEFAULT NULL,
  `sTrunkNo` varchar(8) DEFAULT NULL,
  `fBCharge` float DEFAULT NULL,
  `fSCharge` float DEFAULT NULL,
  `fTax` float DEFAULT NULL,
  `fTotal` float DEFAULT NULL,
  `sDesc` varchar(30) DEFAULT NULL,
  `sChgExtnNo` varchar(8) DEFAULT NULL,
  `sIDCode` varchar(10) DEFAULT NULL,
  `sAccessCode` varchar(4) DEFAULT NULL,
  `sDayEndDateTime` datetime DEFAULT NULL,
  `nPulse` int(11) DEFAULT NULL,
  `nSurChargeCode` int(11) DEFAULT NULL,
  `fRatePerMin` float DEFAULT NULL,
  `nSerialNo` int(11) DEFAULT NULL,
  `sCallType` varchar(16) DEFAULT NULL,
  `sCallTime` varchar(8) DEFAULT NULL,
  `sCallDate` varchar(9) DEFAULT NULL,
  `sDuration` varchar(9) DEFAULT NULL,
  `sExtnType` varchar(1) DEFAULT NULL,
  `nPropertyNo` int(11) DEFAULT NULL,
  `sPropertyName` varchar(30) DEFAULT NULL,
  `nDivNo` int(11) DEFAULT NULL,
  `sDivName` varchar(30) DEFAULT NULL,
  `nDeptNo` int(11) DEFAULT NULL,
  `sDeptName` varchar(30) DEFAULT NULL,
  `nSectNo` int(11) DEFAULT NULL,
  `sSectName` varchar(30) DEFAULT NULL,
  `sExtnName` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbmonth`
--

INSERT INTO `tbmonth` (`sRoomNo`, `sExtnNo`, `sResponse`, `sTranType`, `sTranDate`, `sTranTime`, `lDuration`, `bTransfer`, `nSmartFilter`, `sTelNo`, `sAuthCode`, `sAcctCode`, `sTrunkNo`, `fBCharge`, `fSCharge`, `fTax`, `fTotal`, `sDesc`, `sChgExtnNo`, `sIDCode`, `sAccessCode`, `sDayEndDateTime`, `nPulse`, `nSurChargeCode`, `fRatePerMin`, `nSerialNo`, `sCallType`, `sCallTime`, `sCallDate`, `sDuration`, `sExtnType`, `nPropertyNo`, `sPropertyName`, `nDivNo`, `sDivName`, `nDeptNo`, `sDeptName`, `nSectNo`, `sSectName`, `sExtnName`) VALUES
('7367', '7367', '2', '2', '20151017', '151008', 29, 0, NULL, '90996717692         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 408, 'Local Call      ', '15:10:08', '17Oct2015', '00:00:29', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7804', '7804', '2', '2', '20151018', '122554', 111, 0, NULL, '90990316493         ', '0', '        ', '003    ', 3, 0, 0, 3, 'Local Call                    ', '7804    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 37, 'Local Call      ', '12:25:54', '18Oct2015', '00:01:51', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 29, 'Personal Office               ', 'Extn. 7804'),
('7367', '7367', '2', '2', '20151018', '163134', 14, 0, NULL, '90996717692         ', '0', '        ', '001    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 58, 'Local Call      ', '16:31:34', '18Oct2015', '00:00:14', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7673', '7673', '2', '2', '20151019', '083841', 32, 0, NULL, '90991245070         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7673    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 91, 'Local Call      ', '08:38:41', '19Oct2015', '00:00:32', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 26, 'Z Fitness                     ', 'Extn. 7673'),
('7673', '7673', '2', '2', '20151020', '072147', 72, 0, NULL, '90992468496         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7673    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 112, 'Local Call      ', '07:21:47', '20Oct2015', '00:01:12', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 26, 'Z Fitness                     ', 'Extn. 7673'),
('7367', '7367', '1', '2', '20151004', '161300', 28, 0, NULL, '90996717692      ', NULL, NULL, '001 ', 3, 0, 0, 3, 'Local Call', '7367', NULL, '0011', NULL, NULL, NULL, NULL, 10, 'Local Call', '16:13', '04Oct2015', '00:00:28', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 20, 'Function Room', 'Extn 7367'),
('7367', '7367', '1', '2', '20151006', '142600', 18, 0, NULL, '90996717692      ', NULL, NULL, '002 ', 3, 0, 0, 3, 'Local Call', '7367', NULL, '0011', NULL, NULL, NULL, NULL, 243, 'Local Call', '14:26', '06Oct2015', '00:00:18', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 20, 'Function Room', 'Extn 7367'),
('7367', '7367', '1', '2', '20151006', '142700', 48, 0, NULL, '90996717692      ', NULL, NULL, '003 ', 3, 0, 0, 3, 'Local Call', '7367', NULL, '0011', NULL, NULL, NULL, NULL, 244, 'Local Call', '14:27', '06Oct2015', '00:00:48', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 20, 'Function Room', 'Extn 7367'),
('7803  ', '7803', '1', '2', '20151008', '083400', 382, 0, NULL, '90990343151      ', NULL, NULL, '003 ', 3, 0, 0, 3, 'Local Call', '7803', NULL, '0011', NULL, NULL, NULL, NULL, 457, 'Local Call', '08:34', '08Oct2015', '00:06:22', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 29, 'Personal Office', 'Extn. 7803  '),
('7804  ', '7804', '1', '2', '20151008', '101100', 49, 0, NULL, '90989732473      ', NULL, NULL, '003 ', 3, 0, 0, 3, 'Local Call', '7804', NULL, '0011', NULL, NULL, NULL, NULL, 504, 'Local Call', '10:11', '08Oct2015', '00:00:49', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 29, 'Personal Office', 'Extn. 7804  '),
('7120  ', '7120', '1', '2', '20151009', '132400', 39, 0, NULL, '90992478474      ', NULL, NULL, '003 ', 3, 0, 0, 3, 'Local Call', '7120', NULL, '0011', NULL, NULL, NULL, NULL, 93, 'Local Call', '13:24', '09Oct2015', '00:00:39', 'A', 1, 'The Zign Hotel', 1, 'Admin', 1, 'Admin', 27, 'HK', 'Extn. 7120  '),
('7367', '7367', '2', '2', '20151022', '102153', 6, 0, NULL, '90996717692         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 232, 'Local Call      ', '10:21:53', '22Oct2015', '00:00:06', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151022', '120314', 52, 0, NULL, '90996717692         ', '0', '        ', '003    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 274, 'Local Call      ', '12:03:14', '22Oct2015', '00:00:52', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151023', '094532', 16, 0, NULL, '90996717692         ', '0', '        ', '001    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 103, 'Local Call      ', '09:45:32', '23Oct2015', '00:00:16', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151023', '094625', 9, 0, NULL, '90996717692         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 104, 'Local Call      ', '09:46:25', '23Oct2015', '00:00:09', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151023', '163538', 70, 0, NULL, '9099671769          ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 209, 'Local Call      ', '16:35:38', '23Oct2015', '00:01:10', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151024', '154457', 22, 0, NULL, '90996717692         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 38, 'Local Call      ', '15:44:57', '24Oct2015', '00:00:22', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151024', '154550', 33, 0, NULL, '90996717692         ', '0', '        ', '001    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 40, 'Local Call      ', '15:45:50', '24Oct2015', '00:00:33', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151026', '122001', 42, 0, NULL, '90996717692         ', '0', '        ', '001    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 201, 'Local Call      ', '12:20:01', '26Oct2015', '00:00:42', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7367', '7367', '2', '2', '20151028', '123825', 17, 0, NULL, '90996717692         ', '0', '        ', '002    ', 3, 0, 0, 3, 'Local Call                    ', '7367    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 441, 'Local Call      ', '12:38:25', '28Oct2015', '00:00:17', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 20, 'Function Room                 ', 'Extn 7367'),
('7803', '7803', '2', '2', '20151030', '093045', 141, 0, NULL, '91506               ', '0', '        ', '001    ', 3, 0, 0, 3, 'Local Call                    ', '7803    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 638, 'Local Call      ', '09:30:45', '30Oct2015', '00:02:21', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 29, 'Personal Office               ', 'Extn. 7803'),
('7802', '7802', '2', '2', '20151031', '162226', 399, 0, NULL, '91506               ', '0', '        ', '003    ', 3, 0, 0, 3, 'Local Call                    ', '7802    ', ' ', '    ', '2015-07-16 21:42:01', 0, 1, 3, 854, 'Local Call      ', '16:22:26', '31Oct2015', '00:06:39', 'A', 1, 'The Zign Hotel                ', 1, 'Admin', 1, 'Admin                         ', 29, 'Personal Office               ', 'Extn. 7802');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbmonth`
--
ALTER TABLE `tbmonth`
  ADD KEY `sExtnNo` (`sExtnNo`),
  ADD KEY `sRoomNo` (`sRoomNo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
