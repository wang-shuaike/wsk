<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:35
         compiled from main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'u', 'main.html', 28, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>

<script type="text/javascript">
$(function(){
	getLoad('<?php echo $this->_tpl_vars['version']; ?>
');
	$('#repeat_link').live('click',function(){
		getLoad('<?php echo $this->_tpl_vars['version']; ?>
');	
	})
	<?php if (! $this->_tpl_vars['isupdate']): ?>
	$('#version_v p').remove();
	$('#version_v').html('<?php echo $this->_tpl_vars['version']; ?>
');
	<?php endif; ?>
})

</script>
</head>

<body>
<div class="dqnav">
    <ul>
        <li>当前位置：</li>
        <li><a href="<?php echo ((is_array($_tmp='Index')) ? $this->_run_mod_handler('u', true, $_tmp, 'main') : u($_tmp, 'main')); ?>
" target="">后台首页</a></li>
    </ul>
</div>
<div class="mainBox">
	<div class="mainForm sysBox">
    	<div class="sysLeft">
            <?php if ($this->_tpl_vars['is_install']): ?>
        	<div class="if_install_path">您的安装目录没有删除，<a href="?m=Index&a=delInstall_dir">请点击这里删除安装目录</a>，避免招恶意重复安装系统！</div>
            <?php endif; ?>
        	<div class="webInfo">
            	<h1>服务器信息</h1>
                <table cellspacing="1" cellpadding="0" border="0">
                	<tr>
                    	<td align="right" width="25%" class="bg0">程序名称：</td>
                        <td width="75%">梦想(lmxcms)网站内容管理系统</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">系统版本：</td>
                        <td id="version_v"><p id="version" style="font-family:'微软雅黑';"></p></td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">服务器域名/IP：</td>
                        <td><?php echo $this->_tpl_vars['webdomain']; ?>
</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">处理端口：</td>
                        <td><?php echo $this->_tpl_vars['webport']; ?>
</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">PHP | MySql：</td>
                        <td><?php echo $this->_tpl_vars['webparser']; ?>
</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">服务器操作系统：</td>
                        <td><?php echo $this->_tpl_vars['webSysType']; ?>
</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">站点物理路径：</td>
                        <td><?php echo $this->_tpl_vars['webdir']; ?>
</td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">上传文件最大值：</td>
                        <td><?php echo $this->_tpl_vars['fileMaxSize']; ?>
 <span class='succ'>（php.ini中的设置）</span></td>
                    </tr>
                    <tr>
                    	<td align="right" class="bg0">版权所有：</td>
                        <td><a href="http://www.lmxcms.com" target="_blank" class="public">www.lmxcms.com</a></td>
                    </tr>
                </table>
            </div>
        </div>
    	<div class="sysRight">
        	<h1>LMXCMS新闻</h1>
            <table cellpadding="0" border="0" cellspacing="1" id="linkNews"></table>
        </div>
        <div class="fuwuzc">
            <h1>服务与支持</h1>
            <ul>
                <li><a href="http://www.lmxcms.com/doc" target="_blank">使用手册</a></li>
                <li><a href="http://www.lmxcms.com/doc" target="_blank">视频教程</a></li>
                <li><a href="http://www.lmxcms.com" target="_blank">官方网站</a></li>
                <li><a href="http://www.lmxcms.com/dingzhi.html" target="_blank">定制开发</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>