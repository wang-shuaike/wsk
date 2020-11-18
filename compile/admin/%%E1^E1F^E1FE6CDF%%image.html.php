<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:56
         compiled from File/image.html */ ?>
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
    <li>图片管理</li>
  </ul>
</div>
<div class="mainBox">
  <div class="mainList ">
    <h1 class="slideSub"><a class="curr" href="?m=File&a=index&type=0">图片管理</a><a href="?m=File&a=index&type=1">文件管理</a></h1>
    <div class="uploadBox">
      <form action="?m=File&a=delete" method="post">
      	<input type="hidden" name="type" value="0" />
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th style="text-align:left; padding-left:2%;"><label for="allImage"><input type="checkbox" id="allImage" class="allcheckbox" />全选</label> <input type="submit" value="删除选中图片" name="delImages" class="inputSub1" onclick="return confirm('确定删除吗？');" /></th>
          </tr>
        </table>
        <div class="mainUploadImgListBox manageImageList">
          <ul id="allcheckbox">
            <?php $_from = $this->_tpl_vars['file']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['imglist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['imglist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['imglist']['iteration']++;
?>
            <li><label for="img<?php echo $this->_foreach['imglist']['iteration']; ?>
"><span><img src="<?php echo $this->_tpl_vars['v']['path']; ?>
" width="105" height="80" /></span><?php if ($this->_tpl_vars['v']['issmall']): ?><b>缩略图</b><?php endif; ?><input id="img<?php echo $this->_foreach['imglist']['iteration']; ?>
" type="checkbox" name="fid[]" value=<?php echo $this->_tpl_vars['v']['fid']; ?>
#####<?php echo $this->_tpl_vars['v']['path']; ?>
 /></label></li>
            <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div>
      </form>
    </div>
  </div>
  <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php if ($this->_tpl_vars['page']): ?><?php echo $this->_tpl_vars['page']; ?>
<?php endif; ?></div>
</div>
</body>
</html>