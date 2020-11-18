<?php
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   搜索模块
 */
class SearchModel extends Model{
    public function __construct(){
        parent::__construct();
        $this->field=array('*');
        $this->tab = array('search');
    }
    
    //返回搜索关键数量
    public function count(){
        return parent::countModel();
    }
    
    //返回后台关键字列表
    public function lists($limit,$order='',$where=array()){
        $param['limit'] = $limit;
        $param['order'] = 'click desc';
        if($order) $param['order'] = $order;
        if($where) $param['where'][] = $where;
        return parent::selectModel($param);
    }
    
    //根据id删除搜索关键字
    public function delKey($sid){
        $param['where'] = "sid in($sid)";
        return parent::deleteModel($param);
    }
    //根据条件删除搜索关键字
    public function delWkey($click){
        $param['where'] = 'click < '.$click;
        return parent::deleteModel($param);
    }
    
    //初始化搜索字段信息
    public function getSerachField($arr){
        $arr['tem'] = $arr['tem'] ? $arr['tem'] : 'index';
        $arr['ischild'] = $arr['ischild'] ? true : false;
        $arr['field'] = $arr['field'] ? $arr['field'] : 'title';
        if($arr['time'])$arr['time'] = time() - $arr['time'] * 24 * 3600;
        return $arr;
    }
    
    //返回搜索信息列表
    public function getSearchList($searchInfo,$is=false){
        $param = $this->sqlStr($searchInfo);
        $search_data = parent::selectModel($param);
        //判断前台保存、更新关键字
        if($is && $is['keywords']){
            $this->tab = array('search');
            $url = '/index.php?'.$_SERVER['QUERY_STRING'];
            if($this->is_keywords($is['keywords'])){
                //如果不是翻页，那么点击数加1
                if(!isset($_GET['page'])) parent::queryModel("update ".DB_PRE."search set click=click+1,url='$url',time='".time()."' where keywords='".$is['keywords']."'");
            }else{
                //保存关键字
                $data['keywords'] = $is['keywords'];
                $data['click'] = 1;
                $data['classid'] = $is['classid'];
                $data['mid'] = $is['mid'];
                $data['time'] = time();
                $data['url'] = $url;
                parent::addModel($data);
            }
        }
        return $search_data;
    }
    
    //根据关键字查询是否存在
    private function is_keywords($name){
        $param['where'] = "keywords='$name'";
        return parent::countModel($param);
    }
    
    //获取搜索总条数
    public function searchCoutn($searchInfo){
        $param = $this->sqlStr($searchInfo);
        return parent::countModel($param);
    }
    
    //获取sql数据条件
    private function sqlStr($search){
        $sql= '';
        if($search['mid']){
            $this->tab = array($GLOBALS['allmodule'][$search['mid']]['tab']);
        }else if($search['classid']){
            $this->tab = array($GLOBALS['allclass'][$search['classid']]['tab']);
        }else{
            exit('没有找到数据表');
        }
        if($search['is_home']){
            $this->field = array('*');
        }else{
            $this->field = array('id','title','classid','time','tuijian','remen','url');
        }
        //后台专属条件
        if($search['attr'] == 1){
            $param['where'][] = 'remen!=0';
        }
        if($search['attr'] == 2){
            $param['where'][] = 'tuijian!=0';
        }
        //时间
        if($search['time']){
            $param['where'][] = 'time > '.$search['time'];
        }
        //推荐
        if(isset($search['tuijian'])){
            $param['where'][] = 'tuijian='.$search['tuijian'];
        }
        //热门
        if(isset($search['remen'])){
            $param['where'][] = 'remen='.$search['remen'];
        }
        //搜索字段
        $search['field'] = explode(',',$search['field']);
        foreach($search['field'] as $v){
            $like[] = $v." like '%".$search['keywords']."%'";
        }
        $param['like'] = '('.implode(' or ',$like).')';
        $param['order'] = 'id desc';
        //调用数量
        if($search['page']){
            $param['limit'] = $search['page'];
        }
        //获取子栏目
        if($search['classid']){
            //获取所有子栏目
            $child = category::getClassChild($search['classid'],true);
            foreach($child as $v){
                if($v['classtype'] == 0){
                    $classidArr[] = $v['classid'];
                }
            }
            $param['where'][] = 'classid in('.implode($classidArr,',').')';
        }
        return $param;
    }
}
?>