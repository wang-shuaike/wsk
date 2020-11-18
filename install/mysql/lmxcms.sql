CREATE TABLE IF NOT EXISTS `[--pre--]ad` (
  `id` mediumint(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL default '0',
  `extime` int(10) unsigned NOT NULL,
  `html` text NOT NULL,
  `http` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `width` mediumint(5) unsigned NOT NULL,
  `height` mediumint(5) unsigned NOT NULL,
  `exstr` text NOT NULL,
  `click` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `[--pre--]book` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL default '0',
  `ischeck` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `[--pre--]book` (`id`, `name`, `ip`, `content`, `mail`, `tel`, `time`, `uid`, `ischeck`) VALUES
(9, '诗圣杜甫阿斯蒂芬', '127.0.0.1', '爱的色放', '诗圣杜甫阿斯蒂芬', '123123', 1409151994, 0, 1),
(6, '测试姓名', '127.0.0.1', '测试留言内容', '111111@16.com', '123456789', 1409149063, 0, 0),
(7, '测试姓名', '127.0.0.1', '测试留言内容', '123123@126.com', '213123', 1409149077, 0, 1),
(8, 'admin', '', '测试管理员回复', '', '', 1409149097, 7, 0);

CREATE TABLE IF NOT EXISTS `[--pre--]column` (
  `classid` mediumint(5) unsigned NOT NULL auto_increment,
  `uid` mediumint(5) unsigned NOT NULL default '0',
  `classname` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mid` mediumint(5) unsigned NOT NULL,
  `classtype` tinyint(1) NOT NULL default '0',
  `classpath` varchar(100) NOT NULL,
  `classurl` varchar(255) NOT NULL,
  `listtem` varchar(50) NOT NULL,
  `contem` varchar(50) NOT NULL,
  `searchtem` varchar(50) NOT NULL,
  `singletem` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `sort` int(10) unsigned NOT NULL default '0',
  `images` varchar(255) NOT NULL,
  `pagenum` mediumint(5) unsigned NOT NULL,
  `display` tinyint(1) NOT NULL default '0',
  `islist` tinyint(1) unsigned NOT NULL COMMENT '是否为列表分页',
  PRIMARY KEY  (`classid`),
  KEY `uid` (`uid`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

INSERT INTO `[--pre--]column` (`classid`, `uid`, `classname`, `title`, `mid`, `classtype`, `classpath`, `classurl`, `listtem`, `contem`, `searchtem`, `singletem`, `description`, `keywords`, `sort`, `images`, `pagenum`, `display`, `islist`) VALUES
(1, 0, '关于我们', '关于我们', 0, 1, 'about.html', '', '', '', '', 'about', '关于我们', '关于我们', 9, '', 0, 0, 0),
(11, 5, '产品1', '产品1', 1, 0, 'product/chanpin1', '', 'product', 'product', 'index', '', '产品1', '产品1', 0, '', 9, 0, 1),
(3, 1, '主营范围', '主营范围', 0, 1, 'zhuyingfanwei.html', '', '', '', '', 'about', '主营范围', '主营范围', 0, '', 0, 0, 0),
(4, 1, '联系我们', '联系我们', 0, 1, 'contact.html', '', '', '', '', 'about', '联系我们', '联系我们', 0, '', 0, 0, 0),
(5, 0, '产品中心', '产品中心', 1, 0, 'product', '', 'product', 'product', 'index', '', '产品中心', '产品中心', 8, '', 9, 0, 1),
(6, 0, '新闻动态', '新闻动态', 2, 0, 'news', '', 'news', 'news', 'index', '', '新闻动态', '新闻动态', 7, '', 10, 0, 1),
(7, 6, '行业新闻', '行业新闻', 2, 0, 'news/xingyexinwen', '', 'news', 'news', 'index', '', '行业新闻', '行业新闻', 0, '', 10, 0, 1),
(8, 6, '公司新闻', '公司新闻', 2, 0, 'news/gongsixinwen', '', 'news', 'news', 'index', '', '公司新闻', '公司新闻', 0, '', 10, 0, 1),
(12, 5, '产品2', '产品2', 1, 0, 'product/chanpin2', '', 'product', 'product', 'index', '', '产品2', '产品2', 0, '', 9, 0, 1),
(13, 5, '产品3', '产品3', 1, 0, 'product/chanpin3', '', 'product', 'product', 'index', '', '产品3', '产品3', 0, '', 9, 0, 1),
(14, 5, '产品4', '产品4', 1, 0, 'product/chanpin4', '', 'product', 'product', 'index', '', '产品4', '产品4', 0, '', 9, 0, 1),
(15, 1, '留言反馈', '', 0, 2, '', '/index.php?m=Book&a=index', '', '', '', '', '', '', 0, '', 0, 0, 0);

CREATE TABLE IF NOT EXISTS `[--pre--]dyfield` (
  `fid` int(10) unsigned NOT NULL auto_increment,
  `fieldtype` varchar(255) NOT NULL,
  `fieldname` varchar(255) NOT NULL,
  `fieldtitle` varchar(255) NOT NULL,
  PRIMARY KEY  (`fid`),
  KEY `fieldname` (`fieldname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `[--pre--]dyform` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `formname` varchar(255) NOT NULL,
  `must` varchar(255) NOT NULL,
  `fieldid` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `[--pre--]dyformcon` (
  `cid` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL default '0',
  `time` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `[--pre--]field` (
  `fid` int(10) unsigned NOT NULL auto_increment,
  `mid` mediumint(5) unsigned NOT NULL,
  `fname` varchar(20) NOT NULL,
  `ftitle` varchar(100) NOT NULL,
  `ftype` varchar(50) NOT NULL,
  `ismust` tinyint(1) unsigned NOT NULL default '0',
  `sort` int(10) unsigned NOT NULL default '0',
  `defaults` text NOT NULL,
  `vice` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fid`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `[--pre--]field` (`fid`, `mid`, `fname`, `ftitle`, `ftype`, `ismust`, `sort`, `defaults`, `vice`) VALUES
(1, 1, 'content', '正文', 'editor', 0, 0, '', 1),
(2, 2, 'content', '正文', 'editor', 0, 0, '', 1),
(3, 1, 'pic', '产品图片', 'image', 0, 2, '', 0),
(4, 1, 'duotp', '产品图片集', 'moreimage', 0, 1, '', 0);

CREATE TABLE IF NOT EXISTS `[--pre--]file` (
  `fid` int(10) unsigned NOT NULL auto_increment,
  `type` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为图片 1为文件',
  `name` varchar(255) NOT NULL,
  `temname` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `size` varchar(50) NOT NULL,
  `issmall` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fid`),
  KEY `filepath` (`path`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `[--pre--]file` (`fid`, `type`, `name`, `temname`, `path`, `time`, `size`, `issmall`) VALUES
(4, 0, '201408271642357617.jpg', '1.jpg', '/file/d/product/20140827/201408271642357617.jpg', 1409128955, '20.74KB', 0),
(2, 0, '201408271523025580.jpg', '2.jpg', '/file/slide/20140827/201408271523025580.jpg', 1409124182, '87.73KB', 0),
(3, 0, '201408271523022322.jpg', '3.jpg', '/file/slide/20140827/201408271523022322.jpg', 1409124182, '49.47KB', 0),
(5, 0, '201408271644398005.jpg', '2.jpg', '/file/d/product/20140827/201408271644398005.jpg', 1409129079, '21.25KB', 0),
(6, 0, '201408271645056451.jpg', '3.jpg', '/file/d/product/20140827/201408271645056451.jpg', 1409129105, '21.5KB', 0),
(7, 0, '201408271649165919.jpg', '4.jpg', '/file/d/product/20140827/201408271649165919.jpg', 1409129356, '25.74KB', 0);

CREATE TABLE IF NOT EXISTS `[--pre--]link` (
  `id` mediumint(5) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `isimg` tinyint(1) unsigned NOT NULL default '0',
  `sort` int(10) unsigned NOT NULL default '0',
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `isimg` (`isimg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `[--pre--]link` (`id`, `name`, `url`, `img`, `isimg`, `sort`, `remarks`) VALUES
(1, '梦想cms', 'http://www.lmxcms.com', '', 0, 0, ''),
(2, 'lmxcms', 'http://www.lmxcms.com', '', 0, 0, '');

CREATE TABLE IF NOT EXISTS `[--pre--]log` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `content` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userip` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;


INSERT INTO `[--pre--]log` (`id`, `content`, `time`, `username`, `userip`) VALUES
(1, '【admin】登录后台', 1409116768, 'admin', '127.0.0.1'),
(2, '增加系统模型【产品模型】', 1409117131, 'admin', '127.0.0.1'),
(3, '增加系统模型【新闻模型】', 1409117140, 'admin', '127.0.0.1'),
(4, '增加字段—模型id：【1】—字段名字：【pic】', 1409117173, 'admin', '127.0.0.1'),
(5, '增加栏目【关于我们】', 1409117245, 'admin', '127.0.0.1'),
(6, '增加栏目【公司介绍】', 1409117278, 'admin', '127.0.0.1'),
(7, '修改【公司介绍】栏目', 1409117296, 'admin', '127.0.0.1'),
(8, '增加栏目【主营范围】', 1409117465, 'admin', '127.0.0.1'),
(9, '修改【主营范围】栏目', 1409117484, 'admin', '127.0.0.1'),
(10, '增加栏目【联系我们】', 1409117627, 'admin', '127.0.0.1'),
(11, '增加栏目【产品中心】', 1409117739, 'admin', '127.0.0.1'),
(12, '增加栏目【新闻动态】', 1409117774, 'admin', '127.0.0.1'),
(13, '增加栏目【行业新闻】', 1409117794, 'admin', '127.0.0.1'),
(14, '增加栏目【公司新闻】', 1409117814, 'admin', '127.0.0.1'),
(15, '增加栏目【联系我们】', 1409117871, 'admin', '127.0.0.1'),
(16, '删除栏目【id：9】和所属信息', 1409117881, 'admin', '127.0.0.1'),
(17, '【admin】登录后台', 1409122201, 'admin', '127.0.0.1'),
(18, '删除搜索关键字【id：1,2】', 1409122212, 'admin', '127.0.0.1'),
(19, '修改【联系我们】栏目', 1409122701, 'admin', '127.0.0.1'),
(20, '更新栏目排序', 1409122728, 'admin', '127.0.0.1'),
(21, '增加栏目【联系我们】', 1409122786, 'admin', '127.0.0.1'),
(22, '删除栏目【id：10】和所属信息', 1409123179, 'admin', '127.0.0.1'),
(23, '修改【联系我们】栏目', 1409123192, 'admin', '127.0.0.1'),
(24, '更新栏目排序', 1409123229, 'admin', '127.0.0.1'),
(25, '删除栏目【id：2】和所属信息', 1409123470, 'admin', '127.0.0.1'),
(26, '增加焦点图【id：1】', 1409124051, 'admin', '127.0.0.1'),
(27, '增加焦点图片', 1409124195, 'admin', '127.0.0.1'),
(28, '增加焦点图片', 1409124232, 'admin', '127.0.0.1'),
(29, '删除文件、图片', 1409124248, 'admin', '127.0.0.1'),
(30, '修改焦点图片', 1409124257, 'admin', '127.0.0.1'),
(31, '【admin】登录后台', 1409128920, 'admin', '127.0.0.1'),
(32, '增加信息【classid：5】', 1409128960, 'admin', '127.0.0.1'),
(33, '增加字段—模型id：【1】—字段名字：【duotp】', 1409128997, 'admin', '127.0.0.1'),
(34, '增加信息【classid：5】', 1409129083, 'admin', '127.0.0.1'),
(35, '增加信息【classid：5】', 1409129108, 'admin', '127.0.0.1'),
(36, '增加信息【classid：5】', 1409129363, 'admin', '127.0.0.1'),
(37, '删除搜索关键字【id：3】', 1409129609, 'admin', '127.0.0.1'),
(38, '增加信息【classid：7】', 1409129643, 'admin', '127.0.0.1'),
(39, '增加信息【classid：7】', 1409129651, 'admin', '127.0.0.1'),
(40, '增加信息【classid：7】', 1409129659, 'admin', '127.0.0.1'),
(41, '增加信息【classid：7】', 1409129665, 'admin', '127.0.0.1'),
(42, '增加信息【classid：8】', 1409129676, 'admin', '127.0.0.1'),
(43, '增加信息【classid：8】', 1409129681, 'admin', '127.0.0.1'),
(44, '增加信息【classid：8】', 1409129702, 'admin', '127.0.0.1'),
(45, '修改【关于我们】栏目', 1409130845, 'admin', '127.0.0.1'),
(46, '【admin】登录后台', 1409135223, 'admin', '127.0.0.1'),
(47, '增加友情链接', 1409135502, 'admin', '127.0.0.1'),
(48, '增加友情链接', 1409135513, 'admin', '127.0.0.1'),
(49, '修改基本设置', 1409136974, 'admin', '127.0.0.1'),
(50, '增加栏目【产品1】', 1409137078, 'admin', '127.0.0.1'),
(51, '增加栏目【产品2】', 1409137086, 'admin', '127.0.0.1'),
(52, '修改【产品2】栏目', 1409137093, 'admin', '127.0.0.1'),
(53, '增加栏目【产品3】', 1409137104, 'admin', '127.0.0.1'),
(54, '增加栏目【产品4】', 1409137117, 'admin', '127.0.0.1'),
(55, '修改【产品中心】栏目', 1409137123, 'admin', '127.0.0.1'),
(56, '【admin】登录后台', 1409139320, 'admin', '127.0.0.1'),
(57, '修改【产品中心】栏目', 1409139326, 'admin', '127.0.0.1'),
(58, '修改【产品中心】栏目', 1409139537, 'admin', '127.0.0.1'),
(59, '增加信息【classid：11】', 1409139633, 'admin', '127.0.0.1'),
(60, '增加信息【classid：11】', 1409139643, 'admin', '127.0.0.1'),
(61, '增加信息【classid：11】', 1409139653, 'admin', '127.0.0.1'),
(62, '增加信息【classid：11】', 1409139663, 'admin', '127.0.0.1'),
(63, '增加信息【classid：12】', 1409139674, 'admin', '127.0.0.1'),
(64, '增加信息【classid：12】', 1409139684, 'admin', '127.0.0.1'),
(65, '修改信息【classid：12】【id：10】', 1409140291, 'admin', '127.0.0.1'),
(66, '修改【新闻动态】栏目', 1409141304, 'admin', '127.0.0.1'),
(67, '修改【新闻动态】栏目', 1409141428, 'admin', '127.0.0.1'),
(68, '修改【新闻动态】栏目', 1409141807, 'admin', '127.0.0.1'),
(69, '修改【新闻动态】栏目', 1409141849, 'admin', '127.0.0.1'),
(70, '删除搜索关键字【条件：搜索人气小于（2）的记录】', 1409144631, 'admin', '127.0.0.1'),
(71, '删除留言【id：1】', 1409147320, 'admin', '127.0.0.1'),
(72, '修改基本设置', 1409147401, 'admin', '127.0.0.1'),
(73, '修改基本设置', 1409147563, 'admin', '127.0.0.1'),
(74, '修改基本设置', 1409147575, 'admin', '127.0.0.1'),
(75, '留言回复【id：3】', 1409147831, 'admin', '127.0.0.1'),
(76, '修改基本设置', 1409149004, 'admin', '127.0.0.1'),
(77, '审核留言【id：5】', 1409149010, 'admin', '127.0.0.1'),
(78, '审核留言【id：3】', 1409149011, 'admin', '127.0.0.1'),
(79, '删除留言【id：5】', 1409149021, 'admin', '127.0.0.1'),
(80, '删除留言【id：3】', 1409149023, 'admin', '127.0.0.1'),
(81, '删除留言【id：2】', 1409149026, 'admin', '127.0.0.1'),
(82, '审核留言【id：7】', 1409149081, 'admin', '127.0.0.1'),
(83, '审核留言【id：6】', 1409149083, 'admin', '127.0.0.1'),
(84, '留言回复【id：7】', 1409149097, 'admin', '127.0.0.1'),
(85, '增加栏目【留言反馈】', 1409149298, 'admin', '127.0.0.1'),
(86, '修改【留言反馈】栏目', 1409149311, 'admin', '127.0.0.1'),
(87, '修改【留言反馈】栏目', 1409149346, 'admin', '127.0.0.1'),
(88, '增加自定义表单字段', 1409150805, 'admin', '127.0.0.1'),
(89, '删除自定义表单字段', 1409150809, 'admin', '127.0.0.1'),
(90, '增加自定义表单字段', 1409150816, 'admin', '127.0.0.1'),
(91, '删除自定义表单字段', 1409150819, 'admin', '127.0.0.1'),
(92, '删除自定义表单字段', 1409150821, 'admin', '127.0.0.1'),
(93, '增加自定义表单字段', 1409150832, 'admin', '127.0.0.1'),
(94, '增加自定义表单字段', 1409150916, 'admin', '127.0.0.1'),
(95, '增加自定义表单', 1409150966, 'admin', '127.0.0.1'),
(96, '增加自定义表单字段', 1409151013, 'admin', '127.0.0.1'),
(97, '修改自定义表单【id：1】', 1409151026, 'admin', '127.0.0.1'),
(98, '增加自定义表单字段', 1409151042, 'admin', '127.0.0.1'),
(99, '修改自定义表单【id：1】', 1409151049, 'admin', '127.0.0.1'),
(100, '删除表单内容【cid：3】', 1409151394, 'admin', '127.0.0.1'),
(101, '删除表单内容【cid：2】', 1409151398, 'admin', '127.0.0.1'),
(102, '删除表单内容【cid：1】', 1409151402, 'admin', '127.0.0.1'),
(103, '删除自定义表单【id：1】', 1409151418, 'admin', '127.0.0.1'),
(104, '删除自定义表单字段', 1409151421, 'admin', '127.0.0.1'),
(105, '删除自定义表单字段', 1409151423, 'admin', '127.0.0.1'),
(106, '删除自定义表单字段', 1409151426, 'admin', '127.0.0.1'),
(107, '删除自定义表单字段', 1409151428, 'admin', '127.0.0.1'),
(108, '修改基本设置', 1409151964, 'admin', '127.0.0.1'),
(109, '审核留言【id：9】', 1409152003, 'admin', '127.0.0.1'),
(110, '修改基本设置', 1409152095, 'admin', '127.0.0.1');

CREATE TABLE IF NOT EXISTS `[--pre--]module` (
  `mid` mediumint(5) unsigned NOT NULL auto_increment,
  `mname` varchar(100) NOT NULL,
  `tab` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY  (`mid`),
  KEY `tab` (`tab`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `[--pre--]module` (`mid`, `mname`, `tab`, `content`) VALUES
(1, '产品模型', 'product_data', ''),
(2, '新闻模型', 'news_data', '');

CREATE TABLE IF NOT EXISTS `[--pre--]news_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` mediumint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  `tuijian` tinyint(1) unsigned NOT NULL default '0',
  `remen` tinyint(1) unsigned NOT NULL default '0',
  `click` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `tuijian` (`tuijian`),
  KEY `remen` (`remen`),
  KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `[--pre--]news_data` (`id`, `classid`, `title`, `keywords`, `description`, `time`, `url`, `tuijian`, `remen`, `click`) VALUES
(1, 7, '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', '测试新闻,测试新闻测试新闻测试新闻,测试新闻', '测试新闻测试新闻测试新闻测试新闻', 1409129633, '', 0, 0, 20),
(2, 7, '测试新闻测试新闻测试新闻', '测试新闻测试新闻测试新闻', '测试新闻测试新闻测试新闻', 1409129645, '', 0, 0, 60),
(3, 7, '测试新闻测试新闻测试新闻', '测试新闻', '测试新闻测试新闻', 1409129653, '', 0, 0, 32),
(4, 7, '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', '', '测试新闻测试新闻测试新闻', 1409129661, '', 0, 0, 69),
(5, 8, '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', '', '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', 1409129672, '', 0, 0, 52),
(6, 8, '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', '', '测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻', 1409129677, '', 0, 0, 115),
(7, 8, '内容外部链接内容外部链接内容外部链接', '', '', 1409129683, 'http://baidu.com', 0, 0, 66);

CREATE TABLE IF NOT EXISTS `[--pre--]news_data_1` (
  `uid` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[--pre--]news_data_1` (`uid`, `content`) VALUES
(1, '<p>测试新闻测试新闻测试新闻</p>'),
(2, '<p>测试新闻测试新闻测试新闻测试新闻测试新闻</p>'),
(3, '<p>测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻</p>'),
(4, '<p>测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻</p>'),
(5, '<p>测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻</p>'),
(6, '<p>测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻</p>'),
(7, '');

CREATE TABLE IF NOT EXISTS `[--pre--]product_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` mediumint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  `tuijian` tinyint(1) unsigned NOT NULL default '0',
  `remen` tinyint(1) unsigned NOT NULL default '0',
  `click` int(10) unsigned NOT NULL default '0',
  `pic` varchar(255) NOT NULL,
  `duotp` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `tuijian` (`tuijian`),
  KEY `remen` (`remen`),
  KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `[--pre--]product_data` (`id`, `classid`, `title`, `keywords`, `description`, `time`, `url`, `tuijian`, `remen`, `click`, `pic`, `duotp`) VALUES
(1, 5, '产品测试内容产品测试内容产品测试内容', '产品测试内容,产品测试内容,产品测试内容', '产品测试内容产品测试内容', 1409128924, '', 0, 0, 62, '/file/d/product/20140827/201408271642357617.jpg', ''),
(2, 5, '产品测试内容产品测试内容产品测试内容', '', '产品测试内容产品测试内容产品测试内容', 1409129062, '', 0, 0, 39, '/file/d/product/20140827/201408271644398005.jpg', ''),
(3, 5, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409129093, '', 0, 0, 70, '/file/d/product/20140827/201408271645056451.jpg', ''),
(4, 5, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409129346, '', 0, 0, 73, '/file/d/product/20140827/201408271649165919.jpg', ''),
(5, 11, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409139621, '', 0, 0, 52, '/file/d/product/20140827/201408271649165919.jpg', ''),
(6, 11, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409139634, '', 0, 0, 19, '/file/d/product/20140827/201408271645056451.jpg', ''),
(7, 11, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409139645, '', 0, 0, 11, '/file/d/product/20140827/201408271644398005.jpg', ''),
(8, 11, '产品测试内容产品测试内容产品测试内容', '', '产品测试内容产品测试内容产品测试内容', 1409139655, '', 0, 0, 84, '/file/d/product/20140827/201408271642357617.jpg', ''),
(9, 12, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409139667, '', 0, 0, 17, '/file/d/product/20140827/201408271649165919.jpg', ''),
(10, 12, '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', '产品测试内容产品测试内容产品测试内容', 1409139675, '', 0, 0, 42, '/file/d/product/20140827/201408271645056451.jpg', '/file/d/product/20140827/201408271649165919.jpg#####/file/d/product/20140827/201408271645056451.jpg#####/file/d/product/20140827/201408271644398005.jpg#####/file/d/product/20140827/201408271642357617.jpg');

CREATE TABLE IF NOT EXISTS `[--pre--]product_data_1` (
  `uid` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[--pre--]product_data_1` (`uid`, `content`) VALUES
(1, '<p>产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍</p>'),
(2, ''),
(3, ''),
(4, '<p>产品测试内容产品测试内容产品测试内容</p>'),
(5, '<p>产品测试内容产品测试内容产品测试内容</p>'),
(6, '<p>产品测试内容产品测试内容产品测试内容</p>'),
(7, '<p>产品测试内容产品测试内容产品测试内容</p>'),
(8, '<p>产品测试内容产品测试内容产品测试内容</p>'),
(9, ''),
(10, '<p>产品测试内容产品测试内容产品测试内容</p>');

CREATE TABLE IF NOT EXISTS `[--pre--]search` (
  `sid` int(10) unsigned NOT NULL auto_increment,
  `keywords` varchar(255) NOT NULL,
  `classid` int(10) unsigned NOT NULL default '0',
  `mid` int(5) unsigned NOT NULL default '0',
  `time` int(10) unsigned NOT NULL,
  `url` text NOT NULL,
  `click` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sid`),
  KEY `keywords` (`keywords`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `[--pre--]singlecon` (
  `classid` mediumint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  KEY `classid` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[--pre--]singlecon` (`classid`, `content`) VALUES
(1, '<p><img src="/file/p/20140827/201408271713506112.jpg" title="未标题-2.jpg"/>环保科技有限公司，是一家专业从事环保设备生产与销售的技术密集型企业。我们不仅拥有强大完备的生产能力和十余年环保设备研发生产服务史，更有着一支热爱环保事业、诚信敬业的高素质团队。</p>'),
(3, '<p>主营范围</p>'),
(4, '<p>联系我们</p>');

CREATE TABLE IF NOT EXISTS `[--pre--]slide` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `[--pre--]slide` (`id`, `name`, `content`) VALUES
(1, '首页焦点图', '');

CREATE TABLE IF NOT EXISTS `[--pre--]slide_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL,
  `img` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `sort` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `[--pre--]slide_data` (`id`, `uid`, `img`, `content`, `sort`, `url`) VALUES
(1, 1, '/file/slide/20140827/201408271523022322.jpg', '', 0, ''),
(2, 1, '/file/slide/20140827/201408271523025580.jpg', '', 0, '');

CREATE TABLE IF NOT EXISTS `[--pre--]user` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `pwd` char(32) NOT NULL,
  `currtime` int(10) NOT NULL,
  `currip` varchar(100) NOT NULL,
  `lasttime` int(10) unsigned NOT NULL,
  `lastip` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;