-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2015 at 05:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rhc_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `benchessinksdb`
--

CREATE TABLE IF NOT EXISTS `benchessinksdb` (
  `RHCs` int(11) NOT NULL DEFAULT '0',
  `ProductName` varchar(255) NOT NULL DEFAULT ' ',
  `Category` varchar(255) NOT NULL DEFAULT '0',
  `Height` int(11) NOT NULL DEFAULT '0',
  `Width` int(11) NOT NULL DEFAULT '0',
  `Depth` int(11) NOT NULL DEFAULT '0',
  `Price` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Comments` varchar(255) NOT NULL DEFAULT ' ',
  `Sold` bit(1) NOT NULL DEFAULT b'0',
  `Quantity` int(11) NOT NULL DEFAULT '1',
  `Curlew Ref` varchar(255) NOT NULL DEFAULT '0',
  `TableinFeet` decimal(5,1) NOT NULL DEFAULT '0.0',
  `VATPrice` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Line1` varchar(255) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`RHCs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `benchessinksdb`
--

INSERT INTO `benchessinksdb` (`RHCs`, `ProductName`, `Category`, `Height`, `Width`, `Depth`, `Price`, `Comments`, `Sold`, `Quantity`, `Curlew Ref`, `TableinFeet`, `VATPrice`, `Line1`) VALUES
(0, '', '0', 0, 2500, 0, '0.00', '', b'0', 0, '', '0.0', '0.00', ''),
(1, '7ft Stainless Steel Double Sink with Drainer', '0', 650, 920, 890, '295.00', '', b'1', 0, '', '3.1', '354.00', ''),
(2, '5ft Stainless Steel Worktop with 2 Shelves', 'Worktops', 870, 1600, 760, '150.00', '1200mm front length', b'0', 0, '', '5.3', '180.00', ''),
(3, '6½ ft Stainless Steel Worktop', 'Worktops', 880, 1950, 700, '125.00', 'Legs can be painted', b'0', 0, '', '6.4', '150.00', ''),
(4, '3ft Stainless Steel Worktop', 'Worktops', 840, 920, 610, '70.00', '', b'0', 0, '', '3.1', '84.00', ''),
(5, '6½ ft Parry Stainless Steel Worktop', 'Worktops', 950, 2000, 700, '150.00', '', b'0', 0, '', '6.6', '180.00', ''),
(6, '6ft Stainless Steel Worktop', 'Worktops', 830, 1830, 660, '135.00', '', b'0', 0, '', '6.1', '162.00', ''),
(7, '4½ ft Curved Stainless Steel Worktop', 'Worktops', 810, 1320, 830, '75.00', '600mm front length', b'0', 0, '', '4.4', '90.00', ''),
(8, '4½ ft Wedged Stainless Steel Worktop', 'Worktops', 810, 1310, 680, '90.00', '910mm front length', b'0', 0, '', '4.3', '108.00', ''),
(9, '4ft Stainless Steel Worktop', 'Worktops', 890, 1170, 610, '80.00', '', b'0', 0, '', '3.9', '96.00', ''),
(10, '3¼ ft Stainless Steel Worktop', '0', 920, 990, 600, '70.00', '', b'0', 0, '', '3.2', '84.00', ''),
(11, '10ft Stainless Steel Worktop with 2 Shelves', 'Worktops', 840, 3050, 870, '210.00', '', b'0', 0, '', '10.1', '252.00', ''),
(12, '4ft Stainless Steel Worktop with Drawer', 'Worktops', 860, 1120, 640, '95.00', '', b'0', 0, '', '3.7', '114.00', ''),
(13, '4ft Stainless Steel Table', 'Worktops', 880, 1220, 650, '90.00', '', b'0', 0, '', '4.1', '108.00', ''),
(14, '5ft Stainless Steel Worktop with Drawer', 'Worktops', 840, 1520, 600, '100.00', '', b'0', 0, '', '5.0', '120.00', ''),
(15, '3½ ft Stain-less Steel Worktop', 'Worktops', 840, 1000, 520, '75.00', '', b'0', 0, '', '3.3', '90.00', ''),
(17, '4ft Stainless Steel Cupboard', 'Worktops', 900, 1225, 610, '110.00', '', b'0', 0, '', '4.1', '132.00', ''),
(18, '3½ ft Stainless Steel Double Sink', '0', 910, 1000, 600, '150.00', '', b'1', 0, '', '3.3', '180.00', ''),
(21, '3½ ft Stainless Steel Servery Top', 'Worktops', 880, 1000, 600, '150.00', '1200mm back height', b'0', 0, '', '3.3', '180.00', ''),
(22, '6ft Stainless Steel Table', 'Worktops', 860, 1830, 765, '150.00', '', b'0', 0, '', '6.1', '180.00', ''),
(24, '2½ ft Baking Tray Trolley', 'Worktops', 770, 800, 530, '65.00', '', b'0', 0, '', '2.7', '78.00', ''),
(25, '4¼ Stainless Steel Worktop', '0', 890, 1270, 620, '95.00', '', b'1', 0, '', '4.2', '114.00', ''),
(26, '5½ ft Stainless Steel Worktop', 'Worktops', 910, 1680, 635, '150.00', '385mm side depth', b'0', 0, '', '5.6', '180.00', ''),
(31, '6½ ft Stainless Steel Double+Single Sink with Hose', 'Sinks', 915, 2000, 620, '450.00', '', b'0', 0, '', '6.6', '540.00', ''),
(32, '5½ ft Stainless Steel Table', 'Worktops', 880, 1605, 650, '145.00', '', b'0', 0, '', '5.3', '174.00', ''),
(34, '8ft Stainless Steel Double Sink with Drainer', 'Sinks', 980, 2430, 620, '350.00', '', b'0', 0, '', '8.0', '420.00', ''),
(36, '6½ft Stainless Steel Double Sink with Drainer', 'Sinks', 1030, 2030, 540, '350.00', '', b'0', 0, '', '6.7', '420.00', ''),
(37, '8¼ft Stainless Steel Double Sink with Drainer', 'Sinks', 950, 2510, 610, '325.00', '', b'0', 0, '', '8.3', '390.00', ''),
(38, '9½ ft Stainless Steel Double Sink', 'Sinks', 910, 2880, 610, '325.00', '', b'0', 0, '', '9.5', '390.00', ''),
(40, '6ft Stainless Steel Cupboard', 'Worktops', 930, 1800, 700, '195.00', '', b'0', 0, '', '6.0', '234.00', ''),
(42, '4ft bench (x2)', 'Worktops', 900, 1200, 700, '125.00', '', b'0', 0, '', '4.0', '150.00', ''),
(45, '5½ ft Stainless-Steel Worktop', 'Worktops', 900, 1680, 600, '165.00', '', b'0', 0, '', '5.6', '198.00', ''),
(46, '5 ft Single sink', '0', 900, 1500, 650, '250.00', '', b'0', 0, '', '4.9', '300.00', ''),
(47, '5 ft Stainless steel Single sink', '0', 900, 1500, 650, '250.00', '', b'0', 0, '', '4.9', '300.00', ''),
(50, '6ft Stainless-Steel Worktop', 'Worktops', 870, 1840, 760, '150.00', '', b'0', 0, '', '6.1', '180.00', ''),
(55, '4½ ft steel tables', '0', 940, 1400, 610, '145.00', '', b'1', 0, '', '4.6', '174.00', ''),
(56, '4ft table', 'Worktops', 960, 1260, 640, '125.00', '', b'0', 0, '', '4.2', '150.00', ''),
(59, '6½ ft steel table', '0', 940, 2000, 650, '175.00', '', b'1', 0, '', '6.6', '210.00', ''),
(60, '5½ ft steel table', 'Worktops', 960, 1700, 700, '150.00', '', b'0', 0, '', '5.6', '180.00', ''),
(61, '5ft double sink', '0', 950, 1500, 650, '295.00', '', b'0', 0, '', '4.9', '354.00', ''),
(63, '6ft Stainless-Steel Table', 'Worktops', 920, 1800, 600, '150.00', '', b'0', 0, '', '6.0', '180.00', ''),
(68, '4ft Steel Table', 'Worktops', 900, 1200, 600, '150.00', '', b'0', 0, '', '4.0', '180.00', ''),
(70, '4ft Stainless Table with Gantry', '0', 1300, 1200, 600, '175.00', '', b'0', 0, '', '3.9', '210.00', ''),
(71, '4ft Steel Worktop', '0', 840, 1170, 610, '150.00', '', b'1', 0, '', '3.8', '180.00', ''),
(72, '6ft Workbench', 'Worktops', 880, 1800, 600, '150.00', '', b'0', 0, '', '6.0', '180.00', ''),
(73, 'Double Sink 8ft', 'Sinks', 900, 2400, 700, '375.00', '', b'0', 0, '', '7.9', '450.00', ''),
(75, '4ft table with shelf', '0', 880, 1200, 780, '125.00', '', b'1', 0, '', '3.9', '150.00', ''),
(76, '2.6ft Table with Shelf', 'Worktops', 780, 800, 350, '75.00', '', b'0', 0, '', '2.7', '90.00', ''),
(89, 'Six and a half ft Steel Bench', '0', 940, 2000, 700, '175.00', '', b'1', 0, '', '6.6', '210.00', ''),
(90, 'Four and a half ft Bench', '0', 900, 1300, 650, '155.00', '', b'1', 0, '', '4.3', '186.00', ''),
(91, 'Six Foot Bench With lower shelf', '0', 860, 180, 600, '175.00', '', b'1', 2, '', '0.6', '210.00', ''),
(92, 'RHCS91', '0', 0, 0, 0, '0.00', '', b'1', 0, '', '0.0', '0.00', ''),
(93, 'Three and 3/4 foot bench', 'Worktops', 910, 1140, 600, '150.00', '', b'0', 0, '', '3.8', '180.00', ''),
(94, 'Five foot stainless table with low shelf', '0', 900, 1500, 600, '165.00', '', b'1', 0, '', '4.9', '198.00', ''),
(95, 'Three Quarter foot stainless side table', '0', 990, 250, 695, '55.00', '', b'1', 0, '', '0.9', '66.00', ''),
(96, 'One and a Quarter foot side table', 'Worktops', 880, 400, 400, '75.00', '', b'0', 0, '', '1.4', '90.00', ''),
(97, 'Two Foot small stainless table', '0', 900, 600, 700, '95.00', '', b'1', 0, '', '2.0', '114.00', ''),
(98, 'Two and a 1/4 ft stainless bench', '0', 950, 1000, 700, '110.00', '', b'1', 0, '', '3.3', '132.00', ''),
(99, '3 ft Stainless table with lower storage shelf', 'Worktops', 780, 900, 600, '125.00', '', b'0', 0, '', '3.0', '150.00', ''),
(100, 'Four ft stainless table with bottom shelf for storage', '0', 950, 1200, 600, '145.00', '', b'1', 0, '', '4.0', '174.00', ''),
(101, 'Two and a 1/4 Stainless diagonal table', 'Worktops', 930, 700, 780, '75.00', '', b'0', 0, '', '2.3', '90.00', ''),
(102, '4.5 foot stainless steel workbench with lower shelf', '0', 950, 1400, 650, '160.00', '', b'1', 0, '', '4.6', '192.00', ''),
(103, '5 ft workbench stainless steel with no lower shelf', 'Worktops', 1000, 1500, 600, '150.00', '', b'0', 0, '', '5.0', '180.00', ''),
(104, '4 ft stainless steel sink with lower shelf', '0', 950, 1200, 650, '295.00', '', b'1', 0, '86FD2EDA2B4C', '3.9', '354.00', ''),
(105, 'One foot stainless side bench with lower shelf', '0', 920, 300, 960, '95.00', '', b'1', 0, '', '1.0', '114.00', ''),
(106, '3.75 foot long sink with lower storage shelf', 'Sinks', 1180, 1150, 700, '250.00', '', b'0', 0, '9DC8214D71FC', '3.8', '300.00', ''),
(107, '7 foot long double sink with under sink storage shelf', 'Sinks', 1040, 2200, 650, '375.00', '', b'0', 0, '1213E9DF6A78', '7.3', '450.00', ''),
(108, '2 and 1/4 Stainless Basin with wheels', 'Sinks', 870, 670, 530, '110.00', '', b'0', 0, '092A0D24A490', '2.2', '132.00', ''),
(109, '4.5 foot long stainless workbench with lower shelf unit', 'Worktops', 900, 140, 650, '150.00', '', b'0', 0, '', '0.5', '180.00', ''),
(111, 'Corner Sink (to do full dimensions)', 'Sinks', 940, 1850, 1340, '395.00', '', b'0', 0, '', '6.1', '474.00', ''),
(112, '1.7ft Stainless steel workbench', '0', 900, 510, 850, '0.00', '', b'1', 0, '', '1.7', '0.00', ''),
(113, '**113', '0', 1020, 1330, 660, '0.00', '', b'0', 0, '', '4.4', '0.00', ''),
(114, 'Two tier stainless workbench with bottom shelf', 'Worktops', 900, 1320, 660, '195.00', 'lower shelf height: 700mm', b'0', 0, '', '4.4', '234.00', ''),
(115, 'Stainless long draining board sink', 'Sinks', 900, 1800, 660, '325.00', '', b'0', 0, '', '6.0', '390.00', ''),
(116, 'Six Foot Worktop', 'Worktops', 880, 1800, 680, '195.00', ' ', b'0', 2, '0', '6.0', '0.00', ' '),
(117, '2.3ft Steel Table', 'Worktops', 900, 700, 780, '110.00', ' ', b'0', 1, '0', '2.3', '0.00', ' With undercounter drawer'),
(118, '6ft double sink with shelf top', 'Sinks', 1400, 1780, 650, '375.00', ' ', b'0', 1, '0', '5.9', '0.00', 'Worktop height: 880'),
(119, '7ft double sink', '0', 950, 600, 2100, '0.00', 'NEEDS PICTURES', b'0', 1, '0', '2.0', '0.00', 'With undercounter drawer'),
(120, 'Side tap stainless sink with ridged draining', '0', 900, 1800, 660, '275.00', '', b'1', 0, '', '6.0', '330.00', ''),
(121, ' 4.5 Ft Long Double Sink with Drainers', 'Sinks', 950, 1350, 650, '275.00', ' ', b'0', 1, '0', '4.5', '0.00', 'With Under sink storage area'),
(122, '3.3 Ft Single Sink with draining board', 'Sinks', 960, 1000, 600, '195.00', ' ', b'0', 1, '0', '3.3', '0.00', ' '),
(123, '10.7ft Stainless bench with 3-pin plug socket', 'Worktops', 1010, 3240, 600, '395.00', ' ', b'0', 1, '0', '10.7', '0.00', ' '),
(221, '7.6 Foot Souble sink with single tap and under sink storage', 'Sinks', 950, 2300, 700, '350.00', ' ', b'0', 1, '0', '7.6', '0.00', ' '),
(222, 'Stainless 2.7 Foot Prep Table', 'Worktops', 900, 800, 650, '100.00', ' ', b'0', 1, '0', '2.7', '0.00', ' '),
(223, 'Stainless 4ft single sink with ridged draining area', 'Sinks', 950, 1200, 650, '165.00', ' ', b'0', 1, '0', '4.0', '0.00', ' '),
(224, 'Sissons Single Sink with under sink storage space', 'Sinks', 910, 650, 650, '175.00', ' ', b'0', 2, '0', '2.2', '0.00', ' '),
(225, 'RHCs224 - Sissons', '0', 910, 650, 650, '175.00', ' ', b'0', 0, '0', '2.2', '0.00', ' '),
(226, '6 Foot Double sink with single draining area and under sink storage', '0', 950, 1800, 600, '350.00', ' ', b'0', 1, '0', '6.0', '0.00', ' '),
(227, 'Multi-Tray Holder with stainless top', 'Shelving & Gantries', 1000, 1650, 520, '225.00', ' ', b'0', 1, '0', '5.5', '0.00', ' ');

--
-- Triggers `benchessinksdb`
--
DROP TRIGGER IF EXISTS `TRiggerUpdateFeet`;
DELIMITER //
CREATE TRIGGER `TRiggerUpdateFeet` BEFORE UPDATE ON `benchessinksdb`
 FOR EACH ROW BEGIN
	SET NEW.TableinFeet = (Truncate(NEW.Width/304.8, 1) + 0.1);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TriggerNewFeet`;
DELIMITER //
CREATE TRIGGER `TriggerNewFeet` BEFORE INSERT ON `benchessinksdb`
 FOR EACH ROW BEGIN
	SET NEW.TableinFeet = (Truncate(NEW.Width/304.8, 1) + 0.1);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keywords_db`
--

CREATE TABLE IF NOT EXISTS `keywords_db` (
  `ref` int(3) NOT NULL AUTO_INCREMENT,
  `keywordGroup` varchar(255) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ref`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `keywords_db`
--

INSERT INTO `keywords_db` (`ref`, `keywordGroup`, `keyword`) VALUES
(1, 'group', 'Cooking & Hot Storage'),
(2, 'group', 'Food Preparation & Cleaning'),
(3, 'group', 'Furniture & Front of House'),
(4, 'group', 'Refrigeration & Cold Storage'),
(5, 'group', 'Stainless Steel Fabrications'),
(6, 'group', 'Specialist Cooking'),
(10, 'stainless', 'Sinks'),
(13, 'stainless', 'Worktops'),
(14, 'stainless', 'Shelving & Gantries'),
(15, 'power', 'Natural Gas'),
(16, 'power', 'LPG'),
(17, 'power', 'Single Phase'),
(18, 'power', 'Three Phase'),
(19, 'power', 'Dual Fuel'),
(20, 'brand', 'Blue Seal'),
(21, 'brand', 'King Edward'),
(24, 'brand', 'WinterHalter'),
(25, 'brand', 'Williams'),
(26, 'brand', 'Whirlpool'),
(27, 'brand', 'Vulcan'),
(28, 'brand', 'Victor'),
(29, 'brand', 'Parry'),
(30, 'brand', 'Osborne'),
(31, 'brand', 'Middleby Marshall'),
(32, 'brand', 'Merrychef'),
(33, 'brand', 'Lincat'),
(34, 'brand', 'Lec'),
(35, 'brand', 'Lainox'),
(36, 'brand', 'Inomak'),
(37, 'brand', 'Infrico'),
(38, 'brand', 'Hoshizaki'),
(39, 'brand', 'Hobart'),
(40, 'brand', 'Gram'),
(41, 'brand', 'Falcon'),
(42, 'brand', 'Buffalo'),
(43, 'brand', 'Autonumis');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
