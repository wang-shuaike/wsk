<?php 
defined('LMXCMS') or exit();
class AjaxAction extends AdminAction{
    public function __construct() {
        parent::__construct();
    }
    //生成拼音
    public function PinYinDir(){
        $path = trim($_POST['path']);
        echo string::scPinYin($path);
    }
    //检测文件是否存在
    public function isFile(){
        $fix = '';
        if(isset($_POST['fix']) && $_POST['fix']) $fix = $_POST['fix'];
        $path = trim($_POST['path'],'/');
        $isfile = file::isFile(ROOT_PATH.$path.$fix);
        if($isfile)
            echo 1;
        else
            echo 0;
    }
    //检测目录是否存在
    public function isDir(){
        $isdir = file::isDir($_POST['path']);
        if($isdir)
            echo 1;
        else
            echo 0;
    }
    
    //返回信息管理栏目列表代码
    public function getClasslistHtml(){
        $columnModel = new ColumnModel();
        echo $columnModel->getInfoClass();
    }
    //获取官网远程信息
    public function get_lmxcms_info(){
        echo file_get_contents('http://www.lmxcms.com/link.txt');
    }
}
?>