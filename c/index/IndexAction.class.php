<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   前台首页控制器
 */
class IndexAction extends HomeAction{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
				$this->smarty->assign('classid','home');
        $this->smarty->assign('keywords',$GLOBALS['public']['keywords']);
        $this->smarty->assign('description',$GLOBALS['public']['description']);
        $this->smarty->display('index.html');
    }
}
?>