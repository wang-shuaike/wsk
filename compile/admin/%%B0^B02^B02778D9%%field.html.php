<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:13
         compiled from Form/field.html */ ?>
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
	<li>表单字段管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<h1 class="slideSub"><a href="?m=Form&a=index">表单管理</a><a href="?m=Form&a=field" class="curr">字段管理</a></h1>
    	<div class="mainHead"><a href="?m=Form&a=addField">+增加字段</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="10%">字段ID</th>
                <th width="20%">字段标识</th>
                <th width="30%">字段名称</th>
                <th width="30%">表单类型</th>
                <th width="40%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['fid']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['fieldtitle']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['fieldname']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['fieldtype']; ?>
</td>
                <td><a href="?m=Form&a=deleteField&fid=<?php echo $this->_tpl_vars['v']['fid']; ?>
" onclick="return confirm('确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </form>
        </table>
    </div>
</div>
</body>
</html>