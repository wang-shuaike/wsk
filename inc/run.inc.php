<?php
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   系统初始化
 */
error_reporting(E_ALL ^ E_NOTICE);
defined('LMXCMS') or exit();
$GLOBALS['public'] = require ROOT_PATH.'data/public/conf.php'; //载入全局变量
//判断入口类型获取模板路径
if(RUN_TYPE == 'index'){
    $config['curr_template'] = $config['template'].$GLOBALS['public']['default_temdir'].'/'; //前台模板路径
}else if(RUN_TYPE == 'extend'){
    $config['curr_template'] = ROOT_PATH.'extend/'.EXTEND_DIR.'/template/'; //扩展模板路径
    //载入当前扩展的私有函数文件
    $extend_fun_name = ROOT_PATH.'extend/'.EXTEND_DIR.'/function/common.php';
    if(is_file($extend_fun_name)) require $extend_fun_name;
}else{
    $config['curr_template'] = $config['template'].RUN_TYPE.'/'; //后台模板路径
}
//引入smarty入口文件
require ROOT_PATH.'plug/smarty/Smarty.class.php';
//引入用户自定义函数库
require ROOT_PATH.'function/userfun.php';
//引入公共函数库
require ROOT_PATH.'function/common.php';
//引入前台语言
require ROOT_PATH.'inc/language.inc.php';
//加载类文件函数
function requireClassName($classname){
    if($classname == 'Action' || $classname == 'Model'){
        $dir=ROOT_PATH.'class/';
    }else if(substr($classname,-6) == 'Action'){
        $dir=ROOT_PATH.'c/'.RUN_TYPE.'/';
    }else if(substr($classname,-5) == 'Model'){
        $dir=ROOT_PATH.'m/';
    }else if(substr($classname,-7) == 'AExtend'){
        $dir=ROOT_PATH.'extend/'.EXTEND_DIR.'/c/';
    }else if(substr($classname,-7) == 'MExtend'){
        $dir=ROOT_PATH.'extend/'.EXTEND_DIR.'/m/';
    }else{
        $dir=ROOT_PATH.'class/';
    }
    if(!file_exists($dir.$classname.'.class.php')){
        exit('404：发生错误');
//        header("location:/404.html");
//        exit;
    }
    require $dir.$classname.'.class.php';
}
//把加载类文件函数注册到autoload中
spl_autoload_register('requireClassName');


//单入口
$extendEnt = RUN_TYPE == 'extend' ? 'AExtend' : 'Action'; //返回入口类型字符串
$m=isset($_GET['m']) ? ucfirst(strtolower($_GET['m'])) : 'Index';
if(!class_exists($m.$extendEnt)){ $m = 'Index'; }
eval('$action=new '.$m.$extendEnt.'();');
eval('$action->run();');

?>