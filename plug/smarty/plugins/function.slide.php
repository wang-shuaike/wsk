<?php 
//焦点图调用标签
//  <{slide}>
//  参数：
//      id: 焦点图id，默认空
//      style：样式编号1-5 默认1
//      num：    焦点图数量，默认全部
//      order：	 图片排序方式 默认：sort desc
//      width:  焦点图总体宽度
//      height: 焦点图总体高度
//返回的数据变量名：style为0则返回$slide_data 一维图片数组
function smarty_function_slide($param,&$smarty){
    $id = (int)$param['id'];
    if(!$id) return;
    $style = (int)$param['style'];
    if($style < 0 || $style > 5) return;
    $num = $param['num'];
    $order = $param['order'] ? $param['order'] : 'sort desc';
    $width = $param['width'];
    $height = $param['height'];
    if(!$width || !$height) return;
    $model = null;
    if($model == null) $model = new SlideModel();
    $imgData = $model->slide_tag($num,$order,$id);
    $html = '';
    if($style == 0){
        $smarty->assign('slide_data',$imgData); return;
    }else{
        $fun = 'slide_style_'.$style;
        $html = $model->$fun($imgData,$width,$height);
    }
    echo $html; //输出焦点图代码
}
?>