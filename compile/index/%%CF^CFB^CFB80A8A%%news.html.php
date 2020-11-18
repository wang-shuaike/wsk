<?php /* Smarty version 2.6.28, created on 2014-08-27 23:52:56
         compiled from content/news.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date', 'content/news.html', 24, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
<?php echo $this->_tpl_vars['public']['global']['webname_public']; ?>
</title>
<meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['weburl']; ?>
template/default/css/style.css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['weburl']; ?>
template/default/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['weburl']; ?>
template/default/js/main.js"></script>
</head>

<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="navpos width">您所在的位置：<?php echo $this->_tpl_vars['navpos']; ?>
</div>
<div class="mainBox width">
	<div class="mainBox_l">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'main_left.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
	<div class="mainBox_r">
    	<div class="rightBox">
        	<div class="mainRightH1"><?php echo $this->_tpl_vars['classname']; ?>
</div>
            <h1 class="contentH1"><?php echo $this->_tpl_vars['title']; ?>
</h1>
            <div class="news_p">发布时间：<?php echo ((is_array($_tmp='Y-m-d H:i:s')) ? $this->_run_mod_handler('date', true, $_tmp, $this->_tpl_vars['time']) : date($_tmp, $this->_tpl_vars['time'])); ?>
&nbsp;&nbsp;访问次数：<?php echo $this->_tpl_vars['clicknum']; ?>
</div>
            <div class="contentBox"><?php echo $this->_tpl_vars['content']; ?>
</div>
            <div class='hrefBox'>
            	<ul>
                	<li>上一页：<a href='<?php echo $this->_tpl_vars['prev']['url']; ?>
'><?php echo $this->_tpl_vars['prev']['title']; ?>
</a></li>
                    <li>下一页：<a href='<?php echo $this->_tpl_vars['next']['url']; ?>
'><?php echo $this->_tpl_vars['next']['title']; ?>
</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>