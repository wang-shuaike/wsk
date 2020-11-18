<?php /* Smarty version 2.6.28, created on 2014-08-27 23:52:56
         compiled from main_left.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'menu', 'main_left.html', 2, false),)), $this); ?>
<h1>产品中心</h1>
<?php echo smarty_function_menu(array('classid' => 5), $this);?>

<ul>
<?php $_from = $this->_tpl_vars['menu_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
<li><a href="<?php echo $this->_tpl_vars['v']['classurl']; ?>
"><?php echo $this->_tpl_vars['v']['classname']; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<h1>联系方式</h1>
<p>地址：辽宁沈阳市<br />
  电话：0731-8888888<br />
  传真：0731-8888888</p>