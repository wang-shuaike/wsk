<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:11
         compiled from Slide/index.html */ ?>
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
	<li>焦点图管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<div class="mainHead"><a href="?m=Slide&a=add">+增加焦点图</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="10%">焦点图ID</th>
                <th width="20%">焦点图名字</th>
                <th width="40%">说明</th>
                <th width="30%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['slide']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['content']; ?>
</td>
                <td><a href="?m=Slide&a=img&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">图片管理</a><a href="?m=Slide&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">修改</a><a href="?m=Slide&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
" onclick="return confirm('确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>
    <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>