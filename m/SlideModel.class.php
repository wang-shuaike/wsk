<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   焦点图模块
 */
defined('LMXCMS') or exit();
class SlideModel extends Model{
    function __construct(){
        parent::__construct();
        $this->field = array('*');
        $this->tab = array('slide');
    }
    
    //获取焦点图
    public function get($limit='',$where=''){
        if($where) $param['where'][] = $where;
        if($limit) $param['limit'] = $limit;
        return parent::selectModel($param);
    }
    
    //获取焦点图数量
    public function slideCount($limit='',$where=''){
        if($where) $param['where'][] = $where;
        if($limit) $param['limit'] = $limit;
        return parent::countModel($param);
    }
    
    //增加焦点图
    public function add($data){
        unset($data['addSlide']);
        return parent::addModel($data);
    }
    
    //根据焦点图id获取焦点图数据
    public function getSlideData($id){
        $param['where'] = 'id='.$id;
        return parent::oneModel($param);
    }
    
    //根据焦点图id修改焦点图
    public function update($id,$data){
        unset($data['updateSlide']);
        $param['where'] = 'id='.$id;
        return parent::updateModel($data,$param);
    }
    
    //删除焦点图
    public function delete($id){
        $param['where'] = 'id='.$id;
        parent::deleteModel($param); //删除焦点图数据
        $param['where'] = 'uid='.$id;
        $this->tab = array('slide_data');
        parent::deleteModel($param); //删除焦点图图片数据
    }
    
    //改正焦点图片数据表
    public function imgTab(){
        $this->tab = array('slide_data');
    }
    
    //增加焦点图片
    public function addimg($data){
        $this->imgTab();
        unset($data['addimg']);
        return parent::addModel($data);
    }
    
    //获取焦点图片
    public function getimg($id){
        $this->imgTab();
        $param['where'] = 'uid='.$id;
        $param['order'] = 'sort desc';
        return parent::selectModel($param);
    }
    
    //获取一条图片数据
    public function getOneImg($id){
        $this->imgTab();
        $param['where'] = 'id='.$id;
        return parent::oneModel($param);
    }
    
    //修改焦点图片数据
    public function updateimg($data){
        $this->imgTab();
        $param['where'] = 'id='.$data['id'];
        unset($data['updateimg']);
        unset($data['id']);
        unset($data['uid']);
        parent::updateModel($data,$param);
    }
    
    //删除焦点图片
    public function deleteimg($id,$uid){
        $this->imgTab();
        $param['where'][] = 'id='.$id;
        $param['where'][] = 'uid='.$uid;
        parent::deleteModel($param);
    }
    
    //焦点图片排序
    public function sortimg($sort,$id){
        $this->imgTab();
        foreach($id as $k => $v){
            $param['where'] = 'id='.(int)$v;
            $data['sort'] = (int)$sort[$k];
            parent::updateModel($data,$param);
        }
    }
    
    //焦点图标签返回焦点图数据
    public function slide_tag($num,$order,$id){
        $this->imgTab();
        if($num) $param['limit'] = $num;
        $param['order'] = $order;
        $param['where'] = 'uid='.$id;
        return parent::selectModel($param);
    }
    
