<?php
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   后台编辑器上传文件、图片辅助
 */
defined('LMXCMS') or exit();
class EditAction extends AdminAction{
    public function __construct() {
        parent::__construct();
    }
    //编辑器上传提交方法  
    public function editUpload(){
        $path = trim($_GET['path']);
        edit::getEditObj()->upload($path);
    }
}
?>
