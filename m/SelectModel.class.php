<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   其他标签调用数据模块
 */
defined('LMXCMS') or exit();
class SelectModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    //自定义sql标签查询方法
    public function select_tag($sql){
        return parent::sqlModel($sql);
    }
}
?>