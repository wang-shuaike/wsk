<?php /* Smarty version 2.6.28, created on 2014-08-04 19:03:59
         compiled from 5.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lmxcms网站管理系统安装</title>
<link rel="stylesheet" type="text/css" href="/install/tem/css/style.css" />
</head>

<body>
<div class="top">
	<div class="logo width"><img src="/install/tem/images/logo.gif"  /><span>lmxcms 1.0 网站系统 安装程序</span></div>
</div>
<div class="mainBox">
    <div class="but width"><span><font>1</font>安装使用协议</span><span><font>2</font>系统环境效验</span><span><font>3</font>参数配置</span><span><font>4</font>正在安装</span><span class="curr"><font>5</font>安装完成</span></div>
    <div class="main width install_ok">
    	<h1>安装成功！</h1>
        <div class="install_ok_c">
        	<p>基于安全考虑，请<span class="red">【 删除“/install”目录、删除“/c/install”目录 】</span>，您也可以点击下面的按钮删除上述俩个文件夹，避免重复安装而覆盖数据！</p>
            <div class="ok_sub">
            <input type="button" value="进入后台" onclick="window.location.href='/admin.php'" /> —— <input type="button" value="删除安装程序" onclick="window.location.href='/other/install_del.php'" />
            </div>
        </div>
	</div>
    <div class="footer width">Powered by <a href="http://www.lmxcms.com">lmxcms</a> <?php echo $this->_tpl_vars['version']; ?>
 ©2014  <a href="http://www.lmxcms.com">lmxcms Inc.</a></div>
</div>
</body>
</html>