<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   系统扩展入口文件
 */
define('LMXCMS',TRUE);
if(!isset($_GET['e'])) exit('404：发生错误');
define('EXTEND_DIR',$_GET['e']); //扩展文件夹名字
define('RUN_TYPE','extend'); //入口类型
require substr(dirname(__FILE__),0,-6).'inc/config.inc.php';//引入全局配置文件
require ROOT_PATH.'inc/run.inc.php';//引入初始化文件

?>