<?php /* Smarty version 2.6.28, created on 2014-08-04 19:03:59
         compiled from 4.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lmxcms网站管理系统安装</title>
<link rel="stylesheet" type="text/css" href="/install/tem/css/style.css" />
<script type="text/javascript" src="../../template/admin/js/jquery.js"></script>
<script type="text/javascript">
//设置滚动条始终在最下面
function scrollToBottom() {
    var scrollTop = $(document).height()-$(window).height();
    $(document).scrollTop(scrollTop);
}
</script>
</head>

<body>
<div class="top">
	<div class="logo width"><img src="/install/tem/images/logo.gif"  /><span>lmxcms <?php echo $this->_tpl_vars['version']; ?>
 网站系统 安装程序</span></div>
</div>
<div class="mainBox">
    <div class="but width"><span><font>1</font>安装使用协议</span><span><font>2</font>系统环境效验</span><span><font>3</font>参数配置</span><span class="curr"><font>4</font>正在安装</span><span><font>5</font>安装完成</span></div>
    <div class="main width content2">
        <div class="mainK check3">
        	<h2><span>安装过程中请勿刷新</span></h2>
            <ul id="start"></ul>
        </div>
	</div>
    <div class="footer width">Powered by <a href="http://www.lmxcms.com">lmxcms</a> <?php echo $this->_tpl_vars['version']; ?>
 ©2014  <a href="http://www.lmxcms.com">lmxcms Inc.</a></div>
</div>
</body>
</html>