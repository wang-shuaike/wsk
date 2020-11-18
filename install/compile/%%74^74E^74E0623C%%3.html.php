<?php /* Smarty version 2.6.28, created on 2014-08-04 18:37:26
         compiled from 3.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'rand', '3.html', 60, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lmxcms网站管理系统安装</title>
<link rel="stylesheet" type="text/css" href="/install/tem/css/style.css" />
</head>

<body>
<div class="top">
	<div class="logo width"><img src="/install/tem/images/logo.gif"  /><span>lmxcms <?php echo $this->_tpl_vars['version']; ?>
 网站系统 安装程序</span></div>
</div>
<div class="mainBox">
    <div class="but width"><span><font>1</font>安装使用协议</span><span><font>2</font>系统环境效验</span><span class="curr"><font>3</font>参数配置</span><span><font>4</font>正在安装</span><span><font>5</font>安装完成</span></div>
    <form action="" method="post">
    <div class="main width content2">
    	<h1>请正确填写数据库信息和网站后台管理员帐号和密码</h1>
        <div class="mainK check3">
        	<h2><span>配置数据库信息</span></h2>
            <table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<td align="right" width="20%"><strong>数据库主机地址</strong></td>
                	<td width="80%"><input type="text" name="local" value="localhost" class="inputText" /><span>一般为localhost</span></td>
                </tr>
            	<tr>
                	<td align="right"><strong>数据库名称</strong></td>
                	<td><input type="text" name="dbname" class="inputText" /><span>若您不清楚数据库名称，请咨询您的空间提供商</span></td>
                </tr>
            	<tr>
                	<td align="right"><strong>数据库用户名</strong></td>
                	<td><input type="text" name="dbuser" class="inputText" /></td>
                </tr>
            	<tr>
                	<td align="right"><strong>数据库密码</strong></td>
                	<td><input type="text" name="dbpwd" class="inputText" /></td>
                </tr>
            	<tr>
                	<td align="right"><strong>数据表前缀</strong></td>
                	<td><input type="text" name="dbpre" value="lmx_" class="inputText" /><span>如无特殊需要,请不要修改，以“_”结尾</span></td>
                </tr>
            </table>
        </div>
        <div class="mainK check3">
        	<h2><span>设置管理员</span></h2>
            <table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<td align="right" width="20%"><strong>管理员用户名</strong></td>
                	<td width="80%"><input type="text" name="user_name" value="admin" class="inputText" /><span>以数字、字母、下划线开头</span></td>
                </tr>
            	<tr>
                	<td align="right"><strong>管理员密码</strong></td>
                	<td><input type="text" name="user_pwd" class="inputText" /></td>
                </tr>
            	<tr>
                	<td align="right"><strong>确认密码</strong></td>
                	<td><input type="text" name="user_pwd1" class="inputText" /></td>
                </tr>
            	<tr>
                	<td align="right"><strong>密码加密</strong></td>
                	<td><input type="text" name="user_key" class="inputText" value="<?php echo ((is_array($_tmp=1000000000)) ? $this->_run_mod_handler('rand', true, $_tmp, 9999999999) : rand($_tmp, 9999999999)); ?>
" /><span>密码加密字符串 默认即可</span></td>
                </tr>
            </table>
        </div>
	</div>
    <div class="form_sub"><input type="hidden" name="action" value="3" /><input type="submit" value="开始安装" name="sub3" style="padding:5px 20px;" /></div>
    </form>
    <div class="footer width">Powered by <a href="http://www.lmxcms.com">lmxcms</a> <?php echo $this->_tpl_vars['version']; ?>
 ©2014  <a href="http://www.lmxcms.com">lmxcms Inc.</a></div>
</div>
</body>
</html>