-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 11:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_12_13_075209_create_tbl_faculty_table', 1),
(3, '2022_12_13_105629_create_tbl_authors_table', 2),
(4, '2022_12_14_045713_create_tbl_books_category', 3),
(5, '2022_12_14_065320_create_tbl_books', 4),
(6, '2022_12_16_064929_create_tbl_borrow_books', 5),
(7, '2022_12_16_085753_create_tbl_users', 6),
(8, '2022_12_18_042000_create_tbl_borrow_books_detail', 7);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_phone`) VALUES
(1, 'Nguyễn Anh Thư', 'e10adc3949ba59abbe56e057f20f883e', 'nguyenanhthu55138@gmail.com', '0395245117');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authors`
--

CREATE TABLE `tbl_authors` (
  `authors_id` int(10) UNSIGNED NOT NULL,
  `authors_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_authors`
--

INSERT INTO `tbl_authors` (`authors_id`, `authors_name`) VALUES
(1, 'Lý Thương Long'),
(6, 'Giáo sư John Vu'),
(7, 'Không Xác Định');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `books_id` int(10) UNSIGNED NOT NULL,
  `books_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `books_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors_id` int(11) NOT NULL,
  `books_category_id` int(11) NOT NULL,
  `books_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `books_price` int(11) NOT NULL,
  `books_quantity` int(11) NOT NULL,
  `books_borrow_qty` int(11) DEFAULT NULL,
  `books_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `books_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`books_id`, `books_code`, `barcode`, `books_name`, `authors_id`, `books_category_id`, `books_slug`, `books_price`, `books_quantity`, `books_borrow_qty`, `books_image`, `books_status`, `created_at`, `updated_at`) VALUES
