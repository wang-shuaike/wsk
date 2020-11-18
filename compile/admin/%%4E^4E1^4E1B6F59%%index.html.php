<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:50
         compiled from Log/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Log/index.html', 34, false),)), $this); ?>
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
	<li>日志管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList">
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="5%">ID</th>
                <th width="50%">操作内容</th>
                <th width="15%">操作时间</th>
                <th width="15%">管理员用户名</th>
                <th width="15%">操作IP</th>
            </tr>
            <?php $_from = $this->_tpl_vars['logData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td class="padding"><?php echo $this->_tpl_vars['v']['content']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['username']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['userip']; ?>
</td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td>&nbsp;</td>
                <td colspan="4" class="padding"><form action="?m=Log&a=del" method="post" onsubmit="return confirm('确定要清理吗？');"><input type="submit" class="inputSub" name='dellog' value="删除日志（只保留7天内）" /></form></td>
            </tr>
        </table>
    </div>
    <div class="page"><?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>