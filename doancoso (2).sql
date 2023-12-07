-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2023 lúc 01:04 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doancoso`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresscustomer`
--

CREATE TABLE `addresscustomer` (
  `idAddress` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addresscustomer`
--

INSERT INTO `addresscustomer` (`idAddress`, `idCustomer`, `Address`, `PhoneNumber`, `CustomerName`, `created_at`, `updated_at`) VALUES
(2, 1, '32 huỳnh ngọc đủ hòa xuân', '0794646588', 'Trần Thị Thông Thảo', '2023-12-02 13:42:21', '2023-12-02 13:42:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(10) UNSIGNED NOT NULL,
  `AdminName` varchar(50) NOT NULL,
  `AdminUser` varchar(50) NOT NULL,
  `AdminPass` varchar(255) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `NumberPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`idAdmin`, `AdminName`, `AdminUser`, `AdminPass`, `Position`, `Address`, `NumberPhone`, `Email`, `created_at`, `updated_at`) VALUES
(1, 'Trần Thị Thông Thảo', 'admin', '25f9e794323b453885f5181f1b624d0b', 'Quản lý', '32 Huỳnh Ngọc Đủ, Hòa Xuân , Cẩm Lệ, Đà Nẵng', '0794646588', 'thaottt.22it@vku.udn.vn', '2023-11-14 15:30:58', '2023-11-14 16:21:48'),
(2, 'Trần Thị Thông Thảo', 'nhanvien1', '25f9e794323b453885f5181f1b624d0b', 'Nhân Viên', '32 huỳnh ngọc đủ', '0794646588', 'thaotran4135@gmail.com', '2023-11-17 16:20:17', '2023-11-17 16:20:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `idAttribute` int(10) UNSIGNED NOT NULL,
  `AttributeName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`idAttribute`, `AttributeName`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2023-11-14 16:05:06', '2023-11-14 16:05:06'),
(2, 'Màu', '2023-11-18 04:52:06', '2023-11-18 04:52:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `idAttrValue` int(10) UNSIGNED NOT NULL,
  `idAttribute` int(11) UNSIGNED NOT NULL,
  `AttrValName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`idAttrValue`, `idAttribute`, `AttrValName`, `created_at`, `updated_at`) VALUES
