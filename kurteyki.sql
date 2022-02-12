-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 11:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurteyki`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_post`
--

CREATE TABLE `tb_blog_post` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `title` mediumtext NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `id_category` varchar(255) NOT NULL,
  `id_tags` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `status` enum('Published','Draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_post`
--

INSERT INTO `tb_blog_post` (`id`, `id_user`, `title`, `permalink`, `image`, `time`, `updated`, `id_category`, `id_tags`, `content`, `description`, `views`, `status`) VALUES
(1, 0, 'Konten Baru dan Rencana Kedepannya Situs ini', 'konten-baru-dan-rencana-kedepannya-situs-ini', 'images/banner.png', '2020-03-21 18:44:00', '2020-05-03 11:57:11', '1', '1', '&lt;p&gt;kini saya akan mengaktifkan situs ini menjadi sebuah blog. situs ini nantinya akan dipenuhi dengan tulisan tentang pengembangan diri.&lt;/p&gt;\r\n\r\n&lt;p&gt;alasan saya menuliskan tentang pengembangan diri di situs ini adalah untuk mencatat apa saja yang telah saya pelajari tentang pengembangan diri dan mungkin bisa berguna untuk para pembaca sekalian.&lt;/p&gt;\r\n\r\n&lt;p&gt;sedikit gambaran tentang pengembangan diri, jadi pengembangan diri menurut saya itu seperti mengasah kemampuan diri untuk menjalani hidup ini. dengan adanya pemahaman tentang skill hidup maka untuk menjalani kehidupan ini juga kita akan selalu merasa mudah.&lt;/p&gt;\r\n', '', 72, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_post_category`
--

CREATE TABLE `tb_blog_post_category` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_post_category`
--

INSERT INTO `tb_blog_post_category` (`id`, `name`, `slug`) VALUES
(1, 'news', 'news');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_post_comment`
--

CREATE TABLE `tb_blog_post_comment` (
  `id` int(255) NOT NULL,
  `id_blog_post` int(255) NOT NULL,
  `parent` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `log` varchar(255) NOT NULL,
  `status` enum('Approved','Blocked','Pending') NOT NULL,
  `status_read` enum('Read','Unread') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_post_tags`
--

CREATE TABLE `tb_blog_post_tags` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_post_tags`
--

INSERT INTO `tb_blog_post_tags` (`id`, `name`, `slug`) VALUES
(1, 'berita', 'berita');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_template`
--

CREATE TABLE `tb_blog_template` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` enum('Active','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_template`
--

INSERT INTO `tb_blog_template` (`id`, `name`, `path`, `status`) VALUES
(1, 'Pisen Creative', 'pisen', 'No'),
(2, 'Mediumish', 'mediumish', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_template_style`
--

CREATE TABLE `tb_blog_template_style` (
  `id` int(255) NOT NULL,
  `id_template` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_template_style`
--

INSERT INTO `tb_blog_template_style` (`id`, `id_template`, `type`, `name`, `file`, `status`) VALUES
(1, 1, 'homepage', 'List with Sidebar', 'list_with_sidebar', 'Active'),
(2, 1, 'post', 'Post Center', 'post_center', 'No'),
(3, 1, 'homepage', 'Grid Two Column', 'grid_two_column', 'No'),
(4, 1, 'homepage', 'Clasic', 'clasic', 'No'),
(5, 1, 'post', 'Post Center Full', 'post_center_full', 'No'),
(6, 1, 'post', 'Post Sidebar', 'post_sidebar', 'Active'),
(7, 2, 'homepage', 'Default', 'default', 'Active'),
(8, 2, 'post', 'Default', 'default', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_template_widget`
--

CREATE TABLE `tb_blog_template_widget` (
  `id` int(255) NOT NULL,
  `id_template` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `var` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data_json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_blog_template_widget`
--

INSERT INTO `tb_blog_template_widget` (`id`, `id_template`, `name`, `var`, `type`, `data_json`) VALUES
(1, 1, 'Footer 1', 'link1_footer', 'pages', '{\"status\":\"active\",\"title\":\"Pages\",\"id\":[\"1\"]}'),
(2, 1, 'Footer 2', 'link2_footer', 'link', '{\"status\":\"active\",\"title\":\"Other Site\",\"content\":[{\"text\":\"Riedayme\",\"url\":\"https:\\/\\/riedayme.kurteyki.com\\/\"},{\"text\":\"Shinmu\",\"url\":\"https:\\/\\/shinmu.kurteyki.com\\/\"}]}'),
(3, 1, 'Contact Footer', 'contact_footer', 'text', '{\"status\":\"active\",\"title\":\"Contact Us\",\"content\":\"Bogor, Indonesia \\r\\nkurteyki@gmail.com\\r\\n<div class=\\\"social-contact\\\"> <a title=\\\"Facebook\\\" target=\\\"_blank\\\" class=\\\"icon-btn\\\" href=\\\"https:\\/\\/facebook.com\\/kurteyki\\\" style=\'background:#fff\'><i class=\\\"fa fa-facebook\\\"><\\/i><\\/a> <\\/div>\"}'),
(4, 1, 'Logo Template', 'logo', 'image', '{\"status\":\"active\",\"content\":\"image4_20200411172145.png\"}'),
(5, 1, 'Ads Content Top', 'ads_content_top', 'ads', '{\"status\":\"nonactive\",\"content\":\"<a href=\\\"https:\\/\\/placeholder.com\\\"><img src=\\\"https:\\/\\/via.placeholder.com\\/768x120\\\"><\\/a>\"}'),
(6, 1, 'Ads Content Bottom', 'ads_content_bottom', 'ads', '{\"status\":\"nonactive\",\"content\":\"<div><a href=\\\"https:\\/\\/placeholder.com\\\"><img src=\\\"https:\\/\\/via.placeholder.com\\/768x120\\\"><\\/a><\\/div>\"}'),
(7, 1, 'Ads Content Middle', 'ads_content_middle', 'ads-content', '{\"status\":\"nonactive\",\"content\":\"<a href=\\\"https:\\/\\/placeholder.com\\\"><img src=\\\"https:\\/\\/via.placeholder.com\\/768x120\\\"><\\/a>\",\"loop_ads\":\"2\"}'),
(8, 1, 'Ads Sidebar', 'ads_sidebar', 'ads', '{\"status\":\"nonactive\",\"content\":\"<a href=\\\"https:\\/\\/placeholder.com\\\"><img src=\\\"https:\\/\\/via.placeholder.com\\/150\\\"><\\/a>\"}'),
(9, 1, 'Navigation Header', 'menu_header', 'category', '{\"status\":\"active\",\"title\":\"Header\",\"id\":[\"1\"]}'),
(10, 1, 'Popular Post Sidebar', 'popular_post', 'popular-post', '{\"status\":\"active\",\"title\":\"Dilihat paling banyak\",\"max_result\":\"5\"}'),
(11, 1, 'Category Sidebar', 'category_sidebar', 'category', '{\"status\":\"active\",\"title\":\"Kategori\",\"id\":null}'),
(12, 1, 'Tags Sidebar', 'tags_sidebar', 'tags', '{\"status\":\"active\",\"title\":\"Sub Kategori\",\"id\":null}'),
(13, 2, 'Featured Homepage', 'featured_homepage', 'featured-post', '{\"status\":\"nonactive\",\"title\":\"Artikel Pilihan\",\"id\":[\"1\"]}'),
(14, 2, 'Ads Content Top', 'ads_content_top', 'ads', '{\"status\":\"nonactive\",\"content\":\"\"}'),
(15, 2, 'Ads Content Bottom', 'ads_content_bottom', 'ads', '{\"status\":\"nonactive\",\"content\":\"\"}'),
(16, 2, 'Logo Header', 'logo_header', 'image', '{\"status\":\"active\",\"content\":\"image16_20200408092129.png\"}'),
(17, 2, 'Ads Post Content', 'ads_post_content', 'ads-content', '{\"status\":\"nonactive\",\"content\":\"<a href=\\\"https:\\/\\/placeholder.com\\\"><img src=\\\"https:\\/\\/via.placeholder.com\\/768x120\\\"><\\/a>\",\"loop_ads\":\"1\"}'),
(18, 2, 'Footer Pages', 'footer_pages', 'pages', '{\"status\":\"nonactive\",\"title\":\"Pages\",\"id\":null}'),
(19, 2, 'Navigation Header', 'navigation_header', 'pages', '{\"status\":\"nonactive\",\"title\":\"Menu\",\"id\":[\"1\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobs`
--

CREATE TABLE `tb_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `payload` text COMMENT 'JSON payload',
  `response` text,
  `status` enum('running','queued','done') NOT NULL DEFAULT 'queued',
  `run_time` double DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jobs`
--

INSERT INTO `tb_jobs` (`id`, `name`, `payload`, `response`, `status`, `run_time`, `created`) VALUES
(1, 'sendEmail', '{\"to\":\"programmer.irfaan@gmail.com\",\"subject\":\"Vertifikasi Email\",\"message\":\"Terima kasih telah mendaftar,\\r\\n            <br\\/><br\\/>\\r\\n            Silahkan klik link dibawah ini untuk mengaktifkan akun anda :\\r\\n            <br\\/><br\\/>\\r\\n            <a href=\'http:\\/\\/localhost\\/kurteyki\\/auth\\/confirm\\/b69b245dd7a7166b1c9d52fffb00cfc2\'>http:\\/\\/localhost\\/kurteyki\\/auth\\/confirm\\/b69b245dd7a7166b1c9d52fffb00cfc2<\\/a>\\r\\n            <br\\/><br\\/>\\r\\n            \"}', NULL, 'queued', NULL, '2020-05-03 20:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_category`
--

CREATE TABLE `tb_lms_category` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(255) NOT NULL,
  `time` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `icon` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_lms_category`
--

INSERT INTO `tb_lms_category` (`id`, `name`, `slug`, `parent`, `time`, `updated`, `icon`, `image`) VALUES
(1, 'Pengembangan Diri', 'pengembangan-diri', 0, '2020-04-11 16:51:46', '0000-00-00 00:00:00', 'fa-globe', ''),
(2, 'Skill Hidup', 'skill-hidup', 1, '2020-04-11 16:52:14', '0000-00-00 00:00:00', 'fa-hand-grab-o', ''),
(3, 'Karakter', 'karakter', 1, '2020-04-11 19:37:18', '2020-04-11 19:37:40', 'fa-star-o', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_coupon`
--

CREATE TABLE `tb_lms_coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expired` datetime NOT NULL,
  `type` enum('Price','Percent') NOT NULL,
  `data` varchar(255) NOT NULL,
  `for` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_courses`
--

CREATE TABLE `tb_lms_courses` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `title` mediumtext NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `faq` text NOT NULL,
  `id_category` varchar(255) NOT NULL,
  `id_sub_category` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `price` int(255) NOT NULL,
  `discount` int(255) NOT NULL,
  `views` int(11) NOT NULL,
  `status` enum('Published','Draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_lms_courses`
--

INSERT INTO `tb_lms_courses` (`id`, `id_user`, `title`, `permalink`, `image`, `description`, `faq`, `id_category`, `id_sub_category`, `time`, `updated`, `price`, `discount`, `views`, `status`) VALUES
(1, 2, 'Dummy Course 2', 'dummy-course-2', 'images/1911368.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n', '1', '3', '2020-04-11 16:53:44', '2022-02-11 17:06:52', 0, 0, 219, 'Published'),
(2, 2, 'Dummy Course 1', 'dummy-course-1', 'images/1911368.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n', '1', '2', '2020-04-11 22:19:25', '2022-02-11 17:06:44', 0, 0, 245, 'Published'),
(3, 1, 'Dummy Course 3', 'dummy-course-3', 'images/1911368.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n', '', '1', '2', '2022-02-11 17:03:54', '2022-02-11 17:04:05', 0, 0, 1, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_courses_lesson`
--

CREATE TABLE `tb_lms_courses_lesson` (
  `id` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `id_section` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `order` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_lms_courses_lesson`
--

INSERT INTO `tb_lms_courses_lesson` (`id`, `id_courses`, `id_section`, `title`, `type`, `content`, `order`) VALUES
(1, 1, 1, 'Kenapa harus memiliki tujuan', 'Text', '', 1),
(2, 1, 2, 'Meyakinkan diri', 'Video', '', 2),
(3, 1, 2, 'Kenapa harus yakin ?', 'Video', '', 1),
(4, 1, 1, 'Memiliki tujuan besar', 'Video', '', 2),
(5, 1, 5, 'emosi dapat mempengaruhi tindakan', 'Text', '', 0),
(6, 1, 6, 'Penundaan adalah rintangan utama kesuksesan', 'Text', '', 0),
(7, 1, 3, 'Waktu yang diberikan sama apa yang membedakannya ?', 'Text', '', 0),
(8, 1, 4, 'Tujuan Hidupmu ? ', 'Text', '', 0),
(9, 2, 7, 'Material 1', 'Text', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 0),
(10, 2, 8, 'Material 2', 'Text', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 0),
(11, 3, 9, 'Good 1', 'Video', '', 0),
(12, 3, 10, 'Good 2', 'Image', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_courses_section`
--

CREATE TABLE `tb_lms_courses_section` (
  `id` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_lms_courses_section`
--

INSERT INTO `tb_lms_courses_section` (`id`, `id_courses`, `title`, `order`) VALUES
(1, 1, 'Mempunyai Tujuan', 1),
(2, 1, 'Yakin dengan Diri Sendiri', 2),
(3, 1, 'Mengatur Waktu', 4),
(4, 1, 'Merancang Tujuan Hidup', 3),
(5, 1, 'Emosi adalah sumber Motivasi', 6),
(6, 1, 'Meninggalkan Penundaan', 5),
(7, 2, 'Dummy Section', 0),
(8, 2, 'Dummy Section 2', 0),
(9, 3, 'Section 1', 0),
(10, 3, 'Section 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_template`
--

CREATE TABLE `tb_lms_template` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` enum('Active','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_lms_template`
--

INSERT INTO `tb_lms_template` (`id`, `name`, `path`, `status`) VALUES
(1, 'Default - App', 'default-app', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_template_widget`
--

CREATE TABLE `tb_lms_template_widget` (
  `id` int(255) NOT NULL,
  `id_template` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `var` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data_json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_courses`
--

CREATE TABLE `tb_lms_user_courses` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_lesson`
--

CREATE TABLE `tb_lms_user_lesson` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_payment`
--

CREATE TABLE `tb_lms_user_payment` (
  `id` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `id_courses_user` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `proof` text NOT NULL,
  `coupon` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` enum('Purchased','Pending','Checking','Failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_review`
--

CREATE TABLE `tb_lms_user_review` (
  `id` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `review` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lms_user_wishlist`
--

CREATE TABLE `tb_lms_user_wishlist` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_courses` int(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_site`
--

CREATE TABLE `tb_site` (
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_site`
--

INSERT INTO `tb_site` (`type`, `data`) VALUES
('ads_txt', ''),
('blog_comment', '{\"type\":\"disable\",\"disqus_shortname\":\"kurteyki\",\"disqus_developer\":\"1\",\"moderate\":\"true\",\"message\":\"Komentar diblokir\"}'),
('blog_limit_post', '1'),
('cache', 'No'),
('cookie_notification', '{\"status\":\"Yes\",\"message\":\"Situs web ini menggunakan cookie untuk mempersonalisasi konten dan menganalisis lalu lintas untuk menawarkan pengalaman yang lebih baik kepada Anda.\"}'),
('currency_format', 'IDR'),
('description', 'Ilmu Pengembangan Diri untuk Hidup yang lebih baik.'),
('fb_app', '{\"facebook_app_id\":\"\",\"facebook_app_secret\":\"\"}'),
('google_api', '{\"client_id\":\"\",\"client_secret\":\"\"}'),
('google_recaptcha', '{\"status\":\"No\",\"site_key\":\"\",\"secret_key\":\"\"}'),
('icon', 'icon_20200408075727.png'),
('image', 'logo_20200415181034.png'),
('language', 'indonesia'),
('lms_free_courses_readable', 'No'),
('lms_limit_post', '6'),
('meta_open_graph', '{\"app_id\":\"\",\"publisher\":\"https:\\/\\/www.facebook.com\\/kurteyki\",\"author\":\"https:\\/\\/www.facebook.com\\/kurteyki\",\"default_image\":\"open_graph_default_image_20200415181017.png\"}'),
('meta_schema', '{\"type\":\"Person\",\"content\":{\"person_name\":\"Faanteyki\",\"person_alternateName\":\"Faan\",\"person_gender\":\"male\",\"person_height\":\"163 centimetre\",\"person_birthDate\":\"1999-08-30\",\"person_birthPlace\":\"Bogor, Jawabarat\",\"person_nationality\":\"Indonesia\",\"person_alumniOf\":\"Bobobib\",\"person_memberOf\":\"Kurteyki\",\"person_streetAddress\":\"RT.05 RW.04 NO.C23\",\"person_addressLocality\":\"Cibinong\",\"person_addressRegion\":\"Indonesia\",\"person_postalCode\":\"16916\",\"person_email\":\"life.irfaan@gmail.com\",\"person_telephone\":\"+62 813 8921 5100\",\"person_url\":\"https:\\/\\/faanteyki.blogspot.com\",\"person_sameAs\":\"https:\\/\\/facebook.com\\/faanteyki\",\"person_jobTitle\":\"Bobobib\",\"person_worksFor_name\":\"Bobobib\",\"person_worksFor_sameAs\":\"https:\\/\\/facebook.com\\/kurteyki\",\"organization_name\":\"Kurteyki\",\"organization_url\":\"https:\\/\\/www.kurteyki.com\\/\",\"organization_contactPoint_telephone\":\"+62 813 8921 5100\",\"organization_contactPoint_contactType\":\"customer service\",\"organization_sameAs\":\"https:\\/\\/facebook.com\\/kurteyki\",\"organization_logo_url\":\"organization_logo_url_20200424151642.png\",\"person_image\":\"person_image_20200415181017.png\"}}'),
('meta_twitter_card', '{\"publisher\":\"@kurteyki\",\"default_image\":\"twitter_card_default_image_20200415181017.png\"}'),
('no_image', 'no_image_20200408075727.jpg'),
('payment_method', 'Manual'),
('payment_midtrans', '{\"status_production\":\"No\",\"client_key\":\"\",\"server_key\":\"\"}'),
('robots_txt', 'User-agent: *\r\nAllow: /\r\n\r\nSitemap: [sitemap_url]'),
('slogan', 'Belajar pengembangan diri.'),
('smtp', '{\"protocol\":\"smtp\",\"smtp_host\":\"smtp.googlemail.com\",\"smtp_port\":\"465\",\"smtp_user\":\"\",\"smtp_pass\":\"\"}'),
('time_zone', 'Asia/Jakarta'),
('title', 'Kurteyki'),
('updated', '2022-02-11 16:57:44'),
('user_limit_data', '5'),
('vertification_email', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_pages`
--

CREATE TABLE `tb_site_pages` (
  `id` int(255) NOT NULL,
  `title` text NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` enum('Published','Draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_site_pages`
--

INSERT INTO `tb_site_pages` (`id`, `title`, `permalink`, `time`, `updated`, `content`, `status`) VALUES
(1, 'Kebijakan Privasi', 'kebijakan-privasi', '2020-03-21 18:36:40', '2022-02-11 16:56:53', '&lt;p&gt;Di Kurteyki, dapat diakses dari kurteyki.com, salah satu prioritas utama kami adalah privasi pengunjung kami. Dokumen Kebijakan Privasi ini berisi jenis informasi yang dikumpulkan dan dicatat oleh Kurteyki dan bagaimana kami menggunakannya.&lt;/p&gt;\r\n\r\n&lt;p&gt;Jika Anda memiliki pertanyaan tambahan atau memerlukan informasi lebih lanjut tentang Kebijakan Privasi kami, jangan ragu untuk menghubungi kami.&lt;/p&gt;\r\n\r\n&lt;h2&gt;File Log&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kurteyki mengikuti prosedur standar menggunakan file log. File-file ini mencatat pengunjung ketika mereka mengunjungi situs web. Semua perusahaan hosting melakukan ini dan bagian dari analisis layanan hosting. Informasi yang dikumpulkan oleh file log termasuk alamat protokol internet (IP), tipe browser, Penyedia Layanan Internet (ISP), cap tanggal dan waktu, halaman rujukan / keluar, dan mungkin jumlah klik. Ini tidak terkait dengan informasi apa pun yang dapat diidentifikasi secara pribadi. Tujuan dari informasi ini adalah untuk menganalisis tren, mengelola situs, melacak pergerakan pengguna di situs web, dan mengumpulkan informasi demografis.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Cookie dan Beacon Web&lt;/h2&gt;\r\n\r\n&lt;p&gt;Seperti situs web lainnya, Kurteyki menggunakan &amp;#39;cookies&amp;#39;. Cookie ini digunakan untuk menyimpan informasi termasuk preferensi pengunjung, dan halaman-halaman di situs web yang diakses atau dikunjungi pengunjung. Informasi ini digunakan untuk mengoptimalkan pengalaman pengguna dengan menyesuaikan konten halaman web kami berdasarkan jenis browser pengunjung dan / atau informasi lainnya.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Google DoubleClick Cookie DART&lt;/h2&gt;\r\n\r\n&lt;p&gt;Google adalah salah satu vendor pihak ketiga di situs kami. Itu juga menggunakan cookie, yang dikenal sebagai cookie DART, untuk menayangkan iklan kepada pengunjung situs kami berdasarkan kunjungan mereka ke www.website.com dan situs lain di internet. Namun, pengunjung dapat memilih untuk menolak penggunaan cookie DART dengan mengunjungi iklan Google dan jaringan konten Kebijakan Privasi di URL berikut - https://policies.google.com/technologies/ads&lt;/p&gt;\r\n\r\n&lt;h2&gt;Mitra Iklan Kami&lt;/h2&gt;\r\n\r\n&lt;p&gt;Beberapa pengiklan di situs kami mungkin menggunakan cookie dan suar web. Mitra iklan kami tercantum di bawah ini. Setiap mitra periklanan kami memiliki Kebijakan Privasi sendiri untuk kebijakan mereka tentang data pengguna. Untuk akses yang lebih mudah, kami hyperlink ke Kebijakan Privasi mereka di bawah ini.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Google\r\n	&lt;ul&gt;\r\n		&lt;li&gt;https://policies.google.com/technologies/ads&lt;/li&gt;\r\n	&lt;/ul&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;h2&gt;Kebijakan Privasi&lt;/h2&gt;\r\n\r\n&lt;p&gt;Anda dapat berkonsultasi daftar ini untuk menemukan Kebijakan Privasi untuk masing-masing mitra periklanan Kurteyki. Kebijakan Privasi kami dibuat dengan bantuan Generator Kebijakan Privasi Gratis dan Generator Kebijakan Privasi Online.&lt;/p&gt;\r\n\r\n&lt;p&gt;Server iklan pihak ketiga atau jaringan iklan menggunakan teknologi seperti cookie, JavaScript, atau Web Beacon yang digunakan dalam iklan masing-masing dan tautan yang muncul di Kurteyki, yang dikirim langsung ke browser pengguna. Mereka secara otomatis menerima alamat IP Anda ketika ini terjadi. Teknologi ini digunakan untuk mengukur efektivitas kampanye iklan mereka dan / atau untuk mempersonalisasi konten iklan yang Anda lihat di situs web yang Anda kunjungi.&lt;/p&gt;\r\n\r\n&lt;p&gt;Perhatikan bahwa Kurteyki tidak memiliki akses ke atau kontrol terhadap cookie ini yang digunakan oleh pengiklan pihak ketiga.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Kebijakan Privasi Pihak Ketiga&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kebijakan Privasi Kurteyki tidak berlaku untuk pengiklan atau situs web lain. Karenanya, kami menyarankan Anda untuk berkonsultasi dengan masing-masing Kebijakan Privasi dari server iklan pihak ketiga ini untuk informasi yang lebih terperinci. Ini mungkin termasuk praktik dan instruksi mereka tentang cara menyisih dari opsi tertentu. Anda dapat menemukan daftar lengkap Kebijakan Privasi ini dan tautannya di sini: Tautan Kebijakan Privasi.&lt;/p&gt;\r\n\r\n&lt;p&gt;Anda dapat memilih untuk menonaktifkan cookie melalui opsi peramban individual. Untuk mengetahui informasi lebih rinci tentang manajemen cookie dengan browser web tertentu, dapat ditemukan di situs web masing-masing browser. Apa Itu Cookie?&lt;/p&gt;\r\n\r\n&lt;h2&gt;Informasi Anak&lt;/h2&gt;\r\n\r\n&lt;p&gt;Bagian lain dari prioritas kami adalah menambahkan perlindungan untuk anak-anak saat menggunakan internet. Kami mendorong orang tua dan wali untuk mengamati, berpartisipasi, dan / atau memantau dan membimbing aktivitas online mereka.&lt;/p&gt;\r\n\r\n&lt;p&gt;Kurteyki tidak secara sadar mengumpulkan Informasi Identifikasi Pribadi apa pun dari anak-anak di bawah usia 13. Jika Anda berpikir bahwa anak Anda memberikan informasi semacam ini di situs web kami, kami sangat menganjurkan Anda untuk menghubungi kami segera dan kami akan melakukan upaya terbaik kami untuk segera menghapus informasi tersebut dari catatan kami.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Hanya Kebijakan Privasi Online&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kebijakan Privasi ini hanya berlaku untuk aktivitas online kami dan berlaku untuk pengunjung situs web kami sehubungan dengan informasi yang mereka bagikan dan / atau kumpulkan di Kurteyki. Kebijakan ini tidak berlaku untuk informasi apa pun yang dikumpulkan secara offline atau melalui saluran selain dari situs web ini.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Persetujuan&lt;/h2&gt;\r\n\r\n&lt;p&gt;Dengan menggunakan situs web kami, Anda dengan ini menyetujui Kebijakan Privasi kami dan menyetujui Syarat dan Ketentuannya.&lt;/p&gt;\r\n', 'Published'),
(2, 'Bantuan', 'help', '2020-04-14 07:52:45', '2020-04-16 08:22:28', '&lt;meta name=&quot;robots&quot; content=&quot;noindex&quot;&gt;\r\n&lt;p&gt;Belum ada konten untuk dibuat.&lt;/p&gt;\r\n', 'Published'),
(3, 'Kontak', 'contact', '2020-04-14 07:53:12', '2020-04-16 08:24:26', '&lt;p&gt;Anda dapat menghubungi tim melalui kontak dibawah ini&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Email : kurteyki@gmail.com&lt;/p&gt;\r\n\r\n&lt;p&gt;Facebook : &lt;a href=&quot;https://facebook.com/kurteyki&quot;&gt;facebook.com/kurteyki&lt;/a&gt;&lt;/p&gt;\r\n', 'Published'),
(4, 'Tentang Kurteyki', 'about', '2020-04-14 07:53:19', '2020-04-16 08:20:59', '&lt;p&gt;kurteyki.com situs belajar pengembangan diri, situs dibuat pada tahun 2019.&lt;/p&gt;\r\n', 'Published'),
(5, 'Syarat dan Ketentuan', 'term-and-condition', '2020-04-14 07:54:26', '2020-04-14 08:39:27', '&lt;p&gt;Selamat datang di Kurteyki!&lt;/p&gt;\r\n\r\n&lt;p&gt;Syarat dan ketentuan ini menguraikan aturan dan peraturan untuk penggunaan Situs Web Kurteyki, yang terletak di kurteyki.com.&lt;/p&gt;\r\n\r\n&lt;p&gt;Dengan mengakses situs web ini, kami menganggap Anda menerima syarat dan ketentuan ini. Jangan terus menggunakan Kurteyki jika Anda tidak setuju untuk mengambil semua syarat dan ketentuan yang tercantum di halaman ini.&lt;/p&gt;\r\n\r\n&lt;p&gt;Terminologi berikut ini berlaku untuk Syarat dan Ketentuan ini, Pernyataan Privasi dan Pemberitahuan Sangkalan dan semua Perjanjian: &amp;quot;Klien&amp;quot;, &amp;quot;Anda&amp;quot; dan &amp;quot;Anda&amp;quot; mengacu pada Anda, orang yang masuk ke situs web ini dan mematuhi persyaratan dan ketentuan Perusahaan. &amp;quot;Perusahaan&amp;quot;, &amp;quot;Diri Kami&amp;quot;, &amp;quot;Kami&amp;quot;, &amp;quot;Kami&amp;quot; dan &amp;quot;Kami&amp;quot;, mengacu pada Perusahaan kami. &amp;quot;Pihak&amp;quot;, &amp;quot;Pihak&amp;quot;, atau &amp;quot;Kami&amp;quot;, mengacu pada Klien dan diri kami sendiri. Semua istilah mengacu pada penawaran, penerimaan, dan pertimbangan pembayaran yang diperlukan untuk melakukan proses bantuan kami kepada Klien dengan cara yang paling tepat untuk tujuan yang jelas dalam memenuhi kebutuhan Klien sehubungan dengan penyediaan layanan yang dinyatakan Perusahaan, sesuai dengan dan tunduk pada, hukum Belanda yang berlaku. Setiap penggunaan terminologi di atas atau kata-kata lain dalam bentuk tunggal, jamak, huruf besar dan / atau dia, dianggap sebagai dapat dipertukarkan dan karena itu merujuk pada yang sama.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Cookies&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kami menggunakan penggunaan cookie. Dengan mengakses Kurteyki, Anda setuju untuk menggunakan cookie sesuai dengan Kebijakan Privasi Kurteyki.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sebagian besar situs web interaktif menggunakan cookie untuk memungkinkan kami mengambil detail pengguna untuk setiap kunjungan. Cookie digunakan oleh situs web kami untuk mengaktifkan fungsionalitas area tertentu agar lebih mudah bagi orang yang mengunjungi situs web kami. Beberapa mitra afiliasi / iklan kami juga dapat menggunakan cookie.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Lisensi&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kecuali dinyatakan sebaliknya, Kurteyki dan / atau pemberi lisensinya memiliki hak kekayaan intelektual untuk semua materi tentang Kurteyki. Semua hak kekayaan intelektual dilindungi. Anda dapat mengakses ini dari Kurteyki untuk penggunaan pribadi Anda dengan batasan yang diatur dalam syarat dan ketentuan ini.&lt;/p&gt;\r\n\r\n&lt;p&gt;Anda tidak harus:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n &lt;li&gt;Publikasikan ulang materi dari Kurteyki&lt;/li&gt;\r\n  &lt;li&gt;Menjual, menyewakan atau mensublisensikan materi dari Kurteyki&lt;/li&gt;\r\n &lt;li&gt;Mereproduksi, menggandakan atau menyalin materi dari Kurteyki&lt;/li&gt;\r\n  &lt;li&gt;Mendistribusikan kembali konten dari Kurteyki&lt;/li&gt;\r\n  &lt;li&gt;Perjanjian ini akan dimulai pada tanggal perjanjian ini.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Bagian dari situs web ini menawarkan kesempatan bagi pengguna untuk memposting dan bertukar pendapat dan informasi di area situs web tertentu. Kurteyki tidak memfilter, mengedit, menerbitkan atau meninjau Komentar sebelum kehadiran mereka di situs web. Komentar tidak mencerminkan pandangan dan pendapat Kurteyki, agen dan / atau afiliasinya. Komentar mencerminkan pandangan dan pendapat orang yang memposting pandangan dan pendapat mereka. Sejauh diizinkan oleh undang-undang yang berlaku, Kurteyki tidak akan bertanggung jawab atas Komentar atau untuk setiap kewajiban, kerusakan atau biaya yang disebabkan dan / atau diderita sebagai akibat dari penggunaan dan / atau pengeposan dan / atau penampilan Komentar mengenai hal ini. situs web.&lt;/p&gt;\r\n\r\n&lt;p&gt;Kurteyki berhak untuk memantau semua Komentar dan menghapus Komentar yang dapat dianggap tidak pantas, menyinggung, atau menyebabkan pelanggaran terhadap Syarat dan Ketentuan ini.&lt;/p&gt;\r\n\r\n&lt;p&gt;Anda menjamin dan menyatakan bahwa:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n  &lt;li&gt;Anda berhak memposting Komentar di situs web kami dan memiliki semua lisensi dan persetujuan yang diperlukan untuk melakukannya;&lt;/li&gt;\r\n &lt;li&gt;Komentar tidak melanggar hak kekayaan intelektual apa pun, termasuk tanpa batasan hak cipta, paten, atau merek dagang pihak ketiga mana pun;&lt;/li&gt;\r\n &lt;li&gt;Komentar tidak mengandung materi yang memfitnah, memfitnah, menyinggung, tidak senonoh, atau melanggar hukum yang merupakan pelanggaran privasi&lt;/li&gt;\r\n  &lt;li&gt;Komentar tidak akan digunakan untuk meminta atau mempromosikan bisnis atau kebiasaan atau menyajikan kegiatan komersial atau kegiatan yang melanggar hukum.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Anda dengan ini memberi Kurteyki lisensi non-eksklusif untuk menggunakan, mereproduksi, mengedit, dan memberi otorisasi kepada orang lain untuk menggunakan, mereproduksi, dan mengedit komentar Anda dalam segala bentuk, format, atau media.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Hyperlink ke Konten kami&lt;/h2&gt;\r\n\r\n&lt;p&gt;Organisasi berikut dapat menautkan ke situs web kami tanpa persetujuan tertulis sebelumnya:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n &lt;li&gt;Agensi pemerintahan;&lt;/li&gt;\r\n &lt;li&gt;Mesin pencari;&lt;/li&gt;\r\n &lt;li&gt;Organisasi berita;&lt;/li&gt;\r\n &lt;li&gt;Distributor direktori online dapat menautkan ke situs web kami dengan cara yang sama seperti mereka hyperlink ke situs web bisnis terdaftar lainnya; dan&lt;/li&gt;\r\n &lt;li&gt;Bisnis Terakreditasi di seluruh sistem kecuali meminta organisasi nirlaba, pusat perbelanjaan amal, dan kelompok penggalangan dana amal yang mungkin tidak hyperlink ke situs Web kami.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Organisasi-organisasi ini dapat menautkan ke beranda kami, ke publikasi atau ke informasi situs web lainnya selama tautan: (a) tidak menipu dengan cara apa pun; (B) tidak secara tidak langsung menyiratkan sponsor, dukungan atau persetujuan dari pihak yang menghubungkan dan produk dan / atau layanannya; dan (c) sesuai dengan konteks situs pihak yang menghubungkan.&lt;/p&gt;\r\n\r\n&lt;p&gt;Kami dapat mempertimbangkan dan menyetujui permintaan tautan lain dari jenis organisasi berikut:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n  &lt;li&gt;sumber informasi konsumen dan / atau bisnis yang umum dikenal;&lt;/li&gt;\r\n &lt;li&gt;situs komunitas dot.com;&lt;/li&gt;\r\n &lt;li&gt;asosiasi atau kelompok lain yang mewakili badan amal;&lt;/li&gt;\r\n  &lt;li&gt;distributor direktori online;&lt;/li&gt;\r\n  &lt;li&gt;portal internet;&lt;/li&gt;\r\n &lt;li&gt;perusahaan akuntansi, hukum dan konsultasi; dan&lt;/li&gt;\r\n  &lt;li&gt;lembaga pendidikan dan asosiasi perdagangan.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Kami akan menyetujui permintaan tautan dari organisasi-organisasi ini jika kami memutuskan bahwa: (a) tautan tersebut tidak akan membuat kami terlihat tidak menguntungkan bagi diri kami sendiri atau untuk bisnis terakreditasi kami; (B) organisasi tidak memiliki catatan negatif dengan kami; (c) manfaat bagi kami dari visibilitas hyperlink mengkompensasi ketiadaan Kurteyki; dan (d) tautannya ada dalam konteks informasi sumber daya umum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Organisasi-organisasi ini dapat menautkan ke beranda kami selama tautan tersebut: (a) sama sekali tidak menipu; (B) tidak secara tidak langsung menyiratkan sponsor, dukungan atau persetujuan dari pihak yang menghubungkan dan produk atau layanannya; dan (c) sesuai dengan konteks situs pihak yang menghubungkan.&lt;/p&gt;\r\n\r\n&lt;p&gt;Jika Anda salah satu organisasi yang tercantum dalam paragraf 2 di atas dan tertarik untuk menautkan ke situs web kami, Anda harus memberi tahu kami dengan mengirim email ke Kurteyki. Harap sertakan nama Anda, nama organisasi Anda, informasi kontak serta URL situs Anda, daftar URL apa pun yang ingin Anda tautkan ke Situs web kami, dan daftar URL di situs kami yang ingin Anda kunjungi tautan. Tunggu 2-3 minggu untuk tanggapan.&lt;/p&gt;\r\n\r\n&lt;p&gt;Organisasi yang disetujui dapat hyperlink ke Situs web kami sebagai berikut:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n &lt;li&gt;Dengan menggunakan nama perusahaan kami; atau&lt;/li&gt;\r\n  &lt;li&gt;Dengan menggunakan pencari sumber daya seragam yang ditautkan ke; atau&lt;/li&gt;\r\n &lt;li&gt;Dengan menggunakan uraian lain apa pun dari Situs Web kami yang ditautkan dengan yang masuk akal dalam konteks dan format konten di situs pihak yang menautkan.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Penggunaan logo Kurteyki atau karya seni lainnya tidak akan diizinkan untuk menghubungkan tidak adanya perjanjian lisensi merek dagang.&lt;/p&gt;\r\n\r\n&lt;h2&gt;iFrames&lt;/h2&gt;\r\n\r\n&lt;p&gt;Tanpa persetujuan sebelumnya dan izin tertulis, Anda tidak boleh membuat bingkai di sekitar Halaman Web kami yang mengubah cara tampilan visual atau tampilan Situs Web kami.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Pertanggungjawaban Konten&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kami tidak akan bertanggung jawab atas konten yang muncul di Situs Web Anda. Anda setuju untuk melindungi dan membela kami terhadap semua klaim yang muncul di Situs Web Anda. Tidak ada tautan yang muncul di Situs web mana pun yang dapat ditafsirkan sebagai fitnah, cabul atau kriminal, atau yang melanggar, jika tidak melanggar, atau menganjurkan pelanggaran atau pelanggaran lain terhadap, hak pihak ketiga.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Reservasi Hak&lt;/h2&gt;\r\n\r\n&lt;p&gt;Kami berhak meminta Anda menghapus semua tautan atau tautan tertentu apa pun ke Situs Web kami. Anda menyetujui untuk segera menghapus semua tautan ke Situs web kami berdasarkan permintaan. Kami juga berhak mengubah syarat dan ketentuan ini dan ini menautkan kebijakan kapan saja. Dengan terus menautkan ke Situs web kami, Anda setuju untuk terikat dan mengikuti syarat dan ketentuan tautan ini.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Penghapusan tautan dari situs web kami&lt;/h2&gt;\r\n\r\n&lt;p&gt;Jika Anda menemukan tautan apa pun di Situs Web kami yang menyinggung karena alasan apa pun, Anda bebas untuk menghubungi dan memberi tahu kami kapan saja. Kami akan mempertimbangkan permintaan untuk menghapus tautan tetapi kami tidak berkewajiban untuk menanggapi Anda secara langsung.&lt;/p&gt;\r\n\r\n&lt;p&gt;Kami tidak memastikan bahwa informasi di situs web ini benar, kami tidak menjamin kelengkapan atau keakuratannya; kami juga tidak berjanji untuk memastikan bahwa situs web tetap tersedia atau bahwa materi di situs web tetap terbaru.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Penolakan&lt;/h2&gt;\r\n\r\n&lt;p&gt;Sejauh diizinkan oleh hukum yang berlaku, kami mengecualikan semua representasi, jaminan, dan ketentuan yang berkaitan dengan situs web kami dan penggunaan situs web ini. Tidak ada dalam penafian ini yang akan:&lt;/p&gt;\r\n\r\n&lt;p&gt;membatasi atau mengecualikan tanggung jawab kami atau Anda atas kematian atau cedera pribadi;&lt;br /&gt;\r\nmembatasi atau mengecualikan tanggung jawab kami atau Anda untuk penipuan atau penggambaran yang salah;&lt;br /&gt;\r\nbatasi salah satu dari kewajiban kami atau Anda dengan cara apa pun yang tidak diizinkan berdasarkan hukum yang berlaku; atau&lt;br /&gt;\r\nmengecualikan salah satu dari kewajiban kami atau Anda yang mungkin tidak dikecualikan berdasarkan hukum yang berlaku.&lt;br /&gt;\r\nBatasan dan larangan tanggung jawab yang diatur dalam Bagian ini dan di tempat lain dalam penafian ini: (a) tunduk pada paragraf sebelumnya; dan (b) mengatur semua kewajiban yang timbul berdasarkan penafian, termasuk kewajiban yang timbul dalam kontrak, dalam gugatan hukum dan untuk pelanggaran kewajiban hukum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Selama situs web dan informasi serta layanan di situs web disediakan secara gratis, kami tidak akan bertanggung jawab atas kehilangan atau kerusakan apa pun.&lt;/p&gt;\r\n', 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_visitor`
--

CREATE TABLE `tb_site_visitor` (
  `id` int(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `browser` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `hits` int(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `referrer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_site_visitor`
--

INSERT INTO `tb_site_visitor` (`id`, `ip`, `date`, `browser`, `os`, `country_name`, `country_code`, `hits`, `url`, `referrer`) VALUES
(1, '::1', '2020-05-03 11:49:04', 'Chrome', 'Windows 7', 'Other', 'Other', 78, 'http://localhost/kurteyki/', ''),
(2, '::1', '2020-05-03 11:49:12', 'Chrome', 'Windows 7', 'Other', 'Other', 13, 'http://localhost/kurteyki/blog', ''),
(3, '::1', '2020-05-03 11:49:22', 'Chrome', 'Windows 7', 'Other', 'Other', 21, 'http://localhost/kurteyki/courses-filter', ''),
(4, '::1', '2020-05-03 11:49:32', 'Chrome', 'Windows 7', 'Other', 'Other', 1, 'http://localhost/kurteyki/blog-search', ''),
(5, '::1', '2020-05-03 11:56:13', 'Chrome', 'Windows 7', 'Other', 'Other', 9, 'http://localhost/kurteyki/blog-post/konten-baru-dan-rencana-kedepannya-situs-ini', ''),
(6, '::1', '2020-05-03 11:56:45', 'Chrome', 'Windows 7', 'Other', 'Other', 2, 'http://localhost/kurteyki/blog-category/news', ''),
(7, '::1', '2020-05-03 11:57:14', 'Chrome', 'Windows 7', 'Other', 'Other', 2, 'http://localhost/kurteyki/blog-tags/berita', ''),
(8, '::1', '2020-05-03 12:01:06', 'Chrome', 'Windows 7', 'Other', 'Other', 15, 'http://localhost/kurteyki/courses-detail/ilmu-dari-building-the-dream', ''),
(9, '::1', '2020-05-03 12:02:03', 'Chrome', 'Windows 7', 'Other', 'Other', 14, 'http://localhost/kurteyki/courses-detail/ilmu-dari-adam-khoo', ''),
(10, '::1', '2020-05-03 15:47:23', 'Chrome', 'Windows 10', 'Other', 'Other', 3, 'http://localhost/kurteyki/p/term-and-condition', ''),
(11, '::1', '2020-05-03 15:47:26', 'Chrome', 'Windows 10', 'Other', 'Other', 3, 'http://localhost/kurteyki/p/about', ''),
(12, '::1', '2020-05-03 15:47:32', 'Chrome', 'Windows 10', 'Other', 'Other', 2, 'http://localhost/kurteyki/p/privacy-policy', ''),
(13, '::1', '2020-05-03 15:47:33', 'Chrome', 'Windows 10', 'Other', 'Other', 3, 'http://localhost/kurteyki/p/contact', ''),
(14, '::1', '2020-05-03 15:47:34', 'Chrome', 'Windows 10', 'Other', 'Other', 2, 'http://localhost/kurteyki/p/help', ''),
(15, '::1', '2020-05-04 15:15:17', 'Chrome', 'Windows 7', 'Other', 'Other', 2, 'http://localhost/kurteyki/', ''),
(16, '::1', '2022-02-11 16:48:36', 'Chrome', 'Windows 7', 'Other', 'Other', 3, 'http://localhost/w/p/help', ''),
(17, '::1', '2022-02-11 16:48:39', 'Chrome', 'Windows 7', 'Other', 'Other', 30, 'http://localhost/w/', ''),
(18, '::1', '2022-02-11 16:48:43', 'Chrome', 'Windows 7', 'Other', 'Other', 2, 'http://localhost/w/p/contact', ''),
(19, '::1', '2022-02-11 16:48:44', 'Chrome', 'Windows 7', 'Other', 'Other', 3, 'http://localhost/w/blog', ''),
(20, '::1', '2022-02-11 16:49:43', 'Chrome', 'Windows 7', 'Other', 'Other', 7, 'http://localhost/w/courses-filter', ''),
(21, '::1', '2022-02-11 16:49:45', 'Chrome', 'Windows 7', 'Other', 'Other', 3, 'http://localhost/w/courses-detail/ilmu-dari-adam-khoo', ''),
(22, '::1', '2022-02-11 16:49:50', 'Chrome', 'Windows 7', 'Other', 'Other', 2, 'http://localhost/w/courses-detail/ilmu-dari-building-the-dream', ''),
(23, '::1', '2022-02-11 16:57:17', 'Chrome', 'Windows 7', 'Other', 'Other', 3, 'http://localhost/w/blog-post/konten-baru-dan-rencana-kedepannya-situs-ini', ''),
(24, '::1', '2022-02-11 16:57:22', 'Chrome', 'Windows 7', 'Other', 'Other', 1, 'http://localhost/w/blog-tags/berita', ''),
(25, '::1', '2022-02-11 16:57:23', 'Chrome', 'Windows 7', 'Other', 'Other', 1, 'http://localhost/w/blog-category/news', ''),
(26, '::1', '2022-02-11 17:00:39', 'Chrome', 'Windows 7', 'Other', 'Other', 12, 'http://localhost/w/courses-detail/dummy-course-1', ''),
(27, '::1', '2022-02-11 17:04:08', 'Chrome', 'Windows 7', 'Other', 'Other', 7, 'http://localhost/w/courses-detail/dummy-course-3', ''),
(28, '::1', '2022-02-11 17:05:17', 'Chrome', 'Windows 7', 'Other', 'Other', 3, 'http://localhost/w/courses-detail/dummy-course-2', ''),
(29, '::1', '2022-02-11 17:07:15', 'Chrome', 'Windows 7', 'Other', 'Other', 1, 'http://localhost/w/p/about', ''),
(30, '::1', '2022-02-11 17:07:16', 'Chrome', 'Windows 7', 'Other', 'Other', 1, 'http://localhost/w/p/term-and-condition', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_handphone` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `grade` enum('App','User','Instructor') NOT NULL,
  `payment` text NOT NULL,
  `created` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `status` enum('Active','Blocked','UnActive') NOT NULL DEFAULT 'UnActive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `headline`, `email`, `no_handphone`, `photo`, `grade`, `payment`, `created`, `last_login`, `status`) VALUES
(1, 'kurteyki', '1a5651f74beaa02c5e5fc380875d23a66e4549bd', 'Owner', 'kurteyki@gmail.com', '081389215100', 'user_photo_20200503125412.png', 'App', '{\"transaction\":[{\"identity\":\"bri20200425130634\",\"type\":\"bri\",\"account_number\":\"1923892138192\",\"receiver\":\"irfan\"},{\"identity\":\"bca20200426162016\",\"type\":\"bca\",\"account_number\":\"12321321\",\"receiver\":\"troffle\"}],\"confirmation\":[{\"identity\":\"whatsapp20200425130641\",\"type\":\"whatsapp\",\"data\":\"6285280815735\"},{\"identity\":\"facebook20200501131607\",\"type\":\"facebook\",\"data\":\"https:\\/\\/www.facebook.com\\/riedayme\"}]}', '0000-00-00 00:00:00', '2022-02-11 16:52:25', 'Active'),
(2, 'Faaan', '42989f964d45b1bba335241a4b5b7292be4d1079', 'Pengembangan Diri', 'he.irfaan@gmail.com', '081389215100', 'user_photo_20200504151502.png', 'Instructor', '', '2020-05-03 12:58:26', '0000-00-00 00:00:00', 'Active'),
(3, 'Riedayme', 'cfd5acd586398229e9229ee327a0c2bf6a379658', 'test', 'programmer.irfaan@gmail.com', '21321321321', '', 'User', '', '2020-05-03 20:01:58', '0000-00-00 00:00:00', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blog_post`
--
ALTER TABLE `tb_blog_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permalink` (`permalink`),
  ADD KEY `time` (`time`),
  ADD KEY `status` (`status`),
  ADD KEY `id_tags` (`id_tags`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `views` (`views`),
  ADD KEY `description` (`description`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `tb_blog_post_category`
--
ALTER TABLE `tb_blog_post_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `tb_blog_post_comment`
--
ALTER TABLE `tb_blog_post_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blog_post` (`id_blog_post`,`parent`),
  ADD KEY `status` (`status`),
  ADD KEY `status_read` (`status_read`);

--
-- Indexes for table `tb_blog_post_tags`
--
ALTER TABLE `tb_blog_post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `tb_blog_template`
--
ALTER TABLE `tb_blog_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tb_blog_template_style`
--
ALTER TABLE `tb_blog_template_style`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `id_template` (`id_template`);

--
-- Indexes for table `tb_blog_template_widget`
--
ALTER TABLE `tb_blog_template_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `id_template` (`id_template`);

--
-- Indexes for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_category`
--
ALTER TABLE `tb_lms_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `tb_lms_coupon`
--
ALTER TABLE `tb_lms_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_courses`
--
ALTER TABLE `tb_lms_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permalink` (`permalink`),
  ADD KEY `time` (`time`),
  ADD KEY `status` (`status`),
  ADD KEY `id_tags` (`id_sub_category`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `views` (`views`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `tb_lms_courses_lesson`
--
ALTER TABLE `tb_lms_courses_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_courses_section`
--
ALTER TABLE `tb_lms_courses_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_template`
--
ALTER TABLE `tb_lms_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tb_lms_template_widget`
--
ALTER TABLE `tb_lms_template_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `id_template` (`id_template`);

--
-- Indexes for table `tb_lms_user_courses`
--
ALTER TABLE `tb_lms_user_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_user_lesson`
--
ALTER TABLE `tb_lms_user_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_user_payment`
--
ALTER TABLE `tb_lms_user_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lms_user_review`
--
ALTER TABLE `tb_lms_user_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_courses` (`id_courses`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_lms_user_wishlist`
--
ALTER TABLE `tb_lms_user_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site`
--
ALTER TABLE `tb_site`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `tb_site_pages`
--
ALTER TABLE `tb_site_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permalink` (`permalink`,`time`,`status`),
  ADD KEY `time` (`time`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tb_site_visitor`
--
ALTER TABLE `tb_site_visitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`),
  ADD KEY `date` (`date`),
  ADD KEY `hits` (`hits`),
  ADD KEY `url` (`url`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_blog_post`
--
ALTER TABLE `tb_blog_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_blog_post_category`
--
ALTER TABLE `tb_blog_post_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_blog_post_comment`
--
ALTER TABLE `tb_blog_post_comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_blog_post_tags`
--
ALTER TABLE `tb_blog_post_tags`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_blog_template`
--
ALTER TABLE `tb_blog_template`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_blog_template_style`
--
ALTER TABLE `tb_blog_template_style`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_blog_template_widget`
--
ALTER TABLE `tb_blog_template_widget`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_lms_category`
--
ALTER TABLE `tb_lms_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_lms_coupon`
--
ALTER TABLE `tb_lms_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lms_courses`
--
ALTER TABLE `tb_lms_courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_lms_courses_lesson`
--
ALTER TABLE `tb_lms_courses_lesson`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_lms_courses_section`
--
ALTER TABLE `tb_lms_courses_section`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_lms_template`
--
ALTER TABLE `tb_lms_template`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_lms_template_widget`
--
ALTER TABLE `tb_lms_template_widget`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lms_user_courses`
--
ALTER TABLE `tb_lms_user_courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lms_user_lesson`
--
ALTER TABLE `tb_lms_user_lesson`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lms_user_review`
--
ALTER TABLE `tb_lms_user_review`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lms_user_wishlist`
--
ALTER TABLE `tb_lms_user_wishlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_site_pages`
--
ALTER TABLE `tb_site_pages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_site_visitor`
--
ALTER TABLE `tb_site_visitor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
