<?php
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   内容模型模块
 */
class ModuleModel extends Model{
    public function __construct(){
        parent::__construct();
        $this->field=array('*');
        $this->tab=array('module');
    }
    
    //获取全部模型
    public function getAllModule(){
        return parent::selectModel();
    }
    
    //根据mid删除模型
    public function del($mid){
        $this->tab = array('module');
        //删除模型所属数据表
        $tab = $GLOBALS['allmodule'][$mid]['tab'];
        parent::delTabModel($tab);//删除主表
        parent::delTabModel($tab.'_1');//删除副表
        //删除模型记录
        $param['where'] = 'mid='.$mid;
        parent::deleteModel($param);
        $this->cacheModule();//生成模型缓存文件
        //删除记录字段
        $fieldModel = new FieldModel();
        $fieldModel->del2mid($mid); //删除所属模型的所有字段
        $fieldModel->cachefield(); //生成所有字段缓存文件
        $fieldModel->del_htmlForm($mid);//删除html表单缓存文件
    }
    //根据mid判断模型数据表是否有数据
    public function is_data($mid){
        $tab = $GLOBALS['allmodule'][$mid]['tab'];
        $this->tab = array($tab);
        return parent::countModel();
    }
    
    //修改模型信息
    public function update($data){
        $param['where'] = 'mid='.$data['mid'];
        unset($data['mid']);
        unset($data['updateModule']);
        parent::updateModel($data,$param);
        $this->cacheModule();
    }
    
    //生成模型和所属模型的字段缓存文件和表单html文件
    public function scCacheFile(){
        //生成所有模型缓存文件
        $this->cacheModule();
        //生成所有字段缓存文件
        $fieldModel = new FieldModel();
        $fieldModel->cachefield();
        //生成模型表单缓存文件
        $fieldModel->cacheInfoform();
    }
    
    //生成所有模型缓存文件
    public function cacheModule(){
        $module = $this->getAllModule();
        $module = $module ? tool::arrV2K($module,'mid') : array();
        f('public/module',$module,true);
    }
    
    //增加系统模型
    public function add($data){
        $data['tab'] .= '_data';
        $mid = parent::addModel($data); //增加模型记录
        $this->addTab($data['tab']); //增加模型数据表和系统默认字段
        $this->cacheModule(); //生成所有模型缓存文件
        $fieldModel = new FieldModel();
        $fieldModel->addcontentStr($mid);//增加系统默认内容副表content字段记录
        $fieldModel->cachefield();//生成所有字段缓存文件
        $fieldModel->cacheInfomidform($mid);//生成模型表单缓存文件
    }
    
    //增加系统模型数据表
    private function addTab($tab){
        $field1 = array(
            '`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            '`classid` MEDIUMINT(5) UNSIGNED NOT NULL',
            '`title` VARCHAR(255) NOT NULL',
            '`keywords` VARCHAR(255) NOT NULL',
            '`description` VARCHAR(255) NOT NULL',
            "`time` INT(10) UNSIGNED NOT NULL DEFAULT '0'",
            '`url` VARCHAR(255) NOT NULL',
            "`tuijian` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'",
            "`remen` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'",
            "`click` INT(10) UNSIGNED NOT NULL DEFAULT '0'",
            'PRIMARY KEY (`id`)',
            'KEY `classid` (`classid`)',
            'KEY `tuijian` (`tuijian`)',
            'KEY `remen` (`remen`)',
            'KEY `title` (`title`)',
                );
        parent::createModel($tab,$field1); //创建主表
        $field2 = array(
            '`uid` INT(10) UNSIGNED NOT NULL',
            '`content` MEDIUMTEXT NOT NULL',
            'KEY `uid` (`uid`)',
                );
        parent::createModel($tab.'_1',$field2); //创建副表
    }
    
    //根据数据表验证模型或数据表是否存在
    public function is_module($tab){
        $param['where'] = "tab='".$tab."_data'";
        if(parent::countModel($param)) return true;
        $tabArr = parent::getAllTabDb();
        if(in_array(DB_PRE.$tab,$tabArr)) return true;
    }
}
?>