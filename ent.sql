-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2017 at 03:07 AM
-- Server version: 5.5.42
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `imooc_app_singwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ent_admin_user`
--

CREATE TABLE `ent_admin_user` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_admin_user`
--

INSERT INTO `ent_admin_user` (`id`, `username`, `password`, `last_login_ip`, `last_login_time`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'c53d0bf8dcdbc8fbf430feb1230742d5', '0.0.0.0', 1505033935, 0, 1, 0, 1505033935),
(2, 'singwa', 'b7f39367b5d8d0f65c8e2002dae7a07a', '', 0, 0, 1, 0, 0),
(7, 'admin122', 'f5957f2d94df1be5d82fede6fcd9dc29', '', 0, 0, 1, 1501151220, 1501151220),
(9, 'admin3444', 'b64974feb747678f4d443bd75b0b47c6', '', 0, 0, 1, 1501151278, 1501151278);

-- --------------------------------------------------------

--
-- Table structure for table `ent_app_active`
--

CREATE TABLE `ent_app_active` (
  `id` int(10) unsigned NOT NULL,
  `version` int(8) unsigned NOT NULL DEFAULT '0',
  `app_type` varchar(20) NOT NULL DEFAULT '',
  `version_code` varchar(10) NOT NULL DEFAULT '',
  `did` varchar(100) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_app_active`
--

INSERT INTO `ent_app_active` (`id`, `version`, `app_type`, `version_code`, `did`, `create_time`, `update_time`) VALUES
(1, 1, 'android', '', '12345dg', 1503338102, 1503338102),
(2, 1, 'android', '', '12345dg', 1503338116, 1503338116),
(3, 1, 'android', '', '12345dg', 1503943731, 1503943731);

-- --------------------------------------------------------

--
-- Table structure for table `ent_comment`
--

CREATE TABLE `ent_comment` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `news_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content` varchar(300) NOT NULL DEFAULT '',
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论目标用户ID',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_comment`
--

