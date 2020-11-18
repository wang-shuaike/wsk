<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   文件管理模块
 */
defined('LMXCMS') or exit();
class FileModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->field = array('fid','type','name','temname','path','time','size','issmall');
        $this->tab = array('file');
    }
    
    //增加文件 
    public function add($file,$type){
        $arr['type'] = $type;
        $arr['name'] = $file['filename'];
        $arr['temname'] = $file['name'];
        $arr['path'] = $file['url'];
        $arr['time'] = time();
        if($file['size'] > (1024 * 1024)){
            $size = round(($file['size'] / 1024 / 1024),2).'MB';
        }else if($file['size'] > 1024){
            $size = round(($file['size'] / 1024),2).'KB';
        }else{
            $size = $file['size'].'B';
        }
        $arr['size'] = $size;
        $arr['issmall'] = $file['issmall'] ? 1 : 0;
        parent::addModel($arr);
     }
     
     //获取数据 文件类型，当前limit
     public function getData($type,$limit){
         $param['limit'] = $limit;
         $param['where'] = 'type='.$type;
         $param['order'] = 'time desc';
         return parent::selectModel($param);
     }
     
     //获取图片或者文件的所有数量 文件类型
     public function count($type){
         $param['where'] = 'type='.$type;
         return parent::countModel($param);
     }
     
     //删除
     public function delete($data){
         $param['where'][] = 'type='.$data['type'];
         foreach($data['fid'] as $k => $v){
             $fileInfo = explode('#####',$v);
             $fid[] = $fileInfo[0];
             $path[] = trim($fileInfo[1],'/');
         }
         $fid = implode(',',$fid);
         $param['where'][] = 'fid in('.$fid.')';
         if(parent::deleteModel($param)){
             //删除文件
             foreach($path as $v){
                 file::unLink(ROOT_PATH.$v);
             }
         }
     }
     
    //根据图片名字删除图片数据库记录和文件 传入文件路径
    public function deleteName($path){
        $fileinfo = pathinfo($path);
        $param['where'] = "name='".$fileinfo['basename']."'";
        if(parent::deleteModel($param)){//删除数据库记录
            //删除文件
            file::unLink(ROOT_PATH.trim($fileinfo['dirname'].'/'.$fileinfo['basename'],'/'));
        }
    }
}
?>