<?php /* Smarty version 2.6.28, created on 2014-08-28 17:19:35
         compiled from Back/down.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'Back/down.html', 32, false),)), $this); ?>
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
	<li>下载数据库</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column" id="allcheckbox">
    <h1 class="slideSub"><a href="?m=Backdb&a=index">备份数据</a><a href="?m=Backdb&a=backdbInList" class="curr">恢复数据</a></h1>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="100%">文件名（点击文件名下载）</th>
            </tr>
            <?php $_from = $this->_tpl_vars['downlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td class="padding"><a href="/other/down.php?filename=http://<?php echo $this->_tpl_vars['webhttp']; ?>
/file/back/<?php echo $this->_tpl_vars['v']; ?>
" target='_blank'><?php echo $this->_tpl_vars['v']; ?>
</a> <a href="/other/down.php?filename=http://<?php echo $this->_tpl_vars['webhttp']; ?>
/file/back/<?php echo $this->_tpl_vars['v']; ?>
" target='_blank'>【下载】</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td class="padding"><span class="succ"><?php if (count ( $this->_tpl_vars['downlist'] ) > 1): ?><span class="error">【<?php echo count($this->_tpl_vars['downlist']); ?>
个分卷都要下载】</span><?php endif; ?>点击文件名即可下载，下载完成后请删除该备份，避免数据库信息泄漏</span></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>