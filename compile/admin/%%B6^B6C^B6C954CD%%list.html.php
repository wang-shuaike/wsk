<?php /* Smarty version 2.6.28, created on 2014-08-28 21:05:56
         compiled from Schtml/list.html */ ?>
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
	<li>生成栏目页面</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainForm schtml" id="mainForm">
        <form action="?m=Schtml&a=lists" method="post">
        <input type="hidden" name="scform" value="1" />
        <table cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<th>生成全部栏目</th>
            </tr>
        	<tr>
            	<td><input type="submit" name="allclass" value="生成全部栏目" class="inputSub1" /></td>
            </tr>
        	<tr>
            	<th>按照栏目生成</th>
            </tr>
        	<tr>
            	<td style="position:relative;"><select name="classid[]" multiple="multiple" style="width:220px; height:300px; outline:none;">
                	<?php $_from = $this->_tpl_vars['classdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                    <option value="<?php echo $this->_tpl_vars['v']['classid']; ?>
"><?php echo $this->_tpl_vars['v']['html']; ?>
<?php echo $this->_tpl_vars['v']['classname']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                <ul>
                	<li>1、您可以按住CtrL或SHIFT同时选择多个栏目一起发布</li>
                	<li>2、也可以选择一个栏目</li>
                	<li><span class="error">4、注意在生成过程中，请勿手动刷新此页面</span></li>
                    <li><input type="submit" name="classidsub" value="开始生成" class="inputSub1" /></li>
                </ul>
</td>
            </tr>
        </table>
        </form>
    </div>
</div>
</body>
</html>