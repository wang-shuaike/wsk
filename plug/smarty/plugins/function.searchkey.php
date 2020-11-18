<?php 

//搜索关键字调用标签
//  <{searchkey}>
//  参数：
//      num：    数量 默认：10
//      order：	 排序方式 默认：click desc  信息数量可以用 length(infoid) desc
//返回的数据变量名：$searchkey_data
function smarty_function_searchkey($param,&$smarty){
    $num = $param['num'] ? $param['num'] : 10;
    $order = $param['order'] ? $param['order'] : 'click desc';
    $where = $param['where'];
    $model = new SearchModel();
    $data = $model->lists($num,$order,$where);
    $smarty->assign('searchkey_data',$data);
}
?>