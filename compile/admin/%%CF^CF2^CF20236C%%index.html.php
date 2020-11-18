<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:52
         compiled from Back/index.html */ ?>
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
	<li>备份数据库</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column" id="allcheckbox">
    <h1 class="slideSub"><a href="?m=Backdb&a=index" class="curr">备份数据</a><a href="?m=Backdb&a=backdbInList">恢复数据</a></h1>
        <table cellpadding="0" cellspacing="1" border="0">
        <form action="?m=Backdb&a=backdbUp" method="post">
            <tr>
                <th width="10%">选择</th>
                <th width="90%">数据表名</th>
            </tr>
            <?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><input type="checkbox" name="tabname[]" value="<?php echo $this->_tpl_vars['v']; ?>
" checked /></td>
                <td class="padding"><?php echo $this->_tpl_vars['v']; ?>
</td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td colspan="2" style="padding-left:4%; text-align:left;"><input type="checkbox" checked class="allcheckbox" />全选&nbsp;&nbsp;每卷长度：<input type="text" name="backsize" value="2048" class="inputText" style="width:30px; text-align:center;" />KB&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="备份数据" name="backdbUp" class="inputSub1" /></td>
            </tr>
        </form>
        </table>
    </div>
</div>
</body>
</html>