<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   前台控制器基类
 */
defined('LMXCMS') or exit();
class HomeAction extends Action{
    protected $l; //语言文字
    protected function __construct() {
        parent::__construct();
        global $l;
        $this->l = $l;
    }
    
    //效验自定义表单提交时间
    protected function formTime(){
        if(isset($_COOKIE['formtime'])){
            rewrite::error($this->config['form_time'].$this->l['form_time_error']);
        }
    }
    
    //设置自定义表单时间
    protected function setFormTime(){
        setcookie('formtime',1,time() + $this->config['form_time']);
    }
    
    //设置留言板提交时间
    protected function bookTime(){
        if(isset($_COOKIE['booktime'])){
            rewrite::error($GLOBALS['public']['repeatbook'].$this->l['form_time_error']);
        }
    }
    
    //设置自定义表单时间
    protected function setBookTime(){
        setcookie('booktime',1,time() + $GLOBALS['public']['repeatbook']);
    }
}
?>