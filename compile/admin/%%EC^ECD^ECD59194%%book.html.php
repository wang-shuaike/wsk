<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:10
         compiled from Book/book.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Book/book.html', 41, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
<script type="text/javascript" src="/template/admin/js/book.js"></script>


</head>

<body>
<div class="dqnav">
<ul>
	<li>当前位置：</li>
	<li><a href="?m=index&a=main">后台首页</a></li>
	<li><span>&gt;</span></li>
	<li>留言板管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
        <div class="smfooter" style="padding-bottom:10px;"><span class="hong">留言板前台地址：<a href='/index.php?m=Book&a=index' target="_blank" style="color:#f00;">/index.php?m=Book&a=index</a></span></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="5%">ID</th>
                <th width="25%">留言者信息</th>
                <th width="25%">留言信息</th>
                <th width="25%">回复</th>
                <th width="20%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['book']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td class="padding"><ul class="table_ul">
                	<li>姓名：<?php echo $this->_tpl_vars['v']['name']; ?>
</li>
                    <li>邮箱：<?php echo $this->_tpl_vars['v']['mail']; ?>
</li>
                    <li>电话：<?php echo $this->_tpl_vars['v']['tel']; ?>
</li>
                    <li>ＩＰ：<?php echo $this->_tpl_vars['v']['ip']; ?>
</li>
                    <li>时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</li>
                </ul></td>
                <td><?php echo $this->_tpl_vars['v']['content']; ?>
</td>
                <td><?php if ($this->_tpl_vars['v']['isreply']): ?><span class='hong'>管理(<?php echo $this->_tpl_vars['v']['username']; ?>
)回复：</span><?php echo $this->_tpl_vars['v']['replycon']; ?>
<?php else: ?><span class='hong'>暂无回复</span><?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['v']['ischeck']): ?><a href='?m=Book&a=check&check=0&id=<?php echo $this->_tpl_vars['v']['id']; ?>
'>取消审核</a><?php else: ?><a href='?m=Book&a=check&check=1&id=<?php echo $this->_tpl_vars['v']['id']; ?>
'>审核</a><?php endif; ?><a href="?m=Book&a=reply&id=<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php if ($this->_tpl_vars['v']['isreply']): ?>修改回复<?php else: ?>回复<?php endif; ?></a><a href="?m=Book&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
<?php if ($this->_tpl_vars['v']['isreply']): ?>&isreply=1<?php endif; ?>" onclick="return confirm('确定要删除此留言？');">删除</a></td>
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