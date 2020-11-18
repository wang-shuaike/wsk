<?php /* Smarty version 2.6.28, created on 2014-08-28 15:07:36
         compiled from content/product.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'forstr', 'content/product.html', 25, false),)), $this); ?>
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
            <?php if ($this->_tpl_vars['duotp']): ?>
            <?php echo smarty_function_forstr(array('data' => $this->_tpl_vars['duotp']), $this);?>

            <div class="sidle_con" id="sidle_con">
                <div class="sidle_con_l">
                    <ul>
                        <?php $_from = $this->_tpl_vars['forstr_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['d'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['d']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['d']['iteration']++;
?>
                            <li<?php if ($this->_foreach['d']['iteration'] == 1): ?> style=' display:block;'<?php endif; ?>><img src="<?php echo $this->_tpl_vars['v']; ?>
" /></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
                <div class="sidle_con_r">
                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td><img src='<?php echo $this->_tpl_vars['weburl']; ?>
template/default/image/prev.gif' id='c_prev' class='sub_img' /></td>
                      <td><ul>
                          <?php $_from = $this->_tpl_vars['forstr_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['x'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['x']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['x']['iteration']++;
?>
                            <li<?php if ($this->_foreach['x']['iteration'] == 1): ?> class='dq'<?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['v']; ?>
" /><em></em></span></li>
                          <?php endforeach; endif; unset($_from); ?>
                        </ul></td>
                      <td><img src='<?php echo $this->_tpl_vars['weburl']; ?>
template/default/image/next.gif' id='c_next' class='sub_img' /></td>
                    </tr>
                  </table>
                </div>
            </div>
            <?php endif; ?>
            <div class="content_h1">产品介绍</div>
            <div class="contentBox"><?php echo $this->_tpl_vars['content']; ?>
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