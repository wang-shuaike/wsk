<?php /* Smarty version 2.6.28, created on 2014-08-28 17:19:30
         compiled from Back/inlist.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Back/inlist.html', 37, false),array('modifier', 'count', 'Back/inlist.html', 38, false),)), $this); ?>
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
	<li>恢复数据库</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column" id="allcheckbox">
    <h1 class="slideSub"><a href="?m=Backdb&a=index">备份数据</a><a href="?m=Backdb&a=backdbInList" class="curr">恢复数据</a></h1>
        <table cellpadding="0" cellspacing="1" border="0">
        <form action="?m=Backdb&a=delmorebackdb" method="post">
            <tr>
                <th width="5%">选择</th>
                <th width="40%">文件名</th>
                <th width="10%">大小</th>
                <th width="15%">备份时间</th>
                <th width="10%">分卷数量</th>
                <th width="20%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['backlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><input type="checkbox" name="filename[]" value="<?php echo $this->_tpl_vars['v']['filename']; ?>
" /></td>
                <td class="padding"><?php echo $this->_tpl_vars['v']['filename']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['filesize']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
                <td><?php echo count($this->_tpl_vars['v']['fjfile']); ?>
</td>
                <td><a href="?m=Backdb&a=downdb&filename=<?php echo $this->_tpl_vars['v']['filename']; ?>
">下载</a><a href="?m=Backdb&a=backdbin&filename=<?php echo $this->_tpl_vars['v']['filename']; ?>
" onclick="return confirm('确定要恢复吗？');">恢复</a><a href="?m=Backdb&a=delbackdb&filename=<?php echo $this->_tpl_vars['v']['filename']; ?>
" onclick="return confirm('确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td colspan="6" style="padding-left:2%; text-align:left;"><label for="allcheckbox1"><input type="checkbox"  class="allcheckbox" id="allcheckbox1" />全选</label> <input type="submit" value="批量删除" name="backdbUp" class="inputSub1" onclick="return confirm('确定要删除吗？');" />&nbsp;&nbsp;<span class="succ">备份数据库后请及时下载到本地备份，删除服务器备份，避免数据库信息泄漏</span></td>
            </tr>
        </form>
        </table>
    </div>
</div>
</body>
</html>