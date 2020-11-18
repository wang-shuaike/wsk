<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   html生成模块
 */
defined('LMXCMS') or exit();
class HtmlModel extends Model{
    private $html = null;
    public function __construct() {
        parent::__construct();
        if($this->html == null) $this->html = new html();
    }
    
    //生成首页
    public function home(){
        $this->html->set_config('index.php','','index.html');
        $this->html->setFile();
    }
    
    //按照classid生成栏目
    public function lists($classid){
        if($GLOBALS['allclass'][$classid]['classtype'] == 0){
            if($GLOBALS['allclass'][$classid]['islist'] == 1){
                //栏目列表
                $j = $this->getClassPage($classid);
                for($i=1;$i<=$j;$i++){
                    $filename = $i == 1 ? 'index.html' : 'index_'.$i.'.html';
                    $this->html->set_config('index.php?m=List&a=index&classid='.$classid.'&ishtml=1&count='.$j.'&curr='.$i,$GLOBALS['allclass'][$classid]['classpath'],$filename);
                    $this->html->setFile();
                }
            }else if($GLOBALS['allclass'][$classid]['islist'] == 0){
                //栏目封面
                $this->html->set_config('index.php?m=List&a=index&classid='.$classid,$GLOBALS['allclass'][$classid]['classpath'],'index.html');
                $this->html->setFile();
            }
            rewrite::speed('【'.$GLOBALS['allclass'][$classid]['classname'].'】栏目生成成功');
        }else if($GLOBALS['allclass'][$classid]['classtype'] == 1){
            $dir = pathinfo($GLOBALS['allclass'][$classid]['classpath']);
            $dirname = $dir['dirname'];
            $filename = $dir['basename'];
            $this->html->set_config('index.php?m=List&a=index&classid='.$classid,$dirname,$filename);
            $this->html->setFile();
            rewrite::speed('【'.$GLOBALS['allclass'][$classid]['classname'].'】栏目生成成功');
        }
    }
    
    //根据classid查询该共有多少分页
    public function getClassPage($classid){
        $this->tab = array($GLOBALS['allclass'][$classid]['tab']);
        $classidArr = category::getClassChild($classid,true);
        foreach($classidArr as $v){
            $classidStr[] = $v['classid'];
        }
        $classidStr = implode(',',$classidStr);
        $param['where'] = 'classid in('.$classidStr.')';
        $count = parent::countModel($param);
        if($count < 1) return 1;
        return ceil($count / $GLOBALS['allclass'][$classid]['pagenum']);
    }
    
    
    //按照模型mid生成内容页面
    public function scMidHtml($mid){
        if(!isset($GLOBALS['allmodule'][$mid])) return;
        global $config;
        $tab = $GLOBALS['allmodule'][$mid]['tab'];
        $this->tab = array($tab);
        $count = $this->tabCount($tab);
        if($count <= 0) return; 
        $pagenum = ceil($count/$config['sc_group_num']);
        for($i=0;$i<$pagenum;$i++){
            $limit = ($i*$config['sc_group_num']).','.$config['sc_group_num'];
            $data = $this->tabData($tab,$limit);
            if($data)$this->scIdHtml ($data);
            rewrite::speed('生成【'.$GLOBALS['allmodule'][$mid]['mname'].'】模型下第 <span><b>'.($i+1).'</b></span> 组内容成功');
        }
    }
    
    //生成内容页面，需要传入二维的数据数组
    public function scIdHtml($data){
        //遍历内容数组循环生成内容
        foreach($data as $v){
            $time = date('Ymd',$v['time']);
            //开始生成文件
            $this->html->set_config('index.php?m=Content&a=index&classid='.$v['classid'].'&id='.$v['id'],$GLOBALS['allclass'][$v['classid']]['classpath'].'/'.$time,$v['id'].'.html');  
            $this->html->setFile();
        }
    }
    
    
    //根据数据表返回信息总数
    public function tabCount($tab,$where=''){
        $this->tab = array($tab);
        if($where) $param['where'] = $where;
        return parent::countModel($param);
    }
    
    //根据数据表返回生成内容所需数据
    public function tabData($tab,$limit='',$where=''){
        $this->tab = array($tab);
        $this->field = array('id','classid','time');
        if($where) $param['where'] = $where;
        if($limit) $param['limit'] = $limit;
        return parent::selectModel($param);
    }
}
?>