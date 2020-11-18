<?php 

//友情链接标签
//<{link}>
//  参数：
//      type：调用数据类型  默认为空 不管有没有图片都会调用 1：调用没有图片的链接 2：调用有图片的链接
//      order：排序方式，默认sort desc
//      num：调用数量，默认全部
//      返回的数据变量名：$link_data
function smarty_function_link($param,&$smarty){
    if($param['type'] == 1){
        $where = 'isimg=0';
    }else if($param['type'] == 2){
        $where = 'isimg=1';
    }else{
        $where = '';
    }
    $order = $param['order'] ? $param['order'] : 'sort desc,id desc';
    $num = $param['num'] ? $param['num'] : 10;
    $model = null;
    if($model == null){
        $model = new LinkModel();
    }
    $data = $model->getData($num,$where,$order);
    $smarty->assign('link_data',$data);
}
?>