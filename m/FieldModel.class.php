<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   模型字段模块
 */
class FieldModel extends Model{
    public function __construct() {
        parent::__construct();
        $this->tab = array('field');
        $this->field = array('*');
    }
    
    
    //根据mid获取字段数组
    public function getMidField($mid){
        $param['where'] = 'mid='.$mid;
        $param['order'] = 'sort desc,fid desc';
        return parent::selectModel($param);
    }
    
    //根据mid生成字段缓存文件
    public function cachemidforfile($mid){
        $fieldArr = $this->getMidField($mid);
        $fieldArr = tool::arrV2K($fieldArr,'fid');
        $all = $GLOBALS['allfield'];
        $all[$mid] = $fieldArr;
        //存储缓存文件
        f('public/field',$all,true);
    }
    
    //更新字段排序 
    public function sort(){
        $sort = $_POST['sort'];
        $fid = $_POST['fid'];
        $mid = (int)$_POST['mid'];
        $param['where'][0] = 'mid='.$mid;
        foreach($fid as $k => $v){
            $param['where'][1] = 'fid='.$v;
            $data['sort'] = (int)$sort[$k] ? (int)$sort[$k] : 0;
            parent::updateModel($data,$param);
        }
        $this->cachemidforfile($mid);//更新字段缓存
        $this->cacheInfomidform($mid);//更新表单html
    }
    //修改字段
    public function updateField($data){
        $fid = $data['fid'];
        $mid = $data['mid'];
        unset($data['fid']);
        unset($data['mid']);
        unset($data['updateField']);
        $param['where'] = 'fid='.$fid;
        parent::updateModel($data,$param);
        $this->cachefield();//更新字段文件缓存
        $this->cacheInfomidform($mid); //更新模型表单文件缓存
    }
    //删除字段
    public function deleteField($mid,$fid,$fData){
        $param['where'][] = 'fid='.$fid;
        $param['where'][] = 'mid='.$mid;
        parent::deleteModel($param);//删除记录字段
        $tab = $fData['vice'] ? $GLOBALS['allmodule'][$mid]['tab'].'_1' : $GLOBALS['allmodule'][$mid]['tab'];
        parent::delFieldModel($tab,$fData['fname']); //删除数据表字段
        $this->cachefield();//更新字段文件缓存
        $this->cacheInfomidform($mid); //更新模型表单文件缓存
    }
    
    //返回所有字段
    public function getField(){
        $param['order'] = 'sort desc,fid desc';
        return parent::selectModel($param);
    }
    
    //生成所有字段缓存文件
    public function cachefield(){
        $data = $this->getField();
        $newdata = array();
        foreach($data as $v){
           $newdata[$v['mid']][$v['fid']] = $v;
        }
        //存储缓存文件
        f('public/field',$newdata,ture);
    }
    
    //增加系统默认的content字段的记录
    public function addcontentStr($mid){
        $field = array(
            'mid' => $mid,
            'fname' => 'content',
            'ftitle' => '正文',
            'ftype' => 'editor',
            'vice' => 1,
            'defaults' => '',
        );
        parent::addModel($field);
    }
    
    //根据所属mid删除模型字段
    public function del2mid($mid){
        $param['where'] = 'mid='.$mid;
        parent::deleteModel($param);
    }
    
    
    //生成所有模型信息表单缓存文件
    public function cacheInfoform(){
        $field = category::getField();
        $module = category::allmodule();
        foreach($module as $v){
            $this->cacheInfomidform($v['mid'],$field[$v['mid']]);
        }
    }
    
    //根据mid生成模型表单缓存文件
    public function cacheInfomidform($mid,$fieldArr=array()){
        $form = '';
        $fieldArr ? $fieldArr : $fieldArr = category::getField($mid);
        foreach($fieldArr as $v){
            $form .= "<tr>\r\n<td align='right' width='12%'>".$v['ftitle']."：</td>\r\n<td width='88%'>".$this->getfieldhtml($v)."</td>\r\n</tr>\r\n";
        }
        $str="<?php \r\n if(!defined('LMXCMS')){exit();} \r\n //本文件为缓存文件 无需手动更改\r\n ?>";
        file::put(ROOT_PATH.'data/form/'.$mid.'.php',$str.$form);
    }
    
