<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   分页处理类
 */
defined('LMXCMS') or exit();
class page{
    private $num;                    //总条数
    private $pagesize;               //每页显示条数
    private $url;                    //地址
    private $pagenum;                //总页数
    private $limit;                  //limit
    private $page;                   //当前页码
    private $bothnum;                //俩边页码偏移
    private $pagecon;                //分页参数 array ishome:显示首页和尾页,isprev:显示上一页和下一页
    
    public function __construct($num,$pagesize,array $pagecon=array()){
        //初始化参数
        $this->num=$num ? $num : 1;
        $this->pagesize=$pagesize;
        $this->url=$this->geturl();
        $this->pagenum=ceil($this->num / $this->pagesize);
        $this->page=$this->getPage();
        $this->limit=($this->page-1) * $this->pagesize .",$this->pagesize";
        $this->bothnum=4;
        $this->pagecon = array('ishome'=>1,'isprev'=>1);
        foreach($pagecon as $k=>$v){
            $this->pagecon[$k] = $v;
        }
    }
    
    //返回当前页码
    public function returnPage(){
        return $this->page;
    }
    
    //返回limit
    public function returnLimit(){
        return $this->limit;
    }
    
    //获取url地址
    private function geturl(){
        $Yurl= $_SERVER["REQUEST_URI"];
        $url=parse_url($Yurl);
        if(isset($url['query'])){
            parse_str($url['query'],$query);
            unset($query['page']);
            $xurl = $url['path'].'?'.http_build_query($query).'&page=';
        }
        return $xurl;
    }
    
    //获取当前页码
    private function getPage(){
        $page=(int)$_GET['page'];
        if(!isset($page) || empty($page) || !$page){
            return 1;
        }
        if($page > $this->pagenum){
            return $this->pagenum;
        }
        if($page < 1){
            return 1;
        }
        return $page;
    }
    
    //返回页码
    private function listpage(){
        $pageList='';
        //计算上偏移
        if($this->page + $this->bothnum >= $this->pagenum){
            $s = $this->bothnum + ($this->page + $this->bothnum - $this->pagenum);
        }else{
            $s = $this->bothnum;
        }
        //计算下偏移
        if($this->page <= $this->bothnum){
            $h = $this->bothnum - $this->page + $this->bothnum+1;
        }else{
            $h = $this->bothnum;
        }
        for($i=$s;$i>=1;$i--){
            $page=$this->page-$i;
            if($page < 1){
                continue;
            }
            $pageList .= '<a href="'.$this->url.$page.'">'.$page.'</a>';
        }
        $pageList.="<span class='curr'>$this->page</span>";
        for($i=1;$i<=$h;$i++) {
            $page = $this->page+$i;
            if ($page > $this->pagenum) break;
            $pageList .= '<a href="'.$this->url.$page.'">'.$page.'</a>';
        }
        return $pageList;
    }
    
    //返回首页
    private function home(){
        if($this->page > 1){
            return '<a href="'.$this->url.'1">首页</a>';
        }
    }
    
    //返回尾页
    private function last(){
        if($this->page+1 <= $this->pagenum){
            return '<a href="'.$this->url.$this->pagenum.'">尾页</a>';
        }
    }
    
    //返回上一页
    private function prev(){
        if($this->page > 1){
            $prevNum = ($this->page-1) < 1 ? 1 : $this->page - 1;
            return '<a href="'.$this->url.$prevNum.'">上一页</a>';
        }
    }
    
    //返回下一页
    private function next(){
        if($this->page+1 <= $this->pagenum){
            $nextNum = ($this->page + 1) > $this->pagenum ? $this->pagenum : $this->page + 1;
            return '<a href="'.$this->url.$nextNum.'">下一页</a>';
        }
    }
    
    //返回整个页码
    public function html(){
        if(isset($_GET['ishtml']) && $GLOBALS['public']['ishtml'] && isset($_GET['count']) && isset($_GET['curr'])){
            //静态分页，程序内部生成所需
            $classid = $_GET['classid'];
            $count = $_GET['count'];
            $curr = $_GET['curr'];
            if($count <= 1) return; //如果只有一页则不显示页码
            $url = $GLOBALS['public']['weburl'].$GLOBALS['allclass'][$classid]['classpath'].'/';
            if($curr > 1){
                $str = "<a href='".$url."index.html'>首页</a>";
                $prev = $curr - 1 <= 1 ? '' : '_'.$curr - 1;
                $str .= "<a href='".$url."index".$prev.".html'>上一页</a>";
            }
            for($i=1;$i<=$count;$i++){
                $filename = $i == 1 ? 'index.html' : 'index_'.$i.'.html';
                if($i == $curr){
                    $str .= "<span class='curr'>$i</span>";
                }else{
                    $str .= "<a href='$url$filename'>$i</a>";
                }
            }
            if($curr < $count){
                $str .= "<a href='".$url."index_".($curr+1).".html'>下一页</a>";
                $str .= "<a href='".$url."index_".$count.".html'>尾页</a>";
            }
            return $str;
        }else{
            if($this->pagenum > 1){
                if($this->pagecon['ishome']){
                    $page.=$this->home();
                }
                if($this->pagecon['isprev']){
                    $page.=$this->prev();
                }
                $page.=$this->listpage();
                if($this->pagecon['isprev']){
                    $page.=$this->next();
                }
                if($this->pagecon['ishome']){
                    $page.=$this->last();
                }
                return $page;
            }
        }
    }
}
?>