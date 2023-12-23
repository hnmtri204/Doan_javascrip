-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 23, 2023 lúc 03:08 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(9, 'Burger', 'Burger', 0, '2023-12-08 08:40:15', '2023-12-08 08:40:15'),
(10, 'Fasr food', 'Fasr food', 0, '2023-12-08 08:41:02', '2023-12-08 08:41:02'),
(11, 'Pizza', 'Pizza', 0, '2023-12-08 08:41:12', '2023-12-08 08:41:12'),
(12, 'Garlic_Fried', 'Garlic_Fried', 0, '2023-12-08 08:41:30', '2023-12-08 08:41:30'),
(13, 'Grilled_beef_steak', 'Grilled_beef_steak', 0, '2023-12-08 08:41:54', '2023-12-08 08:41:54'),
(14, 'Crispy_fried', 'Crispy_fried', 0, '2023-12-08 08:42:43', '2023-12-08 08:42:43'),
(15, 'Lyulya_kebab', 'Lyulya_kebab', 0, '2023-12-08 08:43:41', '2023-12-08 08:43:41'),
(16, 'Grilled_pork_ribs', 'Grilled_pork_ribs', 0, '2023-12-08 08:43:56', '2023-12-08 08:43:56'),
(17, 'Mangalorean_Chicken', 'Mangalorean_Chicken', 0, '2023-12-08 08:44:14', '2023-12-08 08:44:14'),
(18, 'Pineapple', 'Pineapple', 0, '2023-12-08 08:44:27', '2023-12-08 08:44:27'),
(19, 'Rice', 'Rice', 0, '2023-12-08 08:44:46', '2023-12-08 08:44:46'),
(20, 'Shushi', 'Shushi', 0, '2023-12-08 08:44:54', '2023-12-08 08:44:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `price`, `quantity`) VALUES
(11, 'Bánh ngọt', 123, 100),
(13, 'Bánh gạo', 12, 10),
(14, 'Pizza', 30, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `categoriesid` text NOT NULL,
  `description` text NOT NULL,
  `price` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `view` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `view`, `created_at`, `updated_at`) VALUES
(63, 'Burger', 'Burger', 60, '/storage/burger.png', 0, '2023-12-22 16:39:11', '2023-12-22 16:39:11'),
(64, 'Crispy_fried', 'Crispy_fried', 180, '/storage/crispy_fried.png', 0, '2023-12-22 16:39:46', '2023-12-22 16:39:46'),
(66, 'Pizza', 'Pizza', 300, '/storage/Pizza.jpg', 0, '2023-12-22 16:40:23', '2023-12-22 16:40:23'),
(67, 'Shushi', 'Shushi', 450, '/storage/sushi__japanese.png', 0, '2023-12-22 16:41:33', '2023-12-22 16:41:33'),
(68, 'Rice', 'Rice', 120, '/storage/rice.png', 0, '2023-12-22 16:41:49', '2023-12-22 16:41:49'),
(69, 'Garlic_Fried', 'Garlic_Fried', 250, '/storage/Garlic_Fried.png', 0, '2023-12-22 16:42:12', '2023-12-22 16:42:12'),
(70, 'Grilled_beef_steak', 'Grilled_beef_steak', 350, '/storage/Grilled_beef_steak.png', 0, '2023-12-22 16:42:32', '2023-12-22 16:42:32'),
(72, 'Sashimi', 'Sashimi', 320, '/storage/Shashimi1.jpg', 0, '2023-12-22 16:44:35', '2023-12-22 16:44:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Email` text NOT NULL,
  `password` int(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `Email`, `password`, `created_at`, `updated_at`) VALUES
(106, 'Hoàng Ngọc Quý', 'quy@gmail.com', 12345678, '2023-12-22 13:16:21', '2023-12-22 13:16:21'),
(107, 'Hoàng Ngọc Minh Trí', 'hoangngocminhtri.thpt.ht@gmail.com', 123456, '2023-12-23 00:44:52', '2023-12-23 00:44:52'),
(108, 'Hoàng Ngọc Nam', 'hoangngocnam@gmail.com', 123456, '2023-12-23 01:21:56', '2023-12-23 01:21:56');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
