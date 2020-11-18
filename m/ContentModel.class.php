<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   内容模块
 */
defined('LMXCMS') or exit();
class ContentModel extends Model{
    private $classid;
    private $mid;
    public function __construct($classid=false,$mid=false) {
        parent::__construct();
        $this->field = array('*');
        $this->classid = $classid;
        $this->mid = $mid;
        if($classid){
            $this->tab = array($GLOBALS['allclass'][$classid]['tab']);
            $this->mid = $GLOBALS['allclass'][$classid]['mid'];
        }else if($mid){
            $this->tab = array($GLOBALS['allmodule'][$mid]['tab']);
        }else{
            rewrite::error('数据表有误','?m=Content');
        }
    }
    
    //增加信息
    public function add($data){
        $id = parent::addModel($data[1]);
        if(isset($data[2])){
            $this->tab = array($data['tab'].'_1');
            $data[2]['uid'] = $id;
            parent::addModel($data[2]);
        }
    }
    
    //修改信息
    public function updateInfo($data){
        $id = (int)$_POST['id'];
        $param['where'] = 'id='.$id;
        parent::updateModel($data[1],$param); //修改主表
        if(isset($data[2])){//修改副表
            $this->tab = array($data['tab'].'_1');
            $param['where'] = 'uid='.$id;
            parent::updateModel($data[2],$param);
        }
    }
    
    //根据id获取信息数据
    public function updateData($id){
        $param['where'] = 'id='.$id;
        $data1 = parent::oneModel($param); //主表数据
        $this->tab = array($this->tab[0].'_1');
        $param['where'] = 'uid='.$id;
        $data2 = parent::oneModel($param); //副表
        return array_merge($data1,$data2);
    }
    
    //获取信息列表
    public function getInfolist($page,$classid,$where='',$xglink=false){
        $this->field = array('id','classid','title','time','url','tuijian','remen');
        if($classid) $param['where'][] = 'classid='.$classid;
        if($where) $param['where'][] = $where;
        if($xglink) $this->field = array('*');
        $param['limit'] = $page;
        $param['order'] = 'id desc';
        return parent::selectModel($param);
    }
    
    //获取信息总条数
    public function count($classid){
        $classid = $classid ? $classid : $this->classid;
        $param['where'] = 'classid='.$classid;
        return parent::countModel($param);
    }
    
    //推荐信息
    public function tuijian(array $idArr){
        $param['where'] = 'id in('.implode(',',$idArr).')';
        $data = array(
            'tuijian' =>(int)$_POST['tuijian'],
        );
        return parent::updateModel($data,$param);
    }
    
    //热门信息
    public function remen(array $idArr){
        $param['where'] = 'id in('.implode(',',$idArr).')';
        $data = array(
            'remen' =>(int)$_POST['remen'],
        );
        return parent::updateModel($data,$param);
    }
    //根据classid获取所属的所有信息id
    public function getClassidInfoid($classid){
        $this->field = array('id');
        $param['where'] = 'classid='.$classid;
        return parent::selectModel($param);
    }
    
    //根据id删除信息
    public function delete($id){
        $this->deleteInfoAndfile($id); //删除信息的附件和图片
        $this->tab = array($GLOBALS['allclass'][$this->classid]['tab']);
        $param['where'] = 'id='.$id;
        if($GLOBALS['public']['ishtml']){//删除静态文件
          $this->field = array('time');
          $time = parent::oneModel($param);
          $time = date('Ymd',$time['time']);
          $path = ROOT_PATH.$GLOBALS['allclass'][$this->classid]['classpath'].'/'.$time.'/'.$id.'.html';
          file::unLink($path);
        }
        parent::deleteModel($param); //删除主表信息
        $param['where'] = 'uid='.$id;
        $this->tab = array($this->tab[0].'_1');
        parent::deleteModel($param); //删除附表信息
    }
    
    //根据信息id删除信息编辑器内的图片与附件
    public function deleteInfoAndfile($id){
        $this->tab = array($GLOBALS['allclass'][$this->classid]['tab']);
        //获取所属字段
        $fieldArr = $GLOBALS['allfield'][$this->mid];
        $editorName = array();
        foreach($fieldArr as $v){
            //筛选出编辑器字段
            if($v['ftype'] == 'editor' && $v['vice'] == 0){ 
                $editorName[1][] = $v['fname'];
            }else if($v['ftype'] == 'editor' && $v['vice'] == 1){
                $editorName[2][] = $v['fname'];
            }
        }
        if($editorName[1]){//获取主表内容
            $this->field = $editorName[1];
            $param['where'] = 'id='.$id;
            $data1 = parent::oneModel($param);
        }
        if($editorName[2]){//获取副表内容
            $this->field = $editorName[2];
            $this->tab = array($this->tab[0].'_1');
            $param['where'] = 'uid='.$id;
            $data2 = parent::oneModel($param);
        }
        $dataArr = array_merge($data1 ? $data1 : array(),$data2 ? $data2 : array());
        //遍历删除文件
        foreach($dataArr as $v){
            //筛选出内容中的文件路径
            $fileArr = string::getStringFileUrl($v);
            if($fileArr){
                foreach($fileArr as $v){
                    file::unLink(ROOT_PATH.$v);
                }
            }
        }
    }
    
