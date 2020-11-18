<?php 

//sql调用数据，支持任意select语句
//  参数：
//      sql：sql语句 表前缀使用[pre]
//返回的数据变量名：$select_data
function smarty_function_select($param,&$smarty){
    $sql = $param['sql'];
    if($sql && !preg_match('/^select/i',$sql)){
        exit('只支持select查询语句');
    }
    $sql = str_replace('[pre]',DB_PRE,$sql);
    if($model == null){
        $model = new SelectModel();
    }
    $data = $model->select_tag($sql);
    $smarty->assign('select_data',$data);
}
?>