    //焦点图样式
    public function slide_style_1($data,$width,$height){
        $html = '';
        $link = '<link href="/file/slideStyle/1/css/css.css" rel="stylesheet" type="text/css" />';
        $js = '<script>!window.jQuery && document.write("<script src=\"/file/slideStyle/jquery.js\">"+"</scr"+"ipt>");</script><script src="/file/slideStyle/1/js/koala.min.1.5.js" type="text/javascript"></script><script src="/file/slideStyle/1/js/terminator2.2.min.js" type="text/javascript"></script><script src="/file/slideStyle/1/js/slide.js" type="text/javascript"></script>';
        $html = '<div id="fsD1" class="focus"><div id="D1pic1" class="fPic">';
        foreach($data as $k => $v){
            $html .= '<div class="fcon" style="display: none;">
            <a target="_blank" href="'.$v['url'].'"><img src="'.$v['img'].'" style="opacity: 1; "></a>
            <span class="shadow"><a target="_blank" href="'.$v['url'].'">'.$v['content'].'</a></span>
        </div>';
        }
        $html .= '</div><div class="fbg"><div class="D1fBt" id="D1fBt">';
        foreach($data as $k => $v){
            $html .= '<a href="javascript:void(0)" hidefocus="true" target="_self"><i>'.($k+1).'</i></a>';
        }
        $html .= '</div></div><span class="prev"></span><span class="next"></span></div>';
        $css = '<style type="text/css">.focus,.focus img{width:'.$width.'px;height:'.$height.'px;}</style>';
        return $link.$css.$js.$html;
    }
    public function slide_style_2($data,$width,$height){
        $js = '<script>!window.jQuery && document.write("<script src=\"/file/slideStyle/jquery.js\">"+"</scr"+"ipt>");</script>';
        $html = '';
        $link = '<link href="/file/slideStyle/2/css/css.css" rel="stylesheet" type="text/css" />';
        $js .= '<script src="/file/slideStyle/2/js/slide.js" type="text/javascript"></script>';
        $html = '<div id="slide_style_box2"><ul>';
        foreach($data as $k => $v){
            $html .= '<li><a href="'.$v['url'].'"><img src="'.$v['img'].'" alt="'.$v['content'].'" title="'.$v['content'].'" /></a></li>';
        }
        $html .= '</ul></div>';
        $css = '<style type="text/css">#slide_style_box2 img,#slide_style_box2{ width:'.$width.'px; height:'.$height.'px;}</style>';
        return $link.$css.$js.$html;
    }
    public function slide_style_3($data,$width,$height){
        $js = '<script>!window.jQuery && document.write("<script src=\"/file/slideStyle/jquery.js\">"+"</scr"+"ipt>");</script>';
        $html = '';
        $js .= '<script src="/file/slideStyle/3/js/jquery.kinMaxShow-1.1.min.js" type="text/javascript" charset="utf-8"></script>';
        $js .= '<script type="text/javascript">$(function(){$("#kinMaxShow").kinMaxShow({height:'.$height.',intervalTime:4,switchTime:500,imageAlign:"left top",});});
</script>';
        $css = '<style type="text/css">#kinMaxShow{visibility:hidden;overflow:hidden;display:none;}#kinMaxShow img{ width:'.$width.'px; height:'.$height.'px;}</style>';
        $html .= '<div style="width:'.$width.'px;"><div id="kinMaxShow">';
        foreach($data as $v){
            $html .= '<div><a href="'.$v['url'].'" target="_blank"><img src="'.$v['img'].'" /></a> </div>';
        }
        $html .= '</div></div>';
        
        return $css.$js.$html;
    }
    public function slide_style_4($data,$width,$height){
        $js = '<script>!window.jQuery && document.write("<script src=\"/file/slideStyle/jquery.js\">"+"</scr"+"ipt>");</script>';
        $html = '';
        $js .= '<script src="/file/slideStyle/4/js/slide.js" type="text/javascript" charset="utf-8"></script>';
        $link = '<link href="/file/slideStyle/4/css/css.css" rel="stylesheet" type="text/css" />';
        $css = '<style type="text/css">.wrapper,#focus,#focus ul li,.wrapper img{ width:'.$width.'px;height:'.$height.'px;}#focus .btnBg{ width:'.$width.'px;}#focus ul{height:'.$height.'px;}</style>';
        $html .= '<div class="wrapper"><div id="focus"><ul>';
        foreach($data as $v){
            $html .= '<li><a href="'.$v['url'].'" target="_blank"><img src="'.$v['img'].'" alt="'.$v['content'].'" /></a></li>';
        }
        $html .= '</ul></div>';
        return $link.$css.$js.$html;
    }
    public function slide_style_5($data,$width,$height){
        $js = '<script>!window.jQuery && document.write("<script src=\"/file/slideStyle/jquery.js\">"+"</scr"+"ipt>");</script>';
        $html = '';
        $js .= '<script src="/file/slideStyle/5/js/slide.js" type="text/javascript" charset="utf-8"></script>';
        $link = '<link href="/file/slideStyle/5/css/css.css" rel="stylesheet" type="text/css" />';
        $css = '<style type="text/css">.slide5,.slide5 img,.slide5 li,.slide5 ul{ width:'.$width.'px; height:'.$height.'px;}</style>';
        $html .= '<div class="slide5" id="slide5"><ul>';
        foreach($data as $k => $v){
            $k==0 ? $display = ' style=" display:block;"' : $display = '';
            $html .= '<li'.$display.'><a href="'.$v['url'].'" target="_blank"><img src="'.$v['img'].'" alt="'.$v['content'].'" /></a></li>';
        }
        $html .= '</ul></div>';
        
        return $link.$css.$js.$html;
    }
}
?>