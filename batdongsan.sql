/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : batdongsan

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-09-14 15:01:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_album
-- ----------------------------
DROP TABLE IF EXISTS `tbl_album`;
CREATE TABLE `tbl_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `cdate` datetime NOT NULL,
  `visited` int(11) DEFAULT '0',
  `order` tinyint(5) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_album
-- ----------------------------
INSERT INTO `tbl_album` VALUES ('8', '0', 'thu-vien-anh', '', 'Thư viện ảnh', '', '2019-07-14 17:27:09', '5', null, '1');

-- ----------------------------
-- Table structure for tbl_boxes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_boxes`;
CREATE TABLE `tbl_boxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL COMMENT 'inbox=1 | outbox=2 | draft=0 | trash=-1',
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `encoding` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject_encoding` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `size` double DEFAULT NULL COMMENT 'Dung lượng',
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Đính kèm',
  `priority` int(11) DEFAULT NULL COMMENT 'Mức độ ưu tiên',
  `viewed` int(11) DEFAULT '0' COMMENT 'not view = 0 | viewed = 1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_boxes
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_categories
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_desc` text COLLATE utf8_unicode_ci,
  `order` int(11) DEFAULT '0',
  `lag_id` int(11) DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('2', '0', 'Tin tức', 'tin-tuc', '', '', null, null, null, '1', '0', '1');
INSERT INTO `tbl_categories` VALUES ('51', '2', 'Hoạt động sinh viên', 'hoat-dong-sinh-vien', '', '', null, null, null, '0', '0', '1');
INSERT INTO `tbl_categories` VALUES ('60', '0', 'FAQ', 'faq', '', '', null, null, null, '0', '0', '1');
INSERT INTO `tbl_categories` VALUES ('66', '51', 'test 123', 'test-123', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', '<p>dfsdfsdfsdfsd sdfsdfsdf</p>', null, null, null, '0', '0', '1');
INSERT INTO `tbl_categories` VALUES ('65', '0', 'Dịch vụ', 'dich-vu', 'http://demo.loichoi.com/batdongsan/images/basic/feature-img02.png', '<p>sadfsdfsdf</p>', null, null, null, '2', '0', '1');

-- ----------------------------
-- Table structure for tbl_configsite
-- ----------------------------
DROP TABLE IF EXISTS `tbl_configsite`;
CREATE TABLE `tbl_configsite` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` longtext COLLATE utf8_unicode_ci,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `meta_keyword` longtext COLLATE utf8_unicode_ci,
  `meta_descript` longtext COLLATE utf8_unicode_ci,
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `nick_yahoo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_yahoo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `skype1` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `skype2` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `gplus` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_configsite
-- ----------------------------
INSERT INTO `tbl_configsite` VALUES ('1', '0', 'Trung tâm Kỹ thuật Ô tô Mỹ Đình THC', 'Trung tâm Kỹ thuật Ô tô Mỹ Đình THC', '', 'Số 563 đường Phúc Diễn, Xuân Phương, Nam Từ Liêm, Hà Nội', '0968.87.87.68 - 0964.10.4444', '0968.87.87.68 - 0964.10.4444', '', 'thuynguyen2607@gmail.com', '', '', '', 'ga ra ô tô, ga ra ô tô mỹ đình, xưởng sửa chữa ô tô mỹ đình, xưởng sửa chữa phục hồi ô tô,sửa chữa động cơ ô tô,thay dầu động cơ ô tô,chăm sóc bảo dưỡng ô tô,cứu hộ giao thông', 'Trung tâm Kỹ thuật Ô tô Mỹ Đình THC - Sửa chữa phục hồi xe ô tô. Đặt lịch hẹn sửa ngay hôm nay!', '0', '', '', '', '', '', '', 'https://twitter.com/', 'https://plus.google.com/?hl=vi', 'https://www.facebook.com/', 'https://www.youtube.com/');

-- ----------------------------
-- Table structure for tbl_contact
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tittle` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` text COLLATE utf8_unicode_ci,
  `cdate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_contact
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_contents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contents`;
CREATE TABLE `tbl_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `intro` text COLLATE utf8_unicode_ci,
  `fulltext` longtext COLLATE utf8_unicode_ci,
  `type_of_land_id` int(11) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `list_conid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `list_tagid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `visited` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `pin` int(11) DEFAULT '0',
  `ishot` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `intro` (`intro`),
  FULLTEXT KEY `fulltext` (`fulltext`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_contents
-- ----------------------------
INSERT INTO `tbl_contents` VALUES ('2', '53', 'Thư ngỏ', 'thu-ngo', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/wc.jpg', '', '&lt;h1&gt;Trung t&acirc;m kỹ thuật &ocirc; t&ocirc; Mỹ&amp;nbsp;&lt;span style=&quot;color: rgb(255, 165, 0);&quot;&gt;Đ&igrave;nh THC&lt;/span&gt;&lt;/h1&gt;&lt;div&gt;&lt;span style=&quot;font-size: 18pt;&quot;&gt;K&iacute;nh ch&agrave;o qu&yacute; kh&aacute;ch!&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Mỹ Đ&igrave;nh THC&lt;/span&gt;&amp;nbsp;lu&ocirc;n lu&ocirc;n cố gắng để trở th&agrave;nh nơi cung cấp h&agrave;ng đầu c&aacute;c dịch vụ &quot;&lt;span style=&quot;font-weight: bold; font-style: italic;&quot;&gt;Chăm s&oacute;c xe to&agrave;n diện&lt;/span&gt;&quot; cho Qu&yacute; kh&aacute;ch h&agrave;ng, l&agrave; gara c&oacute; thương hiệu về tất cả c&aacute;c dịch vụ li&ecirc;n quan đến bảo tr&igrave;, bảo dưỡng, sửa chữa &ocirc; t&ocirc;.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Trung t&acirc;m &ocirc; t&ocirc; THC&lt;/span&gt;&amp;nbsp;ch&uacute;ng t&ocirc;i tin rằng nguồn nh&acirc;n lực l&agrave; một ch&igrave;a kh&oacute;a để x&acirc;y dựng một mối quan hệ vững chắc với Kh&aacute;ch h&agrave;ng của ch&uacute;ng t&ocirc;i.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;V&igrave; vậy đội ngũ nh&acirc;n vi&ecirc;n của ch&uacute;ng t&ocirc;i lu&ocirc;n lu&ocirc;n cải thiện bản th&acirc;n kh&ocirc;ng ngừng để đạt được 3 gi&aacute; trị cốt l&otilde;i:&amp;nbsp;&lt;span style=&quot;font-weight: bold; font-style: italic;&quot;&gt;Kỹ năng kỹ thuật, phong c&aacute;ch chuy&ecirc;n nghiệp v&agrave; th&aacute;i độ chuy&ecirc;n t&acirc;m&lt;/span&gt;&amp;nbsp;để cung cấp những gi&aacute; trị tốt nhất c&oacute; thể cho kh&aacute;ch h&agrave;ng trong bất kỳ trường hợp n&agrave;o.&lt;/div&gt;', null, null, null, '', '', 'igf', '2019-07-06 02:19:50', '2019-07-25 03:02:42', '23', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('3', '59', 'Sửa chữa gầm m&aacute;y', 'sua-chua-gam-may', 'http://demo.loichoi.com/batdongsan/images/services/service1.png', 'Sửa chữa hệ thống khung gầm &ocirc; t&ocirc; l&agrave; một c&ocirc;ng việc bảo dưỡng v&agrave; chăm s&oacute;c xe hơi v&ocirc; c&ugrave;ng quan trọng vừa để bảo vệ tuổi thọ cho chiếc &ldquo;xế y&ecirc;u&rdquo; của bạn, vừa đảm bảo an to&agrave;n cho bạn c&ugrave;ng h&agrave;nh kh&aacute;ch tr&ecirc;n mỗi chặng đường.', 'Sửa chữa hệ thống khung gầm &ocirc; t&ocirc; l&agrave; một c&ocirc;ng việc bảo dưỡng v&agrave; chăm s&oacute;c xe hơi v&ocirc; c&ugrave;ng quan trọng vừa để bảo vệ tuổi thọ cho chiếc &ldquo;xế y&ecirc;u&rdquo; của bạn, vừa đảm bảo an to&agrave;n cho bạn c&ugrave;ng h&agrave;nh kh&aacute;ch tr&ecirc;n mỗi chặng đường.&lt;div&gt;&lt;h2&gt;Hư hỏng v&agrave; c&aacute;ch khắc phục th&ocirc;ng thường&lt;/h2&gt;&lt;h3&gt;Tay l&aacute;i nặng&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Điều chỉnh lại c&aacute;ch xếp hang&lt;/li&gt;&lt;li&gt;Bơm lốp đủ &aacute;p suất quy định&lt;/li&gt;&lt;li&gt;Bổ sung đủ dầu cho trợ lực tay l&aacute;i&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;Tay l&aacute;i kh&oacute; trở về vị tr&iacute; thẳng (c&acirc;n bằng)&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Tra dầu mỡ v&agrave;o c&aacute;c khớp nối&lt;/li&gt;&lt;li&gt;Nới lỏng bạc l&aacute;i cho chuẩn (ch&uacute; &yacute; nếu lỏng qu&aacute; sẽ bị dơ)&lt;/li&gt;&lt;li&gt;Chỉnh lại v&iacute;t v&ocirc; t&acirc;n (thanh răng v&agrave; v&iacute;t răng)&lt;/li&gt;&lt;li&gt;Chỉnh lại g&oacute;c đặt b&aacute;nh xe&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;Tay l&aacute;i bị rung&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục :&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Xiết chặt c&aacute;c đai ốc&lt;/li&gt;&lt;li&gt;Xiết chặt lại c&aacute;c khớp nối&lt;/li&gt;&lt;li&gt;Thay, tiện lại bạc mới&lt;/li&gt;&lt;li&gt;Chỉnh lại bạc tỳ thước l&aacute;i&lt;/li&gt;&lt;li&gt;Thay bạc tr&ograve;n hay căn lại cho khe hở hợp l&yacute;&lt;/li&gt;&lt;li&gt;C&acirc;n bằng lại c&aacute;c b&aacute;nh xe&lt;/li&gt;&lt;li&gt;Thay thế cao su phần c&acirc;n bằng, kiểm tra lốp hoặc bơm lại lốp&lt;/li&gt;&lt;li&gt;Bơm lốp đủ &aacute;p suất quy định&lt;/li&gt;&lt;li&gt;Thay lốp&lt;/li&gt;&lt;li&gt;Xả kh&iacute; trong hệ thống trợ lực l&aacute;i&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;Tay l&aacute;i nhao (sang tr&aacute;i hoặc sang phải)&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Bơm lốp đ&uacute;ng &aacute;p suất quy định&lt;/li&gt;&lt;li&gt;Thay thế cao su tay l&aacute;i&lt;/li&gt;&lt;li&gt;Chỉnh lại g&oacute;c đặt v&ocirc; lăng, độ chụm v&agrave; độ song h&agrave;nh b&aacute;nh xe.&lt;/li&gt;&lt;li&gt;Thay thế t&aacute;o l&aacute;i&lt;/li&gt;&lt;li&gt;Thay thế r&ocirc;tuyn&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;Phanh kh&ocirc;ng ăn&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Chỉnh lại h&agrave;nh tr&igrave;nh b&agrave;n đạp phanh&lt;/li&gt;&lt;li&gt;Xiết chặt lại c&aacute;c đầu khớp nối, thay thế c&aacute;c đệm&lt;/li&gt;&lt;li&gt;Xả kh&iacute; lẫn trong dầu phanh&lt;/li&gt;&lt;li&gt;Th&aacute;o ra lấy giấy r&aacute;p mịn v&agrave; dầu đ&aacute;nh lại&lt;/li&gt;&lt;li&gt;Thay thế bầu trợ lực v&agrave; phớt giữa tổng tr&ecirc;n&lt;/li&gt;&lt;li&gt;Thay c&uacute;p ben, d&acirc;y phanh, m&aacute; phanh mới&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;B&oacute; phanh&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Điều chỉnh lại h&agrave;nh tr&igrave;nh b&agrave;n phanh&lt;/li&gt;&lt;li&gt;Điều chỉnh lại phanh tay&lt;/li&gt;&lt;li&gt;Thay l&ograve; xo k&eacute;o ở cơ cấu phanh&lt;/li&gt;&lt;li&gt;Thay thế xi lanh b&aacute;nh xe&lt;/li&gt;&lt;li&gt;Thay thế xi lanh b&aacute;nh ch&iacute;nh&lt;/li&gt;&lt;li&gt;Th&aacute;o khớp nối v&agrave; bảo dưỡng bằng c&aacute;ch đ&aacute;nh rỉ s&eacute;t phần khớp tang trống&lt;/li&gt;&lt;li&gt;Đ&aacute;nh sạch v&agrave; cho th&ecirc;m mỡ&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;h3&gt;Phanh bị ăn lệch một b&ecirc;n&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Thay thế c&uacute;p ben&lt;/li&gt;&lt;li&gt;Bơm lốp đ&uacute;ng &aacute;p suất quy định&lt;/li&gt;&lt;li&gt;Xếp lại h&agrave;ng tr&ecirc;n xe&lt;/li&gt;&lt;li&gt;Thay lốp mới nếu cần thiết&lt;/li&gt;&lt;li&gt;Sửa chữa lại tang trống phanh&lt;/li&gt;&lt;li&gt;L&agrave;m sạch ở m&aacute; phanh&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;h3&gt;&Aacute;p suất của kh&iacute; n&eacute;n kh&ocirc;ng đủ&lt;/h3&gt;&lt;div&gt;C&aacute;ch khắc phục:&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Xiết chặt lại c&aacute;c đầu nối của đường ống&lt;/li&gt;&lt;li&gt;Điều chỉnh lại độ căng của d&acirc;y đai&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;div&gt;&lt;h2&gt;Dấu hiệu thường gặp&lt;/h2&gt;&lt;h3&gt;Những dấu hiệu thường gặp khi gầm xe &ocirc; t&ocirc; kh&ocirc;ng ổn định:&lt;/h3&gt;&lt;div&gt;Khi l&aacute;i xe c&oacute; cảm gi&aacute;c bất thường, qu&yacute; kh&aacute;ch n&ecirc;n nghĩ tới hư hỏng ở gầm xe &ocirc; t&ocirc;. Trong đ&oacute;, tiếng động cơ hay tiếng xả kh&iacute; l&agrave; một trong nhiều dấu hiệu của gầm xe &ocirc; t&ocirc; đang hỏng h&oacute;c.&lt;/div&gt;&lt;div&gt;&lt;ul&gt;&lt;li&gt;Động cơ giảm hẳn c&ocirc;ng suất, sức &igrave; lớn;&lt;/li&gt;&lt;li&gt;Gầm xe r&ograve; rỉ nước; Hệ thống xả kh&iacute; k&ecirc;u bất thường;&lt;/li&gt;&lt;li&gt;Lốp xe r&iacute;t mạnh khi dừng hoặc đỗ xe;&lt;/li&gt;&lt;li&gt;Xe lệch về một b&ecirc;n d&ugrave; đang đi tr&ecirc;n đường bằng phẳng;&lt;/li&gt;&lt;li&gt;Phanh nhẹ, mất hiệu quả;&lt;/li&gt;&lt;li&gt;Nhiệt độ của nước l&agrave;m m&aacute;t động cơ cao hơn b&igrave;nh thường.&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;div&gt;Để đảm bảo an to&agrave;n cho chiếc xe v&agrave; ch&iacute;nh bản th&acirc;n, bạn n&ecirc;n mang xe tới garage uy t&iacute;n để tiến h&agrave;nh kiểm tra ch&iacute;nh x&aacute;c v&agrave; sửa gầm &ocirc; t&ocirc;.&lt;/div&gt;&lt;div&gt;Ngay khi c&oacute; mốt số dấu hiệu tr&ecirc;n, qu&yacute; kh&aacute;ch n&ecirc;n mang xe đi kiểm tra ngay lập tức để tr&aacute;nh xe bị hỏng th&ecirc;m hoặc g&acirc;y tại nạn kh&ocirc;ng đ&aacute;ng c&oacute;. Theo kinh nghiệm của ch&uacute;ng t&ocirc;i, kh&aacute;ch h&agrave;ng thường mang xe sửa chữa khi lỗi hỏng học đ&atilde; qu&aacute; lớn. Điều n&agrave;y g&acirc;y ra hai điều cực nghi&ecirc;m trọng. Một l&agrave;, tăng chi ph&iacute; kh&ocirc;ng đ&aacute;ng c&oacute;. Hai l&agrave;, g&acirc;y tai nạn nguy hiểm đến t&iacute;nh mạng kh&ocirc;ng đ&aacute;ng c&oacute;. &lt;span style=&quot;font-weight: bold;&quot;&gt;MyDinhTHC &lt;/span&gt;l&agrave; địa chỉ sửa chữa uy t&iacute;n nhất tại H&agrave; Nội, lu&ocirc;n đảm bảo cho qu&yacute; kh&aacute;ch chất lượng v&agrave; th&aacute;i độ phục vụ tốt nhất.&lt;/div&gt;&lt;h2&gt;Kiểm tra trước khi sửa gầm &ocirc; t&ocirc;&amp;nbsp;&lt;/h2&gt;&lt;div&gt;Để xe vẫn nổ m&aacute;y&lt;/div&gt;&lt;div&gt;1.&amp;nbsp;&lt;span style=&quot;font-weight: bold;&quot;&gt;Quan s&aacute;t m&agrave;u kh&iacute; xả.&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div&gt;&lt;div&gt;&lt;div&gt;Nếu kh&iacute; xả c&oacute; m&agrave;u đen hoặc trắng đều kh&ocirc;ng tốt. Kh&iacute; xả m&agrave;u đen l&agrave; do hỗn hợp kh&iacute; qu&aacute; đậm hoặc dầu b&ocirc;i trơn lọt l&ecirc;n buồng ch&aacute;y. Kh&iacute; xả m&agrave;u trắng l&agrave; do xăng c&oacute; lẫn nước hoặc đệm nắp m&aacute;y bị ch&aacute;y.&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;2. Quan sắc m&agrave;u sắc của ch&acirc;n nến điện.&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;div&gt;&lt;div&gt;Nếu ch&acirc;n nến điện c&oacute; m&agrave;u đen hoặc m&agrave;u s&aacute;ng đều kh&ocirc;ng tốt. V&igrave; hiện tượng sục dầu l&ecirc;n buồng ch&aacute;y hoặc bỏ lửa đều l&agrave;m ch&acirc;n nến điện c&oacute; m&agrave;u đen, c&ograve;n m&agrave;u s&aacute;ng l&agrave; do ch&acirc;n nến điện bị ch&aacute;y v&igrave; động cơ l&agrave;m việc qu&aacute; n&oacute;ng.&lt;/div&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;/div&gt;', null, null, null, '', '', 'igf', '2019-07-06 04:20:55', '2019-07-23 09:59:40', '4', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('4', '59', 'Nội thất - Ngoại thất', 'noi-that-ngoai-that', 'http://demo.loichoi.com/batdongsan/images/services/service1.png', 'C&aacute;c dịch vụ nội thất: vệ sinh ghế, s&agrave;n xe, trần xe, vệ sinh t&aacute;p l&ocirc;, khử m&ugrave;i &ocirc; t&ocirc;,... Dịch vụ ngoại thất: đ&aacute;nh b&oacute;ng sơn, tẩy ố k&iacute;nh, rửa khoang động cơ,...', 'C&aacute;c dịch vụ nội thất: vệ sinh ghế, s&agrave;n xe, trần xe, vệ sinh t&aacute;p l&ocirc;, khử m&ugrave;i &ocirc; t&ocirc;,... Dịch vụ ngoại thất: đ&aacute;nh b&oacute;ng sơn, tẩy ố k&iacute;nh, rửa khoang động cơ,...', null, null, null, '', '', 'igf', '2019-07-06 04:21:33', '2019-07-23 10:42:00', '1', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('6', '59', 'Rửa xe, dọn nội thất', 'rua-xe-don-noi-that', 'http://demo.loichoi.com/batdongsan/images/services/service1.png', 'Quy tr&igrave;nh dọn nội thất xe &ocirc; t&ocirc; đạt chuẩn từ hệ thống trang thiết bị cho đến tay nghề của c&aacute;c kỹ thuật vi&ecirc;n, THC ch&uacute;ng t&ocirc;i cam kết sẽ mang lại mang đến sự chăm s&oacute;c tốt nhất cho chiếc xe của c&aacute;c bạn.', 'Quy tr&igrave;nh dọn nội thất xe &ocirc; t&ocirc; đạt chuẩn từ hệ thống trang thiết bị cho đến tay nghề của c&aacute;c kỹ thuật vi&ecirc;n, &lt;span style=&quot;font-weight: bold;&quot;&gt;MyDinhTHC&lt;/span&gt; ch&uacute;ng t&ocirc;i cam kết sẽ mang lại mang đến sự chăm s&oacute;c tốt nhất cho chiếc xe của c&aacute;c bạn.', null, null, null, '', '', 'igf', '2019-07-06 04:22:17', '2019-07-23 10:15:17', '5', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('7', '59', 'Chăm s&oacute;c xe', 'cham-soc-xe', 'http://demo.loichoi.com/batdongsan/images/services/service1.png', 'Dịch vụ chăm s&oacute;c xe hơi chuy&ecirc;n nghiệp, to&agrave;n diện về nội thất, ngoại thất, đặc biệt l&agrave; về động cơ của chiếc xe. Đảm bảo xe vận h&agrave;nh tốt v&agrave; đem đến sự an to&agrave;n tuyệt đối cho người sử dụng', 'Dịch vụ chăm s&oacute;c xe hơi chuy&ecirc;n nghiệp, to&agrave;n diện về nội thất, ngoại thất, đặc biệt l&agrave; về động cơ của chiếc xe để đảm bảo n&oacute; vận h&agrave;nh tốt v&agrave; đem đến sự an to&agrave;n tuyệt đối cho người sử dụng', null, null, null, '', '', 'igf', '2019-07-06 11:06:07', '2019-07-23 10:12:13', '3', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('9', '2', 'Việc rửa khoang m&aacute;y &ocirc; t&ocirc; nhiều người c&ograve;n e ngại !', 'viec-rua-khoang-may-o-to-nhieu-nguoi-con-e-ngai-', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/section-7-img-1.jpg', 'Kh&ocirc;ng giống việc rửa xe th&ocirc;ng thường hầu hết ai cũng c&oacute; thể l&agrave;m được, vệ sinh', '&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 18px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; float: none; width: 660px; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif; margin-top: 0px !important;&quot;&gt;Chức v&ocirc; địch n&agrave;y của Team Flash đ&aacute;nh dấu lần đầu ti&ecirc;n Việt Nam trở th&agrave;nh qu&aacute;n qu&acirc;n của một giải đấu Esports mang tầm cỡ thế giới. Điều đ&oacute; khiến người h&acirc;m mộ Li&ecirc;n qu&acirc;n cả nước vỡ &ograve;a trong sung sướng.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&quot;Anh em ơi, nổi lửa l&ecirc;n đi, phất cờ l&ecirc;n đi. T&ocirc;i n&oacute;i rồi m&agrave;, Việt Nam v&ocirc; địch. B&atilde;o kh&ocirc;ng anh em ơi&quot;, kh&aacute;n giả Nguyễn C&ocirc;ng Khanh b&igrave;nh luận tr&ecirc;n page Cao Thủ Li&ecirc;n Qu&acirc;n.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&quot;Ch&uacute;c mừng cả Team Flash, h&ocirc;m nay c&aacute;c anh đ&atilde; c&oacute; một ng&agrave;y thi đấu tuyệt vời để đ&aacute;nh bại con qu&aacute;i vật mang t&ecirc;n Đ&agrave;i Bắc Trung Hoa&quot;.&amp;nbsp;&lt;/p&gt;&lt;table class=&quot;picture&quot; align=&quot;center&quot; style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 0.8em; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; border-collapse: collapse; border-spacing: 0px; width: 660px; font-family: sans-serif; color: rgb(136, 136, 136);&quot;&gt;&lt;tbody style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;&lt;tr style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;&lt;td class=&quot;pic&quot; style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%; position: relative; cursor: pointer;&quot;&gt;&lt;img alt=&quot;\'Xem Lien quan Viet Nam suong khong khac gi U23 thi dau\' hinh anh 1 &quot; src=&quot;https://znews-photo.zadn.vn/w660/Uploaded/lce_uxlcq/2019_07_14/150dea0914dcf082a9cd.jpg&quot; class=&quot;loaded&quot; style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%; max-width: 100%; display: block; height: auto; width: 660px;&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;&lt;td class=&quot;caption&quot; style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 5px 0px 8px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%; position: relative;&quot;&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14.08px; vertical-align: baseline; background: transparent; text-size-adjust: 100%; display: inline;&quot;&gt;Team Flash n&acirc;ng cao chiếc c&uacute;p v&ocirc; địch.&amp;nbsp;&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&quot;Cảm ơn Team Flash, cảm ơn đội tuyển Việt Nam đ&atilde; c&oacute; những trận thi đấu v&ocirc; c&ugrave;ng nỗ lực v&agrave; cống hiến để mang lại niềm tự h&agrave;o, chức v&ocirc; địch cho nền thể thao điện tử Việt Nam, bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile&quot;.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&quot;Tuyệt vời qu&aacute; Việt Nam ơi. Cảm ơn Team Flash đ&atilde; cống hiến một trận chung kết gi&agrave;u cảm x&uacute;c cho người h&acirc;m mộ cả nước. Đặc biệt l&agrave; c&aacute;c anh đ&atilde; kh&ocirc;ng qu&ecirc;n lời hứa v&ocirc; địch ngay tr&ecirc;n s&acirc;n nh&agrave;. Việt Nam v&ocirc; địch&quot;.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&quot;Xem đội tuyển Li&ecirc;n qu&acirc;n Việt Nam v&ocirc; địch thế giới sướng kh&ocirc;ng kh&aacute;c g&igrave; l&uacute;c xem U23 thi đấu. Qu&aacute; cảm x&uacute;c, qu&aacute; thăng hoa&quot;.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&lt;span style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;Những người h&acirc;m mộ bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile đ&atilde; c&oacute; những ph&uacute;t gi&acirc;y tuyệt vời. Đối với họ, đ&oacute; l&agrave; những cảm x&uacute;c kh&ocirc;ng kh&aacute;c g&igrave; khoảnh khắc U23 Việt Nam vượt qua U23 Qatar ở v&ograve;ng chung kết U23 ch&acirc;u &Aacute; 2018 v&agrave; l&uacute;c ĐTQG Việt Nam v&ocirc; địch AFF Cup.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&lt;span style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;Ngo&agrave;i ra những b&igrave;nh luận mang t&iacute;nh cảm x&uacute;c v&agrave; khen ngợi Team Flash, kh&aacute;n giả Việt Nam cũng tỏ ra rất c&ocirc;ng t&acirc;m khi d&agrave;nh những lời c&oacute; c&aacute;nh d&agrave;nh cho đội bạn.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&lt;span style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;&quot;Neil thực sự l&agrave; qu&aacute;i vật rồi, kh&ocirc;ng ai c&oacute; thể chối c&atilde;i. Việt Nam v&ocirc; địch v&igrave; ch&uacute;ng ta c&oacute; một tập thể qu&aacute; tốt v&agrave; một ch&uacute;t may mắn hơn team bạn&quot;, kh&aacute;n giả T&ugrave;ng Trần chia sẻ.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 18px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: rgb(255, 255, 255); text-size-adjust: 100%; color: rgb(51, 51, 51); font-family: &amp;quot;Noto Serif&amp;quot;, serif;&quot;&gt;&lt;span style=&quot;box-sizing: border-box; text-rendering: geometricprecision; -webkit-font-smoothing: antialiased; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 17.6px; vertical-align: baseline; background: transparent; text-size-adjust: 100%;&quot;&gt;&quot;Về nh&igrave; phải chịu thiệt th&ograve;i rồi. Thực sự Neil vẫn l&agrave; thần rừng số một thế giới. Việt Nam v&ocirc; địch nhờ một tập thể xuất sắc&quot;, Thoại Gooner c&ocirc;ng nhận t&agrave;i năng của người đi rừng b&ecirc;n ph&iacute;a Đ&agrave;i Bắc Trung Hoa.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', null, null, null, '', '', 'igf', '2019-07-14 22:37:29', null, '9', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('10', '2', 'Biểu tượng tr&ecirc;n bảng t&aacute;p-l&ocirc; xe hơi c&oacute; &yacute; nghĩa g&igrave;?', 'bieu-tuong-tren-bang-tap-lo-xe-hoi-co-y-nghia-gi', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/section-7-img-2.jpg', 'Biểu tượng tr&ecirc;n bảng t&aacute;p-l&ocirc; xe hơi c&oacute; &yacute; nghĩa g&igrave;? Đ&atilde; bao giờ bạn cảm thấy bối rối', '&lt;div&gt;Chức v&ocirc; địch n&agrave;y của Team Flash đ&aacute;nh dấu lần đầu ti&ecirc;n Việt Nam trở th&agrave;nh qu&aacute;n qu&acirc;n của một giải đấu Esports mang tầm cỡ thế giới. Điều đ&oacute; khiến người h&acirc;m mộ Li&ecirc;n qu&acirc;n cả nước vỡ &ograve;a trong sung sướng.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Anh em ơi, nổi lửa l&ecirc;n đi, phất cờ l&ecirc;n đi. T&ocirc;i n&oacute;i rồi m&agrave;, Việt Nam v&ocirc; địch. B&atilde;o kh&ocirc;ng anh em ơi&quot;, kh&aacute;n giả Nguyễn C&ocirc;ng Khanh b&igrave;nh luận tr&ecirc;n page Cao Thủ Li&ecirc;n Qu&acirc;n.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Ch&uacute;c mừng cả Team Flash, h&ocirc;m nay c&aacute;c anh đ&atilde; c&oacute; một ng&agrave;y thi đấu tuyệt vời để đ&aacute;nh bại con qu&aacute;i vật mang t&ecirc;n Đ&agrave;i Bắc Trung Hoa&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\'Xem Lien quan Viet Nam suong khong khac gi U23 thi dau\' hinh anh 1&amp;nbsp;&lt;/div&gt;&lt;div&gt;Team Flash n&acirc;ng cao chiếc c&uacute;p v&ocirc; địch.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&quot;Cảm ơn Team Flash, cảm ơn đội tuyển Việt Nam đ&atilde; c&oacute; những trận thi đấu v&ocirc; c&ugrave;ng nỗ lực v&agrave; cống hiến để mang lại niềm tự h&agrave;o, chức v&ocirc; địch cho nền thể thao điện tử Việt Nam, bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Tuyệt vời qu&aacute; Việt Nam ơi. Cảm ơn Team Flash đ&atilde; cống hiến một trận chung kết gi&agrave;u cảm x&uacute;c cho người h&acirc;m mộ cả nước. Đặc biệt l&agrave; c&aacute;c anh đ&atilde; kh&ocirc;ng qu&ecirc;n lời hứa v&ocirc; địch ngay tr&ecirc;n s&acirc;n nh&agrave;. Việt Nam v&ocirc; địch&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Xem đội tuyển Li&ecirc;n qu&acirc;n Việt Nam v&ocirc; địch thế giới sướng kh&ocirc;ng kh&aacute;c g&igrave; l&uacute;c xem U23 thi đấu. Qu&aacute; cảm x&uacute;c, qu&aacute; thăng hoa&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Những người h&acirc;m mộ bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile đ&atilde; c&oacute; những ph&uacute;t gi&acirc;y tuyệt vời. Đối với họ, đ&oacute; l&agrave; những cảm x&uacute;c kh&ocirc;ng kh&aacute;c g&igrave; khoảnh khắc U23 Việt Nam vượt qua U23 Qatar ở v&ograve;ng chung kết U23 ch&acirc;u &Aacute; 2018 v&agrave; l&uacute;c ĐTQG Việt Nam v&ocirc; địch AFF Cup.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Ngo&agrave;i ra những b&igrave;nh luận mang t&iacute;nh cảm x&uacute;c v&agrave; khen ngợi Team Flash, kh&aacute;n giả Việt Nam cũng tỏ ra rất c&ocirc;ng t&acirc;m khi d&agrave;nh những lời c&oacute; c&aacute;nh d&agrave;nh cho đội bạn.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Neil thực sự l&agrave; qu&aacute;i vật rồi, kh&ocirc;ng ai c&oacute; thể chối c&atilde;i. Việt Nam v&ocirc; địch v&igrave; ch&uacute;ng ta c&oacute; một tập thể qu&aacute; tốt v&agrave; một ch&uacute;t may mắn hơn team bạn&quot;, kh&aacute;n giả T&ugrave;ng Trần chia sẻ.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Về nh&igrave; phải chịu thiệt th&ograve;i rồi. Thực sự Neil vẫn l&agrave; thần rừng số một thế giới. Việt Nam v&ocirc; địch nhờ một tập thể xuất sắc&quot;, Thoại Gooner c&ocirc;ng nhận t&agrave;i năng của người đi rừng b&ecirc;n ph&iacute;a Đ&agrave;i Bắc Trung Hoa.&amp;nbsp;&lt;/div&gt;', null, null, null, '', '', 'igf', '2019-07-14 22:44:55', null, '16', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('11', '2', 'C&aacute;ch nhận biết lỗi v&agrave; định gi&aacute; khi mua xe cũ', 'cach-nhan-biet-loi-va-dinh-gia-khi-mua-xe-cu', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/section-7-img-3.jpg', 'Nếu cần mua xe cũ bạn cần bỏ t&uacute;i những kiến thức cơ bản để kiểm tra, tr&aacute;nh', '&lt;div&gt;Chức v&ocirc; địch n&agrave;y của Team Flash đ&aacute;nh dấu lần đầu ti&ecirc;n Việt Nam trở th&agrave;nh qu&aacute;n qu&acirc;n của một giải đấu Esports mang tầm cỡ thế giới. Điều đ&oacute; khiến người h&acirc;m mộ Li&ecirc;n qu&acirc;n cả nước vỡ &ograve;a trong sung sướng.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Anh em ơi, nổi lửa l&ecirc;n đi, phất cờ l&ecirc;n đi. T&ocirc;i n&oacute;i rồi m&agrave;, Việt Nam v&ocirc; địch. B&atilde;o kh&ocirc;ng anh em ơi&quot;, kh&aacute;n giả Nguyễn C&ocirc;ng Khanh b&igrave;nh luận tr&ecirc;n page Cao Thủ Li&ecirc;n Qu&acirc;n.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Ch&uacute;c mừng cả Team Flash, h&ocirc;m nay c&aacute;c anh đ&atilde; c&oacute; một ng&agrave;y thi đấu tuyệt vời để đ&aacute;nh bại con qu&aacute;i vật mang t&ecirc;n Đ&agrave;i Bắc Trung Hoa&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;\'Xem Lien quan Viet Nam suong khong khac gi U23 thi dau\' hinh anh 1&amp;nbsp;&lt;/div&gt;&lt;div&gt;Team Flash n&acirc;ng cao chiếc c&uacute;p v&ocirc; địch.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&quot;Cảm ơn Team Flash, cảm ơn đội tuyển Việt Nam đ&atilde; c&oacute; những trận thi đấu v&ocirc; c&ugrave;ng nỗ lực v&agrave; cống hiến để mang lại niềm tự h&agrave;o, chức v&ocirc; địch cho nền thể thao điện tử Việt Nam, bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Tuyệt vời qu&aacute; Việt Nam ơi. Cảm ơn Team Flash đ&atilde; cống hiến một trận chung kết gi&agrave;u cảm x&uacute;c cho người h&acirc;m mộ cả nước. Đặc biệt l&agrave; c&aacute;c anh đ&atilde; kh&ocirc;ng qu&ecirc;n lời hứa v&ocirc; địch ngay tr&ecirc;n s&acirc;n nh&agrave;. Việt Nam v&ocirc; địch&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Xem đội tuyển Li&ecirc;n qu&acirc;n Việt Nam v&ocirc; địch thế giới sướng kh&ocirc;ng kh&aacute;c g&igrave; l&uacute;c xem U23 thi đấu. Qu&aacute; cảm x&uacute;c, qu&aacute; thăng hoa&quot;.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Những người h&acirc;m mộ bộ m&ocirc;n Li&ecirc;n qu&acirc;n Mobile đ&atilde; c&oacute; những ph&uacute;t gi&acirc;y tuyệt vời. Đối với họ, đ&oacute; l&agrave; những cảm x&uacute;c kh&ocirc;ng kh&aacute;c g&igrave; khoảnh khắc U23 Việt Nam vượt qua U23 Qatar ở v&ograve;ng chung kết U23 ch&acirc;u &Aacute; 2018 v&agrave; l&uacute;c ĐTQG Việt Nam v&ocirc; địch AFF Cup.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Ngo&agrave;i ra những b&igrave;nh luận mang t&iacute;nh cảm x&uacute;c v&agrave; khen ngợi Team Flash, kh&aacute;n giả Việt Nam cũng tỏ ra rất c&ocirc;ng t&acirc;m khi d&agrave;nh những lời c&oacute; c&aacute;nh d&agrave;nh cho đội bạn.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Neil thực sự l&agrave; qu&aacute;i vật rồi, kh&ocirc;ng ai c&oacute; thể chối c&atilde;i. Việt Nam v&ocirc; địch v&igrave; ch&uacute;ng ta c&oacute; một tập thể qu&aacute; tốt v&agrave; một ch&uacute;t may mắn hơn team bạn&quot;, kh&aacute;n giả T&ugrave;ng Trần chia sẻ.&amp;nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&quot;Về nh&igrave; phải chịu thiệt th&ograve;i rồi. Thực sự Neil vẫn l&agrave; thần rừng số một thế giới. Việt Nam v&ocirc; địch nhờ một tập thể xuất sắc&quot;, Thoại Gooner c&ocirc;ng nhận t&agrave;i năng của người đi rừng b&ecirc;n ph&iacute;a Đ&agrave;i Bắc Trung Hoa.&amp;nbsp;&lt;/div&gt;', null, null, null, '', '', 'igf', '2019-07-14 22:43:31', null, '21', '2', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('12', '62', 'CẢM BIẾN CH&Acirc;N GA FORD FIESTA', 'cam-bien-chan-ga-ford-fiesta', 'http://demo.loichoi.com/batdongsan/images/mua-phu-tung-o-to-tr-e98fwm-2036.jpg', 'Gi&aacute;: 750.000 VNĐ\r\nCẢM BIẾN CH&Acirc;N GA FORD FIESTA-TDN1707, sản xuất bởi Ford, phụ t&ugrave;ng ch&iacute;nh h&atilde;ng, gi&aacute; tốt nhất.\r\nThương hiệu: Ford\r\nXuất xứ: Th&aacute;i Lan', '&lt;h3 style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 26px; margin: 0.6em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;CẢM BIẾN CH&Acirc;N GA FORD FIESTA-TDN1707, sản xuất bởi Ford, phụ t&ugrave;ng ch&iacute;nh h&atilde;ng, gi&aacute; tốt nhất. Cảm biến ch&acirc;n ga Ford Fiesta sản xuất tại Th&aacute;i Lan&lt;/h3&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;img src=&quot;https://muaphutungoto.vn/wp-content/uploads/2019/07/b6581a84a142451c1c53-300x300.jpg&quot; style=&quot;font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; height: auto; max-width: 100%; box-sizing: border-box; display: inline-block;&quot;&gt;&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Cảm biến ch&acirc;n ga Ford Fiesta thuộc hệ thống cung cấp kh&iacute; nạp của &ocirc; t&ocirc; nhập khẩu trực tiếp tại Th&aacute;i Lan v&agrave; được ph&acirc;n phối bởi trung t&acirc;m Phụ t&ugrave;ng &ocirc; t&ocirc; Th&agrave;nh Dũng&lt;/p&gt;&lt;p class=&quot;Normal&quot; style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Cảm biến ch&acirc;n ga Ford Fiesta&amp;nbsp;c&oacute; nhiệm vụ ghi lại độ mở của bướm ga v&agrave; gửi th&ocirc;ng tin về ECU để điều chỉnh lượng phun nhi&ecirc;n liệu cho hợp l&yacute;.&lt;/p&gt;&lt;p class=&quot;Normal&quot; style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Cảm biến bướm ga Ford Fiesta&amp;nbsp;ch&iacute;nh h&atilde;ng n&ecirc;n người sử dụng c&oacute; thể y&ecirc;n t&acirc;m về chất lượng, cũng như những t&iacute;nh năng v&agrave; độ bền của sản phẩm.&lt;/p&gt;&lt;figure id=&quot;attachment_29219&quot; class=&quot;wp-caption alignnone&quot; style=&quot;font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; max-width: 100%; float: none !important;&quot;&gt;&lt;figcaption class=&quot;wp-caption-text&quot; style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;CH&Iacute;NH S&Aacute;CH BẢO H&Agrave;NH TỐT NHẤT CỦA TH&Agrave;NH DŨNG&lt;/figcaption&gt;&lt;/figure&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Sản phẩm được đổi trả trong v&ograve;ng 7 ng&agrave;y&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Sản phẩm được ho&agrave;n tiền trong v&ograve;ng 7 ng&agrave;y&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Sản phẩm được bảo h&agrave;nh mới 100%, đ&uacute;ng nguồn gốc xuất xứ&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Sản phẩm được bảo h&agrave;nh lắp l&ecirc;n&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&ndash; Ch&uacute;ng t&ocirc;i khuyến c&aacute;o kh&aacute;ch h&agrave;ng sử dụng sản phẩm được ph&acirc;n phối bởi Th&agrave;nh Dũng. Để tr&aacute;nh miaua phải những sản phẩm nh&aacute;i, k&eacute;m chất lượng tr&ecirc;n thị trường.&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&ndash; Ch&uacute;ng t&ocirc;i tự h&agrave;o được phục vụ h&agrave;ng trăm ng&agrave;n kh&aacute;ch h&agrave;ng tr&ecirc;n mọi miền của tổ quốc. Đặc biệt được sự ủng hộ của một số kh&aacute;ch h&agrave;ng quốc tế.&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&ndash; Th&agrave;nh Dũng cam kết b&aacute;n h&agrave;ng với gi&aacute; rẻ nhất. Đảm bảo đ&uacute;ng nguồn gốc xuất xứ của sản phẩm.&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Tất cả c&aacute;c sản phẩm được ph&acirc;n phối bởi Th&agrave;nh Dũng được đổi, trả lại h&agrave;ng hoặc ho&agrave;n tiền trong v&ograve;ng 7 ng&agrave;y kể từ ng&agrave;y xuất h&agrave;ng. Với điều kiện h&agrave;ng c&ograve;n nguy&ecirc;n vẹn, kh&ocirc;ng lắp r&aacute;p, trầy xước, c&ograve;n nguy&ecirc;n vỏ hộp.&lt;/p&gt;&lt;h3 style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 26px; margin: 0.6em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Kh&aacute;ch h&agrave;ng n&oacute;i về ch&uacute;ng t&ocirc;i&lt;/h3&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;C&oacute; rất nhiều&lt;a href=&quot;https://10hay.com/top-list/top-10-cua-hang-phu-tung-xe-may-tai-ha-noi.html&quot; style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px;&quot;&gt;&amp;nbsp;forum&lt;/a&gt;,&amp;nbsp;&lt;a href=&quot;https://www.yellowpages.vnn.vn/lgs/1187803749/phu-tung-o-to-thanh-dung.html&quot; style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px;&quot;&gt;diễn đ&agrave;n&lt;/a&gt;&amp;nbsp;sử dụng th&ocirc;ng tin, h&igrave;nh ảnh của ch&uacute;ng t&ocirc;i cho những mục đ&iacute;ch kh&aacute;c nhau. Tuy nhi&ecirc;n ch&uacute;ng t&ocirc;i rất hoan ngh&ecirc;nh nếu c&aacute;c bạn dẫn nguồn từ trang web của Th&agrave;nh Dũng&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;Trung t&acirc;m phụ t&ugrave;ng &ocirc; t&ocirc; Th&agrave;nh Dũng chỉ ph&acirc;n phối tại địa chỉ duy nhất tại số 211 ng&otilde; 281 Trần Kh&aacute;t Ch&acirc;n. Mọi chi tiết xin li&ecirc;n hệ với số tổng đ&agrave;i hotline&amp;nbsp;0931.029.029, 0944.628.333, 01647.303.303, 01647.313.313&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;(H&igrave;nh ảnh thuộc bản quyền của Th&agrave;nh Dũng Auto)&lt;/p&gt;&lt;p style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: 22px; margin: 1em 0px; padding: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;img src=&quot;https://phutungotogiare.vn/data/uploads/2019/07/b6581a84a142451c1c53.jpg&quot; alt=&quot;C&aacute;&ordm;&cent;M BI&aacute;&ordm;&frac34;N CH&Atilde;N GA FORD FIESTA&quot; style=&quot;font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; height: auto; max-width: 100%; box-sizing: border-box; display: inline-block;&quot;&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', null, null, null, '', '', 'admin', '2019-07-19 14:14:52', '2019-07-19 14:17:55', '12', '1', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('14', '2', 'test 123', 'test-123', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', '&lt;p&gt;1111&lt;/p&gt;', '&lt;p&gt;1111&lt;/p&gt;', null, null, null, null, null, 'admin', '2019-09-14 08:55:38', '2019-09-14 10:28:33', '0', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('15', '51', 'test2', 'test2', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', '', '', null, null, null, null, null, 'admin', '2019-09-14 08:58:32', '2019-09-14 10:33:16', '0', '0', '0', '0', '1');
INSERT INTO `tbl_contents` VALUES ('16', '51', 'test 2', 'test-2', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', '&lt;p&gt;fdsfsdfdsf&lt;/p&gt;', '&lt;p&gt;fsdfsdfsdfsdfsd&lt;/p&gt;', '1', '1000', '200000000', null, null, 'admin', '2019-09-14 10:33:54', '2019-09-14 11:20:35', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for tbl_document
-- ----------------------------
DROP TABLE IF EXISTS `tbl_document`;
CREATE TABLE `tbl_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `filetype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` int(11) NOT NULL,
  `date_issued` datetime DEFAULT NULL,
  `cdate` datetime NOT NULL,
  `mdate` datetime DEFAULT NULL,
  `pages` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ishot` int(11) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`views`),
  FULLTEXT KEY `idx` (`name`,`intro`,`content`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_document
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_document_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_document_group`;
CREATE TABLE `tbl_document_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` int(11) DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_document_group
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_feedback
-- ----------------------------
DROP TABLE IF EXISTS `tbl_feedback`;
CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `career` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `isactive` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_feedback
-- ----------------------------
INSERT INTO `tbl_feedback` VALUES ('1', 'Layla', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', 'Tôi thật sự bị ấn tượng bởi sự nhiệt tình và chu đáo dành cho khách hàng ở đây. Không chỉ chuyên sửa Lexus uy tín, mà chất lượng phục vụ cũng rất tốt. Dịch vụ ở đây hoàn toàn thuyết phục', 'Doanh nhân', '1', '1');
INSERT INTO `tbl_feedback` VALUES ('2', 'DAVID MATIN', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', 'Tôi hài lòng về dịch vụ bảo hành ở đây, các kỹ sư sau khi sửa ô tô Lexus còn gọi điện chăm sóc và hỏi thăm tình trạng ô tô sau khi sửa chữa. Dịch vụ ở đây hoàn toàn thuyết phục một khách hàng khó tính như tôi', 'Student', '0', '1');
INSERT INTO `tbl_feedback` VALUES ('3', 'Võ Văn Vẻ', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', 'Tôi hài lòng về dịch vụ bảo hành ở đây, các kỹ sư sau khi sửa ô tô Lexus còn gọi điện chăm sóc và hỏi thăm tình trạng ô tô sau khi sửa chữa. Dịch vụ ở đây hoàn toàn thuyết phục một khách hàng khó tính như tôi', 'Nhân viên văn phòng', null, '1');
INSERT INTO `tbl_feedback` VALUES ('4', 'Hoàng Rapper', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', 'Tôi hài lòng về dịch vụ bảo hành ở đây, các kỹ sư sau khi sửa ô tô Lexus còn gọi điện chăm sóc và hỏi thăm tình trạng ô tô sau khi sửa chữa. Dịch vụ ở đây hoàn toàn thuyết phục một khách hàng khó tính như tôi', 'Nhân viên văn phòng', null, '1');

-- ----------------------------
-- Table structure for tbl_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_gallery
-- ----------------------------
INSERT INTO `tbl_gallery` VALUES ('1', '8', 'hinh-anh-1', 'http://demo.loichoi.com/batdongsan/images/gallery/bd5.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('2', '8', 'hinh-anh-2', 'http://demo.loichoi.com/batdongsan/images/gallery/bd6.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('3', '8', 'hinh-anh-3', 'http://demo.loichoi.com/batdongsan/images/gallery/bd7.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('4', '8', 'hinh-anh-4', 'http://demo.loichoi.com/batdongsan/images/gallery/bd8.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('5', '8', 'hinh-anh-5', 'http://demo.loichoi.com/batdongsan/images/gallery/bd1.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('6', '8', 'hinh-anh-6', 'http://demo.loichoi.com/batdongsan/images/gallery/bd2.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('7', '8', 'hinh-anh-7', 'http://demo.loichoi.com/batdongsan/images/gallery/bd4.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('8', '8', 'ha1', 'http://demo.loichoi.com/batdongsan/images/gallery/block-4-img-5.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('9', '8', 'ha2', 'http://demo.loichoi.com/batdongsan/images/gallery/block-4-img-6.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('10', '8', 'ha3', 'http://demo.loichoi.com/batdongsan/images/gallery/block-4-img-7.jpg', '1');
INSERT INTO `tbl_gallery` VALUES ('11', '8', 'ha4', 'http://demo.loichoi.com/batdongsan/images/gallery/block-4-img-8.jpg', '1');

-- ----------------------------
-- Table structure for tbl_mail_config
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mail_config`;
CREATE TABLE `tbl_mail_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL DEFAULT '110',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_mail_config
-- ----------------------------
INSERT INTO `tbl_mail_config` VALUES ('1', 'admin', 'yourdomain.com', 'info@yourdomain.com', '123456', '465', 'YOURDOMAIN.COM');

-- ----------------------------
-- Table structure for tbl_menus
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menus`;
CREATE TABLE `tbl_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_menus
-- ----------------------------
INSERT INTO `tbl_menus` VALUES ('1', 'Main menu', 'main-menu', '', '1');
INSERT INTO `tbl_menus` VALUES ('3', 'Menu Footer', 'Menu-footer', '', '1');

-- ----------------------------
-- Table structure for tbl_mnuitems
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mnuitems`;
CREATE TABLE `tbl_mnuitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `intro` text COLLATE utf8_unicode_ci,
  `viewtype` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `content_id` int(11) NOT NULL DEFAULT '0',
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_mnuitems
-- ----------------------------
INSERT INTO `tbl_mnuitems` VALUES ('1', '0', '1', 'Trang chủ', 'trang-chu', '', 'link', '0', '0', 'http://demo.loichoi.com/batdongsan/', 'fa fa-home', 'home', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('2', '2', '1', 'Giới thiệu', 'gioi-thieu', '<img src=\"http://daihocdongdo.edu.vn/images/DD.jpg\" alt=\"\" align=\"\" border=\"0px\">', 'block', '44', '0', '', '', '', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('3', '0', '1', 'Giới thiệu', 'gioi-thieu', '', 'article', '0', '2', '', '', '', '1', '1');
INSERT INTO `tbl_mnuitems` VALUES ('4', '0', '1', 'Dịch vụ', 'dich-vu', '', 'link', '0', '0', '#', '', '', '2', '1');
INSERT INTO `tbl_mnuitems` VALUES ('5', '0', '1', 'Tin tức', 'tin-tuc', null, 'block', '2', '0', '', '', '', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('6', '0', '1', 'Phụ tùng', 'phu-tung', '', 'link', '0', '0', '#', '', '', '18', '1');
INSERT INTO `tbl_mnuitems` VALUES ('7', '0', '1', 'FAQ', 'faq', '', 'block', '60', '0', '', '', '', '19', '1');
INSERT INTO `tbl_mnuitems` VALUES ('10', '0', '3', 'FAQs', 'faqs', null, 'link', '0', '0', '#', '', '', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('11', '0', '3', 'Liên hệ', 'lien-he', null, 'link', '0', '0', '#', '', '', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('13', '0', '1', 'Hình ảnh', 'hinh-anh', null, 'link', '0', '0', 'http://demo.loichoi.com/batdongsan/gallery/8/thu-vien-anh.html', '', '', '19', '1');
INSERT INTO `tbl_mnuitems` VALUES ('12', '6', '1', 'Phụ tùng động cơ', 'phu-tung-dong-co', '', 'block', '62', '0', '', '', '', '0', '1');
INSERT INTO `tbl_mnuitems` VALUES ('14', '4', '1', 'Sửa chữa gầm máy', 'sua-chua-gam-may', null, 'article', '0', '3', '', '', '', '3', '1');

-- ----------------------------
-- Table structure for tbl_modtype
-- ----------------------------
DROP TABLE IF EXISTS `tbl_modtype`;
CREATE TABLE `tbl_modtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_modtype
-- ----------------------------
INSERT INTO `tbl_modtype` VALUES ('1', 'mainmenu', 'Main menu');
INSERT INTO `tbl_modtype` VALUES ('2', 'html', 'HTML');
INSERT INTO `tbl_modtype` VALUES ('3', 'news', 'Tin tức');
INSERT INTO `tbl_modtype` VALUES ('12', 'slide', 'Slideshow');
INSERT INTO `tbl_modtype` VALUES ('13', 'video', 'Tin Video');
INSERT INTO `tbl_modtype` VALUES ('14', 'gallery', 'Tin ảnh');
INSERT INTO `tbl_modtype` VALUES ('15', 'partner', 'Đối tác');
INSERT INTO `tbl_modtype` VALUES ('16', 'content', 'Bài viết');

-- ----------------------------
-- Table structure for tbl_modules
-- ----------------------------
DROP TABLE IF EXISTS `tbl_modules`;
CREATE TABLE `tbl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `viewtitle` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) DEFAULT NULL,
  `menu_ids` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(50) DEFAULT NULL,
  `content_id` int(50) DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_modules
-- ----------------------------
INSERT INTO `tbl_modules` VALUES ('2', 'mainmenu', 'Main menu', '', '', '0', '1', '', '0', null, '', 'navitor', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('54', 'html', 'Sửa chữa thành công', '', '<div class=\"circle\"><div><img src=\"http://demo.loichoi.com/batdongsan/images/icons/icon_car.png\" alt=\"\" align=\"\" border=\"0\"></div><div class=\"count\">850</div></div><div class=\"title\">Sửa chữa thành công</div>', '0', '0', null, '0', null, '', 'box4', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('55', 'news', 'Dịch vụ của chúng tôi', '', '', '1', '0', null, '59', null, 'branch', 'box5', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('15', 'html', 'Logo', '', '<img src=\"http://demo.loichoi.com/batdongsan/images/logo/logo_mydinh_thc.png\" class=\"img-responsive\">', '0', '0', '', '0', null, '', 'user1', 'logo', '1', '1');
INSERT INTO `tbl_modules` VALUES ('51', 'html', 'Dịch vụ phương tiện', '', '<div class=\"circle\"><div><img src=\"http://demo.loichoi.com/batdongsan/images/icons/icon_car.png\" alt=\"\" align=\"\" border=\"0\"></div><div class=\"count\">850</div></div><div class=\"title\">Dịch vụ phương tiện</div>', '0', '0', null, '0', null, '', 'box1', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('52', 'html', 'Chuyên gia của chúng tôi', '', '<div class=\"circle\"><div><img src=\"http://demo.loichoi.com/batdongsan/images/icons/icon_user.png\" alt=\"\" align=\"\" border=\"0\"></div><div class=\"count\">250</div></div><div class=\"title\">Chuyên gia của chúng tôi</div>', '0', '0', null, '0', null, '', 'box2', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('53', 'html', 'Khách hàng hài lòng', '', '<div class=\"circle\"><div><img src=\"http://demo.loichoi.com/batdongsan/images/icons/icon_customer.png\" alt=\"\" align=\"\" border=\"0\"></div><div class=\"count\">1500</div></div><div class=\"title\">Khách hàng hài lòng</div>', '0', '0', null, '0', null, '', 'box3', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('44', 'html', 'Logo trên di động', '', '<img src=\"http://daihocdongdo.edu.vn/images/logo-mobile.jpg\" class=\"img-responsive\">', '0', '0', null, '0', null, '', 'mobile1', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('50', 'html', 'Video giới thiệu', '', '<iframe width=\"560\" height=\"320\" src=\"https://www.youtube.com/embed/G3Qih-C6xEw\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\"></iframe>', '0', '0', null, '0', null, '', 'user6', 'video', '0', '1');
INSERT INTO `tbl_modules` VALUES ('21', 'html', 'Copyright', '', '© Copyright 2019 Mỹ Đình THC', '0', '0', null, '0', null, '', 'bottom', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('57', 'mainmenu', 'Footer menu', '', '', '0', '3', null, '0', null, 'menu_footer', 'box7', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('47', 'html', 'Hotline (Đầu trang)', '', '096.410.4444<div>096.887.8768</div>', '0', '0', null, '0', null, '', 'user4', 'pull-right', '0', '1');
INSERT INTO `tbl_modules` VALUES ('48', 'slide', 'Banner slideshow', '', '', '0', '0', null, '0', null, '', 'banner', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('49', 'content', 'Mỹ Đình THC Kính chào Quý khách!', '', '', '0', '0', null, '0', '2', 'default', 'user5', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('46', 'html', 'Giờ làm việc (Đầu trang)', '', '<span style=\"font-weight: bold;\">Giờ làm việc</span><div>T2-T7: 8h00 - 17h00</div>', '0', '0', null, '0', null, '', 'user3', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('45', 'html', 'Địa chỉ (Đầu trang)', '', '<span style=\"font-weight: bold;\">430 &amp; 563 Đ.Phúc Diễn,</span><div>P.Xuân Phương, Q.Nam Từ Liêm, Hà Nội</div>', '0', '0', null, '0', null, '', 'user2', '', '2', '1');
INSERT INTO `tbl_modules` VALUES ('43', 'html', 'Thông tin liên hệ - Trang liên hệ', '', '<div><span style=\"font-size: 24px;\">THC AUTO SERVICE</span></div><div><br></div><div><div>XƯỞNG DỊCH VỤ 1:</div><div>430 đường Phúc Diễm, Xuân Phương, Nam Từ Liêm, HN</div><div><br></div><div>XƯỞNG DỊCH VỤ 2:</div><div>563 đường Phúc Diễm, Xuân Phương, Nam Từ Liêm, HN</div><div><br></div><div>HOTLINE:</div><div>0968.87.87.68 - 0964.10.4444 (Hỗ trợ 24/7)</div><div><br></div><div>EMAIL:</div><div>otomydinhthc@gmail.com</div></div>', '0', '0', null, '0', null, '', 'user9', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('56', 'gallery', 'Hình ảnh tại Mĩ Đình THC', '', '', '0', '0', null, '0', null, '', 'box6', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('58', 'news', 'Footer dịch vụ', '', '', '0', '0', null, '59', null, 'footer_dich_vu', 'box8', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('59', 'html', 'Footer liên hệ', '', '<div>&lt;div class=\"title\"&gt;Liên hệ&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"dlab-separator-outer m-b10\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"dlab-separator style-skew\"&gt;&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"sub_item\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;i class=\"fa fa-map-marker\" aria-hidden=\"true\"&gt;&lt;/i&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"content\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"name\"&gt;Xưởng dịch vụ 1:&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;p class=\"info\"&gt;430 đường Phúc Diễn, Xuân Phương, Nam Từ Liêm, HN&lt;/p&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"sub_item\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;i class=\"fa fa-map-marker\" aria-hidden=\"true\"&gt;&lt;/i&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"content\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"name\"&gt;Xưởng dịch vụ 2:&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;p class=\"info\"&gt;563 đường Phúc Diễn, Xuân Phương, Nam Từ Liêm, HN&lt;/p&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"sub_item\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;i class=\"fa fa-mobile\" aria-hidden=\"true\"&gt;&lt;/i&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"content\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"name phone\"&gt;HOTLINE:&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;p class=\"info\"&gt;0968.87.87.68 - 0964.10.4444 (Hỗ trợ 24/7)&lt;/p&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"sub_item\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;i class=\"fa fa-mobile\" aria-hidden=\"true\"&gt;&lt;/i&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"content\"&gt;</div><div><span style=\"white-space:pre\"></span>&lt;div class=\"name phone\"&gt;EMAIL:&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;p class=\"info\"&gt;otomydinhthc@gmail.com&lt;/p&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div><div><span style=\"white-space:pre\"></span>&lt;/div&gt;</div>', '0', '0', null, '0', null, '', 'box9', '', '0', '0');
INSERT INTO `tbl_modules` VALUES ('64', 'html', 'Footer: Xưởng dịch vụ 1', '', '<div class=\"name\">Xưởng dịch vụ 1:</div><p class=\"info\">430 đường Phúc Diễn, Xuân Phương, Nam Từ Liêm, HN</p>', '0', '0', null, '0', null, '', 'footer1', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('65', 'html', 'Footer: Xưởng dịch vụ 2', '', '<div class=\"name\">Xưởng dịch vụ 2:</div><p class=\"info\">563 đường Phúc Diễn, Xuân Phương, Nam Từ Liêm, HN</p>', '0', '0', null, '0', null, '', 'footer2', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('66', 'html', 'Footer: hotline', '', '<div class=\"name phone\">HOTLINE:</div><p class=\"info\">0968.87.87.68 - 0964.10.4444 (Hỗ trợ 24/7)</p>', '0', '0', null, '0', null, '', 'footer3', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('67', 'html', 'Footer: Email', '', '<div class=\"name phone\">EMAIL:</div><p class=\"info\"><a href=\"mailto:otomydinhthc@gmail.com\">otomydinhthc@gmail.com</a></p>', '0', '0', null, '0', null, '', 'footer4', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('68', 'html', 'Footer: THC AUTO SERVICE', '', '<div class=\"title_auto_service\">THC AUTO SERVICE</div><div class=\"intro\">Mang đến cho Khách hàng sự hài lòng về chất lượng dịch vụ HƠN CẢ MONG ĐỢI</div>', '0', '0', null, '0', null, '', 'footer5', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('61', 'partner', 'Slide đối tác', '', '', '0', '0', null, '0', null, '', 'user7', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('62', 'news', 'Tin tức tại THC', '', '', '0', '0', null, '2', null, 'news1', 'user8', '', '0', '1');
INSERT INTO `tbl_modules` VALUES ('63', 'news', 'Tư vấn / Đặt lịch', '', '', '0', '0', null, '2', '0', 'events', 'banner1', '', '0', '1');

-- ----------------------------
-- Table structure for tbl_partner
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE `tbl_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_partner
-- ----------------------------
INSERT INTO `tbl_partner` VALUES ('1', 'Đối t&aacute;c 1', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/logo1.jpg', '', '1', '1');
INSERT INTO `tbl_partner` VALUES ('2', 'Đối t&aacute;c 2', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/logo2.jpg', '', '2', '1');
INSERT INTO `tbl_partner` VALUES ('3', 'Đối t&aacute;c 3', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/logo3.jpg', '', '3', '1');
INSERT INTO `tbl_partner` VALUES ('4', 'Đối t&aacute;c 4', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/logo4.jpg', '', '4', '1');
INSERT INTO `tbl_partner` VALUES ('5', 'Đối t&aacute;c 5', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/logo1.jpg', '', '5', '1');

-- ----------------------------
-- Table structure for tbl_personnel
-- ----------------------------
DROP TABLE IF EXISTS `tbl_personnel`;
CREATE TABLE `tbl_personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_personnel
-- ----------------------------
INSERT INTO `tbl_personnel` VALUES ('1', 'Benson Casero', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns1.jpg', 'Tổng giám đốc', '1', '1');
INSERT INTO `tbl_personnel` VALUES ('2', 'Nguyễn Thanh Hải', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns4.jpg', 'Trưởng phòng kinh doanh', '2', '1');
INSERT INTO `tbl_personnel` VALUES ('3', 'Trần Quốc Chí', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns3.jpg', 'Phó tổng giám đốc', '3', '1');
INSERT INTO `tbl_personnel` VALUES ('4', 'Võ Chí Công', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns4.jpg', 'Trưởng phòng kỹ thuật', '4', '1');
INSERT INTO `tbl_personnel` VALUES ('5', 'Nguyễn Thị Thủy', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns5.jpg', 'Nhân viên kinh doanh', '5', '1');
INSERT INTO `tbl_personnel` VALUES ('6', 'Nguyễn Hồng', 'http://demo.loichoi.com/batdongsan/images/nhan-su/ns6.jpg', 'Nhân viên kinh doanh', '6', '1');

-- ----------------------------
-- Table structure for tbl_schedule
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule`;
CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_schedule
-- ----------------------------
INSERT INTO `tbl_schedule` VALUES ('1', 'Nguyễn Văn Nam1', '59', 'abc@gmail.com1', '09695499991', '2019-08-24 00:00:00', 'hehehihi111', 'hihihehe111', '1');
INSERT INTO `tbl_schedule` VALUES ('2', 'DAVID MATIN', '7', 'abc@gmail.com1', '09695499991', '2019-08-03 00:00:00', 'hihihehe', 'hihihaha', '1');
INSERT INTO `tbl_schedule` VALUES ('3', 'DAVID MATIN', '7', 'abc@gmail.com1', '09695499991', '2019-08-03 00:00:00', 'hihihehe', 'hihihaha', '1');
INSERT INTO `tbl_schedule` VALUES ('4', 'Nguyễn Thị Ly', '6', 'abc@gmail.com', '0969548888', '2019-08-02 00:00:00', 'hihihehe', 'hihihaha', '1');
INSERT INTO `tbl_schedule` VALUES ('5', 'Nguyễn Thị Ly', '6', 'abc@gmail.com', '0969548888', '2019-08-02 00:00:00', 'hihihehe', 'hihihaha', '1');
INSERT INTO `tbl_schedule` VALUES ('6', 'Đối tác 1', '0', '', '', '0000-00-00 00:00:00', '', '', '1');
INSERT INTO `tbl_schedule` VALUES ('7', 'DAVID MATIN', '8', 'abc@gmail.com1', '09695499991', '2019-07-19 00:00:00', 'hihihehe', 'hihihaha', '1');
INSERT INTO `tbl_schedule` VALUES ('8', 'DAVID MATIN', '13', 'abc@gmail.com1', '09695499991', '2019-08-02 00:00:00', '', '', '1');

-- ----------------------------
-- Table structure for tbl_seo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_seo`;
CREATE TABLE `tbl_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ishot` tinyint(4) DEFAULT '0',
  `order` tinyint(4) DEFAULT '0',
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_seo
-- ----------------------------
INSERT INTO `tbl_seo` VALUES ('1', 'Việc rửa khoang máy ô tô nhiều người còn e ngại !', 'http://demo.loichoi.com/batdongsan/tin-tuc/test-123.html', 'http://demo.loichoi.com/batdongsan/images/basic/avata-1.jpg', 'Việc rửa khoang m&aacute;y &ocirc; t&ocirc; nhiều người c&ograve;n e ngại !', 'Việc rửa khoang m&aacute;y &ocirc; t&ocirc; nhiều người c&ograve;n e ngại !', 'Việc rửa khoang m&aacute;y &ocirc; t&ocirc; nhiều người c&ograve;n e ngại !', '0', '0', '1');
INSERT INTO `tbl_seo` VALUES ('5', 'Biểu tượng trên bảng táp-lô xe hơi có ý nghĩa gì?', '#', 'http://demo.loichoi.com/batdongsan/images/hinh-anh/avata-1.jpg', 'Biểu tượng tr&ecirc;n bảng t&aacute;p-l&ocirc; xe hơi c&oacute; &yacute; nghĩa g&igrave;?', 'Biểu tượng tr&ecirc;n bảng t&aacute;p-l&ocirc; xe hơi c&oacute; &yacute; nghĩa g&igrave;?', 'Biểu tượng tr&ecirc;n bảng t&aacute;p-l&ocirc; xe hơi c&oacute; &yacute; nghĩa g&igrave;?', '0', '0', '1');

-- ----------------------------
-- Table structure for tbl_slider
-- ----------------------------
DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slogan` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_slider
-- ----------------------------
INSERT INTO `tbl_slider` VALUES ('18', 'SỬA CHỮA PHỤC HỒI XE Ô TÔ', 'Đặt lịch hẹn Hôm nay <span style=\"color: rgb(250, 121, 1); font-weight: bold;\">GIẢM NGAY 15%</span><div><br><div><button class=\"btn btn-view\">ĐẶT LỊCH SỬA CHỮA</button></div></div>', '0', 'http://demo.loichoi.com/batdongsan/images/banner/slide9.jpg', '', null, '1');
INSERT INTO `tbl_slider` VALUES ('19', 'SỬA CHỮA PHỤC HỒI XE Ô TÔ', 'Đặt lịch hẹn Hôm nay <span style=\"color: rgb(250, 121, 1); font-weight: bold;\">GIẢM NGAY 15%</span><div><br><div><button class=\"btn btn-view\">ĐẶT LỊCH SỬA CHỮA</button></div></div>', '0', 'http://demo.loichoi.com/batdongsan/images/banner/slide10.jpg', '', null, '1');
INSERT INTO `tbl_slider` VALUES ('20', 'SỬA CHỮA PHỤC HỒI XE Ô TÔ', 'Đặt lịch hẹn Hôm nay <span style=\"color: rgb(250, 121, 1); font-weight: bold;\">GIẢM NGAY 15%</span><div><br><div><button class=\"btn btn-view\">ĐẶT LỊCH SỬA CHỮA</button></div></div>', '0', 'http://demo.loichoi.com/batdongsan/images/banner/slide1.jpg', '', null, '1');

-- ----------------------------
-- Table structure for tbl_tags
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tags`;
CREATE TABLE `tbl_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text,
  `pids` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tags
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_type_of_land
-- ----------------------------
DROP TABLE IF EXISTS `tbl_type_of_land`;
CREATE TABLE `tbl_type_of_land` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ishot` tinyint(4) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_type_of_land
-- ----------------------------
INSERT INTO `tbl_type_of_land` VALUES ('1', 'Đất trồng cây lâu năm', 'dat-trong-cay-lau-nam', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('2', 'Đất rừng phòng hộ', 'dat-rung-phong-ho', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('3', 'Đất rừng sản xuất', 'dat-rung-san-xuat', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('4', 'Đất rừng đặc dụng', 'dat-rung-dac-dung', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('5', 'Đất nuôi trồng thuỷ sản', 'dat-nuoi-trong-thuy-san', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('6', 'Đất ở gồm đất ở tại nông thôn, đất ở tại đô thị', 'dat-o-gom-dat-o-tai-nong-thon-dat-o-tai-do-thi', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('7', 'Đất xây dựng trụ sở cơ quan, xây dựng công trình sự nghiệp', 'dat-xay-dung-tru-so-co-quan-xay-dung-cong-trinh-su-nghiep', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('8', 'Đất sử dụng vào mục đích quốc phòng, an ninh', 'dat-su-dung-vao-muc-dich-quoc-phong-an-ninh', '', null, null, '1');
INSERT INTO `tbl_type_of_land` VALUES ('9', 'Đất sản xuất, kinh doanh phi nông nghiệp', 'dat-san-xuat-kinh-doanh-phi-nong-nghiep', '', null, null, '1');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identify` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organ` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joindate` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `gid` int(11) NOT NULL,
  `isroot` tinyint(4) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('12', 'igf', 'd93a5def7511da3d0f2d171d9c344e91', 'IGF', 'JSC', '0000-00-00', '', '', '', '', '', null, null, null, '0000-00-00 00:00:00', '2019-09-03 01:15:04', '1', null, '1');
INSERT INTO `tbl_user` VALUES ('16', 'admin', 'd93a5def7511da3d0f2d171d9c344e91', 'THC', 'Admin', '0000-00-00', '0', '', '123456789', '', 'a@gmail.com', null, '1111111111', '', '2019-07-23 17:13:50', '0000-00-00 00:00:00', '1', null, '1');

-- ----------------------------
-- Table structure for tbl_user_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_group`;
CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` int(11) DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `permission` int(11) NOT NULL DEFAULT '0',
  `isadmin` int(11) NOT NULL DEFAULT '0',
  `isroot` tinyint(4) DEFAULT NULL,
  `isboss` tinyint(4) DEFAULT '1',
  `isactive` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user_group
-- ----------------------------
INSERT INTO `tbl_user_group` VALUES ('1', '0', 'Super Admin', '', '8388607', '1', null, '1', '1');
INSERT INTO `tbl_user_group` VALUES ('2', '1', 'Admin', '', '6291448', '0', null, '1', '1');
INSERT INTO `tbl_user_group` VALUES ('10', '2', 'Content', '', '992', '0', null, '1', '1');
INSERT INTO `tbl_user_group` VALUES ('13', '2', 'Dangky', '', '49152', '0', null, '1', '1');

-- ----------------------------
-- Table structure for tbl_video
-- ----------------------------
DROP TABLE IF EXISTS `tbl_video`;
CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `intro` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `ishot` tinyint(4) DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `visited` int(11) DEFAULT '0',
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_video
-- ----------------------------
INSERT INTO `tbl_video` VALUES ('3', 'Sinh vi&ecirc;n đại học Đ&ocirc;ng Đ&ocirc;', 'sinh-vien-dai-hoc-dong-do', 'rUXsxIRagMo', 'https://www.youtube.com/watch?v=rUXsxIRagMo', 'https://i.ytimg.com/vi/rUXsxIRagMo/hqdefault.jpg', 'Clip nhảy Flashmob sinh vi&ecirc;n đại học Đ&ocirc;ng Đ&ocirc;', '', '0', '0', '2018-09-13 10:00:00', '2018-09-14 14:56:41', '0', '1');
INSERT INTO `tbl_video` VALUES ('4', 'Flash mob mừng kỷ niệm 26 năm quan hệ ngoại giao Việt - H&agrave;n', 'flash-mob-mung-ky-niem-26-nam-quan-he-ngoai-giao-viet-han', 's3dDUNL1VNY', 'https://www.youtube.com/watch?v=s3dDUNL1VNY', 'https://i.ytimg.com/vi/s3dDUNL1VNY/hqdefault.jpg', '150 SV Đại học Đ&ocirc;ng Đ&ocirc; đồng diễn flash mob ch&agrave;o mừng kỷ niệm 26 năm quan hệ ngoại giao Việt Nam - H&agrave;n Quốc (1992 - 2018) tại SVĐ Mỹ Đ&igrave;nh ng&agrave;y 20/1 vừa qua.', '&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &quot; helvetica=&quot;&quot; neue&quot;,=&quot;&quot; helvetica,=&quot;&quot; arial,=&quot;&quot; sans-serif;=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; background-color:=&quot;&quot; rgb(255,=&quot;&quot; 255,=&quot;&quot; 255);&quot;=&quot;&quot;&gt;150 SV Đại học Đ&ocirc;ng Đ&ocirc; đồng diễn flash mob ch&agrave;o mừng kỷ niệm 26 năm quan hệ ngoại giao Việt Nam - H&agrave;n Quốc (1992 - 2018) tại SVĐ Mỹ Đ&igrave;nh ng&agrave;y 20/1 vừa qua.&lt;/span&gt;', '0', '0', '2018-09-14 08:00:00', '2018-09-15 18:25:46', '0', '1');
INSERT INTO `tbl_video` VALUES ('5', 'Đại học Đ&ocirc;ng Đ&ocirc; tuyển sinh v&agrave; giảng dạy 2018', 'dai-hoc-dong-do-tuyen-sinh-va-giang-day-2018', 'fzcchFRp1qw', 'https://www.youtube.com/watch?v=fzcchFRp1qw', 'https://i.ytimg.com/vi/fzcchFRp1qw/hqdefault.jpg', 'Đại học Đ&ocirc;ng Đ&ocirc; tuyển sinh 20 ng&agrave;nh hệ Đại học v&agrave; 06 ng&agrave;nh hệ Thạc sĩ: Thạc sĩ Quản trị kinh doanh Thạc sĩ Quản l&yacute; c&ocirc;ng Thạc sĩ Quản l&yacute; kinh tế Thạc sĩ T&agrave;i ch&iacute;nh ng&acirc;n h&agrave;ng Thạ', '&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &quot; helvetica=&quot;&quot; neue&quot;,=&quot;&quot; helvetica,=&quot;&quot; arial,=&quot;&quot; sans-serif;=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; background-color:=&quot;&quot; rgb(255,=&quot;&quot; 255,=&quot;&quot; 255);&quot;=&quot;&quot;&gt;Đại học Đ&ocirc;ng Đ&ocirc; tuyển sinh 20 ng&agrave;nh hệ Đại học v&agrave; 06 ng&agrave;nh hệ Thạc sĩ: Thạc sĩ Quản trị kinh doanh Thạc sĩ Quản l&yacute; c&ocirc;ng Thạc sĩ Quản l&yacute; kinh tế Thạc sĩ T&agrave;i ch&iacute;nh ng&acirc;n h&agrave;ng Thạc sĩ Quản l&yacute; x&acirc;y dựng Thạc sĩ Kiến tr&uacute;c&lt;/span&gt;', '0', '0', '2018-09-14 08:28:30', '2018-09-15 18:25:40', '0', '1');
INSERT INTO `tbl_video` VALUES ('6', 'Trường Đại học Đ&ocirc;ng Đ&ocirc; x&eacute;t tuyển Học bạ v&agrave;o đại học ch&iacute;nh quy 2018', 'truong-dai-hoc-dong-do-xet-tuyen-hoc-ba-vao-dai-hoc-chinh-quy-2018', 'q1XdK2O6hLU', 'https://www.youtube.com/watch?v=q1XdK2O6hLU', 'https://i.ytimg.com/vi/q1XdK2O6hLU/hqdefault.jpg', 'Trường Đại học Đ&ocirc;ng Đ&ocirc; tuyển sinh đại học ch&iacute;nh quy năm 2018. Phương thức x&eacute;t tuyển học bạ v&agrave; x&eacute;t tuyển kết quả thi PTTH Quốc gia', '&lt;span style=&quot;font-family: arial; font-size: 14.6667px; background-color: rgb(255, 255, 255);&quot;&gt;Trường Đại học Đ&ocirc;ng Đ&ocirc; tuyển sinh đại học ch&iacute;nh quy năm 2018. Phương thức x&eacute;t tuyển học bạ v&agrave; x&eacute;t tuyển kết quả thi PTTH Quốc gia&lt;/span&gt;', '0', '0', '2018-09-14 08:31:10', '2018-09-15 18:25:33', '0', '1');
