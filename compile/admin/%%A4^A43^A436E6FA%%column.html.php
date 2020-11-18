<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:53
         compiled from Column/column.html */ ?>
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
	<li>栏目管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<div class="mainHead"><a href="?m=Column&a=addMain">+添加栏目</a>&nbsp;&nbsp;<a href="?m=Column&a=updateCache">更新栏目缓存</a> <span class="hui">'修改栏目后无变化时点击'</span></div>
        <table cellpadding="0" cellspacing="1" border="0">
        	<form method="post" action="?m=column&a=sort">
            <tr>
                <th width="5%">排序</th>
                <th width="5%">栏目ID</th>
                <th width="20%">栏目名称</th>
                <th width="15%">栏目类型</th>
                <th width="10%">所属模块</th>
                <th width="30%">目录</th>
                <th width="15%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['column']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><input type="text" class="inputText" style="width:25px; text-align:center" name="sort[]" value="<?php echo $this->_tpl_vars['v']['sort']; ?>
" /><input type="hidden" value="<?php echo $this->_tpl_vars['v']['classid']; ?>
" name="classid[]" /></td>
                <td><?php echo $this->_tpl_vars['v']['classid']; ?>
</td>
                <td class="padding"><a href="<?php echo $this->_tpl_vars['v']['classurl']; ?>
" target='_blank'><?php echo $this->_tpl_vars['v']['lvevlImage']; ?>
 <?php echo $this->_tpl_vars['v']['classname']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['v']['classtypeName']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['mname']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['classpath']; ?>
</td>
                <td><a href="?m=Column&a=updateMain&id=<?php echo $this->_tpl_vars['v']['classid']; ?>
">修改</a><a href="?m=Column&a=copyMain&id=<?php echo $this->_tpl_vars['v']['classid']; ?>
">复制</a><a href="?m=Column&a=del&id=<?php echo $this->_tpl_vars['v']['classid']; ?>
" onclick="return confirm('确定要删除此栏目？将删除所有所属子栏目及所有所属信息');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td width="5%"></td>
                <td width="95%" colspan="6" class="padding"><input type="submit" value="更新排序" class="inputSub1" name="sortSub" /> <span class="hui">值越大排序越前</span></td>
            </tr>
            </form>
        </table>
    </div>
</div>
</body>
</html>