-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 19, 2022 at 02:38 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doantotnghiep_phpthuan_qldoan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chuyennganh`
--

CREATE TABLE `tbl_chuyennganh` (
  `id` int(11) NOT NULL,
  `tenchuyennganh` varchar(50) DEFAULT NULL,
  `machuyennganh` varchar(50) DEFAULT NULL,
  `id_makhoa` varchar(50) DEFAULT NULL,
  `mota` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_chuyennganh`
--

INSERT INTO `tbl_chuyennganh` (`id`, `tenchuyennganh`, `machuyennganh`, `id_makhoa`, `mota`) VALUES
(9, 'Hệ Thống Thông Tin', 'HTTT', 'mkcntt', ''),
(10, 'Điện Tử Viễn Thông', 'DTVT', 'mkcntt', ''),
(11, 'Xây Dựng Dân Dụng', 'XDDD', 'mkct', ''),
(12, 'Cầu Đường', 'CD', 'mkct', ''),
(13, 'Đường Bộ', 'DB', 'mkct', ''),
(14, 'Đường Sắt', 'DS', 'mkct', ''),
(15, 'Kế Toán', 'KT', 'mkktvt', ''),
(17, 'Quản Trị Doang Nghiệp', 'QTDN', 'mkktvt', ''),
(18, 'Ô Tô', 'OTO', 'mkck', ''),
(19, 'Máy Xây Dựng', 'MXD', 'mkck', ''),
(20, 'Máy Tàu Thủy', 'MTT', 'mkck', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doan`
--

CREATE TABLE `tbl_doan` (
  `id` int(11) NOT NULL,
  `tendoan` varchar(200) DEFAULT NULL,
  `madoan` varchar(50) DEFAULT NULL,
  `id_makhoa` varchar(50) DEFAULT NULL,
  `id_machuyennganh` varchar(50) DEFAULT NULL,
  `id_malop` varchar(50) DEFAULT NULL,
  `id_masinhvien` varchar(50) DEFAULT NULL,
  `id_giaovien` int(11) DEFAULT NULL,
  `id_hoidong` int(11) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `diem` float NOT NULL DEFAULT '0',
  `url` varchar(200) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `hinhanh` varchar(100) DEFAULT NULL,
  `view` int(11) DEFAULT '0',
  `download` int(11) DEFAULT '0',
  `gioithieu` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_doan`
--

INSERT INTO `tbl_doan` (`id`, `tendoan`, `madoan`, `id_makhoa`, `id_machuyennganh`, `id_malop`, `id_masinhvien`, `id_giaovien`, `id_hoidong`, `tags`, `diem`, `url`, `file`, `hinhanh`, `view`, `download`, `gioithieu`) VALUES
(5, 'Xây dựng hệ thống thông tin quản  lí học sinh THCS', 'qlhsthcs', 'mkcntt', 'HTTT', '64DCTH01', '64DCTH1235', 12, NULL, NULL, 2, 'https://drive.google.com/drive/my-drive', 'fix lỗi.docx', 'chuyên ngành.png', 0, 0, '<div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85452.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85453.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85454.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85455.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85456.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85457.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div><br style=\"margin: 0px; padding: 0px; border: none; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><div class=\"text-center\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; outline: 0px; vertical-align: top; color: rgb(126, 89, 42); font-family: Tahoma, Arial, sans-serif; font-size: 14px;\"><img src=\"https://sharecode.vn/FilesUpload/CodeUpload/source-code-ung-dung-quan-ly-quan-ca-phe-coffee-85458.jpg\" alt=\"quản lý cà phê,coffee,quản lý coffe,quản lý cafe,quản lý quán cà phê,c# cafe\" title=\"Download Source code ứng dụng quản lý quán Cà phê-coffee ngay!\" class=\"dt-max-img\" style=\"margin: 0px; padding: 0px; vertical-align: top; background: transparent; font-weight: inherit; outline: 0px; max-width: 100%; height: auto !important;\"></div>'),
(6, 'Xây dựng hệ thống quản lí học sinh', 'qlsv', 'mkcntt', 'HTTT', '64DCTH03', '64DCTH1234', 27, NULL, NULL, 6, 'https://drive.google.com/drive/my-drive', 'QL ĐỒ ÁN- Lê thị phương my.doc', 'admin.png', 0, 0, '<p class=\"MsoNormal\" style=\"text-align:justify;line-height:130%;tab-stops:right dotted 16.0cm\"><b><span lang=\"EN-US\"><font face=\"Times New Roman\">Tóm tắt:</font></span></b><span lang=\"EN-US\"><font face=\"Times New Roman\"> Ngày nay, cùng với sự phát triển nhanh chóng công nghệ thông tin đã\r\ntrở thành một ngành công nghiệp mũi nhọn, một ngành khoa học kĩ thuật không thể\r\nthiếu trong cuộc sống. Trước tiên, phải kể đến việc áp dụng tin học vào các\r\nlĩnh vực của xã hội như quản lí, thông tin, kinh tế…đã cho ra đời những sản\r\nphẩm ứng dụng để thay thế cơ bản các công tác quản lí thủ công, giảm nhẹ tới\r\nmức tối thiểu việc sử dụng sức người trong công tác quản lí, tăng cường hiệu\r\nquả, tiết kiệm chi phí, thời gian và sức lao động.Chính vì vậy, trong đề tài đồ\r\nán này em muốn giới thiệu một sản phẩm giúp quản lí đồ án tốt nghiệp tại trường\r\nđại học.</font><o:p></o:p></span></p>'),
(7, 'Xây dựng website quản lí đồ án tốt nghiệp', 'qlhs', 'mkcntt', 'HTTT', '64DCTH03', '64DCTH3090', 24, 3, NULL, 8, 'https://drive.google.com/open?id=1AIuhp5GNZktLy_leTa8E8r_U18nJKXFI', 'font-full_10_2.zip', 'dn  sv.png', 0, 0, '<h5 style=\"text-align:justify;line-height:130%;tab-stops:right dotted 16.0cm\"><b><span lang=\"EN-US\"><font face=\"Times New Roman\">Tóm tắt:</font></span></b><span lang=\"EN-US\"><font face=\"Times New Roman\"> Ngày nay, cùng với sự phát triển nhanh chóng công nghệ thông tin đã\r\ntrở thành một ngành công nghiệp mũi nhọn, một ngành khoa học kĩ thuật không thể\r\nthiếu trong cuộc sống. Trước tiên, phải kể đến việc áp dụng tin học vào các\r\nlĩnh vực của xã hội như quản lí, thông tin, kinh tế…đã cho ra đời những sản\r\nphẩm ứng dụng để thay thế cơ bản các công tác quản lí thủ công, giảm nhẹ tới\r\nmức tối thiểu việc sử dụng sức người trong công tác quản lí, tăng cường hiệu\r\nquả, tiết kiệm chi phí, thời gian và sức lao động.Chính vì vậy, trong đề tài đồ\r\nán này em muốn giới thiệu một sản phẩm giúp quản lí đồ án tốt nghiệp tại trường\r\nđại học.</font><o:p></o:p></span></h5>'),
(8, 'Xây dựng ứng dụng nhận diện biển số xe máy qua ảnh chụp', 'ndbsx', 'mkcntt', 'HTTT', '64DCTH02', '64DCTH9098', 32, NULL, NULL, 8.5, 'https://drive.google.com/drive/my-drive', 'aeadf-Quy-dinh-trinh-bay-KLTN.doc', 'ds đồ ámn.png', 0, 0, '<p class=\"MsoNormal\" style=\"text-align:justify;line-height:130%;tab-stops:right dotted 16.0cm\"><b><span lang=\"EN-US\"><font face=\"Times New Roman\">Tóm tắt:</font></span></b><span lang=\"EN-US\"><font face=\"Times New Roman\"> Ngày nay, cùng với sự phát triển nhanh chóng công nghệ thông tin đã\r\ntrở thành một ngành công nghiệp mũi nhọn, một ngành khoa học kĩ thuật không thể\r\nthiếu trong cuộc sống. Trước tiên, phải kể đến việc áp dụng tin học vào các\r\nlĩnh vực của xã hội như quản lí, thông tin, kinh tế…đã cho ra đời những sản\r\nphẩm ứng dụng để thay thế cơ bản các công tác quản lí thủ công, giảm nhẹ tới\r\nmức tối thiểu việc sử dụng sức người trong công tác quản lí, tăng cường hiệu\r\nquả, tiết kiệm chi phí, thời gian và sức lao động.Chính vì vậy, trong đề tài đồ\r\nán này em muốn giới thiệu một sản phẩm giúp quản lí đồ án tốt nghiệp tại trường\r\nđại học.</font><o:p></o:p></span></p>'),
(9, 'Điều khiển tay máy bằng giọng nói Tiếng Việt', 'dktm', 'mkcntt', 'DTVT', '64DCDT01', '64DCĐT8906', 17, NULL, NULL, 9, 'https://drive.google.com/drive/my-drive', 'QL ĐỒ ÁN- Lê thị phương my.doc', 'admin.png', 0, 0, '<p class=\"MsoNormal\" style=\"text-align:justify;line-height:130%;tab-stops:right dotted 16.0cm\"><b><span lang=\"EN-US\"><font face=\"Times New Roman\">Tóm tắt:</font></span></b><span lang=\"EN-US\"><font face=\"Times New Roman\"> Ngày nay, cùng với sự phát triển nhanh chóng công nghệ thông tin đã\r\ntrở thành một ngành công nghiệp mũi nhọn, một ngành khoa học kĩ thuật không thể\r\nthiếu trong cuộc sống. Trước tiên, phải kể đến việc áp dụng tin học vào các\r\nlĩnh vực của xã hội như quản lí, thông tin, kinh tế…đã cho ra đời những sản\r\nphẩm ứng dụng để thay thế cơ bản các công tác quản lí thủ công, giảm nhẹ tới\r\nmức tối thiểu việc sử dụng sức người trong công tác quản lí, tăng cường hiệu\r\nquả, tiết kiệm chi phí, thời gian và sức lao động.Chính vì vậy, trong đề tài đồ\r\nán này em muốn giới thiệu một sản phẩm giúp quản lí đồ án tốt nghiệp tại trường\r\nđại học.</font><o:p></o:p></span></p>'),
(10, 'Kế toán nguyên vật liệu-công cụ dụng cụ trong doanh nghiệp', 'ktnvl', 'mkktvt', 'KT', '64DCKT01', '64DCKT8980', 29, NULL, NULL, 5, 'https://drive.google.com/drive/my-drive', 'aeadf-Quy-dinh-trinh-bay-KLTN.doc', 'lớp.png', 0, 0, '<p class=\"MsoNormal\" style=\"text-align:justify;line-height:130%;tab-stops:right dotted 16.0cm\"><b><span lang=\"EN-US\"><font face=\"Times New Roman\">Tóm tắt:</font></span></b><span lang=\"EN-US\"><font face=\"Times New Roman\"> Ngày nay, cùng với sự phát triển nhanh chóng công nghệ thông tin đã\r\ntrở thành một ngành công nghiệp mũi nhọn, một ngành khoa học kĩ thuật không thể\r\nthiếu trong cuộc sống. Trước tiên, phải kể đến việc áp dụng tin học vào các\r\nlĩnh vực của xã hội như quản lí, thông tin, kinh tế…đã cho ra đời những sản\r\nphẩm ứng dụng để thay thế cơ bản các công tác quản lí thủ công, giảm nhẹ tới\r\nmức tối thiểu việc sử dụng sức người trong công tác quản lí, tăng cường hiệu\r\nquả, tiết kiệm chi phí, thời gian và sức lao động.Chính vì vậy, trong đề tài đồ\r\nán này em muốn giới thiệu một sản phẩm giúp quản lí đồ án tốt nghiệp tại trường\r\nđại học.</font><o:p></o:p></span></p>'),
(11, 'quản lí học sinh', 'qlhsthpt', 'mkcntt', 'HTTT', '64DCTH03', '64DCTH3423', 32, NULL, NULL, 8, 'https://drive.google.com/drive/folders/1R9GJnN6ZsJuzCtgsvOEvlBtTf42VKtJE', 'QL ĐỒ ÁN- Lê thị phương my.doc', 'admin.png', 0, 0, '<p>adsaadfdf</p>'),
(12, 'Do An A', 'm200001', 'mkcntt', 'HTTT', '64DCTH01', '64DCTH2344', 12, NULL, NULL, 20, 'link', 'fix-lỗi.docx', 'logo_laravel.png', 0, 0, '<p>ok</p>'),
(13, 'Do an Nguyen Minh Hoang', 'DA001', 'mkcntt', 'HTTT', '64DCTH01', '64DCTH2344', 15, NULL, NULL, 9, 'link demo', 'fix-lỗi.docx', 'logo_laravel.png', 0, 0, '<p>ok</p>'),
(14, 'Do an tot nghiep', '121', 'mkktvt', 'KT', '64DCKT01', '64DCKT8980', 15, 3, NULL, 6, '12121', 'NOTE-WEB.doc', 'Screen Shot 2017-12-19 at 8.29.51 PM.png', 0, 0, '<p>ok</p>'),
(15, 'ok', 'ok', 'mkktvt', 'KT', '64DCKT01', '64DCKT8980', 19, 1, 'ko , hu , o', 9, 'ok', 'NOTE-WEB.doc', 'Screen Shot 2017-12-19 at 8.29.47 PM.png', 0, 0, '<p>ok</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doan_giaovien`
--

CREATE TABLE `tbl_doan_giaovien` (
  `id` int(11) NOT NULL,
  `id_doan` int(11) NOT NULL,
  `id_giaovien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_doan_giaovien`
--

INSERT INTO `tbl_doan_giaovien` (`id`, `id_doan`, `id_giaovien`) VALUES
(5, 13, 15),
(6, 13, 23),
(7, 7, 15),
(8, 7, 19),
(9, 14, 12),
(10, 14, 19),
(11, 14, 22),
(12, 15, 12),
(13, 15, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giaovien`
--

CREATE TABLE `tbl_giaovien` (
  `id` int(11) NOT NULL,
  `tengiaovien` varchar(50) DEFAULT NULL,
  `magiaovien` varchar(50) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `id_makhoa` varchar(50) DEFAULT NULL,
  `id_machuyennganh` varchar(50) DEFAULT NULL,
  `trangthai` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `quequan` varchar(100) DEFAULT NULL,
  `sodienthoai` varchar(15) DEFAULT NULL,
  `hinhanh` varchar(100) DEFAULT NULL,
  `gioithieu` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_giaovien`
--

INSERT INTO `tbl_giaovien` (`id`, `tengiaovien`, `magiaovien`, `ngaysinh`, `id_makhoa`, `id_machuyennganh`, `trangthai`, `email`, `quequan`, `sodienthoai`, `hinhanh`, `gioithieu`) VALUES
(12, 'Bùi Thị Như', 'GV01', '1986-03-12', 'mkcntt', 'HTTT', 'Đại học Công nghệ Giao thông Vận tải', 'buinhu@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '0995496181', '14958915_710723169086963_2074329421_o.jpg', '<p>Trí tuệ nhân tạo</p>'),
(15, 'Lê Văn Tân', 'GV04', '1987-12-09', 'mkktvt', 'QTDN', 'Học Viện Kĩ thuật Mật mã', 'baoson@gmail.com', 'Đô Lương-Nghệ An', '0167344332', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Thống kê kinh doanh</p>'),
(17, 'Nguyễn Hữu Tuân', 'GV03', '2017-12-15', 'mkcntt', 'HTTT', 'Đại học Công nghệ Giao thông Vận tải', 'Tuan@gmail.com', 'Hoàng Mai-Hà Nội', '9762253464', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Kiến trúc máy tính</p>'),
(18, 'Nguyễn Thị Vân Anh', 'GV05', '2017-12-08', 'mkcntt', 'HTTT', 'Đại học Công nghệ Giao thông Vận tải', 'nguyenthia@gmail.com', 'Hải Hậu- Nam Định', '0164576876', '12208523_1656788374600047_332592549829393046_n - Copy.jpg', '<p>Lập trình trực quan c#</p>'),
(19, 'Nguyễn Thị Hằng', 'GV06', '2017-12-08', 'mkcntt', 'HTTT', 'Đại học Công nghệ Giao thông Vận tải', 'nguyenthib@gmail.com', 'Nam Sách- Hải Dương', '096753412', '14976050_722695501217122_1044024390_o.jpg', '<p>Cấu trúc dữ liệu và giải thuật</p>'),
(20, 'Nguyễn Thị Tuyền', 'GV08', '2017-12-08', 'mkcntt', 'DTVT', 'Đại học Công nghệ Giao thông Vận tải', 'nguyenthic@gmail.com', 'Thái Thụy-Thái Bình', '0967337952', '14976050_722695501217122_1044024390_o.jpg', '<p>Tín hiệu và hệ thống</p>'),
(21, 'Lê Văn Khải', 'GV09', '2017-12-03', 'mkcntt', 'DTVT', 'Đại học Công nghệ Giao thông Vận tải', 'levana@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '0977654565', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Xử lí tín hiệu số</p>'),
(22, 'Lê Văn Dũng', 'GV10', '2017-12-08', 'mkcntt', 'DTVT', 'Đại học Công nghệ Giao thông Vận tải', 'levanb@gmail.com', 'Lê Trân- Hải Phòng', '972376541', '10496917_345997665553221_3903439141374121369_o - Copy.jpg', '<p>Linh kiện điện tử</p>'),
(23, 'Bùi Thị Thương', 'GV12', '2017-12-14', 'mkcntt', 'DTVT', 'Đại học Công nghệ Giao thông Vận tải', 'buithithuong@gmail.com', 'Thái Bình', '0976565432', '12208523_1656788374600047_332592549829393046_n - Copy.jpg', '<p>ấdasd</p>'),
(24, 'Nguyễn Thị Hồng Hạnh', 'GV13', '2017-12-20', 'mkktvt', 'KT', 'Đại học Công nghệ Giao thông Vận tải', 'nguyenthihonghanh@gmail.com', 'Gia Lâm -Hà Nội', '978878784', '14958207_722695514550454_1423785687_o (1).jpg', '<p>Kế toán hành chính sự nghiệp</p>'),
(25, 'Trần Văn Mậu', 'GV14', '2017-12-28', 'mkktvt', 'KT', 'Đại học Công nghệ Giao thông Vận tải', 'tranvanmau@gmail.com', 'Văn Lâm-Hưng Yên', '0982343423', '10496917_345997665553221_3903439141374121369_o - Copy.jpg', '<p>Quản trị doanh nghiệp</p>'),
(26, 'Cao Thị Dung', 'GV15', '2008-06-02', 'mkktvt', 'KT', 'Đại học Công nghệ Giao thông Vận tải', 'caothidung@gmail.com', 'Thái Thụy-Thái Bình', '0165454782', '14958915_710723169086963_2074329421_o.jpg', '<p>ádada</p>'),
(27, 'Nguyễn Thị Thanh Mai', 'GV16', '2017-12-07', 'mkktvt', 'QTDN', 'Đại học Công nghệ Giao thông Vận tải', 'nguyenthithanhmai@gmail.com', 'Thái Nguyên', '0987654323', '14963679_710723275753619_1378012536_o.jpg', '<p>Quản trị chất lượng</p>'),
(28, 'Trần Văn Tâm', 'GV17', '2017-12-20', 'mkktvt', 'QTDN', 'Đại học Công nghệ Giao thông Vận tải', 'tranvantan@gmail.com', 'Kiến Hưng-Hải Phòng', '0987676565', '10496917_345997665553221_3903439141374121369_o - Copy.jpg', '<p>Quản trị dự án đầu tư</p>'),
(29, 'Lê Thị Thu', NULL, '2017-12-02', 'mkktvt', 'KT', 'Đại Học Công nghệ Giao thông Vận Tải', 'lethithu@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '0989876767', '12208523_1656788374600047_332592549829393046_n - Copy.jpg', '<p>Kế toán tổng hợp</p>'),
(30, 'Lê Thị Hoài', NULL, '2017-12-18', 'mkktvt', 'QTDN', 'Đại học Công nghệ Giao thông Vận tải', 'lethihoai@gmail.com', 'Hải Hậu-Nam Định', '0989878899', '12208523_1656788374600047_332592549829393046_n - Copy.jpg', '<p>Tài chính tiền tệ</p>'),
(31, 'Trần Văn Tưởng', NULL, '2017-12-14', 'mkck', 'MXD', 'Đại học Công nghệ Giao thông Vận tải', 'tranvantuong@gmail.com', 'Xuân Thủy-Cầu Giấy', '0978565432', '10496917_345997665553221_3903439141374121369_o - Copy.jpg', '<p>Truyền động thủy&nbsp; lực và khí nén</p>'),
(32, 'Hoàng Văn Long', NULL, '2017-12-02', 'mkck', 'OTO', 'Đại học Công nghệ Giao thông Vận tải', 'hoanglong@gmail.com', 'Hải Hậu-Nam Định', '0164567867', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Lý thuyết ô tô</p>'),
(33, 'Trần Văn An', NULL, '2017-12-18', 'mkck', 'MTT', 'Đại học Công nghệ Giao thông Vận tải', 'tranvanan@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '978765651', 'IMG_9483.JPG', '<p>Nhiệt kĩ thuật</p>'),
(34, 'Cao Văn Hà', NULL, '2017-12-28', 'mkct', 'XDDD', 'Đại học Công nghệ Giao thông Vận tải', 'caoha@gmail.com', 'Hải Hậu-Nam Định', '0967676543', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Động lực học công trình</p>'),
(35, 'Trần Vĩnh Ninh', NULL, '2017-08-10', 'mkct', 'CD', 'Đại học Công nghệ Giao thông Vận tải', 'tranvinhninh@gmail.com', 'Thanh Xuân-Hà Nội', '0167897654', '10496917_345997665553221_3903439141374121369_o - Copy.jpg', '<p>Kết cấu thép</p>'),
(36, 'Lê Văn Nam', NULL, '2017-12-19', 'mkct', 'DB', 'Đại học Công nghệ Giao thông Vận tải', 'levannam@gmail.com', 'Nam Sách-Hải Dương', '0977878787', '14900480_1137324096350334_2851233879958154313_n.png', '<p>Máy xây dựng</p>'),
(37, 'Trần Văn Nam', NULL, '2017-12-26', 'mkct', 'DS', 'Đại học Công nghệ Giao thông Vận tải', 'tranvannam@gmail.com', 'Hà Đông-Hà Nội', '0176767890', 'IMG_9483.JPG', '<p>Thực hành trắc địa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hedaotao`
--

CREATE TABLE `tbl_hedaotao` (
  `id` int(11) NOT NULL,
  `tenhedaotao` varchar(50) DEFAULT NULL,
  `mahedaotao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_hedaotao`
--

INSERT INTO `tbl_hedaotao` (`id`, `tenhedaotao`, `mahedaotao`) VALUES
(4, 'Đại học chính quy', 'DHCQ'),
(5, 'Cao đẳng', 'CĐ'),
(6, 'Liên Thông', 'LT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoidong`
--

CREATE TABLE `tbl_hoidong` (
  `id` int(11) NOT NULL,
  `tenhoidong` varchar(100) DEFAULT NULL,
  `id_chutich` int(11) DEFAULT NULL,
  `id_thuky` int(11) DEFAULT NULL,
  `id_phanbien` int(11) DEFAULT NULL,
  `id_uyvien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_hoidong`
--

INSERT INTO `tbl_hoidong` (`id`, `tenhoidong`, `id_chutich`, `id_thuky`, `id_phanbien`, `id_uyvien`) VALUES
(1, 'Hội đồng 1', 17, 23, 24, 19),
(3, 'Hội đồng 2', 17, 19, 22, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khoa`
--

CREATE TABLE `tbl_khoa` (
  `id` int(11) NOT NULL,
  `makhoa` varchar(50) NOT NULL,
  `tenkhoa` varchar(50) DEFAULT NULL,
  `ngaythanhlap` date DEFAULT NULL,
  `mota` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_khoa`
--

INSERT INTO `tbl_khoa` (`id`, `makhoa`, `tenkhoa`, `ngaythanhlap`, `mota`) VALUES
(1, 'mkcntt', 'Công Nghệ Thông Tin', '2011-06-14', '<p><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, sans-serif; font-size: 14px; text-align: justify;\">Quản lý, tổ chức đào tạo trình độ cao đẳng, trình độ đại học, trình độ sau đại học và các trình độ khác thuộc khối ngành công nghệ thông tin, điện tử theo quy định của Bộ Giáo dục và Đào tạo, Bộ Lao động - Thương binh và Xã hội; thực hiện nghiên cứu khoa học, ứng dụng và chuyển giao công nghệ; gắn đào tạo với thực tiễn sản xuất</span><br></p>'),
(4, 'mkktvt', 'Kinh Tế Vận Tải', '1991-03-12', '<p><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, sans-serif; font-size: 14px;\">Quản lý, tổ chức đào tạo khối ngành kinh tế, vận tải trình độ cao đẳng, trình độ đại học, sau đại học và các trình độ khác theo quy định Bộ Giáo dục và Đào tạo, Bộ Lao động - Thương binh và xã hội; thực hiện nghiên cứu khoa học, ứng dụng và chuyển giao công nghệ; gắn đào tạo với thực tiễn sản xuất,</span></p><p><br></p>'),
(5, 'mkck', 'Cơ Khí', '1991-03-12', '<p><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, sans-serif; font-size: 14px;\">Quản lý, tổ chức đào tạo trình độ cao đẳng, trình độ đại học, trình độ sau đại học và các trình độ khác thuộc khối ngành công nghệ kỹ thuật cơ khí theo quy định của Bộ Giáo dục và Đào tạo, Bộ Lao động - Thương binh và Xã hội; thực hiện nghiên cứu khoa học, ứng dụng tiến bộ khoa học kỹ thuật và chuyển giao công nghệ; gắn đào tạo với thực tiễn sản xuất</span></p><p><br></p>'),
(6, 'mkct', 'Công Trình', '1945-04-12', '<p><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, sans-serif; font-size: 14px;\">Hàng năm Khoa thực hiện các đề tài NCKH cấp Nhà nước, cấp bộ, cấp trường đạt kết quả tốt. Hoạt động &nbsp;NCKH sinh viên ngày càng đạt hiệu quả cao, công bố nhiều bài báo trên tạp chí chuyên ngành trong nước và quốc tế.</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lop`
--

CREATE TABLE `tbl_lop` (
  `id` int(11) NOT NULL,
  `tenlop` varchar(50) DEFAULT NULL,
  `malop` varchar(50) DEFAULT NULL,
  `id_makhoa` varchar(50) DEFAULT NULL,
  `id_machuyennganh` varchar(50) DEFAULT NULL,
  `id_mahedaotao` varchar(50) DEFAULT NULL,
  `id_nienkhoa` int(11) DEFAULT NULL,
  `niemkhoa` varchar(50) DEFAULT NULL,
  `siso` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_lop`
--

INSERT INTO `tbl_lop` (`id`, `tenlop`, `malop`, `id_makhoa`, `id_machuyennganh`, `id_mahedaotao`, `id_nienkhoa`, `niemkhoa`, `siso`) VALUES
(10, '64DCTH01', '64DCTH01', 'mkcntt', 'HTTT', 'DHCQ', 5, NULL, 5),
(11, '64DCTH02', '64DCTH02', 'mkcntt', 'HTTT', 'DHCQ', 5, NULL, 5),
(12, '64DCTH03', '64DCTH03', 'mkcntt', 'HTTT', 'DHCQ', 5, NULL, 5),
(13, '64DCDT01', '64DCDT01', 'mkcntt', 'DTVT', 'DHCQ', 5, NULL, 5),
(14, '64DCDT02', '64DCDT02', 'mkcntt', 'DTVT', 'DHCQ', 5, NULL, 1),
(15, '64DCDT03', '64DCDT03', 'mkcntt', 'DTVT', 'DHCQ', 5, NULL, 1),
(16, '64DCDD01', '64DCDD01', 'mkct', 'XDDD', 'DHCQ', 5, NULL, 0),
(17, '64DCDD02', '64DCDD02', 'mkct', 'XDDD', 'DHCQ', 5, NULL, 0),
(18, '64DCDD03', '64DCDD03', 'mkct', 'XDDD', 'DHCQ', 5, NULL, 0),
(19, '64DCKT01', '64DCKT01', 'mkktvt', 'KT', 'DHCQ', 5, NULL, 1),
(20, '64DCKT02', '64DCKT02', 'mkktvt', 'KT', 'DHCQ', 5, NULL, 0),
(21, '64DCKT03', '64DCKT03', 'mkktvt', 'KT', 'DHCQ', 5, NULL, 0),
(22, '64DCOTO01', '64DCOTO01', 'mkck', 'OTO', 'DHCQ', 5, NULL, 1),
(23, '64DCOTO02', '64DCOTO02', 'mkck', 'OTO', 'DHCQ', 5, NULL, 0),
(24, '64DCOTO03', '64DCOTO03', 'mkck', 'OTO', 'DHCQ', 5, NULL, 0),
(25, '65DCTH01', '65DCTH01', 'mkcntt', 'HTTT', 'DHCQ', 9, NULL, 0),
(29, '64DCQTDN01', '64DCQTDN01', 'mkktvt', 'QTDN', 'DHCQ', 5, NULL, 1),
(30, '64DCQTDN02', '64DCQTDN02', 'mkktvt', 'QTDN', 'DHCQ', 5, NULL, 0),
(31, '64DCQTDN03', '64DCQTDN03', 'mkktvt', 'QTDN', 'DHCQ', 5, NULL, 0),
(32, '64DCMXD01', '64DCMXD01', 'mkck', 'MXD', 'DHCQ', 5, NULL, 1),
(33, '64DCMXD02', '64DCMXD02', 'mkck', 'MXD', 'DHCQ', 5, NULL, 0),
(34, '64DCMXD03', '64DCMXD03', 'mkck', 'MXD', 'DHCQ', 5, NULL, 0),
(35, '64DCMTT01', '64DCMTT01', 'mkck', 'MTT', 'DHCQ', 5, NULL, 1),
(36, '64DCMTT02', '64DCMTT02', 'mkck', 'MTT', 'DHCQ', 5, NULL, 0),
(37, '64DCMTT03', '64DCMTT03', 'mkck', 'MTT', 'DHCQ', 5, NULL, 0),
(38, '64DCCD01', '64DCCD01', 'mkct', 'CD', 'DHCQ', 5, NULL, 0),
(39, '64DCCD02', '64DCCD02', 'mkct', 'CD', 'DHCQ', 5, NULL, 0),
(40, '64DCCD03', '64DCCD03', 'mkct', 'CD', 'DHCQ', 5, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nienkhoa`
--

CREATE TABLE `tbl_nienkhoa` (
  `id` int(11) NOT NULL,
  `tenkhoa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_nienkhoa`
--

INSERT INTO `tbl_nienkhoa` (`id`, `tenkhoa`) VALUES
(5, '2013-2018'),
(6, '2012-2017'),
(7, '2011-2016'),
(8, '2010-2015'),
(9, '2014-2019');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quanly`
--

CREATE TABLE `tbl_quanly` (
  `id` int(11) NOT NULL,
  `tenquanly` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_quanly`
--

INSERT INTO `tbl_quanly` (`id`, `tenquanly`, `email`, `matkhau`) VALUES
(1, 'Trung Phú', 'doantotnghiep@gmail.com', '123456789'),
(2, 'nguyenphuong', 'phuongnb@gmail.com', '123412'),
(3, 'phuongnb94', 'phuong@gmail.com', '1234512');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sinhvien`
--

CREATE TABLE `tbl_sinhvien` (
  `id` int(11) NOT NULL,
  `tensinhvien` varchar(50) DEFAULT NULL,
  `masinhvien` varchar(50) DEFAULT NULL,
  `matkhau` varchar(20) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `id_makhoa` varchar(50) NOT NULL,
  `id_machuyennganh` varchar(50) NOT NULL,
  `id_malop` varchar(50) NOT NULL,
  `id_mahedaotao` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quequan` varchar(100) NOT NULL,
  `sodienthoai` varchar(15) NOT NULL,
  `hinhanh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sinhvien`
--

INSERT INTO `tbl_sinhvien` (`id`, `tensinhvien`, `masinhvien`, `matkhau`, `ngaysinh`, `id_makhoa`, `id_machuyennganh`, `id_malop`, `id_mahedaotao`, `email`, `quequan`, `sodienthoai`, `hinhanh`) VALUES
(6, 'Lê Thị Phương My', '64DCTH3090', '123456', '1995-01-15', 'mkcntt', 'HTTT', '64DCTH03', 'DHCQ', 'myhoi1995@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '0995496181', '12208523_1656788374600047_332592549829393046_n - Copy.jpg'),
(7, 'Thái Thị THùy Trang', '64DCTH1234', '123456', '1995-04-12', 'mkcntt', 'HTTT', '64DCTH03', 'DHCQ', 'thaitrang@gmail.com', 'Đô Lương-Nghệ An', '0954263547', '12208523_1656788374600047_332592549829393046_n - Copy.jpg'),
(8, 'Trần Văn Phúc', '64DCTH1235', '123456', '1995-04-12', 'mkcntt', 'HTTT', '64DCTH01', 'DHCQ', 'tranvanphuc@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '01675536372', '12208523_1656788374600047_332592549829393046_n - Copy.jpg'),
(9, 'Hoàng Thị Hằng', '64DCTH2344', '123456', '1995-03-31', 'mkcntt', 'HTTT', '64DCTH01', 'DHCQ', 'hoanghang', 'Hiệp Hòa-Bắc Giang', '01644911148', '12231493_628792180591837_753912344_n - Copy.jpg'),
(10, 'Vũ Thị Mỹ Hạnh', '64DCTH6544', '123456', '2017-12-16', 'mkcntt', 'DTVT', '64DCDT01', 'DHCQ', 'hanh@gmail.com', 'Hoàng Mai-Hà Nội', '0965123345', ''),
(11, 'Vũ Thị Mỹ Hạnh', '64DCTH2345', '123456', '2017-12-07', 'mkcntt', 'HTTT', '64DCTH01', 'DHCQ', 'vuhanh@gmail.com', 'Đống Đa-Hà Nội', '0164723123', ''),
(12, 'Vũ Thị Thùy', '64DCTH3546', '123456', '2017-12-02', 'mkcntt', 'HTTT', '64DCTH01', 'DHCQ', 'vuthithuy@gmail.com', 'Đô Lương-Nghệ An', '0965364532', ''),
(13, 'Trần Văn Khôi', '64DCTH1236', '123456', '2017-12-08', 'mkcntt', 'HTTT', '64DCTH01', 'DHCQ', 'tranvakhoi@gmail.com', 'Thanh Xuân Bắn-Hà Nội', '0976768765', ''),
(14, 'Trịnh Quang Hưng', '64DCTH2321', '123456', '2017-12-06', 'mkcntt', 'HTTT', '64DCTH02', 'DHCQ', 'trinhquanghung@gmail.com', 'Thanh Bính-Thanh Hà-Hải Dương', '0978766767', ''),
(15, 'Vũ Hoàng Anh', '64DCTH0989', '123456', '2017-08-09', 'mkcntt', 'HTTT', '64DCTH02', 'DHCQ', 'vuhoanganh@gmail.com', 'Quỳnh Lưu-Nghệ An', '0977879876', ''),
(16, 'Nguyễn Văn Tân', '64DCTH8987', '123456', '2017-12-08', 'mkcntt', 'HTTT', '64DCTH02', 'DHCQ', 'nguyenvantan@gmail.com', 'Vĩnh Lập-Thanh Hà-Hải Dương', '0989876767', ''),
(17, 'Võ Thu Lý', '64DCTH9876', '123456', '2017-12-20', 'mkcntt', 'HTTT', '64DCTH02', 'DHCQ', 'vothuly@gmail.com', 'Mỹ Đức- Hà Nội', '01678789890', ''),
(18, 'Lê Nguyễn Vương Khang', '64DCTH9098', '123456', '2017-12-09', 'mkcntt', 'HTTT', '64DCTH02', 'DHCQ', 'lenguyenvuongkhang@gmail.com', 'Bát Trang-Hải Phòng', '0954676545', ''),
(19, 'Lê Thị Thu Hương', '64DCTH3423', '123456', '2017-12-14', 'mkcntt', 'HTTT', '64DCTH03', 'DHCQ', 'thuhuong@gmail.com', 'Quỳnh Lưu-Nghệ An', '0987676565', ''),
(20, 'Lê Văn Nam', '64DCTH7676', '123456', '2017-12-09', 'mkcntt', 'HTTT', '64DCTH03', 'DHCQ', 'levannam@gmail.com', 'Bát Trang-Hải Phòng', '0967676543', ''),
(21, 'Đinh Thị Hằng', '64DCTH8980', '123456', '2017-12-03', 'mkcntt', 'HTTT', '64DCTH03', 'DHCQ', 'dinhthihang@gmail.com', 'Thanh Thủy-Thanh Hà-Hải Dương', '0956765432', ''),
(22, 'Lê Thị Thu Thủy', '64DCDT9098', '123456', '2017-09-01', 'mkcntt', 'DTVT', '64DCDT01', 'DHCQ', 'thuthuy@gmail.com', 'Gia Lâm-Hà Nội', '0912565432', ''),
(23, 'Trần Văn Thực', '64DCDT8900', '123456', '2017-12-29', 'mkcntt', 'DTVT', '64DCDT01', 'DHCQ', 'tranvanthuc@gmail.com', 'Quán Trang-Hải Phòng', '0978787654', ''),
(24, 'Liêu Văn Ninh', '64DCDT9899', '123456', '2017-12-11', 'mkcntt', 'DTVT', '64DCDT01', 'DHCQ', 'lieuvanninh@gmail.com', 'Thanh Hà-Hải Dương', '0987876543', ''),
(25, 'Lê Sĩ Hợi', '64DCĐT8906', '123456', '2017-12-09', 'mkcntt', 'DTVT', '64DCDT01', 'DHCQ', 'lesihoi@gmail.com', 'Thành Thịnh-Thanh Hà-Hải Dương', '0165787654', ''),
(26, 'Trần Hữu Nghĩa', '64DCKT8980', '123456', '2017-12-20', 'mkktvt', 'KT', '64DCKT01', 'DHCQ', 'tranhuunghia@gmail.com', 'Hải Dương', '0978789098', ''),
(27, 'Lê Thị Phương Mai', '64DCQTDN7876', '123456', '2017-12-14', 'mkktvt', 'QTDN', '64DCQTDN01', 'DHCQ', 'lethiphuongmai@gmail.com', 'Hải Phòng', '0129876543', ''),
(28, 'Trần Văn Thực', '64DCOTO8909', '123456', '2017-12-28', 'mkck', 'OTO', '64DCOTO01', 'DHCQ', 'vanthuc@gmail.com', 'Hà Tĩnh', '0897654321', ''),
(29, 'Lê Thị Luyến', '64DCDT8876', '123456', '2017-12-27', 'mkcntt', 'DTVT', '64DCDT02', 'DHCQ', 'luyen@gmail.com', 'Nam Định', '0978765432', ''),
(30, 'Lê Thị Lan', '64DCDT6543', '123456', '2017-12-25', 'mkcntt', 'DTVT', '64DCDT03', 'DHCQ', 'lelan@gmail.com', 'Hưng Yên', '0278787654', ''),
(31, 'Trần Văn An', '64DCMXD8904', '123456', '2017-09-15', 'mkck', 'MXD', '64DCMXD01', 'DHCQ', 'tranvanan@gmail.com', 'Nam Sách-Hải Dương', '0123456789', ''),
(32, 'Lê Văn Luyện', '64DCMTT5654', '123456', '2017-12-13', 'mkck', 'MTT', '64DCMTT01', 'DHCQ', 'levanluyen@mail.com', 'Bát Trang-An Lão-Hải Phòng', '0954543211', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doan`
--
ALTER TABLE `tbl_doan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doan_giaovien`
--
ALTER TABLE `tbl_doan_giaovien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_giaovien`
--
ALTER TABLE `tbl_giaovien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hedaotao`
--
ALTER TABLE `tbl_hedaotao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hoidong`
--
ALTER TABLE `tbl_hoidong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_khoa`
--
ALTER TABLE `tbl_khoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makhoa` (`makhoa`);

--
-- Indexes for table `tbl_lop`
--
ALTER TABLE `tbl_lop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nienkhoa`
--
ALTER TABLE `tbl_nienkhoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quanly`
--
ALTER TABLE `tbl_quanly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_doan`
--
ALTER TABLE `tbl_doan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_doan_giaovien`
--
ALTER TABLE `tbl_doan_giaovien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_giaovien`
--
ALTER TABLE `tbl_giaovien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_hedaotao`
--
ALTER TABLE `tbl_hedaotao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_hoidong`
--
ALTER TABLE `tbl_hoidong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_khoa`
--
ALTER TABLE `tbl_khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_lop`
--
ALTER TABLE `tbl_lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_nienkhoa`
--
ALTER TABLE `tbl_nienkhoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_quanly`
--
ALTER TABLE `tbl_quanly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
