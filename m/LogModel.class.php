<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   日志模块
 */
defined('LMXCMS') or exit();
class LogModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->field=array('id','content','time','username','userip');
        $this->tab=array('log');
    }
    
    //增加日志
    public function add($content){
        $time = time();
        $ip = getip();
        $data = array(
            'content' => $content,
            'time' => $time,
            'username' => encrypt(session('username'),'D',$GLOBALS['public']['user_pwd_key']),
            'userip' => $ip,
        );
        parent::addModel($data);
    }
    //返回日志总记录数
    public function getLogCount(){
        return parent::countModel();
    }
    //获取日志数据
    public function getLog($param){
        return parent::selectModel($param);
    }
    
    //删除7天外日志
    public function delLog(){
        $time=time() - (7 * 24 * 3600);
        $param['where'] = "time < $time";
        return parent::deleteModel($param);
    }
}
?>