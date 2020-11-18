<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:55
         compiled from Search/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Search/index.html', 36, false),)), $this); ?>
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
	<li><a href="?m=Search&a=getSearchData">搜索关键字管理</a></li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column" id="allcheckbox">
        <table cellpadding="0" cellspacing="1" border="0">
            <form action="?&m=Search&a=delSearchKey" method="post" onsubmit="return confirm('确定要删除吗？');">
            <tr>
                <th width="5%">选择</th>
                <th width="5%">ID</th>
                <th width="45%">关键字</th>
                <th width="15%">最后搜索时间</th>
                <th width="15%">搜索人气</th>
                <th width="15%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['search_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
            	<td><input type="checkbox" name="sid[]" value="<?php echo $this->_tpl_vars['v']['sid']; ?>
" /></td>
                <td><?php echo $this->_tpl_vars['v']['sid']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['keywords']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['click']; ?>
</td>
                <td><a href="?m=Search&a=delSearchKey&sid=<?php echo $this->_tpl_vars['v']['sid']; ?>
" onclick="return confirm('确定要删除吗？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td><input type='checkbox' class='allcheckbox' /></td>
                <td colspan="8" class='padding'><input type='submit' name='delmorekey' value='批量删除' class='inputSub1' /> &nbsp;&nbsp;删除搜索人气小于（<b style='color:#f00;'>&lt;</b>）<input type="text" name='click' class='inputText' value='2' style="width:20px; text-align:center;" /> 的记录 <input type="submit" class='inputSub1' name="delclick" value='删除' /></td>
            </tr>
            </form>
        </table>
    </div>
    <div class="page"><?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>