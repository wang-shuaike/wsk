<?php /* Smarty version 2.6.28, created on 2014-08-28 17:06:25
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lmxcms网站管理系统首页 - 免费开源无授权</title>
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
</head>

<body>
<div class="top">
	<div class="logo"><a href="?m=Index&a=index" target="in"><img src="/template/admin/img/logo.gif" alt="网站管理系统首页" /></a></div>
    <div class="nav">
    	<ul>
        	<li><a href="javascript:;" class="curr">系统管理</a></li>
                <li><a href="javascript:;" onclick="getClasslisthtml();">内容管理</a></li>
            <li><a href="javascript:;">模型模块</a></li>
        	<li><a href="javascript:;">更新生成</a></li>
        	<li><a href="javascript:;">其他功能</a></li>
        </ul>
    </div>
    <div class="p">你好：<?php echo $this->_tpl_vars['username']; ?>
 <a href="?m=Login&a=logout">退出登录</a><span>|</span><a href="/" target="_blank">网站首页</a></div>
</div>
<div class="box">
	<div class="leftBox" id="leftBox">
            <h1><a href="/" target="_blank">前台首页</a></h1>
            <dl style="display:block">
                <dd><a href="?m=Index&a=main" target="in" class="curr">系统信息</a></dd>
                <dd><a href="?m=Basic&a=index" target="in">基本设置</a></dd>
                <dd><a href="?m=Manage&a=index" target="in">管理员管理</a></dd>
                <dd><a href='?m=Log&a=index' target="in">日志管理</a></dd>
                <dd><a href='?m=Backdb&a=index' target="in">数据库备份与恢复</a></dd>
                <dd><a href="?m=Column&a=index" target="in">栏目管理</a></dd>
                <dd><a href="?m=Search&a=getSearchData" target="in">搜索关键字管理</a></dd>
                <dd><a href="?m=File&a=imageMain&type=0" target="in">文件管理</a></dd>
            </dl>
            <dl>
                <dd><div class="contentClassList"><?php echo $this->_tpl_vars['classData']; ?>
</div></dd>
            </dl>
            <dl>
                <dd><a href="http://www.lmxcms.com/doc" target="_blank">模板标签说明</a></dd>
                <dd><a href="?m=Template&a=index" target="in">模板管理</a></dd>
                <dd><a href="?m=Module&a=index" target="in">模型管理</a></dd>
            </dl>
            <dl>
                <dd><a href="?m=Schtml&a=index" target="in">生成首页</a></dd>
                <dd><a href="?m=Schtml&a=lists" target="in">生成列表页</a></dd>
                <dd><a href="?m=Schtml&a=content" target="in">生成内容页</a></dd>
                <dd><a href="?m=Cache&a=index" target="in">更新数据缓存</a></dd>
            </dl>
            <dl>
                <dd><a href="?m=Link&a=index" target="in">友情连接管理</a></dd>
                <dd><a href="?m=Book&a=index" target="in">留言板</a></dd>
                <dd><a href="?m=Ad&a=index" target="in">广告</a></dd>
                <dd><a href="?m=Form&a=index" target="in">自定义表单</a></dd>
                <dd><a href="?m=Slide&a=index" target="in">焦点图</a></dd>
            </dl>
    </div>
	<div class="rightBox" id="rightBox"><iframe src="?m=Index&a=main" frameborder="0" name="in"></iframe></div>
</div>
<div class="footer"><script type='text/javascript' src='http://www.lmxcms.com/data/ad/1.js'></script></div>
</body>
</html>