-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-07 15:10:58
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `source02`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `basic`
--

CREATE TABLE `basic` (
  `id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `basic`
--

INSERT INTO `basic` (`id`, `start`, `end`) VALUES
(1, '2025-04-13 16:40:00', '2025-04-13 16:40:00');

-- --------------------------------------------------------

--
-- 資料表結構 `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `plate` text NOT NULL,
  `time` int(11) NOT NULL,
  `route` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `bus`
--

INSERT INTO `bus` (`id`, `plate`, `time`, `route`) VALUES
(4, 'B12345', 20, 'asdfasdf'),
(5, 'C12345', 13, '台北101接駁專車');

-- --------------------------------------------------------

--
-- 資料表結構 `form`
--

CREATE TABLE `form` (
  `form` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `form`
--

INSERT INTO `form` (`form`) VALUES
(0);

-- --------------------------------------------------------

--
-- 資料表結構 `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `participants`
--

INSERT INTO `participants` (`id`, `mail`) VALUES
(2, 'user01@test.come'),
(3, 'user02@test.come'),
(4, 'roychen68@test.com');

-- --------------------------------------------------------

--
-- 資料表結構 `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mail` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `response`
--

INSERT INTO `response` (`id`, `name`, `mail`, `note`) VALUES
(4, 'adsf', 'user01@test.come', 'fads');

-- --------------------------------------------------------

--
-- 資料表結構 `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `stations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `route`
--

INSERT INTO `route` (`id`, `name`, `stations`) VALUES
(23, 'asdfasdf', '4'),
(24, '台北101接駁專車', '7'),
(25, '265', '4');

-- --------------------------------------------------------

--
-- 資料表結構 `route-station`
--

CREATE TABLE `route-station` (
  `id` int(11) NOT NULL,
  `station` text NOT NULL,
  `rank` int(11) NOT NULL,
  `need` int(11) NOT NULL,
  `stop` int(11) NOT NULL,
  `route` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `route-station`
--

INSERT INTO `route-station` (`id`, `station`, `rank`, `need`, `stop`, `route`) VALUES
(15, '台北車站', 1, 3, 2, '台北101接駁專車'),
(16, '臺大醫院', 2, 3, 4, '台北101接駁專車'),
(17, '中正紀念堂', 3, 3, 3, '台北101接駁專車'),
(18, '東門', 4, 3, 2, '台北101接駁專車'),
(19, '大安森林公園', 5, 4, 2, '台北101接駁專車'),
(20, '大安', 6, 4, 2, '台北101接駁專車'),
(21, '信義安和', 7, 5, 2, '台北101接駁專車'),
(22, '台北車站', 1, 2, 2, '265'),
(23, '中正紀念堂', 2, 2, 2, '265'),
(24, '東門', 3, 2, 2, '265'),
(25, '大安森林公園', 4, 2, 2, '265'),
(29, '台北車站', 1, 3, 3, 'asdfasdf'),
(30, '臺大醫院', 2, 3, 2, 'asdfasdf'),
(31, '中正紀念堂', 3, 2, 2, 'asdfasdf'),
(32, '東門', 4, 3, 2, 'asdfasdf');

--
-- 觸發器 `route-station`
--
DELIMITER $$
CREATE TRIGGER `route_add` AFTER INSERT ON `route-station` FOR EACH ROW UPDATE route
    SET stations = (
        SELECT COUNT(*) FROM `route-station`
        WHERE route = NEW.route
    )
    WHERE name = NEW.route
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `route_edit` AFTER UPDATE ON `route-station` FOR EACH ROW UPDATE route
SET stations = (
    SELECT COUNT(*) FROM `route-station`
    WHERE route = NEW.route
)
WHERE name = NEW.route
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `station`
--

INSERT INTO `station` (`id`, `name`) VALUES
(2, '台北車站'),
(3, '臺大醫院'),
(4, '中正紀念堂'),
(5, '東門'),
(6, '大安森林公園'),
(7, '大安'),
(8, '信義安和');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `basic`
--
ALTER TABLE `basic`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`form`);

--
-- 資料表索引 `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route-station`
--
ALTER TABLE `route-station`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `basic`
--
ALTER TABLE `basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route-station`
--
ALTER TABLE `route-station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