(13, '102213', '<div style=\"font-size:0;position:relative;width:198px;height:60px;\">\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:0px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:6px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:12px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:16px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:24px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:28px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:32px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:36px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:44px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:48px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:52px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:60px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:68px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:72px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:76px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:84px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:88px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:92px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:100px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:104px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:112px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:116px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:120px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:128px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:136px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:140px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:144px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:148px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:156px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:164px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:172px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:176px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:180px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:184px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:190px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:194px;top:0\">&nbsp;</div>\r\n</div>\r\n', 'Khởi Hành – Lời Khuyên Sinh Viên Việt Nam', 6, 5, 'khoi-hanh-loi-khuyen-sinh-vien-viet-nam68', 64500, 10, 0, 'khoi-hanh76.jpg', 1, '2022-12-23 06:50:59', NULL),
(14, '100672', '<div style=\"font-size:0;position:relative;width:198px;height:60px;\">\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:0px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:6px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:12px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:16px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:24px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:28px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:32px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:36px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:44px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:48px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:52px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:60px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:68px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:72px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:76px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:80px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:88px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:96px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:100px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:104px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:112px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:120px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:124px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:128px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:132px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:136px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:140px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:148px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:156px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:160px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:168px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:172px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:176px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:184px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:190px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:194px;top:0\">&nbsp;</div>\r\n</div>\r\n', 'Đại Học Không Lạc Hướng', 1, 5, 'dai-hoc-khong-lac-huong80', 60000, 12, -2, 'dai-hoc-khong-lac-huong14.jpg', 1, '2022-12-23 06:52:50', NULL),
(15, '102023', '<div style=\"font-size:0;position:relative;width:198px;height:60px;\">\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:0px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:6px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:12px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:16px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:24px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:28px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:32px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:36px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:44px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:48px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:52px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:60px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:68px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:72px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:76px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:84px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:88px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:92px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:100px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:104px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:108px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:116px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:124px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:128px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:132px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:140px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:144px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:148px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:156px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:6px;height:60px;position:absolute;left:164px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:172px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:176px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:180px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:184px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:2px;height:60px;position:absolute;left:190px;top:0\">&nbsp;</div>\r\n<div style=\"background-color:black;width:4px;height:60px;position:absolute;left:194px;top:0\">&nbsp;</div>\r\n</div>\r\n', 'Xác Suất Thống Kê', 7, 3, 'xac-suat-thong-ke86', 45000, 5, 0, 'xac-suat-thong-ke59.jpg', 1, '2022-12-23 06:55:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books_category`
--

CREATE TABLE `tbl_books_category` (
  `books_category_id` int(10) UNSIGNED NOT NULL,
  `books_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `books_category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_books_category`
--

INSERT INTO `tbl_books_category` (`books_category_id`, `books_category_name`, `books_category_status`) VALUES
(3, 'Giáo Trình', 1),
(4, 'Sách Tham Khảo', 1),
(5, 'Sách Tư Duy và Cuộc Sống', 1),
(6, 'Sách Hướng Dẫn Thực Hành', 1),
(7, 'Truyện Tranh', 1),
(8, 'Kí: kí sự, phóng sự, tuỳ bút, hồi kí, nhật kí', 1),
(9, 'Truyện: truyện ngắn, truyện vừa, tiểu thuyết, truyện lịch sử, truyện trinh thám, truyền hình sự, truyện dài, truyện khoa học viễn tưởng', 1),
(10, 'Thể Loại Khác', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow_books`
--

CREATE TABLE `tbl_borrow_books` (
  `borrow_books_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `borrow_books_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `pay_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_borrow_books`
--

INSERT INTO `tbl_borrow_books` (`borrow_books_id`, `user_id`, `borrow_books_status`, `created_at`, `pay_day`) VALUES
(50, 1, '3', '2022-12-22 09:26:21', '2022-12-31'),
(51, 4, '1', '2022-12-27 04:47:45', '2023-01-10'),
(52, 4, '2', '2022-12-27 06:34:25', '2022-12-31'),
(53, 1, '3', '2022-12-27 06:46:10', '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow_books_detail`
--

CREATE TABLE `tbl_borrow_books_detail` (
  `borrow_detail_id` int(10) UNSIGNED NOT NULL,
  `borrow_book_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `borrow_detail_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow_detail`
--

CREATE TABLE `tbl_borrow_detail` (
  `borrow_detail_id` int(11) NOT NULL,
  `borrow_book_id` int(11) NOT NULL,
  `book_borrow_qty` int(11) NOT NULL,
  `authors_id` int(11) NOT NULL,
  `authors_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_price` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrow_detail`
--

INSERT INTO `tbl_borrow_detail` (`borrow_detail_id`, `borrow_book_id`, `book_borrow_qty`, `authors_id`, `authors_name`, `category_id`, `category_name`, `book_id`, `book_name`, `book_price`, `user_id`, `user_name`, `user_phone`, `user_email`) VALUES
(37, 50, 1, 6, 'Nguyễn Anh Thư', 1, 'sách giải trí', 11, 'Hoa mặt trời', '10000', 1, 'Nguyễn Anh Thư', 395245117, 'thub1910584@student.ctu.edu.vn'),
(38, 51, 1, 7, 'Không Xác Định', 3, 'Giáo Trình', 15, 'Xác Suất Thống Kê', '45000', 4, 'Mai Thị Tuyết Hồng', 394132791, 'hongB1910520@student.ctu.edu.vn'),
(39, 52, 1, 7, 'Không Xác Định', 3, 'Giáo Trình', 15, 'Xác Suất Thống Kê', '45000', 4, 'Mai Thị Tuyết Hồng', 394132791, 'hongB1910520@student.ctu.edu.vn'),
(40, 53, 1, 7, 'Không Xác Định', 3, 'Giáo Trình', 14, 'Đại Học Không Lạc Hướng', '60000', 1, 'Nguyễn Anh Thư', 395245117, 'thub1910584@student.ctu.edu.vn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_majors`
--

CREATE TABLE `tbl_majors` (
  `majors_id` int(11) NOT NULL,
  `majors_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_majors`
--

INSERT INTO `tbl_majors` (`majors_id`, `majors_name`) VALUES
(1, 'Công Nghệ Thông Tin'),
(2, 'Nông Học'),
(3, 'Khuyến Nông'),
(4, 'Ngôn Ngữ Anh'),
(5, 'Việt Nam Học'),
(6, 'Luật'),
(7, 'Quản Trị Kinh Doanh'),
(8, 'Kinh Tế Nông Nghiệp'),
(9, 'Kinh Doanh Nông Nghiệp'),
(10, 'Nuôi trồng Thủy Sản'),
(11, 'Kỹ Thuật Xây Dựng'),
(12, 'Ngành KHác');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_resets`
--

CREATE TABLE `tbl_password_resets` (
  `email` varchar(255) NOT NULL,
  `_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `student_code`, `user_email`, `user_phone`) VALUES
(1, 'Nguyễn Anh Thư', 'B1910584', 'thub1910584@student.ctu.edu.vn', 395245117),
(4, 'Mai Thị Tuyết Hồng', 'B1910520', 'hongB1910520@student.ctu.edu.vn', 394132791);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  ADD PRIMARY KEY (`authors_id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`books_id`),
  ADD UNIQUE KEY `tbl_books_books_slug_unique` (`books_slug`);

--
-- Indexes for table `tbl_books_category`
--
ALTER TABLE `tbl_books_category`
  ADD PRIMARY KEY (`books_category_id`);

--
-- Indexes for table `tbl_borrow_books`
--
ALTER TABLE `tbl_borrow_books`
  ADD PRIMARY KEY (`borrow_books_id`);

--
-- Indexes for table `tbl_borrow_books_detail`
--
ALTER TABLE `tbl_borrow_books_detail`
  ADD PRIMARY KEY (`borrow_detail_id`);

--
-- Indexes for table `tbl_borrow_detail`
--
ALTER TABLE `tbl_borrow_detail`
  ADD PRIMARY KEY (`borrow_detail_id`);

--
-- Indexes for table `tbl_majors`
--
ALTER TABLE `tbl_majors`
  ADD PRIMARY KEY (`majors_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  MODIFY `authors_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `books_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_books_category`
--
ALTER TABLE `tbl_books_category`
  MODIFY `books_category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_borrow_books`
--
ALTER TABLE `tbl_borrow_books`
  MODIFY `borrow_books_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_borrow_books_detail`
--
ALTER TABLE `tbl_borrow_books_detail`
  MODIFY `borrow_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_borrow_detail`
--
ALTER TABLE `tbl_borrow_detail`
  MODIFY `borrow_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_majors`
--
ALTER TABLE `tbl_majors`
  MODIFY `majors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