(1, 1, '17', '2023-11-14 16:05:17', '2023-11-14 16:05:17'),
(2, 1, '18', '2023-11-14 16:05:21', '2023-11-14 16:05:21'),
(3, 1, '19', '2023-11-14 16:05:26', '2023-11-14 16:05:26'),
(4, 1, '20', '2023-11-14 16:06:10', '2023-11-14 16:06:10'),
(5, 1, '21', '2023-11-14 16:06:14', '2023-11-14 16:06:14'),
(6, 1, '22', '2023-11-14 16:06:17', '2023-11-14 16:06:17'),
(7, 1, '23', '2023-11-14 16:06:21', '2023-11-14 16:06:21'),
(8, 1, '24', '2023-11-14 16:06:39', '2023-11-14 16:06:39'),
(9, 1, '25', '2023-11-14 16:06:44', '2023-11-14 16:06:44'),
(10, 1, '26', '2023-11-14 16:06:48', '2023-11-14 16:06:48'),
(11, 1, '27', '2023-11-14 16:06:51', '2023-11-14 16:06:51'),
(12, 1, '28', '2023-11-14 16:06:55', '2023-11-14 16:06:55'),
(13, 1, '29', '2023-11-14 16:06:58', '2023-11-14 16:06:58'),
(14, 1, '30', '2023-11-14 16:07:02', '2023-11-14 16:07:02'),
(15, 1, '31', '2023-11-14 16:07:05', '2023-11-14 16:07:05'),
(16, 1, '32', '2023-11-14 16:07:09', '2023-11-14 16:07:09'),
(17, 1, '33', '2023-11-14 16:07:12', '2023-11-14 16:07:12'),
(18, 1, '34', '2023-11-14 16:07:15', '2023-11-14 16:07:15'),
(19, 1, '35', '2023-11-14 16:07:19', '2023-11-14 16:07:19'),
(20, 1, '36', '2023-11-14 16:07:23', '2023-11-14 16:07:23'),
(21, 1, '37', '2023-11-14 16:07:26', '2023-11-14 16:07:26'),
(22, 1, '38', '2023-11-14 16:07:30', '2023-11-14 16:07:30'),
(23, 1, '39', '2023-11-14 16:07:34', '2023-11-14 16:07:34'),
(24, 1, '40', '2023-11-14 16:07:37', '2023-11-14 16:07:37'),
(25, 1, '41', '2023-11-14 16:07:41', '2023-11-14 16:07:41'),
(26, 1, '42', '2023-11-14 16:07:45', '2023-11-14 16:07:45'),
(27, 1, '43', '2023-11-14 16:07:49', '2023-11-14 16:07:49'),
(28, 1, '44', '2023-11-14 16:07:53', '2023-11-14 16:07:53'),
(29, 2, 'Trắng', '2023-11-18 04:52:19', '2023-11-18 04:52:19'),
(30, 2, 'Đen', '2023-11-18 04:52:26', '2023-11-18 04:52:26'),
(31, 1, '45', '2023-12-05 03:56:15', '2023-12-05 03:56:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `idBill` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `Payment` varchar(50) NOT NULL DEFAULT 'cash',
  `Voucher` varchar(50) DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `ReceiveDate` datetime DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 0,
  `TotalBill` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`idBill`, `idCustomer`, `Payment`, `Voucher`, `Address`, `PhoneNumber`, `CustomerName`, `ReceiveDate`, `Status`, `TotalBill`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', NULL, '32 huỳnh ngọc đủ, hòa xuân,cẩm lệ,đà nẵng', '0794646588', 'Trần Thị Thông Thảo', NULL, 99, 113149000, '2023-11-21 15:42:40', '2023-11-22 08:53:10'),
(2, 1, 'cash', NULL, '32 huỳnh ngọc đủ, hòa xuân,cẩm lệ,đà nẵng', '0794646588', 'Trần Thị Thông Thảo', '2023-11-22 15:55:27', 2, 113149000, '2023-11-21 15:44:17', '2023-11-22 08:55:27'),
(3, 1, 'cash', NULL, '32 huỳnh ngọc đủ, hòa xuân,cẩm lệ,đà nẵng', '0794646588', 'Trần Thị Thông Thảo', NULL, 99, 539000, '2023-11-22 09:11:27', '2023-11-24 12:44:51'),
(4, 1, 'cash', NULL, '32 huỳnh ngọc đủ hòa xuân', '0794646588', 'Trần Thị Thông Thảo', '2023-12-02 21:26:35', 2, 112640000, '2023-12-02 13:44:23', '2023-12-02 14:26:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billhistory`
--

CREATE TABLE `billhistory` (
  `idBill` int(11) UNSIGNED NOT NULL,
  `AdminName` varchar(50) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `billhistory`
--

INSERT INTO `billhistory` (`idBill`, `AdminName`, `Status`, `created_at`, `updated_at`) VALUES
(2, 'Trần Thị Thông Thảo', 1, '2023-11-22 08:52:54', '2023-11-22 08:52:54'),
(1, 'Trần Thị Thông Thảo', 99, '2023-11-22 08:53:10', '2023-11-22 08:53:10'),
(3, 'Trần Thị Thông Thảo', 99, '2023-11-24 12:44:51', '2023-11-24 12:44:51'),
(4, 'Trần Thị Thông Thảo', 1, '2023-12-02 14:26:31', '2023-12-02 14:26:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billinfo`
--

CREATE TABLE `billinfo` (
  `idBill` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `AttributeProduct` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `QuantityBuy` int(11) NOT NULL,
  `idProAttr` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `idBlog` int(10) UNSIGNED NOT NULL,
  `BlogContent` longtext NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `BlogDesc` text NOT NULL,
  `BlogTitle` varchar(255) NOT NULL,
  `BlogSlug` varchar(255) NOT NULL,
  `BlogImage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`idBlog`, `BlogContent`, `Status`, `BlogDesc`, `BlogTitle`, `BlogSlug`, `BlogImage`, `created_at`, `updated_at`) VALUES
(1, '<h2>1. Tại sao gi&agrave;y g&atilde;y mũi khi mang?</h2>\r\n\r\n<p>C&oacute; rất nhiều l&yacute; do c&oacute; thể khiến gi&agrave;y bị g&atilde;y mũi. Gi&agrave;y bị g&atilde;y mũi v&igrave; bạn đang khiến gi&agrave;y bị đau! Đừng để gi&agrave;y chất chồng l&ecirc;n nhau m&agrave; kh&ocirc;ng được bảo vệ. Gi&agrave;y n&ecirc;n được săn s&oacute;c cẩn thận, c&oacute; đủ kh&ocirc;ng gian tho&aacute;ng m&aacute;t, kh&ocirc;ng bị những m&oacute;n đồ kh&aacute;c phủ k&iacute;n.&nbsp;</p>\r\n\r\n<p>Một vấn đề nữa l&agrave;, ai m&agrave; chẳng c&oacute; l&uacute;c cảm thấy kh&oacute; đi gi&agrave;y v&agrave;o ch&acirc;n. Việc n&agrave;y c&oacute; thể khiến bạn đ&egrave; n&eacute;n phần trước của g&oacute;t gi&agrave;y v&agrave; vặn ch&acirc;n v&agrave;o gi&agrave;y theo nhiều hướng. Đến khi ch&acirc;n bạn y&ecirc;n vị b&ecirc;n trong gi&agrave;y, sẽ l&agrave;m gi&agrave;y bạn bị g&atilde;y mũi ở nhiều chỗ.</p>\r\n\r\n<p>Nếu bạn muốn gi&agrave;y m&igrave;nh giữ được vẻ đẹp v&agrave; kh&ocirc;ng cũ đi qu&aacute; nhanh, bạn kh&ocirc;ng thể đi một đ&ocirc;i gi&agrave;y li&ecirc;n tục m&atilde;i được. D&ugrave; đ&acirc;y c&oacute; l&agrave; đ&ocirc;i gi&agrave;y y&ecirc;u th&iacute;ch nhất của bạn đi chăng nữa. Đi c&ugrave;ng một đ&ocirc;i gi&agrave;y li&ecirc;n tục mỗi ng&agrave;y sẽ khiến đ&ocirc;i gi&agrave;y y&ecirc;u th&iacute;ch đ&oacute; của bạn nhanh bị hằn vết v&agrave; đế gi&agrave;y cũng nhanh bị sờn. Nếu cần, h&atilde;y mua th&ecirc;m đ&ocirc;i thứ hai mẫu gi&agrave;y bạn th&iacute;ch!</p>\r\n\r\n<p><img alt=\"cach-mang-giay-de-khong-bi-gay-mui-giay-1.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/cach_mang_giay_de_khong_bi_gay_mui_giay_1_2724db5417.jpg\" /></p>\r\n\r\n<p>C&oacute; nguy&ecirc;n do kh&aacute;c nữa, đ&oacute; ch&iacute;nh l&agrave; độ ẩm. Khi gi&agrave;y bạn được nghỉ ngơi, gi&agrave;y c&oacute; thời gian được tho&aacute;t ẩm dư thừa v&agrave; đ&aacute;p ứng chuyển động m&agrave; kh&ocirc;ng g&acirc;y hằn vết hoặc nứt bề mặt gi&agrave;y. Tất nhi&ecirc;n gi&agrave;y vẫn bị m&ograve;n khi được sử dụng nhiều. Nhưng độ ẩm mới ch&iacute;nh l&agrave; s&aacute;t thủ thầm lặng. Độ ẩm dư thừa c&oacute; thể l&agrave; m&ocirc;i trường l&yacute; tưởng cho nấm mốc ph&aacute;t triển. Cũng như c&oacute; thể l&agrave;m chất liệu gi&agrave;y bị gi&atilde;n ra hoặc co lại.</p>\r\n\r\n<p>Bảo vệ gi&agrave;y kh&ocirc; r&aacute;o bằng c&aacute;ch tr&aacute;nh để gi&agrave;y bị ẩm khi đi bộ, dưỡng gi&agrave;y trước khi sử dụng, v&agrave; để gi&agrave;y kh&ocirc; ho&agrave;n to&agrave;n trong v&agrave;i ng&agrave;y trước khi tiếp tục đi gi&agrave;y tr&ecirc;n ch&acirc;n. Bảo vệ ch&acirc;n bạn cũng c&oacute; thể bảo vệ gi&agrave;y bạn.</p>\r\n\r\n<h2>2. L&agrave;m thế n&agrave;o để gi&agrave;y kh&ocirc;ng bị g&atilde;y mũi khi mang</h2>\r\n\r\n<p>Đầu ti&ecirc;n, chắc chắn l&agrave; về bản th&acirc;n đ&ocirc;i gi&agrave;y. Đa số c&aacute;c sản phẩm n&agrave;y đều được tổng hợp từ nhiều yếu tố kh&aacute;c nhau. Nếu tay nghề chất lượng v&agrave; chất liệu tốt sẽ cho ra một đ&ocirc;i gi&agrave;y chất lượng v&agrave; ngược lại, tay nghề k&eacute;m v&agrave; chất liệu dỏm cũng sẽ cho ra sản phẩm dỏm. Nếu bạn muốn mua được đ&ocirc;i gi&agrave;y sẽ kh&ocirc;ng hằn vết, h&atilde;y t&igrave;m kiếm hai yếu tố sau khi mua gi&agrave;y mới:</p>\r\n\r\n<h3>2.1 Chất lượng</h3>\r\n\r\n<p>Sản phẩm thương hiệu kh&ocirc;ng nổi tiếng thường c&oacute; chất lượng thấp hơn. Sản phẩm cao cấp thường sử dụng chất liệu cao cấp. Đ&acirc;y kh&ocirc;ng phải l&agrave; nguy&ecirc;n tắc v&agrave;ng l&uacute;c n&agrave;o cũng đ&uacute;ng, nhưng thường th&igrave; kh&aacute; đ&aacute;ng tin cậy.</p>\r\n\r\n<p>Một số nguy&ecirc;n tắc chung khi kiểm tra chất lượng gi&agrave;y:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Nhiều mẫu gi&agrave;y chất lượng cao c&oacute; xu hướng được may chứ kh&ocirc;ng phải d&aacute;n v&agrave;o nhau.</p>\r\n	</li>\r\n	<li>\r\n	<p>Đường viền b&ecirc;n trong phải gọn g&agrave;ng, (hầu như) kh&ocirc;ng c&oacute; lỗi.&nbsp;</p>\r\n	</li>\r\n	<li>\r\n	<p>Lu&ocirc;n kiểm tra hai b&ecirc;n gi&agrave;y c&oacute; đối xứng kh&ocirc;ng</p>\r\n	</li>\r\n	<li>\r\n	<p>Ngắm kỹ chất liệu gi&agrave;y. Chất liệu n&agrave;y c&oacute; phải l&agrave; phi&ecirc;n bản tốt nhất kh&ocirc;ng?&nbsp;</p>\r\n	</li>\r\n	<li>\r\n	<p>H&atilde;y lu&ocirc;n nhớ lượng nhựa c&agrave;ng nhiều, chất lượng thường c&agrave;ng thấp hơn.&nbsp;</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><img alt=\"cach-mang-giay-de-khong-bi-gay-mui-giay-2.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/cach_mang_giay_de_khong_bi_gay_mui_giay_2_25203f32b5.jpg\" /></p>\r\n\r\n<h3>2.2 Độ vừa vặn</h3>\r\n\r\n<p>Gi&agrave;y vừa vặn với ch&acirc;n thường &iacute;t g&acirc;y vết hằn qu&aacute; nặng. Nếu gi&agrave;y &ocirc;m s&aacute;t quanh ch&acirc;n bạn th&igrave; chất liệu gi&agrave;y kh&ocirc;ng bị dồn ứ qu&aacute; nhiều v&agrave;o một chỗ, v&agrave; gi&agrave;y sẽ giữ d&aacute;ng tốt hơn v&agrave; l&acirc;u hơn. Mặt kh&aacute;c, d&ugrave; bạn đi lại hay chuyển động thế n&agrave;o, bạn sẽ lu&ocirc;n g&acirc;y ra vết hằn tr&ecirc;n những đ&ocirc;i gi&agrave;y qu&aacute; chật hoặc rộng so với ch&acirc;n m&igrave;nh.</p>\r\n\r\n<h2>3. C&aacute;c vật dụng gi&uacute;p hạn chế t&igrave;nh trạng gi&agrave;y g&atilde;y mũi&nbsp;</h2>\r\n\r\n<h3>3.1 Kem, s&aacute;p, v&agrave; chất dưỡng da</h3>\r\n\r\n<p>Kem, s&aacute;p v&agrave; chất dưỡng c&oacute; thể c&oacute; v&agrave;i đặc điểm tương đồng, nhưng về cơ bản th&igrave; ho&agrave;n to&agrave;n kh&aacute;c biệt.</p>\r\n\r\n<p>C&oacute; lẽ bạn đ&atilde; nghe thấy cụm từ &ldquo;dụng cụ đ&aacute;nh gi&agrave;y&rdquo;. Kem gi&agrave;y v&agrave; xi đ&aacute;nh gi&agrave;y thuộc ph&acirc;n loại n&agrave;y. C&aacute;c c&ocirc;ng cụ n&agrave;y gi&uacute;p gi&agrave;y bạn s&aacute;ng b&oacute;ng hơn, nhưng ngo&agrave;i ra c&ograve;n c&oacute; c&ocirc;ng dụng kh&aacute;c nữa. Cả hai sản phẩm đều c&oacute; lượng m&agrave;u đậm, gi&uacute;p che phủ c&aacute;c dấu vết khuyết điểm c&oacute; thể c&oacute; tr&ecirc;n bề mặt gi&agrave;y bạn.</p>\r\n\r\n<p>Điều n&agrave;y kh&aacute;c với chất dưỡng da. N&oacute; kh&ocirc;ng l&agrave;m gi&agrave;y s&aacute;ng b&oacute;ng nhưng thay v&agrave;o đ&oacute; kh&ocirc;i phục lượng dầu trong da, giữ da gi&agrave;y được mềm v&agrave; ẩm, cũng như h&igrave;nh th&agrave;nh lớp kh&oacute;a ẩm cho gi&agrave;y. Nhược điểm của chất dưỡng da l&agrave; khả năng v&ocirc; t&igrave;nh l&agrave;m tối đi v&agrave; nổi bật l&ecirc;n c&aacute;c khuyết điểm n&agrave;y.</p>\r\n\r\n<p><img alt=\"cach-mang-giay-de-khong-bi-gay-mui-giay-5.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/cach_mang_giay_de_khong_bi_gay_mui_giay_5_3a7b59bd23.jpg\" style=\"width:500px\" /></p>\r\n\r\n<p>S&aacute;p giống kem gi&agrave;y hơn l&agrave; chất dưỡng da. S&aacute;p cũng l&agrave;m gi&agrave;y s&aacute;ng b&oacute;ng nhưng thường kh&ocirc;ng c&oacute; dầu hoặc c&aacute;c t&iacute;nh chất phủ m&agrave;u như kem. S&aacute;p gi&agrave;y gi&uacute;p gi&agrave;y tr&ocirc;ng s&aacute;ng b&oacute;ng như gương, cũng như tạo một lớp bảo vệ gi&agrave;y kh&ocirc;ng bị ẩm, kh&ocirc;ng tiếp x&uacute;c trực tiếp với &aacute;nh s&aacute;ng, cũng như kh&ocirc;ng bị trầy xước.&nbsp;</p>\r\n\r\n<p>Tuy nhi&ecirc;n, h&atilde;y cẩn thận đừng b&ocirc;i qu&aacute; nhiều s&aacute;p l&ecirc;n gi&agrave;y v&igrave; việc n&agrave;y c&oacute; thể khiến gi&agrave;y mất đi độ linh hoạt v&agrave; l&agrave;m s&aacute;p bị nứt, sẽ tr&ocirc;ng c&ograve;n xấu hơn gi&agrave;y c&oacute; nếp hằn.&nbsp;</p>\r\n\r\n<h3>3.2 Shoetree - c&acirc;y giữ form gi&agrave;y</h3>\r\n\r\n<p>Bạn cũng c&oacute; thể sử dụng shoe tree. Đ&acirc;y l&agrave; c&ocirc;ng cụ d&ugrave;ng cho v&agrave;o b&ecirc;n trong gi&agrave;y khi bạn kh&ocirc;ng sử dụng đến gi&uacute;p gi&agrave;y hạn chế t&igrave;nh trạng g&atilde;y mũi.</p>\r\n\r\n<p>Shoe tree tốt nhất được l&agrave;m bằng gỗ c&acirc;y tuyết t&ugrave;ng. Loại n&agrave;y vừa giữ d&aacute;ng tốt cho gi&agrave;y, vừa h&uacute;t ẩm tốt. H&atilde;y d&ugrave;ng shoe tree để vừa h&uacute;t hết lượng ẩm thừa, vừa hỗ trợ n&acirc;ng đỡ gi&agrave;y ho&agrave;n hảo.</p>\r\n\r\n<p><a href=\"https://extrim.vn/san-pham/shoe-tree-nhua-nam-nu\" rel=\"noopener noreferrer\" target=\"_blank\">Shoe tree l&agrave;m bằng nhựa</a>&nbsp;cũng rất đ&aacute;ng sử dụng nếu bạn kh&ocirc;ng muốn sử dụng gỗ c&acirc;y tuyết t&ugrave;ng. D&ugrave; kh&ocirc;ng hữu &iacute;ch bằng nhưng shoe tree nhựa cũng c&oacute; hiệu quả.</p>\r\n\r\n<p><img alt=\"cach-mang-giay-de-khong-bi-gay-mui-giay-4.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/cach_mang_giay_de_khong_bi_gay_mui_giay_4_d2e396d81b.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<h3>3.3 Shoeshield - Miếng silicone gi&uacute;p gi&agrave;y kh&ocirc;ng g&atilde;y mũi&nbsp;</h3>\r\n\r\n<p>Đ&uacute;ng thật l&agrave; c&oacute; miếng sillicone bảo vệ gi&agrave;y, hay c&ograve;n gọi l&agrave;&nbsp;<a href=\"https://extrim.vn/san-pham/bo-bao-ve-mui-giay-don-chong-nhan-gay-nut-shoe-shield\" rel=\"noopener noreferrer\" target=\"_blank\">shoeshield</a>. Gi&uacute;p gi&agrave;y kh&ocirc;ng bị hằn nếp ở mũi. Nhưng đ&uacute;ng ra m&agrave; n&oacute;i, đ&acirc;y chỉ l&agrave; một dạng shoe tree thu nhỏ được sử dụng b&ecirc;n trong gi&agrave;y khi bạn bước đi. C&oacute; một v&agrave;i người rất m&ecirc; m&oacute;n đồ n&agrave;y, nhưng những người kh&aacute;c kh&ocirc;ng th&iacute;ch lắm.</p>\r\n\r\n<p>Loại n&agrave;y kh&ocirc;ng ho&agrave;n hảo v&agrave; c&oacute; thể g&acirc;y kh&oacute; chịu. Hơn nữa, miếng sillicone n&agrave;y c&oacute; thể l&agrave;m gi&atilde;n gi&agrave;y bạn. Ngo&agrave;i ra, nếu độn miếng sillicone n&agrave;y v&agrave;o trong m&agrave; gi&agrave;y bạn vẫn vừa vặn thoải m&aacute;i. Đ&acirc;y c&oacute; thể l&agrave; dấu hiệu cho thấy gi&agrave;y bạn đang qu&aacute; rộng. Thế n&ecirc;n mọi người vẫn ưa chuộng shoe tree hơn.</p>\r\n\r\n<p><img alt=\"cach-mang-giay-de-khong-bi-gay-mui-giay-3.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/cach_mang_giay_de_khong_bi_gay_mui_giay_3_c425503868.jpg\" style=\"width:750px\" /></p>\r\n\r\n<h2>4. C&aacute;ch giữ gi&agrave;y kh&ocirc;ng g&atilde;y mũi khi bước đi</h2>\r\n\r\n<p>C&aacute;ch đầu ti&ecirc;n v&agrave; nhanh nhất l&agrave; giảm &aacute;p lực l&ecirc;n ng&oacute;n ch&acirc;n khi bước đi. H&atilde;y đảm bảo khi đi bộ, g&oacute;t ch&acirc;n bạn chạm đất trước.</p>\r\n\r\n<p>C&aacute;ch thứ hai l&agrave; phải đảm bảo gi&agrave;y bạn chất lượng tốt v&agrave; vừa vặn với ch&acirc;n. Gi&agrave;y rẻ tiền sẽ bị hằn nếp, cũ đi, v&agrave; vẻ ngo&agrave;i thường nhanh xuống cấp. Gi&agrave;y chất lượng cao được l&agrave;m từ chất liệu bền bỉ, cũng như vừa vặn với ch&acirc;n bạn hơn. Gi&agrave;y vừa vặn cũng gi&uacute;p ngăn tạo ra th&ecirc;m nếp hằn khi bạn bước đi.</p>\r\n\r\n<p>Thứ ba, một kh&iacute;a cạnh quan trọng của chăm s&oacute;c gi&agrave;y ch&iacute;nh l&agrave; chiến đấu với độ ẩm. H&atilde;y đảm bảo m&igrave;nh c&oacute; nhiều đ&ocirc;i gi&agrave;y đi thay phi&ecirc;n nhau để mỗi đ&ocirc;i đều c&oacute; đủ thời gian nghỉ ngơi v&agrave; phơi kh&ocirc; r&aacute;o.<a href=\"https://extrim.vn/san-pham/cay-giu-form-giay-shoe-tree-nhua-co-lo-xo-de-dang-tuy-chinh-size-giay\" rel=\"noopener noreferrer\" target=\"_blank\">&nbsp;H&atilde;y tậu shoe tree</a>, nếu bạn muốn gi&agrave;y vẫn giữ phom d&aacute;ng tốt khi được hong kh&ocirc; v&agrave; chưa được sử dụng đến.</p>\r\n\r\n<p>Cuối c&ugrave;ng, h&atilde;y d&ugrave;ng chất dưỡng da để bảo vệ gi&agrave;y trước c&aacute;c yếu tố g&acirc;y hại. Một lớp h&agrave;ng r&agrave;o mỏng c&oacute; thể tạo n&ecirc;n sự kh&aacute;c biệt lớn cho gi&agrave;y của bạn.</p>\r\n\r\n<p>Bạn đ&atilde; sẵn s&agrave;ng để gi&agrave;y m&igrave;nh nh&igrave;n phẳng phiu, thơm tho v&agrave; sạch sẽ chưa? H&atilde;y nhớ c&aacute;c mẹo gi&uacute;p hạn chế gi&agrave;y g&atilde;y mũi v&agrave; bạn sẽ được trải nghiệm cảm gi&aacute;c đ&oacute; ngay.</p>\r\n\r\n<p>&nbsp;</p>', 1, '<p>Một người ăn mặc chỉnh chu sẽ rất để &yacute; về vẻ ngo&agrave;i của m&igrave;nh. Đồng nghĩa rằng họ sẽ chăm ch&uacute;t từ đầu đến ch&acirc;n, tức l&agrave; bao gồm cả gi&agrave;y d&eacute;p. Ai sở hữu gi&agrave;y chắc hẳn cũng thường lo lắng bản th&acirc;n tự g&acirc;y ra c&aacute;c vết hằn kh&ocirc;ng đẹp mắt tr&ecirc;n gi&agrave;y m&igrave;nh. Nhưng đừng lo, c&aacute;c mẹo sau đ&acirc;y sẽ gi&uacute;p bạn tr&aacute;nh được t&igrave;nh trạng gi&agrave;y g&atilde;y mũi.</p>', 'TẠI SAO GIÀY BỊ GÃY MŨI? CÁCH MANG GIÀY ĐỂ KHÔNG BỊ GÃY MŨI GIÀY', 'tai-sao-giay-bi-gay-mui-cach-mang-giay-de-khong-bi-gay-mui-giay', 'blog196.png', '2023-11-18 15:40:32', '2023-11-18 15:40:32'),
(2, '<h2><strong>1. Nike - thương hiệu ti&ecirc;n phong về đổi mới c&ocirc;ng nghệ gi&agrave;y</strong></h2>\r\n\r\n<h3><strong>1.1 Nike Air - C&ocirc;ng nghệ gi&agrave;y mang t&iacute;nh biểu tượng</strong></h3>\r\n\r\n<p>Nike đ&atilde; tạo n&ecirc;n nhiều &yacute; tưởng độc đ&aacute;o v&agrave; ti&ecirc;n phong trong ng&agrave;nh gi&agrave;y sneaker qua nhiều năm. C&ocirc;ng nghệ gi&agrave;y đ&aacute;ng ch&uacute; &yacute; nhất của họ chắc chắn l&agrave; phần đệm Air - một cải tiến mang t&iacute;nh biểu tượng. Đệm Air tạo ra cảm gi&aacute;c &ecirc;m &aacute;i v&agrave; như đang đi tr&ecirc;n m&acirc;y mỗi bước ch&acirc;n. C&ocirc;ng nghệ n&agrave;y được giới thiệu lần đầu bởi kỹ sư h&agrave;ng kh&ocirc;ng Frank Rudy v&agrave;o năm 1977. V&agrave; đ&atilde; trở th&agrave;nh phần quan trọng của hầu hết c&aacute;c sản phẩm gi&agrave;y Nike sau đ&oacute;.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, kh&ocirc;ng giữ nguy&ecirc;n sự ph&aacute;t triển của c&ocirc;ng nghệ. Nike vẫn kh&ocirc;ng ngừng nghi&ecirc;n cứu v&agrave; cải tiến. Điều n&agrave;y đ&atilde; dẫn đến việc Tinker Hatfield đưa ra c&ocirc;ng nghệ Air Max - một bước tiến mới về cảm nhận v&agrave; thiết kế của đệm Air. C&ocirc;ng nghệ Air Max tạo ra một khả năng quan s&aacute;t đ&aacute;ng kinh ngạc. Người mang c&oacute; thể nh&igrave;n thấy đệm Air b&ecirc;n trong gi&agrave;y. Điều n&agrave;y kh&ocirc;ng chỉ mang t&iacute;nh thẩm mỹ m&agrave; c&ograve;n cải thiện hiệu suất v&agrave; trải nghiệm của người d&ugrave;ng. Sự ph&aacute;t triển n&agrave;y chứng tỏ rằng c&ocirc;ng nghệ sneaker kh&ocirc;ng ngừng tiến xa v&agrave; lu&ocirc;n c&oacute; khả năng th&uacute;c đẩy sự đổi mới trong ng&agrave;nh.<br />\r\nNgo&agrave;i ra, kh&ocirc;ng thể kh&ocirc;ng kể th&ecirc;m một số c&aacute;c c&ocirc;ng nghệ gi&agrave;y si&ecirc;u đỉnh kh&aacute;c của Nike về hệ thống đệm l&oacute;t gi&agrave;y si&ecirc;u &ecirc;m như: Zoom &ndash; React &ndash; Joyride</p>\r\n\r\n<h3><strong>1.2 FlyEase &ndash; d&acirc;y thắt gi&agrave;y kh&ocirc;ng c&ograve;n l&agrave; vấn đề kh&oacute; khăn</strong></h3>\r\n\r\n<p>&nbsp;Hệ thống tự thắt d&acirc;y Adapt của Nike l&agrave; một ấn tượng với t&iacute;nh ho&agrave;i niệm đến Marty McFly. Nhưng vẫn c&ograve;n kh&aacute; nhiều kh&ocirc;ng gian để tối ưu h&oacute;a. Tuy nhi&ecirc;n, c&ocirc;ng nghệ FlyEase đ&atilde; thể hiện sự vượt trội hơn nhiều. Với c&ocirc;ng nghệ n&agrave;y, người d&ugrave;ng c&oacute; khả năng mang gi&agrave;y chỉ bằng một tay hoặc thậm ch&iacute; xỏ ch&uacute;ng bằng ch&acirc;n m&agrave; kh&ocirc;ng cần sự hỗ trợ của tay. Điều n&agrave;y thực sự tạo ra một sự thuận tiện lớn cho những người c&oacute; khả năng vận động hạn chế. Hoặc kh&ocirc;ng thể sử dụng tay một c&aacute;ch th&ocirc;ng thường. C&ocirc;ng nghệ FlyEase đưa ra một ti&ecirc;u chuẩn mới về t&iacute;nh tiện lợi v&agrave; sự tiện dụng trong thiết kế gi&agrave;y sneaker.</p>\r\n\r\n<p><img alt=\"giai-ma-nhung-cong-nghe-giay-sneaker-nang-niu-doi-chan-ban-1.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/giai_ma_nhung_cong_nghe_giay_sneaker_nang_niu_doi_chan_ban_1_41d2c4c3de.jpg\" style=\"width:500px\" /></p>\r\n\r\n<h3><strong>1.3 Th&acirc;n gi&agrave;y trước Flyknit&nbsp;</strong></h3>\r\n\r\n<p>&nbsp;C&ocirc;ng nghệ Flyknit thật sự mang đến những ưu điểm nổi bật như tho&aacute;ng m&aacute;t, nhẹ nh&agrave;ng v&agrave; thiết kế đẹp mắt. Điều th&uacute; vị về c&ocirc;ng nghệ n&agrave;y ch&iacute;nh l&agrave; to&agrave;n bộ phần th&acirc;n gi&agrave;y trước của sneaker được tạo th&agrave;nh từ một mảnh vải dệt liền mạch. Điều n&agrave;y cho ph&eacute;p mỗi phần của gi&agrave;y được dệt theo c&aacute;ch tối ưu h&oacute;a để cung cấp sự hỗ trợ tốt nhất cho ch&acirc;n. C&ocirc;ng nghệ Flyknit kh&ocirc;ng chỉ mang lại cảm gi&aacute;c thoải m&aacute;i v&agrave; &ocirc;m vừa ch&acirc;n, m&agrave; c&ograve;n gi&uacute;p giảm thiểu sự cản trở v&agrave; tạo sự linh hoạt cho ch&acirc;n trong qu&aacute; tr&igrave;nh di chuyển</p>\r\n\r\n<h2><strong>2. Adidas tạo ra cuộc c&aacute;ch mạng c&ocirc;ng nghệ ng&agrave;nh gi&agrave;y sneaker</strong></h2>\r\n\r\n<h3><strong>2.1 Boots baby</strong></h3>\r\n\r\n<p>&nbsp;C&ocirc;ng nghệ Boost thực sự đ&atilde; tạo ra một cuộc c&aacute;ch mạng trong ng&agrave;nh c&ocirc;ng nghiệp gi&agrave;y sneaker. Khi thương hiệu ba sọc đang gặp kh&oacute; khăn, việc ra mắt c&ocirc;ng nghệ Boost đ&atilde; thay đổi trạng th&aacute;i đ&oacute; bằng việc tạo ra một loại đệm vượt trội về độ &ecirc;m &aacute;i v&agrave; thoải m&aacute;i. C&ocirc;ng nghệ n&agrave;y đ&atilde; gi&uacute;p tạo ra những đ&ocirc;i gi&agrave;y kh&ocirc;ng chỉ hấp dẫn về mặt thẩm mỹ m&agrave; c&ograve;n cung cấp trải nghiệm vượt trội cho người mang. Boost đ&atilde; nhanh ch&oacute;ng trở th&agrave;nh biểu tượng của sự thoải m&aacute;i trong ng&agrave;nh gi&agrave;y sneaker v&agrave; ảnh hưởng lớn đến việc t&aacute;i thiết lập vị thế của thương hiệu ba sọc.</p>\r\n\r\n<p><img alt=\"giai-ma-nhung-cong-nghe-giay-sneaker-nang-niu-doi-chan-ban-2.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/giai_ma_nhung_cong_nghe_giay_sneaker_nang_niu_doi_chan_ban_2_3c4e01fd38.jpg\" style=\"width:500px\" /></p>\r\n\r\n<h3><strong>2.2 Primeknit</strong></h3>\r\n\r\n<p>C&ocirc;ng nghệ gi&agrave;y Primeknit đ&atilde; mang đến một c&aacute;ch tiếp cận ho&agrave;n to&agrave;n mới trong thiết kế gi&agrave;y sneaker. Việc tạo ra phần th&acirc;n gi&agrave;y trước liền mảnh, giống như tất, kh&ocirc;ng chỉ tạo n&ecirc;n sự thoải m&aacute;i m&agrave; c&ograve;n tạo cảm gi&aacute;c như đang mặc thứ g&igrave; đ&oacute; v&ocirc; c&ugrave;ng nhẹ nh&agrave;ng v&agrave; tho&aacute;ng m&aacute;t tr&ecirc;n ch&acirc;n. C&ugrave;ng với c&ocirc;ng nghệ Boost, việc kết hợp giữa Boost v&agrave; Primeknit thực sự l&agrave; một sự kết hợp ho&agrave;n hảo. Mang lại trải nghiệm &ecirc;m &aacute;i v&agrave; thoải m&aacute;i cho người mang.</p>\r\n\r\n<p>Về Yeezy, đ&uacute;ng l&agrave; c&aacute;c mẫu gi&agrave;y trong d&ograve;ng Yeezy của Adidas đ&atilde; tạo ra sự đột ph&aacute; về thiết kế v&agrave; phối m&agrave;u. Đặc biệt l&agrave; trong c&aacute;c phối m&agrave;u độc đ&aacute;o v&agrave; th&uacute; vị. C&aacute;c mẫu Yeezy kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y, m&agrave; c&ograve;n l&agrave; biểu tượng thời trang. Ch&uacute;ng thể hiện sự c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch của người mang. Chắc chắn rằng việc chọn một phối m&agrave;u Yeezy y&ecirc;u th&iacute;ch sẽ mang lại cảm gi&aacute;c tự tin v&agrave; phong c&aacute;ch ri&ecirc;ng cho bạn.</p>\r\n\r\n<h3><strong>2.3 Futurecraft strung - tương lai của c&ocirc;ng nghệ gi&agrave;y sneaker?</strong></h3>\r\n\r\n<p>Adidas đ&atilde; kh&ocirc;ng ngừng đặt ra mục ti&ecirc;u c&aacute;ch mạng h&oacute;a ng&agrave;nh c&ocirc;ng nghiệp gi&agrave;y sneaker bằng việc ph&aacute;t triển c&aacute;c c&ocirc;ng nghệ ti&ecirc;n tiến. Mặc d&ugrave; c&ocirc;ng nghệ 4D Futurecraft đ&atilde; mang lại sự th&uacute; vị v&agrave; đột ph&aacute; trong thiết kế đế gi&agrave;y bằng in 3D. Nhưng họ vẫn tiếp tục đ&agrave;o s&acirc;u v&agrave;o nghi&ecirc;n cứu để đạt được những bước tiến mới. Một v&iacute; dụ r&otilde; r&agrave;ng l&agrave; c&ocirc;ng nghệ Futurecraft Strung. Đ&oacute; l&agrave; một c&aacute;ch tiếp cận ho&agrave;n to&agrave;n mới trong việc sản xuất gi&agrave;y c&oacute; th&acirc;n gi&agrave;y trước liền mảnh.C&ocirc;ng nghệ Strung kh&ocirc;ng chỉ l&agrave; việc dệt thoi truyền thống. M&agrave; l&agrave; một c&aacute;ch tiếp cận s&aacute;ng tạo v&agrave; nghệ thuật để tạo ra vải cho gi&agrave;y.</p>\r\n\r\n<p>Sự kết hợp giữa việc sử dụng c&aacute;c sợi chất liệu ch&iacute;nh x&aacute;c v&agrave; kỹ thuật cắt dệt độc đ&aacute;o đ&atilde; tạo ra những mẫu gi&agrave;y c&oacute; th&acirc;n trước liền mảnh với sự linh hoạt v&agrave; độ tương th&iacute;ch tốt hơn với h&igrave;nh d&aacute;ng của ch&acirc;n người mang. Sự cam kết của Adidas trong việc thử nghiệm v&agrave; &aacute;p dụng những c&ocirc;ng nghệ mới n&agrave;y chắc chắn sẽ mang lại những đột ph&aacute; đầy th&uacute; vị trong tương lai cho ng&agrave;nh c&ocirc;ng nghiệp gi&agrave;y sneaker.</p>\r\n\r\n<h2><strong>3. Asics</strong></h2>\r\n\r\n<h3><strong>3.1 C&ocirc;ng nghệ gi&agrave;y Asics Gel&nbsp;</strong></h3>\r\n\r\n<p>Phần gel trong gi&agrave;y đ&oacute;ng vai tr&ograve; giảm sốc theo một c&aacute;ch rất kh&aacute;c biệt. Gi&uacute;p b&agrave;n ch&acirc;n người chạy được thoải m&aacute;i hơn rất nhiều. Thường th&igrave; phần bị ảnh hưởng nhiều nhất ở b&agrave;n ch&acirc;n l&agrave; phần mũi ch&acirc;n v&agrave; g&oacute;t ch&acirc;n. N&ecirc;n đ&oacute; ch&iacute;nh x&aacute;c l&agrave; những nơi bạn sẽ t&igrave;m thấy c&ocirc;ng nghệ Asics Gel.</p>\r\n\r\n<p><img alt=\"giai-ma-nhung-cong-nghe-giay-sneaker-nang-niu-doi-chan-ban-3.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/giai_ma_nhung_cong_nghe_giay_sneaker_nang_niu_doi_chan_ban_3_31b6fcc5be.jpg\" style=\"width:500px\" /></p>\r\n\r\n<h3><strong>3.2 Flytefoam</strong></h3>\r\n\r\n<p>Theo như h&atilde;ng sneaker, Flytefoam giải quyết vấn đề gi&agrave;y nhẹ m&agrave; kh&ocirc;ng phải hi sinh đệm tốt. Thế n&ecirc;n khi bạn c&oacute; loại đế giữa n&agrave;y, bạn sẽ được một đ&ocirc;i gi&agrave;y nhẹ ch&acirc;n nhưng vẫn c&oacute; cảm gi&aacute;c thoải m&aacute;i nhất khi mang.</p>\r\n\r\n<h2><strong>4. Reebok cũng tham gia v&agrave;o &ldquo;cuộc chiến&rdquo; c&ocirc;ng nghệ gi&agrave;y</strong></h2>\r\n\r\n<p>C&ocirc;ng nghệ đệm gi&agrave;y Hexalite lấy cảm hứng từ tổ ong. C&ocirc;ng nghệ c&oacute; từ năm 1990 n&agrave;y gi&uacute;p ph&acirc;n t&aacute;n lực sốc, v&agrave; đ&atilde; được sử dụng tr&ecirc;n nhiều loại sneaker kh&aacute;c nhau! D&ugrave; c&oacute; nhiều c&ocirc;ng nghệ đệm mới hơn nhưng loại đệm kinh điển n&agrave;y vẫn kh&aacute; quan trọng.</p>\r\n\r\n<p><img alt=\"giai-ma-nhung-cong-nghe-giay-sneaker-nang-niu-doi-chan-ban-4.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/giai_ma_nhung_cong_nghe_giay_sneaker_nang_niu_doi_chan_ban_4_fcee07d945.jpg\" style=\"width:500px\" /></p>\r\n\r\n<p>Ng&agrave;nh c&ocirc;ng nghiệp gi&agrave;y sneaker lu&ocirc;n tiến xa v&agrave; kh&ocirc;ng ngừng ph&aacute;t triển. Mỗi thương hiệu đều c&oacute; vai tr&ograve; đặc biệt trong việc đ&oacute;ng g&oacute;p c&aacute;c c&ocirc;ng nghệ đột ph&aacute; v&agrave; tiến bộ. C&aacute;c c&ocirc;ng nghệ n&agrave;y kh&ocirc;ng chỉ mang lại sự thoải m&aacute;i v&agrave; hiệu suất tốt hơn cho người mang. M&agrave; c&ograve;n tạo n&ecirc;n những thiết kế độc đ&aacute;o v&agrave; đẹp mắt. Một số c&ocirc;ng nghệ c&oacute; thể trở th&agrave;nh huyền thoại v&agrave; tồn tại m&atilde;i m&atilde;i trong lịch sử. Trong khi những c&ocirc;ng nghệ kh&aacute;c c&oacute; thể bị thay thế hoặc cải tiến để đ&aacute;p ứng nhu cầu thay đổi của thị trường v&agrave; người ti&ecirc;u d&ugrave;ng. Qu&aacute; tr&igrave;nh n&agrave;y l&agrave; một sự kết hợp giữa s&aacute;ng tạo, kỹ thuật v&agrave; phản hồi từ người ti&ecirc;u d&ugrave;ng, gi&uacute;p ng&agrave;nh c&ocirc;ng nghiệp gi&agrave;y sneaker lu&ocirc;n sống động v&agrave; đa dạng.</p>', 1, '<p>Trong x&atilde; hội hiện đại, c&ocirc;ng nghệ v&agrave; kỹ thuật đang ph&aacute;t triển với tốc độ ch&oacute;ng mặt. V&agrave; ng&agrave;nh c&ocirc;ng nghiệp sneaker cũng kh&ocirc;ng nằm ngo&agrave;i xu hướng n&agrave;y. D&agrave;nh thời gian để nắm vững những sự thay đổi, nghi&ecirc;n cứu v&agrave; hiểu r&otilde; về c&ocirc;ng nghệ mới l&agrave; điều quan trọng để kh&ocirc;ng bị bỏ lại ph&iacute;a sau. B&agrave;i viết n&agrave;y kh&ocirc;ng chỉ giới thiệu về những t&ecirc;n tuổi lớn trong ng&agrave;nh sneaker. M&agrave; c&ograve;n tập trung v&agrave;o việc t&oacute;m gọn những c&ocirc;ng nghệ sản xuất v&agrave; thiết kế gi&agrave;y sneaker đang nổi bật hiện nay. Việc hiểu r&otilde; về những xu hướng v&agrave; c&aacute;ch m&agrave; c&ocirc;ng nghệ ảnh hưởng đến qu&aacute; tr&igrave;nh sản xuất v&agrave; thiết kế gi&agrave;y sneaker sẽ gi&uacute;p bạn c&oacute; c&aacute;i nh&igrave;n tổng quan về sự ph&aacute;t triển của ng&agrave;nh n&agrave;y.</p>', 'GIẢI MÃ NHỮNG CÔNG NGHỆ GIÀY SNEAKER NÂNG NIU ĐÔI CHÂN BẠN!', 'giai-ma-nhung-cong-nghe-giay-sneaker-nang-niu-doi-chan-ban', 'blog213.png', '2023-11-18 15:43:27', '2023-11-18 15:43:27'),
(3, '<h2>D&ograve;ng gi&agrave;y Jordan 1 High</h2>\r\n\r\n<p>C&oacute; thể số người nh&igrave;n thấy sự xuất hiện của những đ&ocirc;i Jordan 1 High c&ograve;n nhiều hơn cả số người nhận biết t&ecirc;n v&agrave; những phi&ecirc;n bản của d&ograve;ng thiết kế n&agrave;y. Kh&ocirc;ng chỉ giới hạn trong giới mộ điệu b&oacute;ng rổ truyền thống, Jordan 1 High với nhiều phi&ecirc;n bản c&oacute; thể xuất hiện tr&ecirc;n trang đầu tạp ch&iacute;, tr&ecirc;n mạng x&atilde; hội của người nổi tiếng hay khắp phố phường.</p>\r\n\r\n<p>Thiết kế của d&ograve;ng sản phẩm n&agrave;y kh&ocirc;ng thật sự đặc biệt v&agrave; được đ&aacute;nh gi&aacute; cao. Tuy nhi&ecirc;n, ch&iacute;nh nhờ những mảng trống tr&ecirc;n th&acirc;n gi&agrave;y tạo n&ecirc;n &ldquo;s&acirc;n chơi&rdquo; đa dạng m&agrave;u sắc l&agrave; mấu chốt khiến Jordan 1 High ghi điểm tuyệt đối với c&aacute;c t&iacute;n đồ thời trang.</p>\r\n\r\n<h2>1. Dark Mocha</h2>\r\n\r\n<p><img alt=\"Jordan-1-Retro-High-Dark-Mocha\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Jordan_1_Retro_High_Dark_Mocha_1_205b77c789.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Mẫu Jordan 1 High Dark Mocha được ra mắt rất đ&uacute;ng thời điểm ở Mỹ, cụ thể l&agrave; v&agrave;o 31 th&aacute;ng 10, 2020. Mẫu gi&agrave;y n&agrave;y được bắt đầu b&agrave;y b&aacute;n khi nhiều d&acirc;n chơi sneaker bắt đầu nảy ra &yacute; nghĩ rằng c&aacute;c mẫu gi&agrave;y m&agrave;u trung t&iacute;nh được b&aacute;n với số lượng giới hạn c&oacute; lẽ l&agrave; c&aacute;ch để mở ra một điều g&igrave; đ&oacute; mới mẻ cho giới sneaker đ&atilde; sắp trở n&ecirc;n b&atilde;o h&ograve;a. Đ&acirc;y l&agrave; l&yacute; do Dark Mocha được đ&oacute;n nhận nồng nhiệt như một dấu ấn cho sự ti&ecirc;n phong trong giới sneaker.</p>\r\n\r\n<h2>2. Patent Bred</h2>\r\n\r\n<p><img alt=\"Nike jordan high Patent Bre\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Nike_jordan_high_Patent_Bred_249f8ffcee.png\" style=\"width:1000px\" /></p>\r\n\r\n<p>Một trong số những phi&ecirc;n bản phối m&agrave;u huyền thoại của Jordan 1 High kh&ocirc;ng thể kh&ocirc;ng kể đến l&agrave; Bred, Reverse Bred. Đen v&agrave; đỏ vốn l&agrave; một sự kết hợp cơ bản v&agrave; huyền thoại nhưng tr&ecirc;n chất liệu da b&oacute;ng th&igrave; thật sự l&agrave; một c&uacute; twist đầy ấn tượng.</p>\r\n\r\n<h2>3. &nbsp;Air Jordan 1 Zoom CMFT 2</h2>\r\n\r\n<p><img alt=\"Air Jordan 1 Zoom CMFT 2\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Air_Jordan_1_Zoom_CMFT_2_1d21bc251a.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Phối m&agrave;u University blue lu&ocirc;n lọt top c&aacute;c phi&ecirc;n bản được ưa chuộng nhất. Mẫu gi&agrave;y Zoom CMFT 2 lần n&agrave;y đ&atilde; một lần nữa khuấy đảo thị trường với phần th&acirc;n gi&agrave;y trước l&agrave;m từ da lộn độc đ&aacute;o.</p>\r\n\r\n<h2>4. Smoke Grey</h2>\r\n\r\n<p><img alt=\"Smoke Grey Jordan 1 High.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Smoke_Grey_Jordan_1_High_d5aedb9652.jpg\" style=\"width:500px\" /></p>\r\n\r\n<p>D&ugrave; nhiều người chọn phối m&agrave;u thật t&aacute;o bạo để g&acirc;y ấn tượng nhưng nhưng những d&acirc;n chơi sneaker thật sự sẽ kh&ocirc;ng cần m&agrave;u qu&aacute; nổi mới đủ g&acirc;y sự ch&uacute; &yacute;. Mẫu Smoke Grey Jordan 1 High nắm rất r&otilde; điều n&agrave;y. Bạn c&oacute; thể custom một v&agrave;i chi tiết, chỉ cần đổi m&agrave;u cổ gi&agrave;y m&agrave;u đỏ tr&ecirc;n nền m&agrave;u x&aacute;m đ&atilde; đủ khiến đ&ocirc;i gi&agrave;y trở n&ecirc;n cực kỳ nổi bật.</p>\r\n\r\n<h2>5. Lucky Green</h2>\r\n\r\n<p><img alt=\"Lucky Green Jordan High\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Lucky_Green_Jordan_High_08c960aa96.jpg\" style=\"width:750px\" /></p>\r\n\r\n<p>Được thiết kế để kỷ niệm trận đấu play-off ghi 63 điểm của Michael Jordan tại Boston v&agrave;o năm 1986, Jordan 1 High Lucky Green nổi bật với c&aacute;c mảng m&agrave;u xanh l&aacute; c&acirc;y tươi s&aacute;ng tr&ecirc;n nền da nguy&ecirc;n tấm m&agrave;u trắng v&agrave; c&aacute;c điểm nhấn m&agrave;u đen tr&ecirc;n Swoosh v&agrave; d&acirc;y gi&agrave;y.</p>\r\n\r\n<h2>6. Pink Glaze</h2>\r\n\r\n<p><img alt=\"Jordan-1-High-Pink Glaze\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Jordan_1_High_Pink_Glaze_06933b3e82.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Mẫu Jordan 1 High CMFT l&agrave; sự lựa chọn tốt cho những ai muốn đa dạng h&oacute;a tủ gi&agrave;y của m&igrave;nh. Sử dụng m&agrave;u hồng trong thời trang vốn kh&ocirc;ng hề đơn giản, chỉ cần chất liệu, c&aacute;ch phối hoặc sắc độ kh&ocirc;ng ph&ugrave; hợp, thiết kế sẽ tr&ocirc;ng qu&ecirc; m&ugrave;a, lỗi thời hoặc sến sẩm, di&ecirc;m d&uacute;a. V&agrave; thật may, Pink Glaze đ&atilde; l&agrave;m rất tốt điều n&agrave;y!&nbsp;</p>\r\n\r\n<h2>7. Court Purple</h2>\r\n\r\n<p><img alt=\"Court Purple Jordan 1 High\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Court_Purple_Jordan_1_High_92c8589e97.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Thay m&agrave;u đỏ từ mẫu Jordan 1 High Bred l&agrave; bạn c&oacute; ngay mẫu Court Purple. Ra mắt v&agrave;o th&aacute;ng 9 năm 2018, quay lại với kiểu d&aacute;ng cổ điển đ&atilde; mang đến một điểm nhấn mới mẻ cho d&ograve;ng gi&agrave;y n&agrave;y. C&aacute;c khối m&agrave;u sắc tối giản gi&uacute;p mẫu gi&agrave;y n&agrave;y trở n&ecirc;n linh hoạt, dễ phối đồ nhưng vẫn c&oacute; vẻ ngo&agrave;i ấn tượng.</p>\r\n\r\n<h2>8. Clay Green</h2>\r\n\r\n<p><img alt=\"Clay Green Jordan 1 High.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Clay_Green_Jordan_1_High_8f2be4a68a.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Phải n&oacute;i l&agrave; Clay Green l&agrave; một trong những phi&ecirc;n bản c&oacute; m&agrave;u sắc đẹp nhất trong c&aacute;c sản phẩm nh&agrave; Nike. Phần da lộn c&oacute; t&ocirc;ng m&agrave;u kh&aacute; &quot;bụi bặm&quot; ở g&oacute;t v&agrave; cổ gi&agrave;y khiến người ta c&oacute; thể ngắm m&atilde;i kh&ocirc;ng ch&aacute;n. Đế ngo&agrave;i v&agrave; Swoosh c&oacute; t&ocirc;ng m&agrave;u y hệt nhau, trở th&agrave;nh điểm nhấn ch&iacute;nh mang đến cho chủ nh&acirc;n vẻ ngo&agrave;i tr&ocirc;ng c&oacute; vẻ low-key. Th&uacute; vị nhưng b&iacute; ẩn v&agrave; kh&ocirc;ng hề ph&ocirc; trương.</p>\r\n\r\n<h2>9. Twist W Panda</h2>\r\n\r\n<p><img alt=\"Twist W Panda Jordan 1 High.jpg\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Twist_W_Panda_Jordan_1_High_54e3836b23.jpg\" style=\"width:1000px\" /></p>\r\n\r\n<p>Điểm đặc biệt của &ldquo;Twist Panda&rdquo; kh&ocirc;ng chỉ đến từ phối m&agrave;u trắng - đen vốn lu&ocirc;n được ưa chuộng v&agrave; cực k&igrave; dễ phối đồ. Mẫu gi&agrave;y n&agrave;y c&ograve;n được chế t&aacute;c tư chất liệu da lộn cao cấp với phần lớn diện t&iacute;ch bề mặt c&oacute; phủ l&ocirc;ng ngựa tổng hợp m&agrave;u đen mang đến cảm nhận mềm mại, ấm &aacute;p. Sự tương phản giữa hai t&ocirc;ng m&agrave;u trắng &ndash; đen đ&atilde; được Nike tận dụng triệt để trong thiết kế n&agrave;y.</p>\r\n\r\n<h2>10. Midnight Navy</h2>\r\n\r\n<p><img alt=\"Midnight Navy Jordan 1 High.png\" src=\"https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Midnight_Navy_Jordan_1_High_fe61eace57.png\" style=\"width:1000px\" /></p>\r\n\r\n<p>L&agrave; một phần trong &yacute; tưởng ​​Co.JP của Nike nhằm hồi sinh c&aacute;c phối m&agrave;u độc quyền của Nhật Bản cho thị trường rộng lớn hơn, Jordan 1 High Midnight Navy l&agrave; sản phẩm ưa th&iacute;ch của c&aacute;c nh&agrave; sưu tập. V&agrave; đặc biệt hơn hết, bạn kh&ocirc;ng cần phải bỏ số tiền qu&aacute; lớn để c&oacute; được mẫu gi&agrave;y n&agrave;y trong tủ gi&agrave;y của m&igrave;nh.</p>\r\n\r\n<p>Hy vọng b&agrave;i viết n&agrave;y gi&uacute;p bạn biết nhiều hơn về những phi&ecirc;n bản thuộc mẫu gi&agrave;y Jordan 1 High đ&atilde;, đang v&agrave; c&oacute; lẽ vẫn sẽ lu&ocirc;n được xem l&agrave; sự th&agrave;nh c&ocirc;ng của Nike.</p>', 1, '<p>Dưới đ&acirc;y l&agrave; danh s&aacute;ch những phi&ecirc;n bản g&oacute;p phần gi&uacute;p Nike Jordan 1 High giữ vững &ldquo;ng&ocirc;i vương&rdquo; trong l&ograve;ng người h&acirc;m mộ d&ograve;ng gi&agrave;y n&agrave;y.Từ những đ&ocirc;i gi&agrave;y phổ biến dễ tậu đến những bản thiết kế giới hạn. B&agrave;i viết sẽ gi&uacute;p bạn hiểu hơn về những đ&ocirc;i gi&agrave;y đ&igrave;nh đ&aacute;m đến từ Nike n&agrave;y.</p>', '10 BẢN PHỐI MÀU HUYỀN THOẠI CỦA DÒNG GIÀY NIKE JORDAN 1 HIGH', '10-ban-phoi-mau-huyen-thoai-cua-dong-giay-nike-jordan-1-high', 'blog39.png', '2023-11-18 15:45:44', '2023-11-18 15:45:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `idBrand` int(10) UNSIGNED NOT NULL,
  `BrandName` varchar(255) NOT NULL,
  `BrandSlug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`idBrand`, `BrandName`, `BrandSlug`, `created_at`, `updated_at`) VALUES
(1, 'NIKE', 'nike', '2023-11-14 16:04:34', '2023-11-14 16:04:34'),
(2, 'ADIDAS', 'adidas', '2023-11-14 16:04:36', '2023-11-14 16:04:36'),
(3, 'MLB', 'mlb', '2023-11-14 16:04:38', '2023-11-14 16:04:38'),
(4, 'Converse', 'converse', '2023-11-14 16:04:40', '2023-11-14 16:04:40'),
(5, 'New Balance', 'new-balance', '2023-11-14 16:04:42', '2023-11-14 16:04:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `idCart` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `idProAttr` int(11) UNSIGNED NOT NULL,
  `AttributeProduct` varchar(50) NOT NULL,
  `PriceNew` int(11) NOT NULL,
  `QuantityBuy` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`idCart`, `idCustomer`, `idProduct`, `idProAttr`, `AttributeProduct`, `PriceNew`, `QuantityBuy`, `Total`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 183, 'Size: 17', 1529000, 1, 1529000, '2023-12-07 12:01:10', '2023-12-07 12:01:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `idCategory` int(10) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategorySlug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`idCategory`, `CategoryName`, `CategorySlug`, `created_at`, `updated_at`) VALUES
(1, 'Giày Sneaker Nam', 'giay-sneaker-nam', '2023-11-14 16:01:51', '2023-11-14 16:01:51'),
(2, 'Giày Sneaker Nữ', 'giay-sneaker-nu', '2023-11-14 16:01:59', '2023-11-14 16:01:59'),
(3, 'Giày Sneaker Trẻ Em', 'giay-sneaker-tre-em', '2023-11-14 16:04:18', '2023-11-14 16:04:18'),
(4, 'Phụ kiện', 'phu-kien', '2023-11-14 16:04:20', '2023-11-14 16:04:20'),
(5, 'Dép Nam', 'dep-nam', '2023-11-14 16:04:22', '2023-11-14 16:04:22'),
(6, 'Dép Nữ', 'dep-nu', '2023-11-14 16:04:25', '2023-11-14 16:04:25'),
(7, 'Giày Sneaker Unisex', 'giay-sneaker-unisex', '2023-11-14 16:08:07', '2023-11-14 16:08:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CustomerName` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`idCustomer`, `username`, `password`, `PhoneNumber`, `CustomerName`, `created_at`, `updated_at`) VALUES
(1, 'Thao09', '25d55ad283aa400af464c76d713c07ad', '0794646588', 'Trần Thị Thông Thảo', '2023-11-15 14:35:56', '2023-11-30 12:45:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_14_130030_create_tbl_product_table', 2),
(6, '2023_11_14_130234_create_brand_table', 2),
(7, '2023_11_14_130234_create_saleproduct_table', 2),
(8, '2023_11_14_130235_create_attribute_table', 2),
(9, '2023_11_14_130235_create_attributevalue_table', 2),
(10, '2023_11_14_130235_create_category_table', 2),
(11, '2023_11_14_130236_create_admin_table', 2),
(12, '2023_11_14_130236_create_productattribute_table', 2),
(13, '2023_11_14_130236_create_productimage_table', 2),
(14, '2023_11_14_130237_create_bill_table', 2),
(15, '2023_11_14_130237_create_billinfo_table', 2),
(16, '2023_11_14_130238_create_cart_table', 2),
(17, '2023_11_14_130238_create_compare_table', 2),
(18, '2023_11_14_130238_create_wishlist_table', 2),
(19, '2023_11_14_130239_create_blog_table', 2),
(20, '2023_11_14_130239_create_customer_table', 2),
(21, '2023_11_14_130239_create_voucher_table', 2),
(22, '2023_11_14_130240_create_addresscustomer_table', 2),
(23, '2023_11_14_130240_create_billhistory_table', 2),
(24, '2023_11_14_130240_update_product_table', 2),
(32, '2014_10_12_100000_create_password_resets_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `idProduct` int(10) UNSIGNED NOT NULL,
  `idCategory` int(11) UNSIGNED NOT NULL,
  `idBrand` int(11) UNSIGNED NOT NULL,
  `QuantityTotal` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductSlug` varchar(255) NOT NULL,
  `DesProduct` longtext NOT NULL,
  `ShortDes` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Sold` int(11) NOT NULL DEFAULT 0,
  `StatusPro` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`idProduct`, `idCategory`, `idBrand`, `QuantityTotal`, `ProductName`, `ProductSlug`, `DesProduct`, `ShortDes`, `Price`, `Sold`, `StatusPro`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 70, 'Nike Air Force 1 \'07', 'nike-air-force-1-07', '<p style=\"text-align:start\"><strong>PHONG C&Aacute;CH HUYỀN THOẠI TINH TẾ.</strong></p>\r\n\r\n<p>Sự rạng rỡ vẫn tồn tại trong Nike Air Force 1 &#39;07, phi&ecirc;n bản b&oacute;ng rổ nguy&ecirc;n bản mang đến sự thay đổi mới mẻ về những g&igrave; bạn biết r&otilde; nhất: lớp phủ được kh&acirc;u bền, lớp ho&agrave;n thiện gọn g&agrave;ng v&agrave; lượng đ&egrave;n flash ho&agrave;n hảo gi&uacute;p bạn tỏa s&aacute;ng.</p>\r\n\r\n<p><strong>Những lợi &iacute;ch:</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">C&aacute;c lớp phủ được kh&acirc;u ở ph&iacute;a tr&ecirc;n tăng th&ecirc;m phong c&aacute;ch di sản, độ bền v&agrave; khả năng hỗ trợ.</li>\r\n	<li style=\"list-style-type:none\">Được thiết kế ban đầu cho c&aacute;c v&ograve;ng thi đấu, đệm Nike Air tăng th&ecirc;m trọng lượng nhẹ, sự thoải m&aacute;i cả ng&agrave;y.</li>\r\n	<li style=\"list-style-type:none\">Kiểu d&aacute;ng cắt thấp mang lại vẻ ngo&agrave;i gọn g&agrave;ng, hợp l&yacute;.</li>\r\n	<li style=\"list-style-type:none\">Cổ &aacute;o c&oacute; đệm tạo cảm gi&aacute;c mềm mại v&agrave; thoải m&aacute;i.</li>\r\n	<li style=\"list-style-type:none\">&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>Th&ocirc;ng tin chi tiết sản phẩm:</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Đế giữa xốp</li>\r\n	<li style=\"list-style-type:none\">C&aacute;c vết thủng ở ng&oacute;n ch&acirc;n</li>\r\n	<li style=\"list-style-type:none\">Đế cao su</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Trắng/Trắng</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: CW2288-111</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Việt Nam, Ấn Độ</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', '<p style=\"text-align:start\"><span style=\"font-family:&quot;Helvetica Now Text&quot;,Helvetica,Arial,sans-serif\"><span style=\"color:#111111\"><span style=\"background-color:#ffffff\">Sự rạng rỡ vẫn tồn tại trong Nike Air Force 1 &#39;07, phi&ecirc;n bản b&oacute;ng rổ nguy&ecirc;n bản mang đến sự thay đổi mới mẻ về những g&igrave; bạn biết r&otilde; nhất: lớp phủ được kh&acirc;u bền, lớp ho&agrave;n thiện gọn g&agrave;ng v&agrave; lượng đ&egrave;n flash ho&agrave;n hảo gi&uacute;p bạn tỏa s&aacute;ng.</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:disc\">M&agrave;u sắc hiển thị: Trắng/Trắng</li>\r\n	<li style=\"list-style-type:disc\">Phong c&aacute;ch: CW2288-111</li>\r\n</ul>', 2929000, 0, 1, '2023-12-07 11:22:04', '2023-12-07 11:23:27'),
(2, 3, 1, 70, 'Jordan 1 Mid SE', 'jordan-1-mid-se', '<p style=\"text-align:start\"><strong>Những lợi &iacute;ch</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Lực k&eacute;o g&oacute;t ch&acirc;n gi&uacute;p mang gi&agrave;y v&agrave;o v&agrave; cởi ra khỏi b&agrave;n ch&acirc;n nhỏ.</li>\r\n	<li style=\"list-style-type:none\">Da ở ph&iacute;a tr&ecirc;n mang lại độ bền v&agrave; cấu tr&uacute;c.</li>\r\n	<li style=\"list-style-type:none\">Cao su ở đế ngo&agrave;i mang lại lực k&eacute;o dồi d&agrave;o cho con bạn.</li>\r\n</ul>\r\n\r\n<p><strong>Th&ocirc;ng tin chi tiết sản phẩm</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">D&acirc;y buộc cổ điển</li>\r\n	<li style=\"list-style-type:none\">Logo đ&ocirc;i c&aacute;nh được dập tr&ecirc;n cổ &aacute;o</li>\r\n	<li style=\"list-style-type:none\">Logo Swoosh được kh&acirc;u xuống</li>\r\n	<li style=\"list-style-type:none\">Thiết kế Jumpman tr&ecirc;n lưỡi</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: M&agrave;u xanh lam/Trắng đỉnh/Trắng/Xanh băng</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: FQ9116-400</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Indonesia</li>\r\n</ul>', '<p>Những đ&ocirc;i gi&agrave;y sẵn s&agrave;ng cho m&ugrave;a giải n&agrave;y c&oacute; nhiều chi tiết mang phong c&aacute;ch m&ugrave;a đ&ocirc;ng: đế ngo&agrave;i bằng đ&aacute; trong suốt, lớp phủ bằng da c&oacute; kết cấu &quot;đ&oacute;ng băng&quot; v&agrave; dấu Swoosh chứa đầy gel lấy cảm hứng từ quả cầu tuyết xo&aacute;y.&nbsp;H&atilde;y để con bạn thay đổi diện mạo m&ugrave;a đ&ocirc;ng của ch&uacute;ng.</p>', 1529000, 0, 1, '2023-12-07 11:26:30', '2023-12-07 11:26:30'),
(3, 2, 1, 50, 'Nike Go FlyEase', 'nike-go-flyease', '<p style=\"text-align:start\"><strong>&ldquo;Đệm&rdquo; Mỗi Bước Đi</strong></p>\r\n\r\n<p style=\"text-align:start\">Bọt Cushlon sang trọng mang lại cho mỗi lần chuyển đổi từ g&oacute;t ch&acirc;n sang ng&oacute;n ch&acirc;n một cảm gi&aacute;c &ecirc;m &aacute;i, &ecirc;m &aacute;i.</p>\r\n\r\n<p><strong>Cấu tr&uacute;c nhẹ</strong></p>\r\n\r\n<p>Vải tho&aacute;ng m&aacute;t ở ph&iacute;a tr&ecirc;n gi&uacute;p ch&acirc;n bạn thở trong khi lớp phủ bền, kh&ocirc;ng cần đường may mang lại cấu tr&uacute;c v&agrave; độ ổn định.</p>\r\n\r\n<p><strong>Th&ocirc;ng tin chi tiết sản phẩm</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Đế ngo&agrave;i cao su b&aacute;m chắc</li>\r\n	<li style=\"list-style-type:none\">thiết kế swoosh</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Trắng/Đen</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: DR5540-102</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>', '<p style=\"text-align:start\">Bỏ d&acirc;y buộc v&agrave; ra ngo&agrave;i.&nbsp;Những đ&ocirc;i gi&agrave;y n&agrave;y sử dụng c&ocirc;ng nghệ FlyEase mang t&iacute;nh c&aacute;ch mạng của Nike, gi&uacute;p việc khởi động trở n&ecirc;n dễ d&agrave;ng.&nbsp;Với g&oacute;t ch&acirc;n c&oacute; thể xoay để mở ra ho&agrave;n to&agrave;n rảnh tay, ch&uacute;ng rất l&yacute; tưởng cho những người c&oacute; khả năng di chuyển hạn chế&mdash;hoặc bất kỳ ai muốn di chuyển nhanh hơn.</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type: disc;\">M&agrave;u sắc hiển thị: Trắng/Đen</li>\r\n	<li style=\"list-style-type: disc;\">Phong c&aacute;ch: DR5540-102</li>\r\n</ul>', 3829000, 0, 1, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(4, 4, 1, 40, 'Nike Academy', 'nike-academy', '<p style=\"text-align:start\"><strong>BẢO QUẢN TIỆN LỢI CHO THIẾT BỊ CỦA BẠN.</strong></p>\r\n\r\n<p>Nike Academy Gymsack c&oacute; thiết kế gọn nhẹ với d&acirc;y r&uacute;t đ&oacute;ng k&iacute;n, gi&uacute;p bạn c&oacute; thể nhanh ch&oacute;ng lấy đồ đạc của m&igrave;nh khi đang di chuyển.&nbsp;Một t&uacute;i b&ecirc;n ngo&agrave;i cho ph&eacute;p bạn giữ c&aacute;c vật dụng nhỏ hơn ri&ecirc;ng biệt.&nbsp;Sản phẩm n&agrave;y được l&agrave;m từ &iacute;t nhất 50% sợi polyester t&aacute;i chế.</p>\r\n\r\n<p><strong>Những lợi &iacute;ch</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Vải dệt nhẹ v&agrave; bền.</li>\r\n	<li style=\"list-style-type:none\">Ngăn ch&iacute;nh được đ&oacute;ng k&iacute;n để dễ d&agrave;ng lấy đồ của bạn.</li>\r\n	<li style=\"list-style-type:none\">Lưới ở ph&iacute;a dưới cho ph&eacute;p th&ocirc;ng gi&oacute;.</li>\r\n	<li style=\"list-style-type:none\">T&uacute;i c&oacute; kh&oacute;a k&eacute;o ở mặt trước giữ những thứ cần thiết của bạn trong tầm tay.</li>\r\n</ul>\r\n\r\n<p><strong>Th&ocirc;ng tin chi tiết sản phẩm</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">51cm H x 36cm W x 5cm D (xấp xỉ)</li>\r\n	<li style=\"list-style-type:none\">18L</li>\r\n	<li style=\"list-style-type:none\">100% polyester</li>\r\n	<li style=\"list-style-type:none\">Sạch sẽ tại chỗ</li>\r\n	<li style=\"list-style-type:none\">Đ&atilde; nhập</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Đen/Đen/Trắng</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: DA5435-010</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>', '<p style=\"text-align:start\">Nike Academy Gymsack c&oacute; thiết kế gọn nhẹ với d&acirc;y r&uacute;t đ&oacute;ng k&iacute;n, gi&uacute;p bạn c&oacute; thể nhanh ch&oacute;ng lấy đồ đạc của m&igrave;nh khi đang di chuyển.&nbsp;Một t&uacute;i b&ecirc;n ngo&agrave;i cho ph&eacute;p bạn giữ c&aacute;c vật dụng nhỏ hơn ri&ecirc;ng biệt.&nbsp;Sản phẩm n&agrave;y được l&agrave;m từ &iacute;t nhất 50% sợi polyester t&aacute;i chế.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Đen/Đen/Trắng</li>\r\n	<li>Phong c&aacute;ch: DA5435-010</li>\r\n</ul>', 509000, 0, 1, '2023-12-07 11:34:28', '2023-12-07 11:34:28'),
(5, 1, 1, 70, 'Jordan Nu Retro 1 Low', 'jordan-nu-retro-1-low', '<p style=\"text-align:start\"><strong>Những lợi &iacute;ch</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">C&ocirc;ng nghệ Nike Air hấp thụ lực t&aacute;c động để giảm chấn theo từng bước đi.</li>\r\n	<li style=\"list-style-type:none\">Cổ &aacute;o c&oacute; đệm, cắt thấp vừa vặn thoải m&aacute;i quanh mắt c&aacute; ch&acirc;n của bạn.</li>\r\n	<li style=\"list-style-type:none\">Đế cao su mang lại cho bạn lực k&eacute;o dồi d&agrave;o.</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Trắng/Trắng/Đen</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: DV5141-100</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>', '<p style=\"text-align:start\">Lấy cảm hứng từ logo v&agrave; thiết kế Wings nguy&ecirc;n bản của Jordan 1, những đ&ocirc;i gi&agrave;y h&agrave;ng ng&agrave;y n&agrave;y lu&ocirc;n sẵn s&agrave;ng cho mọi hoạt động.&nbsp;H&atilde;y diện ch&uacute;ng với một v&agrave;i chiếc quần jean rộng th&ugrave;ng th&igrave;nh, mặc ch&uacute;ng để trượt v&aacute;n hay chỉ đơn giản l&agrave; tr&ocirc;ng bay bổng&mdash;điều đ&oacute; t&ugrave;y thuộc v&agrave;o bạn.&nbsp;Mũ gi&agrave;y bằng da mịn v&agrave; logo dập nổi lớn sẽ gi&uacute;p bạn nổi bật d&ugrave; mặc trang phục cao hay thấp.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/Trắng/Đen</li>\r\n	<li>Phong c&aacute;ch: DV5141-100</li>\r\n</ul>', 3089000, 0, 1, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(6, 1, 1, 70, 'Jordan Stay Loyal 2', 'jordan-stay-loyal-2', '<p style=\"text-align:start\"><strong>Những lợi &iacute;ch</strong></p>\r\n\r\n<ul>\r\n	<li>C&ocirc;ng nghệ Nike Air hấp thụ lực t&aacute;c động để giảm chấn theo từng bước đi.</li>\r\n	<li>Da ở phần tr&ecirc;n dễ d&agrave;ng bong ra v&agrave; tạo n&ecirc;n một đ&ocirc;i gi&agrave;y bền l&acirc;u.</li>\r\n	<li>Mũi gi&agrave;y đan lưới gi&uacute;p đ&ocirc;i ch&acirc;n bạn tho&aacute;ng kh&iacute;.</li>\r\n</ul>\r\n\r\n<p><strong>Th&ocirc;ng tin chi tiết sản phẩm</strong></p>\r\n\r\n<ul>\r\n	<li>D&acirc;y đeo g&oacute;t logo Jumpman</li>\r\n	<li>V&ograve;ng g&oacute;t ch&acirc;n</li>\r\n	<li>Chi tiết lỗ gắn khu&ocirc;n</li>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/X&aacute;m xi măng/Antraxit/V&agrave;ng Topaz</li>\r\n	<li>Phong c&aacute;ch: DQ8401-103</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>', '<p style=\"text-align:start\">Lấy cảm hứng từ nhiều thế hệ J, những c&uacute; đ&aacute; n&agrave;y l&agrave; sự kết hợp rất th&uacute; vị.&nbsp;C&aacute;c chi tiết thiết kế gợi lại những đ&ocirc;i gi&agrave;y huyền thoại h&agrave;ng thập kỷ đồng thời b&agrave;y tỏ l&ograve;ng t&ocirc;n k&iacute;nh đối với sự nghiệp d&agrave;y dặn của MJ.&nbsp;Lưới tho&aacute;ng kh&iacute;, da chắc chắn v&agrave; đệm kh&iacute; nhẹ ở g&oacute;t ch&acirc;n gi&uacute;p bạn bước đi tr&ecirc;n những bước ch&acirc;n vĩ đại dễ d&agrave;ng hơn nhiều.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/X&aacute;m xi măng/Antraxit/V&agrave;ng Topaz</li>\r\n	<li>Phong c&aacute;ch: DQ8401-103</li>\r\n</ul>', 3369000, 0, 1, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(7, 1, 1, 70, 'Paris Saint-Germain Jumpman MVP', 'paris-saint-germain-jumpman-mvp', '<p style=\"text-align:start\">Ch&agrave;o mừng tới paris.&nbsp;Đối với PSG Collab mới nhất của ch&uacute;ng t&ocirc;i, ch&uacute;ng t&ocirc;i đ&atilde; kết hợp c&aacute;c yếu tố mang t&iacute;nh biểu tượng từ AJ6, 7 v&agrave; 8 trong một thiết kế mới nhằm kỷ niệm bộ ba chức v&ocirc; địch đầu ti&ecirc;n của MJ.&nbsp;Với chất liệu cao cấp, đường kh&acirc;u đậm n&eacute;t v&agrave; c&aacute;c chi tiết in chữ, những đ&ocirc;i gi&agrave;y thể thao phi&ecirc;n bản đặc biệt n&agrave;y cho mọi người biết bạn l&agrave; ai.</p>\r\n\r\n<p><strong>Những lợi &iacute;ch:</strong></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Phần tr&ecirc;n lưỡi gi&agrave;y v&agrave; lớp phủ được sửa đổi lấy cảm hứng từ AJ6, trong khi lớp l&oacute;t b&aacute;n gi&agrave;y thể hiện sự t&ocirc;n k&iacute;nh đối với AJ7.</li>\r\n	<li style=\"list-style-type:none\">Logo g&oacute;t ch&acirc;n Nike Air th&ecirc;u tham khảo AJ6 v&agrave; chi tiết g&oacute;t đ&uacute;c lấy từ AJ8.</li>\r\n	<li style=\"list-style-type:none\">Thiết kế đế ngo&agrave;i giống với AJ6.</li>\r\n	<li style=\"list-style-type:none\">Bộ Nike Air ở b&agrave;n ch&acirc;n trước v&agrave; bộ Max Air ở g&oacute;t ch&acirc;n cung cấp khả năng đệm.</li>\r\n</ul>\r\n\r\n<p>Th&ocirc;ng tin chi tiết sản phẩm:</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Logo Jumpman th&ecirc;u</li>\r\n	<li style=\"list-style-type:none\">Đế gi&agrave;y cao su</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Đen/Xương nhạt/Cam Magma</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: FJ0742-081</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>', '<p style=\"text-align:start\">Ch&agrave;o mừng tới paris.&nbsp;Đối với PSG Collab mới nhất của ch&uacute;ng t&ocirc;i, ch&uacute;ng t&ocirc;i đ&atilde; kết hợp c&aacute;c yếu tố mang t&iacute;nh biểu tượng từ AJ6, 7 v&agrave; 8 trong một thiết kế mới nhằm kỷ niệm bộ ba chức v&ocirc; địch đầu ti&ecirc;n của MJ.&nbsp;Với chất liệu cao cấp, đường kh&acirc;u đậm n&eacute;t v&agrave; c&aacute;c chi tiết in chữ, những đ&ocirc;i gi&agrave;y thể thao phi&ecirc;n bản đặc biệt n&agrave;y cho mọi người biết bạn l&agrave; ai.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Đen/Xương nhạt/Cam Magma</li>\r\n	<li>Phong c&aacute;ch: FJ0742-081</li>\r\n</ul>', 4849000, 0, 1, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(8, 1, 1, 70, 'Air Jordan 5 Retro', 'air-jordan-5-retro', '<p style=\"text-align:start\">CHUYẾN BAY ANTRAXIT.</p>\r\n\r\n<p>Giống như chiếc m&aacute;y bay chiến đấu trong Thế chiến thứ hai đ&atilde; truyền cảm hứng cho thiết kế của Air Jordan 5, Michael Jordan kh&ocirc;ng ngừng tấn c&ocirc;ng v&agrave; kh&ocirc;ng thể bị ngăn cản tr&ecirc;n kh&ocirc;ng.&nbsp;Air Jordan 5 Retro mang lại đ&ocirc;i gi&agrave;y thi đấu của MJ, được l&agrave;m lại với sự kết hợp giữa Anthracite, đen v&agrave; x&aacute;m.&nbsp;Da lộn, chất liệu dệt bền v&agrave; v&ograve;ng ren bằng nhựa mang lại cấu tr&uacute;c v&agrave; phong c&aacute;ch cổ điển.&nbsp;C&aacute;c chi tiết thiết kế phản quang ở hai b&ecirc;n v&agrave; đầu lưỡi l&agrave;m cho n&oacute; nổi bật.</p>\r\n\r\n<p>Những lợi &iacute;ch:</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Air c&oacute; thể nh&igrave;n thấy ở g&oacute;t ch&acirc;n v&agrave; Air được bao bọc ở b&agrave;n ch&acirc;n trước mang lại lớp đệm nhẹ v&agrave; độ tin cậy tức th&igrave;.</li>\r\n	<li style=\"list-style-type:none\">Chất liệu dệt v&agrave; da lộn ch&iacute;nh h&atilde;ng v&agrave; tổng hợp mang lại cấu tr&uacute;c, độ bền v&agrave; phong c&aacute;ch cao cấp.</li>\r\n</ul>\r\n\r\n<p>Th&ocirc;ng tin chi tiết sản phẩm:</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">Chi tiết thiết kế phản quang</li>\r\n	<li style=\"list-style-type:none\">Cổ &aacute;o phồng l&ecirc;n</li>\r\n	<li style=\"list-style-type:none\">Chuyển đổi ren</li>\r\n	<li style=\"list-style-type:none\">Kh&ocirc;ng nhằm mục đ&iacute;ch sử dụng l&agrave;m Thiết bị bảo hộ c&aacute; nh&acirc;n (PPE)</li>\r\n	<li style=\"list-style-type:none\">M&agrave;u sắc hiển thị: Antraxit/X&aacute;m s&oacute;i/Trong/Đen</li>\r\n	<li style=\"list-style-type:none\">Phong c&aacute;ch: DB0731-001</li>\r\n	<li style=\"list-style-type:none\">Quốc gia/Khu vực xuất xứ: Trung Quốc</li>\r\n</ul>', '<p style=\"text-align:start\">Giống như chiếc m&aacute;y bay chiến đấu trong Thế chiến thứ hai đ&atilde; truyền cảm hứng cho thiết kế của Air Jordan 5, Michael Jordan kh&ocirc;ng ngừng tấn c&ocirc;ng v&agrave; kh&ocirc;ng thể bị ngăn cản tr&ecirc;n kh&ocirc;ng.&nbsp;Air Jordan 5 Retro mang lại đ&ocirc;i gi&agrave;y thi đấu của MJ, được l&agrave;m lại với sự kết hợp giữa Anthracite, đen v&agrave; x&aacute;m.&nbsp;Da lộn, chất liệu dệt bền v&agrave; v&ograve;ng ren bằng nhựa mang lại cấu tr&uacute;c v&agrave; phong c&aacute;ch cổ điển.&nbsp;C&aacute;c chi tiết thiết kế phản quang ở hai b&ecirc;n v&agrave; đầu lưỡi l&agrave;m cho n&oacute; nổi bật.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Antraxit/X&aacute;m s&oacute;i/Trong/Đen</li>\r\n	<li>Phong c&aacute;ch: DB0731-001</li>\r\n</ul>', 5589000, 0, 1, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(9, 2, 1, 50, 'Nike Air Force 1 Shadow', 'nike-air-force-1-shadow', '<p style=\"text-align:start\">NH&Acirc;N Đ&Ocirc;I AF-1. NH&Acirc;N Đ&Ocirc;I VUI VẺ.</p>\r\n\r\n<p>Nike Air Force 1 Shadow mang đến sự thay đổi vui nhộn tr&ecirc;n thiết kế b&oacute;ng b cổ điển. Sử dụng c&aacute;ch tiếp cận theo lớp, nh&acirc;n đ&ocirc;i thương hiệu v&agrave; t&ocirc;n l&ecirc;n phần đế giữa, n&oacute; l&agrave;m nổi bật DNA AF-1 với diện mạo mới, t&aacute;o bạo.</p>\r\n\r\n<p>Nh&igrave;n nhiều lớp</p>\r\n\r\n<p>Với 2 miếng che mắt, 2 tấm chắn b&ugrave;n, 2 vấu sau v&agrave; 2 thiết kế Swoosh, bạn sẽ c&oacute; được vẻ ngo&agrave;i nhiều lớp với thương hiệu gấp đ&ocirc;i.</p>\r\n\r\n<p>Nhẹ nh&agrave;ng thoải m&aacute;i</p>\r\n\r\n<p>Đế giữa bằng xốp v&agrave; đế ngo&agrave;i c&oacute; r&atilde;nh đảm bảo gi&agrave;y nhẹ, linh hoạt v&agrave; thoải m&aacute;i.</p>\r\n\r\n<p>H&igrave;nh dạng mang t&iacute;nh biểu tượng</p>\r\n\r\n<p>Với h&igrave;nh dạng mang t&iacute;nh biểu tượng tương tự như Air Force 1 nguy&ecirc;n bản, đế giữa hơi ph&oacute;ng đại gi&uacute;p đ&ocirc;i gi&agrave;y c&oacute; thể nhận ra ngay lập tức đồng thời c&acirc;n nhắc tỷ lệ.</p>\r\n\r\n<p>Th&ocirc;ng tin chi tiết sản phẩm:</p>\r\n\r\n<ul>\r\n	<li>Chiều cao đế giữa: 41mm</li>\r\n	<li>Sự kết hợp giữa da v&agrave; vật liệu tổng hợp</li>\r\n	<li>Băng cao su</li>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/Trắng/Trắng</li>\r\n	<li>Phong c&aacute;ch: CI0919-100</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam, Trung Quốc</li>\r\n</ul>', '<p style=\"text-align:start\">Nike Air Force 1 Shadow mang đến sự thay đổi vui nhộn tr&ecirc;n thiết kế b&oacute;ng b cổ điển. Sử dụng c&aacute;ch tiếp cận theo lớp, nh&acirc;n đ&ocirc;i thương hiệu v&agrave; t&ocirc;n l&ecirc;n phần đế giữa, n&oacute; l&agrave;m nổi bật DNA AF-1 với diện mạo mới, t&aacute;o bạo.</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/Trắng/Trắng</li>\r\n	<li>Phong c&aacute;ch: CI0919-100</li>\r\n</ul>', 3519000, 0, 1, '2023-12-07 11:51:45', '2023-12-07 11:51:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productimage`
--

CREATE TABLE `productimage` (
  `idImage` int(10) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `ImageName` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `productimage`
--

INSERT INTO `productimage` (`idImage`, `idProduct`, `ImageName`, `created_at`, `updated_at`) VALUES
(18, 1, '[\"a1928.png\",\"a20.png\",\"a120.png\"]', '2023-12-07 11:22:04', '2023-12-07 11:22:04'),
(20, 2, '[\"a640.png\",\"a592.png\",\"a445.png\"]', '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(21, 3, '[\"a1187.png\",\"a102.png\",\"a835.png\"]', '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(22, 4, '[\"a1568.png\",\"a1480.png\",\"a1344.png\"]', '2023-12-07 11:34:28', '2023-12-07 11:34:28'),
(23, 5, '[\"a1831.png\",\"a1719.png\",\"a1610.png\"]', '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(24, 6, '[\"a2158.png\",\"a2039.png\",\"a1110.png\"]', '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(25, 7, '[\"a2417.png\",\"a2319.png\",\"a251.png\"]', '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(26, 8, '[\"a2711.png\",\"a2636.png\",\"a2892.png\"]', '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(27, 9, '[\"a3133.png\",\"a3090.png\",\"a2975.png\"]', '2023-12-07 11:51:45', '2023-12-07 11:51:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute`
--

CREATE TABLE `product_attribute` (
  `idProAttr` int(10) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `idAttrValue` int(11) UNSIGNED NOT NULL DEFAULT 11,
  `Quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attribute`
--

INSERT INTO `product_attribute` (`idProAttr`, `idProduct`, `idAttrValue`, `Quantity`, `created_at`, `updated_at`) VALUES
(169, 1, 23, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(170, 1, 24, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(171, 1, 25, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(172, 1, 26, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(173, 1, 27, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(174, 1, 28, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(175, 1, 31, 10, '2023-12-07 11:23:27', '2023-12-07 11:23:27'),
(183, 2, 1, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(184, 2, 2, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(185, 2, 3, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(186, 2, 4, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(187, 2, 5, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(188, 2, 6, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(189, 2, 7, 10, '2023-12-07 11:27:04', '2023-12-07 11:27:04'),
(190, 3, 19, 10, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(191, 3, 20, 10, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(192, 3, 21, 10, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(193, 3, 22, 10, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(194, 3, 23, 10, '2023-12-07 11:31:20', '2023-12-07 11:31:20'),
(195, 4, 29, 20, '2023-12-07 11:34:28', '2023-12-07 11:34:28'),
(196, 4, 30, 20, '2023-12-07 11:34:28', '2023-12-07 11:34:28'),
(197, 5, 23, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(198, 5, 24, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(199, 5, 25, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(200, 5, 26, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(201, 5, 27, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(202, 5, 28, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(203, 5, 31, 10, '2023-12-07 11:36:41', '2023-12-07 11:36:41'),
(204, 6, 23, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(205, 6, 24, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(206, 6, 25, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(207, 6, 26, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(208, 6, 27, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(209, 6, 28, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(210, 6, 31, 10, '2023-12-07 11:39:39', '2023-12-07 11:39:39'),
(211, 7, 23, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(212, 7, 24, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(213, 7, 25, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(214, 7, 26, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(215, 7, 27, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(216, 7, 28, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(217, 7, 31, 10, '2023-12-07 11:42:56', '2023-12-07 11:42:56'),
(218, 8, 23, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(219, 8, 24, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(220, 8, 25, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(221, 8, 26, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(222, 8, 27, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(223, 8, 28, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(224, 8, 31, 10, '2023-12-07 11:46:55', '2023-12-07 11:46:55'),
(225, 9, 19, 10, '2023-12-07 11:51:45', '2023-12-07 11:51:45'),
(226, 9, 20, 10, '2023-12-07 11:51:45', '2023-12-07 11:51:45'),
(227, 9, 21, 10, '2023-12-07 11:51:45', '2023-12-07 11:51:45'),
(228, 9, 22, 10, '2023-12-07 11:51:45', '2023-12-07 11:51:45'),
(229, 9, 23, 10, '2023-12-07 11:51:45', '2023-12-07 11:51:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  ADD PRIMARY KEY (`idAddress`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`idAttribute`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`idAttrValue`),
  ADD KEY `idAttribute` (`idAttribute`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`idBill`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Chỉ mục cho bảng `billhistory`
--
ALTER TABLE `billhistory`
  ADD KEY `idBill` (`idBill`);

--
-- Chỉ mục cho bảng `billinfo`
--
ALTER TABLE `billinfo`
  ADD KEY `idBill` (`idBill`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`idBlog`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`idBrand`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idProAttr` (`idProAttr`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idCategory` (`idCategory`,`idBrand`),
  ADD KEY `idBrand` (`idBrand`);
ALTER TABLE `product` ADD FULLTEXT KEY `ProductName` (`ProductName`);

--
-- Chỉ mục cho bảng `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`idImage`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`idProAttr`),
  ADD KEY `idProduct` (`idProduct`,`idAttrValue`),
  ADD KEY `idAttrValue` (`idAttrValue`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  MODIFY `idAddress` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `idAttribute` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `idAttrValue` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `idBill` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `idBlog` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `idBrand` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `idCart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `idCustomer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `productimage`
--
ALTER TABLE `productimage`
  MODIFY `idImage` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `idProAttr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  ADD CONSTRAINT `addresscustomer_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `attribute_value_ibfk_1` FOREIGN KEY (`idAttribute`) REFERENCES `attribute` (`idAttribute`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `billhistory`
--
ALTER TABLE `billhistory`
  ADD CONSTRAINT `billhistory_ibfk_1` FOREIGN KEY (`idBill`) REFERENCES `bill` (`idBill`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `billinfo`
--
ALTER TABLE `billinfo`
  ADD CONSTRAINT `billinfo_ibfk_1` FOREIGN KEY (`idBill`) REFERENCES `bill` (`idBill`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `billinfo_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`idProAttr`) REFERENCES `product_attribute` (`idProAttr`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idBrand`) REFERENCES `brand` (`idBrand`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_ibfk_1` FOREIGN KEY (`idAttrValue`) REFERENCES `attribute_value` (`idAttrValue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_attribute_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
