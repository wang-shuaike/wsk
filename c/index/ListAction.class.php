<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   前台栏目页面控制器
 */
defined('LMXCMS') or exit();
class ListAction extends HomeAction{
    private $classid;
    private $contentModel = null;
    private $columnModel = null;
    public function __construct(){
        parent::__construct();
        $this->classid = (int)$_POST['classid'] ? (int)$_POST['classid'] : (int)$_GET['classid'];
        if(!$this->classid || !isset($GLOBALS['allclass'][$this->classid])){
            //栏目不存在或者参数发生错误时，该地方可以定义错误页面，现在是直接停止程序运行
            exit;
        }
        if($GLOBALS['allclass'][$this->classid]['classtype'] == 2){
            //外部链接直接跳转
            rewrite::php_url($GLOBALS['allclass'][$this->classid]['classurl']);
        }
    }
    
    public function index(){
        $classData = $GLOBALS['allclass'][$this->classid]; //当前栏目数组
        $parentData = $GLOBALS['allclass'][$classData['uid']];//父栏目数组
        $classData['classurl'] = classurl($classData['classid']);
        if($parentData)$parentData['classurl'] = classurl($parentData['classid']);
        $this->smarty->assign('classData',$classData);//注入栏目变量数组
        $this->smarty->assign('parentData',$parentData);//注入父栏目数组
        //注入栏目相关变量
        category::assign_class($classData,$parentData,$this->smarty);
        $this->smarty->assign('title',$classData['title']);
        $this->smarty->assign('keywords',$classData['keywords']);
        $this->smarty->assign('description',$classData['description']);
        $this->smarty->assign('navpos', navpos($this->classid)); //注入当前位置
				$this->smarty->assign('topid',category::getClassTopId($this->classid));
        if($classData['classtype'] == 0){
            $this->classList();
        }else if($classData['classtype'] == 1){
            $this->classSingle();
        }
    }
    
    //单页栏目
    private function classSingle(){
        if($this->columnModel == null) $this->columnModel = new ColumnModel();
        $content = string::html_char_dec($this->columnModel->getOneSingleContent($this->classid));
        $this->smarty->assign('classcontent',$content);
        $this->smarty->display('single/'.$GLOBALS['allclass'][$this->classid]['singletem'].'.html');
    }
    
    //普通栏目
    private function classList(){
        //判断是否为栏目列表
        if($GLOBALS['allclass'][$this->classid]['islist'] == 1){
            if($this->contentModel == null) $this->contentModel = new ContentModel($this->classid);
            $classidArr = category::getClassChild($this->classid,true);
            foreach($classidArr as $v){
                $classidStr[] = $v['classid'];
            }
            $classidStr = implode(',',$classidStr);
            $count = $this->contentModel->q_listCount($classidStr);
            $page = new page($count,$GLOBALS['allclass'][$this->classid]['pagenum']);
            $data = $this->contentModel->q_listInfo($page->returnLimit(),$classidStr);
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
                $newData[] = $v;
            }
            $this->smarty->assign('num',$count);
            $this->smarty->assign('pagenum',$count);
            $this->smarty->assign('page',$page->html()); //注入页码变量
            $this->smarty->assign('list',$newData); //注入信息列表变量
        }
        $this->smarty->display('column/'.$GLOBALS['allclass'][$this->classid]['listtem'].'.html');
    }
}
?>