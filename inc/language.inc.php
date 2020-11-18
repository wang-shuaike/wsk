<?php 
/**
 *  【梦想cms】 http://www.lmxcms.com
 * 
 *   接收自定义表单数据并保存
 */
defined('LMXCMS') or exit();
$l = array(
    'dy_ok' => '提交成功', //自定义表单提交成功
    'dy_must' => '必须填写', //自定义表单某个字段必须填写
    'form_time_error' => '秒内不能再次提交', //前台提交间隔时间提示
    'book_name_must' => '留言名字必须填写', //留言名字字段必须填写
    'book_content_must' => '留言内容必须填写', //留言内容字段必须填写
	'book_is_error' => '留言板没有开启',//是否开启留言板提示
    'book_ok' => '留言提交成功', //留言提交完成
    'book_error' => '留言提交失败，请重试', //留言失败
    'search_is_keywords' => '搜索关键词不能为空', //搜索关键词提示
    'search_is_param' => '缺少必要的参数：classid或者mid',
    'search_is_classid' => '栏目不存在',
    'search_is_mid' => '模型不存在',
);
?>