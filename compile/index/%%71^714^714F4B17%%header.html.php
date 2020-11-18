<?php /* Smarty version 2.6.28, created on 2014-08-27 23:52:52
         compiled from header.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'menu', 'header.html', 20, false),array('function', 'classurl', 'header.html', 34, false),array('function', 'slide', 'header.html', 37, false),)), $this); ?>
<div class="top width">
  <div class="logo"><a href="<?php echo $this->_tpl_vars['weburl']; ?>
" title="<?php echo $this->_tpl_vars['webname']; ?>
"><img src="<?php echo $this->_tpl_vars['weburl']; ?>
template/default/image/logo.gif" alt="<?php echo $this->_tpl_vars['webname']; ?>
" /></a></div>
  <div class="searchBox">
    <form action="<?php echo $this->_tpl_vars['weburl']; ?>
index.php" method="get">
    <input type="hidden" name='m' value="Search" />
    <input type="hidden" name="a" value="index" />
    <input type="hidden" name="classid" value="5" />
    <input type="hidden" name="tem" value="index" />
    <input type="hidden" name="field" value="title,keywords,description" />
  	<table cellpadding="0" cellspacing="0" border="0">
    	<tr>
        	<td><input type="text" name="keywords" class="inputText" /></td>
        	<td><input type="submit" value=" " class="inputSub" /></td>
        </tr>
    </table>
    </form>
  </div>
</div>
<div class="nav width" id="nav">
  <?php echo smarty_function_menu(array('child' => 1), $this);?>

  <ul>
    <li><a href="<?php echo $this->_tpl_vars['weburl']; ?>
" title="首页"<?php if ($this->_tpl_vars['classid'] == 'home'): ?> class="curr"<?php endif; ?>>首页</a></li>
    <?php $_from = $this->_tpl_vars['menu_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
    <li><a href="<?php echo $this->_tpl_vars['v']['classurl']; ?>
" title="<?php echo $this->_tpl_vars['v']['classname']; ?>
"<?php if (( $this->_tpl_vars['v']['classid'] == $this->_tpl_vars['topid'] || $this->_tpl_vars['v']['classid'] == $this->_tpl_vars['classid'] ) && $this->_tpl_vars['classid'] != 4): ?> class='curr'<?php endif; ?>><?php echo $this->_tpl_vars['v']['classname']; ?>
</a>
    	<?php if ($this->_tpl_vars['v']['child']): ?>
        <dl>
        <?php $_from = $this->_tpl_vars['v']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        <dd><a href="<?php echo $this->_tpl_vars['i']['classurl']; ?>
"><?php echo $this->_tpl_vars['i']['classname']; ?>
</a></dd>
        <?php endforeach; endif; unset($_from); ?>
        </dl>
        <?php endif; ?>
    </li>
    <?php endforeach; endif; unset($_from); ?>
    <li><a href="<?php echo smarty_function_classurl(array('id' => 4), $this);?>
"<?php if ($this->_tpl_vars['classid'] == 4): ?> class='curr'<?php endif; ?>>联系我们</a></li>
  </ul>
</div>
<div class="slide width"><?php echo smarty_function_slide(array('id' => 1,'style' => 3,'width' => 900,'height' => 310), $this);?>
</div>