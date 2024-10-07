-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 07, 2024 lúc 05:12 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thuesp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `deleted_at`) VALUES
(1, 'thiết bị OTO', '2024-10-06 08:42:09', '2024-10-07 03:36:34'),
(2, 'Thiết bị điện tử', '2024-10-06 08:42:30', '2024-10-06 08:42:30'),
(6, 'phụ kiện động cơ', '2024-10-07 12:42:55', '2024-10-07 12:42:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `title`, `text`, `created_at`) VALUES
(1, 1, 'Đơn hàng', 'Đơn hàng #4 của bạn đã bị hủy bởi quản trị viên.', '2024-10-05 22:39:09'),
(2, 1, 'Đơn hàng', 'Đơn hàng #4 của bạn đã bị hủy bởi quản trị viên.', '2024-10-06 22:39:09'),
(3, 1, 'v', 'Đơn hàng #4 của bạn đã bị hủy bởi quản trị viên.', '2024-10-01 22:39:09'),
(4, 1, 'Đơn hàng', 'Đơn hàng #4 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-06 22:39:09'),
(5, 1, 'Đơn hàng', 'Đơn hàng #4 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 03:08:54'),
(6, 1, 'Đơn hàng', 'Đơn hàng #7 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 03:14:44'),
(7, 1, 'Đơn hàng', 'Đơn hàng #8 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 03:24:30'),
(8, 1, 'Đơn hàng', 'Đơn hàng #9 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 03:27:14'),
(9, 1, 'Đơn hàng', 'Đơn hàng #9 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 03:27:26'),
(10, 1, 'Đơn hàng', 'Đơn hàng #2 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 07:16:20'),
(11, 1, 'Đơn hàng', 'Đơn hàng #2 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 07:20:16'),
(12, 1, 'Đơn hàng', 'Đơn hàng #2 của bạn đã bị hủy bởi quản trị viên.', '2024-10-07 07:21:11'),
(13, 1, 'Đơn hàng', 'Đơn hàng #2 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 07:21:53'),
(14, 1, 'Đơn hàng', 'Đơn hàng #2 của bạn đã bị hủy bởi quản trị viên.', '2024-10-07 07:21:59'),
(15, 2, 'Đơn hàng', 'Đơn hàng #10 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 07:41:47'),
(16, 2, 'Đơn hàng', 'Đơn hàng #11 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 07:41:54'),
(17, 2, 'Đơn hàng', 'Đơn hàng #11 của bạn đã bị hủy bởi quản trị viên.', '2024-10-07 07:42:06'),
(18, 6, 'Đơn hàng', 'Đơn hàng #12 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 12:41:53'),
(19, 6, 'Đơn hàng', 'Phiếu Mượn #13 của bạn đã được xác nhận bởi quản trị viên.', '2024-10-07 13:00:01'),
(20, 6, 'Đơn hàng', 'Phiếu Mượn #13 của bạn đã bị hủy bởi quản trị viên.', '2024-10-07 13:10:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `quantity`, `description`, `image`, `brand`) VALUES
(1, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(2, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(3, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(5, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(6, 'Quạt điều hòa', 1, 12, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(7, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(12, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(14, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(15, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(16, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(17, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(18, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(19, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(20, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(21, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(22, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(23, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(24, 'Quạt điều hòa', 1, 13, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(25, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(26, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(27, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(28, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(29, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(30, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(31, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(32, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(33, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(34, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(35, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(36, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(37, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(38, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(39, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(40, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(41, 'Quạt điều hòa', 1, 13, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(42, 'Quạt điều hòa', 1, 13, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(43, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(44, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(45, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(46, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(47, 'Quạt điều hòa', 1, 13, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(48, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(49, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(50, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(51, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(52, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(53, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(54, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(55, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(56, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(57, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(58, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(59, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL'),
(60, 'Quạt điều hòa', 1, 13, 'vrerwv grt', 'https://product.hstatic.net/200000038580/product/quat-dieu-hoa-d_multi_5_519_1020.png_736cdc167adf48a99c71d48b29984a53_large.jpg', 'JQK'),
(61, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(62, '1', 1, 1, '1', 'http://localhost/doan/ajaxs/admin/uploads/facebook-verified-badge-01-scaled.webp', '1'),
(63, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(64, 'Loa', 2, 31, '2323d2d', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'CDS'),
(65, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(66, 't45', 1, 145, '45t', 'http://localhost/qltb/ajaxs/admin/uploads/Screenshot (1345).png', '454'),
(67, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(68, 'Tivi', 2, 108, 'edweágdjasbkjdbasjdbkjashjkdsssssssssssssssssssssssssssssssssssssssssssssss\r\nsssssssssssssss\r\nsssssssssssssssssssssssss\r\nssssssssssssssssssssssssss\r\nsssssssssssssssssssssssss\r\nsassssssssssssssssssssssssssssssss', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'ASD'),
(69, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(70, 'Mic', 2, 12, 'fvrv', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JQK'),
(71, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(72, 'abcd ', 6, 5, 'tạm được \r\ntạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\ntạm được tạm được tạm được \r\ntạm được \r\ntạm được \r\n', 'http://localhost/doan/ajaxs/admin/uploads/a1a5192e-dd1c-4f8f-9639-53d19a7d01c9.jpg', 'truc phong '),
(73, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(74, 'Máy sấy tạo kiểu tóc', 1, 123, 'tvbtb', 'https://product.hstatic.net/200000038580/product/71yghjidh4l.jpg_690e04c194e04509ba08553f96b84f86_large.jpg', 'JQK'),
(75, 'Quạt', 1, 1, 'ưewewe', 'https://product.hstatic.net/200000038580/product/hall-kilburn-ii-black-brass-04_778e4b048ccf4902b4561d51a457bf5b_master_f644064f024545ba8326332d12d57131_large.png', 'JBL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rental_requests`
--

CREATE TABLE `rental_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` set('pending','success','paid','cancel') NOT NULL DEFAULT 'pending',
  `mota` longtext DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rental_requests`
--

INSERT INTO `rental_requests` (`id`, `user_id`, `product_id`, `status`, `mota`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'paid', '0388734079 - btvgrcf', '2024-09-30 17:00:00', '2024-10-01 18:06:35', '2024-10-06 16:53:20', '2024-10-07 07:21:59'),
(3, 2, 3, 'success', '0388734079 - 5g4f3', '2024-10-23 17:00:00', '2024-11-01 17:00:00', '2024-10-06 17:11:58', '2024-10-06 22:17:11'),
(4, 1, 2, 'success', '0388734079 - rt', '2024-10-06 17:00:00', '2024-10-17 17:00:00', '2024-10-06 22:34:23', '2024-10-07 03:08:54'),
(5, 1, 2, 'paid', '0388734079 - 12123', '2023-12-31 17:00:00', '2024-01-01 17:00:00', '2024-10-07 03:12:53', '2024-10-07 04:04:12'),
(6, 1, 2, 'paid', '0388734079 - 123', '2024-07-19 17:00:00', '2024-09-19 17:00:00', '2024-10-07 03:13:48', '2024-10-07 04:04:25'),
(7, 1, 2, 'success', '0388734079 - 1243', '2024-10-06 17:00:00', '2024-10-19 17:00:00', '2024-10-07 03:14:25', '2024-10-07 03:14:44'),
(8, 1, 2, 'success', '0388734079 - hahaha', '2024-10-09 17:00:00', '2024-11-08 17:00:00', '2024-10-07 03:23:50', '2024-10-07 03:24:30'),
(9, 1, 2, 'success', '0388734079 - 1231', '2024-10-07 17:00:00', '2024-10-30 17:00:00', '2024-10-07 03:26:41', '2024-10-07 03:27:26'),
(10, 2, 2, 'success', 'ád1', '2024-10-08 17:00:00', '2024-10-16 17:00:00', '2024-10-07 07:01:11', '2024-10-07 07:41:47'),
(11, 2, 14, 'paid', '123', '2024-10-15 17:00:00', '2024-11-06 17:00:00', '2024-10-07 07:40:32', '2024-10-07 07:42:06'),
(12, 6, 1, 'success', 'trúc phong', '2024-10-08 17:00:00', '2024-10-13 17:00:00', '2024-10-07 12:38:47', '2024-10-07 12:41:53'),
(13, 6, 6, 'paid', 'ngngng', '2024-10-07 17:00:00', '2024-10-13 17:00:00', '2024-10-07 12:57:18', '2024-10-07 13:10:28'),
(14, 6, 6, 'pending', 'dfasd', '2024-10-07 17:00:00', '2024-10-13 17:00:00', '2024-10-07 12:58:16', '2024-10-07 12:58:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`) VALUES
(1, 'customer', 'Vai trò khách hàng mặc định'),
(2, 'admin', 'Vai trò Quản Lý Website');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` set('active','ban') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `phone`, `role_id`, `created_at`, `updated_at`, `active`) VALUES
(1, 'a', 'demo@gmail.com', '4297f44b13955235245b2497399d7a93', 'Hoàng công', '0388734079', 1, '2024-10-06 07:51:44', '2024-10-07 12:32:23', 'active'),
(2, 'Asdasdf123', 'testewr41@gmail.com', 'ff90ab2c579ca478f00ec493755220fd', 'wre ferf', '543224534', 1, '2024-10-06 21:42:51', '2024-10-07 08:16:24', 'active'),
(3, 'admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 'Hoàng Minh Công', '', 2, '2024-10-06 17:44:53', '2024-10-07 03:08:21', 'active'),
(6, '123', 'abcs@gmail.com', '4297f44b13955235245b2497399d7a93', '123', '0534567892', 1, '2024-10-07 08:15:13', '2024-10-07 13:10:44', 'active');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `rental_requests`
--
ALTER TABLE `rental_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `rental_requests`
--
ALTER TABLE `rental_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rental_requests`
--
ALTER TABLE `rental_requests`
  ADD CONSTRAINT `rental_requests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
