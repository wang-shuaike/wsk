<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   栏目模块
 */
defined('LMXCMS') or exit();
class ColumnModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->tab = array('column');
        $this->field = array('*');
    }
    
    //返回全部栏目 data = column + module 栏目数据+模型数据 
    public function ColumnJionData(){
        $this->join=array(
            'fromTab' => 'column',
            'field' => array(
                'column' => array('*'),
                'module' => array('mname','tab'),
            ),
            'on' => array(
                array('LEFT','module','column.mid [=] module.mid'),
            ),
        );
        $param=array(
            'order' => 'sort desc,classid asc',
        );
        return parent::joinModel($param);
    }
    
    //重新生成栏目缓存文件
    public function scCacheFile(){
        $class = $this->ColumnJionData();
		if($class){
            $class = category::oneLevel($class);
            $class = tool::arrV2K($class,'classid');
            f('public/class',$class,true);
        }else{
            f('public/class',array(),true);
        }
    }
    
    
    
    //增加栏目
    public function addColumn($data){
        //判断是否增加单页内容
        if($data['classtype'] == 1){
            $content = $data['content'];
            unset($data['content']);
            $id = parent::addModel($data);
            $this->addSingleContent(array('classid'=>$id,'content'=>$content));
        }else{
            return parent::addModel($data);
        }
    }
    
    //增加单页内容
    public function addSingleContent($data){
        $this->tab=array('singlecon');
        return parent::addModel($data);
    }
    
    //更新排序
    public function updateSort($data){
        foreach($data['classid'] as $k => $v){
            $param['where'] = 'classid='.$v;
            $upData = array(
                'sort' => $data['sort'][$k],
            );
            parent::updateModel($upData,$param);
        }
    }
    
    //根据栏目id获取栏目数据
    public function getOneClassData($classid){
        if(!$classid) return;
        $param['where'] = 'classid='.$classid;
        $arr = parent::oneModel($param);
        //获取单页内容
        if($arr['classtype'] == 1){
            $arr['content'] = $this->getOneSingleContent($arr['classid']);
        }
        return $arr;
    }
    
    //根据classid获取单页栏目内容
    public function getOneSingleContent($classid){
        $this->tab = array('singlecon');
        $param['where'] = 'classid='.$classid;
        $data = parent::oneModel($param);
        return string::html_char($data['content']);
    }
    
    //修改栏目
    public function updateColumn($classid,$data){
        $param['where'] ='classid='.$classid;
        $content = $data['content'];
        $classtype = $data['classtype'];
        unset($data['classtype']);
        unset($data['content']);
        parent::updateModel($data,$param);
        //修改单页栏目内容
        if($classtype == 1){
            $this->tab = array('singlecon');
            $this->updateSingleContent($classid,$content);
        }
    }
    
    //按照classid修改单页内容
    public function updateSingleContent($classid,$content){
        $param['where'] ='classid='.$classid;
        $data['content'] = $content;
        parent::updateModel($data,$param);
    }
    
    //根据一条classData删除栏目和所属信息
    public function delClass($classData){
        $this->tab = array('column');
        //删除栏目数据
        $param['where'] = 'classid='.$classData['classid'];
        if(!parent::deleteModel($param)){
            rewrite::js_back('删除失败，请重试');
        }
        //删除栏目图片
        if($classData['images']) file::unLink(ROOT_PATH.$classData['images']);
        //删除普通栏目的数据
        if($classData['classtype'] == 0){
            //删除内容数据
            $infoModel = new ContentModel($classData['classid']);
            $idArr = $infoModel->getClassidInfoid($classData['classid']);
            foreach($idArr as $v){
                $infoModel->delete($v['id']);
            }
            //删除html目录
            file::delDir(ROOT_PATH.$classData['classpath']);
            //删除附件目录
            file::delDir(ROOT_PATH.'file/d/'.$classData['classpath']);
        }
        //删除单页栏目的数据
        if($classData['classtype'] == 1){
            //删除单页栏目内容和内容中的图片
            $this->delSingleContent($classData['classid']);
            //删除单页栏目html文件
            file::unLink(ROOT_PATH.$classData['classpath']);
        }
    }
    
    //根据classid删除单页栏目的内容和里面的图片
    public function delSingleContent($classid){
        $this->tab = array('singlecon');
        $param['where'] = 'classid='.$classid;
        //获取单页内容
        $singleData = parent::oneModel($param);
        if($singleData){
            //删除内容中的图片
            $fileArr = string::getStringFileUrl($singleData['content']);
            foreach($fileArr as $v){
                file::unLink(ROOT_PATH.$v);
            }
            //删除这条信息
            parent::deleteModel($param);
        }
    }
    
    //返回信息管理栏目列表
    public function getInfoClass(){
        if(!$GLOBALS['allclass']) return;
        return $this->formatInfoClass(category::categoryMore($GLOBALS['allclass']));
    }
    
    //格式化内容管理栏目列表
    private function formatInfoClass($data){
        if($data){
            $str .= '<ul>';
        }
        $index = 1;
        foreach($data as $v){
            //判断栏目类型取得url地址
            if($v['classtype'] == 0){
                $url = '?m=Content&a=index&classid='.$v['classid'];
            }else{
                $url = '?m=Column&a=updateMain&id='.$v['classid'];
            }
            $count = count($data);
            $last='';
            if($count == $index){
                $last = " last";
            }
            $str .= "<li class='level".$v['signLevel']."$last'><a href='$url' class='type".$v['classtype']."' target='in'>".$v['classname']."</a>";
            if($v['child']){
                $str .= $this->formatInfoClass($v['child']);
            }
            $str .= '</li>';
            $index++;
        }
        if($data){
            $str .= '</ul>';
        }
        return $str;
    }
    
    //menu标签调用数据
    public function menu_tag($classid,$num,$order,$child,$where){
        if($classid) $param['where'][] = 'uid='.$classid;
        if($classid === 0) $param['where'][] = 'uid=0';
        if(!isset($classid) && $child) $param['where'][] = 'uid=0'; //如果调用全部栏目，并且包括所有子栏目，那么过滤非顶级栏目
        if($num) $param['limit'] = $num;
        $param['order'] = $order ? $order : 'sort desc,classid asc';
        if($where) $param['where'][] = $where;
        $param['where'][] = 'display=0';
        
        $data = parent::selectModel($param); //初始数据
        //是否需要所有子栏目
        if($child){
            foreach($data as $v){
                $v['child'] = category::categoryMore($GLOBALS['allclass'],$v['classid']);
                $newData[] = $v;
            }
        }else{
            $newData = $data;
        }
        $newData = $this->menu_tag_assign($newData);
        return $newData;
    }
    
    //给menu标签增加url和其他变量
    public function menu_tag_assign($data){
        $arr = array();
        foreach($data as $v){
            $param['classid'] = $v['classid'];
            $param['classpath'] = $v['classpath'];
            $param['type'] = 'list';
            $v['classurl'] = $v['classurl'] ? $v['classurl'] : url($param);
            $v['classimage'] = $v['images'];
            $v['mname'] = $GLOBALS['allclass'][$v['classid']]['mname'];
            if($v['uid'] != 0){
                $v['parent_classid'] = $v['uid'];
                $v['parent_classname'] = $GLOBALS['allclass'][$v['uid']]['classname'];
                $param1['classid'] = $v['uid'];
                $param1['classpath'] = $GLOBALS['allclass'][$v['uid']]['classpath'];
                $param1['type'] = 'list';
                $v['parent_classurl'] = $GLOBALS['allclass'][$v['uid']]['classurl'] ? $GLOBALS['allclass'][$v['uid']]['classurl'] : url($param1);
                $v['parent_classimage'] = $GLOBALS['allclass'][$v['uid']]['images'];
            }
            if($v['child']){
                $v['child'] = $this->menu_tag_assign($v['child']);
            }
            $v['topid'] = category::getClassTopId($v['classid']);
            $arr[] = $v;
        }
        return $arr;
    }
}
?>