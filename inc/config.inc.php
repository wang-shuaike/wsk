<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   全站配置文件
 */
defined('LMXCMS') or exit();
//数据库配置

define('DB_HOST','localhost'); //数据库地址
define('DB_NAME','lmxcms');   //数据库名字
define('DB_USER','root');      //数据库用户名
define('DB_PWD','');          //数据库密码
define('DB_PORT','');          //mysql端口号
define('DB_CHAR','UTF8');      //数据库编码
define('DB_PRE','lmx_');       //数据库前缀

//网站绝对根路径
define('ROOT_PATH',str_replace('\\','/',substr(dirname(__FILE__),0,-3)));


//系统相关
$config['template'] = ROOT_PATH.'template/'; //模板根路径
$config['page_list_num'] = 15; //后台信息列表每页显示 过多会影响后台速度
$config['template_edit'] = 0; //后台是否允许编辑模板文件 0：允许 1：不允许
$config['sc_group_num'] = 100; //后台生成html每组条数 过大会造成系统负担 建议500以内
$config['ad_extime'] = 5; //后台即将到期列表显示距离多少天到期的广告
$config['user_out_time'] = 30; //后台管理员登录超时时间
$config['search_isnull'] = 1; //前台搜索是否允许搜索空字符串 1:不允许 0:允许
$config['form_time'] = 10; //前台多少秒之内不允许再次提交自定义表单  搜索和留言板间隔时间在 “后台—系统管理—基本设置” 里面设置
$config['clickMax'] = array(10,100); //后台增加内容点击次数的随机范围
$config['search_time'] = 365; //前台搜索信息默认查询多少天之内信息 0:全部 
$config['is_lmxcms_update'] = 1; //后台是否开启系统更新提示
//上传相关
$config['upload_file_pre'] = array('zip','rar'); //后台允许上传的文件后缀
$config['upload_image_pre'] = array('jpg','gif','png'); //后台允许上传的图片后缀 
$config['update_max_size'] = 20; //后台上传文件最大数值 单位：M

$config['q_upload_file_pre'] = array('zip','rar','jpg','gif','png'); //前台允许上传的后缀
$config['q_update_max_size'] = 2; //前台上传文件最大数值 单位：M
$config['q_dyform_filepath'] = 'file/dy'; //自定义表单前台上传文件保存路径

//Ueditor编辑器配置项
$config['ueditor_dir'] = 'plug/ueditor/'; //编辑器路径
$config['ueditor_out_sub'] = array('snapscreen','wordimage','insertvideo','scrawl','help');//去掉编辑器中的某些按钮，这些是系统默认的，某些功能没有集成到本系统中

//前台和后台smarty配置
$config['smy_compile_dir'] = ROOT_PATH.'compile/'; //smarty编译文件路径
$config['smy_cache_dir'] = ROOT_PATH.'compile/cache/'; //smarty静态缓存目录

date_default_timezone_set('Asia/Shanghai');         //设置时区

?>