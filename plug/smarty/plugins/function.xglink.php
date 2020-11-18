<?php 
//相关链接标签
function smarty_function_xglink($param,&$smarty){
    //初始化参数
    $classid = $smarty->_tpl_vars['classid'];
    $id = $smarty->_tpl_vars['id'];
    if(!$classid || !$id) exit('相关信息调用标签必须在信息内容页面使用');
    $keyword = $smarty->_tpl_vars['keywords'];
    $num = $param['num'] ? $param['num'] : 10; 
    if(!$keyword) return ''; //如果没有关键词那么直接返回空
    $keyword = explode(',',$keyword);
    foreach($keyword as $v){
        $where[] = "title LIKE '%".$v."%'";
        $where[] = "keywords LIKE '%".$v."%'";
    }
    $where = implode(' or ',$where);
    $where = '('.$where.') and id <> '.$id;
    //查找数据
    $model = new ContentModel($classid);
    $data = $model->getInfolist($num,'',$where,true);
    if($data){
        //加入url和所属栏目变量
        foreach($data as $v){
            $v['classname'] = $GLOBALS['allclass'][$v['classid']]['classname'];
            $param['type'] = 'list';
            $param['classid'] = $v['classid'];
            $param['classpath'] = $GLOBALS['allclass'][$v['classid']]['classpath'];
            $v['classurl'] = $GLOBALS['allclass'][$v['classid']]['classurl'] ? $GLOBALS['allclass'][$v['classid']]['classurl'] : url($param);
            $v['classimage'] = $GLOBALS['allclass'][$v['classid']]['images'];
            $param['type'] = 'content';
            $param['id'] = $v['id'];
            $param['time'] = $v['time'];
            $v['url'] = $v['url'] ? $v['url'] : url($param);
            $newdata[] = $v;
        }
        $smarty->assign('xglink_data',$newdata);
    }
}
?>