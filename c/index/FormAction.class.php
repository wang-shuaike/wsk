<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   接收自定义表单数据并保存
 */
defined('LMXCMS') or exit();
class FormAction extends HomeAction{
    private $formModel = null;
    private $id; //表单id
    private $field; //表单所属字段
    private $isfile = false; //是否有文件字段
    private $filepath; //上传文件保存路径
    private $form; //表单数据
    private $must; //必填字段
    
    public function __construct() {
        parent::__construct();
        $this->formTime(); //设置再次提交时间
        $this->id = (int)$_POST['id'];
        if(!$this->id) exit;
        if($this->formModel == null) $this->formModel = new FormModel();
        $this->filepath = $this->config['q_dyform_filepath'] ? $this->config['q_dyform_filepath'] : 'file/dy';
        $this->runForm(); //初始化各项数据
    }
    
    public function index(){
        $data = $this->formatData();
        if($this->isfile){
            //处理文件上传
            $fileArr = $this->updateFile();
        }
        $data = $fileArr ? array_merge($data,$fileArr) : $data;
        $data['uid'] = $this->id;
        $data['time'] = time();
        $data['ip'] = getip();
        $this->formModel->addcontent($data);
        $this->setFormTime(); //保存表单提交时间
        rewrite::succ($this->l['dy_ok']);
    }
    
    //过略无用的数据并排除非法数据并验证必填数据并返回
    private function formatData(){
        foreach($this->field as $k => $v){
            $data[$v['fieldname']] = $_POST[$v['fieldname']];
            $this->field[$v['fieldname']] = $v;
            unset($this->field[$k]);
            //判断是否有文件字段
            if($v['fieldtype'] == 'file') $this->isfile[] = $v['fieldname'];
        }
	$data = p($data,1,1);
        $data = string::forDelhtml($data); //去掉html标签
        //验证必填字段
        foreach($this->must as $v){
            if($this->isfile && in_array($v,$this->isfile)){
                //验证文件
                if(!$_FILES[$v]['tmp_name']) rewrite::error('“'.$this->field[$v]['fieldtitle'].'”'.$this->l['dy_must']);
            }else{
                //验证普通数据
                if(!$data[$v]) rewrite::error('“'.$this->field[$v]['fieldtitle'].'”'.$this->l['dy_must']);
            }
        }
        foreach($data as $k => $v){
            if(is_array($v)){
                $v = implode('|',$v);
            }
            $newData[$k] = $v;
        }
	$fieldArray = $this->formModel->getFieldArrayData();
        return array_merge($fieldArray,$newData);
    }
    
    //获取表单数据和所属字段数据
    private function runForm(){
        $this->form = $this->formModel->one($this->id);
        if(!$this->form) rewrite::error('自定义表单不存在');
        $this->must = explode(',',$this->form['must']);
        $this->field = $this->formModel->getFieldData('fid in('.$this->form['fieldid'].')');
    }
    
    //处理文件上传并返回上传文件路径
    private function updateFile(){
        $upload = new upload();
        $upload->setConfig('fix',$this->config['q_upload_file_pre']);
        $upload->setConfig('maxSize',$this->config['q_update_max_size']);
        if($upload->upload($this->filepath)){
            $ok = $upload->getSucc();
            foreach($ok as $v){
                $arr[$v['formname']] = $v['url'];
            }
            return $arr;
        }else{
            rewrite::error($upload->getMsg());
        }
    }
}
?>