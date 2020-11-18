<?php 
//lmxcms安装程序控制器
class IndexAction extends Action{
    public function __construct() {
        parent::__construct();
        if(file_exists(ROOT_PATH.'install/install_ok.txt')){
            echo "<script type='text/javascript'>alert('lmxcms已经安装过了，请勿重复安装');window.location.href='http://".$_SERVER['SERVER_NAME']."';</script>'";
            exit();
        }
        //smarty配置
        $this->smarty->template_dir=ROOT_PATH.'install/tem/'; //模板路径
        $this->smarty->compile_dir=ROOT_PATH.'install/compile/'; //编译文件路径
        $this->smarty->cache_dir=ROOT_PATH.'install/cache/'; //缓存目录
    }
    
    public function index(){
        $action = (int)$_POST['action'] ? (int)$_POST['action'] : (int)$_GET['action'];
        switch($action){
            case 2 : $this->index_2(); break;
            case 3 : $this->index_3(); break;
            case 5 : $this->index_5(); break;
            default : $this->index_1(); break;
        }
    }
    
    public function index_1(){
        $this->smarty->display('1.html');
    }
    
    public function index_2(){
        $arr['install_mysqls'] = function_exists('mysql_connect') ? 1 : 0;
        $arr['install_gd'] = $this->gdversion();
        $arr['install_phpvs'] = phpversion();
        $arr['install_isphp'] = substr($arr['install_phpvs'],0,1) > 5 || substr($arr['install_phpvs'],0,1) == 5 ? 1 : 0;
        $arr['install_preg_replace'] = function_exists('preg_replace') ? 1 : 0;
        $arr['install_mysql_connect'] = function_exists('mysql_connect') ? 1 : 0;
        $arr['install_file_put_contents'] = function_exists('file_put_contents') ? 1 : 0;
        $arr['install_file_get_contents'] = function_exists('file_get_contents') ? 1 : 0;
        $dirArr = array(
            'install_dir_s' => '',
            'install_dir_compile' => 'compile',
            'install_dir_data' => 'data',
            'install_dir_file' => 'file',
            'install_dir_inc' => 'inc',
            'install_dir_template' => 'template',
            'install_dir_install' => 'install',
        );
        foreach($dirArr as $k=>$v){
            $dir[$k] = $this->is_chmod($v);
        }
        //插入变量
        foreach($dir as $k=>$v){
            $this->smarty->assign($k,$v);
        }
        foreach($arr as $k=>$v){
            $this->smarty->assign($k,$v);
        }
        if(isset($_POST['sub2'])){
            //检测环境
            foreach($dir as $v){
                if(!$v){
                    tool::JSback('环境检测没有通过！');
                }
            }
            //检测目录
            foreach($arr as $v){
                if(!$v){
                    tool::JSback('环境检测没有通过！');
                }
            }
            $this->index_3();
        }else{
            $this->smarty->display('2.html');
        }
    }
    
    public function index_3(){
        if(isset($_POST['sub3'])){
            $data = $this->checkform();
            $this->ismysql($data);
            //修改缓存缓存文件
            $cacheData = $GLOBALS['public'];
            $cacheData['user_pwd_key'] = $data['user_key'];
            f('public/conf',$cacheData,true);
            //修改配置文件
            $this->updateConf($data);
            //开始安装
            $this->index_4($data);
        }else{
            $this->smarty->display('3.html');
        }
    }
    //修改配置文件
    private function updateConf($data){
        $configStr = file_get_contents(ROOT_PATH.'inc/config.inc.php');
        $local = explode(':',$data['local']);
        $configStr = preg_replace('/define\(\'DB_HOST\',\'(.*)\'\)/',"define('DB_HOST','".$local[0]."')",$configStr);
        $configStr = preg_replace('/define\(\'DB_NAME\',\'(.*)\'\)/',"define('DB_NAME','".$data['dbname']."')",$configStr);
        $configStr = preg_replace('/define\(\'DB_USER\',\'(.*)\'\)/',"define('DB_USER','".$data['dbuser']."')",$configStr);
        $configStr = preg_replace('/define\(\'DB_PWD\',\'(.*)\'\)/',"define('DB_PWD','".$data['dbpwd']."')",$configStr);
        $configStr = preg_replace('/define\(\'DB_PORT\',\'(.*)\'\)/',"define('DB_PORT','".$local[1]."')",$configStr);
        $configStr = preg_replace('/define\(\'DB_PRE\',\'(.*)\'\)/',"define('DB_PRE','".$data['dbpre']."')",$configStr);
        //保存配置文件
        file_put_contents(ROOT_PATH.'inc/config.inc.php',$configStr);
    }
    //验证数据库和管理员表单数据并返回
    private function checkform(){
        //获取数据
        $arr = p(1);
        unset($arr['sub3']);
        //验证数据
        if(!$arr['local']) rewrite::js_back('请填写数据库主机地址');
        if(!$arr['dbname']) rewrite::js_back('请填写数据库名称');
        if(!$arr['dbuser']) rewrite::js_back('请填写数据库用户名');
        if(!$arr['dbpre']) rewrite::js_back('请填写数据库表前缀');
        if(!preg_match('/_$/',$arr['dbpre'])) rewrite::js_back('数据库后缀必须以“_”结尾');
        if(!$arr['user_name']) rewrite::js_back('请填写管理员用户名');
        if(!$arr['user_pwd']) rewrite::js_back('请填写管理员密码');
        if(!$arr['user_pwd1']) rewrite::js_back('请填写管理员确认密码');
        if($arr['user_pwd'] != $arr['user_pwd1']) rewrite::js_back('管理员二次输入的密码不一致');
        if(!$arr['user_key']) rewrite::js_back('请填写密码加密字符串');
        return $arr;
    }
    //验证是否能够链接上mysql并导入数据库
    private function ismysql($data){
        $link=@mysql_connect($data['local'],$data['dbuser'],$data['dbpwd']);
        if(!$link) rewrite::js_back('无法链接数据库，请检查数据库配置信息');
        $select_db = @mysql_select_db($data['dbname'],$link);
        if(!$select_db) rewrite::js_back ('数据库名称有误，没有【'.$data['dbname'].'】这个数据库');
        mysql_close($link);
    }
    
