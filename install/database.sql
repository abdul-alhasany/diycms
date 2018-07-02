
CREATE TABLE IF NOT EXISTS `diycms_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT 'The id of ther user adding the post',
  `date_time` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `content` text COLLATE utf8_bin NOT NULL,
  `allow` char(3) COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diycms_pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_admin_sessions`
--

CREATE TABLE IF NOT EXISTS `diy_admin_sessions` (
  `sessID` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sessIP` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sess_NAME` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sess_TIME` int(11) NOT NULL DEFAULT '0',
  `sess_VALUE` text COLLATE utf8_bin NOT NULL,
  `sess_LOGTIME` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `diy_admin_sessions`
--

-- --------------------------------------------------------

--
-- Table structure for table `diy_contact`
--

CREATE TABLE IF NOT EXISTS `diy_contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `title` varchar(225) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `website` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post` text COLLATE utf8_bin NOT NULL,
  `date_added` int(11) NOT NULL DEFAULT '0',
  `replied_to` char(3) COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_contact`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_download_cat`
--

CREATE TABLE IF NOT EXISTS `diy_download_cat` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `dsc` text NOT NULL,
  `dscin` text NOT NULL,
  `countopic` int(10) NOT NULL DEFAULT '0',
  `countcomm` int(10) NOT NULL DEFAULT '0',
  `lastpostid` int(11) NOT NULL DEFAULT '0',
  `grouppost` varchar(200) NOT NULL DEFAULT '0',
  `groupview` varchar(200) NOT NULL DEFAULT '0',
  `cat_email` varchar(255) DEFAULT NULL,
  `closed` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diy_download_cat`
--

INSERT INTO `diy_download_cat` (`catid`, `cat_order`, `parent`, `cat_title`, `dsc`, `dscin`, `countopic`, `countcomm`, `lastpostid`, `grouppost`, `groupview`, `cat_email`, `closed`) VALUES
(1, 0, 0, 'قسم تجريبي', 'هذا القسم هو للتجربة فقط', '', 1, 0, 1, '1,2,3,4,5', '1,2,3,4,5', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `diy_download_comments`
--

CREATE TABLE IF NOT EXISTS `diy_download_comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `downid` int(10) NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `allow` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_download_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_download_files`
--

CREATE TABLE IF NOT EXISTS `diy_download_files` (
  `downid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `file_size` int(11) NOT NULL COMMENT 'The size of the file added',
  `size_unit` varchar(11) NOT NULL COMMENT 'The size unit of the file',
  `file_link` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The link to the file (if the file is not uploaded)',
  `clicks` int(11) NOT NULL COMMENT 'Number of file downloads',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `post` longtext,
  `allow` char(3) NOT NULL DEFAULT '',
  `readers` int(10) DEFAULT '0',
  `comments_no` int(10) DEFAULT '0',
  `status` varchar(100) NOT NULL DEFAULT '0',
  `rating_total` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `lastuserid` int(11) NOT NULL DEFAULT '0',
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `edit_by` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`downid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diy_download_files`
--

INSERT INTO `diy_download_files` (`downid`, `userid`, `cat_id`, `username`, `title`, `file_size`, `size_unit`, `file_link`, `clicks`, `date_added`, `post`, `allow`, `readers`, `comments_no`, `status`, `rating_total`, `ratings`, `lastuserid`, `uploadfile`, `edit_by`) VALUES
(1, 1, 1, 'admin', 'Test post', 0, '', '', 0, 1249996876, '[b]This post is for testing purposes only[/b]. [i]You can edit or delete this post.[/i]', 'yes', 11, 0, '0', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `diy_forum_cat`
--

CREATE TABLE IF NOT EXISTS `diy_forum_cat` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `dsc` text NOT NULL,
  `dscin` text NOT NULL,
  `countopic` int(10) NOT NULL DEFAULT '0',
  `countcomm` int(10) NOT NULL DEFAULT '0',
  `lastpostid` int(11) NOT NULL DEFAULT '0',
  `grouppost` varchar(200) NOT NULL DEFAULT '0',
  `groupview` varchar(200) NOT NULL DEFAULT '0',
  `cat_email` varchar(255) DEFAULT NULL,
  `closed` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `diy_forum_cat`
--

INSERT INTO `diy_forum_cat` (`catid`, `cat_order`, `parent`, `cat_title`, `dsc`, `dscin`, `countopic`, `countcomm`, `lastpostid`, `grouppost`, `groupview`, `cat_email`, `closed`) VALUES
(1, 0, 0, 'قسم تجريبي', 'هذا القسم هو للتجربة فقط', '', 1, 0, 1, '1,2,3,4,5', '1,2,3,4,5', '', '0'),
(2, 0, 1, 'قسم تجريبي', 'This is a test category', '', 1, 0, 2, '1,2,3,4,5', '1,2,3,4,5', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `diy_forum_comments`
--

CREATE TABLE IF NOT EXISTS `diy_forum_comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `threadid` int(10) NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `allow` char(3) NOT NULL DEFAULT '',
  `editor_type` varchar(225) NOT NULL DEFAULT 'bbcode',
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_forum_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_forum_threads`
--

CREATE TABLE IF NOT EXISTS `diy_forum_threads` (
  `threadid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `post` longtext,
  `allow` char(3) NOT NULL DEFAULT '',
  `readers` int(10) DEFAULT '0',
  `comments_no` int(10) DEFAULT '0',
  `status` varchar(100) NOT NULL DEFAULT '0',
  `rating_total` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `lastuserid` int(11) NOT NULL DEFAULT '0',
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `edit_by` varchar(255) NOT NULL DEFAULT '0',
  `editor_type` varchar(225) NOT NULL DEFAULT 'bbcode',
  `closed` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`threadid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `diy_forum_threads`
--

INSERT INTO `diy_forum_threads` (`threadid`, `userid`, `cat_id`, `username`, `title`, `date_added`, `post`, `allow`, `readers`, `comments_no`, `status`, `rating_total`, `ratings`, `lastuserid`, `uploadfile`, `edit_by`, `editor_type`, `closed`) VALUES
(1, 1, 1, 'admin', 'Test post', 1249996876, '[b]This post is for testing purposes only[/b]. [i]You can edit or delete this post.[/i]', 'yes', 8, 0, '1', 0, 0, 0, 0, '', 'bbcode', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diy_groups`
--

CREATE TABLE IF NOT EXISTS `diy_groups` (
  `groupid` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `grouptitle` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `editble` tinyint(1) DEFAULT '0',
  `deletble` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `diy_groups`
--

INSERT INTO `diy_groups` (`groupid`, `grouptitle`, `editble`, `deletble`) VALUES
(1, 'المدير العام', 1, 0),
(2, 'المشرفون الإداريون', 1, 0),
(3, 'المشرفون', 1, 0),
(4, 'الأعضاء', 1, 0),
(5, 'الزوار', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `diy_groups_privileges`
--

CREATE TABLE IF NOT EXISTS `diy_groups_privileges` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `groupid` int(5) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `variable` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `value` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action` (`variable`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- Dumping data for table `diy_groups_privileges`
--

INSERT INTO `diy_groups_privileges` (`id`, `groupid`, `type`, `variable`, `value`) VALUES
(1, 1, '', 'view_site', '1'),
(2, 2, '', 'view_site', '1'),
(3, 3, '', 'view_site', '1'),
(4, 4, '', 'view_site', '1'),
(5, 5, '', 'view_site', '1'),
(6, 1, '', 'maximum_posts_letters', '60000'),
(7, 2, '', 'maximum_posts_letters', '50000'),
(8, 3, '', 'maximum_posts_letters', '30000'),
(9, 4, '', 'maximum_posts_letters', '30000'),
(10, 5, '', 'maximum_posts_letters', '30000'),
(11, 1, '', 'maximum_post_edit_time', '30'),
(12, 2, '', 'maximum_post_edit_time', ''),
(13, 3, '', 'maximum_post_edit_time', '30'),
(14, 4, '', 'maximum_post_edit_time', '30'),
(15, 5, '', 'maximum_post_edit_time', '30'),
(16, 1, '', 'allowed_files_upload', '.jpg,.gif,.png,.php,.zip,.pdf'),
(17, 2, '', 'allowed_files_upload', '.jpg,.gif,.png,.php,.zip,.pdf'),
(18, 3, '', 'allowed_files_upload', '.jpg,.gif,.png,.php,.zip,.pdf'),
(19, 4, '', 'allowed_files_upload', '.jpg,.gif,.png,.php,.zip,.pdf'),
(20, 5, '', 'allowed_files_upload', '.jpg,.gif,.png,.php,.zip,.pdf'),
(21, 1, '', 'maximum_upload_size', '1024'),
(22, 2, '', 'maximum_upload_size', '1042'),
(23, 3, '', 'maximum_upload_size', '500'),
(24, 4, '', 'maximum_upload_size', '500'),
(25, 5, '', 'maximum_upload_size', '500'),
(26, 1, '', 'maximum_upload_width', '500'),
(27, 2, '', 'maximum_upload_width', '500'),
(28, 3, '', 'maximum_upload_width', '200'),
(29, 4, '', 'maximum_upload_width', '200'),
(30, 5, '', 'maximum_upload_width', '200'),
(31, 1, '', 'maximum_upload_height', '500'),
(32, 2, '', 'maximum_upload_height', '500'),
(33, 3, '', 'maximum_upload_height', '200'),
(34, 4, '', 'maximum_upload_height', '200'),
(35, 5, '', 'maximum_upload_height', '200'),
(36, 1, '', 'editor_type', 'bbcode'),
(37, 2, '', 'editor_type', 'bbcode'),
(38, 3, '', 'editor_type', 'bbcode'),
(39, 4, '', 'editor_type', 'bbcode'),
(40, 5, '', 'editor_type', 'bbcode'),
(41, 1, '', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN><U><I><OL><LI><FONT><UL><STRONG><EM><B><BR><EMBED><DIV>'),
(42, 2, '', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN><U><I><OL><LI><FONT><UL><STRONG><EM><B><BR><EMBED><DIV>'),
(43, 3, '', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN><U><I><OL><LI><FONT><UL><STRONG><EM><B><BR><EMBED><DIV>'),
(44, 4, '', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN><U><I><OL><LI><FONT><UL><STRONG><EM><B><BR><EMBED><DIV>'),
(45, 5, '', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN><U><I><OL><LI><FONT><UL><STRONG><EM><B><BR><EMBED><DIV>');

-- --------------------------------------------------------

--
-- Table structure for table `diy_menu`
--

CREATE TABLE IF NOT EXISTS `diy_menu` (
  `menuid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `block_template` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `menutitle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `menuhead` text COLLATE utf8_bin,
  `menucenter` text COLLATE utf8_bin,
  `menualign` int(1) NOT NULL DEFAULT '0',
  `menushow` int(1) NOT NULL DEFAULT '0',
  `modid` int(10) NOT NULL DEFAULT '0',
  `menuorder` int(5) NOT NULL DEFAULT '0',
  `checkuser` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT 'The groups allowed to view the menu',
  PRIMARY KEY (`menuid`),
  KEY `menualign` (`menualign`),
  KEY `menushow` (`menushow`),
  KEY `menumodule` (`modid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=48 ;

--
-- Dumping data for table `diy_menu`
--

INSERT INTO `diy_menu` (`menuid`, `title`, `block_template`, `menutitle`, `menuhead`, `menucenter`, `menualign`, `menushow`, `modid`, `menuorder`, `checkuser`) VALUES
(1, 'القائمة الرئيسية', 'standard_menu', 'mainmenu', 'القائمة الرئيسية', '<ul>\r\n<a href="index.php">\r\n			<li>الصفحة الرئيسية</a>\r\n		\r\n		\r\n			<a href="mod.php?mod=forum">\r\n			<li>المنتدى</a>\r\n		\r\n		\r\n			<a href="mod.php?mod=users&modfile=signup">\r\n			<li>التسجيل</a>\r\n		\r\n		\r\n			<a href="mod.php?mod=news">\r\n			<li>الأخبار</a>\r\n		\r\n			<a href="mod.php?mod=download">\r\n			<li>مركز التحميل</a>\r\n		\r\n		\r\n			<a href="mod.php?mod=web_directory">\r\n			<li>دليل المواقع</a>\r\n		\r\n		\r\n			<a href="mod.php?mod=guestbook">\r\n			<li>سجل الزوار</a>\r\n\r\n			<a href="mod.php?mod=contact-us">\r\n			<li>اتصل بنا</a>\r\n</ul>', 1, 1, 0, 1, '1,2,3,4,5'),
(2, 'تسجيل الدخول', 'standard_menu', 'mainmenu', 'تسجيل الدخول', '<center><br>\r\n<img border=0 src=images/user_login1.gif width=64 height=64><BR>\r\n       </center><table border=0 width=100%><tr><td width=100%>\r\n <form method=post action=mod.php?mod=users&modfile=misc&action=login>\r\n    <tr><td> <font face=tahoma size=2>الاسم: </font></td></tr>\r\n    <tr><td><input type=textbox name=username size=13>\r\n    </td></tr><tr><td> <font face=tahoma size=2 >كلمة المرور:</font></td></tr>\r\n    <tr><td><input type=password name=userpass size=13>\r\n    </td></tr><tr><td><input  class=button  type=submit value=سجل الدخول><br>\r\n\r\n<br>\r\n    </td></tr></form>\r\n</td></tr></table>', 1, 1, 0, 3, '5'),
(3, 'صندوق العضوية', 'standard_menu', 'member_box', 'صندوق العضوية', '<!--INC dir="blocks" file="user_profile.php" -->', 1, 1, 0, 3, '1,2,3,4'),
(4, 'تحكم الأعضاء', 'standard_menu', 'mainmenu', 'تحكم الأعضاء', '<!--INC dir="modules/users/blocks" file="control.block.php" -->', 1, 1, 1, 0, '1'),
(37, 'تحكم دليل المواقع', 'standard_menu', 'mainmenu', 'تحكم دليل المواقع', '<!--INC dir="modules/web_directory/blocks" file="control.block.php" -->', 1, 1, 5, 0, '1'),
(36, 'تحكم الأخبار', 'standard_menu', 'mainmenu', 'تحكم الأخبار', '<!--INC dir="modules/download/blocks" file="control.block.php" -->', 1, 1, 4, 0, '1'),
(34, 'تحكم المنتدى', 'standard_menu', 'mainmenu', 'تحكم المنتدى', '<!--INC dir="modules/forum/blocks" file="control.block.php" -->', 1, 1, 2, 0, '1'),
(35, 'تحكم الأخبار', 'standard_menu', 'mainmenu', 'تحكم الأخبار', '<!--INC dir="modules/news/blocks" file="control.block.php" -->', 1, 1, 3, 0, '1'),
(38, 'احصائيات', 'standard_menu', '', 'احصائيات', '<!--INC dir="blocks" file="stat.block.php" -->', 1, 1, 0, 4, '1,2,3,4,5'),
(39, 'المتواجدون حالياً', 'standard_menu', '', 'المتواجدون حالياً', '<!--INC dir="blocks" file="online.block.php" -->', 1, 1, 0, 5, '1,2,3,4,5'),
(40, 'تحكم سجل الزوار', 'standard_menu', 'mainmenu', 'تحكم سجل الزوار', '<!--INC dir="modules/guestbook/blocks" file="control.block.php" -->', 1, 1, 10, 0, '1'),
(41, 'التصويت', 'standard_menu', 'mainmenu', 'التصويت', '<!--INC dir="modules/poll/blocks" file="poll.block.php" -->', 2, 1, 11, 0, '1,2,3,4,5'),
(42, 'تحكم الصفحات', 'standard_menu', 'mainmenu', 'تحكم الصفحات', '<!--INC dir="modules/pages/blocks" file="control.block.php" -->', 1, 1, 12, 0, '1'),
(43, 'تحكم اتصل بنا', 'standard_menu', 'mainmenu', 'تحكم اتصل بنا', '<!--INC dir="modules/contact-us/blocks" file="control.block.php" -->', 1, 1, 13, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `diy_messages`
--

CREATE TABLE IF NOT EXISTS `diy_messages` (
  `msgid` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT 'User id',
  `msgbox` int(10) NOT NULL DEFAULT '0',
  `msgdate` int(11) NOT NULL DEFAULT '0',
  `msgisread` tinyint(1) NOT NULL DEFAULT '1',
  `msgtitle` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `message` text COLLATE utf8_bin,
  `toid` int(10) NOT NULL DEFAULT '0' COMMENT 'Received id',
  `toname` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Recieve name',
  `fromid` int(1) NOT NULL,
  `fromname` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`msgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_modules`
--

CREATE TABLE IF NOT EXISTS `diy_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mod_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mod_user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT 'The groups allowed to view the module',
  `mod_sys` tinyint(1) NOT NULL DEFAULT '1',
  `left_menu` int(1) NOT NULL DEFAULT '0',
  `right_menu` int(1) NOT NULL DEFAULT '1',
  `middle_menu` int(1) NOT NULL DEFAULT '1',
  `mnueid` text COLLATE utf8_bin NOT NULL,
  `themeid` int(10) NOT NULL DEFAULT '0',
  `mod_lang` text COLLATE utf8_bin NOT NULL COMMENT 'The language of the module',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=16 ;

--
-- Dumping data for table `diy_modules`
--

INSERT INTO `diy_modules` (`id`, `mod_name`, `mod_title`, `mod_user`, `mod_sys`, `left_menu`, `right_menu`, `middle_menu`, `mnueid`, `themeid`, `mod_lang`) VALUES
(1, 'users', 'الأعضاء', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,4', 1, 'arabic'),
(6, 'download', 'مركز التحميل', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,36,38', 1, 'arabic'),
(7, 'forum', 'المنتدى', '1,2,3,4,5', 1, 0, 0, 0, '1,2,3,34', 1, 'arabic'),
(8, 'news', 'الأخبار', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,35', 1, 'arabic'),
(9, 'web_directory', 'دليل المواقع', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,37', 1, 'arabic'),
(10, 'guestbook', 'سجل الزوار', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,38,39,40', 1, 'arabic'),
(11, 'poll', 'التصويت', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,38,39,41', 2, 'arabic'),
(12, 'pages', 'الصفحات', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,38,39,42', 1, 'arabic'),
(13, 'contact-us', 'اتصل بنا', '1,2,3,4,5', 1, 0, 1, 0, '1,2,3,38,39,43', 1, 'arabic'),
(14, 'search', 'البحث', '1,2,3,4,5', 1, 0, 1, 0, '1,2,38,39,41', 1, 'arabic');

-- --------------------------------------------------------

--
-- Table structure for table `diy_modules_settings`
--

CREATE TABLE IF NOT EXISTS `diy_modules_settings` (
  `set_id` int(9) NOT NULL AUTO_INCREMENT,
  `set_mod` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `set_text` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `set_var` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `set_val` text COLLATE utf8_bin,
  `set_order` tinyint(4) DEFAULT NULL,
  `set_type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=133 ;

--
-- Dumping data for table `diy_modules_settings`
--

INSERT INTO `diy_modules_settings` (`set_id`, `set_mod`, `set_text`, `set_var`, `set_val`, `set_order`, `set_type`) VALUES
(1, 'users', 'ALLOW_REGISTRATION', 'allow_registration', '1', 0, 5),
(2, 'users', 'REG_STATUS', 'reg_status', 'approved', 1, 2),
(3, 'users', 'USERS_PER_PAGE', 'users_per_page', '30', 2, 6),
(4, 'users', 'AVATAR_MAX_WIDTH', 'avatar_max_width', '200', 3, 6),
(5, 'users', 'AVATAR_MAX_HEIGHT', 'avatar_max_height', '200', 4, 6),
(6, 'users', 'ALLOW_BBCODE', 'allow_bbcode', '1', 5, 5),
(7, 'users', 'SIGNATURE_MAX_LETTERS', 'signature_max_letters', '2000', 6, 6),
(9, 'users', 'ALERT_PM_TITLE', 'alert_pm_title', 'You have received a private message', 5, 6),
(10, 'users', 'REG_CONDITIONS', 'reg_conditions', '', 7, 4),
(11, 'users', 'MAXIMUM_MESSAGES', 'maximum_messages', '100', 6, 6),
(12, 'users', 'VIEW_MEMBERS_LIST', 'view_members_list', '1,2,3,4,5', 0, 7),
(13, 'users', 'EDIT_MEMBER', 'edit_member', '1', 1, 7),
(14, 'users', 'APPROVE_NEW_MEMBERS', 'approve_new_members', '1,2,3', 2, 7),
(15, 'users', 'EMAIL_MEMBERS', 'email_members', '1,2', 3, 7),
(16, 'users', 'EDIT_RANKS', 'edit_ranks', '1,2,3,4,5', 4, 7),
(17, 'users', 'SEARCH_MEMBERS', 'search_memebrs', '1,2,3,4,5', 5, 7),
(18, 'users', 'ALLOWED_PM', 'allowed_pm', '1,2,3,4', 5, 7),
(19, 'download', 'LIST_TYPE', 'list_type', 'title', 0, 2),
(20, 'download', 'CAT_PER_ROW', 'cat_per_row', '10', 1, 3),
(21, 'download', 'POSTS_PER_PAGE', 'posts_per_page', '10', 2, 3),
(22, 'download', 'COMMENTS_PER_PAGE', 'comments_per_page', '10', 3, 3),
(23, 'download', 'ALLOWED_FILES', 'allowed_files', '.zip,.pdf,.rar', 4, 6),
(24, 'download', 'MAXIMUM_UPLOAD_SIZE', 'maximum_upload_size', '500', 5, 6),
(25, 'download', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', 6, 2),
(26, 'download', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', 7, 2),
(27, 'download', 'MANAGE_CAT', 'manage_cat', '1,2', 0, 7),
(28, 'download', 'ADD_POST', 'add_post', '1,2,3,4,5', 1, 7),
(29, 'download', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2', 2, 7),
(30, 'download', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4,5', 3, 7),
(31, 'download', 'APPROVE_FILES', 'approve_files', '1,2', 4, 7),
(32, 'download', 'WAIT', 'wait', '5', 5, 7),
(33, 'download', 'ALLOW_DOWNLOAD', 'allow_download', '1,2,3,4,5', 6, 7),
(34, 'forum', 'CAT_PER_ROW', 'cat_per_row', '10', 0, 3),
(35, 'forum', 'POSTS_PER_PAGE', 'posts_per_page', '10', 1, 3),
(36, 'forum', 'COMMENTS_PER_PAGE', 'comments_per_page', '10', 2, 3),
(37, 'forum', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', 3, 2),
(38, 'forum', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', 4, 2),
(39, 'forum', 'MANAGE_CAT', 'manage_cat', '1,2', 0, 7),
(40, 'forum', 'ADD_POST', 'add_post', '1,2,3,4,5', 1, 7),
(41, 'forum', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2,3', 2, 7),
(42, 'forum', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4,5', 3, 7),
(43, 'forum', 'APPROVE_POSTS', 'approve_posts', '1,2', 4, 7),
(44, 'forum', 'WAIT', 'wait', '5', 5, 7),
(45, 'forum', 'SEARCH_POSTS', 'search_posts', '1,2,3,4,5', 6, 7),
(46, 'news', 'POST_HEAD_LETTERS', 'post_head_letters', '', 0, 6),
(47, 'news', 'CAT_PER_ROW', 'cat_per_row', '10', 1, 3),
(48, 'news', 'POSTS_PER_PAGE', 'posts_per_page', '1', 2, 3),
(49, 'news', 'COMMENTS_PER_PAGE', 'comments_per_page', '10', 3, 3),
(50, 'news', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', 4, 2),
(51, 'news', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', 5, 2),
(52, 'news', 'MANAGE_CAT', 'manage_cat', '1,2', 0, 7),
(53, 'news', 'ADD_POST', 'add_post', '1,2,3,4,5', 1, 7),
(54, 'news', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2,3', 2, 7),
(55, 'news', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4,5', 3, 7),
(56, 'news', 'APPROVE_POSTS', 'approve_posts', '1,2', 4, 7),
(57, 'news', 'WAIT', 'wait', '5', 5, 7),
(58, 'news', 'SEARCH_POSTS', 'search_posts', '1,2,3,4,5', 6, 7),
(59, 'web_directory', 'CAT_PER_ROW', 'cat_per_row', '10', 0, 3),
(60, 'web_directory', 'POSTS_PER_PAGE', 'posts_per_page', '10', 1, 3),
(61, 'web_directory', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', 2, 2),
(62, 'web_directory', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', 3, 2),
(63, 'web_directory', 'MANAGE_CAT', 'manage_cat', '1,2', 0, 7),
(64, 'web_directory', 'ADD_POST', 'add_post', '1,2,3,4,5', 1, 7),
(65, 'web_directory', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2', 2, 7),
(66, 'web_directory', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4,5', 3, 7),
(67, 'web_directory', 'APPROVE_LINKS', 'approve_links', '1,2', 4, 7),
(68, 'web_directory', 'WAIT', 'wait', '5', 5, 7),
(94, 'guestbook', 'SIGNS_PER_PAGE', 'signs_per_page', '10', 0, 6),
(95, 'guestbook', 'MAX_LETTERS', 'max_letters', '1000', 0, 6),
(96, 'guestbook', 'ADD_SIGN', 'add_sign', '1,2,3,4,5', 1, 7),
(97, 'guestbook', 'EDIT_SIGN', 'edit_sign', '1,2,3', 2, 7),
(98, 'guestbook', 'VIEW_SIGN', 'view_sign', '1,2,3,4,5', 3, 7),
(99, 'guestbook', 'WAIT', 'wait', '4,5', 3, 7),
(100, 'poll', 'POLLS_PER_PAGE', 'polls_per_page', '10', 0, 6),
(101, 'poll', 'INT_OPTIONS', 'int_options', '10', 1, 6),
(102, 'poll', 'EDIT_PERM', 'edit_perm', '1', 2, 7),
(103, 'poll', 'VIEW_POLL', 'view_poll', '1,2,3,4,5', 3, 7),
(104, 'poll', 'ALLOW_VOTE', 'allow_vote', '1,2,3,4,5', 4, 7),
(105, 'pages', 'MAX_LETTERS', 'max_letters', '1000', 0, 6),
(106, 'pages', 'ADD_PAGE', 'add_page', '1,2,3,4,5', 1, 7),
(107, 'pages', 'EDIT_PAGE', 'edit_page', '1,2,3', 2, 7),
(108, 'pages', 'VIEW_PAGE', 'view_page', '1,2,3,4,5', 3, 7),
(109, 'pages', 'WAIT', 'wait', '4,5', 4, 7),
(110, 'pages', 'EDITOR_TYPE', 'editor_type', 'bbcode', 5, 2),
(111, 'pages', 'ALLOWED_HTML_TAGS', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN>\r\n<U><I><OL><LI><FONT><UL>\r\n<STRONG><EM><B><BR><EMBED>\r\n<DIV><DEL><INS>', 6, 4),
(112, 'contact-us', 'NOTIFICATION_TYPE', 'notification_type', 'database', 0, 2),
(113, 'contact-us', 'MAX_LETTERS', 'max_letters', '1000', 1, 6),
(114, 'contact-us', 'NOTIFICATION_EMAIL', 'notification_email', '', 2, 6),
(115, 'contact-us', 'MESSAGE_TYPES', 'message_types', 'سؤال\r\nتعليق\r\nاقتراح', 3, 4),
(116, 'contact-us', 'SEND_MSG', 'send_msg', '1,2,3,4,5', 0, 7),
(117, 'contact-us', 'MANAGE_MSG', 'manage_msg', '1', 1, 7),
(118, 'search', 'FLOOD_CONTROL', 'flood_control', '10', 0, 6),
(119, 'search', 'ALLOW_SEARCH', 'allow_search', '1,2,3,4,5', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `diy_modules_templates`
--

CREATE TABLE IF NOT EXISTS `diy_modules_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `themeid` int(10) NOT NULL DEFAULT '0',
  `temp_groupid` int(11) NOT NULL DEFAULT '0' COMMENT 'The id of the template group',
  `parent` int(10) NOT NULL DEFAULT '0',
  `modid` int(10) NOT NULL DEFAULT '0',
  `modname` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `theme` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `temp_title` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `template` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=231 ;

--
-- Dumping data for table `diy_modules_templates`
--

INSERT INTO `diy_modules_templates` (`id`, `main`, `themeid`, `temp_groupid`, `parent`, `modid`, `modname`, `theme`, `temp_title`, `template`) VALUES
(113, 1, 2, 0, 0, 11, 'poll', 'Default', '', ''),
(191, 0, 0, 29, 1, 1, 'users', '', 'users_block_admin', '<ul>\r\n<li><a href=mod.php?mod=users&dir=control>  [lang:BLOCKS_CONTROL_USERS]</font></a>\r\n\r\n<li> <a href=mod.php?mod=users&dir=control&modfile=adduser>  [lang:BLOCKS_ADDUSER]</a><br>\r\n\r\n<li><a href=mod.php?mod=users&dir=control&modfile=emailusers> [lang:BLOCKS_SEND_BULK_MESSAGES]</a><br>\r\n\r\n<li><a href=mod.php?mod=users&dir=control&modfile=newusers> [lang:BLOCKS_PENDING_USERS]</a><br>\r\n\r\n<li><a href=mod.php?mod=users&dir=control&modfile=userranks> [lang:BLOCKS_EDIT_RANKS]</a>\r\n</ul>'),
(189, 0, 0, 28, 1, 1, 'users', '', 'users_pm_head', '<div id="pm_header">\r\n<a href="mod.php?mod=users&dir=pm&box=1&tab=2"><div id="inbox">[lang:PM_INBOX]</div></a>\r\n<a href="mod.php?mod=users&dir=pm&box=2&tab=2"><div id="outbox">[lang:PM_OUTBOX]</div></a>\r\n</div>'),
(190, 0, 0, 28, 1, 1, 'users', '', 'users_pm_msg_table', '<div class="message">\r\n<div class="message-details">\r\n\r\n<span class="message_author"><?php echo $username ?></span>\r\n<span class="message_date"><?php echo $date ?></span>\r\n</div>\r\n<div class="message-content">\r\n<h4><?php echo $msgtitle ?></h4>\r\n<p> <?php echo $message ?></p>\r\n</div>\r\n</div>\r\n\r\n<?php\r\nif($_GET[''box''] == 1)\r\n{\r\necho "\r\n<div class=''post_buttons''>\r\n<a href=''mod.php?mod=users&dir=pm&modfile=reply&msgid=$msgid&box=$box&tab=2'' class=''button''>\r\n<div class=''button''>\r\n<span class=''reply_pm''>{$lang[REPLY]}<span>\r\n</div>\r\n</a>\r\n</div>";\r\n}\r\n?>'),
(188, 0, 0, 28, 1, 1, 'users', '', 'users_pm_list_table', '<div id="messages">\r\n\r\n<?php\r\n$width = $usage[''width''];\r\nif($width  < 35)\r\n{\r\n$color = ''#c5ffc9'';\r\n}\r\nelseif($width >= 35 AND $width <= 70)\r\n{\r\n$color = ''#ffdb8f'';\r\n}\r\nelseif($width > 70)\r\n{\r\n$color = ''#ffc5c5'';\r\n}\r\nelse\r\n{\r\n$color = ''#D8F5FE'';\r\n}\r\necho "\r\n    <div id=''usage-bar''>\r\n      {$usage[''usage'']}\r\n\r\n      <div class=''bar''>\r\n        <div class=''fill'' style=''width: {$usage[''width'']}%; background-color: $color; white-space: nowrap;''>\r\n          {$usage[''width'']}%\r\n        </div>\r\n      </div>\r\n    </div>";\r\n?>\r\n<br />\r\n\r\n    <form method="post" action="mod.php?mod=users&dir=pm&modfile=managepm" name=\r\n    "admin" id="admin">\r\n      <table class="messages-table" id="messages-table" cellpadding="0" cellspacing="1">\r\n        <tr class="header">\r\n          <td></td>\r\n\r\n          <td><?php echo $lang[''PM_MSG_TITLE''] ?></td>\r\n\r\n          <td><?php echo $middle ?></td>\r\n\r\n          <td><?php echo $lang[''PM_MSG_DATE''] ?></td>\r\n\r\n          <td></td>\r\n        </tr><?php echo $msg_rows ?>\r\n\r\n<?php echo "<tr class=''footer''><td colspan=''5''>\r\n                                                {$lang[''PM_MSG_OPTIONS'']}\r\n                                                <select name=''do''>\r\n                                                <option value=''''>{$lang[''PM_MSG_OPTIONS_CHOOSE'']}</option>\r\n                                                <option value=''del''>{$lang[''PM_MSG_OPTIONS_DELETE'']}</option>\r\n                                                <option value=''read''>{$lang[''PM_MSG_OPTIONS_MARK_READ'']}</option>\r\n                                                <option value=''unread''>{$lang[''PM_MSG_OPTIONS_MARK_UNREAD'']}</option>\r\n                                                </select>\r\n                                                <input type=''submit'' class='''' value=''{$lang[''PM_MSG_OPTIONS_DO'']}'' />\r\n                                                <input type=''button'' name=''CheckAll'' value=''{$lang[''PM_MSG_OPTIONS_SELECTALL'']}'' onclick=''checkAll(document.admin)''>\r\n                                                <input type=''button'' name=''UnCheckAll'' value=''{$lang[''PM_MSG_OPTIONS_UNSELECT'']}'' onclick=''uncheckAll(document.admin)''>\r\n                                                <input type=''hidden'' name=''box'' value=''{$box}''>\r\n                                        </td>\r\n                                </tr>";\r\n        ?>\r\n      </table>\r\n    </form>\r\n\r\n<div class="post_buttons">\r\n<a href="mod.php?mod=users&dir=pm&modfile=sendpm&tab=2">\r\n<div class="button">\r\n<span class="sendpm"><?php echo $lang[''SEND_PM''] ?></span></div></a>\r\n</div>\r\n\r\n\r\n\r\n    <ul id="legend">\r\n      <li class="unread"><?php echo $lang[''PM_MSG_UNREAD''] ?></li>\r\n\r\n      <li class="read"><?php echo $lang[''PM_MSG_READ''] ?></li>\r\n<?php\r\nif($_GET[''box''] == 1)\r\n{\r\necho "<li class=''replied''>{$lang[''PM_MSG_REPLIED'']}</li>";\r\n}\r\n?>\r\n    </ul>\r\n  </div>'),
(187, 0, 0, 28, 1, 1, 'users', '', 'users_pm_msg_row', '<tr class="msg-row">\r\n<td>$msgicon</td>\r\n<td class="title"><a href="mod.php?mod=users&dir=pm&modfile=viewmsg&msgid=$msgid&box=$msgbox&tab=2">$msgtitle</a></td>\r\n<td>$fromusername</td>\r\n<td>$msgdate</td>\r\n<td><input type="checkbox" name="msgsid[]" value="$msgid" /></td>\r\n</tr>'),
(186, 0, 0, 27, 1, 1, 'users', '', 'users_control_view_ranks_row', '<tr>\r\n<td>$rank_title</td>\r\n<td>$posts_no</td>\r\n<td>$repetition</td>\r\n<td>$icons</td>\r\n<td>$rank_avatar</td>\r\n<td><a href="mod.php?mod=users&dir=control&modfile=userranks&action=edit&rankid=$rankid"><image border=0 src="images/edit.jpg"></a>\r\n<a href="mod.php?mod=users&dir=control&modfile=userranks&action=delete&rankid=$rankid" onClick="if (!confirm(''[lang:CONTROL_CONFIRM_DELETE_RANK] $rank_title'')) return false;"><image border=0 src="images/delete.jpg"></a>\r\n</td>\r\n</tr>'),
(185, 0, 0, 27, 1, 1, 'users', '', 'users_control_view_ranks', '<br>\r\n<table class="data_table" border="1" width="90%" cellspacing="0" cellpadding="4" style="border-collapse: collapse">\r\n		<tr>\r\n<td colspan=6 class="table_header"> [lang:CONTROL_USERRANKS_VIEW_RANKS]</td>\r\n		</tr>\r\n<tr>\r\n<td class="table_division">[lang:RANK_DESC]</td>\r\n<td class="table_division">[lang:RANK_POST_NO]</td>\r\n<td class="table_division">[lang:RANK_ICONS]</td>\r\n<td class="table_division">[lang:RANK_IMAGE]</td>\r\n<td class="table_division">[lang:RANK_RANK_IMAGE]</td>\r\n<td class="table_division">[lang:RANK_OPTIONS]</td>\r\n\r\n</tr>\r\n\r\n$rank_row\r\n	</table><br>'),
(179, 0, 0, 26, 1, 1, 'users', '', 'users_usercp_head', '<?php\r\n$tab = (empty($_GET[''tab''])) ? 1 : $_GET[''tab''];\r\necho ''\r\n<div id="tab''.$tab.''">\r\n\r\n<ul id="tabnav">\r\n	<li class="tab1"><a href="mod.php?mod=users&modfile=usercp&userid=''.$userid.''&tab=1">''.$lang[PROFILE].''</a></li>\r\n	<li class="tab2"><a href="mod.php?mod=users&dir=pm&tab=2">''.$lang[PM].''</a></li>\r\n	<li class="tab3"><a href="mod.php?mod=users&modfile=edit&action=profile&userid=''.$userid.''&tab=3">''.$lang[EDIT_PROFILE].''</a></li>\r\n	<li class="tab4"><a href="mod.php?mod=users&modfile=edit&action=password&userid=''.$userid.''&tab=4">''.$lang[CHANGE_PASSWORD].''</a></li>\r\n\r\n</ul>\r\n</div>'';\r\n?>'),
(180, 0, 0, 26, 1, 1, 'users', '', 'users_index_top_letters', '<ul id="letters_boxes">\r\n<?php\r\nforeach($letters as $value)\r\n{\r\n\r\nif($value == ''|'')\r\n{\r\nunset($value);\r\necho ''</ul><ul id="letters_boxes">'';\r\n}\r\nelse\r\n{\r\necho "<li><a href=''mod.php?mod=users&action=msearch&by={$value}''>$value</a></li>";\r\n}\r\n}\r\necho $list;\r\n ?>\r\n<div style="clear:both"></div>\r\n</ul>'),
(181, 0, 0, 26, 1, 1, 'users', '', 'inline_errors_display', '<ul class="display_error">\r\n$error\r\n</ul>'),
(182, 0, 0, 27, 1, 1, 'users', '', 'users_control_newusers_row', '<tr><td width=70%>$username</td>\r\n<td width=15% align=center><a href=mod.php?mod=users&modfile=edit&action=profile&userid=$userid>[lang:CONTROL_EDIT_USER]</b></a></td>\r\n                <td width=15% align=center><a href=mod.php?mod=users&modfile=misc&action=delete_user&userid=$userid>[lang:CONTROL_DELETE_USER]</b></a></td>\r\n                <td align=center><INPUT TYPE="checkbox" name="select[]" VALUE="$userid"></td>\r\n</tr>'),
(183, 0, 0, 27, 1, 1, 'users', '', 'users_control_index', '<br><br>\r\n<table width=90%><tr><td align="center" width="25%">\r\n<a href="mod.php?mod=users&dir=control&modfile=emailusers">\r\n<img border="0" src="<#mod_themepath#>/1/bulkpm.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=users&dir=control&modfile=adduser">\r\n<img border="0" src="<#mod_themepath#>/1/adduser.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=users&dir=control&modfile=newusers">\r\n<img border="0" src="<#mod_themepath#>/1/newuser.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=users&dir=control&modfile=userranks">\r\n<img border="0" src="<#mod_themepath#>/1/ranks.jpg"></a>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align="center">\r\n<a href="mod.php?mod=users&dir=control&modfile=emailusers">\r\n[lang:CONTROL_EMAIL_USERS]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=users&dir=control&modfile=adduser">\r\n[lang:CONTROL_NEWUSER_ADD_USER]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=users&dir=control&modfile=newusers">\r\n[lang:CONTROL_PENDING_USERS]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=users&dir=control&modfile=userranks">\r\n[lang:CONTROL_USER_RANKS]</a>\r\n</td>\r\n</tr>\r\n</table>'),
(184, 0, 0, 27, 1, 1, 'users', '', 'users_control_newusers', '<form action="mod.php?mod=users&dir=control&modfile=newusers" method="post" name="admin" enctype="multipart/form-data">\r\n	<table border="1" width="90%" cellspacing="0" cellpadding="3" style="border-collapse: collapse">\r\n		<tr>\r\n<td class="form_header" colspan=4>[lang:CONTROL_PENDING_USERS]</td>\r\n		</tr>\r\n$users_row\r\n	</table><br>\r\n<center>\r\n<input type="button" name="CheckAll" value="[lang:CONTROL_CHECK_ALL]" onclick="checkAll(document.admin)">\r\n<input type="button" name="UnCheckAll" value="[lang:CONTROL_UNCHECK_ALL]" onclick="uncheckAll(document.admin)" >\r\n<input type="submit" name="delete" value="[lang:CONTROL_DELETE]" onClick="if (!confirm(''[lang:CONTROL_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve" value="[lang:CONTROL_APPROVE]">\r\n\r\n</center>\r\n</form>'),
(177, 0, 0, 26, 1, 1, 'users', '', 'register_policy', '<div class="reg_conditions">\r\n<h2>[lang:REGISTER_POLICY]</h2>\r\n$reg_conditions\r\n</div>'),
(178, 0, 0, 26, 1, 1, 'users', '', 'users_info', '<div id="user_card">\r\n<div class="user_photo_name"><?php echo $avatar_pic ?><br><br>\r\n<?php echo $row[''username''] ?></div>\r\n<div class="user_details">\r\n<div class="user_register"><span class="desc"><?php echo $lang[''INFO_REGISTER_DATE''] ?>: </span><?php echo format_date($row[''register_date'']) ?></div>\r\n<div class="user_email"><span class="desc"><?php echo $lang[''INFO_USER_EMAIL''] ?>: </span>\r\n\r\n<?php\r\nif($row[''show_email''] == 0)\r\n{\r\necho $lang[''HIDDEN'']."<a href=''mod.php?mod=users&dir=pm&modfile=sendpm&userid=".$row[''userid'']."''>".$lang[''SEND_PM'']."</a>";\r\n}\r\nelse\r\n{\r\necho $row[''email''];\r\n}\r\n?>\r\n\r\n</div>\r\n<div class="user_website"><span class="desc"><?php echo $lang[''INFO_USER_WEBSITE''] ?>: </span>\r\n<?php\r\nif(($row[''website''] != ''None''))\r\necho "<a target=''_blank'' href=".add_to_url($row[''website'']).">".$row[''website'']."</a>";\r\n?></div>\r\n\r\n<div class="user_posts"><span class="desc"><?php echo $lang[''INFO_USER_ALLPOSTS''] ?>: </span><?php echo $row[''all_posts''] ?></div>\r\n\r\n<div class="user_birthday"><span class="desc"><?php echo $lang[''INFO_USER_BIRTHDATE''] ?>: </span>\r\n<?php\r\nif(is_numeric($row[''birthdate'']))\r\n{\r\necho format_date($row[''birthdate'']);\r\n}\r\nelse\r\n{\r\necho $row[''birthdate''];\r\n}?></div>\r\n\r\n\r\n\r\n\r\n<div class="user_yahoo_id"><span class="desc"><?php echo $lang[''INFO_USER_YAHOO''] ?>: </span><?php echo $row[''yahoo''] ?></div>\r\n\r\n<div class="user_hotmail_id"><span class="desc"><?php echo $lang[''INFO_USER_HOTMAIL''] ?>: </span><?php echo $row[''hotmail''] ?></div>\r\n\r\n<div class="user_icq_id"><span class="desc"><?php echo $lang[''INFO_USER_ICQ''] ?>: </span><?php echo $row[''icq''] ?></div>\r\n\r\n<div class="user_aim_id"><span class="desc"><?php echo $lang[''INFO_USER_AIM''] ?>: </span><?php echo $row[''aim''] ?></div>\r\n\r\n<div class="user_signature">\r\n<fieldset style="padding: 2px;">\r\n<legend><span class="desc"><?php echo $lang[''INFO_USER_SIGNATURE''] ?> </span></legend>\r\n<?php echo $row[''signature''] ?>\r\n</fieldset>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n\r\n<?php\r\n\r\nif ($perm != '''') {\r\necho "<div class=''user_edit''>\r\n<a href=''mod.php?mod=users&modfile=edit&action=profile&userid=".$row[''userid'']."&tab=3''><img src=''modules/users/images/edit.png'' title=''".$lang[INFO_EDIT_USER]."''></a>\r\n<a href=''mod.php?mod=users&modfile=misc&action=delete_user&userid=".$row[''userid'']."''><img src=''modules/users/images/delete.png'' title=''".$lang[INFO_DEL_USER]."''></a></div>";\r\n }\r\n\r\n?>\r\n\r\n<div style="clear:both;"></div>\r\n</div>'),
(16, 1, 1, 0, 0, 6, 'download', 'Default', '', ''),
(17, 0, 0, 5, 1, 6, 'download', '', 'download_index_cat', '<div align="center">\r\n<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">\r\n	<tr>\r\n		<td align="center" width="100%" style="padding: 3"> \r\n<a href="mod.php?mod=download&modfile=list&catid=$catid"><center>$cat_image</a></td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%" style="padding: 3"> <font class="fontht">\r\n		<a href="mod.php?mod=download&modfile=list&catid=$catid"><center>$cat_title</a></font>\r\n		<br><span class="fontablt"><center>\r\n		<img border="0" src="images/topics.gif" align="middle" alt="Topics">\r\n		<font color="#C0C0C0">[$numrows]\r\n		<img border="0" src="images/replys.gif" alt="comments" align="absmiddle"> \r\n		[$numcomment]</font></span></td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%" class="fontablt"><center><font color="#808080">$dsc</font></td>\r\n	</tr>\r\n</table>\r\n<center>\r\n<br>'),
(18, 0, 0, 5, 1, 6, 'download', '', 'download_list_title_desc_view', '<table border="0" cellpadding="0" cellspacing="0" width="95%">\r\n	<tr>\r\n		<td height="28">\r\n		<div class="post_title">\r\n			<img border="0" src="<#mod_themepath#>/news_icon.gif" width="12" height="12">\r\n			<a href="mod.php?mod=download&modfile=view_file&downid=$downid">$title</a></div>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%">\r\n		<table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" id="AutoNumber1" class="article_info">\r\n			<tr>\r\n				<td width="100%">\r\n				<div class="article_info">\r\n					<img border="0" src="<#mod_themepath#>/info.gif" width="13" height="18"> \r\n					By: <a href="mod.php?mod=users&modfile=info&userid=$userid">$name</a> \r\n					Date: $date </div>\r\n				</td>\r\n				<td nowrap colspan="3"></td>\r\n			</tr>\r\n		</table>\r\n		</td>\r\n	</tr>\r\n<tr>\r\n		<td width="100%" style="padding-top: 5; padding-bottom: 5; text-align: justify">\r\n		<font class="home_text">$post </font></td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%" class="info_bar2" style="padding-top: 5; padding-bottom: 5">\r\n		<p><a href="mod.php?mod=download&modfile=view_file&downid=$downid">\r\n		<img border="0" src="<#mod_themepath#>/readmore.gif" align="right"></a>\r\n		</p>\r\n		<div class="article_info">\r\n&nbsp; Readers: $readers&nbsp;&nbsp;&nbsp; comments: $numrows </div>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%">$pagenum </td>\r\n	</tr>\r\n</table>\r\n<hr color="#C0C0C0" width="95%" size="1" style="border-style: dotted; border-width: 1px">'),
(19, 0, 0, 5, 1, 6, 'download', '', 'download_list_files_row', '<tr>\r\n\r\n<td class="alt1" width="40%">\r\n<a href="mod.php?mod=download&modfile=view_file&downid=$downid">\r\n<font color="#34597D">$title</font> </a>$pagenum </td>\r\n<td class="alt2" align="center" width="20%">$name</td>\r\n<td class="alt1" align="center" width="20%">$date</td>\r\n<td class="alt2" align="center" width="10%">$readers</td>\r\n<td class="alt1" align="center" width="10%">$numrows</td>\r\n\r\n</tr>'),
(20, 0, 0, 5, 1, 6, 'download', '', 'download_list_files', '<table border="1" width="95%" id="table4" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td class="table_header">[lang:LIST_TITLE]</td>\r\n		<td class="table_header">[lang:LIST_AUTHOR]</td>\r\n<td class="table_header">[lang:LIST_DATE_ADDED]</td>\r\n<td class="table_header">[lang:LIST_READERS]</td>\r\n		<td class="table_header">[lang:LIST_COMMENTS]</td>\r\n	</tr>\r\n	$list_row\r\n</table>'),
(21, 0, 0, 5, 1, 6, 'download', '', 'download_viewfile_file', '<table border="0" width="90%" id="table3" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n			<tr>\r\n				<td class="table_header">\r\n				[lang:VIEWFILE_FILE_DETAILS]</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n				<table border="0" width="100%" id="table4" cellpadding="2" class="fontablt">\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_NAME]</td>\r\n						<td width="100%">$title</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_BY]</td>\r\n						<td width="100%">$username</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_SIZE]</td>\r\n						<td width="100%">$file_size $size_unit</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_CLICKS]</td>\r\n						<td width="100%">$clicks</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_VOTES]</td>\r\n						<td width="100%">$ratings</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_RATING]</td>\r\n						<td width="100%"><font class="fontablt">\r\n						$rating_avg</font></td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_DATE_ADDED]</td>\r\n						<td width="100%">$date</td>\r\n					</tr>\r\n					<tr>\r\n						<td nowrap class="info_bar">[lang:VIEWFILE_FILE_DESC]</td>\r\n						<td width="100%">$post </td>\r\n					</tr>\r\n				</table>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width="100%">\r\n\r\n                <a href="javascript:popup(''mod.php?mod=download&modfile=misc&action=rate_file&downid=$downid&fullpage=1'',200,400)">\r\n                <img border="0" src="<#mod_themepath#>/rate.gif"></a>\r\n                <a href="mod.php?mod=download&modfile=edit_file&downid=$downid">\r\n                <img border="0" src="<#mod_themepath#>/edit.png"></a>\r\n<center>\r\n		 <a href="mod.php?mod=download&modfile=misc&action=goto&downid=$downid">\r\n                <img border="0" src="<#mod_themepath#>/download.gif">\r\n                </center></a>\r\n\r\n                </td>\r\n			</tr>\r\n			<tr>\r\n				<td align="left"><font size="2" color="#FFFFFF"><br>\r\n				\r\n               </font></td>\r\n			</tr>\r\n		</table>'),
(22, 0, 0, 5, 1, 6, 'download', '', 'download_post_tools', '<table border="0" width="95%" id="table11" cellpadding="2">\r\n	<tr>\r\n		<td class="small">$pagenum</td>\r\n		<td align="left">\r\n\r\n<a href="mod.php?mod=download&modfile=add_file"><img border=''0'' src="<#mod_themepath#>/add_file.gif"></a>\r\n\r\n$replay_img\r\n\r\n	</tr>\r\n</table>'),
(23, 0, 0, 5, 1, 6, 'download', '', 'download_breadcrumb', '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%">\r\n		<p class="catlinkfont"><font size="4">\r\n		<img border="0" src="<#mod_themepath#>/navbits_start.gif" width="21" height="21" align="middle">\r\n		<a href="index.php">$sitetitle</a> » <a href="mod.php?mod=download">مركز التحميل</a> » $nav_bits\r\n		</font></p>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(25, 0, 0, 5, 1, 6, 'download', '', 'download_view_comment', '<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse" width="95%" bordercolor="#E4E4E4">\r\n	<tr>\r\n		<td valign="top" bgcolor="#F1F1F1" nowrap><span class="fontablt">\r\nBy: $avatar_pic\r\n		<a href="mod.php?mod=users&modfile=info&userid=$userid">$username</a><br>\r\n		&nbsp;<a href="mod.php?mod=users&modfile=email_user&userid=$userid"><img border="0" src="images/mail.gif"></a>\r\n		<a href="mod.php?mod=users&modfile=misc&action=user_website&userid=$userid" target="_blank">\r\n		<img border="0" src="images/home.gif"></a>\r\n		<a href="mod.php?mod=users&dir=pm&modfile=sendpm&userid=$userid">\r\n		<img border="0" src="images/pmid.gif"></a><br>\r\n$userrank\r\n		</span>\r\n		</td>\r\n		<td width="100%" valign="top"><span class="normal">$title </span>\r\n		<font class="fontablt"><font color="#808080">[EEC??I : $date ]</font></font><span class="fontablt"><a name="comment$id"></a></span></td>\r\n	</tr>\r\n	<tr>\r\n		<td valign="top" nowrap colspan="2">\r\n		<div align="center">\r\n			<table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" cellspacing="4">\r\n				<tr>\r\n					<td>\r\n					<p><font class="fontablt">$comment\r\n					</font><br>\r\n					$comment_attachment </p>\r\n<br>-------------------------------------<br>$signature\r\n$grouptitle\r\n					</td>\r\n				</tr>\r\n			</table>\r\n		</div>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td valign="top" bgcolor="#FFFFFF" nowrap colspan="2">\r\n		<a href="mod.php?mod=download&modfile=addcomment&downid=$downid&qoute=$commentid"><img border="0" src="<#mod_themepath#>/quote.gif" align="left"></a>\r\n<a href="mod.php?mod=download&modfile=editcomment&commentid=$commentid&downid=$downid"><img border="0" src=<#mod_themepath#>/edit.gif></a>\r\n</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(27, 0, 0, 5, 1, 6, 'download', '', 'download_cat_tools', '<table border="0" width="95%" id="table11" cellpadding="2">\r\n	<tr>\r\n		<td class="small">$pagenum</td>\r\n		<td align="left">\r\n\r\n<a href="mod.php?mod=download&modfile=add_file"><img border=''0'' src=''<#mod_themepath#>/add_file.gif''></a>\r\n\r\n</td>\r\n	</tr>\r\n</table>'),
(28, 0, 0, 5, 1, 6, 'download', '', 'download_misc_rate_file', '<center>\r\n<b>[lang:MISC_RATE_FILE]</b>\r\n<form name="rate_file" method="post" action=mod.php?mod=download&modfile=misc&action=rate_file&downid=$downid&fullpage=1>\r\n             <br>  <select name=rating>\r\n     	        <option value=5>5</option>\r\n		<option value=4>4</option>\r\n		<option value=3>3</option>\r\n		<option value=2>2</option>\r\n		<option value=1>1</option>\r\n			   </select>\r\n<input type="submit" name="submit" value="[global_lang:LANG_FORM_SUBMIT_BUTTON]"></form><br>\r\n</center>'),
(29, 0, 0, 5, 1, 6, 'download', '', 'download_viewfile_reply_close', '<img border=0 src="<#mod_themepath#>/close.gif">'),
(30, 0, 0, 5, 1, 6, 'download', '', 'download_viewfile_reply_open', '<a href="mod.php?mod=download&modfile=addcomment&downid=$downid&cat_id=$cat_id"><img border=''0'' src=''<#mod_themepath#>/replay.gif''></a>'),
(31, 0, 0, 6, 1, 6, 'download', '', 'download_control_viewcat_row', '<tr>\r\n<td $tdcolor>$title</td>\r\n<td $tdcolor><a href=mod.php?mod=download&dir=control&modfile=edit_cat&catid=$catid><img border=0 src="<#mod_themepath#>/edit_cat.gif"></a>\r\n\r\n<a href=mod.php?mod=download&dir=control&modfile=misc&action=delete_cat&catid=$catid><img border=0 src="<#mod_themepath#>/delete.png"></a>\r\n</td>\r\n</tr>'),
(32, 0, 0, 6, 1, 6, 'download', '', 'download_control_index', '<br><br>\r\n<table width=90%><tr><td align="center" width="25%">\r\n<a href="mod.php?mod=download&dir=control&modfile=addcat">\r\n<img border="0" src="<#mod_themepath#>/addcat.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=download&dir=control&modfile=viewcat">\r\n<img border="0" src="<#mod_themepath#>/viewcats.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=download&dir=control&modfile=approve_files">\r\n<img border="0" src="<#mod_themepath#>/pending_posts.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=download&dir=control&modfile=approve_comments">\r\n<img border="0" src="<#mod_themepath#>/pending_posts.jpg"></a>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align="center">\r\n<a href="mod.php?mod=download&dir=control&modfile=addcat">\r\n[lang:CONTROL_ADD_NEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=download&dir=control&modfile=viewcat">\r\n[lang:CONTROL_EDIT_VIEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=download&dir=control&modfile=approve_files">\r\n[lang:CONTROL_PENDING_POSTS]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=download&dir=control&modfile=approve_comments">\r\n[lang:CONTROL_PENDING_COMMENTS]</a>\r\n</td>\r\n</tr>\r\n</table>'),
(33, 0, 0, 6, 1, 6, 'download', '', 'download_control_viewcat', '<table class="data_table" border="1" width="90%" cellspacing="0" cellpadding="4" style="border-collapse: collapse">\r\n		<tr>\r\n<td colspan=3 class="table_header">[lang:CONTROL_CATEGORIES]</td>\r\n		</tr>\r\n<tr>\r\n<td class="table_division" width="70%">[lang:CONTROL_VIEWCAT_TITLE]</td>\r\n<td class="table_division">[lang:CONTROL_VIEWCAT_OPTIONS]</td>\r\n</tr>\r\n$download_row\r\n</table>'),
(34, 0, 0, 6, 1, 6, 'download', '', 'download_control_pending_files_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$downid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=download&modfile=edit_file&downid=$downid><img border=0 src="<#mod_themepath#>/edit.gif"></a>\r\n\r\n<a href=mod.php?mod=download&dir=control&modfile=misc&action=delete_post&downid=$downid><img border=0 src="<#mod_themepath#>/delete.png"></a>\r\n</td>\r\n</tr>'),
(35, 0, 0, 6, 1, 6, 'download', '', 'download_control_pending_comments', '<form method="post" action="mod.php?mod=download&dir=control&modfile=approve_comments" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_COMMENTS_COMMENTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_COMMENTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_COMMENTS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_COMMENTS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_comments_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_COMMENTS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_COMMENTS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_COMMENTS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_COMMENTS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_COMMENTS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n</form>'),
(36, 0, 0, 6, 1, 6, 'download', '', 'download_control_pending_files', '<form method="post" action="mod.php?mod=download&dir=control&modfile=approve_posts" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_FILES_POSTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_FILES_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_FILES_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_FILES_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_files_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_FILES_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_FILES_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_FILES_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_FILES_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_FILES_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n<br><br>[lang:APPROVE_FILES_MOVE_TO]<select name=''new_catid''>\r\n$options\r\n</option>\r\n<input type="submit" name="move"  value="[lang:APPROVE_FILES_MOVE]">\r\n</form>'),
(37, 0, 0, 6, 1, 6, 'download', '', 'download_control_pending_comments_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$commentid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=download&modfile=editcomment&commentid=$commentid&downid=$downid><img border=0 src=<#mod_themepath#>/edit.gif></a>\r\n\r\n<a href=mod.php?mod=download&dir=control&modfile=misc&action=delete_comment&$commentid&downid=$downid><img border=0 src=<#mod_themepath#>/delete.png></a>\r\n</td>\r\n</tr>'),
(38, 0, 0, 7, 1, 6, 'download', '', 'download_block_admin', '<ul>\r\n<li><a href=mod.php?mod=download&dir=control>  [lang:BLOCKS_CONTROL_DOWNLOAD]</font></a>\r\n\r\n<li><a href=mod.php?mod=download&dir=control&modfile=addcat>  [lang:BLOCKS_ADDCAT]</a>\r\n\r\n<li><a href=mod.php?mod=download&dir=control&modfile=viewcat> [lang:BLOCKS_VIEW_EDIT]</a>\r\n\r\n<li><a href=mod.php?mod=download&dir=control&modfile=approve_files> [lang:BLOCKS_PENDING_FILES] ($waiting_posts)</a>\r\n\r\n<li><a href=mod.php?mod=download&dir=control&modfile=approve_comments> [lang:BLOCKS_PENDING_COMMENTS] ($waiting_comments)</a>\r\n</ul>'),
(171, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_pending_posts', '<form method="post" action="mod.php?mod=forum&dir=control&modfile=approve_posts" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_POSTS_POSTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_POSTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_POSTS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_POSTS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_posts_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_POSTS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_POSTS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_POSTS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_POSTS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_POSTS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n<br><br>[lang:APPROVE_POSTS_MOVE_TO]<select name=''new_catid''>\r\n$options\r\n</option>\r\n<input type="submit" name="move"  value="[lang:APPROVE_POSTS_MOVE]">\r\n</form>'),
(172, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_pending_comments_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$commentid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=forum&modfile=editcomment&commentid=$commentid&topicid=$topicid><img border=0 src=<#mod_themepath#>/edit.png></a>\r\n\r\n<a href=mod.php?mod=forum&dir=control&modfile=misc&action=delete_comment&$commentid&threadid=$threadid><img border=0 src=<#mod_themepath#>/delete.png></a>\r\n</td>\r\n</tr>'),
(173, 0, 0, 25, 1, 7, 'forum', '', 'forum_block_admin', '-<a href=mod.php?mod=forum&dir=control>  [lang:BLOCKS_CONTROL_NEWS]</font></a><br>\r\n\r\n-<a href=mod.php?mod=forum&dir=control&modfile=addcat>  [lang:BLOCKS_ADDCAT]</a><br>\r\n\r\n-<a href=mod.php?mod=forum&dir=control&modfile=viewcat> [lang:BLOCKS_VIEW_EDIT]</a><br>\r\n\r\n- <a href=mod.php?mod=forum&dir=control&modfile=approve_posts> [lang:BLOCKS_UNAPPROVED_POSTS] ($pending_posts)</a><br>\r\n\r\n- <a href=mod.php?mod=forum&dir=control&modfile=approve_comments> [lang:BLOCKS_UNAPPROVED_COMMENTS] ($pending_comments)</a>'),
(170, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_pending_comments', '<form method="post" action="mod.php?mod=forum&dir=control&modfile=approve_comments" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_COMMENTS_COMMENTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_COMMENTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_COMMENTS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_COMMENTS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_posts_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_COMMENTS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_COMMENTS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_COMMENTS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_COMMENTS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_COMMENTS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n</form>'),
(169, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_pending_posts_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$threadid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=forum&modfile=editpost&threadid=$threadid&catid=$cat_id><img border=0 src=<#mod_themepath#>/edit.gif></a>\r\n\r\n<a href=mod.php?mod=forum&dir=control&modfile=misc&action=delete_post&threadid=$threadid><img border=0 src=<#mod_themepath#>/delete.png></a>\r\n</td>\r\n</tr>'),
(167, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_index', '<br><br>\r\n<table width=90%><tr><td align="center" width="25%">\r\n<a href="mod.php?mod=forum&dir=control&modfile=addcat">\r\n<img border="0" src="<#mod_themepath#>/addcat.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=forum&dir=control&modfile=viewcat">\r\n<img border="0" src="<#mod_themepath#>/viewcats.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=forum&dir=control&modfile=approve_posts">\r\n<img border="0" src="<#mod_themepath#>/pending_posts.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=forum&dir=control&modfile=approve_comments">\r\n<img border="0" src="<#mod_themepath#>/pending_posts.jpg"></a>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align="center">\r\n<a href="mod.php?mod=forum&dir=control&modfile=addcat">[lang:CONTROL_ADD_NEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=forum&dir=control&modfile=viewcat">\r\n[lang:CONTROL_EDIT_VIEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=forum&dir=control&modfile=approve_posts">\r\n[lang:CONTROL_PENDING_POSTS]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=forum&dir=control&modfile=approve_comments">\r\n[lang:CONTROL_PENDING_COMMENTS]</a>\r\n</td>\r\n</tr>\r\n</table>'),
(168, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_viewcat', '<table class="data_table" border="1" width="90%" cellspacing="0" cellpadding="4" style="border-collapse: collapse">\r\n		<tr>\r\n<td colspan=3 class="table_header">News categories</td>\r\n		</tr>\r\n<tr>\r\n<td class="table_division" width="70%">[lang:CONTROL_VIEWCAT_TITLE]</td>\r\n<td class="table_division">[lang:CONTROL_VIEWCAT_OPTIONS]</td>\r\n</tr>\r\n$forum_row\r\n</table>'),
(166, 0, 0, 24, 1, 7, 'forum', '', 'forum_control_viewcat_row', '<tr>\r\n<td $tdcolor>$title</td>\r\n<td $tdcolor><a href=mod.php?mod=forum&dir=control&modfile=edit_cat&catid=$catid><img border=0 src=<#mod_themepath#>/edit.png></a>\r\n\r\n<a href=mod.php?mod=forum&dir=control&modfile=misc&action=delete_cat&catid=$catid><img border=0 src=<#mod_themepath#>/delete.png></a>\r\n</td>\r\n</tr>'),
(165, 0, 0, 23, 1, 7, 'forum', '', 'forum_viewpost_admin_control', '<div class="admin-control">\r\n<?php\r\n$admin .= "<a href=''mod.php?mod=forum&modfile=editpost&threadid=$threadid'' title=''{$lang[''INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT'']}''><img src=''<#mod_themepath#>/edit.png''></a>";\r\n     if ($closed == ''1'') {\r\n         $title = $lang[''INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE''];\r\n         $admin .= "<a href=''mod.php?mod=forum&modfile=misc&action=change_status&do=open_topic&threadid=$threadid'' title=''$title''><img src=''<#mod_themepath#>/unlock.png''></a>";\r\n     } else {\r\n         $title = $lang[''INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE''];\r\n         $admin .= "<a href=''mod.php?mod=forum&modfile=misc&action=change_status&do=close_topic&threadid=$threadid'' title=''$title''> <img src=''<#mod_themepath#>/lock.png''></a>";\r\n     }\r\n     \r\n     // Check if the post is pinned or not\r\n     if ($status == ''0'') {\r\n         $title = $lang[''INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN''];\r\n         $admin .= "<a href=''mod.php?mod=forum&modfile=misc&action=change_status&do=unpin_topic&threadid=$threadid'' title=''$title''><img src=''<#mod_themepath#>/unpin.png''></a>";\r\n     } else {\r\n         $title = $lang[''INCLUDES_FUNCTIONS_ADMIN_MENU_PIN''];\r\n         $admin .= "<a href=''mod.php?mod=forum&modfile=misc&action=change_status&do=pin_topic&threadid=$threadid'' title=''$title''><img src=''<#mod_themepath#>/pin.png''></a>";\r\n     }\r\necho $admin;\r\n?>\r\n</div>'),
(163, 0, 0, 23, 1, 7, 'forum', '', 'forum_viewpost_reply_close', '<div class="post_buttons">\r\n<div class="button">\r\n<span class="closed_topic">[lang:CLOSED]<span>\r\n</div>\r\n</div>'),
(164, 0, 0, 23, 1, 7, 'forum', '', 'forum_viewpost_reply_open', '<div class="post_buttons">\r\n<a href="mod.php?mod=forum&modfile=addpost&catid=$cat_id" class="button">\r\n<div class="button">\r\n<span class="add_post">[lang:ADD_POST]<span>\r\n</div>\r\n</a>\r\n\r\n<a href="mod.php?mod=forum&modfile=addcomment&threadid=$threadid&cat_id=$cat_id" class="button">\r\n<div class="button">\r\n<span class="add_comment">[lang:ADD_COMMENT]</span>\r\n</div>\r\n</a>\r\n</div>'),
(162, 0, 0, 23, 1, 7, 'forum', '', 'forum_list_subcat_list', '<table border="1" width="100%" cellspacing="0" cellpadding="0" id="form_cat_table">\r\n<tr>\r\n<td colspan="5" align="center" class="table_header">$row[cat_title]</td>\r\n</tr>\r\n\r\n<tr class="table_division">\r\n<td height="25" width="5%"></td>\r\n<td width="50%">[lang:INDEX_LIST_FORUM]</td>\r\n<td width="10%">[lang:STAT] </td>\r\n<td width="35%">[lang:INDEX_LIST_LAST_POST]</td>\r\n</tr>\r\n$list_cat_row\r\n</table>\r\n<br>'),
(160, 0, 0, 23, 1, 7, 'forum', '', 'forum_tools_bar', '<table border="1" width="100%" cellspacing="0" cellpadding="0" class="data_table">\r\n<tr>\r\n<td class="table_division" height="35" align="center">\r\n <a href="mod.php?mod=users&modfile=usercp&userid=$userid">[lang:INDEX_USER_CONTROL_PANEL]</font></a> | <a href="mod.php?mod=users&dir=pm">[lang:INDEX_USER_PM] \r\n: ($pmumrows)</font></a> | <a href="mod.php?mod=users&modfile=misc&action=logout">[lang:INDEX_LOGOUT]</font></a> \r\n$isadmin\r\n</td></tr></table>\r\n<br>'),
(161, 0, 0, 23, 1, 7, 'forum', '', 'forum_list_subcat_row', '<tr class="cat_row">\r\n<td class="cat_icon"><img border="0" src="<#mod_themepath#>/$cat_icon"></td>\r\n<td class="cat_title">\r\n<a href="mod.php?mod=forum&modfile=list&catid=$catid">$cat_title</a>\r\n<div class="small">$dsc</div>\r\n</td>\r\n<td class="cat_stat">\r\n<span class="threads" title="[lang:INDEX_LIST_THREADS]">$threads_number</span>\r\n<span class="comments" title="[lang:INDEX_LIST_REPLIES]">$replies_number</span>\r\n\r\n</td>\r\n<td class="cat_last_post">\r\n<a href="mod.php?mod=forum&modfile=viewpost&threadid=$lastpostid">$lasttitle </a><br>\r\n$lastpostd <br>\r\n[lang:INDEX_LIST_BY] <a href="mod.php?mod=users&modfile=info&userid=$lastposterid">$lastposter</a>\r\n<a href="mod.php?mod=forum&modfile=rss&catid=$catid&fullpage=1"><span class="rss" title="[lang:LATEST_POSTS_RSS]"></span></a></td>\r\n\r\n</tr>'),
(157, 0, 0, 23, 1, 7, 'forum', '', 'forum_cat_tools', '<div class="post_buttons">\r\n<a href="mod.php?mod=forum&modfile=addpost&catid=$cat_id" class="button">\r\n<div class="button">\r\n<span class="add_post">[lang:ADD_POST]</span></div></a>\r\n</div>'),
(158, 0, 0, 23, 1, 7, 'forum', '', 'forum_index_list_cat', '<table border="1" width="100%" cellspacing="0" cellpadding="0" id="form_cat_table">\r\n<tr>\r\n<td colspan="5" align="center" class="table_header">$row[cat_title]</td>\r\n</tr>\r\n\r\n<tr class="table_division">\r\n<td height="25" width="5%"></td>\r\n<td width="50%">[lang:INDEX_LIST_FORUM]</td>\r\n<td width="10%">[lang:STAT] </td>\r\n<td width="35%">[lang:INDEX_LIST_LAST_POST]</td>\r\n</tr>\r\n$list_cat_row[$cat_id]\r\n</table>\r\n<br>'),
(159, 0, 0, 23, 1, 7, 'forum', '', 'forum_login_bar', '<table border="1" width="100%" cellspacing="0" cellpadding="0" class="data_table">\r\n<tr>\r\n<td class="table_division" height="35" align="center">\r\n\r\n<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n	<font face="tahoma" size="2">[lang:INDEX_LOGIN_BAR_USERNAME]</font>\r\n	<input type="textbox" name="username" size="13">\r\n[lang:INDEX_LOGIN_BAR_PASSWORD]\r\n	<input type="password" name="userpass" size="13">\r\n	<input class="button" type="submit" value="[lang:INDEX_LOGIN_BAR_SUBMIT]">\r\n	<a href="mod.php?mod=users&modfile=misc&action=remind_me">[lang:INDEX_LOGIN_BAR_SEND_DETAILES]</a>\r\n</form>\r\n</td>\r\n</tr>\r\n</table>\r\n<br>'),
(155, 0, 0, 23, 1, 7, 'forum', '', 'forum_view_attachment', '<fieldset style="padding: 2px;">\r\n<legend><b>&nbsp;Attachments&nbsp;</legend>\r\n<div align="center">\r\n<table width="100%" cellspacing="3" cellpadding="0" border="0" style="border-collapse: collapse;">\r\n$download\r\n</div>\r\n</table>\r\n</fieldset>\r\n<br>'),
(156, 0, 0, 23, 1, 7, 'forum', '', 'forum_view_comment', '<a name ="comment-$commentid"></a>\r\n<div class="comment">\r\n<h2>$title $admin_control</h2>\r\n<div class="author-box-bg"></div>\r\n<div class="author-box">\r\n<ul class="author-details">\r\n<li class="avatar" title=''[lang:USER_NAME]''><div><a href=''mod.php?mod=users&modfile=info&userid=$userid''>$avatar_pic</a></div>\r\n<a href=''mod.php?mod=users&modfile=info&userid=$userid''>$username</a>\r\n<li title=''[lang:USER_GROUP]''>$usergroup\r\n<li title=''[lang:USER_RANK]''>$userrank\r\n<li title=''[lang:USER_POSTS_NO]''>$all_posts\r\n<li title=''[lang:USER_REG_DATE]''>$datetime\r\n</ul>\r\n</div>\r\n\r\n<div class="thread-block">\r\n\r\n<span class="post_date">&nbsp;[lang:VIEWPOST_ARTICLE_DATEADDED]\r\n$date </span>\r\n<p>$comment</p>\r\n<br>\r\n$attachment\r\n\r\n<fieldset style="padding: 2" class="signature">\r\n<legend><b>[lang:VIEWPOST_USER_SIGNATURE]</legend>\r\n<div align="center">\r\n$signature</div></fieldset>\r\n</div>\r\n</div>'),
(154, 0, 0, 23, 1, 7, 'forum', '', 'forum_breadcrumb', '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%">\r\n		<div class="wrap">\r\n		<img border="0" src="<#mod_themepath#>/1/navbits_start.gif" width="21" height="21" align="middle">\r\n		<a href="index.php">$sitetitle</a> » <a href="mod.php?mod=forum">[lang:FORUM]</a> » $nav_bits\r\n		</div>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(151, 0, 0, 23, 1, 7, 'forum', '', 'forum_list_threads_row', '<tr>\r\n\r\n<td class="alt1" width="40%">\r\n<a href="mod.php?mod=forum&modfile=viewpost&threadid=$threadid">\r\n<font color="#34597D">$title</font> </a>$pagenum </td>\r\n<td class="alt2" align="center" width="20%">$name</td>\r\n<td class="alt1" align="center" width="20%">$date</td>\r\n<td class="alt2" align="center" width="10%">$readers</td>\r\n<td class="alt1" align="center" width="10%">$numrows</td>\r\n\r\n</tr>'),
(152, 0, 0, 23, 1, 7, 'forum', '', 'forum_list_threads', '<table id="forum_trheads_list" cellspacing="0" cellpadding="5">\r\n	<tr>\r\n		<td class="table_header">[lang:LIST_TITLE]</td>\r\n		<td class="table_header">[lang:LIST_AUTHOR]</td>\r\n<td class="table_header">[lang:LIST_DATE_ADDED]</td>\r\n<td class="table_header">[lang:LIST_READERS]</td>\r\n		<td class="table_header">[lang:LIST_COMMENTS]</td>\r\n	</tr>\r\n	$list_row\r\n</table>'),
(153, 0, 0, 23, 1, 7, 'forum', '', 'forum_viewpost_thread', '<div id="post-$threadid" class="thread">\r\n<h2>$title $admin_control</h2>\r\n<div class="author-box-bg"></div>\r\n<div class="author-box">\r\n<ul class="author-details">\r\n<li class="avatar" title=''[lang:USER_NAME]''><div><a href=''mod.php?mod=users&modfile=info&userid=$userid''>$avatar_pic</a></div>\r\n<a href=''mod.php?mod=users&modfile=info&userid=$userid''>$username</a>\r\n<li title=''[lang:USER_GROUP]''>$usergroup\r\n<li title=''[lang:USER_RANK]''>$userrank\r\n<li title=''[lang:USER_POSTS_NO]''>$all_posts\r\n<li title=''[lang:USER_REG_DATE]''>$datetime\r\n</ul>\r\n</div>\r\n\r\n<div class="thread-block">\r\n<div class=''meta_info''>\r\n<span class="post_date">&nbsp;[lang:VIEWPOST_ARTICLE_DATEADDED]\r\n$date_added</span>\r\n<span class="post_readers">[lang:VIEWPOST_READERS] $readers </span>\r\n<span class="post_comments">[lang:VIEWPOST_COMMENTS] $comments_no\r\n</span>\r\n</div>\r\n<p>$post</p>\r\n<br>\r\n$attachment\r\n\r\n<fieldset style="padding: 2" class="signature">\r\n<legend><b>[lang:VIEWPOST_USER_SIGNATURE]</legend>\r\n<div align="center">\r\n$signature</div></fieldset>\r\n</div>\r\n</div>'),
(150, 0, 0, 23, 1, 7, 'forum', '', 'forum_index_bottom', '<div id="stat">\r\n<div id="top5">\r\n<div class="top-read"><h1>[lang:TOP_5_READ]</h1>\r\n$most_read\r\n</div>\r\n<div class="top-commented"><h1>[lang:TOP_5_COMMENTED]</h1>\r\n$most_commented\r\n</div>\r\n<div class="top-users"><h1>[lang:TOP_5_USERS]</h1>\r\n$top_users\r\n</div>\r\n<div class="top-cat"><h1>[lang:TOP_5_CATEGORIES]</h1>\r\n$active_categories\r\n</div>\r\n</div>\r\n<div id="last_10">\r\n<h1>[lang:LAST_10_POSTS]</h1>\r\n$last_10\r\n</div>\r\n<div style="clear:both"></div>\r\n</div>'),
(148, 1, 1, 0, 0, 7, 'forum', 'Default', '', ''),
(149, 0, 0, 23, 1, 7, 'forum', '', 'forum_index_cat_row', '<tr class="cat_row">\r\n<td class="cat_icon"><img border="0" src="<#mod_themepath#>/$cat_icon"></td>\r\n<td class="cat_title">\r\n<a href="mod.php?mod=forum&modfile=list&catid=$catid">$cat_title</a>\r\n<div class="small">$dsc</div>\r\n</td>\r\n<td class="cat_stat">\r\n<span class="threads" title="[lang:INDEX_LIST_THREADS]">$threads_number</span>\r\n<span class="comments" title="[lang:INDEX_LIST_REPLIES]">$replies_number</span>\r\n\r\n</td>\r\n<td class="cat_last_post">\r\n<a href="mod.php?mod=forum&modfile=viewpost&threadid=$lastpostid">$lasttitle </a><br>\r\n$lastpostd <br>\r\n[lang:INDEX_LIST_BY] <a href="mod.php?mod=users&modfile=info&userid=$lastposterid">$lastposter</a>\r\n<a href="mod.php?mod=forum&modfile=rss&catid=$catid&fullpage=1"><span class="rss" title="[lang:LATEST_POSTS_RSS]"></span></a></td>\r\n\r\n</tr>'),
(210, 0, 0, 32, 1, 8, 'news', '', 'news_block_admin', '<ul>\r\n<li><a href=mod.php?mod=news&dir=control>  [lang:BLOCKS_CONTROL_NEWS]</font></a>\r\n\r\n<li><a href=mod.php?mod=news&dir=control&modfile=addcat>  [lang:BLOCKS_ADDCAT]</a>\r\n\r\n<li><a href=mod.php?mod=news&dir=control&modfile=viewcat> [lang:BLOCKS_VIEW_EDIT]</a>\r\n\r\n<li><a href=mod.php?mod=news&dir=control&modfile=approve_posts> [lang:BLOCKS_UNAPPROVED_POSTS] ($waiting_posts)</a>\r\n\r\n<li><a href=mod.php?mod=news&dir=control&modfile=approve_comments> [lang:BLOCKS_UNAPPROVED_COMMENTS] ($waiting_comments)</a>\r\n</ul>'),
(209, 0, 0, 31, 1, 8, 'news', '', 'news_control_unapproved_comments_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$commentid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=news&modfile=editcomment&commentid=$commentid&newsid=$newsid><img border=0 src=<#mod_themepath#>/edit.gif></a>\r\n\r\n<a href=mod.php?mod=news&dir=control&modfile=misc&action=delete_comment&$commentid&newsid=$newsid><img border=0 src=<#mod_themepath#>/delete.png></a>\r\n</td>\r\n</tr>');
INSERT INTO `diy_modules_templates` (`id`, `main`, `themeid`, `temp_groupid`, `parent`, `modid`, `modname`, `theme`, `temp_title`, `template`) VALUES
(208, 0, 0, 31, 1, 8, 'news', '', 'news_control_unapproved_posts', '<form method="post" action="mod.php?mod=news&dir=control&modfile=approve_posts" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_POSTS_POSTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_POSTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_POSTS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_POSTS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_posts_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_POSTS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_POSTS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_POSTS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_POSTS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_POSTS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n<br><br>[lang:APPROVE_POSTS_MOVE_TO]<select name=''news_catid''>\r\n$options\r\n</option>\r\n<input type="submit" name="move"  value="[lang:APPROVE_POSTS_MOVE]">\r\n</form>'),
(207, 0, 0, 31, 1, 8, 'news', '', 'news_control_unapproved_comments', '<form method="post" action="mod.php?mod=news&dir=control&modfile=approve_comments" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_COMMENTS_COMMENTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_COMMENTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_COMMENTS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_COMMENTS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_posts_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_COMMENTS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_COMMENTS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_COMMENTS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_COMMENTS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_COMMENTS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n</form>'),
(206, 0, 0, 31, 1, 8, 'news', '', 'news_control_unapproved_posts_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$newsid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=news&modfile=editpost&newsid=$newsid><img border=0 src=<#mod_themepath#>/1/edit.gif></a>\r\n\r\n<a href=mod.php?mod=news&dir=control&modfile=misc&action=delete_post&newsid=$newsid><img border=0 src=<#mod_themepath#>/1/delete.png></a>\r\n</td>\r\n</tr>'),
(205, 0, 0, 31, 1, 8, 'news', '', 'news_control_viewcat', '<table class="data_table" border="1" width="90%" cellspacing="0" cellpadding="4" style="border-collapse: collapse">\r\n		<tr>\r\n<td colspan=3 class="table_header">[lang:CONTROL_CATEGORIES]</td>\r\n		</tr>\r\n<tr>\r\n<td class="table_division" width="70%">[lang:CONTROL_VIEWCAT_TITLE]</td>\r\n<td class="table_division">[lang:CONTROL_VIEWCAT_OPTIONS]</td>\r\n</tr>\r\n$news_row\r\n</table>'),
(203, 0, 0, 31, 1, 8, 'news', '', 'news_control_viewcat_row', '<tr>\r\n<td $tdcolor>$title</td>\r\n<td $tdcolor><a href=mod.php?mod=news&dir=control&modfile=edit_cat&catid=$catid><img border=0 src=<#mod_themepath#>/1/edit.gif></a>\r\n\r\n<a href=mod.php?mod=news&dir=control&modfile=misc&action=delete_cat&catid=$catid><img border=0 src=<#mod_themepath#>/1/delete.png></a>\r\n</td>\r\n</tr>'),
(204, 0, 0, 31, 1, 8, 'news', '', 'news_control_index', '<br><br>\r\n<table width=90%><tr><td align="center" width="25%">\r\n<a href="mod.php?mod=news&dir=control&modfile=addcat">\r\n<img border="0" src="<#mod_themepath#>/1/addcat.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=news&dir=control&modfile=viewcat">\r\n<img border="0" src="<#mod_themepath#>/1/viewcats.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=news&dir=control&modfile=approve_posts">\r\n<img border="0" src="<#mod_themepath#>/1/pending_posts.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=news&dir=control&modfile=approve_comments">\r\n<img border="0" src="<#mod_themepath#>/1/pending_posts.jpg"></a>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align="center">\r\n<a href="mod.php?mod=news&dir=control&modfile=addcat">\r\n[lang:CONTROL_ADD_NEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=news&dir=control&modfile=viewcat">\r\n[lang:CONTROL_EDIT_VIEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=news&dir=control&modfile=approve_posts">\r\n[lang:CONTROL_PENDING_POSTS]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=news&dir=control&modfile=approve_comments">\r\n[lang:CONTROL_PENDING_COMMENTS]</a>\r\n</td>\r\n</tr>\r\n</table>'),
(202, 0, 0, 30, 1, 8, 'news', '', 'news_cat_tools', '<div class="post_buttons">\r\n<a href="mod.php?mod=news&modfile=addpost" class="button">\r\n<div class="button">\r\n<span class="add_post">[lang:ADD_POST]</span></div></a>\r\n</div>'),
(198, 0, 0, 30, 1, 8, 'news', '', 'news_post_tools', '<div class="post_buttons">\r\n<a href="mod.php?mod=news&modfile=addpost" class="button">\r\n<div class="button">\r\n<span class="add_post">[lang:ADD_POST]<span>\r\n</div>\r\n</a>\r\n\r\n<a href="mod.php?mod=news&modfile=addcomment&newsid=$newsid&cat_id=$post_catid" class="button">\r\n<div class="button">\r\n<span class="add_comment">[lang:ADD_COMMENT]</span>\r\n</div>\r\n</a>\r\n</div>'),
(199, 0, 0, 30, 1, 8, 'news', '', 'news_errors_display', '<ul class="display_error">\r\n$errors\r\n</ul>'),
(200, 0, 0, 30, 1, 8, 'news', '', 'news_view_attachment', '<fieldset style="padding: 2px;">\r\n<legend><b>&nbsp;[lang:INCLUDES_FUNCTIONS_ATTACHMENT]&nbsp;</legend>\r\n<div align="center">\r\n<table width="100%" cellspacing="3" cellpadding="0" border="0" style="border-collapse: collapse;">\r\n$download\r\n</div>\r\n</table>\r\n</fieldset>\r\n<br>'),
(201, 0, 0, 30, 1, 8, 'news', '', 'news_view_comment', '<a name ="comment-<?php echo $commentid ?>"></a>\r\n<div id="comment-<?php echo $commentid ?>" class="comment">\r\n<div class="comment-details">\r\n\r\n<span class="comment_author"><?php echo $this->get_lang(''VIEWPOST_ARTICLE_BY'').$author ?></span>\r\n<span class="comment_date"><?php echo $this->get_lang(''VIEWPOST_ARTICLE_DATEADDED'') .$date ?></span>\r\n<?php\r\n        if (!$edit_perm) {\r\n            $style = ''display:none;'';\r\n        }\r\n?>\r\n\r\n\r\n<span class="comment-edit" style="<?php echo $style ?>"><a href="mod.php?mod=news&modfile=editcomment&commentid=<?php echo $commentid ?>&newsid=<?php echo $newsid ?>&cat_id=<?php echo $cat_id ?>"><?php echo $this->get_lang(''EDIT_COMMENT'') ?></a></span>\r\n</div>\r\n<div class="comment-content">\r\n<h4><?php echo $title ?></h4>\r\n<p><?php echo $comment ?></p>\r\n</div>\r\n</div>'),
(195, 0, 0, 30, 1, 8, 'news', '', 'news_list_topics_row', '<tr>\r\n\r\n<td class="alt1" width="40%">\r\n<a href="mod.php?mod=news&modfile=viewpost&newsid=$newsid">\r\n<font color="#34597D">$title</font> </a>$pagenum </td>\r\n<td class="alt2" align="center" width="20%">$name</td>\r\n<td class="alt1" align="center" width="20%">$date</td>\r\n<td class="alt2" align="center" width="10%">$readers</td>\r\n<td class="alt1" align="center" width="10%">$numrows</td>\r\n\r\n</tr>'),
(196, 0, 0, 30, 1, 8, 'news', '', 'news_list_topics', '<table border="1" width="95%" id="table4" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td class="table_header">[lang:LIST_TITLE]</td>\r\n		<td class="table_header">[lang:LIST_AUTHOR]</td>\r\n<td class="table_header">[lang:LIST_DATE_ADDED]</td>\r\n<td class="table_header">[lang:LIST_READERS]</td>\r\n		<td class="table_header">[lang:LIST_COMMENTS]</td>\r\n	</tr>\r\n\r\n	$list_row\r\n\r\n</table>'),
(197, 0, 0, 30, 1, 8, 'news', '', 'news_viewpost_post', '<div id="post-$newsid" class="post">	\r\n				<div class="postblock">\r\n					<h2>$title</h2>\r\n<div class="post_details">	\r\n<span class="post_author">\r\n[lang:VIEWPOST_ARTICLE_BY]\r\n\r\n$username</span>\r\n<span class="post_date">&nbsp;[lang:VIEWPOST_ARTICLE_DATEADDED]\r\n$date</span>\r\n<span class="post_readers">[lang:VIEWPOST_READERS] $readers </span>\r\n<span class="post_comments">[lang:VIEWPOST_COMMENTS] $comments_no\r\n</span>\r\n</div>\r\n<p>$post</p>\r\n<br>\r\n$attachment\r\n\r\n<span class="more"></span>\r\n				</div>\r\n			</div>\r\n\r\n<hr>'),
(192, 1, 1, 0, 0, 8, 'news', 'Default', '', ''),
(193, 0, 0, 30, 1, 8, 'news', '', 'news_index_cat', '<div class=''category''>\r\n<span class="category_image"><a href="mod.php?mod=news&modfile=list&catid=$catid"><center>$cat_image</a></span>\r\n<h3><a href="mod.php?mod=news&modfile=list&catid=$catid">$cat_title</a></h3>\r\n<span class="category_topics" title="[lang:POSTS_COUNT]">$numrows</span>\r\n<span class="category_comments" title="[lang:COMMENTS_COUNT]">$numcomment</span>\r\n<span class="category_desc">$dsc</span>\r\n</div>'),
(194, 0, 0, 30, 1, 8, 'news', '', 'news_list_post_head', '<div id="post-$newsid" class="post">	\r\n				<div class="postblock">\r\n					<h2><a title="$title" rel="bookmark" href="mod.php?mod=news&modfile=viewpost&newsid=$newsid">$title</a></h2>\r\n<div class="post_details">	\r\n<span class="post_author">\r\n[lang:VIEWPOST_ARTICLE_BY]\r\n$username</span>\r\n|<span class="post_time">[lang:VIEWPOST_ARTICLE_DATEADDED]</span>\r\n<span class="post_date">\r\n$date</span>\r\n<span class="post_readers">[lang:VIEWPOST_READERS] $readers </span>\r\n<span class="post_comments">[lang:VIEWPOST_COMMENTS] $comments_no\r\n</span>\r\n</div>\r\n<p>$post</p>\r\n<span class="more"></span>\r\n				</div>\r\n			</div>\r\n\r\n<hr>'),
(88, 1, 1, 0, 0, 9, 'web_directory', 'Default', '', ''),
(89, 0, 0, 14, 1, 9, 'web_directory', '', 'links_index_cat', '<div align="center">\r\n<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">\r\n	<tr>\r\n		<td align="center" width="100%" style="padding: 3"> \r\n<a href="mod.php?mod=web_directory&modfile=list&catid=$catid"><center>$cat_image</a></td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%" style="padding: 3"> <font class="fontht">\r\n		<a href="mod.php?mod=web_directory&modfile=list&catid=$catid"><center>$cat_title</a></font>\r\n		<br><span class="fontablt"><center>\r\n		<img border="0" src="images/topics.gif" align="middle" alt="Websites">\r\n		<font color="#C0C0C0">[$numrows]\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td width="100%" class="fontablt"><center><font color="#808080">$dsc</font></td>\r\n	</tr>\r\n</table>\r\n<center>\r\n<br>'),
(90, 0, 0, 14, 1, 9, 'web_directory', '', 'links_view_website', '<div align="center">\r\n	<table border="0" cellpadding="0" cellspacing="0" width="95%">\r\n		<tr>\r\n			<td width="17" bgcolor="#516A93"></td>\r\n			<td class="info_barff" width="100%" bgcolor="#516A93">\r\n			\r\n			<img border="0" src="<#mod_themepath#>/weblinkenter.png">&nbsp;\r\n			<a target="_blank" href="mod.php?mod=web_directory&modfile=misc&action=goto&linkid=$linkid">\r\n			<font color="#FFFFFF" size="4">$title </font></a></p>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</div>\r\n<div align="center">\r\n	<table border="0" width="95%" bgcolor="#ffffff" cellspacing="0" cellpadding="0">\r\n		<tr>\r\n			<td width="32%" valign="top" bgcolor="#F1F9FE">\r\n			<div align="center">\r\n				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" cellspacing="5">\r\n					<tr>\r\n						<td>\r\n						<p><font face="Tahoma" color="#800000">\r\n						<font class="fontablt"><font size="2">[lang:LIST_VIEW_WEBSITE_CLICKS] $clicks\r\n						</font></font><font size="2"><br>\r\n						[lang:LIST_VIEW_WEBSITE_RATE] $rating_avg&nbsp;&nbsp; <br>\r\n						<font class="fontablt">[lang:LIST_VIEW_WEBSITE_VOTES] $ratings</font> <br>\r\n						</font><font class="fontablt"><font size="2">[lang:LIST_VIEW_WEBSITE_BY] $name\r\n						</font></font></font></p>\r\n						</td>\r\n					</tr>\r\n				</table>\r\n			</div>\r\n			</td>\r\n			<td height="100%" valign="top">\r\n			<table border="0" cellpadding="0" cellspacing="0" width="100%">\r\n				<tr>\r\n					<td valign="top">\r\n					<div align="center">\r\n						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" cellspacing="5">\r\n							<tr>\r\n								<td>\r\n								<p ><font class="fontablt">$post</font>\r\n								</p>\r\n								</td>\r\n							</tr>\r\n						</table>\r\n					</div>\r\n					</td>\r\n				</tr>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="32%" valign="top" bgcolor="#F1F9FE">&nbsp;</td>\r\n			<td height="100%" valign="top" bgcolor="#F8F8F8">\r\n			<font face="Tahoma" size="2" color="#800000">&nbsp;\r\n			<img border="0" src="<#mod_themepath#>/world.png" width="12" height="12"><span lang="ar-iq"><font color="#800000">\r\n			<span style="text-decoration: none">\r\n			<a target="_blank" href="mod.php?mod=web_directory&modfile=misc&action=goto&linkid=$linkid">\r\n			<font color="#800000"><span style="text-decoration: none">[lang:LIST_VIEW_WEBSITE_VISIT]</span></font></a></span></font>&nbsp; \r\n			|&nbsp;\r\n			<img border="0" src="<#mod_themepath#>/chart_bar.png" width="12" height="12"></span><font color="#800000">\r\n			<span lang="ar-iq" style="text-decoration: none">\r\n			<a href="javascript:popup(''mod.php?mod=web_directory&modfile=misc&action=rate&fullpage=1&linkid=$linkid'',200,400)">\r\n			<font color="#800000"><span style="text-decoration: none">[lang:LIST_VIEW_WEBSITE_RATE_WEBSITE]</span></font></a></span></font><span lang="ar-iq">&nbsp; \r\n			|&nbsp;\r\n			<img border="0" src="<#mod_themepath#>/page_white_edit.png" width="12" height="12"></span><font color="#800000">\r\n			<span style="text-decoration: none">\r\n			<a href="mod.php?mod=web_directory&modfile=edit&linkid=$linkid"><span lang="ar-iq">\r\n			<font color="#800000"><span style="text-decoration: none">[lang:LIST_VIEW_WEBSITE_EDIT]</span></font></span></a></span></font></font></td>\r\n		</tr>\r\n	</table>\r\n</div>\r\n<hr color="#C0C0C0" width="95%" size="1">'),
(91, 0, 0, 14, 1, 9, 'web_directory', '', 'links_post_tools', '<table border="0" width="95%" id="table11" cellpadding="2">\r\n	<tr>\r\n		<td class="small">$pagenum</td>\r\n		<td align="left">\r\n\r\n<a href="mod.php?mod=web_directory&modfile=add"><img border=''0'' src="<#mod_themepath#>/add_link.gif"></a>\r\n	</tr>\r\n</table>'),
(92, 0, 0, 14, 1, 9, 'web_directory', '', 'links_breadcrumb', '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%">\r\n		<p class="catlinkfont"><font size="4">\r\n		<img border="0" src="<#mod_themepath#>/navbits_start.gif" width="21" height="21" align="middle">\r\n		<a href="index.php">$sitetitle</a> » <a href="mod.php?mod=web_directory">Links</a> » $nav_bits\r\n		</font></p>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(93, 0, 0, 14, 1, 9, 'web_directory', '', 'links_cat_tools', '<table border="0" width="95%" id="table11" cellpadding="2">\r\n	<tr>\r\n		<td class="small">$pagenum</td>\r\n		<td align="left">\r\n\r\n<a href="mod.php?mod=web_directory&modfile=add"><img border=''0'' src=''<#mod_themepath#>/add_link.gif''></a>\r\n\r\n</td>\r\n	</tr>\r\n</table>'),
(94, 0, 0, 14, 1, 9, 'web_directory', '', 'links_misc_rate_file', '<center>\r\n<b>[lang:MISC_RATE_LINK]</b>\r\n<form name="rate" method="post" action=mod.php?mod=web_directory&modfile=misc&action=rate&linkid=$linkid&fullpage=1>\r\n             <br>  <select name=rating>\r\n     	        <option value=5>5</option>\r\n		<option value=4>4</option>\r\n		<option value=3>3</option>\r\n		<option value=2>2</option>\r\n		<option value=1>1</option>\r\n			   </select>\r\n<input type="submit" name="submit" value="[global_lang:LANG_FORM_SUBMIT_BUTTON]"></form><br>\r\n</center>'),
(95, 0, 0, 15, 1, 9, 'web_directory', '', 'links_control_viewcat_row', '<tr>\r\n<td $tdcolor>$title</td>\r\n<td $tdcolor><a href=mod.php?mod=web_directory&dir=control&modfile=edit_cat&catid=$catid><img border=0 src="<#mod_themepath#>/edit_cat.gif"></a>\r\n\r\n<a href=mod.php?mod=web_directory&dir=control&modfile=misc&action=delete_cat&catid=$catid><img border=0 src="<#mod_themepath#>/delete.png"></a>\r\n</td>\r\n</tr>'),
(96, 0, 0, 15, 1, 9, 'web_directory', '', 'links_control_index', '<br><br>\r\n<table width=90%><tr><td align="center" width="25%">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=addcat">\r\n<img border="0" src="<#mod_themepath#>/addcat.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=viewcat">\r\n<img border="0" src="<#mod_themepath#>/viewcats.jpg"></a>\r\n</td>\r\n<td align="center" width="25%">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=approve_files">\r\n<img border="0" src="<#mod_themepath#>/pending_posts.jpg"></a>\r\n</tr>\r\n<tr>\r\n<td align="center">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=addcat">\r\n[lang:CONTROL_ADD_NEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=viewcat">\r\n[lang:CONTROL_EDIT_VIEW_CAT]</a>\r\n</td>\r\n<td align="center">\r\n<a href="mod.php?mod=web_directory&dir=control&modfile=approve_files">\r\n[lang:CONTROL_PENDING_POSTS]</a>\r\n</tr>\r\n</table>'),
(97, 0, 0, 15, 1, 9, 'web_directory', '', 'links_control_viewcat', '<table class="data_table" border="1" width="90%" cellspacing="0" cellpadding="4" style="border-collapse: collapse">\r\n		<tr>\r\n<td colspan=3 class="table_header">[lang:CONTROL_CATEGORIES]</td>\r\n		</tr>\r\n<tr>\r\n<td class="table_division" width="70%">[lang:CONTROL_VIEWCAT_TITLE]</td>\r\n<td class="table_division">[lang:CONTROL_VIEWCAT_OPTIONS]</td>\r\n</tr>\r\n$links_row\r\n</table>'),
(98, 0, 0, 15, 1, 9, 'web_directory', '', 'links_control_pending_links_row', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$linkid"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td>$username</td>\r\n\r\n<td><a href=mod.php?mod=web_directory&modfile=edit&linkid=$linkid><img border=0 src="<#mod_themepath#>/edit_cat.gif"></a>\r\n\r\n<a href=mod.php?mod=web_directory&dir=control&modfile=misc&action=delete_post&linkid=$linkid><img border=0 src="<#mod_themepath#>/delete.png"></a>\r\n</td>\r\n</tr>'),
(99, 0, 0, 15, 1, 9, 'web_directory', '', 'links_control_pending_links', '<form method="post" action="mod.php?mod=web_directory&dir=control&modfile=approve" name="admin">\r\n\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n		<td colspan="5" class="table_header">[lang:APPROVE_LINKS_POSTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="60%" class="table_division"><center>[lang:APPROVE_LINKS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_LINKS_AUTHOR]</td>\r\n<td width="15%"class="table_division"><center>[lang:APPROVE_LINKS_OPTIONS]</td>\r\n\r\n<tr>\r\n$approve_links_row\r\n</tr>\r\n</table>\r\n<br>\r\n<input type="button" name="CheckAll" value="[lang:APPROVE_LINKS_SELECT_ALL]" onclick="checkAll(document.admin)">\r\n\r\n<input type="button" name="UnCheckAll" value="[lang:APPROVE_LINKS_DESELECT_ALL]" onclick="uncheckAll(document.admin)" >\r\n\r\n<input type="submit" name="delete" value="[lang:APPROVE_LINKS_DELETE_SELECTED]"  onClick="if (!confirm(''[lang:APPROVE_LINKS_CONFIRM_DELETE]'')) return false;">\r\n\r\n<input type="submit" name="approve"  value="[lang:APPROVE_LINKS_APPROVE_SELECTED] ">\r\n\r\n<input type="hidden" name="cat_id" value="$catid">\r\n\r\n<br><br>[lang:APPROVE_LINKS_MOVE_TO]<select name=''new_catid''>\r\n$options\r\n</option>\r\n<input type="submit" name="move"  value="[lang:APPROVE_LINKS_MOVE]">\r\n</form>'),
(100, 0, 0, 16, 1, 9, 'web_directory', '', 'links_block_admin', '<ul>\r\n<li><a href=mod.php?mod=web_directory&dir=control>  [lang:BLOCKS_CONTROL_LINKS]</font></a>\r\n\r\n<li><a href=mod.php?mod=web_directory&dir=control&modfile=addcat>  [lang:BLOCKS_ADDCAT]</a>\r\n\r\n<li><a href=mod.php?mod=web_directory&dir=control&modfile=viewcat> [lang:BLOCKS_VIEW_EDIT]</a>\r\n\r\n<li><a href=mod.php?mod=web_directory&dir=control&modfile=approve_files> [lang:BLOCKS_PENDING_LINKS] ($waiting_posts)</a>\r\n\r\n</ul>'),
(104, 1, 1, 0, 0, 10, 'guestbook', 'Default', '', ''),
(105, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_index_sign_table', '<table border="0" width="100%" id="side_menu" cellspacing="0" cellpadding="0">\r\n	<tr>\r\n		<td bgcolor="#F1F1F1" style="padding-right: 5px" class="fontablt" colspan="3" width="100%">\r\n		<a href="mod.php?mod=guestbook&modfile=edit&sid=$sid">\r\n		<img border="0" src="themes/<#themepath#>/g_edit.gif" width="16" height="16"></a>\r\n		<a href="$website" target="_blank">\r\n		<img border="0" src="themes/<#themepath#>/home.gif" width="16" height="16"></a>\r\n		<a href="mailto:$email">\r\n		<img border="0" src="themes/<#themepath#>/email.gif" width="16" height="16"></a>\r\n		</td>$admin_select\r\n	</tr>\r\n	<tr>\r\n		<td bgcolor="#F9F9F9" style="padding-right: 5px" class="fontablt" colspan="3">\r\n		<font class="fontablt">$post <br>\r\n		<br>\r\n		</font></td>\r\n	</tr>\r\n	<tr>\r\n		<td bgcolor="#F1F1F1" style="padding-right: 5px" class="fontht2" colspan="3">\r\n		<font class="fontht2">Name: $name</font> </td>\r\n	</tr>\r\n</table>\r\n<br>'),
(106, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_index_top', '<p align=left>$add_sign</p>\r\n<form method="post" action="mod.php?mod=guestbook" name="admin">'),
(107, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_index_bottom', '<br>\r\n<center>\r\n$admin_bottom\r\n</center>\r\n</form>'),
(108, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_admin_top', '<form method="post" action="mod.php?mod=guestbook&dir=control&modfile=index" name="admin">'),
(109, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_admin_bottom', '<br>\r\n<center>\r\n<input type="button" name="CheckAll" value="[lang:CHECK_ALL]" onclick="checkAll(document.admin)">\r\n<input type="button" name="UnCheckAll" value="[lang:UNCHECK_ALL]" onclick="uncheckAll(document.admin)" >\r\n<input type="submit" name="delete" value="[lang:DELETE]" onClick="if (!confirm(''[lang:CONFIRM_DELETE]'')) return false;">\r\n<input type="submit" name="approve" value="[lang:APPROVE]">\r\n</center>\r\n</form>'),
(110, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_admin_sign_table', '<table border="0" width="100%" id="side_menu" cellspacing="0" cellpadding="0">\r\n	<tr>\r\n		<td bgcolor="#F1F1F1" style="padding-right: 5px" class="fontablt" colspan="3" width="100%">\r\n		<a href="mod.php?mod=guestbook&modfile=edit&sid=$sid">\r\n		<img border="0" src="themes/<#themepath#>/g_edit.gif" width="16" height="16"></a>\r\n		<a href="$website" target="_blank">\r\n		<img border="0" src="themes/<#themepath#>/home.gif" width="16" height="16"></a>\r\n		<a href="mailto:$email">\r\n		<img border="0" src="themes/<#themepath#>/email.gif" width="16" height="16"></a>\r\n		</td><td><INPUT TYPE="checkbox" name="select[]" VALUE="$sid"></td>\r\n	</tr>\r\n	<tr>\r\n		<td bgcolor="#F9F9F9" style="padding-right: 5px" class="fontablt" colspan="3">\r\n		<font class="fontablt">$post <br>\r\n		<br>\r\n		</font></td>\r\n	</tr>\r\n	<tr>\r\n		<td bgcolor="#F1F1F1" style="padding-right: 5px" class="fontht2" colspan="3">\r\n		<font class="fontht2">BY: $name</font> </td>\r\n	</tr>\r\n</table>\r\n<br>'),
(111, 0, 0, 17, 1, 10, 'guestbook', '', 'guestbook_block_admin', '<ul>\r\n<li><a href=mod.php?mod=guestbook&dir=control> [lang:PENDING_SIGN] ($waiting_posts)</a>\r\n</ul>'),
(174, 1, 1, 0, 0, 1, 'users', 'Default', '', ''),
(175, 0, 0, 26, 1, 1, 'users', '', 'users_index_list_row', '<tr class="user_row">\r\n<td class="user_id"> $userid</td>\r\n<td class="user_username"><a href="mod.php?mod=users&modfile=info&userid=$userid">$username</a></td>\r\n<td class="user_posts">$all_posts</td>\r\n<td class="user_date">$register_date</td>\r\n<td class="user_hotmail">$hotmail</td>\r\n<td class="user_yahoo">$yahoo</td>\r\n<td class="user_others"><a href=''$homepage'' target=_blank><img border=''0'' src=''<#mod_themepath#>/1/website.png''> </a>\r\n$aim\r\n$icq\r\n</td>\r\n</tr>'),
(176, 0, 0, 26, 1, 1, 'users', '', 'users_index_list', '<div align="center">\r\n$letters\r\n\r\n<div id="search_users">\r\n<span class="search">\r\n[lang:USERSEARCH] </span>\r\n<span class="search_form">\r\n<form method="get" action="mod.php">\r\n<input type="hidden" name="mod" value="users">\r\n<input type="hidden" name="action" value="msearch">\r\n<input type="text" name="membername" size="30">\r\n<input type="submit" value=[lang:SEARCH]>\r\n</form>\r\n</span>\r\n<div style="clear:both"></div>\r\n</div>\r\n\r\n<table id="users_list" cellspacing="0" cellpadding="2">\r\n<tr>\r\n<td class="header" width="2%">[lang:ID]</td>\r\n<td class="header" width="20%" >[lang:NAME]</td>\r\n<td class="header" width="10%">[lang:ALL_POSTS]</td>\r\n<td class="header" width="15%">[lang:REGISTRATION_DATE]</td>\r\n<td class="header" width="10%">[lang:HOTMAIL]</td>\r\n<td class="header" width="15%">[lang:YAHOO]</td>\r\n<td class="header" width="10%">[lang:OTHER]</td>\r\n</tr>\r\n$show_users_row\r\n<tr>\r\n<td class="bottom_row" colspan="7">\r\n\r\n<form action="mod.php" method="get">\r\n<input type="hidden" name="mod" value="users">\r\n[lang:ORDER_LIST] <select name="morder" size="1">\r\n<option value="userid" selected>[lang:ID]</option>\r\n<option value="username">[lang:NAME]</option>\r\n<option value="groupid">[lang:USER_GROUP]</option>\r\n<option value="all_posts">[lang:ALL_POSTS]</option>\r\n<option value="register_date">[lang:REG_DATE]</option>\r\n</select><select name="msort" size="1">\r\n<option value="DESC" selected>[lang:DESC]</option>\r\n<option value="ASC">[lang:ASC]</option>\r\n\r\n</select> \r\n<input type="submit" value="[lang:ORDER]">\r\n</form>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</div>'),
(114, 0, 0, 18, 2, 11, 'poll', '', 'poll_index_row', '<tr>\r\n<td class="poll_row"><center>$qid</center></td>\r\n<td class="poll_row"><a href="mod.php?mod=poll&modfile=view&qid=$qid">$question</a></td>\r\n<td class="poll_row">$date</td>\r\n$admin_select\r\n</tr>'),
(115, 0, 0, 18, 2, 11, 'poll', '', 'poll_index', '<p align=left>$add_poll</p>\r\n<form method="post" action="mod.php?mod=poll" name="admin">\r\n\r\n<table border=1 class="index_table">\r\n<tr>\r\n<td class="table_division" width="5%">[lang:ID]</td>\r\n<td class="table_division" width="43%">[lang:QUESTION]</td>\r\n<td class="table_division" width="43%">[lang:QUESTION_DATE]</td>\r\n$admin_cell\r\n</tr>\r\n$poll_row\r\n</table>\r\n<br>\r\n<center>\r\n$admin_bottom\r\n</center>\r\n</form>'),
(116, 0, 0, 18, 2, 11, 'poll', '', 'poll_view_question', '<p align=left>$add_poll</p>\r\n\r\n<table border="0" width="95%" id="table4" cellspacing="1" cellpadding="0">\r\n<tr>\r\n<td width="100%" class="form_header" colspan ="2">$question</td></tr>\r\n<tr><td class="forum_alt3">\r\n\r\n<FORM ACTION="mod.php?mod=poll&modfile=vote&qid=$qid" METHOD="post">\r\n<table border="0" width="100%" >\r\n\r\n$selection_top\r\n$option\r\n$selection_bottom\r\n\r\n\r\n<tr><td colspan="2" ><input class=button type="submit" name=submit value=Vote></center></td></tr>\r\n<tr><td colspan="2" class=article_info">\r\n<a href=mod.php?mod=poll&modfile=view&viewmode=viewresults&qid=$qid>[lang:VIEW_RESULTS]</a></td></tr>\r\n\r\n</form>\r\n</td></tr></table>\r\n\r\n</td></tr></table>'),
(117, 0, 0, 18, 2, 11, 'poll', '', 'poll_view_result', '<p align=left>$add_poll</p>\r\n\r\n<table border="0" width="95%" id="table4" cellspacing="1" cellpadding="0">\r\n<tr>\r\n<td width="100%" class="form_header">$question[question]</td></tr>\r\n<tr><td class="forum_alt3">\r\n\r\n<table border="0" width="100%" >\r\n<tr>\r\n<td colspan="4" class="forum_alt1" valign="top">\r\n\r\n</td></tr>\r\n\r\n$answer_row\r\n<tr><td colspan ="4"><center><font class=article_info>[lang:ALL_RESULTS] <b>$total</b>\r\n</td></tr></table>\r\n\r\n</td></tr></table>'),
(118, 0, 0, 18, 2, 11, 'poll', '', 'poll_view_answer_row', '<tr>\r\n            <td width=''35%''>$answer</td>\r\n            <td width=''45%''><img src="$imagebar" height=10 width=$barwidth></td>\r\n            <td width=''10%'' align=''center''>$resultpoll %</td>\r\n            <td width=''10%'' align=''center''>$row[result]</td>\r\n            </tr>'),
(119, 0, 0, 18, 2, 11, 'poll', '', 'poll_question_single', '<tr><td width=1%>\r\n<FONT class=article_info>\r\n<INPUT TYPE="radio" NAME="choice" VALUE="$aid"></FONT></td>\r\n<td><FONT class=article_info>$answer</FONT></td></tr>'),
(120, 0, 0, 18, 2, 11, 'poll', '', 'poll_question_multiple', '<tr><td width=1%><FONT class=article_info>\r\n<INPUT TYPE="checkbox" name="choice[]" VALUE="$aid"></FONT></td>\r\n<td><FONT class=article_info>$answer</FONT></td></tr>'),
(121, 0, 0, 18, 2, 11, 'poll', '', 'poll_question_selection', '<option value="$aid">$answer</option>'),
(122, 0, 0, 19, 2, 11, 'poll', '', 'poll_block_view_results', '<font class=article_info><center><b>$question[question]</b></center></font>\r\n\r\n\r\n$answer_row\r\n\r\n<center>\r\n<font class=article_info>[lang:ALL_RESULTS] <b>$total</b>\r\n</center>'),
(123, 0, 0, 19, 2, 11, 'poll', '', 'poll_block_answer_row', '<font class=article_info>$answer</font>\r\n<font class=article_info><img src="$imagebar" height=10 width=$barwidth>&nbsp;&nbsp;&nbsp;$resultpoll % ($row[result])</font>'),
(124, 0, 0, 19, 2, 11, 'poll', '', 'poll_block_view_question', '$question\r\n<br>\r\n\r\n<FORM ACTION="mod.php?mod=poll&modfile=vote&qid=$qid" METHOD="post">\r\n<table>\r\n$selection_top\r\n$option\r\n$selection_bottom\r\n</table>\r\n<center>\r\n<input  class=button type="submit" name=submit value=Vote>\r\n<a href=mod.php?mod=poll&modfile=view&viewmode=viewresults&qid=$qid>[lang:VIEW_RESULTS]</a>\r\n</center>\r\n</form>'),
(125, 1, 1, 0, 0, 12, 'pages', 'Default', '', ''),
(126, 0, 0, 20, 1, 12, 'pages', '', 'pages_index_pages_list', '<li><a href=mod.php?mod=pages&modfile=view&page=$title>$title</a>'),
(127, 0, 0, 20, 1, 12, 'pages', '', 'pages_index_pages', '<p align="right">\r\n$add_page\r\n</p>\r\n\r\n<ul>\r\n$list\r\n</ul>'),
(128, 0, 0, 20, 1, 12, 'pages', '', 'pages_admin_top', '<form method="post" action="mod.php?mod=pages&modfile=admin" name="admin">\r\n<table width="50%">'),
(129, 0, 0, 20, 1, 12, 'pages', '', 'pages_admin_bottom', '</table>\r\n<br>\r\n<center>\r\n<input type="button" name="CheckAll" value="[lang:CHECK_ALL]" onclick="checkAll(document.admin)">\r\n<input type="button" name="UnCheckAll" value="[lang:UNCHECK_ALL]" onclick="uncheckAll(document.admin)" >\r\n<input type="submit" name="delete" value="[lang:DELETE]" onClick="if (!confirm(''[lang:CONFIRM_DELETE]'')) return false;">\r\n<input type="submit" name="approve" value="[lang:APPROVE]">\r\n</center>\r\n</form>'),
(130, 0, 0, 20, 1, 12, 'pages', '', 'pages_admin_pending_list', '<tr>\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$id"></center></td>\r\n\r\n<td>$title</td>\r\n\r\n<td><a href=mod.php?mod=news&modfile=edit&page=$title><img border=0 src=<#mod_themepath#>/1/edit.gif></a>\r\n</td>\r\n</tr>'),
(131, 0, 0, 20, 1, 12, 'pages', '', 'pages_block_admin', '<ul>\r\n<li><a href=mod.php?mod=pages&modfile=add>[lang:ADD_PAGE]</a><br>\r\n<li><a href=mod.php?mod=pages&dir=control> [lang:PENDING_PAGES]($pending_posts)</a>\r\n</ul>'),
(132, 0, 0, 20, 1, 12, 'pages', '', 'pages_view_page', '$edit_page\r\n\r\n<p align="left">\r\n$title\r\n<br>\r\n$content\r\n</p>'),
(133, 1, 1, 0, 0, 13, 'contact-us', 'Default', '', ''),
(134, 0, 0, 21, 1, 13, 'contact-us', '', 'contact_read_message', '<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse" width="95%" bordercolor="#E4E4E4">\r\n	<tr>\r\n\r\n<td class="table_header">[lang:READ_MESSAGE]</td>\r\n		\r\n	</tr>\r\n<tr>\r\n<td class="table_division">Message by <big>$name</big>, Sent: $date</td>\r\n</tr>\r\n\r\n	<tr>\r\n		<td>$post</td>\r\n	</tr>\r\n	\r\n</table>\r\n<br>'),
(135, 0, 0, 21, 1, 13, 'contact-us', '', 'contact_buttons', '<style>\r\na.button{\r\nbackground:url(<#mod_themepath#>/button.gif);\r\ndisplay:inline-block;\r\ncolor:#555555;\r\nfont-weight:bold;\r\nheight:30px;\r\nline-height:29px;\r\nmargin-bottom:14px;\r\ntext-decoration:none;\r\nwidth:191px;\r\n}\r\na:hover.button{\r\ncolor:#0066CC;\r\n}\r\n\r\n\r\n.reply{\r\nbackground:url(<#mod_themepath#>/comments_add.png) no-repeat 10px 8px;\r\ntext-indent:40px;\r\ndisplay:block;\r\n}\r\n\r\n</style>\r\n<br><br>\r\n<div style="float: right">\r\n<a href="mod.php?mod=contact-us&dir=control&modfile=reply&mid=$mid" class="button">\r\n<span class="reply">[lang:REPLY_MESSAGE]</span>\r\n</a>\r\n</div>'),
(136, 0, 0, 21, 1, 13, 'contact-us', '', 'contact-us_admin_msg_row_pending', '<tr BGCOLOR ="#aed8f6">\r\n\r\n<td><center><INPUT TYPE="checkbox" name="select[]" VALUE="$id"></center></td>\r\n\r\n<td><a href="mod.php?mod=contact-us&dir=control&modfile=read_message&mid=$id">$title</a></td>\r\n\r\n<td>$name</td>\r\n\r\n<td>$date_added</td>\r\n\r\n</td>\r\n</tr>'),
(137, 0, 0, 21, 1, 13, 'contact-us', '', 'contact-us_admin_list', '<form method="post" action="mod.php?mod=contact-us&dir=control&modfile=index" name="admin">\r\n<table border="1" width="95%" cellspacing="0" cellpadding="3" style="border-collapse: collapse" bordercolor="#DAE9FE">\r\n	<tr>\r\n<td colspan="5" class="table_header">[lang:APPROVE_POSTS_POSTS_LIST]</td>\r\n</tr>\r\n<tr>\r\n<td width="5%" class="table_division"></td>\r\n<td width="30%" class="table_division"><center>\r\n[lang:APPROVE_POSTS_TOPIC]</td>\r\n<td width="20%" class="table_division"><center>[lang:APPROVE_POSTS_AUTHOR]</td>\r\n<td width="40%"class="table_division">\r\n<center>[lang:APPROVE_POSTS_DATE]</td>\r\n\r\n<tr>\r\n$manage_msg_row\r\n</tr>\r\n</table>'),
(138, 0, 0, 21, 1, 13, 'contact-us', '', 'contact-us_control_buttons', '<br>\r\n<center>\r\n<input type="button" name="CheckAll" value="[lang:CHECK_ALL]" onclick="checkAll(document.admin)">\r\n<input type="button" name="UnCheckAll" value="[lang:UNCHECK_ALL]" onclick="uncheckAll(document.admin)" >\r\n<input type="submit" name="delete" value="[lang:DELETE]" onClick="if (!confirm(''[lang:CONFIRM_DELETE]'')) return false;">\r\n<input type="submit" name="approve" value="[lang:APPROVE]">\r\n</center>\r\n</form>'),
(139, 0, 0, 21, 1, 13, 'contact-us', '', 'contact-us_admin_msg_row', '<tr>\r\n\r\n<td><center>\r\n<INPUT TYPE="checkbox" name="select[]" VALUE="$id"></center></td>\r\n\r\n<td><a href="mod.php?mod=contact-us&dir=control&modfile=read_message&mid=$id">$title</a></td>\r\n\r\n<td>$name</td>\r\n\r\n<td>$date_added</td>\r\n\r\n</td>\r\n</tr>'),
(140, 0, 0, 21, 1, 13, 'contact-us', '', 'contact-us_block_admin', '<ul>\r\n<li><a href=mod.php?mod=contact-us&dir=control>[lang:PENDING_MESSAGES]($waiting_posts)</a>'),
(141, 1, 1, 0, 0, 14, 'search', 'Default', '', ''),
(142, 0, 0, 22, 1, 14, 'search', '', 'search_index_form', '[template:search_css]\r\n\r\n<div align="center">\r\n<form enctype="multipart/form-data" name="search" method="post" action="mod.php?mod=search&modfile=index">\r\n\r\n<fieldset class="fieldset_title">\r\n<legend> [lang:INDEX_SEARCH_FORM_SEARCH]</legend>  \r\n<table class="form_table">\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_KEYWORDS]</td>\r\n<td class="second_cell"><input name="keywords" type="text" size="50"/></td>\r\n</tr>\r\n\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_TYPE]</td>\r\n<td class="second_cell">\r\n<input type="radio" value="and" name="type" checked>[lang:INDEX_SEARCH_FORM_AND] \r\n<input type="radio" value="or" name="type">[lang:INDEX_SEARCH_FORM_OR]\r\n</td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n\r\n<br>\r\n\r\n<fieldset class="fieldset_title">\r\n<legend> [lang:INDEX_SEARCH_FORM_SCOPE_OPTIONS] </legend>  \r\n<table class="form_table">\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_WHERE]</td>\r\n<td class="second_cell">\r\n<select name="scope">\r\n$scope\r\n</select>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_INCLUDE]</td>\r\n<td class="second_cell">\r\n<input type="checkbox" value="title" name="include[title]" checked>[lang:INDEX_SEARCH_FORM_TITLE]\r\n<input type="checkbox" value="post" name="include[post]" checked>[lang:INDEX_SEARCH_FORM_POST]\r\n</td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n<br>\r\n<fieldset class="fieldset_title">\r\n<legend> [lang:INDEX_SEARCH_FORM_SORTING_OPTIONS]</legend>  \r\n<table class="form_table">\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_FROM]</td>\r\n<td class="second_cell">\r\n<select name="from">\r\n<option value="86400">[lang:INDEX_SEARCH_FORM_YESTERDAY]</option>\r\n<option value="604800">[lang:INDEX_SEARCH_FORM_WEEK]</option>\r\n<option value="2678400" selected>[lang:INDEX_SEARCH_FORM_MONTH]</option>\r\n<option value="7862400">[lang:INDEX_SEARCH_FORM_3_MONTHS]</option>\r\n<option value="15724800">[lang:INDEX_SEARCH_FORM_6_MONTHS]</option>\r\n<option value="31536000">[lang:INDEX_SEARCH_FORM_YEAR]</option>\r\n<option value="0">[lang:INDEX_SEARCH_FORM_BEGINNING]</option>\r\n</select>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_MAX_DISPLAY]</td>\r\n<td class="second_cell">\r\n\r\n<select name="search_max">\r\n<option value="10">10</option>\r\n<option value="20">20</option>\r\n<option value="30" selected>30</option>\r\n<option value="40">40</option>\r\n<option value="50">50</option> </select>\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_SORT_BY]</td>\r\n<td class="second_cell">\r\n<select name="order">\r\n<option value="desc">[lang:INDEX_SEARCH_FORM_DATE]</option>\r\n<option value="asc">[lang:INDEX_SEARCH_FORM_COMMENTS]</option>\r\n<option value="asc">[lang:INDEX_SEARCH_FORM_READERS]</option>\r\n<option value="asc">[lang:INDEX_SEARCH_FORM_AUTHOR]</option>\r\n</select>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td class="first_cell">[lang:INDEX_SEARCH_FORM_ORDER_BY]</td>\r\n<td class="second_cell">\r\n<select name="sort">\r\n<option value="desc">[lang:INDEX_SEARCH_FORM_DESC]</option>\r\n<option value="asc">[lang:INDEX_SEARCH_FORM_ASC]</option>\r\n</select>\r\n</td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n\r\n<br>\r\n<input type="submit" name="submit" value="[lang:INDEX_SEARCH_SEARCH] ">\r\n<br>\r\n\r\n\r\n</form>\r\n</div>'),
(143, 0, 0, 22, 1, 14, 'search', '', 'search_results_table_row', '<tr>\r\n<td><a href="$link">$title</a></td>\r\n<td><center>$scope</center></td>\r\n<td><center>$username</center></td>\r\n</tr>'),
(144, 0, 0, 22, 1, 14, 'search', '', 'search_results_table', '[template:search_css]\r\n\r\n<table width="100%" class="search_table">\r\n<tr class="table_header">\r\n<td>[lang:INDEX_SEARCH_TITLE]</td>\r\n<td>[lang:INDEX_SEARCH_MODULE]</td>\r\n<td>[lang:INDEX_SEARCH_BY]</td>\r\n</tr>\r\n$results_rows\r\n</table>'),
(145, 0, 0, 22, 1, 14, 'search', '', 'search_results_single_module_table', '[template:search_css]\r\n\r\n<table width="100%" class="search_table">\r\n<tr class="table_header">\r\n<td>[lang:INDEX_SEARCH_TITLE]</td>\r\n<td>[lang:INDEX_SEARCH_BY]</td>\r\n</tr>\r\n$results_rows\r\n</table>'),
(146, 0, 0, 22, 1, 14, 'search', '', 'search_results_single_module_row', '<tr>\r\n<td><a href="$link">$title</a></td>\r\n<td>$username</td>\r\n</tr>'),
(147, 0, 0, 22, 1, 14, 'search', '', 'search_css', '<style>\r\n.fieldset_title {\r\nwidth: 70%;\r\n}\r\n\r\n.fieldset_title legend {\r\n font-family: Tahoma;\r\n font-size: 10pt;\r\ncolor: #000000;\r\n background-color: #ffffff;\r\nfont-weight: bold;\r\npadding: 0 5px;\r\n}\r\n\r\n.form_table {\r\nwidth: 95%;\r\n}\r\n\r\n.form_table td {\r\npadding: 7px; \r\n}\r\n\r\n.first_cell{\r\n font-family: Tahoma;\r\n font-size: 9pt;\r\ncolor: #000000;\r\n background-color: #ffffff;\r\nwidth: 35%;\r\n}\r\n\r\n.second_cell{\r\nfont-family: Tahoma;\r\nfont-size: 9pt;\r\ncolor: #000000;\r\nbackground-color: #ffffff;\r\nwidth: 65%;\r\n}\r\n\r\n.search_table {\r\nborder-collapse: collapse;\r\nborder: 1px outset black;\r\n}\r\n\r\n.search_table td {\r\npadding: 5px;\r\n font-family: Tahoma;\r\n font-size: 9pt;\r\ncolor: #000000;\r\n}\r\n</style>');

-- --------------------------------------------------------

--
-- Table structure for table `diy_module_tempgroup`
--

CREATE TABLE IF NOT EXISTS `diy_module_tempgroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The incremental id of the table',
  `modid` int(11) NOT NULL COMMENT 'The module id under which a template group is placed',
  `themeid` int(11) NOT NULL COMMENT 'The theme id under which the template group is placed',
  `title` text COLLATE utf8_bin NOT NULL COMMENT 'The title of the template group',
  `desc` longtext COLLATE utf8_bin NOT NULL COMMENT 'This is the description of the group',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This table defines the template groups for ease of navigatio' AUTO_INCREMENT=36 ;

--
-- Dumping data for table `diy_module_tempgroup`
--

INSERT INTO `diy_module_tempgroup` (`groupid`, `modid`, `themeid`, `title`, `desc`) VALUES
(27, 1, 1, 'control', ''),
(26, 1, 1, 'Main', 'This group contains the main templates'),
(5, 6, 1, 'Main', ''),
(6, 6, 1, 'control', 'All the templates under this group belong to the files in the control folder'),
(7, 6, 1, 'Blocks', 'Templates under this group are for blocks folder'),
(25, 7, 1, 'Blocks', 'Templates under this group are for blocks folder'),
(23, 7, 1, 'Main', ''),
(24, 7, 1, 'control', 'All the templates under this group belong to the files in the control folder'),
(32, 8, 1, 'Blocks', 'Templates under this group are for blocks folder'),
(30, 8, 1, 'Main', ''),
(31, 8, 1, 'control', 'All the templates under this group belong to the files in the control folder'),
(14, 9, 1, 'Main', ''),
(15, 9, 1, 'control', 'All the templates under this group belong to the files in the control folder'),
(16, 9, 1, 'Blocks', 'Templates under this group are for blocks folder'),
(17, 10, 1, 'Main', ''),
(18, 11, 2, 'Main', ''),
(19, 11, 2, 'poll_block', 'This group is for the templates of the poll block'),
(20, 12, 1, 'Main', ''),
(21, 13, 1, 'Main', ''),
(22, 14, 1, 'Main', ''),
(28, 1, 1, 'private_message', ''),
(29, 1, 1, 'blocks', '');

-- --------------------------------------------------------

--
-- Table structure for table `diy_news`
--

CREATE TABLE IF NOT EXISTS `diy_news` (
  `newsid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `post` longtext,
  `allow` char(3) NOT NULL DEFAULT '',
  `readers` int(10) DEFAULT '0',
  `comments_no` int(10) DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `rating_total` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `lastuserid` int(11) NOT NULL DEFAULT '0',
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `edit_by` varchar(255) NOT NULL DEFAULT '0',
  `editor_type` varchar(255) NOT NULL,
  `closed` int(1) NOT NULL,
  PRIMARY KEY (`newsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `diy_news`
--

INSERT INTO `diy_news` (`newsid`, `userid`, `cat_id`, `username`, `title`, `date_added`, `post`, `allow`, `readers`, `comments_no`, `status`, `rating_total`, `ratings`, `lastuserid`, `uploadfile`, `edit_by`, `editor_type`, `closed`) VALUES
(1, 1, 1, 'admin', 'Test post', 1249996876, '[u][b]This post is for testing purposes only[/b]. [i]You can edit or delete this post.[/i][/u]', 'yes', 156, 0, 1, 0, 0, 0, 0, '', '', 0),
(3, 1, 1, 'admin', 'test', 1295768060, 'test', 'yes', 6, 0, 1, 0, 0, 0, 0, '0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diy_news_cat`
--

CREATE TABLE IF NOT EXISTS `diy_news_cat` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `dsc` text NOT NULL,
  `dscin` text NOT NULL,
  `countopic` int(10) NOT NULL DEFAULT '0',
  `countcomm` int(10) NOT NULL DEFAULT '0',
  `lastpostid` int(11) NOT NULL DEFAULT '0',
  `grouppost` varchar(200) NOT NULL DEFAULT '0',
  `groupview` varchar(200) NOT NULL DEFAULT '0',
  `cat_email` varchar(255) DEFAULT NULL,
  `closed` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diy_news_cat`
--

INSERT INTO `diy_news_cat` (`catid`, `cat_order`, `parent`, `cat_title`, `dsc`, `dscin`, `countopic`, `countcomm`, `lastpostid`, `grouppost`, `groupview`, `cat_email`, `closed`) VALUES
(1, 0, 0, 'قسم تجريبي', 'هذا القسم هو للتجربة فقط', '', 3, 0, 3, '1,2,3,4,5', '1,2,3,4,5', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `diy_news_comments`
--

CREATE TABLE IF NOT EXISTS `diy_news_comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `newsid` int(10) NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `editor_type` varchar(255) NOT NULL DEFAULT '0',
  `allow` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_news_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_online`
--

CREATE TABLE IF NOT EXISTS `diy_online` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `onlineip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `onlinefile` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `onlinepage` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `onlineSID` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_online` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `useronlineid` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`onlineSID`),
  KEY `timestamp` (`timestamp`),
  KEY `user_online` (`user_online`),
  KEY `id` (`id`),
  KEY `onlineip` (`onlineip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_online`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_plugins`
--

CREATE TABLE IF NOT EXISTS `diy_plugins` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `plugin_modules` text COLLATE utf8_bin NOT NULL,
  `plugin_usergroups` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT 'The groups to which the plugin will apply',
  `plugin_status` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `diy_plugins`
--

INSERT INTO `diy_plugins` (`plugin_id`, `plugin_name`, `plugin_modules`, `plugin_usergroups`, `plugin_status`) VALUES
(1, 'anti-spam', '1,6,7,8,9,10,11,12,13,14', '3,4,5', 'enabled'),
(2, 'image-resizer', 'index,1,6,7,8,9,10,11,12,13,14', '1,2,3,4,5', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `diy_plugins_settings`
--

CREATE TABLE IF NOT EXISTS `diy_plugins_settings` (
  `set_id` int(9) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(9) NOT NULL,
  `plugin_name` varchar(225) COLLATE utf8_bin NOT NULL,
  `text` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `variable` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `value` text COLLATE utf8_bin,
  `order` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `custom` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `diy_plugins_settings`
--

INSERT INTO `diy_plugins_settings` (`set_id`, `plugin_id`, `plugin_name`, `text`, `variable`, `value`, `order`, `type`, `custom`) VALUES
(1, 1, 'anti-spam', 'PROTECTION_TYPE', 'protection_type', 'calc', 0, 2, ''),
(2, 1, 'anti-spam', 'NUMBER_RANGE', 'number_range', '1-10', 1, 6, ''),
(3, 1, 'anti-spam', 'CALCULATION_TYPES', 'calculation_types', 'addition,subtraction,multiply,division', 2, 1, ''),
(4, 1, 'anti-spam', 'SENTENCES', 'sentences', 'I am not a robot\r\nI am a human', 3, 4, ''),
(5, 2, 'image-resizer', 'MIN_WIDTH_RESIZE', 'min_width_resize', '600', 0, 6, ''),
(6, 2, 'image-resizer', 'MIN_HEIGHT_RESIZE', 'min_height_resize', '600', 1, 6, ''),
(7, 2, 'image-resizer', 'RESIZE_PERCENTAGE', 'resize_percentage', '0.45', 2, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `diy_poll_answers`
--

CREATE TABLE IF NOT EXISTS `diy_poll_answers` (
  `aid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Answer id',
  `qid` int(10) NOT NULL COMMENT 'Parent question id',
  `answer` text COLLATE utf8_bin NOT NULL COMMENT 'Answer to the question',
  `result` int(10) NOT NULL COMMENT 'Result of the answer',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_poll_answers`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_poll_questions`
--

CREATE TABLE IF NOT EXISTS `diy_poll_questions` (
  `qid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Question id',
  `question` text COLLATE utf8_bin NOT NULL COMMENT 'poll question',
  `type` text COLLATE utf8_bin NOT NULL COMMENT 'poll type (multiple or single choice)',
  `status` text COLLATE utf8_bin NOT NULL COMMENT 'poll status (active or inactive)',
  `date` int(16) NOT NULL COMMENT 'The date the poll was added',
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_poll_questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_search`
--

CREATE TABLE IF NOT EXISTS `diy_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `keywords` varchar(225) COLLATE utf8_bin NOT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `from` int(11) NOT NULL,
  `max_view` int(10) NOT NULL,
  `scope` varchar(225) COLLATE utf8_bin NOT NULL,
  `text_part` varchar(15) COLLATE utf8_bin NOT NULL,
  `timestamp` int(11) NOT NULL,
  `user_ip` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Search table' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_search`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_sessions`
--

CREATE TABLE IF NOT EXISTS `diy_sessions` (
  `ses_id` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ses_time` int(11) NOT NULL DEFAULT '0',
  `ses_start` int(11) NOT NULL DEFAULT '0',
  `ses_value` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ses_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `diy_sessions`
--

-- --------------------------------------------------------

--
-- Table structure for table `diy_settings`
--

CREATE TABLE IF NOT EXISTS `diy_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `modulname` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `titletype` int(10) NOT NULL DEFAULT '0',
  `settingtype` int(2) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `variable` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `value` text COLLATE utf8_bin,
  `options` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `diy_settings`
--

INSERT INTO `diy_settings` (`id`, `modulname`, `titletype`, `settingtype`, `title`, `variable`, `value`, `options`) VALUES
(1, '0', 1, 1, 'SETTINGS_SITE_TITLE', 'sitetitle', 'المجلة السهلة', 30),
(2, '0', 1, 1, 'SETTINGS_ADMIN_EMAIL', 'sitemail', 'info@webmaster.com', 30),
(3, '0', 1, 1, 'SETTINGS_SITE_URL', 'siteURL', 'http://localhost/diy_test', 30),
(4, '0', 0, 2, 'SETTINGS_DATE_TYPE', 'date_type', 'gregorian', 5),
(5, '0', 1, 0, 'SETTINGS_UPLOAD_PATH', 'upload_path', 'upload', 0),
(6, '0', 0, 0, 'MAIN_MODULE', 'main_module', 'index_template', 0),
(7, '0', 0, 0, 'INDEX_MENUID', 'index_menuid', '1,2,3,38,39', 0),
(8, '0', 1, 2, 'SETTINGS_HOURS_GM', 'dtimehour', '0', 4),
(9, '0', 1, 7, 'SETTINGS_KEYWORDS', 'keywords', 'المجلة السهلة', 20),
(10, '0', 1, 7, 'SETTINGS_DESCRIPTION', 'Description', 'المجلة السهلة الإصدار 1.0 2010', 40),
(11, '0', 0, 1, 'SETTINGS_TURN_OFF', 'turn_off', '0', 3),
(12, '0', 1, 1, 'SETTINGS_TURN_OFF_MSG', 'turn_off_msg', 'الموقع مغلق حالياً. الرجاء زيارتنا لاحقاً', 50),
(13, '0', 10, 0, 'SETTINGS_SELECT_THEME', 'theme', '8', 0),
(14, '0', 4, 6, 'SETTINGS_CENSORED_WORDS', 'bad_words', '', 6),
(15, '0', 4, 6, 'SETTINGS_BANED_IP', 'ban_ip', '', 6),
(16, '0', 0, 0, '0', 'admin_note', 'ضع ما تريده من ملاحظات هنا للرجوع إليها لاحقاً', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diy_smileys`
--

CREATE TABLE IF NOT EXISTS `diy_smileys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `smile` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `smilename` varchar(75) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Dumping data for table `diy_smileys`
--

INSERT INTO `diy_smileys` (`id`, `code`, `smile`, `smilename`) VALUES
(1, ':TON:', 'tongue.gif', 'TO'),
(2, ':COO:', 'cool.gif', 'cool'),
(3, ':DRY:', 'dry.gif', 'dry'),
(5, ':MAD:', 'mad.gif', 'mad'),
(6, ':WOW:', 'ohmy.gif', 'ohmy'),
(7, ':HuH:', 'huh.gif', 'huh'),
(8, ':SAD:', 'sad.gif', 'sad'),
(9, ':SMI:', 'smile.gif', 'smile'),
(11, ':WUB:', 'wub.gif', 'wub');

-- --------------------------------------------------------

--
-- Table structure for table `diy_spam`
--

CREATE TABLE IF NOT EXISTS `diy_spam` (
  `spamip` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `spamtable` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `spamtime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`spamip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `diy_spam`
--

-- --------------------------------------------------------

--
-- Table structure for table `diy_subscriptions`
--

CREATE TABLE IF NOT EXISTS `diy_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Subscription id',
  `userid` int(11) NOT NULL COMMENT 'User id',
  `postid` int(11) NOT NULL COMMENT 'Post id',
  `alert_sent` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Tells whether an alert has been sent to the user',
  `module` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'The name of the module to apply the subscription to',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_subscriptions`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_templates`
--

CREATE TABLE IF NOT EXISTS `diy_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeid` int(11) NOT NULL,
  `theme` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `temptype` int(2) NOT NULL DEFAULT '0',
  `template` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=233 ;

--
-- Dumping data for table `diy_templates`
--

INSERT INTO `diy_templates` (`id`, `themeid`, `theme`, `name`, `temptype`, `template`) VALUES
(196, 6, 'Twitter', 'pagination_last', 24, '</tr></table>'),
(197, 6, 'Twitter', 'pagination_first_page', 24, '<td class=fontht><b><a title="الصفحة الأولى" href=<?php echo $link ?>&start=0&page=1>«</a></td>'),
(198, 6, 'Twitter', 'pagination_available_pages', 24, '<td class=fontht><a href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $i ?>"><?php echo $i ?></a></td>'),
(199, 6, 'Twitter', 'pagination_next_page', 24, '<td><font class=fontht><a title=Next Page href="<?php echo $link ?>&start=<?php echo $nextstart ?>&page=<?php echo $nextpage ?>"> ></a></font></td>'),
(200, 6, 'Twitter', 'pagination_last_page', 24, '<td><font class=fontht><a title="Last Page" href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $pages ?>"> »</a></font></td>'),
(193, 6, 'Twitter', 'pagination_start', 24, '<table class=''pa'' border=''0''><tr><td><div class=''currentpage''><b>الصفحات </div></td>'),
(194, 6, 'Twitter', 'pagination_current_page', 24, '<td class=fontht><div class=''currentpage''><center><b><?php echo $i ?></b> \r\n</div></td>'),
(195, 6, 'Twitter', 'pagination_previous_page', 24, '<td class=fontht><a title="previous page" href="<?php echo $link ?>&start=<?php echo $prestart ?>&page=<?php echo $prepage ?>"><</a></td>'),
(189, 6, 'Twitter', 'form_textarea_message', 22, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>:</td>\r\n            <td align=right width="100%"><font color="#FF0000">*</font><textarea dir=rtl name=<?php echo $names ?> rows=<?php echo $rows ?>cols=<?php echo $cols ?> id="<?php echo $names ?>"  wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(190, 6, 'Twitter', 'form_yesorno', 22, '<tr><td nowrap class="info_bar"><?php echo $title ?></td><td  width="100%">\r\n<?php echo $option ?>\r\n</td></tr>'),
(191, 6, 'Twitter', 'form_group_checkbox', 22, '<tr><td nowrap class="info_bar" ><?php echo $msg ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(192, 6, 'Twitter', 'standard_menu', 23, '<div class="widget Label">												<h2>{block_head}</h2>\r\n<div class="widget-content">\r\n{block_center}<br>\r\n</div>\r\n</div>'),
(188, 6, 'Twitter', 'form_textareahead', 22, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>: <font color="#FF0000">*</font></td>\r\n<td align=right width="100%"><textarea dir=rtl name="post_head" rows="8" cols="60"onkeypress="return countIt();"><?php echo $value ?></textarea></td></tr>'),
(184, 6, 'Twitter', 'form_edit_upload', 22, '<tr>\r\n             <td nowrap class="info_bar">المرفقات</td>\r\n            <td width="100%">\r\n            <?php echo $attachment ?>\r\n</td></tr>'),
(185, 6, 'Twitter', 'form_inputform', 22, '<tr><td nowrap class="info_bar"><?php echo $title .":". $full ?></td>\r\n				<td width="100%">\r\n				<input type="<?php echo "$type\\" name=''$name'' value=''$value'' size=$size"; ?>" class="text_box">\r\n				</td>\r\n				</tr>'),
(186, 6, 'Twitter', 'form_selectform', 22, '<tr><td nowrap class="info_bar"><?php echo $title.$full ?></td>\r\n<td><select name="<?php echo $name ?>">\r\n<?php echo $option ?>\r\n</select></td></tr>'),
(187, 6, 'Twitter', 'form_textarea_post', 22, '<tr><td nowrap class="info_bar" valign="top"><?php echo $title .":". $full.$smiles ?>\r\n<br><center>[global_lang:LANG_FORM_TEXTAREA_LENGTH]<br><?php echo $letter_count ?> [global_lang:LANG_FORM_TEXTAREA_CHARCHTERS]<br><br>\r\n<center>[global_lang:LANG_FORM_TEXTAREA_REMAIN]<input readonly type=text name=remLen size=5 maxlength=5 value="<?php echo $letter_count ?>">  <center> </td>\r\n\r\n\r\n<td width="100%"><?php echo $bbcode ?><textarea name="<?php echo $name ?>"\r\nonKeyDown="textCounter(this.form.<?php echo $name ?>,this.form.remLen,<?php echo $letter_count ?>);" onKeyUp="textCounter(this.form.<?php echo $name?>,this.form.remLen,<?php echo $letter_count ?>);"  rows=<?php echo $rows ?> cols=<?php echo $cols ?> id="post" wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(179, 6, 'Twitter', 'footer', 21, '<div id="footer">\r\nالثيم الأصلي مصمم من قبل <a target="_blank" href="http://www.freshsites.com/">Fresh Sites</a> | باستعمال <a href="http://arabic.diy-cms.com/">المجلة السهلة</a>\r\n</div>'),
(180, 6, 'Twitter', 'form_table', 22, '<form action="<?php echo $form[action] ?>" method="<?php echo $form[method] ?>" name="<?php echo $form[name] ?>" enctype="multipart/form-data">\r\n\r\n	<table border="1" width="90%" cellspacing="0" cellpadding="0">\r\n<tr><td>\r\n		<table border=0 width="100%" cellspacing="1" cellpadding="3">\r\n		<tr>\r\n			<td colspan=2 align="center" class="form_header"><?php echo $form[title] ?></td>\r\n		</tr>\r\n<?php echo $form[content]; ?>\r\n\r\n			<tr>	\r\n			<td colspan=2 align="center">\r\n			<?php echo $submit_button ?>\r\n</td>\r\n		</tr>\r\n</table>\r\n</td></tr>\r\n	</table>\r\n</form>'),
(181, 6, 'Twitter', 'form_checkbox_selection', 22, '<tr><td nowrap class="info_bar" ><?php echo $title ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(182, 6, 'Twitter', 'form_delete', 22, '<tr><td nowrap class="info_bar">\r\n[global_lang:LANG_EDIT_UPLOAD_DELETE_ATTACHMENT]</td><td width=100%>\r\n         <input type="checkbox"  name="<?php echo $name ?>" value=''1''>\r\n         </td></tr>'),
(183, 6, 'Twitter', 'form_bbcode', 22, '<div class="toolbar">\r\n	<table border="0" cellpadding="0" style="border-collapse: collapse; border:0px solid #000; display:inline;">\r\n		<tr>\r\n			<td>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''face''); this.selectedIndex = 0;" style="width:100px; height:21px">\r\n					<option value="Arial">Arial</option>\r\n<option value="Arial Black">Arial Black</option>\r\n<option value="Arial Narrow">Arial Narrow</option>\r\n<option value="Comic Sans MS">Comic Sans MS</option>\r\n<option value="Courier New">Courier New</option>\r\n<option value="System">System</option>\r\n<option value="Tahoma">Tahoma</option>\r\n<option value="Times New Roman">Times New Roman</option>\r\n<option value="Simplified Arabic">Simplified Arabic</option>\r\n<option value="Verdana">Verdana</option>\r\n<option value="Wingdings">Wingdings</option>\r\n<option value="MS Sans Serif">MS Sans Serif</option>\r\n</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''size''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n					<option value="" selected="selected">[global_lang:FORM_BBCODE_SIZE]</option>\r\n					<option value="10" style="font-size:10pt">10 pt</option>\r\n					<option value="12" style="font-size:12pt">12 pt</option>\r\n					<option value="14" style="font-size:14pt">14 pt</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''align''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_ALIGN]</option>\r\n			<option value="justify" style="text-align: justify">[global_lang:FORM_BBCODE_ALIGN_JUSTIFY]</option>\r\n			<option value="left" style="text-align: left">[global_lang:FORM_BBCODE_ALIGN_LEFT]</option>\r\n			<option value="right" style="text-align: right">[global_lang:FORM_BBCODE_ALIGN_RIGHT]</option>\r\n			<option value="center" style="text-align: center">[global_lang:FORM_BBCODE_ALIGN_CENTER]</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''color''); this.selectedIndex = 0;" style="width:80px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_COLOR]</option>\r\n			<option value="#F00" style="background-color:#F00; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_RED]</option>\r\n			<option value="#F80" style="background-color:#F80; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_ORANGE]</option>\r\n					<option value="#FF0" style="background-color:#FF0; color:#000;">[global_lang:FORM_BBCODE_COLOR_YELLOW]</option>\r\n					<option value="#0F0" style="background-color:#0F0; color:#000;">[global_lang:FORM_BBCODE_COLOR_LIME]</option>\r\n					<option value="#080" style="background-color:#080; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_GREEN]</option>\r\n					<option value="#0FF" style="background-color:#0FF; color:#000;">[global_lang:FORM_BBCODE_COLOR_CYAN]</option>\r\n					<option value="#00F" style="background-color:#00F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_BLUE]</option>\r\n					<option value="#80F" style="background-color:#80F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_INDIGO]</option>\r\n					<option value="#808" style="background-color:#808; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_VIOLET]</option>\r\n					<option value="#F0F" style="background-color:#F0F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_MAGENTA]</option>\r\n				</select>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</div>\r\n\r\n\r\n<div class="toolbar">\r\n\r\n\r\n<img src="html/bbcode/bold.gif" onclick="addtag(''b'')" class="bbcode_button" />\r\n<img src="html/bbcode/italic.gif" onclick="addtag(''i'')" class="bbcode_button" />\r\n<img src="html/bbcode/underline.gif" onclick="addtag(''u'')" class="bbcode_button" />\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n<img src="html/bbcode/createlink.gif" onclick="addurltag(''website'')" class="bbcode_button" alt="Create Link" />\r\n	<img src="html/bbcode/separator.gif" />\r\n<img src="html/bbcode/media.gif" onclick="addurltag(''media'')" class="bbcode_button" alt="Add media content" />\r\n<img src="html/bbcode/flash.gif" onclick="addurltag(''flash'')" class="bbcode_button" alt="Add flash content" />\r\n\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n	<img src="html/bbcode/code.gif" onclick="addtag(''code'')" class="bbcode_button" alt="Code" />\r\n	<img src="html/bbcode/quote.gif" onclick="addtag(''quote'')" class="bbcode_button" alt="Add a quote" />\r\n\r\n	<img src="html/bbcode/php.gif" onclick="addtag(''php'')" class="bbcode_button" alt="PHP" />\r\n<img src="html/bbcode/separator.gif" />\r\n	<img src="html/bbcode/hr.gif" onclick="addtag(''hr'',true)" class="bbcode_button" />\r\n</div>'),
(178, 6, 'Twitter', 'header', 21, '<div id="header-wrapper">\r\n<div id="navWrapper">\r\n  <div id="nav">\r\n    <ul>\r\n      <li> <a href="index.php">الرئيسية</a> </li>\r\n      <li><a href="mod.php?mod=forum">المنتديات</a> </li>\r\n      <li> <a href="mod.php?mod=news">الأخبار</a></li>\r\n      <li> <a href="mod.php?mod=download">مركز التحميل</a></li>\r\n      <li> <a href="mod.php?mod=web_directory">دليل المواقع</a> </li>\r\n      <li> <a href="mod.php?mod=guestbook">سجل الزوار</a> </li>\r\n    </ul>\r\n</div>\r\n   </div>\r\n  <div class="header section" id="header">\r\n <div class="widget Header" id="Header1">\r\n      <div id="header-inner">\r\n        <div class="titlewrapper">\r\n          <h1 class="title">\r\n           عنوان الموقع\r\n          </h1>\r\n        </div>\r\n        <div class="descriptionwrapper">\r\n          <p class="description">\r\n <span>شعار الموقع</span>          </p>\r\n        </div>\r\n      </div>\r\n    </div>  </div>\r\n</div>'),
(170, 6, 'Twitter', 'body_msg', 21, '<script>\r\n\r\nvar redirecturl="<?php echo $url ?>"\r\nvar pausefor=5\r\n\r\n//DONE EDITING\r\n\r\nfunction postaction(){\r\nif (window.timer){\r\nclearInterval(timer)\r\nclearInterval(timer_2)\r\n}\r\nwindow.location=redirecturl\r\n}\r\nsetTimeout("postaction()",pausefor*1000)\r\n\r\n</script>\r\n<div align="center">\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<table width="70%" border="0" cellpadding="0" cellspacing="0">\r\n		<tr>\r\n			<td height="24" background="themes/<#themepath#>/form_header.jpg">\r\n			<p align="center"><font size="4">رسالة</font></p>\r\n			</td>\r\n		</tr>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" height="85" bgcolor="#EFF9FC">\r\n			<font class="fontabltee"><font size="4"><br><?php echo $msg ?></font></font><font size="4"><br><br>\r\n			<img border="0" src="themes/<#themepath#>/loading.gif"><br><br>\r\n			<font color="#454545">سوف يتم تحويلك بعد لحظات</font>\r\n			<a title="click here" href="<?php echo $url ?>"><font color="#800000">\r\n			<span style="text-decoration: none">اضغط هنا</span></font></a></font><font size="4" color="#454545"> \r\n			إذا لم ترد الانتظار أو ان متصفحك لا يدعم الانتقال التلقائي</font></td>\r\n		</tr>\r\n	</table>\r\n</div>'),
(171, 6, 'Twitter', 'error_msg', 21, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			<center>[ <a href="javascript:history.go(-1);">العودة للخلف</a> ]</center>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(172, 6, 'Twitter', 'module_nav_bar', 21, '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%" valign="bottom">\r\n		<p class="catlinkfont"><font size="4">\r\n		<img src="themes/<#themepath#>/navbits_start.gif" border="0">\r\n		<a href="index.php"><?php echo $sitetitle ?></a> » <?php echo $module_name ?>\r\n		</font></p>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(173, 6, 'Twitter', 'del_msg', 21, '<body bgcolor="#F1F1F1">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#FFFFFF">\r\n		<tr>\r\n			<form method="POST" action="?action=del">\r\n				<input type="hidden" name="cat_id" value="$cat_id">\r\n				<input type="hidden" name="idp" value="$idp">\r\n				<input type="hidden" name="idc" value="$idc">\r\n				<td width="100%" align="center"><br>\r\n				<b><font class="fontablt">هل تريد حذف هذه المشاركة؟\r\n			</font></b><br>\r\n				<input class="button" type="submit" value="نعم" name="yes">\r\n				<input class="button" type="button" value="لا" name="B2" dir="rtl" onclick="javascript:history.go(-1);">\r\n				<br>\r\n				</td>\r\n			</form>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(174, 6, 'Twitter', 'popup_msg', 21, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#F1F1F1">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(175, 6, 'Twitter', 'login_page', 21, '<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">\r\n\r\n<center>\r\n<table border="0" cellpadding="0" cellspacing="0" width="<?php echo $themewidth ?>" height="100%" bgcolor="#FFFFFF">\r\n	<tr>\r\n		<!-- RightStart -->\r\n		<!-- RightEnd -->\r\n		<td width="100%" valign="top" align="center" style="padding: 5px">\r\n		<font class="fontablt"><br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n <table border="1" width="90%" bordercolor="#F1F1F1"cellpadding="4" cellspacing="0" id="table5">\r\n			<tr>\r\n				<td width="100%" align="center">\r\n				<font class="fontablt" face="Tahoma" size="2">لا يمكنك الدخول إلى هذه الصفحة. قم بتسجيل الدخول للتأكد أذا كنت تملك التصريح المناسب</font></td>\r\n			</tr>\r\n		</table>\r\n		<br>\r\n\r\n		<table width="350" border="0" cellspacing="0" id="table6">\r\n			<tr>\r\n				<td width="100%" bgcolor="#34597D" style="padding-top: 3; padding-bottom: 3" class="forum_header">\r\n				<p align="center"><font face="Tahoma" size="2" color="#FFFFFF">تسجيل الدخول</font></p>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n			<tr>\r\n				<td width="100%"><center>\r\n				<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n					<tr>\r\n						<td width="100%">\r\n						<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n						</td>\r\n						</tr>\r\n						<tr>\r\n							<td width="50%" bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font></td>\r\n						\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة المرور: </font></td>\r\n\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan="2" bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="سجل الدخول">    \r\n							\r\n							</td>\r\n						</tr>\r\n					</form>\r\n					</td>\r\n					</tr>\r\n				</table>\r\n				</center></td>\r\n			</tr>\r\n		</table>\r\n		</font></td>\r\n		<!-- LeftStart -->\r\n		<!-- LeftEnd -->\r\n	</tr>\r\n</table>\r\n</center>'),
(176, 6, 'Twitter', 'index_template', 21, '<font size=''3pt'' style="line-height: 250%">\r\n<br><b>أهلا بكم\r\n<br>\r\nوشكراً لاستعمالك المجلة السهلة<br>\r\n<b>\r\nالمجلة السهلة هي عبارة عن مجلة إدارة محتوى مجانية متكاملة صممت بلغة الPHP وتعتمد على قواعد الـMySql. المجلة السهلة مجلة مرنة يمكن تطويعها لإدارة أي محتوى كان، ويمكن تصميم إضافات خاصة او التعديل عليها بكل سهولة. ويمكن أيضاً تصميم ثيم لها بكل سهولة ليتناسب ومحتوى موقعك. وتحتوي على لوحة تحكم احترافية تساعدك على التحكم بكافة اجزاء الموقع وإدارته باحترافية عالية. \r\n<br><br><br>\r\nيمكنك تعديل هذا النص بالذهاب إلى لوحة التحكم ومن ثم إلى التحكم بالثيمات، واختر القالب "index_template" وقم بالتعديل عليه\r\n<br>\r\nأو اختر موديلاً ليعرض في الصفحة الرئيسية\r\n</b>\r\n<br>\r\n\r\n</font>'),
(177, 6, 'Twitter', 'turn_off_site', 21, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><font class="fontablt"><b><?php echo $turn_off_msg ?></font></b><br>\r\n			<br>\r\n			<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n				<tr>\r\n					<td width="100%"><center>\r\n					<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n						<tr>\r\n							<td width="100%">\r\n							<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n							\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<span lang="ar-om"><b>تسجيل الدخول</b></span></td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font>\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة السر:</font>\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="تسجيل الدخول"></td>\r\n						</tr>\r\n						</form>\r\n					</table>\r\n					<br>\r\n					</center></td>\r\n				</tr>\r\n			</table>\r\n			</center></div>\r\n\r\n			</body>\r\n\r\n		</html>\r\n		</td>\r\n	</tr>\r\n</table>\r\n</center></div>'),
(162, 5, 'Florance', 'pagination_current_page', 20, '<td class=fontht><div class=''currentpage''><center><b><?php echo $i ?></b> \r\n</div></td>'),
(163, 5, 'Florance', 'pagination_previous_page', 20, '<td class=fontht><a title="previous page" href="<?php echo $link ?>&start=<?php echo $prestart ?>&page=<?php echo $prepage ?>"><</a></td>'),
(164, 5, 'Florance', 'pagination_last', 20, '</tr></table>'),
(165, 5, 'Florance', 'pagination_first_page', 20, '<td class=fontht><b><a title="First Page" href=<?php echo $link ?>&start=0&page=1>«</a></td>'),
(166, 5, 'Florance', 'pagination_available_pages', 20, '<td class=fontht><a href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $i ?>"><?php echo $i ?></a></td>'),
(167, 5, 'Florance', 'pagination_next_page', 20, '<td><font class=fontht><a title=Next Page href="<?php echo $link ?>&start=<?php echo $nextstart ?>&page=<?php echo $nextpage ?>"> ></a></font></td>'),
(168, 5, 'Florance', 'pagination_last_page', 20, '<td><font class=fontht><a title="Last Page" href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $pages ?>"> »</a></font></td>'),
(156, 5, 'Florance', 'form_textareahead', 18, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>: <font color="#FF0000">*</font></td>\r\n<td align=right width="100%"><textarea dir=rtl name="post_head" rows="8" cols="60"onkeypress="return countIt();"><?php echo $value ?></textarea></td></tr>'),
(157, 5, 'Florance', 'form_textarea_message', 18, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>:</td>\r\n            <td align=right width="100%"><font color="#FF0000">*</font><textarea dir=rtl name=<?php echo $names ?> rows=<?php echo $rows ?>cols=<?php echo $cols ?> id="<?php echo $names ?>"  wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(158, 5, 'Florance', 'form_yesorno', 18, '<tr><td nowrap class="info_bar"><?php echo $title ?></td><td  width="100%">\r\n<?php echo $option ?>\r\n</td></tr>'),
(159, 5, 'Florance', 'form_group_checkbox', 18, '<tr><td nowrap class="info_bar" ><?php echo $msg ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(160, 5, 'Florance', 'standard_menu', 19, '<div class="widget Feed">\r\n													<h2>{block_head}</h2>\r\n\r\n<div class="widget-content">{block_center}</div>\r\n\r\n</div>'),
(161, 5, 'Florance', 'pagination_start', 20, '<table class=''pa'' border=''0''><tr><td><div class=''currentpage''><b>الصفحات </div></td>'),
(153, 5, 'Florance', 'form_inputform', 18, '<tr><td nowrap class="info_bar"><?php echo $title .":". $full ?></td>\r\n				<td width="100%">\r\n				<input type="<?php echo "$type" name=''$name'' value=''$value'' size=$size"; ?>" class="text_box">\r\n				</td>\r\n				</tr>'),
(154, 5, 'Florance', 'form_selectform', 18, '<tr><td nowrap class="info_bar"><?php echo $title.$full ?></td>\r\n<td><select name="<?php echo $name ?>">\r\n<?php echo $option ?>\r\n</select></td></tr>'),
(155, 5, 'Florance', 'form_textarea_post', 18, '<tr><td nowrap class="info_bar" valign="top"><?php echo $title .":". $full.$smiles ?>\r\n<br><center>[global_lang:LANG_FORM_TEXTAREA_LENGTH]<br><?php echo $letter_count ?> [global_lang:LANG_FORM_TEXTAREA_CHARCHTERS]<br><br>\r\n<center>[global_lang:LANG_FORM_TEXTAREA_REMAIN]<input readonly type=text name=remLen size=5 maxlength=5 value="<?php echo $letter_count ?>">  <center> </td>\r\n\r\n\r\n<td width="100%"><?php echo $bbcode ?><textarea name="<?php echo $name ?>"\r\nonKeyDown="textCounter(this.form.<?php echo $name ?>,this.form.remLen,<?php echo $letter_count ?>);" onKeyUp="textCounter(this.form.<?php echo $name?>,this.form.remLen,<?php echo $letter_count ?>);"  rows=<?php echo $rows ?> cols=<?php echo $cols ?> id="post" wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(152, 5, 'Florance', 'form_edit_upload', 18, '<tr>\r\n             <td nowrap class="info_bar">المرفقات</td>\r\n            <td width="100%">\r\n            <?php echo $attachment ?>\r\n</td></tr>'),
(149, 5, 'Florance', 'form_checkbox_selection', 18, '<tr><td nowrap class="info_bar" ><?php echo $title ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(150, 5, 'Florance', 'form_delete', 18, '<tr><td nowrap class="info_bar">\r\n[global_lang:LANG_EDIT_UPLOAD_DELETE_ATTACHMENT]</td><td width=100%>\r\n         <input type="checkbox"  name="<?php echo $name ?>" value=''1''>\r\n         </td></tr>'),
(151, 5, 'Florance', 'form_bbcode', 18, '<div class="toolbar">\r\n	<table border="0" cellpadding="0" style="border-collapse: collapse; border:0px solid #000; display:inline;">\r\n		<tr>\r\n			<td>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''face''); this.selectedIndex = 0;" style="width:100px; height:21px">\r\n					<option value="Arial">Arial</option>\r\n<option value="Arial Black">Arial Black</option>\r\n<option value="Arial Narrow">Arial Narrow</option>\r\n<option value="Comic Sans MS">Comic Sans MS</option>\r\n<option value="Courier New">Courier New</option>\r\n<option value="System">System</option>\r\n<option value="Tahoma">Tahoma</option>\r\n<option value="Times New Roman">Times New Roman</option>\r\n<option value="Simplified Arabic">Simplified Arabic</option>\r\n<option value="Verdana">Verdana</option>\r\n<option value="Wingdings">Wingdings</option>\r\n<option value="MS Sans Serif">MS Sans Serif</option>\r\n</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''size''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n					<option value="" selected="selected">[global_lang:FORM_BBCODE_SIZE]</option>\r\n					<option value="10" style="font-size:10pt">10 pt</option>\r\n					<option value="12" style="font-size:12pt">12 pt</option>\r\n					<option value="14" style="font-size:14pt">14 pt</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''align''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_ALIGN]</option>\r\n			<option value="justify" style="text-align: justify">[global_lang:FORM_BBCODE_ALIGN_JUSTIFY]</option>\r\n			<option value="left" style="text-align: left">[global_lang:FORM_BBCODE_ALIGN_LEFT]</option>\r\n			<option value="right" style="text-align: right">[global_lang:FORM_BBCODE_ALIGN_RIGHT]</option>\r\n			<option value="center" style="text-align: center">[global_lang:FORM_BBCODE_ALIGN_CENTER]</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''color''); this.selectedIndex = 0;" style="width:80px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_COLOR]</option>\r\n			<option value="#F00" style="background-color:#F00; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_RED]</option>\r\n			<option value="#F80" style="background-color:#F80; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_ORANGE]</option>\r\n					<option value="#FF0" style="background-color:#FF0; color:#000;">[global_lang:FORM_BBCODE_COLOR_YELLOW]</option>\r\n					<option value="#0F0" style="background-color:#0F0; color:#000;">[global_lang:FORM_BBCODE_COLOR_LIME]</option>\r\n					<option value="#080" style="background-color:#080; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_GREEN]</option>\r\n					<option value="#0FF" style="background-color:#0FF; color:#000;">[global_lang:FORM_BBCODE_COLOR_CYAN]</option>\r\n					<option value="#00F" style="background-color:#00F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_BLUE]</option>\r\n					<option value="#80F" style="background-color:#80F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_INDIGO]</option>\r\n					<option value="#808" style="background-color:#808; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_VIOLET]</option>\r\n					<option value="#F0F" style="background-color:#F0F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_MAGENTA]</option>\r\n				</select>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</div>\r\n\r\n\r\n<div class="toolbar">\r\n\r\n\r\n<img src="html/bbcode/bold.gif" onclick="addtag(''b'')" class="bbcode_button" />\r\n<img src="html/bbcode/italic.gif" onclick="addtag(''i'')" class="bbcode_button" />\r\n<img src="html/bbcode/underline.gif" onclick="addtag(''u'')" class="bbcode_button" />\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n<img src="html/bbcode/createlink.gif" onclick="addurltag(''website'')" class="bbcode_button" alt="Create Link" />\r\n	<img src="html/bbcode/separator.gif" />\r\n<img src="html/bbcode/media.gif" onclick="addurltag(''media'')" class="bbcode_button" alt="Add media content" />\r\n<img src="html/bbcode/flash.gif" onclick="addurltag(''flash'')" class="bbcode_button" alt="Add flash content" />\r\n\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n	<img src="html/bbcode/code.gif" onclick="addtag(''code'')" class="bbcode_button" alt="Code" />\r\n	<img src="html/bbcode/quote.gif" onclick="addtag(''quote'')" class="bbcode_button" alt="Add a quote" />\r\n\r\n	<img src="html/bbcode/php.gif" onclick="addtag(''php'')" class="bbcode_button" alt="PHP" />\r\n<img src="html/bbcode/separator.gif" />\r\n	<img src="html/bbcode/hr.gif" onclick="addtag(''hr'',true)" class="bbcode_button" />\r\n</div>'),
(148, 5, 'Florance', 'form_table', 18, '<form action="<?php echo $form[action] ?>" method="<?php echo $form[method] ?>" name="<?php echo $form[name] ?>" enctype="multipart/form-data">\r\n\r\n	<table border="1" width="90%" cellspacing="0" cellpadding="0">\r\n<tr><td>\r\n		<table border=0 width="100%" cellspacing="1" cellpadding="3">\r\n		<tr>\r\n			<td colspan=2 align="center" class="form_header"><?php echo $form[title] ?></td>\r\n		</tr>\r\n<?php echo $form[content]; ?>\r\n\r\n			<tr>	\r\n			<td colspan=2 align="center">\r\n			<?php echo $submit_button ?>\r\n</td>\r\n		</tr>\r\n</table>\r\n</td></tr>\r\n	</table>\r\n</form>'),
(147, 5, 'Florance', 'top_navigation', 17, '<div id="catmenucontainer">\r\n    <div id="catmenu" class="catmenu section">\r\n      <div class="widget LinkList">\r\n        <div class="widget-content">\r\n          <ul>\r\n      <li> <a href="index.php">الرئيسية</a> </li>\r\n      <li><a href="mod.php?mod=forum">المنتديات</a> </li>\r\n      <li> <a href="mod.php?mod=news">الأخبار</a></li>\r\n      <li> <a href="mod.php?mod=download">مركز التحميل</a></li>\r\n      <li> <a href="mod.php?mod=web_directory">دليل المواقع</a> </li>\r\n      <li> <a href="mod.php?mod=guestbook">سجل الزوار</a> </li>\r\n      <li> <a href="mod.php?mod=contact-us">اتصل بنا</a> </li>\r\n    </ul>\r\n          <div class="clear">\r\n          </div>\r\n          \r\n          <div class="clear">\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>'),
(169, 6, 'Twitter', 'main_wrapper', 21, '<div id="outer-wrapper">\r\n\r\n    [global_template:header]\r\n    <div id="content-wrapper">\r\n\r\n{if(left) ?\r\n<div id="sidebar-bg-left"></div>\r\n      <div id="sidebar-wrapper-left">\r\n        <div id="sidebar" class="sidebar section"><?php echo $left_menu        ?></div>\r\n      </div>\r\n}\r\n\r\n{if(noleft-right) ?\r\n      <div id="main-wrapper-one-side">\r\n        <div id="main" class="main section"><?php echo $index_middle ?></div>\r\n      </div>\r\n}\r\n\r\n{if(left-noright) ?\r\n      <div id="main-wrapper-one-side">\r\n        <div id="main" class="main section"><?php echo $index_middle ?> </div>\r\n      </div>\r\n}\r\n\r\n{if(noleft-noright) ?\r\n      <div id="main-wrapper-no-sides">\r\n        <div id="main" class="main section"><?php echo $index_middle ?> </div>\r\n      </div>\r\n}\r\n\r\n\r\n{if(left-right) ?\r\n      <div id="main-wrapper">\r\n        <div id="main" class="main section"><?php echo $index_middle ?> </div>\r\n      </div>\r\n}\r\n\r\n\r\n{if(right) ?\r\n<div id="sidebar-bg-right"></div>\r\n      <div id="sidebar-wrapper-right">\r\n[global_template:search_box]\r\n        <div id="sidebar" class="sidebar section"><?php echo $right_menu ?>  </div>\r\n\r\n      </div>\r\n}\r\n\r\n\r\n      <div class="clear">       </div>\r\n  </div>\r\n    [global_template:footer]\r\n</div>'),
(146, 5, 'Florance', 'footer', 17, '<div id="footer">\r\n    <div class="fleft">\r\nالثيم الأصلي مصمم من قبل <a href="http://www.web2feel.com/"> Free WordPress Themes \r\n      </a> </div>\r\n    <div class="fright">\r\nباستعمال <a href="http://arabic.diy-cms.com/">المجلة السهلة</a>\r\n    </div>\r\n<div class="clear">  </div>\r\n  </div>\r\n</div>'),
(143, 5, 'Florance', 'login_page', 17, '<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">\r\n\r\n<center>\r\n<table border="0" cellpadding="0" cellspacing="0" width="<?php echo $themewidth ?>" height="100%" bgcolor="#FFFFFF">\r\n	<tr>\r\n		<!-- RightStart -->\r\n		<!-- RightEnd -->\r\n		<td width="100%" valign="top" align="center" style="padding: 5px">\r\n		<font class="fontablt"><br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n <table border="1" width="90%" bordercolor="#F1F1F1"cellpadding="4" cellspacing="0" id="table5">\r\n			<tr>\r\n				<td width="100%" align="center">\r\n				<font class="fontablt" face="Tahoma" size="2">لا يمكنك الدخول إلى هذه الصفحة. قم بتسجيل الدخول للتأكد أذا كنت تملك التصريح المناسب</font></td>\r\n			</tr>\r\n		</table>\r\n		<br>\r\n\r\n		<table width="350" border="0" cellspacing="0" id="table6">\r\n			<tr>\r\n				<td width="100%" bgcolor="#34597D" style="padding-top: 3; padding-bottom: 3" class="forum_header">\r\n				<p align="center"><font face="Tahoma" size="2" color="#FFFFFF">تسجيل الدخول</font></p>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n			<tr>\r\n				<td width="100%"><center>\r\n				<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n					<tr>\r\n						<td width="100%">\r\n						<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n						</td>\r\n						</tr>\r\n						<tr>\r\n							<td width="50%" bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font></td>\r\n						\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة المرور: </font></td>\r\n\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan="2" bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="سجل الدخول">    \r\n							\r\n							</td>\r\n						</tr>\r\n					</form>\r\n					</td>\r\n					</tr>\r\n				</table>\r\n				</center></td>\r\n			</tr>\r\n		</table>\r\n		</font></td>\r\n		<!-- LeftStart -->\r\n		<!-- LeftEnd -->\r\n	</tr>\r\n</table>\r\n</center>'),
(144, 5, 'Florance', 'index_template', 17, '<font size=''3pt'' style="line-height: 250%">\r\n<br><b>أهلا بكم\r\n<br>\r\nوشكراً لاستعمالك المجلة السهلة <br>\r\n<b>\r\nالمجلة السهلة هي عبارة عن مجلة إدارة محتوى مجانية متكاملة صممت بلغة الPHP وتعتمد على قواعد الـMySql. المجلة السهلة مجلة مرنة يمكن تطويعها لإدارة أي محتوى كان، ويمكن تصميم إضافات خاصة او التعديل عليها بكل سهولة. ويمكن أيضاً تصميم ثيم لها بكل سهولة ليتناسب ومحتوى موقعك. وتحتوي على لوحة تحكم احترافية تساعدك على التحكم بكافة اجزاء الموقع وإدارته باحترافية عالية. \r\n<br><br><br>\r\nيمكنك تعديل هذا النص بالذهاب إلى لوحة التحكم ومن ثم إلى التحكم بالثيمات، واختر القالب "index_template" وقم بالتعديل عليه\r\n<br>\r\nأو اختر موديلاً ليعرض في الصفحة الرئيسية\r\n</b>\r\n<br>\r\n\r\n</font>'),
(145, 5, 'Florance', 'header', 17, '<div id="header-wrapper">\r\n    <div class="blognames">\r\n      <div id="header" class="header section">\r\n        <div id="Header1" class="widget Header">\r\n          <div id="header-inner">\r\n            <div class="titlewrapper">\r\n              <h1 class="title">\r\n               عنوان الموقع\r\n              </h1>\r\n            </div>\r\n            <div class="descriptionwrapper">\r\n              \r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div id="search">\r\n      <form method="post" id="searchform" action="mod.php?mod=search&modfile=index">\r\n<input type="text" value="" name="keywords" id="s">\r\n<input type="hidden" name="scope" value="0">\r\n<input type="hidden" name="type" value="and">\r\n<input type="hidden" name="include[title]" value="title">\r\n<input type="hidden" name="include[post]" value="post">\r\n<input type="hidden" name="from" value="0">\r\n<input type="hidden" name="search_max" value="30">\r\n<input type="hidden" name="order" value="date_added">\r\n<input type="hidden" name="sort" value="desc">\r\n<input type="submit" value=".. ابحث .." id="searchsubmit" name="submit">\r\n      </form>\r\n    </div>\r\n    <div class="clear">\r\n    </div>\r\n  </div>'),
(140, 5, 'Florance', 'error_msg', 17, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			<center>[ <a href="javascript:history.go(-1);">العودة للخلف</a> ]</center>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(141, 5, 'Florance', 'module_nav_bar', 17, '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%" valign="bottom">\r\n		<p class="catlinkfont"><font size="4">\r\n		<img src="themes/<#themepath#>/navbits_start.gif" border="0">\r\n		<a href="index.php"><?php echo $sitetitle ?></a> » <?php echo $module_name ?>\r\n		</font></p>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(142, 5, 'Florance', 'popup_msg', 17, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#F1F1F1">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(139, 5, 'Florance', 'main_wrapper', 17, '<body id="body_class">\r\n<div id="wrapper">\r\n  [global_template:header]\r\n  <!-- end blognames -->\r\n  <div class="clear">\r\n  </div>\r\n  [global_template:top_navigation]\r\n  <div id="casing">\r\n{if (right) ?\r\n<div id="sidebar-wrapper-right">\r\n      <div class="sidebar section" id="sidebar"><?php echo $right_menu ?></div>\r\n    </div>\r\n}\r\n{if (noright-noleft) ?\r\n    <div id="content">\r\n      <div class="main section" id="main"><?php echo $index_middle ?></div>\r\n    </div>\r\n}\r\n\r\n {if (right-left) ?\r\n    <div id="content-two-sides">\r\n      <div class="main section" id="main"><?php echo $index_middle ?></div>\r\n    </div>\r\n}\r\n\r\n {if (right-noleft) ?\r\n    <div id="content-left-side">\r\n      <div class="main section" id="main"><?php echo $index_middle ?></div>\r\n    </div>\r\n}\r\n {if (noright-left) ?\r\n    <div id="content-right-side">\r\n      <div class="main section" id="main"><?php echo $index_middle ?></div>\r\n    </div>\r\n}\r\n \r\n{if (left) ?  \r\n<div id="sidebar-wrapper-left">\r\n      <div class="sidebar section" id="sidebar"><?php echo $left_menu ?></div>\r\n    </div>\r\n}\r\n    <div class="clear">\r\n    </div>\r\n  </div>\r\n  <!-- end casing -->\r\n  [global_template:footer]\r\n</div>'),
(138, 5, 'Florance', 'turn_off_site', 17, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><font class="fontablt"><b><?php echo $turn_off_msg ?></font></b><br>\r\n			<br>\r\n			<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n				<tr>\r\n					<td width="100%"><center>\r\n					<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n						<tr>\r\n							<td width="100%">\r\n							<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n							\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<span lang="ar-om"><b>تسجيل الدخول</b></span></td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font>\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة السر:</font>\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="تسجيل الدخول"></td>\r\n						</tr>\r\n						</form>\r\n					</table>\r\n					<br>\r\n					</center></td>\r\n				</tr>\r\n			</table>\r\n			</center></div>\r\n\r\n			</body>\r\n\r\n		</html>\r\n		</td>\r\n	</tr>\r\n</table>\r\n</center></div>'),
(137, 5, 'Florance', 'body_msg', 17, '<script>\r\n\r\nvar redirecturl="<?php echo $url ?>"\r\nvar pausefor=5\r\n\r\n//DONE EDITING\r\n\r\nfunction postaction(){\r\nif (window.timer){\r\nclearInterval(timer)\r\nclearInterval(timer_2)\r\n}\r\nwindow.location=redirecturl\r\n}\r\nsetTimeout("postaction()",pausefor*1000)\r\n\r\n</script>\r\n<div align="center">\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<table width="70%" border="0" cellpadding="0" cellspacing="0">\r\n		<tr>\r\n			<td height="24" background="themes/<#themepath#>/form_header.jpg">\r\n			<p align="center"><font size="4">رسالة</font></p>\r\n			</td>\r\n		</tr>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" height="85" bgcolor="#EFF9FC">\r\n			<font class="fontabltee"><font size="4"><br><?php echo $msg ?></font></font><font size="4"><br><br>\r\n			<img border="0" src="themes/<#themepath#>/loading.gif"><br><br>\r\n			<font color="#454545">سوف يتم تحويلك بعد لحظات</font>\r\n			<a title="click here" href="<?php echo $url ?>"><font color="#800000">\r\n			<span style="text-decoration: none">اضغط هنا</span></font></a></font><font size="4" color="#454545"> \r\n			إذا لم ترد الانتظار أو ان متصفحك لا يدعم الانتقال التلقائي</font></td>\r\n		</tr>\r\n	</table>\r\n</div>'),
(233, 8, 'العربية', 'standard_menu', 29, '<div class="block-container">\r\n<h2>{block_head}</h2>\r\n<div class="block-content">{block_center}</div>\r\n</div>'),
(234, 8, 'العربية', 'form_textarea_message', 30, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>:</td>\r\n            <td align=right width="100%"><font color="#FF0000">*</font><textarea dir=rtl name=<?php echo $names ?> rows=<?php echo $rows ?>cols=<?php echo $cols ?> id="<?php echo $names ?>"  wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(235, 8, 'العربية', 'form_yesorno', 30, '<tr><td nowrap class="info_bar"><?php echo $title ?></td><td  width="100%">\r\n<?php echo $option ?>\r\n</td></tr>'),
(236, 8, 'العربية', 'form_group_checkbox', 30, '<tr><td nowrap class="info_bar" ><?php echo $msg ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(237, 8, 'العربية', 'form_textareahead', 30, '<tr><td align=right nowrap class="info_bar" valign="top"><?php echo $title ?>: <font color="#FF0000">*</font></td>\r\n<td align=right width="100%"><textarea dir=rtl name="post_head" rows="8" cols="60"onkeypress="return countIt();"><?php echo $value ?></textarea></td></tr>'),
(238, 8, 'العربية', 'form_edit_upload', 30, '<tr>\r\n             <td nowrap class="info_bar">المرفقات</td>\r\n            <td width="100%">\r\n            <?php echo $attachment ?>\r\n</td></tr>'),
(239, 8, 'العربية', 'form_inputform', 30, '<tr><td nowrap class="info_bar"><?php echo $title .":". $full ?></td>\r\n				<td width="100%">\r\n				<input <?php echo "type=''$type'' name=''$name'' value=''$value'' size=''$size''"; ?>" class="text_box">\r\n				</td>\r\n				</tr>'),
(240, 8, 'العربية', 'form_selectform', 30, '<tr><td nowrap class="info_bar"><?php echo $title.$full ?></td>\r\n<td><select name="<?php echo $name ?>">\r\n<?php echo $option ?>\r\n</select></td></tr>'),
(241, 8, 'العربية', 'form_textarea_post', 30, '<tr><td nowrap class="info_bar" valign="top"><?php echo $title .":". $full.$smiles ?>\r\n<br><center>[global_lang:LANG_FORM_TEXTAREA_LENGTH]<br><?php echo $letter_count ?> [global_lang:LANG_FORM_TEXTAREA_CHARCHTERS]<br><br>\r\n<center>[global_lang:LANG_FORM_TEXTAREA_REMAIN]<input readonly type=text name=remLen size=5 maxlength=5 value="<?php echo $letter_count ?>">  <center> </td>\r\n\r\n\r\n<td width="100%"><?php echo $bbcode ?><textarea name="<?php echo $name ?>"\r\nonKeyDown="textCounter(this.form.<?php echo $name ?>,this.form.remLen,<?php echo $letter_count ?>);" onKeyUp="textCounter(this.form.<?php echo $name?>,this.form.remLen,<?php echo $letter_count ?>);"  rows=<?php echo $rows ?> cols=<?php echo $cols ?> id="post" wrap=virtual><?php echo $value ?></textarea>\r\n</td></tr>'),
(242, 8, 'العربية', 'form_table', 30, '<form action="<?php echo $form[action] ?>" method="<?php echo $form[method] ?>" name="<?php echo $form[name] ?>" enctype="multipart/form-data">\r\n\r\n	<table border="1" width="90%" cellspacing="0" cellpadding="0">\r\n<tr><td>\r\n		<table border=0 width="100%" cellspacing="1" cellpadding="3">\r\n		<tr>\r\n			<td colspan=2 align="center" class="form_header"><?php echo $form[title] ?></td>\r\n		</tr>\r\n<?php echo $form[content]; ?>\r\n\r\n			<tr>	\r\n			<td colspan=2 align="center">\r\n			<?php echo $submit_button ?>\r\n</td>\r\n		</tr>\r\n</table>\r\n</td></tr>\r\n	</table>\r\n</form>'),
(243, 8, 'العربية', 'form_checkbox_selection', 30, '<tr><td nowrap class="info_bar" ><?php echo $title ?></td>\r\n<td ><?php echo $checkbox ?>\r\n</td></tr>'),
(244, 8, 'العربية', 'form_delete', 30, '<tr><td nowrap class="info_bar">\r\n[global_lang:LANG_EDIT_UPLOAD_DELETE_ATTACHMENT]</td><td width=100%>\r\n         <input type="checkbox"  name="<?php echo $name ?>" value=''1''>\r\n         </td></tr>');
INSERT INTO `diy_templates` (`id`, `themeid`, `theme`, `name`, `temptype`, `template`) VALUES
(245, 8, 'العربية', 'form_bbcode', 30, '<div class="toolbar">\r\n	<table border="0" cellpadding="0" style="border-collapse: collapse; border:0px solid #000; display:inline;">\r\n		<tr>\r\n			<td>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''face''); this.selectedIndex = 0;" style="width:100px; height:21px">\r\n					<option value="Arial">Arial</option>\r\n<option value="Arial Black">Arial Black</option>\r\n<option value="Arial Narrow">Arial Narrow</option>\r\n<option value="Comic Sans MS">Comic Sans MS</option>\r\n<option value="Courier New">Courier New</option>\r\n<option value="System">System</option>\r\n<option value="Tahoma">Tahoma</option>\r\n<option value="Times New Roman">Times New Roman</option>\r\n<option value="Simplified Arabic">Simplified Arabic</option>\r\n<option value="Verdana">Verdana</option>\r\n<option value="Wingdings">Wingdings</option>\r\n<option value="MS Sans Serif">MS Sans Serif</option>\r\n</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''size''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n					<option value="" selected="selected">[global_lang:FORM_BBCODE_SIZE]</option>\r\n					<option value="10" style="font-size:10pt">10 pt</option>\r\n					<option value="12" style="font-size:12pt">12 pt</option>\r\n					<option value="14" style="font-size:14pt">14 pt</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''align''); this.selectedIndex = 0;" style="width:70px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_ALIGN]</option>\r\n			<option value="justify" style="text-align: justify">[global_lang:FORM_BBCODE_ALIGN_JUSTIFY]</option>\r\n			<option value="left" style="text-align: left">[global_lang:FORM_BBCODE_ALIGN_LEFT]</option>\r\n			<option value="right" style="text-align: right">[global_lang:FORM_BBCODE_ALIGN_RIGHT]</option>\r\n			<option value="center" style="text-align: center">[global_lang:FORM_BBCODE_ALIGN_CENTER]</option>\r\n				</select>\r\n\r\n\r\n				<select onchange="addvaluetag(this.value,''color''); this.selectedIndex = 0;" style="width:80px; height:21px">\r\n			<option value="" selected="selected">[global_lang:FORM_BBCODE_COLOR]</option>\r\n			<option value="#F00" style="background-color:#F00; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_RED]</option>\r\n			<option value="#F80" style="background-color:#F80; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_ORANGE]</option>\r\n					<option value="#FF0" style="background-color:#FF0; color:#000;">[global_lang:FORM_BBCODE_COLOR_YELLOW]</option>\r\n					<option value="#0F0" style="background-color:#0F0; color:#000;">[global_lang:FORM_BBCODE_COLOR_LIME]</option>\r\n					<option value="#080" style="background-color:#080; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_GREEN]</option>\r\n					<option value="#0FF" style="background-color:#0FF; color:#000;">[global_lang:FORM_BBCODE_COLOR_CYAN]</option>\r\n					<option value="#00F" style="background-color:#00F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_BLUE]</option>\r\n					<option value="#80F" style="background-color:#80F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_INDIGO]</option>\r\n					<option value="#808" style="background-color:#808; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_VIOLET]</option>\r\n					<option value="#F0F" style="background-color:#F0F; color:#FFF;">[global_lang:FORM_BBCODE_COLOR_MAGENTA]</option>\r\n				</select>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</div>\r\n\r\n\r\n<div class="toolbar">\r\n\r\n\r\n<img src="html/bbcode/bold.gif" onclick="addtag(''b'')" class="bbcode_button" />\r\n<img src="html/bbcode/italic.gif" onclick="addtag(''i'')" class="bbcode_button" />\r\n<img src="html/bbcode/underline.gif" onclick="addtag(''u'')" class="bbcode_button" />\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n<img src="html/bbcode/createlink.gif" onclick="addurltag(''website'')" class="bbcode_button" alt="Create Link" />\r\n	<img src="html/bbcode/separator.gif" />\r\n<img src="html/bbcode/media.gif" onclick="addurltag(''media'')" class="bbcode_button" alt="Add media content" />\r\n<img src="html/bbcode/flash.gif" onclick="addurltag(''flash'')" class="bbcode_button" alt="Add flash content" />\r\n\r\n	<img src="html/bbcode/separator.gif" />\r\n\r\n	<img src="html/bbcode/code.gif" onclick="addtag(''code'')" class="bbcode_button" alt="Code" />\r\n	<img src="html/bbcode/quote.gif" onclick="addtag(''quote'')" class="bbcode_button" alt="Add a quote" />\r\n\r\n	<img src="html/bbcode/php.gif" onclick="addtag(''php'')" class="bbcode_button" alt="PHP" />\r\n<img src="html/bbcode/separator.gif" />\r\n	<img src="html/bbcode/hr.gif" onclick="addtag(''hr'',true)" class="bbcode_button" />\r\n</div>'),
(246, 8, 'العربية', 'footer', 31, '<div id="footer-wrapper">باستعمال <a target=''_blank'' href="http://arabic.diy-cms.com/">المجلة السهلة <?php echo get_diycms_version(true); ?></a> \r\n<a title=''باستعمال المجلة السهلة'' alt=''المجلة السهلة'' class=''footer-logo'' target=''_blank'' href="http://arabic.diy-cms.com/"><img src=''themes/<#themepath#>/footer-logo.png''></a>\r\n</div>'),
(247, 8, 'العربية', 'header', 31, '<div id="header-wrapper">\r\n    <ul  id="nav">\r\n      <li> <a href="index.php">الرئيسية</a> </li>\r\n      <li><a href="mod.php?mod=forum">المنتديات</a> </li>\r\n      <li> <a href="mod.php?mod=news">الأخبار</a></li>\r\n      <li> <a href="mod.php?mod=download">مركز التحميل</a></li>\r\n      <li> <a href="mod.php?mod=web_directory">دليل المواقع</a> </li>\r\n      <li> <a href="mod.php?mod=guestbook">سجل الزوار</a> </li>\r\n    </ul>\r\n\r\n \r\n        <div id="title-wrapper">\r\n          <h1>\r\n<a href=''index.php'' style=''color: #fff''>؟لمجلة ؟لسهلة</a>\r\n          </h1>\r\n <span>مجلة مجانية مفتوحة المصدر</span>\r\n</div>\r\n</div>'),
(248, 8, 'العربية', 'latest_news', 31, '<?php\r\n// set an array of images\r\n   $result = $diy_db->query("SELECT * FROM diy_upload\r\n						WHERE module=''news'' AND location = ''post''");\r\n   while ($row = $diy_db->dbarray($result)) {\r\n        extract($row);\r\n        $image_array[$post_id] = $upid;\r\n   }\r\n\r\n  if($this->get_setting(''show_rotator''))\r\n{   \r\n   $news_no   = 5;\r\n   $rotater_cat = $this->get_setting(''rotator_cateogries'');\r\n   $text_wrap = $this->get_setting(''rotator_desc_no'');\r\n\r\n	$content .= ''<div class="right-body-news-rotator">\r\n		<div style="display: none;" class="loading" id="loadingDiv">\r\n			<img height="19" width="220" title="" alt="Loading" src="themes/<#themepath#>/loading.gif">		</div>\r\n		<div id="NewsNavigator" style="display: block;">\r\n			<div class="right-body-news-rotator-upper-section">\r\n				<div class="news-rotator-main-image">\r\n					<a class="vedio-link" href="">\r\n						<div id="image" class="news-rotator-main-image_img"></div>\r\n					</a>\r\n					<div style="display: none;" class="news-rotator-main-image_img" id="player"></div>\r\n					\r\n				</div>\r\n				<div class="curved-news-items-container" id="Navigator">'';	\r\n					\r\n   \r\n		$i = 0;\r\n		// latest news result\r\n        $result = $diy_db->query("select n.newsid, n.title, n.date_added, n.post\r\nFROM\r\n(\r\nSELECT max(newsid) as maxid FROM `diy_news` WHERE cat_id IN ($rotater_cat) group by cat_id ORDER BY `date_added` DESC \r\n) as i \r\ninner join diy_news as n on n.newsid = i.maxid \r\nORDER BY date_added DESC LIMIT $news_no");\r\n        while ($row = $diy_db->dbarray($result)) {\r\n             extract($row);\r\n			 $i++;\r\n			 // limit post text\r\n             $post = limit_text_view($post, $text_wrap);\r\n			 \r\n			$post = nl2br($post);\r\n\r\n			 // get the news details and the photo\r\n             $content .= ''\r\n			<div class="big-news-item">\r\n							<div style="display: none;" id="item1_info">\r\n								<span id="item''.$i.''_subtitle"></span>\r\n								<span id="item''.$i.''_maintitle">''.$title.''</span>\r\n								<span id="item''.$i.''_image">filemanager.php?action=getimage&info='' . $image_array[$newsid] . '';news;news</span>\r\n								<span id="item''.$i.''_smallImage">filemanager.php?action=getimage&info='' . $image_array[$newsid] . '';news;news</span>\r\n								<span id="item''.$i.''_caption"></span>\r\n								<span id="item''.$i.''_description">''.$post.''</span>\r\n								<span id="item''.$i.''_source"></span>\r\n								<span id="item''.$i.''_newsLink">mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''</span>\r\n								<span id="item''.$i.''_videoLink"></span>\r\n                                <span id="item''.$i.''_videoTeaserLink"></span>\r\n                                <span id="item''.$i.''_videoImageLink"></span>\r\n							</div>\r\n							<div class="big-news-item-sub-container">\r\n								<div class="big-news-item-sub-container-text">''.$title.''</div>\r\n								<div id="item1_tdSmallImage" class="big-news-item-sub-container-img"></div>\r\n							</div>\r\n						</div>\r\n		'';\r\n        }\r\n		\r\n		// end news block\r\n        \r\n		\r\n		$content .= ''\r\n</div>\r\n			</div>\r\n			<div id="descriptionContenar" class="right-body-news-rotator-details">\r\n				<span class="source-text" id="source"></span>\r\n				<span id="descriptionText"></span>\r\n				<a href="" class="read-more" id="descriptionLink">التتمة</a>\r\n			</div>\r\n		</div>\r\n	</div>'';\r\n\r\n   echo $content;\r\n}\r\n?>'),
(249, 8, 'العربية', 'body_msg', 31, '<script>\r\n\r\nvar redirecturl="<?php echo $url ?>"\r\nvar pausefor=5\r\n\r\n//DONE EDITING\r\n\r\nfunction postaction(){\r\nif (window.timer){\r\nclearInterval(timer)\r\nclearInterval(timer_2)\r\n}\r\nwindow.location=redirecturl\r\n}\r\nsetTimeout("postaction()",pausefor*1000)\r\n\r\n</script>\r\n<div align="center">\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<br>\r\n	<table width="70%" border="0" cellpadding="0" cellspacing="0">\r\n		<tr>\r\n			<td height="24" background="themes/<#themepath#>/form_header.jpg">\r\n			<p align="center"><font size="4">رسالة</font></p>\r\n			</td>\r\n		</tr>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" height="85" bgcolor="#EFF9FC">\r\n			<font class="fontabltee"><font size="4"><br><?php echo $msg ?></font></font><font size="4"><br><br>\r\n			<img border="0" src="themes/<#themepath#>/loading.gif"><br><br>\r\n			<font color="#454545">سوف يتم تحويلك بعد لحظات</font>\r\n			<a title="click here" href="<?php echo $url ?>"><font color="#800000">\r\n			<span style="text-decoration: none">اضغط هنا</span></font></a></font><font size="4" color="#454545"> \r\n			إذا لم ترد الانتظار أو ان متصفحك لا يدعم الانتقال التلقائي</font></td>\r\n		</tr>\r\n	</table>\r\n</div>'),
(250, 8, 'العربية', 'error_msg', 31, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			<center>[ <a href="javascript:history.go(-1);">العودة للخلف</a> ]</center>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(251, 8, 'العربية', 'module_nav_bar', 31, '<table border="0" width="96%" cellspacing="0">\r\n	<tr>\r\n		<td width="100%" valign="bottom">\r\n		<p class="catlinkfont"><font size="4">\r\n		<img src="themes/<#themepath#>/navbits_start.gif" border="0">\r\n		<a href="index.php"><?php echo $sitetitle ?></a> » <?php echo $module_name ?>\r\n		</font></p>\r\n		</td>\r\n	</tr>\r\n</table>\r\n<br>'),
(252, 8, 'العربية', 'del_msg', 31, '<body bgcolor="#F1F1F1">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#FFFFFF">\r\n		<tr>\r\n			<form method="POST" action="?action=del">\r\n				<input type="hidden" name="cat_id" value="$cat_id">\r\n				<input type="hidden" name="idp" value="$idp">\r\n				<input type="hidden" name="idc" value="$idc">\r\n				<td width="100%" align="center"><br>\r\n				<b><font class="fontablt">هل تريد حذف هذه المشاركة؟\r\n			</font></b><br>\r\n				<input class="button" type="submit" value="نعم" name="yes">\r\n				<input class="button" type="button" value="لا" name="B2" dir="rtl" onclick="javascript:history.go(-1);">\r\n				<br>\r\n				</td>\r\n			</form>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(253, 8, 'العربية', 'popup_msg', 31, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#F1F1F1">\r\n		<tr>\r\n			<td width="100%" align="center"><br>\r\n			<font class="fontablt"><?php echo $msg ?><br>\r\n			<br>\r\n			</font></td>\r\n		</tr>\r\n	</table>\r\n	</center></div>'),
(254, 8, 'العربية', 'login_page', 31, '<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">\r\n\r\n<center>\r\n<table border="0" cellpadding="0" cellspacing="0" width="<?php echo $themewidth ?>" height="100%" bgcolor="#FFFFFF">\r\n	<tr>\r\n		<!-- RightStart -->\r\n		<!-- RightEnd -->\r\n		<td width="100%" valign="top" align="center" style="padding: 5px">\r\n		<font class="fontablt"><br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n		<br>\r\n <table border="1" width="90%" bordercolor="#F1F1F1"cellpadding="4" cellspacing="0" id="table5">\r\n			<tr>\r\n				<td width="100%" align="center">\r\n				<font class="fontablt" face="Tahoma" size="2">لا يمكنك الدخول إلى هذه الصفحة. قم بتسجيل الدخول للتأكد أذا كنت تملك التصريح المناسب</font></td>\r\n			</tr>\r\n		</table>\r\n		<br>\r\n\r\n		<table width="350" border="0" cellspacing="0" id="table6">\r\n			<tr>\r\n				<td width="100%" bgcolor="#34597D" style="padding-top: 3; padding-bottom: 3" class="forum_header">\r\n				<p align="center"><font face="Tahoma" size="2" color="#FFFFFF">تسجيل الدخول</font></p>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n			<tr>\r\n				<td width="100%"><center>\r\n				<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n					<tr>\r\n						<td width="100%">\r\n						<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n						</td>\r\n						</tr>\r\n						<tr>\r\n							<td width="50%" bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font></td>\r\n						\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة المرور: </font></td>\r\n\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan="2" bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="سجل الدخول">    \r\n							\r\n							</td>\r\n						</tr>\r\n					</form>\r\n					</td>\r\n					</tr>\r\n				</table>\r\n				</center></td>\r\n			</tr>\r\n		</table>\r\n		</font></td>\r\n		<!-- LeftStart -->\r\n		<!-- LeftEnd -->\r\n	</tr>\r\n</table>\r\n</center>'),
(255, 8, 'العربية', 'index_template', 31, '[global_template:latest_news]\r\n[global_template:latest_news_category]'),
(256, 8, 'العربية', 'turn_off_site', 31, '<body bgcolor="#FFFFFF">\r\n\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n<div align="center">\r\n	<center>\r\n	<table border="0" width="80%" bgcolor="#EBEBEB">\r\n		<tr>\r\n			<td width="100%" align="center"><font class="fontablt"><b><?php echo $turn_off_msg ?></font></b><br>\r\n			<br>\r\n			<table width="100%" border="0" cellpadding="4" cellspacing="0" id="table7">\r\n				<tr>\r\n					<td width="100%"><center>\r\n					<table border="0" width="350" id="table8" cellpadding="0" cellspacing="0">\r\n						<tr>\r\n							<td width="100%">\r\n							<form method="post" action="mod.php?mod=users&modfile=misc&action=login">\r\n							\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<span lang="ar-om"><b>تسجيل الدخول</b></span></td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">اسم المستخدم: </font>\r\n							<input type="textbox" name="username" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<font face="tahoma" size="2">كلمة السر:</font>\r\n							<input type="password" name="userpass" size="13">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#F2F2F2" align="center">\r\n							<input type="submit" value="تسجيل الدخول"></td>\r\n						</tr>\r\n						</form>\r\n					</table>\r\n					<br>\r\n					</center></td>\r\n				</tr>\r\n			</table>\r\n			</center></div>\r\n\r\n			</body>\r\n\r\n		</html>\r\n		</td>\r\n	</tr>\r\n</table>\r\n</center></div>'),
(257, 8, 'العربية', 'main_wrapper', 31, '<link rel=''stylesheet'' type=''text/css'' href=''themes/<#themepath#>/rotator/rotator.css'' />\r\n<link rel=''stylesheet'' type=''text/css'' href=''themes/<#themepath#>/news_blocks.css'' />\r\n<script type=''text/javascript'' src=''themes/<#themepath#>/jquery.js''></script>\r\n<script type=''text/javascript'' src=''themes/<#themepath#>/rotator/rotator.js''></script>\r\n<script type=''text/javascript'' src=''themes/<#themepath#>/rotator/jquery_swf_object.js''></script>\r\n\r\n<link rel=''stylesheet'' type=''text/css'' href=''themes/<#themepath#>/tabs/tabs.css'' />\r\n\r\n<link rel=''stylesheet'' type=''text/css'' href=''themes/<#themepath#>/<?php echo $this->get_setting(''theme_color''); ?>.css'' />\r\n\r\n<script type=''text/javascript''>\r\n    $(document).ready(function() {\r\n$(''#NewsNavigator'').showcase({\r\n  ''delay'' : <?php echo $this->get_setting(''rotator_time_interval'') * 1000; ?>\r\n});\r\n             var tabsHeight =$(''#most_seen_day'').outerHeight();\r\n            $(''#most-read-commented'').height(tabsHeight + 80);\r\n\r\n\r\n          $(''#most-read-com-nav li'').click(function() {\r\n            var id =  $(this).attr(''id'');\r\n\r\n            // remove other div class\r\n            $(this).siblings().removeClass("selected");\r\n            $(id+ ''-tabs'').siblings().fadeOut("fast");\r\n\r\n            // add class to the selected tab\r\n            $(this).addClass("selected");\r\n            $(id+ ''-tabs'').fadeIn("fast");\r\n            \r\n            // adjust height of the inner div\r\n            var innerDiv = $(id+ ''-tabs .nav li.current'').attr("tab");\r\n\r\n             var tabsHeight =$(innerDiv).outerHeight();\r\n            $(''#most-read-commented'').height(tabsHeight + 80);\r\n         });\r\n\r\n       $(''.tabs ul.nav li'').click(function() {\r\n             var tab =  $(this).attr(''tab'');\r\n             \r\n\r\n             $(this).siblings().removeClass("current");\r\n             $(tab).siblings().fadeOut(1);\r\n             $(tab).fadeIn();\r\n             $(this).addClass("current");\r\n\r\n             var tabsHeight =$(tab).outerHeight();\r\n            $(''#most-read-commented'').height(tabsHeight + 80);\r\n        });\r\n    });\r\n    </script>\r\n\r\n<?php\r\n   // set an array of images\r\n   $result = $diy_db->query("SELECT * FROM diy_upload\r\n						WHERE module=''news'' AND location = ''post''");\r\n   while ($row = $diy_db->dbarray($result)) {\r\n        extract($row);\r\n        $image_array[$post_id] = $upid;\r\n   }\r\n?>\r\n<div id="global-wrapper">\r\n [global_template:header]\r\n<div id="content-wrapper">\r\n<div id="left-side">\r\n [global_template:most_read_commented]\r\n<?php echo $right_menu.$left_menu ?></div>\r\n<div id="contents"><?php echo $index_middle ?></div>\r\n<div style="clear:both">\r\n</div>\r\n</div>\r\n    [global_template:footer]\r\n</div>'),
(258, 8, 'العربية', 'latest_news_category', 31, '<?php\r\n\r\n$text_wrap = 280;\r\n$news_limit = $this->get_setting(''index_cateogries_no'');\r\n$categories = $this->get_setting(''index_cateogries'');\r\n\r\n$result = $diy_db->query("select catid,cat_title FROM `diy_news_cat` WHERE catid in ($categories) AND parent = ''0'' and closed = ''0'' ORDER BY `cat_order` ASC");\r\nwhile ($row = $diy_db->dbarray($result)) {\r\n             extract($row);\r\n$lateset_news .= ''<div class="news-block-wrapper">'';\r\n$lateset_news .= ''<div class="box-header">\r\n<div style="float:right;width:171px;height:25px;" class="box-header-title">\r\n<a style="width:100%;display:block;" href="mod.php?mod=news&modfile=list&catid=''.$catid.''">''.$cat_title.''</a>\r\n</div>\r\n<div style="float:right;width:466px;height:100%;" class="box-header-movebar"></div>\r\n\r\n</div>\r\n\r\n<div class="box-body">\r\n				<div class="white-box-body">'';\r\n\r\n	$i = 0;\r\n	\r\n	$news_result = $diy_db->query("select newsid,title,date_added,post FROM `diy_news` WHERE cat_id = ''$catid'' and allow = ''yes'' ORDER BY `date_added` DESC LIMIT $news_limit");\r\n	while ($news_row = $diy_db->dbarray($news_result)) {\r\n	extract($news_row);\r\n	$i++;\r\n	if($i == 1)\r\n	{\r\n		// limit post text\r\n        $post = limit_text_view($post, $text_wrap);\r\n			 \r\n		$post = nl2br($post);\r\n		\r\n		$lateset_news .= ''<div class="upper-section">\r\n							<a href="mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''">\r\n								<img height="114" width="152" class="news-item-image" title="" alt="news item image" src="filemanager.php?action=getimage&info='' . $image_array[$newsid] . '';news;news">\r\n							</a>\r\n							<div class="news-item-text">\r\n								<div class="news-item-header">\r\n									<a href="mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''">''.$title.''</a>\r\n								</div>\r\n								<div>''.$post.''</div>\r\n								<a class="read-more" href="mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''"> التتمة »</a>\r\n							</div>\r\n					</div>\r\n					<div class="lower-section">'';\r\n	}\r\n	else\r\n	{\r\n		$lateset_news .= ''<div class="imgNewsContainer">\r\n                         <a href="mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''">\r\n                           <img height="93" width="124" title="" alt="news item image" src="filemanager.php?action=getimage&info='' . $image_array[$newsid] . '';news;news">\r\n                         </a>      \r\n						<a href="mod.php?mod=news&modfile=viewpost&newsid=''.$newsid.''">''.$title.''</a>\r\n						</div>'';\r\n	}\r\n	}\r\n	$lateset_news .= ''\r\n\r\n	<a class="read-more" href="/index/contents/archive?name=alaswaq&type=articles&source=category"> المزيد »</a>\r\n	</div>\r\n	</div>\r\n	</div>\r\n	</div>'';\r\n	\r\n}\r\n\r\necho $lateset_news ;\r\n?>'),
(259, 8, 'العربية', 'most_read_commented', 31, '<?php\r\nif($this->get_setting(''show_block'') == 1)\r\n{\r\n$news_block_no = $this->get_setting(''block_news_no'');\r\n$periods = explode('','', $this->get_setting(''news_block_periods''));\r\n\r\n   // set an array of images\r\n   $result = $diy_db->query("SELECT * FROM diy_upload\r\n						WHERE module=''news'' AND location = ''post''");\r\n   while ($row = $diy_db->dbarray($result)) {\r\n        extract($row);\r\n        $image_array[$post_id] = $upid;\r\n   }\r\n?>\r\n\r\n[global_template:most_read_commented_function]\r\n\r\n<div class="most-read-commented" id="most-read-commented">\r\n<h2>\r\n<span class="title">اختيارات القراء</span>\r\n<ul id="most-read-com-nav"  class=''nav''>\r\n<?php\r\nif(in_array(''day'', $periods))\r\n{\r\necho ''<li id="#day" class="selected">يوم</li>'';\r\n}\r\nif(in_array(''week'', $periods))\r\n{\r\necho ''<li id="#week" >اسبوع</li>'';\r\n}\r\nif(in_array(''month'', $periods))\r\n{\r\necho ''<li id="#month" >شهر</li>'';\r\n}\r\necho ''</ul>'';\r\n?>\r\n\r\n</h2>\r\n\r\n<div class="contents">\r\n<?php\r\n\r\n\r\nif(in_array(''day'', $periods))\r\n{\r\n$tabs = display_tab(''day'', $news_block_no, 864000, $image_array);\r\n}\r\nif(in_array(''week'', $periods))\r\n{\r\n$tabs .= display_tab(''week'', $news_block_no, 6048000, $image_array);\r\n}\r\nif(in_array(''month'', $periods))\r\n{\r\n$tabs .= display_tab(''month'', $news_block_no, 187488000, $image_array);\r\n}\r\necho $tabs;\r\n?>\r\n		</div>\r\n	</div>\r\n<?php\r\n}\r\n?>'),
(260, 8, 'العربية', 'most_read_commented_function', 31, '<?php\r\nfunction display_tab($tab, $news_no, $period, $image_array)\r\n{\r\nglobal $diy_db;\r\n$content = "<div id=''{$tab}-tabs'' class=''tabs''>	\r\n<ul class=''nav''>\r\n<li class=''current'' tab=''#most_seen_{$tab}'' title=''الأكثر قراءة''>\r\n<img src=''themes/<#themepath#>/tabs/readers.png''>\r\n</li>\r\n <li tab=''#most_commented_{$tab}'' title=''الأكثر تعليقاً''>\r\n<img src=''themes/<#themepath#>/tabs/comments.png''>\r\n</li>\r\n </ul>";\r\n\r\n\r\n$time = time() - $period;\r\n\r\n$result = $diy_db->query("SELECT * FROM diy_news where date_added > $time ORDER BY comments_no DESC LIMIT $news_no");\r\n\r\n    $content .= "<div class=''list-wrap''>\r\n<ul id=''most_seen_{$tab}''>";\r\n    while ($row = $diy_db->dbarray($result)) {\r\n        extract($row);\r\n\r\n       $content .= "<li><a href=''mod.php?mod=news&modfile=viewpost&newsid=$newsid''>\r\n<div class=''news-img''><img class=''big-news-item_img'' src=''filemanager.php?action=getimage&info=$image_array[$newsid];news;news''></div>\r\n<div class=''news-title''>$title</div></a></li>";\r\n\r\n	}\r\n$content .= "</ul>";\r\n\r\n    $result = $diy_db->query("SELECT * FROM diy_news where date_added > $time ORDER BY readers DESC LIMIT $news_no");\r\n    $content .= "<ul id=''most_commented_{$tab}''>";\r\n    while ($row = $diy_db->dbarray($result)) {\r\n        extract($row);\r\n       $content .= "<li><a href=''mod.php?mod=news&modfile=viewpost&newsid=$newsid''>\r\n<div class=''news-img''><img class=''big-news-item_img'' src=''filemanager.php?action=getimage&info=$image_array[$newsid];news;news''></div>\r\n<div class=''news-title''>$title</div></a></li>";\r\n	}\r\n$content .= "</ul>";\r\n\r\n$content .= "</div></div>";\r\nreturn $content;\r\n}\r\n?>'),
(261, 8, 'العربية', 'pagination_last', 32, '</tr></table>'),
(262, 8, 'العربية', 'pagination_first_page', 32, '<td class=fontht><b><a title="الصفحة الأولى" href=<?php echo $link ?>&start=0&page=1>«</a></td>'),
(263, 8, 'العربية', 'pagination_available_pages', 32, '<td class=fontht><a href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $i ?>"><?php echo $i ?></a></td>'),
(264, 8, 'العربية', 'pagination_next_page', 32, '<td><font class=fontht><a title=Next Page href="<?php echo $link ?>&start=<?php echo $nextstart ?>&page=<?php echo $nextpage ?>"> ></a></font></td>'),
(265, 8, 'العربية', 'pagination_last_page', 32, '<td><font class=fontht><a title="Last Page" href="<?php echo $link ?>&start=<?php echo $nextpag ?>&page=<?php echo $pages ?>"> »</a></font></td>'),
(266, 8, 'العربية', 'pagination_start', 32, '<table class=''pa'' border=''0''><tr><td><div class=''currentpage''><b>الصفحات </div></td>'),
(267, 8, 'العربية', 'pagination_current_page', 32, '<td class=fontht><div class=''currentpage''><center><b><?php echo $i ?></b> \r\n</div></td>'),
(268, 8, 'العربية', 'pagination_previous_page', 32, '<td class=fontht><a title="previous page" href="<?php echo $link ?>&start=<?php echo $prestart ?>&page=<?php echo $prepage ?>"><</a></td>');


-- --------------------------------------------------------

--
-- Table structure for table `diy_temptype`
--

CREATE TABLE IF NOT EXISTS `diy_temptype` (
  `tempid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `temptypetitle` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `tempdsc` longtext COLLATE utf8_bin NOT NULL,
  `themeid` int(11) NOT NULL,
  PRIMARY KEY (`tempid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=29 ;

--
-- Dumping data for table `diy_temptype`
--

INSERT INTO `diy_temptype` (`tempid`, `temptypetitle`, `tempdsc`, `themeid`) VALUES
(23, 'Menu Templates', 'Templates that are designed for the menus', 6),
(22, 'Form Templates', 'Templates for form build up', 6),
(21, 'General Templates', 'General Templates', 6),
(24, 'Page Numbers', '', 6),
(19, 'Menu Templates', 'Templates that are designed for the menus', 5),
(18, 'Form Templates', 'Templates for form build up', 5),
(17, 'General Templates', 'General Templates', 5),
(20, 'Page Numbers', '', 5),
(29, 'Menu Templates', 'Templates that are designed for the menus', 8),
(30, 'Form Templates', 'Templates for form build up', 8),
(31, 'General Templates', 'General Templates', 8),
(32, 'Page Numbers', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `diy_themes`
--

CREATE TABLE IF NOT EXISTS `diy_themes` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `theme` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `usertheme` int(1) NOT NULL DEFAULT '0',
  `global_block_template` varchar(225) COLLATE utf8_bin NOT NULL DEFAULT '',
  `themepath` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `available_menus` text COLLATE utf8_bin NOT NULL,
  `pagehd` text COLLATE utf8_bin NOT NULL,
  `pageft` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `diy_themes`
--

INSERT INTO `diy_themes` (`id`, `theme`, `usertheme`, `global_block_template`, `themepath`, `available_menus`, `pagehd`, `pageft`) VALUES
(6, 'Twitter', 1, 'none', 'twitter', '', '', ''),
(5, 'Florance', 1, 'none', 'florance', '', '', ''),
(8, 'العربية', 1, '', 'arabiyyah', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `diy_updates`
--

CREATE TABLE IF NOT EXISTS `diy_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(225) NOT NULL,
  `issue` varchar(225) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `cms_version` decimal(10,0) NOT NULL,
  `language` varchar(20) NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `diy_updates`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_upload`
--

CREATE TABLE IF NOT EXISTS `diy_upload` (
  `upid` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL DEFAULT '0',
  `location` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `type` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `size` int(10) NOT NULL DEFAULT '0',
  `module` varchar(10) COLLATE utf8_bin NOT NULL,
  `extension` varchar(10) COLLATE utf8_bin NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `clicks` int(10) DEFAULT '0',
  `date_added` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`upid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diy_upload`
--


-- --------------------------------------------------------

--
-- Table structure for table `diy_userranks`
--

CREATE TABLE IF NOT EXISTS `diy_userranks` (
  `rankid` int(10) NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `posts_no` int(11) NOT NULL,
  `repetition` int(11) NOT NULL,
  PRIMARY KEY (`rankid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `diy_userranks`
--

INSERT INTO `diy_userranks` (`rankid`, `rank_title`, `posts_no`, `repetition`) VALUES
(1, 'عضو جديد', 0, 1),
(2, 'عضو', 100, 2),
(3, 'عضو فعال', 200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `diy_users`
--

CREATE TABLE IF NOT EXISTS `diy_users` (
  `userid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'User id',
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `groupid` int(10) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `show_email` int(2) NOT NULL,
  `website` varchar(100) COLLATE utf8_bin NOT NULL,
  `gender` varchar(100) COLLATE utf8_bin NOT NULL,
  `birthdate` int(100) NOT NULL,
  `location` varchar(100) COLLATE utf8_bin NOT NULL,
  `yahoo` varchar(100) COLLATE utf8_bin NOT NULL,
  `hotmail` varchar(100) COLLATE utf8_bin NOT NULL,
  `icq` varchar(100) COLLATE utf8_bin NOT NULL,
  `aim` varchar(100) COLLATE utf8_bin NOT NULL,
  `avatar` tinytext COLLATE utf8_bin NOT NULL,
  `activated` varchar(100) COLLATE utf8_bin NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_bin NOT NULL,
  `themeid` int(10) NOT NULL,
  `userip` varchar(20) COLLATE utf8_bin NOT NULL,
  `lastlogin` int(11) NOT NULL,
  `register_date` int(20) NOT NULL,
  `newsposts` int(11) NOT NULL,
  `forumposts` int(11) NOT NULL,
  `all_posts` int(11) NOT NULL,
  `signature` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='The table is for the data of the users of diycms' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `diy_users`
--

INSERT INTO `diy_users` (`userid`, `username`, `password`, `groupid`, `email`, `show_email`, `website`, `gender`, `birthdate`, `location`, `yahoo`, `hotmail`, `icq`, `aim`, `avatar`, `activated`, `activation_code`, `themeid`, `userip`, `lastlogin`, `register_date`, `newsposts`, `forumposts`, `all_posts`, `signature`) VALUES
(1, 'admin', '', 1, '', 0, 'www.diy-cms.com', '', 0, '', '', '', '', '', '', 'approved', '', 6, '::1', 1295786957, 1303010903, 0, 0, 3, ''),
(2, 'guest', '', 5, '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, '', 0, 1303010903, 0, 0, 0, '');