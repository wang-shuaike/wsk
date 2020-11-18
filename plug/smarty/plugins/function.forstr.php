<?php 

//处理多图片和多文件地址字符串
//  <{hanmore}>
//  参数：
//      data：数据变量
//返回的 $hanmore_data 一维数组 图片或者文件的地址
function smarty_function_forstr($param,&$smarty){
    if(!$param['data']){
        return '';
    }
    $data = explode('#####',$param['data']);
    $smarty->assign('forstr_data',$data);
}
?>