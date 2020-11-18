<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   前台内容页面控制器
 */
defined('LMXCMS') or exit();
class ContentAction extends HomeAction{
    private $classid;
    private $id;
    private $contentModel = null;
    public function __construct(){
        parent::__construct();
        $this->classid = (int)$_POST['classid'] ? (int)$_POST['classid'] : (int)$_GET['classid'];
        $this->id = (int)$_POST['id'] ? (int)$_POST['id'] : (int)$_GET['id'];
        if(!$this->classid || !isset($GLOBALS['allclass'][$this->classid]) || !$this->id){
            //内容页面出现错误给出的提示
            exit;
        }
        $this->contentModel = new ContentModel($this->classid);
    }
    
    public function index(){
        //获取上一页和下一页地址
        $prev = $this->contentModel->prevData($this->id,'prev');
        $next = $this->contentModel->prevData($this->id,'next');
        $classData = $GLOBALS['allclass'][$this->classid]; //当前栏目数组
        $parentData = $GLOBALS['allclass'][$classData['uid']];//父栏目数组
        $classData['classurl'] = classurl($classData['classid']);
        if($parentData)$parentData['classurl'] = classurl($parentData['classid']);
        $this->smarty->assign('classData',$classData);//注入栏目变量数组
        $this->smarty->assign('parentData',$parentData);//注入父栏目数组
        //注入栏目相关变量
        category::assign_class($classData,$parentData,$this->smarty);
        $this->smarty->assign('navpos', navpos($this->classid)); //注入当前位置
        $this->smarty->assign('clicknum',"<script type=\"text/javascript\" src=\"".$GLOBALS['public']['weburl']."index.php?m=content&a=clicknnum&classid=".$this->classid."&id=".$this->id."\"></script>");
        $data = $this->contentModel->updateData($this->id);
        foreach($data as $k => $v){
            $this->smarty->assign($k,$v);
        }
        $this->smarty->assign('prev',$prev);
        $this->smarty->assign('next',$next);
	$this->smarty->assign('topid',category::getClassTopId($this->classid));
        $this->smarty->display('content/'.$classData['contem'].'.html');
    }
		
    //内容点击次数显示及统计
    public function clicknnum(){
        $num = $this->contentModel->click($this->id,$this->classid);
        echo "document.write('".$num['click']."');";
    }
}
?>