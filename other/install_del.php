<?php 
define('LMXCMS',true);
require '../class/file.class.php';
require '../inc/config.inc.php';
//删除安装程序
file::delDir(ROOT_PATH.'install');
file::delDir(ROOT_PATH.'c/install');

echo "<script type='text/javascript'>alert('删除安装程序成功');window.location.href='/admin.php';</script>'";
?>