    //根据字段类型返回字段的表单html
    private function getfieldhtml($field){
        $field['defaults'] = string::html_char($field['defaults']);
        switch($field['ftype']){
            case 'text' : $str = $this->text_html($field); break;
            case 'pwd' : $str = $this->pwd_html($field); break;
            case 'textarea' : $str = $this->textaret_html($field); break;
            case 'editor' : $str = $this->edit_html($field); break;
            case 'selects' : $str = $this->select_html($field); break;
            case 'checkbox': $str = $this->checkbox_html($field); break;
            case 'radio' : $str = $this->radio_html($field); break;
            case 'image' : $str = $this->image_html($field); break;
            case 'file' : $str = $this->file_html($field); break;
            case 'date' : $str = $this->date_html($field); break;
            case 'moreimage' : $str = $this->moreimage_html($field); break;
            case 'morefile' : $str = $this->morefile_html($field);break;
        }
        return $str;
    }
    //返回多文件表单html
    private function morefile_html($data){
        return "<div class='morefile'><h3>文件列表</h3><ul id='".$data['fname']."'><{if \$update && $".$data['fname']."}><{assign var='".$data['fname']."' value='#####'|explode:$".$data['fname']."}><{foreach from=$".$data['fname']." item=v}><li><input type='text' name='".$data['fname']."[]' class='inputText inputWidth' value='<{\$v}>'> <span class='red'>移除</span></li><{/foreach}><{/if}></ul><input type='button' value='上传文件' class='inputSub1' onclick=\"selectUpload(2,'file/d/<{\$classData.classpath}>','".$data['fname']."',1)\" />&nbsp;<input type='button' class='inputSub1 addfile' value='远程地址' /></div>";
    }
    //返回多图片表单html
    private function moreimage_html($data){
        return "<div class='morefile'><h3>图片列表</h3><ul id='".$data['fname']."'><{if \$update && $".$data['fname']."}><{assign var='".$data['fname']."' value='#####'|explode:$".$data['fname']."}><{foreach from=$".$data['fname']." item=v}><li><input type='text' name='".$data['fname']."[]' class='inputText inputWidth' value='<{\$v}>'> <span class='red'>移除</span></li><{/foreach}><{/if}></ul><input type='button' value='上传图片' class='inputSub1' onclick=\"selectUpload(1,'file/d/<{\$classData.classpath}>','".$data['fname']."',1)\" />&nbsp;<input type='button' class='inputSub1 addfile' value='远程地址' /></div>";
    }
    
    //返回时间表单html
    private function date_html($data){
        $form = "<input type='text' name='".$data['fname']."' id='".$data['fname']."' value='<{if \$update}><{\$".$data['fname']."|date_format:'%Y-%m-%d %H:%M:%S'}><{else}><{\$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}><{/if}>'>"; 
        $form .= "<input type='button' class='inputSub1' value='获取当前时间' onclick=\"document.getElementById('".$data['fname']."').value='<{\$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}>'\">";
        return $form;
    }
    
    //返回文件表单html
    private function file_html($data){
        return "<input type='text' id='".$data['fname']."' name='".$data['fname']."' class='inputText inputWidth' value='<{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}>' /><input type='button' value='上传' class='inputSub1' onclick=\"selectUpload(2,'file/d/<{\$classData.classpath}>','".$data['fname']."',0)\" />";
    }
    
    //返回图片表单html
    private function image_html($data){
        return "<input type='text' id='".$data['fname']."' name='".$data['fname']."' class='inputText inputWidth' value='<{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}>' /><input type='button' value='上传' class='inputSub1' onclick=\"selectUpload(1,'file/d/<{\$classData.classpath}>','".$data['fname']."',0)\" />";
    }
    
    //返回单选框表单html
    private function radio_html($data){
        $form = "";
        if($data['defaults']){
            $defaults = $this->formatFieldDefault($data['defaults']);
            foreach($defaults as $k=>$v){
                if(!isset($v['value'])){
                    $v['value'] = $v['key'];
                }
                $form .= "<label for='".$data['fname']."$k'><input type='radio' value='".$v['value']."'<{if \$update && \$".$data['fname']." eq '".$v['value']."'}> checked<{/if}> name='".$data['fname']."' id='".$data['fname']."$k' />".$v['key']."</label> ";
            }
        }
        return $form;
    }
    
    //返回多选框表单html
    private function checkbox_html($data){
        $form = "";
        if($data['defaults']){
            $defaults = $this->formatFieldDefault($data['defaults']);
            $form = "<{assign var='".$data['fname']."' value='#####'|explode:$".$data['fname']."}>";
            foreach($defaults as $k=>$v){
                if(!isset($v['value'])){
                    $v['value'] = $v['key'];
                }
                $form .= "<label for='".$data['fname']."$k'><input type='checkbox' value='".$v['value']."'<{if \$update && in_array('".$v['value']."',\$".$data['fname'].")}> checked<{/if}> name='".$data['fname']."[]' id='".$data['fname']."$k' />".$v['key']."</label> ";
            }
        }
        return $form;
    }
    
