<?php /* Smarty version 2.6.28, created on 2014-08-27 23:51:09
         compiled from Ad/ad.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Ad/ad.html', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
<script type="text/javascript" src="/template/admin/js/ad.js"></script>


</head>

<body>
<div class="dqnav">
<ul>
	<li>当前位置：</li>
	<li><a href="?m=index&a=main">后台首页</a></li>
	<li><span>&gt;</span></li>
	<li>广告管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList column">
    	<h1 class="slideSub" id="ad"><a<?php if (! $this->_tpl_vars['extime']): ?> class="curr"<?php endif; ?> href="?m=Ad&a=index">全部广告</a><a href="?m=Ad&a=index&extime=1"<?php if ($this->_tpl_vars['extime']): ?> class="curr"<?php endif; ?>>即将到期</a></h1>
        <div class='smfooter' style="padding-bottom:10px;"><span class='hong'>调用广告：&lt;script type='text/javascript' src='广告js地址【下面有】'&gt;&lt;/script&gt;</span></div>
    	<div class="mainHead"><a href="?m=Ad&a=add">+增加广告</a><a href="?m=Ad&a=cacheAd">更新广告缓存</a></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
                <th width="7%">广告ID</th>
                <th width="12%">广告名称</th>
                <th width="7%">广告类型</th>
                <th width="11%">过期时间</th>
                <th width="15%">JS调用地址</th>
                <th width="8%">点击次数</th>
                <th width="30%">备注</th>
                <th width="10%">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['ad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
                <td class="padding"><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['type']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['extime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
</td>
                <td>/data/ad/<?php echo $this->_tpl_vars['v']['id']; ?>
.js</td>
                <td><?php echo $this->_tpl_vars['v']['click']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['remarks']; ?>
</td>
                <td><a href="?m=Ad&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
">修改</a><a href="?m=Ad&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
" onclick="return confirm('确定要删除此广告？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </form>
        </table>
    </div>
    <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>