<?php /* Smarty version 2.6.28, created on 2014-08-27 13:19:07
         compiled from 2.html */ ?>
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
    <div class="but width"><span><font>1</font>安装使用协议</span><span class="curr"><font>2</font>系统环境效验</span><span><font>3</font>参数配置</span><span><font>4</font>正在安装</span><span><font>5</font>安装完成</span></div>
    <div class="main width content2">
    	<h1>检查您的服务器是否支持安装lmxcms网站管理系统，请在继续安装前消除错误或警告信息。</h1>
        <div class="mainK checksys">
        	<h2><span>环境检测结果</span></h2>
            <ul>
            	<?php if ($this->_tpl_vars['install_mysqls']): ?>
            	<li><span>MySQL支持</span>ON</li>
                <?php else: ?>
                <li class="no"><span>MySQL支持</span>Off</li>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_isphp']): ?>
            	<li><span>PHP版本</span><?php echo $this->_tpl_vars['install_phpvs']; ?>
</li>
                <?php else: ?>
                <li class="no"><span>PHP版本</span>php版本必须 >= 5</li>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_preg_replace']): ?>
                <li><span>preg_replace</span>ON</li>
                <?php else: ?>
                <li class="no"><span>preg_replace</span>Off</li>
                <?php endif; ?>
            	
                <?php if ($this->_tpl_vars['install_mysql_connect']): ?>
                <li><span>mysql_connect</span>ON</li>
                <?php else: ?>
                <li class="no"><span>mysql_connect</span>Off</li>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['install_file_put_contents']): ?>
                <li><span>file_put_contents</span>ON</li>
                <?php else: ?>
                <li class="no"><span>file_put_contents</span>Off</li>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['install_file_get_contents']): ?>
                <li><span>file_get_contents</span>ON</li>
                <?php else: ?>
                <li class="no"><span>file_get_contents</span>Off</li>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['install_gd']): ?>
                <li><span>GD 支持</span>ON</li>
                <?php else: ?>
                <li class="no"><span>GD 支持</span>Off</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="mainK checkdir">
        	<h2><span>目录权限检测</span></h2>
            <p>要能正常使用lmxcms企业网站管理系统，需要将下面几个目录设置为“777”权限。某些主机不允许您设置“777” 权限，要用666。先试最高的值，不行的话，再逐步降低该值。</p>
            <table cellpadding="0" cellspacing="1" border="0">
            	<tr>
                	<th>目录、文件名</th>
                	<th>是否通过</th>
                	<th>设置权限</th>
                </tr>
                <?php if ($this->_tpl_vars['install_dir_s']): ?>
                <tr>
                	<td>/</td>
                	<td><span>通过</span></td>
                	<td>0777</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777</td>
                </tr>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_dir_compile']): ?>
                <tr>
                	<td>/compile/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/compile/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_dir_data']): ?>
                <tr>
                	<td>/data/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/data/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_dir_file']): ?>
                <tr>
                	<td>/file/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/file/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_dir_inc']): ?>
                <tr>
                	<td>/inc/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/inc/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
                
                <?php if ($this->_tpl_vars['install_dir_template']): ?>
                <tr>
                	<td>/template/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/template/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['install_dir_install']): ?>
                <tr>
                	<td>/install/</td>
                	<td><span>通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php else: ?>
                <tr class="no">
                	<td>/install/</td>
                	<td><span>权限检测没有通过</span></td>
                	<td>0777(应用到所有子目录及文件)</td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
	</div>
    <form action="" method="post">
    <div class="form_sub"><input type="hidden" name="action" value="2" /><input type="submit" value="下一步" name="sub2" style="padding:5px 20px;" /></div>
    </form>
    <div class="footer width">Powered by <a href="http://www.lmxcms.com">lmxcms</a> <?php echo $this->_tpl_vars['version']; ?>
 ©2014  <a href="http://www.lmxcms.com">lmxcms Inc.</a></div>
</div>
</body>
</html>