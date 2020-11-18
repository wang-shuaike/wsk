<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   友情链接模块
 */
defined('LMXCMS') or exit();
class LinkModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->field=array('*');
        $this->tab=array('link');
    }
    
    //获取链接列表
    public function getData($limit='',$where='',$order=''){
        if($where) $param['where'] = $where;
        if($limit) $param['limit'] = $limit;
        $param['order'] = 'sort desc,id desc';
        if($order) $param['order'] = $order;
        return parent::selectModel($param);
    }
    
    //增加
    public function add($data){
        unset($data['addLink']);
        parent::addModel($data);
    }
    
    //修改
    public function updateLink($data){
        $param['where'] = 'id='.$data['id'];
        unset($data['updateLink']);
        unset($data['id']);
        parent::updateModel($data,$param);
    }
    
    //根据id获取一条数据
    public function getOne($id=false){
        $id = $id ? $id : (int)$_GET['id'];
        if(!$id) return;
        $param['where'] = 'id='.$id;
        return parent::oneModel($param);
    }
    
    //获取链接数量
    public function count($where=''){
        if($where) $param['where'] = $where;
        return parent::countModel($param);
    }
    
    //友情链接排序
    public function sort(){
        $idArr = $_POST['id'];
        $sortArr = $_POST['sort'];
        foreach($idArr as $k => $v){
            $param['where'] = 'id='.$v;
            $data['sort'] = (int)$sortArr[$k];
            parent::updateModel($data,$param);
        }
    }
    
    //删除链接
    public function delete(){
        $id = (int)$_GET['id'];
        //获取数据
        $data = $this->getOne($id);
        $param['where'] = 'id='.$id;
        parent::deleteModel($param);
        //判断是否有图片
        if($data['img'] && $data['isimg']){
            $fileObj = new FileModel();
            $fileObj->deleteName($data['img']);
        }
    }
}
?>