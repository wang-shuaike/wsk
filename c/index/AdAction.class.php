<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   广告点击次数记录和跳转
 */
class AdAction extends HomeAction{
    private $adModel = null;
    private $id;
    public function __construct() {
        parent::__construct();
        if($this->adModel == null) $this->adModel = new AdModel(array('id','http'));
        $this->id = (int)$_GET['id'];
        if(!$this->id) exit;
    }
    
    public function index(){
        $data = $this->adModel->one($this->id);
        if(!$data) exit; //不存在的id 停止程序运行
        $this->adModel->click($this->id); //增加点击次数
        $url = isset($_GET['url']) ? $_GET['url'] : $data['http'];
        //跳转地址
        Header("Location:$url");
    }
    
}
?>