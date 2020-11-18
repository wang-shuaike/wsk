<?php 

//栏目链接标签
//  <{classurl}>
//  参数：
//      id：栏目id
//返回的栏目链接地址字符串 数据无需任何处理
function smarty_function_classurl($param,&$smarty){
    if(!$param['id']){
        return;
    }
    $classid = $param['id'];
    return classurl($classid);
}
?>