    //返回下拉框表单html
    private function select_html($data){
        if($data['defaults']){
            $defaults = $this->formatFieldDefault($data['defaults']);
            foreach($defaults as $v){
                if(!isset($v['value'])){
                    $v['value'] = $v['key'];
                }
                $option .= "<option value='".$v['value']."'<{if \$update && \$".$data['fname']." eq '".$v['value']."'}> selected<{/if}>>".$v['key']."</option>";
            }
        }
        $form = "<select name='".$data['fname']."' id='".$data['fname']."'>$option</select>";
        return $form;
    }
    
    //返回text表单html
    private function text_html($data){
        return "<input type='text' class='inputText inputWidth' name='".$data['fname']."' id='".$data['fname']."' value='<{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}>' />";
    }
    
    //返回pwd表单html
    private function pwd_html($data){
        return "<input type='password' class='inputText inputWidth' name='".$data['fname']."' id='".$data['fname']."' value='<{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}>' />";
    }
    
    //返回多行文本框表单html
    private function textaret_html($data){
        return "<textarea class='textarea' name='".$data['fname']."' id='".$data['fname']."'><{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}></textarea>";
    }
    
    //返回编辑器表单html
    private function edit_html($data){
        $str = '';
        $path = '?m=Edit&a=editUpload&path=';
        $url = $_SERVER['SCRIPT_NAME'].$path;
        $editObj = edit::getEditObj(); //获取编辑器对象
        $editObj->sub();//获取按钮字符串
        $configs = implode("','",$editObj->sub);
        $configs = "'".$configs."'";
        $str.="<textarea id='".$data['fname']."' name='".$data['fname']."'  style='width:100%;height:300px;'><{if \$update}><{\$".$data['fname']."}><{else}>".$data['defaults']."<{/if}></textarea>";
        $str.="<script type='text/javascript'>UE.getEditor('".$data['fname']."',{toolbars:[[$configs]],imagePath:'/file/d/<{\$classData.classpath}>/',imageUrl:'".$url."/file/d/<{\$classData.classpath}>/',filePath:'/file/d/<{\$classData.classpath}>/',fileUrl:'".$url."/file/d/<{\$classData.classpath}>/'})</script>";
        return $str;
    }
    
    
    //根据mid删除表单html缓存文件
    public function del_htmlForm($mid){
        file::unLink(ROOT_PATH.'data/form/'.$mid.'.php');
    }
    
    //根据字段名字和mid验证字段是否存在
    public function is_fname($fname,$mid){
        $param['where'][] = "fname='$fname'";
        $param['where'][] = 'mid='.$mid;
        return parent::countModel($param);
    }
    
    //增加字段
    public function add($data){
        unset($data['addField']);
        $this->addTabField($data); //增加数据表字段
        parent::addModel($data);//增加字段记录
        //生成字段缓存文件
        $this->cachemidforfile($data['mid']);
        //生成表单html
        $this->cacheInfomidform($data['mid']);
    }
    
    //根据字段类型增加模型数据表字段
    private function addTabField($data){
        $tab = $GLOBALS['allmodule'][$data['mid']]['tab'];
        $type = '';
        switch($data['ftype']){
            case 'text' : $type = 'VARCHAR(255)';break;
            case 'pwd' : $type = 'VARCHAR(255)';break;
            case 'textarea' : $type = 'TEXT';break; //不能有默认值
            case 'editor' : $type = 'MEDIUMTEXT'; break; //不能有默认值
            case 'selects' : $type = 'VARCHAR(255)';break;
            case 'checkbox' : $type = 'VARCHAR(255)';break;
            case 'radio' : $type = 'VARCHAR(255)';break;
            case 'image' : $type = 'VARCHAR(255)';break;
            case 'moreimage' : $type = 'TEXT';break;
            case 'file' : $type = 'VARCHAR(255)';break;
            case 'morefile' : $type = 'TEXT';break;
            case 'date' : $type= 'INT(10) UNSIGNED'; break;
        }
        parent::fieldModel($tab,$type,$data['fname']);
    }
    
    //格式化字段默认值
    public function formatFieldDefault($str){
        $str = str_replace(array("\r","\n","\s"),',',$str);
        $str = preg_replace('/[,]+/',',',$str);
        $str = str_replace("\r",',',$str);
        $str = explode(",",$str);
        foreach($str as $k=>$v){
            $a = explode('==',$v);
            $arr[$k]['key'] = trim($a['0']);
            if(isset($a['1'])){
                $arr[$k]['value'] = trim($a['1']);
            }
        }
        return $arr;
    }
}
?>