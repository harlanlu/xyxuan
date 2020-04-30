-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-04-30 22:02:30
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `sheying`
--

-- --------------------------------------------------------

--
-- 表的结构 `sy_apply_identify`
--

CREATE TABLE `sy_apply_identify` (
  `id` int(8) NOT NULL,
  `utitle` varchar(222) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `user_id` int(4) NOT NULL COMMENT '用户id',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '用户申请的内容',
  `status` int(4) NOT NULL DEFAULT '0' COMMENT '1同意，-1拒绝，0默认',
  `dotime` int(8) NOT NULL DEFAULT '-1' COMMENT '管理员操作时间',
  `msg` varchar(222) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理员回复信息',
  `write_time` int(8) DEFAULT '1583313336' COMMENT '申请时间',
  `reply_time` int(8) DEFAULT '-1' COMMENT '管理员回复时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户申请身份验证';

--
-- 转存表中的数据 `sy_apply_identify`
--

INSERT INTO `sy_apply_identify` (`id`, `utitle`, `user_id`, `content`, `status`, `dotime`, `msg`, `write_time`, `reply_time`) VALUES
(2, '申请成为摄影师', 1, '申请成为摄影师', -1, 1586761536, '123', 1583313336, -1),
(4, '申请成为摄影师', 1, '申请成为摄影师', -1, 1587174455, '123', 1583313336, -1),
(5, '申请成为摄影师', 1, '申请成为摄影师', 1, 1586761117, NULL, 1583313336, -1),
(6, '申请成为摄影师', 1, '<p>申请成为摄影师</p><p><img src=\"/ueditor/upload/image/20200413/1586773353301208.jpg\" title=\"1586773353301208.jpg\" alt=\"GUSMDS.jpg\" width=\"306\" height=\"288\"/></p>', 0, -1, NULL, 1583313336, -1);

-- --------------------------------------------------------

--
-- 表的结构 `sy_buy_art`
--

CREATE TABLE `sy_buy_art` (
  `id` int(8) NOT NULL,
  `zuozhe` int(6) NOT NULL COMMENT '作者id',
  `art` int(6) NOT NULL COMMENT '作品id',
  `buyer` int(6) NOT NULL COMMENT '购买者id',
  `status` int(4) NOT NULL COMMENT '状态1收入0支出',
  `jifen` int(6) NOT NULL COMMENT '积分',
  `dotime` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sy_buy_art`
--

INSERT INTO `sy_buy_art` (`id`, `zuozhe`, `art`, `buyer`, `status`, `jifen`, `dotime`) VALUES
(1, 1, 15, 2, 0, 0, 1587480601),
(2, 1, 15, 2, 1, 0, 1587480601),
(3, 2, 9, 1, 0, 0, 1587514847),
(4, 2, 9, 1, 1, 0, 1587514847),
(5, 1, 6, 5, 0, 1, 1587905367),
(6, 1, 6, 5, 1, 1, 1587905367);

-- --------------------------------------------------------

--
-- 表的结构 `sy_buy_jifen`
--

CREATE TABLE `sy_buy_jifen` (
  `id` int(8) NOT NULL,
  `user_id` int(6) NOT NULL COMMENT '用户id',
  `jifen` int(6) NOT NULL COMMENT '多少积分',
  `dotime` int(6) DEFAULT '1586761536' COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sy_buy_jifen`
--

INSERT INTO `sy_buy_jifen` (`id`, `user_id`, `jifen`, `dotime`) VALUES
(1, 1, 11, 1586761536),
(2, 1, 3, 1587215713),
(3, 1, 0, 1587215790),
(4, 1, 1, 1587215803),
(5, 1, 1, 1587215814),
(6, 1, 1, 1587215817),
(7, 1, 1, 1587215819),
(8, 1, 1, 1587266110),
(9, 1, 1, 1587266116),
(10, 1, 6, 1587266120),
(11, 1, 1, 1587266230),
(12, 1, 1, 1587266231),
(13, 1, 1, 1587266233),
(14, 1, 1, 1587266234),
(15, 1, 1, 1587266235),
(16, 1, 1, 1587266235),
(17, 1, 1, 1587266236),
(18, 1, 1, 1587266237),
(19, 1, 1, 1587266238),
(20, 3, 1, 1587281030),
(21, 3, 1, 1587281034),
(22, 3, 1, 1587281121),
(23, 3, 1, 1587281123),
(24, 3, 1, 1587281126),
(25, 3, 12, 1587281399),
(26, 3, 100, 1587281405),
(27, 1, 1, 1587551722),
(28, 5, 1, 1587906866);

-- --------------------------------------------------------

--
-- 表的结构 `sy_member`
--

CREATE TABLE `sy_member` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `active_code` varchar(64) DEFAULT NULL,
  `email_time` int(4) DEFAULT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `sex` int(1) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `hits_comment` int(11) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  `ident` int(11) DEFAULT '0' COMMENT '认证情况',
  `vip` int(11) DEFAULT '0',
  `hitsfans` int(11) DEFAULT '0',
  `hitsfollows` int(11) DEFAULT '0',
  `hitsthreads` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='前台会员';

--
-- 转存表中的数据 `sy_member`
--

INSERT INTO `sy_member` (`id`, `email`, `active_code`, `email_time`, `nickname`, `password`, `avatar`, `sex`, `create_time`, `update_time`, `delete_time`, `signature`, `city`, `hits_comment`, `points`, `ident`, `vip`, `hitsfans`, `hitsfollows`, `hitsthreads`, `status`) VALUES
(1, '123@163.com', NULL, 1583313336, '这是一个名字', '2abc200a8e52922386b0b004b5917d72', 'avatar/1583984342.png', 0, 1581856355, 1583979658, NULL, '', '', 0, 83, 1, 5, 2, 0, 0, 0),
(2, '2141204897@qq.com', '827789dbad3a14bc2478a53b101ea08c', 1587170440, '取名字好难啊', '2abc200a8e52922386b0b004b5917d72', 'avatar/1584279547.png', 0, 1583929266, 1585144784, NULL, '这是一段签名', 'China', 0, 25, 1, 5, 0, 1, 0, 1),
(3, 'test@163.com', NULL, NULL, '测试', '2abc200a8e52922386b0b004b5917d72', 'avatar/1584249643.png', 1, 1584090879, 1584158397, NULL, '', '', 0, 218, 1, 2, 0, 0, 0, 0),
(5, '1234@163.com', '2d8bdafe53913c9b', NULL, '1234', '2abc200a8e52922386b0b004b5917d72', NULL, 0, 1585570111, 1585570111, NULL, NULL, NULL, 0, 999, 0, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sy_member_follow`
--

CREATE TABLE `sy_member_follow` (
  `id` int(11) NOT NULL COMMENT 'id',
  `follow_who` int(11) NOT NULL COMMENT '关注谁',
  `who_follow` int(11) NOT NULL COMMENT '谁关注',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注表';

--
-- 转存表中的数据 `sy_member_follow`
--

INSERT INTO `sy_member_follow` (`id`, `follow_who`, `who_follow`, `create_time`) VALUES
(17, 1, 2, 1585232749);

-- --------------------------------------------------------

--
-- 表的结构 `sy_member_ident`
--

CREATE TABLE `sy_member_ident` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `identification` varchar(55) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_member_ident`
--

INSERT INTO `sy_member_ident` (`id`, `member_id`, `identification`, `update_time`) VALUES
(1, 2, '哈哈哈', 1583991556),
(3, 3, '测试', 1584152987),
(4, 1, '123', 1586746609);

-- --------------------------------------------------------

--
-- 表的结构 `sy_member_sign`
--

CREATE TABLE `sy_member_sign` (
  `id` int(11) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `points` int(6) NOT NULL COMMENT '签到积分',
  `num` int(8) NOT NULL DEFAULT '0' COMMENT '连续签到次数',
  `sign_time` int(10) NOT NULL COMMENT '签到时间',
  `create_time` int(10) NOT NULL,
  `sign_ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sy_member_sign`
--

INSERT INTO `sy_member_sign` (`id`, `member_id`, `points`, `num`, `sign_time`, `create_time`, `sign_ip`) VALUES
(1, 1, 5, 1, 1583942400, 1583992115, '127.0.0.1'),
(2, 3, 5, 1, 1584028800, 1584105511, '127.0.0.1'),
(3, 2, 5, 1, 1584288000, 1584328994, '127.0.0.1'),
(4, 1, 5, 1, 1584547200, 1584606511, '127.0.0.1'),
(5, 1, 5, 2, 1584633600, 1584684739, '127.0.0.1'),
(6, 2, 5, 1, 1585238400, 1585311887, '127.0.0.1'),
(7, 1, 5, 1, 1587052800, 1587117054, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `sy_member_wish_thread`
--

CREATE TABLE `sy_member_wish_thread` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sy_message`
--

CREATE TABLE `sy_message` (
  `id` int(11) NOT NULL,
  `send_id` int(11) DEFAULT '0',
  `recv_id` int(11) DEFAULT '0' COMMENT '如果是0，则发给所有人',
  `message_id` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0' COMMENT '0未读，1读了'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sy_message`
--

INSERT INTO `sy_message` (`id`, `send_id`, `recv_id`, `message_id`, `status`) VALUES
(2, 1, 2, 2, 1),
(4, 1, 2, 4, 1),
(5, 1, 2, 5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sy_message_text`
--

CREATE TABLE `sy_message_text` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` text,
  `create_time` int(10) DEFAULT NULL COMMENT '站内信发送的时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sy_message_text`
--

INSERT INTO `sy_message_text` (`id`, `title`, `message`, `create_time`) VALUES
(2, '', '关注了你', 1583991595),
(4, '', '123', 1584604559),
(5, '', '关注了你', 1587118281);

-- --------------------------------------------------------

--
-- 表的结构 `sy_nav`
--

CREATE TABLE `sy_nav` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `expire_time` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_nav`
--

INSERT INTO `sy_nav` (`id`, `pid`, `title`, `content`, `image`, `create_time`, `update_time`, `listorder`, `cid`, `href`, `target`, `icon`, `description`, `expire_time`) VALUES
(40, 0, '百度一下', 'content', 'image/2020-03-16/5e6f241643b1f.jpg', 1585575133, 1585575133, 0, 3, 'http://www.baidu.com', '_blank', 'q', '21q', '2020-03-28'),
(46, NULL, '百度', NULL, 'image/2020-03-16/5e6f49f070868.jpg', 1585575124, 1585575124, NULL, 3, 'http://www.baidu.com', '_self', '', '', '2020-03-27');

-- --------------------------------------------------------

--
-- 表的结构 `sy_nav_cat`
--

CREATE TABLE `sy_nav_cat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  `alias` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_nav_cat`
--

INSERT INTO `sy_nav_cat` (`id`, `title`, `listorder`, `alias`) VALUES
(3, '友情链接', 0, 'friend_links'),
(5, '温馨通道', 3, 'quick');

-- --------------------------------------------------------

--
-- 表的结构 `sy_pinyin`
--

CREATE TABLE `sy_pinyin` (
  `py` char(1) NOT NULL,
  `begin` smallint(5) UNSIGNED NOT NULL,
  `end` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sy_pinyin`
--

INSERT INTO `sy_pinyin` (`py`, `begin`, `end`) VALUES
('A', 45217, 45252),
('B', 45253, 45760),
('C', 45761, 46317),
('D', 46318, 46825),
('E', 46826, 47009),
('F', 47010, 47296),
('G', 47297, 47613),
('H', 47614, 48118),
('J', 48119, 49061),
('K', 49062, 49323),
('L', 49324, 49895),
('M', 49896, 50370),
('N', 50371, 50613),
('O', 50614, 50621),
('P', 50622, 50905),
('Q', 50906, 51386),
('R', 51387, 51445),
('S', 51446, 52217),
('T', 52218, 52697),
('W', 52698, 52979),
('X', 52980, 53640),
('Y', 53689, 54480),
('Z', 54481, 55289);

-- --------------------------------------------------------

--
-- 表的结构 `sy_system_route`
--

CREATE TABLE `sy_system_route` (
  `id` int(11) NOT NULL COMMENT '主键',
  `full_url` varchar(255) NOT NULL COMMENT '完整url， 如：portal/list/index?id=1',
  `url` varchar(255) NOT NULL COMMENT '实际显示的url',
  `listorder` int(5) NOT NULL DEFAULT '0' COMMENT '排序--优先级，越小优先级越高',
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='URL路由';

-- --------------------------------------------------------

--
-- 表的结构 `sy_system_user`
--

CREATE TABLE `sy_system_user` (
  `id` int(11) NOT NULL,
  `account` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `nickname` varchar(55) NOT NULL,
  `sex` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='后台用户';

--
-- 转存表中的数据 `sy_system_user`
--

INSERT INTO `sy_system_user` (`id`, `account`, `password`, `nickname`, `sex`, `create_time`, `update_time`) VALUES
(1, 'superadmin', '2abc200a8e52922386b0b004b5917d72', '超级管理员', 1, 1558924947, 1558924947);

-- --------------------------------------------------------

--
-- 表的结构 `sy_test`
--

CREATE TABLE `sy_test` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_test`
--

INSERT INTO `sy_test` (`id`, `title`) VALUES
(1, 'aa'),
(2, 'bb'),
(3, 'cc');

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread`
--

CREATE TABLE `sy_thread` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `thumb` varchar(222) DEFAULT '/uploads/artpic/img-6.jpeg',
  `isbanner` int(4) NOT NULL DEFAULT '0' COMMENT '是否为欢迎页轮播1是',
  `banner_des` text COMMENT '幻灯片描述',
  `recommend` int(11) NOT NULL DEFAULT '0' COMMENT '推荐首页轮播1是',
  `content` text NOT NULL,
  `lianjie` varchar(255) DEFAULT NULL COMMENT '作品真实下载链接',
  `cp_id` int(6) NOT NULL DEFAULT '0' COMMENT '父子分类的父类',
  `pid` int(4) NOT NULL DEFAULT '112' COMMENT '栏目父类',
  `cid` int(11) NOT NULL COMMENT '所属栏目',
  `jifen` int(6) NOT NULL DEFAULT '0' COMMENT '作品-获得积分',
  `points` int(11) NOT NULL DEFAULT '0' COMMENT '悬赏积分',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态 1精华',
  `top` int(11) NOT NULL DEFAULT '0' COMMENT '置顶',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `hits_zan` int(11) DEFAULT '0',
  `hits_comment` int(11) DEFAULT '0',
  `hits_wish` int(11) DEFAULT '0',
  `hits` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='帖子';

--
-- 转存表中的数据 `sy_thread`
--

INSERT INTO `sy_thread` (`id`, `title`, `thumb`, `isbanner`, `banner_des`, `recommend`, `content`, `lianjie`, `cp_id`, `pid`, `cid`, `jifen`, `points`, `status`, `top`, `create_time`, `update_time`, `delete_time`, `member_id`, `hits_zan`, `hits_comment`, `hits_wish`, `hits`) VALUES
(1, '布拉格', '/uploads/artpic/1587474532.jpeg', 1, '布拉格', 0, '布拉格\nimg[/uploads/images/20200421\\35c72fa0697404dc9fc95fb101b1cd19.jpg]', 'https://cdn.pixabay.com/photo/2016/01/29/16/57/prague-1168302_1280.jpg', 12, 12, 28, 1, 0, 0, 0, 1587474578, 1587474578, NULL, 1, 0, 0, 0, 1),
(2, '克里斯汀堡', '/uploads/artpic/1587476877.jpeg', 1, '克里斯汀堡', 0, '克里斯汀堡\nimg[/uploads/images/20200421\\7e2a8ff4a0fc00435910486302a268a4.jpg]', 'https://cdn.pixabay.com/photo/2018/01/21/01/46/architecture-3095716_1280.jpg', 12, 12, 28, 0, 0, 0, 0, 1587476889, 1587476889, NULL, 1, 0, 0, 0, 1),
(3, '帕台农神庙', '/uploads/artpic/1587476996.jpeg', 1, '帕台农神庙', 0, '帕台农神庙\nimg[/uploads/images/20200421\\671e68a103742433863cda7d5768ac3e.jpg]', 'https://cdn.pixabay.com/photo/2016/08/15/08/22/greece-1594689_1280.jpg', 12, 12, 28, 10, 0, 0, 0, 1587477009, 1587477009, NULL, 1, 0, 0, 0, 0),
(4, '城市的灯光', '/uploads/artpic/1587477137.jpeg', 1, '城市的灯光', 0, '城市的灯光\nimg[/uploads/images/20200421\\d109bb3ca88e3eeba8ad4e6292f296d7.jpg]', 'https://cdn.pixabay.com/photo/2013/12/09/09/18/sydney-225571_1280.jpg', 12, 12, 36, 4, 0, 0, 0, 1587477151, 1587477151, NULL, 1, 0, 0, 0, 0),
(5, '上海外滩夜景', '/uploads/artpic/1587477287.jpeg', 1, '上海外滩夜景', 1, '上海外滩夜景\nimg[/uploads/images/20200421\\306e45f2b81e4dae7e7c06274a388afe.jpg]', 'https://cdn.pixabay.com/photo/2016/02/21/03/58/shanghai-bund-night-1213148_1280.jpg', 12, 12, 36, 0, 0, 0, 0, 1587477297, 1587477297, NULL, 1, 0, 0, 0, 2),
(6, '野生花卉', '/uploads/artpic/1587477457.jpeg', 1, '野生花卉', 1, '野生花卉\nimg[/uploads/images/20200421\\fc0d1e272edad5911256845a08b08796.jpg]', 'https://cdn.pixabay.com/photo/2018/07/29/21/32/wildflowers-3571119_1280.jpg', 12, 12, 27, 1, 0, 0, 0, 1587477479, 1587477479, NULL, 1, 0, 2, 0, 8),
(7, '人物写真', '/uploads/artpic/1587477730.jpeg', 1, '人物写真', 1, '人物写真\nimg[/uploads/images/20200421\\47705bdf55e12a2516ef6ff259476ec0.jpg]', 'https://cdn.pixabay.com/photo/2017/04/01/16/40/photo-2194032_1280.jpg', 12, 12, 39, 0, 0, 0, 0, 1587477739, 1587477739, NULL, 2, 0, 0, 0, 0),
(8, '宠物写真', '/uploads/artpic/1587477855.jpeg', 1, '宠物写真', 1, '宠物写真\nimg[/uploads/images/20200421\\74b4c16886e6514d0eafeee48e204402.jpg]', 'https://cdn.pixabay.com/photo/2017/05/16/20/17/dog-2318787_1280.jpg', 12, 12, 39, 0, 0, 0, 0, 1587477860, 1587477860, NULL, 2, 0, 0, 0, 3),
(9, '形象照-1', '/uploads/artpic/1587478134.jpeg', 0, '形象照-1', 0, '形象照-1\nimg[/uploads/images/20200421\\4f788788a8d7923046320bd7bd695c33.jpg]', 'https://cdn.haimati.cn/himo/372bf964dd84aa4973e604af685be7f7', 13, 13, 37, 0, 0, 0, 0, 1587478148, 1587478148, NULL, 2, 0, 0, 0, 1),
(10, '形象照-2', '/uploads/artpic/1587479946.jpeg', 0, '形象照-2', 0, '形象照-2\nimg[/uploads/images/20200421\\304dec10a3a00574d2b0a01db8f59cbd.jpg]', '', 13, 13, 37, 0, 0, 0, 0, 1587479951, 1587479951, NULL, 1, 0, 0, 0, 0),
(11, '证件照-1', '/uploads/artpic/1587480024.jpeg', 0, '证件照-1', 0, '证件照-1\nimg[/uploads/images/20200421\\177cb6103b7c038416085989acd1a790.jpg]', '', 13, 13, 38, 0, 0, 0, 0, 1587480028, 1587480028, NULL, 1, 0, 0, 0, 1),
(12, '证件照-2', '/uploads/artpic/1587480091.jpeg', 0, '证件照-2', 0, '证件照-2\nimg[/uploads/images/20200421\\4730733f468a5ca832e3d885c6dfaa3c.jpg]', '', 13, 13, 38, 0, 0, 0, 0, 1587480095, 1587480095, NULL, 1, 0, 0, 0, 0),
(13, '证件照-3', '/uploads/artpic/1587480169.jpeg', 0, '证件照', 0, '证件照-3\nimg[/uploads/images/20200421\\5f218e9cee1f324867c23ccdcc79a3c1.jpg]', '', 13, 13, 38, 0, 0, 0, 0, 1587480182, 1587480182, NULL, 1, 0, 0, 0, 0),
(14, '圣诞-单人', '/uploads/artpic/1587480287.jpeg', 0, '圣诞', 0, '圣诞-单人\nimg[/uploads/images/20200421\\3a6cbf06fd57212bf04392f3f564d195.jpg]', 'https://cdn.haimati.cn/erp2/%E5%A4%A7%E5%B8%88-%E5%9C%A3%E8%AF%9E-%E5%8D%95%E4%BA%BA-5.jpg', 13, 13, 42, 1, 0, 0, 0, 1587480308, 1587480308, NULL, 2, 0, 0, 0, 0),
(15, '圣诞合集', '/uploads/artpic/1587480372.jpeg', 0, '圣诞~~~', 0, '圣诞合集\nimg[/uploads/images/20200421\\cdbd2cf873958c127c149b7dabcbd296.jpg]', 'https://cdn.haimati.cn/erp2/%E5%A4%A7%E5%B8%88-%E5%9C%A3%E8%AF%9E-%E5%8D%95%E4%BA%BA-8.jpg', 13, 13, 42, 0, 0, 0, 0, 1587480382, 1587480382, NULL, 1, 0, 0, 0, 1),
(16, '美国签证', '/uploads/artpic/1587480454.jpeg', 0, '美国签证50x50', 0, 'img[/uploads/images/20200421\\8684e897dcd58ad2c6bfeb463f8072bf.jpg]', '', 13, 13, 41, 0, 0, 0, 0, 1587480485, 1587480485, NULL, 1, 0, 0, 0, 2),
(17, '新加坡签证', '/uploads/artpic/1587480544.jpeg', 0, '新加坡签证35x45', 0, 'img[/uploads/images/20200421\\0dd2d0e44fd9343b9e0ac8b2c7023f08.jpg]', '', 13, 13, 41, 0, 0, 0, 0, 1587480553, 1587480553, NULL, 2, 0, 0, 0, 1),
(18, '轻写真 - 无封面图片', '/uploads/thumb.png', 0, '无封面图片', 0, 'img[/uploads/images/20200421\\d77ec368ec80d652c2d396f4b6d42121.jpg]', '', 13, 13, 39, 0, 0, 0, 0, 1587481002, 1587481002, NULL, 2, 0, 0, 0, 0),
(19, '海', '/uploads/artpic/1587512704.jpeg', 0, '海~', 0, 'img[/uploads/images/20200422\\d1344d17a951518ec5484e7797021937.jpg]', 'https://cdn.pixabay.com/photo/2017/09/10/06/26/aerial-2734510_1280.jpg', 43, 43, 46, 1, 0, 0, 0, 1587512716, 1587512716, NULL, 3, 0, 0, 0, 1),
(20, '森林', '/uploads/artpic/1587513341.jpeg', 0, '绿色森林', 0, 'img[/uploads/images/20200422\\0d88f0b330e54e220d3e7e7d623d942e.jpg]', 'https://images.pexels.com/photos/3573351/pexels-photo-3573351.png?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 43, 43, 46, 2, 0, 0, 0, 1587513357, 1587513357, NULL, 3, 0, 0, 0, 0),
(21, '云', '/uploads/artpic/1587513521.jpeg', 0, '云~', 0, 'img[/uploads/images/20200422\\9b52a67d66848adcc0dda7ec7f699fd6.jpg]', 'https://images.pexels.com/photos/2652986/pexels-photo-2652986.jpeg', 43, 43, 46, 1, 0, 0, 0, 1587513547, 1587513547, NULL, 1, 0, 0, 0, 2),
(22, '桥', '/uploads/artpic/1587513667.jpeg', 0, '这是一座桥', 0, 'img[/uploads/images/20200422\\ed36388a915d526c08c2632950e995dc.jpg]', 'https://images.pexels.com/photos/3609211/pexels-photo-3609211.jpeg', 43, 43, 46, 6, 0, 0, 0, 1587513669, 1587513669, NULL, 1, 0, 0, 0, 0),
(23, '星流迹', '/uploads/artpic/1587513921.jpeg', 0, '星流迹~', 0, 'img[/uploads/images/20200422\\a1bba0a096609555254e8751498222f6.jpg]', 'https://cdn.pixabay.com/photo/2015/07/02/10/14/star-trails-828656_1280.jpg', 43, 43, 44, 12, 0, 0, 0, 1587513935, 1587513935, NULL, 2, 0, 0, 0, 1),
(24, '月', '/uploads/artpic/1587514055.jpeg', 0, '月亮', 0, 'img[/uploads/images/20200422\\38c4fa771ebfbbf6a3ffe11ca2f50c15.jpg]', 'https://cdn.pixabay.com/photo/2015/09/02/12/58/crescent-918793_1280.jpg', 43, 43, 44, 100, 0, 0, 0, 1587514075, 1587514075, NULL, 3, 0, 0, 0, 0),
(25, '银河', '/uploads/artpic/1587514294.jpeg', 0, '银河星云', 0, 'img[/uploads/images/20200422\\99181da44e8b6de2e7cabd215fbe1cc2.jpg]', 'https://cdn.pixabay.com/photo/2016/09/21/06/58/milky-way-1684226_1280.jpg', 43, 43, 44, 0, 0, 0, 0, 1587514341, 1587514341, NULL, 2, 0, 0, 0, 0),
(26, '珊瑚', '/uploads/artpic/1587514565.jpeg', 0, '珊瑚~', 0, 'img[/uploads/images/20200422\\2eec46db2e5adf48f9f9922ae5ed8f3f.jpg]', 'https://cdn.pixabay.com/photo/2018/02/12/16/35/underwater-3148688_1280.jpg', 43, 43, 45, 100, 0, 0, 0, 1587514578, 1587514578, NULL, 2, 0, 0, 0, 0),
(27, '鱼群', '/uploads/artpic/1587514672.jpeg', 0, '鱼', 0, 'img[/uploads/images/20200422\\a73ebeb7c0172b95295e2abeaaaa368a.jpg]', 'https://cdn.pixabay.com/photo/2017/07/23/16/51/swarm-2531887_1280.jpg', 43, 43, 45, 4, 0, 0, 0, 1587514679, 1587514679, NULL, 2, 0, 0, 0, 0),
(28, '水下模特', '/uploads/artpic/1587514799.jpeg', 0, '水下模特~', 0, 'img[/uploads/images/20200422\\887454909d9b2fd2ea3cb670d82d183d.jpg]', 'https://cdn.pixabay.com/photo/2017/05/27/17/56/underwater-2349065_1280.jpg', 43, 43, 45, 0, 0, 0, 0, 1587514803, 1587514803, NULL, 1, 0, 0, 0, 1),
(29, '水下植物', '/uploads/artpic/1587515011.jpeg', 0, '水下植物', 0, 'img[/uploads/images/20200422\\1f8dea686dbb06919c4540556aafcd83.jpg] \n\nimg[/uploads/images/20200422\\31f91c6e98d303601bf16f86179f4e3c.jpg]\n\nimg[/uploads/images/20200422\\7923e87e6716dce9604d9f1dc187c21c.jpg]', 'https://cdn.pixabay.com/photo/2016/07/19/23/08/underwater-1529206_1280.jpg\nhttps://cdn.pixabay.com/photo/2016/07/19/23/08/underwater-1529207_1280.jpg\nhttps://cdn.pixabay.com/photo/2016/07/19/23/09/underwater-1529213_1280.jpg', 43, 43, 45, 1, 0, 0, 0, 1587515640, 1587515640, NULL, 2, 0, 1, 0, 7),
(30, '水母', '/uploads/artpic/1587517113.jpeg', 0, '水母~', 0, 'img[/uploads/images/20200422\\48c11eb9ddd0c73c3393901d22c0123f.jpg] \n\nimg[/uploads/images/20200422\\e647ef59b19b04cbec4fbf0f600a8732.jpg]', 'https://cdn.pixabay.com/photo/2016/04/27/12/14/vancouver-aquarium-1356489_960_720.jpg\nhttps://cdn.pixabay.com/photo/2019/06/10/10/11/blub-4263837_960_720.jpg', 43, 43, 45, 2, 0, 0, 0, 1587517163, 1587517163, NULL, 1, 0, 0, 0, 1),
(31, '花和桥', '/uploads/artpic/1587517309.jpeg', 0, '花和桥~~', 0, 'img[/uploads/images/20200422\\f1bdfdf2add69937a363f94575707147.jpeg]', '', 16, 0, 16, 0, 0, 0, 0, 1587517317, 1587517317, NULL, 1, 0, 0, 0, 0),
(32, '山', '/uploads/artpic/1587517380.jpeg', 0, '山和树', 0, 'img[/uploads/images/20200422\\123d38a3182f6d19a0a619719c9e793c.jpeg]', '', 16, 0, 16, 0, 0, 0, 0, 1587517385, 1587517385, NULL, 1, 0, 0, 0, 0),
(33, '大房子', '/uploads/artpic/1587517464.jpeg', 0, '大房子', 0, 'img[/uploads/images/20200422\\5a507e5bc8c4ab95ae86e7aababf33b5.jpeg]', '', 12, 12, 28, 0, 0, 0, 0, 1587517469, 1587517469, NULL, 2, 0, 0, 0, 0),
(34, '香港夜景', '/uploads/artpic/1587517524.jpeg', 0, '香港夜景~~~', 0, 'img[/uploads/images/20200422\\81801702b1f037daa93f2bbe51db30b5.jpeg]', '', 12, 12, 36, 0, 0, 0, 0, 1587517529, 1587517529, NULL, 2, 0, 0, 0, 1),
(35, '悉尼歌剧院', '/uploads/artpic/1587518122.jpeg', 0, '悉尼歌剧院夜景', 0, 'img[/uploads/images/20200422\\732005e15154b63533f06f03cfe4a0b7.jpeg]', '', 12, 12, 36, 0, 0, 0, 0, 1587518126, 1587518126, NULL, 2, 0, 0, 0, 1),
(36, '卢浮宫', '/uploads/artpic/1587518278.jpeg', 0, '卢浮宫夜景', 0, 'img[/uploads/images/20200422\\a0206cac228621f74c0becc519b69e7a.jpeg]', '', 12, 12, 36, 0, 0, 0, 0, 1587518326, 1587518326, NULL, 2, 0, 0, 0, 0),
(37, '日出', '/uploads/artpic/1587518467.jpeg', 0, '日出湖面', 0, 'img[/uploads/images/20200422\\3ee587b8de8c50c81b5d8024c7cbd214.jpg]', 'https://cdn.pixabay.com/photo/2017/01/19/23/46/panorama-1993645_1280.jpg', 12, 12, 27, 3, 0, 0, 0, 1587518473, 1587518473, NULL, 1, 0, 1, 0, 8),
(38, '人像摄影：再次纠结于尼康D3100和索尼alpha7的抉择', '/uploads/thumb.png', 0, '我有一个D3100，配上那个700多块钱的人精镜头，操作比较熟悉。然后公司年会走了狗屎运，中了一个sony alpha7微单。', 0, '各位同学好：\n\n    我有一个D3100，配上那个700多块钱的人精镜头，操作比较熟悉。然后公司年会走了狗屎运，中了一个sony alpha7微单。\n\n    我想问问，如果我想进行人像摄影，就是搭摄影棚，背景白色，然后找个模特摆拍，这样的需求下，用哪个设备号呢？\n因为D3100是老机子了，当时也就3000多买的，sony alpha7是2018年初得到的，比较新。\n\n    之前发了个贴，问了下，如果两个都不合适，可以推荐一个二手机子。本来小弟以为，各位大佬会从D3100和sony alpha7里让我选一个，\n可是，没想到各位大佬都是一致认为让我把两个旧自己都卖了，买个二手机子（D750,D800），都把我搞懵了。为啥让我买新机子，我都不知道为啥啊。。。。。。。\n\n     如果我不买二手机子，一定要从D3100和sony alpha7里选一个，选哪个好呢？（好吧，我是小学生，我只能选一个，没法全都要，嘿嘿。）\n     或者，哪位好心人明白他们为啥让我把两个旧机子都出了，买新机子，也可以跟我说下原因，谢谢！\n\n     我现在处于很懵的状态。。。。。。。', '', 17, 17, 34, 0, 0, 0, 0, 1587518713, 1587518713, NULL, 5, 0, 0, 0, 0),
(39, '色差問題如何解決', '/uploads/thumb.png', 0, '大侠好, 我是摄影小白， 主要做亚马逊產品拍攝，用的相机是佳能700D入门单反，镜头是18-135镜头，用的兩個普通130W柔光燈，一個在上方，一個在左側，底部是無影燈，左側對面有反光板。', 0, '大侠好, 我是摄影小白， 主要做亚马逊產品拍攝，用的相机是佳能700D入门单反，镜头是18-135镜头，用的兩個普通130W柔光燈，一個在上方，一個在左側，底部是無影燈，左側對面有反光板。\n\n一直有一个问题困扰我们， 比如粉紅，金色，銀色等等，我们的色差非常严重，不管我们怎么调整光圈快门ISO，灰卡自定義白平衡，都無法跟實圖顏色一樣。\n\n\n請問是需要購入閃光燈嗎，還是佈光或其他問題呢？\n\n另外，看了一些文章說無反比單反好，成像，鏡頭轉換，對焦，防抖等都要好，你們覺得呢？索尼a7 拍產品怎麼樣？謝謝各位大神多多指教！\n\nimg[/uploads/images/20200422\\0634ebe28d28e39bcd65ca90ecb58aef.jpg]', '', 17, 17, 34, 0, 0, 0, 0, 1587518808, 1587518808, NULL, 2, 0, 0, 0, 1),
(40, '镜头器材避坑提醒', '/uploads/thumb.png', 0, '镜头器材避坑提醒', 0, '买了35mm 1.4和60mm微距两支镜头，打算好好支持一下国产品牌，经过一年的使用，非常失望。镜头成像还算过得去，但是品控及做工让人失望。\n35mm 1.4镜头在使用只几个月，USB接口处即出现裂缝并不断扩大，可见其设计或用料存在问题\n\nimg[/uploads/images/20200422\\b349bcab293446a212678f4fb7637d33.jpg] \n[pre]\n相机品牌：佳能(Canon) / Canon 相机型号：佳能 50D / Canon EOS 50D \n光圈：f/3.2 曝光时间：1/80 ISO：640 焦距：60.0 \n拍摄时间：2020-03-26 14:23:03\n镜头型号：Canon YN60mm f/2.0 MF\n[/pre]\n\nimg[/uploads/images/20200422\\8177ce4cb044db5dc9a5c0f4b196b7a3.jpg]\n[pre]\n相机品牌：佳能(Canon) / Canon 相机型号：佳能 50D / Canon EOS 50D \n光圈：f/3.2 曝光时间：1/80 ISO：640 焦距：60.0 \n拍摄时间：2020-03-26 14:24:15\n镜头型号：Canon YN60mm f/2.0 MF\n[/pre]', '', 17, 17, 47, 0, 0, 0, 0, 1587519038, 1587519038, NULL, 2, 0, 0, 0, 4),
(41, '一套穷人的莱卡，德国爱克发镜头', '/uploads/thumb.png', 0, '一套穷人的莱卡，德国爱克发镜头~~~', 0, '这是德国爱克发公司在1953年为其旁轴相机制造的一套镜头，共四只35mmf/4，50mmf/2.8，90mmf/4及130mmf/4。做工非常精致，基本都是铜质，重量十足，对焦行程适中，像距37mm，在无反相机上可以转接。成像还可以，特别是35这只在远景和中景成像不俗，近拍是短板，最近对焦一米左右，拍小花小草就比较难了。下面的图片全部是35㎜f/4所拍。谢谢朋友们指点观赏。\nimg[/uploads/images/20200422\\7e21092437664bb9e95aa62c9daf2197.jpg] \n[pre]\n相机品牌：索尼(Sony) / SONY 相机型号：NEX-5 光圈： 曝光时间： ISO： 焦距：NaN 拍摄时间：无\n[/pre]', '', 17, 17, 47, 0, 0, 0, 0, 1587519501, 1587519501, NULL, 2, 0, 1, 0, 2),
(42, 'VR全景入门拍摄', '/uploads/thumb.png', 0, 'VR全景入门拍摄--全境拍摄的感光度设置', 0, '什么是感光度？为什么每次在拍照前，都要依现场的光线来调整感光度？\n其实，ISO感光度与光圈、快门，可以说是拍摄时决定曝光亮的三大要素之一。学摄影不得不知的光圈、快门，以及最重要的感光度，老师教学这几年下来，却发现从来没帮大家介绍感光度，来帮大家介绍感光度，以及一些基本的运用观念。\n本文其实并不只是单纯谈ISO感光度而已，而会进一步来谈个现象，又为何数位相机感光度越做越高，甚至是小型消费级DC都能设定ISO到12800，这究竟是怎么回事呢?让我们通过这篇文章，对ISO有进一步认识。\n\nimg[/uploads/images/20200422\\ce2999e6364e7e49f399fd04ecc3867d.png]', '', 17, 17, 35, 0, 0, 0, 0, 1587519676, 1587519676, NULL, 1, 0, 0, 0, 0),
(43, '我的团队', '/uploads/thumb.png', 0, '我的团队', 0, '专业团队\nimg[/uploads/images/20200422\\1b102a9a3e853ae225eaea70a8711dfd.jpg]', '', 33, 0, 33, 0, 0, 1, 1, 1587519777, 1587519777, NULL, 1, 0, 0, 0, 7),
(44, '加入我们', '/uploads/thumb.png', 0, '加入我们', 0, '加入我们\nimg[/uploads/images/20200422\\a6c5f7f9b6b7ef8cc09ba3f374575642.gif] \n\nimg[/uploads/images/20200422\\db68a164e3b5cb6f2c0c9c4b1f923823.jpg]', '', 33, 0, 33, 0, 0, 0, 0, 1587519942, 1587519942, NULL, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_column`
--

CREATE TABLE `sy_thread_column` (
  `id` int(11) NOT NULL,
  `listorder` int(4) NOT NULL DEFAULT '10' COMMENT '排序',
  `cp_id` int(6) NOT NULL DEFAULT '0' COMMENT '父子类的父类',
  `pid` int(4) NOT NULL DEFAULT '0' COMMENT '上级目录',
  `title` varchar(55) NOT NULL,
  `alias` varchar(55) NOT NULL,
  `publish_type` int(11) NOT NULL DEFAULT '0' COMMENT '发贴权限',
  `join_type` int(11) NOT NULL DEFAULT '0' COMMENT '进入权限',
  `vip_limit` int(11) NOT NULL DEFAULT '0' COMMENT '进入权限(vip级别)',
  `points_limit` int(11) NOT NULL DEFAULT '0' COMMENT '进入权限(积分值)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='论坛栏目';

--
-- 转存表中的数据 `sy_thread_column`
--

INSERT INTO `sy_thread_column` (`id`, `listorder`, `cp_id`, `pid`, `title`, `alias`, `publish_type`, `join_type`, `vip_limit`, `points_limit`) VALUES
(12, 1, 12, 0, '自然', 'ziran', 0, 0, 0, 0),
(13, 2, 13, 0, '商业', 'business', 0, 0, 0, 0),
(16, 4, 16, 0, '欣赏', 'enjoy', 0, 0, 0, 0),
(17, 5, 17, 0, '交流', 'bbs', 0, 0, 0, 0),
(27, 3, 12, 12, '自然风光', 'zrfg', 0, 0, 0, 0),
(28, 1, 12, 12, '建筑', 'jianzhu', 0, 0, 0, 0),
(35, 2, 17, 17, '摄影交流', 'sychat', 0, 0, 0, 0),
(34, 1, 17, 17, '求助', 'help', 0, 0, 0, 0),
(33, 5, 33, 0, '关于我们', 'about', 1, 0, 0, 0),
(36, 2, 12, 12, '夜景', 'yejing', 0, 0, 0, 0),
(37, 2, 13, 13, '形象照', 'xxzhao', 0, 0, 0, 0),
(38, 3, 13, 13, '证件照', 'zjzhao', 0, 0, 0, 0),
(39, 1, 13, 13, '写真', 'xiezhen', 0, 0, 0, 0),
(42, 4, 13, 13, '主题照', 'zhutizhao', 0, 0, 0, 0),
(41, 5, 13, 13, '签证照', 'qzzhao', 0, 0, 0, 0),
(43, 3, 43, 0, '特殊摄影', 'special', 0, 0, 0, 0),
(44, 2, 43, 43, '天文摄影', 'sky', 0, 0, 0, 0),
(45, 3, 43, 43, '水下摄影', 'underwater', 0, 0, 0, 0),
(46, 1, 43, 43, '航拍', 'hangpai', 0, 0, 0, 0),
(47, 10, 17, 17, '设备器材', 'shebeiqc', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_column_member`
--

CREATE TABLE `sy_thread_column_member` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `column_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_thread_column_member`
--

INSERT INTO `sy_thread_column_member` (`id`, `member_id`, `column_id`, `create_time`) VALUES
(5, 1, 15, 1584092759),
(6, 3, 17, 1584095566),
(4, 2, 17, 1584091402),
(7, 2, 28, 1587281580),
(8, 1, 33, 1587464913);

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_comment`
--

CREATE TABLE `sy_thread_comment` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `create_time` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `is_take` int(1) NOT NULL DEFAULT '0' COMMENT '是否被采纳',
  `hits_zan` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='帖子回复';

--
-- 转存表中的数据 `sy_thread_comment`
--

INSERT INTO `sy_thread_comment` (`id`, `content`, `create_time`, `member_id`, `thread_id`, `is_take`, `hits_zan`) VALUES
(1, 'face[给力] ', 1587516924, 2, 29, 0, 1),
(2, 'face[威武] ', 1587519552, 2, 41, 0, 0),
(3, 'beautiful~face[good] ', 1587550164, 3, 37, 0, 0),
(4, 'face[给力] ', 1587905267, 5, 6, 0, 1),
(5, '@a(/u/5)[1234]  123', 1587905305, 1, 6, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_comment_hits_zan`
--

CREATE TABLE `sy_thread_comment_hits_zan` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_comment_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sy_thread_comment_hits_zan`
--

INSERT INTO `sy_thread_comment_hits_zan` (`id`, `member_id`, `thread_comment_id`, `create_time`) VALUES
(2, 2, 1, 1587516932),
(3, 5, 4, 1587905278),
(7, 1, 4, 1587905300),
(8, 5, 5, 1587905924);

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_hits_comment`
--

CREATE TABLE `sy_thread_hits_comment` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_hits_wish`
--

CREATE TABLE `sy_thread_hits_wish` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sy_thread_hits_zan`
--

CREATE TABLE `sy_thread_hits_zan` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转储表的索引
--

--
-- 表的索引 `sy_apply_identify`
--
ALTER TABLE `sy_apply_identify`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_buy_art`
--
ALTER TABLE `sy_buy_art`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_buy_jifen`
--
ALTER TABLE `sy_buy_jifen`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_member`
--
ALTER TABLE `sy_member`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_member_follow`
--
ALTER TABLE `sy_member_follow`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_member_ident`
--
ALTER TABLE `sy_member_ident`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_member_sign`
--
ALTER TABLE `sy_member_sign`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_member_wish_thread`
--
ALTER TABLE `sy_member_wish_thread`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_message`
--
ALTER TABLE `sy_message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_message_text`
--
ALTER TABLE `sy_message_text`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_nav`
--
ALTER TABLE `sy_nav`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_nav_cat`
--
ALTER TABLE `sy_nav_cat`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_pinyin`
--
ALTER TABLE `sy_pinyin`
  ADD PRIMARY KEY (`py`);

--
-- 表的索引 `sy_system_route`
--
ALTER TABLE `sy_system_route`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_system_user`
--
ALTER TABLE `sy_system_user`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_test`
--
ALTER TABLE `sy_test`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread`
--
ALTER TABLE `sy_thread`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_column`
--
ALTER TABLE `sy_thread_column`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_column_member`
--
ALTER TABLE `sy_thread_column_member`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_comment`
--
ALTER TABLE `sy_thread_comment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_comment_hits_zan`
--
ALTER TABLE `sy_thread_comment_hits_zan`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_hits_comment`
--
ALTER TABLE `sy_thread_hits_comment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_hits_wish`
--
ALTER TABLE `sy_thread_hits_wish`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sy_thread_hits_zan`
--
ALTER TABLE `sy_thread_hits_zan`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sy_apply_identify`
--
ALTER TABLE `sy_apply_identify`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `sy_buy_art`
--
ALTER TABLE `sy_buy_art`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `sy_buy_jifen`
--
ALTER TABLE `sy_buy_jifen`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `sy_member`
--
ALTER TABLE `sy_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sy_member_follow`
--
ALTER TABLE `sy_member_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `sy_member_ident`
--
ALTER TABLE `sy_member_ident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `sy_member_sign`
--
ALTER TABLE `sy_member_sign`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `sy_member_wish_thread`
--
ALTER TABLE `sy_member_wish_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sy_message`
--
ALTER TABLE `sy_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sy_message_text`
--
ALTER TABLE `sy_message_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sy_nav`
--
ALTER TABLE `sy_nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- 使用表AUTO_INCREMENT `sy_nav_cat`
--
ALTER TABLE `sy_nav_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sy_system_route`
--
ALTER TABLE `sy_system_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键';

--
-- 使用表AUTO_INCREMENT `sy_system_user`
--
ALTER TABLE `sy_system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `sy_test`
--
ALTER TABLE `sy_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `sy_thread`
--
ALTER TABLE `sy_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `sy_thread_column`
--
ALTER TABLE `sy_thread_column`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 使用表AUTO_INCREMENT `sy_thread_column_member`
--
ALTER TABLE `sy_thread_column_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `sy_thread_comment`
--
ALTER TABLE `sy_thread_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sy_thread_comment_hits_zan`
--
ALTER TABLE `sy_thread_comment_hits_zan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `sy_thread_hits_comment`
--
ALTER TABLE `sy_thread_hits_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sy_thread_hits_wish`
--
ALTER TABLE `sy_thread_hits_wish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sy_thread_hits_zan`
--
ALTER TABLE `sy_thread_hits_zan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
