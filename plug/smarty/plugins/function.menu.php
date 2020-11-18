<?php 

//栏目调用标签
//  <{column}>
//  参数：
//      classid：栏目id  空为全部栏目 0为所有顶级栏目 其他为子栏目
//      num：    数量 默认：全部
//      order：	 排序方式 默认：sort desc
//      child:   返回的数据级别 不填默认：只调用下级栏目[该返回结果为二维数组]，其他值为所有子栏目[该返回结果为多维数组]
//      where：  附加sql语句
//返回的数据变量名：$menu_data
function smarty_function_menu($param,&$smarty){
    $classid = $param['classid'];
    if($classid === 'curr') $classid = $smarty->_tpl_vars['classid'];
    $num = $param['num'];
    $order = $param['order'];
    $child = isset($param['child']) ? true : false;
    $where = $param['where'];
    $columnModel = new ColumnModel();
    $data = $columnModel->menu_tag($classid,$num,$order,$child,$where);
    $smarty->assign('menu_data',$data);
}
?>