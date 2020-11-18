<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   前台搜索提交
 */
class SearchAction extends HomeAction{
    private $searchModel = null;
    private $param;
    public function __construct() {
        parent::__construct();
        $this->check(); //验证接收数据
        if($this->searchModel == null) $this->searchModel = new SearchModel();
    }
    
    public function index(){
        $this->param['ischild'] = 1;
        $arr = $this->searchModel->getSerachField($this->param);//初始化条件
        $count = $this->searchModel->searchCoutn($arr);
        if($count > 0){ 
            $page = new page($count,$GLOBALS['public']['searchnum']);
            //获取列表数据
            $arr['page'] = $page->returnLimit();
            $arr['is_home'] = 1;
            $searchData = $this->searchModel->getSearchList($arr,$this->param);
            //赋值url和其他变量
            foreach($searchData as $v){
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
                $v['parent_classid'] = $GLOBALS['allclass'][$v['classid']]['uid'];
                $newlist[] = $v;
            }
            $this->smarty->assign('list',$newlist);
            $this->smarty->assign('page',$page->html());
        }
        $this->smarty->assign('num',$count);
        //获取搜索列表模板
        if(!$this->param['tem']){
            if($this->param['classid']){
                $classtem = $GLOBALS['allclass'][$arr['classid']]['searchtem'];
                $arr['tem'] = $classtem ? $classtem : 'index';
            }else{
                $arr['tem'] = 'index';
            }
        }else{
            $arr['tem'] = $this->param['tem'];
        }
        $this->smarty->assign('title',$this->param['keywords']);
        $this->smarty->assign('keywords',$this->param['keywords']);
        $this->smarty->assign('description',$this->param['keywords']);
        $this->smarty->display('Search/'.$arr['tem'].'.html');
    }
    
    
    //验证接收数据并返回
    private function check(){
        //获取get数据
        $data = p(2,1,1);
        $this->param['keywords'] = string::delHtml($data['keywords']);
        if(!$this->param['keywords'] && $this->config['search_isnull']){
            rewrite::error($this->l['search_is_keywords']);
        }
        $this->param['classid'] = (int)$data['classid'];
        $this->param['mid'] = (int)$data['mid'];
        if(!$this->param['classid'] && !$this->param['mid']) rewrite::error($this->l['search_is_param']);
        if($this->param['classid'] && !isset($GLOBALS['allclass'][$this->param['classid']])){
            rewrite::error($this->l['search_is_classid']);
        }
        if($this->param['mid'] && !isset($GLOBALS['allmodule'][$this->param['mid']])){
            rewrite::error($this->l['search_is_mid']);
        }
        $this->param['tem'] = $data['tem'];
        $this->param['field'] = $data['field'];
        $this->param['time'] = $data['time'] ? $data['time'] : $this->config['search_time'];
        $this->param['tuijian'] = $data['tuijian'];
        $this->param['remen'] = $data['remen'];
    }
}
?>