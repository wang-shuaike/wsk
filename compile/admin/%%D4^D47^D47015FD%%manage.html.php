<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:45
         compiled from Manage/manage.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Manage/manage.html', 37, false),)), $this); ?>
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
	<li>管理员列表</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList">
    	<div class="mainHead"><a href="?m=Manage&a=add">+添加管理员</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="5%">ID</th>
                <th width="10%">用户名</th>
                <th width="20%">本次登录ip</th>
                <th width="20%">最后登录时间</th>
                <th width="20%">最后登录IP</th>
                <th width="25%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['userData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['currip']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['lasttime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['lastip']; ?>
</td>
                <td><a href="?m=Manage&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">修改</a><a href="?m=Manage&a=del&id=<?php echo $this->_tpl_vars['v']['id']; ?>
" onclick="return confirm('确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>
</div>
</body>
</html>