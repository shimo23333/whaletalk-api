-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 11 月 09 日 19:26
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `whaletalk`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `uid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'api使用的ID',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '顯示名稱',
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-mail',
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
  `signup_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間',
  `last_login_at` datetime NOT NULL COMMENT '最後登入時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='使用者';

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`id`, `uid`, `name`, `email`, `password`, `signup_at`, `last_login_at`) VALUES
(1, 'grass', '陳系草', 'grass527@gmail.com', '123123', '2022-11-09 16:27:05', '2022-11-09 17:25:49'),
(2, 'shimo', '曼瑄', 'shimo@gmail.com', '456456', '2022-11-09 16:27:05', '2022-11-09 17:25:49');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `wid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '鯨語 ID',
  `uid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者 ID',
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '類型：1文字, 2聲音',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '文字或聲音URL',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '建立時間',
  `repeat_time` time DEFAULT NULL COMMENT '重播時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`id`, `wid`, `uid`, `type`, `content`, `create_at`, `repeat_time`) VALUES
(5, 'w001', 'grass', '', 'grass gpdpdp', '2022-11-09 18:23:28', NULL),
(6, 'w001', 'grass', 'w001', '0', '2022-11-09 18:14:07', NULL),
(8, 'w001', 'grass', 'w001', 'bighihi', '2022-11-09 18:18:09', NULL),
(9, 'w001', 'grass', 'w001', 'bighihi', '2022-11-09 18:22:37', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `whale`
--

CREATE TABLE `whale` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `wid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'api使用ID',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '顯示名稱',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `owner_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '所有人',
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='鯨語';

--
-- 傾印資料表的資料 `whale`
--

INSERT INTO `whale` (`id`, `wid`, `name`, `create_at`, `owner_id`, `image`) VALUES
(1, 'w001', '鯨語初號機01', '2022-11-09 16:46:13', 'grass', ''),
(2, 'w002', '鯨語二號機', '2022-11-09 16:46:13', 'shimo', '');

-- --------------------------------------------------------

--
-- 資料表結構 `whale_member`
--

CREATE TABLE `whale_member` (
  `wid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '鯨語 wid',
  `uid` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者 uid',
  `is_admin` tinyint(1) NOT NULL COMMENT '管理員權限',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '加入時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `whale_member`
--

INSERT INTO `whale_member` (`wid`, `uid`, `is_admin`, `create_at`) VALUES
('w001', 'grass', 1, '2022-11-09 17:07:54'),
('w001', 'shimo', 1, '2022-11-09 17:35:43');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `whale`
--
ALTER TABLE `whale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wid` (`wid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `whale`
--
ALTER TABLE `whale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
