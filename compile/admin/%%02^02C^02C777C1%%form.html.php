<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:11
         compiled from Form/form.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
<script type="text/javascript" src="/template/admin/js/form.js"></script>


</head>

<body>
<div class="dqnav">
<ul>
	<li>当前位置：</li>
	<li><a href="?m=index&a=main">后台首页</a></li>
	<li><span>&gt;</span></li>
	<li>表单管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<h1 class="slideSub"><a href="?m=Form&a=index" class="curr">表单管理</a><a href="?m=Form&a=field">字段管理</a></h1>
    	<div class="mainHead"><a href="?m=Form&a=add">+增加表单</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="10%">表单ID</th>
                <th width="20%">表单名字</th>
                <th width="30%">必填字段</th>
                <th width="40%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['form']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['formname']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['must']; ?>
</td>
                <td><a href="?m=Form&a=getContent&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">查看内容</a><a href="?m=Form&a=getHtml&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">获取表单代码</a><a href="?m=Form&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">修改</a><a href="?m=Form&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
" onclick="return confirm('将删除该表单所属内容，确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </form>
        </table>
    </div>
    <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>