<?php 

//信息调用标签
//  <{article}>
//  参数：
//      classid：栏目id
//      num：    数量 默认：10
//      order：	 排序方式 默认：id desc
//      where：  附加sql语句
//      remen：  热门信息级别
//      tuijian：推荐信息级别
//返回的数据变量名：$article_data
function smarty_function_article($param,&$smarty){
    $classid = $param['classid'];
    if(!$classid){
        exit('【article】标签必须填写classid参数');
    }
    $num = $param['num'] ? $param['num'] : 10;
    $order = $param['order'] ? $param['order'] : 'id desc';
    $where = $param['where'];
    $remen = $param['remen'];
    $tuijian = $param['tuijian'];
    $contentModel = null;
    if($contentModel == null) $contentModel = new ContentModel($classid);
    $data = $contentModel->article_data($num,$order,$where,$remen,$tuijian);
    $smarty->assign('article_data',$data);
}
?>