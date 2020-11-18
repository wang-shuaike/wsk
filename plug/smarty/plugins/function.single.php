<?php 
//单页栏目信息调用标签
//  <{single}>
//  参数：
//      classid：栏目id
//返回的数据变量名：$single_data
function smarty_function_single($param,&$smarty){
    $classid = $param['classid'];
    if(!$classid || $GLOBALS['allclass'][$classid]['classtype'] != 1) return;
    $columnModel = null;
    if($columnModel == null) $columnModel = new ColumnModel();
    $data = $columnModel->getOneClassData($classid);
    $data['classurl'] = classurl($data['classid']);
    $data['content'] = string::html_char_dec($data['content']);
    $data['content'] = str_replace('&#39;',"'",$data['content']);
    unset($data['listtem']);
    unset($data['contem']);
    unset($data['searchtem']);
    unset($data['pagenum']);
    unset($data['display']);
    unset($data['islist']);
    unset($data['classtype']);
    $smarty->assign('single_data',$data);
}
?>