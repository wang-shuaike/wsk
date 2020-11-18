<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   数据库备份模块
 */
defined('LMXCMS') or exit();
class BackdbModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    //查询数据库中所有表
    public function ShowTable(){
        $data = parent::sqlModel('SHOW TABLES');
        //格式化
        foreach($data as $v){
            foreach($v as $i){
                $newData[] = $i;
            }
        }
        return $newData;
    }
    
    //查询数据表结构
    public function getTableCom($tabname){
        return parent::sqlModel('SHOW CREATE TABLE '.$tabname);
    }
    
    //返回数据表信息
    public function getData($tabname){
        $this->tab = array($tabname);
        $this->field = array('*');
        return parent::selectModel();
    }
    
    //执行sql语句
    public function backSql($sql){
        return parent::queryModel($sql);
    }
}
?>