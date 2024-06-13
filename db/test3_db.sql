-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 12:51 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test3`
--

-- --------------------------------------------------------

--
-- Table structure for table `nation`
--

CREATE TABLE `nation` (
  `vote_id` int(11) NOT NULL,
  `votename` varchar(255) NOT NULL,
  `candidate_num` int(11) NOT NULL,
  `limit_cosign_num` int(11) NOT NULL,
  `voter_num` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `vote_key` varchar(255) NOT NULL,
  `web_key` varchar(255) NOT NULL,
  `is_invocing` BOOLEAN NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nation`
--

INSERT INTO `nation` (`vote_id`, `votename`, `candidate_num`, `limit_cosign_num`, `voter_num`, `percentage`, `vote_key`,`web_key`,`is_invocing`) VALUES
(0, 'dog', 3, 2, 10, 50, 'a56789','123213','false'),
(1, 'cat', 3, 2, 10, 50, 'b56789','sac232','false'),
(2, 'bird', 3, 2, 10, 50, 'c56789','12wd32','false'),
(3, 'fish', 3, 2, 10, 50, 'd56789','12dc34','false');

CREATE TABLE `cosign` (
  `cosign_Name` NVARCHAR(255) NOT NULL,
  `cosign_ID_Number` varchar(20) NOT NULL,
  `cosign_Birthday` DATE NOT NULL,
  `cosign_Phone_Number` VARCHAR(15) NOT NULL,  -- 這裡添加逗號並更改類型
  `vote_key` varchar(255) NOT NULL,
  `cosign_Image` VARCHAR(60) NOT NULL,
  `cosign_Number` int(11) NOT NULL,
  `cosign_Content` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `candidate` (
  `candidate_Name` NVARCHAR(255) NOT NULL,
  `candidate_ID_Number` varchar(20) NOT NULL,
  `candidate_Birthday` DATE NOT NULL,
  `candidate_Phone_Number` VARCHAR(15) NOT NULL,  -- 這裡添加逗號並更改類型
  `vote_key` varchar(255) NOT NULL,
  `candidate_Image` VARCHAR(60) NOT NULL,
  `candidate_Number` int(11) NOT NULL,
  `candidate_Content` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `voter` (
  `voter_Name` NVARCHAR(255) NOT NULL,
  `voter_ID_Number` varchar(20) NOT NULL,
  `voter_Birthday` DATE NOT NULL,
  `voter_Phone_Number` VARCHAR(15) NOT NULL,  -- 這裡添加逗號並更改類型
  `is_vote` BOOLEAN NOT NULL,
  `is_cosign` BOOLEAN NOT NULL,
  `vote_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `candidate` (`candidate_Name`, `candidate_ID_Number`, `candidate_Birthday`, `candidate_Phone_Number`
                          , `vote_key`,`candidate_Image`,`candidate_Number`) VALUES
('dog1', 'A123456789', '2020-01-01', '0912-123-456', 'a56789','a13.jpg',0),
('dog2', 'B123456789', '2020-01-01', '0912-223-456', 'a56789','a13.jpg',1),
('dog3', 'C123456789', '2020-01-01', '0913-123-456', 'a56789','a13.jpg',2),
('cat1', 'A123456789', '2020-01-01', '0922-123-456', 'b56789','a13.jpg',3),
('cat2', 'B103456789', '2020-01-01', '0912-124-456', 'b56789','a13.jpg',4),
('bird1', 'A103456789', '2020-01-01', '0902-123-456', 'c56789','a13.jpg',5),
('fish1', 'A105456889', '2020-01-01', '0912-123-759', 'd56789','a13.jpg',6);


INSERT INTO `cosign` (`cosign_Name`, `cosign_ID_Number`, `cosign_Birthday`, `cosign_Phone_Number`
                          , `vote_key`,`cosign_Image`,`cosign_Number`) VALUES
('dog1', 'A123456789', '2020-01-01', '0912-123-456', 'a56789','a13.jpg',0),
('dog2', 'B123456789', '2020-01-01', '0912-223-456', 'a56789','a13.jpg',1),
('dog3', 'C123456789', '2020-01-01', '0913-123-456', 'a56789','a13.jpg',2),
('cat1', 'A123456789', '2020-01-01', '0922-123-456', 'b56789','a13.jpg',3),
('cat2', 'B103456789', '2020-01-01', '0912-124-456', 'b56789','a13.jpg',4),
('bird1', 'A103456789', '2020-01-01', '0902-123-456', 'c56789','a13.jpg',5),
('fish1', 'A105456889', '2020-01-01', '0912-123-759', 'd56789','a13.jpg',6);



INSERT INTO `voter` (`voter_Name`, `voter_ID_Number`, `voter_Birthday`, `voter_Phone_Number`
                ,`is_vote`,`is_cosign`, `vote_key`) VALUES
('dog1', 'A123456789', '2020-01-01', '0912-123-456','0','0', 'a56789'),
('dog2', 'B123456789', '2020-01-01', '0912-223-456','0','0', 'a56789'),
('dog3', 'C123456789', '2020-01-01', '0913-123-456','0','0', 'a56789'),
('dog4', 'D123456789', '2020-01-01', '0913-402-456','0','0', 'a56789'),
('cat1', 'A123456789', '2020-01-01', '0922-123-456','0','0', 'b56789'),
('cat2', 'B103456789', '2020-01-01', '0912-124-456','0','0', 'b56789'),
('bird1', 'A103456789', '2020-01-01', '0902-123-456','0','0', 'c56789'),
('fish1', 'A105456889', '2020-01-01', '0912-123-759','0','0', 'd56789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--
-- ALTER TABLE `candidate`
--   ADD PRIMARY KEY (`candidate_Number`);

-- ALTER TABLE `cosign`
--   ADD PRIMARY KEY (`cosign_Number`);
--
-- AUTO_INCREMENT for table `nation`
--
-- ALTER TABLE `candidate`
--   MODIFY `candidate_Number` int(11) NOT NULL AUTO_INCREMENT;
-- ALTER TABLE `cosign`
--   MODIFY `cosign_Number` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nation`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
