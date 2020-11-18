<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   控制器基类(前后台使用)
 */
defined('LMXCMS') or exit();
class Action{
    protected $smarty;
    protected $config;
    protected function __construct(){
        $this->smarty = lmxSmarty::getSmarty();
        $this->assign_public_var();
    }
    public function run(){
        $a=isset($_GET['a']) ? $_GET['a'] : 'index';
        if(method_exists($this,$a)){
            eval('$this->'.$a.'();');
        }else{
            //如果方法不存在则执行index方法
            $this->index();
        }
    }
    
    //注入全局变量
    private function assign_public_var(){
        if($GLOBALS['public']['global']){
            foreach($GLOBALS['public']['global'] as $k => $v){
                $GLOBALS['public']['global'][$k] = string::html_char(string::stripslashes($v));
            }
        }
        global $config;
        $this->config = $config;
        $GLOBALS['allclass'] = category::allclass();
        $GLOBALS['allmodule'] = category::allmodule();
        $this->smarty->assign('currtime',time());
        $this->smarty->assign('backurl',rewrite::backurl());
        $this->smarty->assign('public',$GLOBALS['public']);
        $this->smarty->assign('webname',$GLOBALS['public']['webname']);
        $this->smarty->assign('weburl',$GLOBALS['public']['weburl']);
        $this->smarty->assign('webhttp',$_SERVER['SERVER_NAME']);
        $allclassdata = category::allclass();
        $this->smarty->assign('allclass',$allclassdata);
        $this->smarty->assign('version',$GLOBALS['public']['version']);
    }
}
?>