    //根据classid获取前台信息列表
    public function q_listInfo($limit,$classid){
        $param['where'] = 'classid in('.$classid.')';
        $param['order'] = 'time desc,id desc';
        $param['limit'] = $limit;
        return parent::selectModel($param);
    }
    
    //根据classid获取前台信息列表总数
    public function q_listCount($classid){
        $param['where'] = 'classid in('.$classid.')';
        return parent::countModel($param);
    }
    
    //article标签调用数据
    public function article_data($num,$order,$where,$remen,$tuijian){
        $param['limit'] = $num;
        $param['order'] = $order;
        //获取所有子栏目字符串
        $childArr = category::getClassChild($this->classid);
        foreach($childArr as $v){
            $classid[] = $v['classid'];
        }
        $classid = array_merge(array($this->classid),$classid ? $classid : array());
        $classid = implode(',',$classid);
        $param['where'][] = 'classid in('.$classid.')';;
        if($where) $param['where'][] = $where;
        if($remen) $param['where'][] = 'remen='.$remen;
        if($tuijian) $param['where'][] = 'tuijian='.$tuijian;
				$data = parent::selectModel($param);
        //赋值url和其他变量
        foreach($data as $v){
            $param['type'] = 'content';
            $param['classid'] = $v['classid'];
            $param['classpath'] = $GLOBALS['allclass'][$v['classid']]['classpath'];
            $param['time'] = $v['time'];
            $param['id'] = $v['id'];
            $v['classname'] = $GLOBALS['allclass'][$v['classid']]['classname'];
            $v['url'] = $v['url'] ? $v['url'] : url($param);
            $param['type'] = 'list';
            $v['classurl'] = $GLOBALS['allclass'][$v['classid']]['classurl'] ? $GLOBALS['allclass'][$v['classid']]['classurl'] : url($param);
            $v['classimage'] = $GLOBALS['allclass'][$v['classid']]['images'];
            $v['mname'] = $GLOBALS['allclass'][$v['classid']]['mname'];
            $v['mid'] = $GLOBALS['allclass'][$v['classid']]['mid'];
            $uid = $GLOBALS['allclass'][$v['classid']]['uid'];
            $v['parent_classid'] = $uid;
            $v['parent_classname'] = $GLOBALS['allclass'][$uid]['classname'];
            $v['parent_classimage'] = $GLOBALS['allclass'][$uid]['images'];
            $param['classid'] = $v['parent_classid'];
            $param['classpath'] = $GLOBALS['allclass'][$uid]['classpath'];
            $v['parent_classurl'] = $GLOBALS['allclass'][$uid]['classurl'] ? $GLOBALS['allclass'][$uid]['classurl'] : url($param);
            $newData[] = $v;
        }
        return $newData;
    }
    
    
    //查询内容的点击次数并且+1
    public function click($id,$classid){
        $param['where'][] = 'id='.$id;
        $param['where'][] = 'classid='.$classid;
        parent::queryModel("update ".DB_PRE.$this->tab[0]." set click=click+1 where id=$id and classid=$classid");
        $this->field = array('click');
        $num = parent::oneModel($param);
        return $num;
    }
    
    //根据内容id获取上一个和下一个数据
    public function prevData($id,$type=false){
        if($type == 'prev'){
            $param['where'][] = 'id < '.$id;
        }else if($type == 'next'){
            $param['where'][] = 'id > '.$id;
        }else{
            return;
        }
        $param['where'][] = 'classid='.$this->classid;
        $param['order'] = 'time desc';
        $data = parent::oneModel($param);
        if(!$data){
            $data['title'] = '没有了';
            $data['url'] = classurl($this->classid);
        }else{
            $url['type'] = 'content';
            $url['classid'] = $data['classid'];
            $url['classpath'] = $GLOBALS['allclass'][$data['classid']]['classpath'];
            $url['time'] = $data['time'];
            $url['id'] = $data['id'];
            $data['url'] = $data['url'] ? $data['url'] : url($url);
        }
        return $data;
    }
}
?>