<?php 
define('RUN_TYPE','install'); //入口类型  不可更改、删除 否则系统出错
define('LMXCMS',true); //防止调用文件  不可删除 否则系统出错
//引入全局配置文件
require '../inc/config.inc.php';
//引入全局变量数组
$GLOBALS['publics'] = require ROOT_PATH.'data/public/conf.php';
//引入初始化文件
require ROOT_PATH.'inc/run.inc.php';
?>