<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   后台生成静态控制器
 */
defined('LMXCMS') or exit();
class SchtmlAction extends AdminAction{
    private $htmlModel = null;
    public function __construct(){
        parent::__construct();
        if(!$GLOBALS['public']['ishtml']) rewrite::error('请先开启纯静态模式','?m=Basic&a=index');
        if($this->htmlModel == null) $this->htmlModel = new HtmlModel();
        set_time_limit(0); //不限制php执行时间
    }
    
    //生成首页
    public function index(){
        $this->htmlModel->home();
        rewrite::succ('首页生成成功','?m=Schtml&a=lists');
    }
    
    //生成列表页面
    public function lists(){
        if(isset($_POST['scform'])){
            $this->smarty->assign('info','生成栏目中，请勿刷新');
            $this->smarty->display('speed.html');
            if(isset($_POST['allclass'])){
                $this->sc_allList();
            }else if(isset($_POST['classidsub'])){
                $this->sc_classidaction();
            }
            rewrite::speedSucc('生成完毕');
            rewrite::speedInfoBack('生成栏目成功');
            exit;
        }
        $this->smarty->assign('classdata',category::classSelect());
        $this->smarty->display('Schtml/list.html');
    }
    
    //生成内容页面
    public function content(){
        if(isset($_POST['scform'])){
            $this->smarty->assign('info','生成内容中，请勿刷新');
            $this->smarty->display('speed.html');
            if(isset($_POST['allsub'])){
                $this->allContent();
            }else if(isset($_POST['idsub'])){
                $this->idContent();
            }else if(isset($_POST['midsub'])){
                $this->midContent();
            }else if(isset($_POST['classidsub'])){
                $this->classidContent();
            }else if(isset($_POST['timesub'])){
                $this->timeContent();
            }
            rewrite::speedSucc('生成完毕');
            rewrite::speedInfoBack('生成栏目成功');
            exit;
        }
        $this->smarty->assign('modData',$GLOBALS['allmodule']);
        $this->smarty->assign('classdata',category::classSelect());
        $this->smarty->display('Schtml/content.html');
    }
    //按照栏目生成内容
    private function classidContent(){
        $classidArr = $_POST['classid'];
        foreach($classidArr as $v){
            if(!isset($GLOBALS['allclass'][$v]) || $GLOBALS['allclass'][$v]['classtype'] != 0) continue; //过滤非普通栏目和不存在的栏目
            $tab = $GLOBALS['allclass'][$v]['tab'];
            if(!$tab) continue; //如果数据表不存在跳过
            $where = 'classid='.$v;
            $count = $this->htmlModel->tabCount($tab,$where);
            if($count <= 0){
                rewrite::speed('【'.$GLOBALS['allclass'][$v]['classname'].'】栏目没有信息');
                continue; //如果没有数据跳过此栏目
            }
            //开始分组
            $pagenum = ceil($count/$this->config['sc_group_num']);
            for($i=0;$i<$pagenum;$i++){
                $limit = ($i*$this->config['sc_group_num']).','.$this->config['sc_group_num'];
                $data = $this->htmlModel->tabData($tab,$limit,$where);
                if($data)$this->htmlModel->scIdHtml($data);
                rewrite::speed('生成【'.$GLOBALS['allclass'][$v]['classname'].'】栏目下第 <span><b>'.($i+1).'</b></span> 组内容成功');
            }
        }
    }
    
    //按照模型生成内容
    private function midContent(){
        $mid = (int)$_POST['mid'];
        $this->htmlModel->scMidHtml($mid);
    }
    //生成全部内容
    private function allContent(){
        foreach($GLOBALS['allmodule'] as $v){
            $this->htmlModel->scMidHtml($v['mid']);
        }
    }
    
    //按照内容id生成内容
    private function idContent(){
        $classid = (int)$_POST['classid'];
        if(!isset($GLOBALS['allclass'][$classid]) || $GLOBALS['allclass'][$classid]['classtype'] != 0) return;
        $start = (int)$_POST['idstar'];
        $end = (int)$_POST['idend'];
        $tab = $GLOBALS['allclass'][$classid]['tab'];
        if($end < $start || !$start || !$end) rewrite::js_back('请正确填写开始id和结束id');
        //生成条件分组
        $index=1;
        $key = 0;
        for($i=$start;$i<=$end;$i++){
            if($index > $this->config['sc_group_num']){ $key++; $index = 1;} 
            $where[$key][] = $i;
            $index++;
        }
        foreach($where as $v){
            $w[] = implode(',',$v);
        }
        $scIndex = 0;
        //分组获取数据
        foreach($w as $v){
            $wh = 'id in('.$v.') and classid='.$classid;
            $data = $this->htmlModel->tabData($tab,false,$wh);
            if($data){
                $scIndex++;
                $this->htmlModel->scIdHtml($data);
                rewrite::speed('生成第 <span><b>'.($scIndex).'</b></span> 组内容成功');        
            }
        }
    }
    
    //按照时间生成
    private function timeContent(){
        $classid = (int)$_POST['timeclassid'];
        $time = (int)$_POST['time'];
        if($time <= 0) return;
        $endtime = time() - $time * 3600;
        if($classid == 0){
            foreach($GLOBALS['allclass'] as $v){
                if($v['classtype'] == 0) $classidArr[] = $v['classid'];
            }
        }else{
            $classidArr = array($classid);
        }
        //循环生成栏目信息
        foreach($classidArr as $v){
            if(!isset($GLOBALS['allclass'][$v]) || $GLOBALS['allclass'][$v]['classtype'] != 0) continue;
            $tab = $GLOBALS['allclass'][$v]['tab'];
            if(!$tab) continue; //如果数据表不存在跳过
            $where = array('classid='.$v,'time > '.$endtime);
            $count = $this->htmlModel->tabCount($tab,$where);
            if($count <= 0){
                continue; //如果没有数据跳过此栏目
            }
            //开始分组
            $pagenum = ceil($count/$this->config['sc_group_num']);
            for($i=0;$i<$pagenum;$i++){
                $limit = ($i*$this->config['sc_group_num']).','.$this->config['sc_group_num'];
                $data = $this->htmlModel->tabData($tab,$limit,$where);
                if($data)$this->htmlModel->scIdHtml($data);
                rewrite::speed('生成【'.$GLOBALS['allclass'][$v]['classname'].'】栏目下第 <span><b>'.($i+1).'</b></span> 组内容成功');
            }
        }
    }
    
    //生成全部栏目
    private function sc_allList(){
        foreach($GLOBALS['allclass'] as $v){
            $this->htmlModel->lists($v['classid']);
        }
    }
    
    //按照classid生成栏目控制
    private function sc_classidaction(){
        if(!$_POST['classid']) rewrite::js_back('请选择栏目');
        foreach($_POST['classid'] as $v){
            if($v) $this->htmlModel->lists($v);
        }
    }
    
}
?>