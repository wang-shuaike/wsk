<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   留言模块
 */
defined('LMXCMS') or exit();
class BookModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->field=array('*');
        $this->tab=array('book');
    }
    
    //获取留言数据
    public function getData($limit='',$where=''){
        $param['where'][] = 'uid=0';
        $param['order'] = 'id desc';
        if($limit) $param['limit'] = $limit;
        if($where) $param['where'][] = $where;
        $data = parent::selectModel($param);
        foreach($data as $v){
            $id[] = $v['id'];
        }
        if(!$data) return;
        $reply = $this->getReply($id); //获取回复
        //组合
        foreach($data as $v){
            $v['isreply'] = 0;
            if($reply){
                foreach($reply as $value){
                    if($v['id'] == $value['uid']){
                         $v['isreply'] = 1;
                         $v['replyid'] = $value['id'];
                         $v['replycon'] = $value['content'];
                         $v['replytime'] = $value['time'];
                         $v['username'] = $value['name'];
                    }
                }
            }
            $newdata[] = $v;
        }
        return $newdata;
    }
    
    //获取留言总数量
    public function count($where=''){
        $param['where'][] = 'uid=0';
        if($where) $param['where'][] = $where;
        return parent::countModel($param);
    }
    
    //根据留言id获取全部回复
    public function getReply(array $id){
        $id = implode(',',$id);
        $param['where'] = 'uid in('.$id.')';
        return parent::selectModel($param);
    }
    
    //审核和取消审核
    public function ischeck(){
        $data['ischeck'] = $_GET['check'] ? 1 : 0;
        $param['where'] = 'id='.(int)$_GET['id'];
        parent::updateModel($data,$param);
    }
    
    //删除留言
    public function delete(){
        $isreply = (int)$_GET['isreply'] ? true : false;
        $id = (int)$_GET['id'];
        //删除回复
        if($isreply) parent::deleteModel(array('where' => 'uid='.$id));
        //删除留言
        parent::deleteModel(array('where' => 'id='.$id));
    }
    
    //管理回复留言
    public function reply($data){
        $conData = p(1,1);
        if($data['type'] == 'add'){
            //增加回复
            $addData = array(
                'content' => $conData['content'],
                'uid'     => $data['id'],
                'name'    => $data['username'],
                'time'    => time(),
            );
            parent::addModel($addData);
        }else if($data['type'] == 'update'){
            //修改回复
            $param['where'] = 'uid='.$data['id'];
            parent::updateModel(array('content'=>$conData['content']),$param);
        }
    }
    
    //前台增加留言
    public function add($data){
        $data['ip'] = getip();
        $data['time'] = time();
        return parent::addModel($data);
    }
}
?>