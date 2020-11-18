<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   留言板控制器
 */
defined('LMXCMS') or exit();
class BookAction extends HomeAction{
    private $bookModel = null;
    public function __construct() {
        parent::__construct();
        if($this->bookModel == null) $this->bookModel = new BookModel();
		if(!$GLOBALS['public']['isbook']) rewrite::error($this->l['book_is_error'],$GLOBALS['public']['weburl']);
    }
    
    public function index(){
        if(isset($_POST['setbook'])){//提交留言
            $data = $this->checkData();
            if($this->bookModel->add($data)){
                $this->setBookTime(); //存储提交时间
                rewrite::succ($this->l['book_ok']);
            }else{
                rewrite::error($this->l['book_error']);
            }
        }
		//判断是否调用留言数据
		if($GLOBALS['public']['isbookdata']){
			//判断是否只调用审核
			$where = '';
			if($GLOBALS['public']['bookDisplay']) $where = 'ischeck=1';
			$count = $this->bookModel->count($where);
			$page = new page($count,$GLOBALS['public']['booknum']);
			$data = $this->bookModel->getData($page->returnLimit(),$where);
			$this->smarty->assign('list',$data);
			$this->smarty->assign('num',$count);
			$this->smarty->assign('page',$page->html());
		}
        $this->smarty->display('book/index.html');
    }
    
    //验证数据并返回
    private function checkData(){
        $this->bookTime(); //验证提交间隔时间
        $arr['name'] = '';
        $arr['content'] = '';
        $arr['mail'] = '';
        $arr['tel'] = '';
        $arr['ip'] = '';
        $data = p(1,1,1); //验证前台数据
        $data = array_merge($arr,$data);
        if(!$data['name']) rewrite::js_back($this->l['book_name_must']);
        if(!$data['content']) rewrite::js_back($this->l['book_content_must']);
        //过滤html代码
        foreach($data as $k => $v){
            $data[$k] = string::delHtml($v); 
        }
        unset($data['setbook']);
        return $data;
    }
}
?>