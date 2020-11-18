<?php /* Smarty version 2.6.28, created on 2014-08-27 23:52:52
         compiled from index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'classurl', 'index.html', 17, false),array('function', 'article', 'index.html', 19, false),array('function', 'single', 'index.html', 32, false),array('function', 'link', 'index.html', 53, false),array('modifier', 'lmxstr', 'index.html', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['webname']; ?>
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
<div class='indexBox1 width'>
	<div class="indexBox1_l">
    	<h1>产品中心<a href="<?php echo smarty_function_classurl(array('id' => 5), $this);?>
"><font>更多</font></a></h1>
        <div class="index_product boxbg1">
        	<?php echo smarty_function_article(array('classid' => 5,'num' => 5), $this);?>

            <ul id="slide_product">
                <?php $_from = $this->_tpl_vars['article_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product_s'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product_s']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['product_s']['iteration']++;
?>
                <li<?php if ($this->_foreach['product_s']['iteration'] == 1): ?> style='display:block;' class='curr'<?php endif; ?>><a href="<?php echo $this->_tpl_vars['v']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['v']['pic']; ?>
" alt='<?php echo $this->_tpl_vars['v']['title']; ?>
' width='180' height='180' /></a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            <span id="prev"></span>
            <span id="next"></span>
        </div>
    </div>
	<div class="indexBox1_c">
    	<h1>公司介绍<a href="<?php echo smarty_function_classurl(array('id' => 1), $this);?>
"><font>更多</font></a></h1>
        <div class="index_about boxbg">
        	<?php echo smarty_function_single(array('classid' => 1), $this);?>

            <p><?php echo ((is_array($_tmp=$this->_tpl_vars['single_data']['content'])) ? $this->_run_mod_handler('lmxstr', true, $_tmp, 250) : smarty_modifier_lmxstr($_tmp, 250)); ?>
</p>
        </div>
    </div>
	<div class="indexBox1_r">
    	<h1>新闻动态<a href="<?php echo smarty_function_classurl(array('id' => 6), $this);?>
"><font>更多</font></a></h1>
        <div class="index_news boxbg">
        <?php echo smarty_function_article(array('classid' => 6,'num' => 7), $this);?>

        <ul>
        	<?php $_from = $this->_tpl_vars['article_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <li><a href="<?php echo $this->_tpl_vars['v']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('lmxstr', true, $_tmp, 30) : smarty_modifier_lmxstr($_tmp, 30)); ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="link width">
	<table cellpadding="0" border="0" cellspacing="0">
    	<tr>
        	<td width="70">友情链接：</td>
            <td><?php echo smarty_function_link(array(), $this);?>

            	<ul>
                	<?php $_from = $this->_tpl_vars['link_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['v']['url']; ?>
"><?php echo $this->_tpl_vars['v']['name']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </td>
        </tr>
    </table>
</div>
</body>
</html>