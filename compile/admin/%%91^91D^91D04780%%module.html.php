<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:02
         compiled from Module/module.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
</head>

<body>
<div class="dqnav">
<ul>
	<li>当前位置：</li>
	<li><a href="?m=index&a=main">后台首页</a></li>
	<li><span>&gt;</span></li>
	<li>模型管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<div class="mainHead"><a href="?m=Module&a=add">+添加模型</a>&nbsp;&nbsp;<a href="?m=Module&a=cachemodule">更新模型缓存</a> <span class="hui">“增加修改模型、字段无变化时点击”</span></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="5%">模型ID</th>
                <th width="8%">模型名称</th>
                <th width="7%">模型数据表名</th>
                <th width="35%">模型说明</th>
                <th width="15%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['moduleData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['mid']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['mname']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['tab']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['content']; ?>
</td>
                <td><a href="?m=Field&a=index&mid=<?php echo $this->_tpl_vars['v']['mid']; ?>
">字段管理</a><a href="?m=Module&a=update&mid=<?php echo $this->_tpl_vars['v']['mid']; ?>
">修改</a><a href="?m=Module&a=del&mid=<?php echo $this->_tpl_vars['v']['mid']; ?>
" onclick="return confirm('确定要删除此模型？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>
</div>
</body>
</html>