INSERT INTO `ent_comment` (`id`, `user_id`, `news_id`, `content`, `to_user_id`, `create_time`, `parent_id`, `status`) VALUES
(1, 1, 7, '', 0, 1505034036, 0, 0),
(2, 1, 7, '你好', 0, 1505034066, 0, 0),
(3, 1, 7, '你好', 2, 1505034097, 0, 0),
(4, 2, 7, '我觉得文章很不错的哦。', 0, 1505034066, 0, 0),
(5, 2, 7, '我挺好的撒', 1, 1505034066, 3, 0),
(6, 1, 7, '你好', 2, 1505060320, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ent_crab`
--

CREATE TABLE `ent_crab` (
  `id` int(10) unsigned NOT NULL,
  `app_type` varchar(10) NOT NULL DEFAULT '',
  `version_code` varchar(10) NOT NULL DEFAULT '',
  `model` varchar(10) NOT NULL DEFAULT '',
  `did` varchar(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1-crash 2-卡顿 3-exception 4-anr',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `line` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ent_news`
--

CREATE TABLE `ent_news` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `small_title` varchar(20) NOT NULL DEFAULT '',
  `catid` int(8) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_position` tinyint(1) NOT NULL DEFAULT '0',
  `is_head_figure` tinyint(1) NOT NULL DEFAULT '0',
  `is_allowcomments` tinyint(1) NOT NULL DEFAULT '0',
  `listorder` int(8) NOT NULL,
  `source_type` tinyint(1) DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `read_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `upvote_count` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_news`
--

INSERT INTO `ent_news` (`id`, `title`, `small_title`, `catid`, `image`, `content`, `description`, `is_position`, `is_head_figure`, `is_allowcomments`, `listorder`, `source_type`, `create_time`, `update_time`, `status`, `read_count`, `upvote_count`, `comment_count`) VALUES
(1, 'ttst', 'ttt', 1, '', '<p>ttttttt</p>', 'ttt', 1, 0, 0, 0, 0, 1501439513, 1501634869, -1, 0, 0, 0),
(2, 'tttt', 'sst', 1, '', '<p>tt</p>', 'tt', 0, 0, 0, 0, 0, 1501439814, 1501634848, -1, 0, 0, 0),
(3, 'ttt', 'ttt', 1, 'http://otwueljs0.bkt.clouddn.com/2017/07/a055e20170731023719851.jpg', '<p>ttt</p>', 't', 0, 0, 0, 0, 0, 1501439846, 1501439846, 1, 0, 0, 0),
(4, 'tttt', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 0, 1, 1, 0, 0, 1501441709, 1501441709, 1, 0, 0, 0),
(5, '刘德华', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 0, 1, 1, 0, 0, 1501441709, 1501441709, 1, 2, 0, 0),
(6, '吴奇隆', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 0, 1, 1, 0, 0, 1501441709, 1501441709, 1, 0, 1, 0),
(7, 'singwa', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 0, 1, 1, 0, 0, 1501441709, 1501441709, 1, 0, 0, 0),
(8, '一个人的生活', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 0, 1, 1, 0, 0, 1501441709, 1501441709, 1, 0, 0, 0),
(9, '两个人的世界', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 1, 1, 1, 0, 0, 1501441709, 1502972250, 1, 0, 0, 0),
(10, 'singwa又出新课程了', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 1, 1, 1, 0, 0, 1501441709, 1502972232, 1, 0, 0, 0),
(11, 'singwa出席江西农业大学第三届大学生就业讲座', 'tt', 3, 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', 1, 1, 1, 0, 0, 1501441709, 1504460156, -1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ent_user`
--

CREATE TABLE `ent_user` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `token` varchar(100) NOT NULL DEFAULT '',
  `time_out` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(200) NOT NULL DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别0男 1女',
  `signature` varchar(200) NOT NULL DEFAULT '' COMMENT '个性签名',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_user`
--

INSERT INTO `ent_user` (`id`, `username`, `password`, `phone`, `token`, `time_out`, `image`, `sex`, `signature`, `create_time`, `update_time`, `status`) VALUES
(1, 'singwa123', '15da5b87fbda7ab1a95e471a1247abce', '18618158941', 'c040f9af9b3bd0da8090de7f6077e0ef456f9f19', 1505589024, 'http://otwueljs0.bkt.clouddn.com/2017/09/506d3201709100057331257.jpg', 1, 'singwa来了', 1504635742, 1504984224, 1),
(2, 'wali', '15da5b87fbda7ab1a95e471a1247abce', '18618158941', 'c040f9af9b3bd0da8090de7f6077e0ef456f9f19', 1505589024, 'http://otwueljs0.bkt.clouddn.com/2017/09/506d3201709100057331257.jpg', 1, 'heih 嘿嘿', 1504635742, 1504984224, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ent_user_news`
--

CREATE TABLE `ent_user_news` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `news_id` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_user_news`
--

INSERT INTO `ent_user_news` (`id`, `user_id`, `news_id`, `create_time`) VALUES
(1, 1, 5, 1505027446),
(2, 1, 4, 1505027779);

-- --------------------------------------------------------

--
-- Table structure for table `ent_version`
--

CREATE TABLE `ent_version` (
  `id` int(10) unsigned NOT NULL,
  `app_type` varchar(20) NOT NULL DEFAULT '' COMMENT 'app类型 比如 ios android',
  `version` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '内部版本号',
  `version_code` varchar(20) NOT NULL DEFAULT '' COMMENT '外部版本号比如1.2.3',
  `is_force` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否强制更新0不，1强制更新',
  `apk_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'apk最新地址',
  `upgrade_point` varchar(500) NOT NULL DEFAULT '' COMMENT '升级提示',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ent_version`
--

INSERT INTO `ent_version` (`id`, `app_type`, `version`, `version_code`, `is_force`, `apk_url`, `upgrade_point`, `status`, `create_time`, `update_time`) VALUES
(1, 'android', 2, '1.2', 0, 'x.com/1/3.html', '1、优化了网络数据\r\n2、增加新闻内容', 1, 0, 0),
(2, 'android', 3, '2.1', 0, 'b.com/1/3.html', '1、优化了网络数据\r\n', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ent_admin_user`
--
ALTER TABLE `ent_admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `create_time` (`create_time`);

--
-- Indexes for table `ent_app_active`
--
ALTER TABLE `ent_app_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_comment`
--
ALTER TABLE `ent_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `ent_crab`
--
ALTER TABLE `ent_crab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_news`
--
ALTER TABLE `ent_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `create_time` (`create_time`);

--
-- Indexes for table `ent_user`
--
ALTER TABLE `ent_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `token` (`token`);

--
-- Indexes for table `ent_user_news`
--
ALTER TABLE `ent_user_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ent_version`
--
ALTER TABLE `ent_version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ent_admin_user`
--
ALTER TABLE `ent_admin_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ent_app_active`
--
ALTER TABLE `ent_app_active`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ent_comment`
--
ALTER TABLE `ent_comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ent_crab`
--
ALTER TABLE `ent_crab`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ent_news`
--
ALTER TABLE `ent_news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ent_user`
--
ALTER TABLE `ent_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ent_user_news`
--
ALTER TABLE `ent_user_news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ent_version`
--
ALTER TABLE `ent_version`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;