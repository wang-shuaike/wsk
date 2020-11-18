<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   自定义表单
 */
defined('LMXCMS') or exit();
class FormModel extends Model{
    public function __construct(){
        parent::__construct();
        $this->field = array('*');
        $this->tab = array('dyform');
    }
    
    //获取表单数据
    public function getFormData($limit='',$where=''){
        $param['order'] = 'id desc';
        if($limit) $param['limit'] = $limit;
        if($where) $param['where'] = $where;
        return parent::selectModel($param);
    }
    
    //获取表单所属内容
    public function getContent($id,$limit,$fieldData){
        foreach($fieldData as $v){
            $fieldArr[] = $v['fieldname'];
        }
        $fieldArr = array_merge(array('cid','uid','time','ip'),$fieldArr);
        $this->contentDbInfo();
        $this->field = $fieldArr;
        $param['where'] = 'uid='.$id;
        $param['limit'] = $limit;
        $param['order'] = 'time desc';
        return parent::selectModel($param);
    }
    
    //根据id删除表单内容
    public function deleteCon($id='',$cid=''){
        $id = $id ? $id : (int)$_GET['id'];
        $cid = $cid ? $cid : (int)$_GET['cid'];
        $param['where'] = 'cid='.$cid;
        $fieldData = $this->getFormField($id);
        foreach($fieldData as $v){
            if($v['fieldtype'] == 'file'){
                $fileArr[] = $v['fieldname'];
            }
        }
        $this->contentDbInfo();
        //如果存在附件，则删除附件
        if($fileArr){
            $this->field = $fileArr;
            $fileDir = parent::oneModel($param);
            //遍历删除附件
            foreach($fileDir as $v){
                if($v) file::unLink(ROOT_PATH.trim($v,'/'));
            }
        }
        return parent::deleteModel($param);
    }
    
    //根据表单id获取所属字段数据
    public function getFormField($id){
        //获取表单字段id
        $formData = $this->one($id);
        $fidStr = $formData['fieldid'];
        //获取字段数据
        $this->fieldDbInfo();
        $param['where'] = 'fid in('.$fidStr.')';
        return parent::selectModel($param);
    }
    
    
    //获取表单所属内容总条数
    public function getContentCount($id){
        $this->contentDbInfo();
        $param['where'] = 'uid='.$id;
        return parent::countModel($param);
    }
    
    //根据id删除表单及表单所属内容
    public function delete(){
        $id = (int)$_GET['id'];
        $this->contentDbInfo();
        $this->field = array('cid');
        $param['where'] = 'uid='.$id;
        $formContent = parent::selectModel($param);
        //遍历删除表单内容
        foreach($formContent as $v){
            $this->deleteCon($id,$v['cid']);
        }
        //删除表单
        $this->tab = array('dyform');
        $param['where'] = 'id='.$id;
        parent::deleteModel($param);
    }
    //增加表单
    public function add(){
        return parent::addModel($this->formatForm());
    }
    
    //修改表单
    public function update($id){
        $param['where'] = 'id='.$id;
        return parent::updateModel($this->formatForm(),$param);
    }
    
    //初始化表单接收数据
    private function formatForm(){
        $arr['formname'] = trim($_POST['formname']);
        $arr['fieldid'] = implode(',',$_POST['fieldid']);
        $arr['must'] = implode(',',$_POST['must']);
        return $arr;
    }
    
    //根据表单id获取表单数据
    public function one($id){
        $this->tab = array('dyform');
        $this->field = array('*');
        $param['where'] = 'id='.$id;
        return parent::oneModel($param);
    }
    
    //获取表单数量
    public function countForm($where=''){
        if($where) $param['where'] = $where;
        return parent::countModel($param);
    }
    
    //获取字段数据
    public function getFieldData($where=''){
        $this->fieldDbInfo();
        $param['order'] = 'fid desc';
        if($where) $param['where'] = $where;
        return parent::selectModel($param);
    }

		//获取所有字段并返回字段空数组
		public function getFieldArrayData(){
			 $fieldData = $this->getFieldData("fieldtype='textarea'");
			 foreach($fieldData as $v){
				   $data[$v['fieldname']] = '';
			 }
			 return $data;
		}
    
    //字段表和字段
    private function fieldDbInfo(){
        $this->tab = array('dyfield');
        $this->field = array('*');
    }
    //内容表和字段
    private function contentDbInfo(){
        $this->tab = array('dyformcon');
        $this->field = array('*');
    }
    
    //根据字段名字验证字段是否存在
    public function isNameField($name){
        $this->fieldDbInfo();
        $param['where'] = "fieldname='$name'";
        return parent::countModel($param);
    }
    
    //增加记录字段
    public function addField($data){
        $this->fieldDbInfo();
        if(parent::addModel($data)){
            $this->addFieldDb($data['fieldname'],$data['fieldtype']);
        }
    }
    
    //增加数据表字段
    private function addFieldDb($name,$type){
        $type = $this->sqlFieldType($type);
        parent::fieldModel('dyformcon',$type,$name);
    }
    
    //根据字段类型返回数据库类型字符串
    private function sqlFieldType($type){
        $str = 'VARCHAR(255)';
        if($type == 'textarea' || $type == 'checkbox'){
            $str = 'TEXT';
        }
        return $str;
    }
    
    //根据id删除字段
    public function deleteField($fid){
        $this->fieldDbInfo();
        $this->field = array('fieldname');
        $param['where'] = 'fid='.$fid;
        $fname = parent::oneModel($param);
        if(!$fname) return;
        $fname = $fname['fieldname'];
        if(parent::delFieldModel('dyformcon',$fname)){ //删除数据表字段
            //删除字段记录
            parent::deleteModel($param);
        }
    }
    
    //增加表单内容
    public function addcontent($data){
        $this->contentDbInfo();
        return parent::addModel($data);
    }
}
?>