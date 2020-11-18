<?php /* Smarty version 2.6.28, created on 2014-08-29 00:51:34
         compiled from Link/link.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'Link/link.html', 42, false),)), $this); ?>
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
	<li>友情链接管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<div class="mainHead"><a href="?m=Link&a=add">+增加友情链接</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
        	<form method="post" action="?m=Link&a=sort">
            <tr>
                <th width="5%">排序</th>
                <th width="5%">链接ID</th>
                <th width="15%">名字</th>
                <th width="20%">URL地址</th>
                <th width="10%">图片</th>
                <th width="25%">备注</th>
                <th width="20%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><input type="text" class="inputText" style="width:25px; text-align:center" name="sort[]" value="<?php echo $this->_tpl_vars['v']['sort']; ?>
" /><input type="hidden" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" name="id[]" /></td>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['url']; ?>
</td>
                <td><?php if ($this->_tpl_vars['v']['img']): ?><img src='<?php echo $this->_tpl_vars['v']['img']; ?>
' width="88" height="32" /><?php endif; ?></td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['remarks'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                <td><a href="?m=Link&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">修改</a><a href="?m=Link&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
" onclick="return confirm('确定要删除此链接？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td width="5%"></td>
                <td width="95%" colspan="6" class="padding"><input type="submit" value="更新排序" class="inputSub1" name="sortSub" /> <span class="hui">值越大排序越前</span></td>
            </tr>
            </form>
        </table>
    </div>
    <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>