    //第四步、导入数据库
    private function index_4($data){
        if(!$data){
            exit('请按照安装程序进行安装');
        }
        $this->smarty->display('4.html');
        $sql = file(ROOT_PATH.'install/mysql/lmxcms.sql');
        $index = 0;
        //初始化sql数据并分组sql
        foreach($sql as $v){
            if(preg_match('/^\s+$/',$v) || $v[0] == '#'){
                continue;
            }
            $v = str_replace('[--pre--]',$data['dbpre'],trim($v));
            if(preg_match('/\;$/',$v)){
                $newsql[$index] .= $v;
                $index++;
            }else{
                $newsql[$index] .= $v;
            }
        }
        //执行sql
        $link=@mysql_connect($data['local'],$data['dbuser'],$data['dbpwd']);
        @mysql_select_db($data['dbname'],$link);
        mysql_query('SET NAMES '.DB_CHAR);
        foreach($newsql as $v){
            mysql_query($v,$link);
            if(preg_match('/^CREATE TABLE/',$v)){
                preg_match('/CREATE TABLE IF NOT EXISTS `(.*)`/U',$v,$dbname);
                echo "<script>$('#start').append('<li>创建【".$dbname[1]."】数据表成功</li>');scrollToBottom();</script>";
            }
            ob_flush(); 
            flush();
        }
        //插入管理员数据
        $GLOBALS['public']['user_pwd_key'] = $data['user_key'];
        $userSql = "INSERT INTO `".$data['dbpre']."user` VALUES(1,'".$data['user_name']."','".string::pwdmd5($data['user_pwd'])."','".time()."','".getip()."','".time()."','".getip()."');";
        mysql_query($userSql,$link);
        mysql_close($link);
        echo "<script type='text/javascript'>window.location.href='index.php?action=5';</script>'";
    }
    
    //安装完成
    public function index_5(){
        //创建安装完成印记
        file_put_contents(ROOT_PATH.'install/install_ok.txt','');
        $this->smarty->display('5.html');
    }
    //返回gd支持版本
    private function gdversion(){
        //没启用php.ini函数的情况下如果有GD默认视作2.0以上版本
        if(!function_exists('phpinfo')){
              if(function_exists('imagecreate')){ 
                  return '2.0';
              }else{
                  return 0;
              }
        }else{
            ob_start();
            phpinfo(8);
            $module_info = ob_get_contents();
            ob_end_clean();
            if(preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info,$matches)){   
                $gdversion_h = $matches[1];
            }else{  
                $gdversion_h = 0; 
            }
            return $gdversion_h;
        }
    }
    
    //返回目录是否可读可写可删
    private function is_chmod($path){
        $path = ROOT_PATH.$path;
        //检测是否可读
        if(!$readdir = @opendir($path)){
            return 0;
        }
        closedir($readdir);
        //检测是否可写
        $file = $path.'/lmxcms_install_test.txt';
        $fp = @fopen($file,'w');
        if(!$fp){
            return 0;
        }
        fclose($fp);
        $unk = @unlink($file);
        if(!$unk){
            return 0;
        }
        return 1;
    }
}
?>