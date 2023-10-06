-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql-server
-- Thời gian đã tạo: Th5 27, 2022 lúc 09:22 AM
-- Phiên bản máy phục vụ: 8.0.27
-- Phiên bản PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `product_management`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`%` PROCEDURE `my_proc` ()   BEGIN
  DECLARE shopdomain VARCHAR(255);
  SET shopdomain = TIMEDIFF("2017-06-15 13:11:11", "2017-06-15 13:10:30");
  Select TIME_TO_SEC(shopdomain);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `register_id` int NOT NULL,
  `changepass` int NOT NULL DEFAULT '0',
  `wrongpass` int NOT NULL DEFAULT '0',
  `abnormal_login` int NOT NULL DEFAULT '0',
  `lockaccount` int NOT NULL DEFAULT '0',
  `lockedtime` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'chờ xác minh',
  `account_balance` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `register_id`, `changepass`, `wrongpass`, `abnormal_login`, `lockaccount`, `lockedtime`, `status`, `account_balance`, `date_create`) VALUES
(6, '5905357827', '555555', 39, 1, 0, 0, 0, NULL, 'đã xác minh', '86986852', '2022-05-26 15:40:32'),
(7, '7908607570', '222222', 40, 1, 0, 0, 0, NULL, 'chờ xác minh', '17100000', '2022-05-22 15:27:22'),
(8, 'admin', '123456', -1, 0, 0, 0, 0, NULL, 'chờ xác minh', '0', '2022-05-22 05:54:32'),
(9, '4280618805', '222222', 41, 1, 0, 0, 0, NULL, 'đã xác minh', '4000000', '2022-05-22 05:54:32'),
(10, '6728907282', '111111', 42, 1, 0, 0, 0, NULL, 'đã vô hiệu hóa', '0', '2022-05-22 12:47:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `credit`
--

CREATE TABLE `credit` (
  `id` int UNSIGNED NOT NULL,
  `card` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `exdate` date NOT NULL,
  `cvv` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `credit`
--

INSERT INTO `credit` (`id`, `card`, `exdate`, `cvv`) VALUES
(1, '111111', '2022-10-10', '411'),
(2, '222222', '2022-11-11', '443'),
(3, '333333', '2022-12-12', '577');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phonecard`
--

CREATE TABLE `phonecard` (
  `id` int UNSIGNED NOT NULL,
  `home` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phonecard`
--

INSERT INTO `phonecard` (`id`, `home`, `code`, `fee`) VALUES
(1, 'Viettel', '11111', NULL),
(2, 'Mobifone', '22222', NULL),
(3, 'Vinaphone', '33333', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `price` int DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`) VALUES
(1, 'Macbook Pro', 1500, '16 inch, 32GB RAM'),
(2, 'iPhone X', 1100, 'No Adapter');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registers`
--

CREATE TABLE `registers` (
  `id` int UNSIGNED NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fontimage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `backimage` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `registers`
--

INSERT INTO `registers` (`id`, `phone`, `email`, `fullname`, `date`, `address`, `fontimage`, `backimage`) VALUES
(39, '0965514285', 'ngohuule16012000@gmail.com', 'Ngô Lễ', '2022-05-01', 'An Giang', 'z3382168648249_b79f12121fad9fa6a21f6495b1c54112.jpg', 'IMG20180705162549.jpg'),
(40, '0965514284', 'ngohuule2000@gmail.com', 'Ngô Hữu Lễ', '2022-05-02', 'HCM', '280415793_1598435393883113_1280382433385556103_n.jpg', 'IMG_1527832273296_1527832410639.jpg'),
(41, '0923514285', 'ngoh16012000@gmail.com', 'Ngô Lễ', '2022-05-02', '16', 'IMG20180806100713.jpg', 'IMG20180705162552.jpg'),
(42, '0965514333', 'nguyenvanteo@gmail.com', 'Nguyễn Văn Tèo', '2022-05-01', 'Hà Nội', 'IMG20180705162549.jpg', 'IMG20180705163332.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transhis`
--

CREATE TABLE `transhis` (
  `id` int UNSIGNED NOT NULL,
  `account_id` int NOT NULL,
  `credit_id` int DEFAULT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_date` datetime NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `home` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `cardcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `valuecard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transhis`
--

INSERT INTO `transhis` (`id`, `account_id`, `credit_id`, `money`, `trans_date`, `type`, `note`, `status`, `fee`, `sender_id`, `receiver_id`, `home`, `quantity`, `cardcode`, `valuecard`) VALUES
(4, 6, 1, '12121212', '2022-05-22 13:59:41', 0, NULL, NULL, NULL, NULL, NULL, '', 0, 'null', NULL),
(5, 6, 1, '5000000', '2022-05-26 02:15:59', 0, NULL, NULL, NULL, NULL, NULL, '', 0, 'null', NULL),
(6, 6, 1, '3000000', '2022-05-26 03:14:54', 1, 'rút tiền', NULL, '150000', NULL, NULL, '', 0, 'null', NULL),
(17, 6, NULL, '1000000', '2022-05-26 05:27:58', 2, 'chuyen', NULL, '50000', NULL, 7, '', 0, 'null', NULL),
(18, 7, NULL, '1000000', '2022-05-26 05:27:58', 3, NULL, NULL, '50000', 6, NULL, '', 0, 'null', NULL),
(19, 7, NULL, '200000', '2022-05-26 05:34:21', 3, NULL, NULL, NULL, 6, NULL, '', 0, 'null', NULL),
(20, 6, NULL, '200000', '2022-05-26 05:34:21', 2, 'ch', NULL, '10000', NULL, 7, '', 0, 'null', NULL),
(21, 6, NULL, '10000000', '2022-05-26 17:03:26', 2, 'chuyen 10tr', NULL, '500000', NULL, 7, '', 0, 'null', NULL),
(23, 6, NULL, '90000000', '2022-05-26 17:11:28', 2, 'chuyen 90tr', 'bị huỷ', '4500000', NULL, 7, '', 0, 'null', NULL),
(26, 6, NULL, '30000', '2022-05-26 07:54:29', 4, NULL, NULL, NULL, NULL, NULL, 'Viettel', 3, '1111110898 1111162385 1111195576 ', '10000'),
(27, 6, NULL, '200000', '2022-05-26 07:56:15', 4, NULL, NULL, NULL, NULL, NULL, 'Viettel', 2, '1111166856 1111136528 ', '100000'),
(28, 7, 1, '10000000', '2022-05-26 10:37:34', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 9, NULL, '3000000', '2022-05-26 10:39:11', 3, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL),
(30, 7, NULL, '3000000', '2022-05-26 10:39:11', 2, 'chuyen 3tr', NULL, '150000', NULL, 9, NULL, NULL, NULL, NULL),
(31, 6, NULL, '200000', '2022-05-26 14:09:56', 4, NULL, NULL, NULL, NULL, NULL, 'Viettel', 4, '1111182005 1111168995 1111110426 1111185904 ', '50000'),
(32, 6, 1, '6000000', '2022-05-26 17:01:31', 1, 'rut 6 cu', NULL, '300000', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 7, NULL, '10000000', '2022-05-26 17:03:26', 3, 'chuyen 10tr', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phonecard`
--
ALTER TABLE `phonecard`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transhis`
--
ALTER TABLE `transhis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `credit`
--
ALTER TABLE `credit`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `phonecard`
--
ALTER TABLE `phonecard`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `transhis`
--
ALTER TABLE `transhis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
