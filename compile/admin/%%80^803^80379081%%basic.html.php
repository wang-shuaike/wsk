<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:34
         compiled from Basic/basic.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/template/admin/css/style.css" />
<script type="text/javascript" src="/template/admin/js/jquery.js"></script>
<script type="text/javascript" src="/template/admin/js/main.js"></script>
<script type="text/javascript" src="/template/admin/js/basic.js"></script>

</head>

<body>
<div class="dqnav">
<ul>
	<li>当前位置：</li>
	<li><a href="?m=index&a=main">后台首页</a></li>
	<li><span>&gt;</span></li>
	<li>基本设置</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainForm" id="mainForm">
    	<h1 class="slideSub" id="slideSub"><span class="curr">基本设置</span><span>扩展变量</span><span>其他设置</span></h1>
        <form action="?&m=basic&a=set" method="post">
    	<table cellpadding="0" border="0" cellspacing="0" class="slideBox" id="k0" style="display:table;">
        	<tr>
            	<th colspan="2">基本设置</th>
            </tr>
        	<tr>
            	<td width="12%" align="right">网站地址：</td>
            	<td width="88%"><input type="text" class="inputText" name="weburl" id="weburl" value="<?php echo $this->_tpl_vars['public']['weburl']; ?>
" /> <span class="succ">默认即可（可以写绝对路径）“/”结尾</span></td>
            </tr>
        	<tr>
            	<td align="right">网站名称：</td>
            	<td><input type="text" class="inputText inputWidth" name="webname" value="<?php echo $this->_tpl_vars['public']['webname']; ?>
" /></td>
            </tr>
            <tr>
            	<td align="right">网站关键词：</td>
            	<td><input type="text" class="inputText inputWidth" name="keywords" value="<?php echo $this->_tpl_vars['public']['keywords']; ?>
" /> <span class="error"></span></td>
            </tr>
        	<tr>
            	<td align="right">网站描述：</td>
            	<td><textarea class="textarea" name="description"><?php echo $this->_tpl_vars['public']['description']; ?>
</textarea></td>
            </tr>
            <tr>
            	<td align="right">开启纯静态html：</td> 
                <td><label for="ishtml"><input type="radio" name="ishtml"<?php if ($this->_tpl_vars['public']['ishtml'] == 1): ?> checked="checked"<?php endif; ?> id="ishtml" value="1" />是</label>&nbsp;&nbsp;<label for="ishtml0"><input type="radio" name="ishtml" value='0' id="ishtml0" <?php if ($this->_tpl_vars['public']['ishtml'] == 0): ?> checked="checked"<?php endif; ?> />否</label></td>
            </tr>
        </table>
        <table cellpadding="0" border="0" cellspacing="0" class="slideBox addVarBox" id="k1">
        	<tr>
            	<th width="12%" align="right" style="text-align:right;">扩展变量：</th>
            	<th width="88%"><select id="varType"><option value="1">单行文本框</option><option value="2">多行文本框</option></select>&nbsp;&nbsp;<span id="addVar" class="inputSub1">增加变量</span> <span class="succ">支持html代码 <b>模板中调用 “$public.global.变量名”</b></span></th>
            </tr>
            <?php $_from = $this->_tpl_vars['public']['global']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['global'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['global']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['global']['iteration']++;
?>
            <tr>
                <td>变量名：<br><input type="text" class="inputText varName" style=" width:100%;" name="global[<?php echo $this->_foreach['global']['iteration']; ?>
][name]" value="<?php echo $this->_tpl_vars['k']; ?>
"><br><span class="hui">字母数字下划线组成</span></td>
                <td>变量值：<em class="delVar" title="删除该变量">X</em><br><?php if ($this->_tpl_vars['public']['globalType'][$this->_tpl_vars['k']] == 2): ?><textarea class='textarea varValue' name='global[<?php echo $this->_foreach['global']['iteration']; ?>
][value]'><?php echo $this->_tpl_vars['i']; ?>
</textarea><?php else: ?><input type="text" class="inputText varValue" name="global[<?php echo $this->_foreach['global']['iteration']; ?>
][value]" value='<?php echo $this->_tpl_vars['i']; ?>
' /><?php endif; ?><input type='hidden' name='global[<?php echo $this->_foreach['global']['iteration']; ?>
][type]' value="<?php echo $this->_tpl_vars['public']['globalType'][$this->_tpl_vars['k']]; ?>
" /></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
        <table cellpadding="0" border="0" cellspacing="0" class="slideBox" id="k2">
        	<tr>
            	<th colspan="2">其他设置</th>
            </tr>
        	<tr>
            	<td width="15%" align="right">前台搜索时间间隔：</td>
            	<td width="85%"><input type="text" class="inputText" style="width:30px; text-align:center;" name="searchtime" value="<?php echo $this->_tpl_vars['public']['searchtime']; ?>
" /> 秒 <span class="succ">避免搜索频繁占用系统资源</span></td>
            </tr>
        	<tr>
            	<td width="15%" align="right">前台搜索每页显示：</td>
            	<td width="85%"><input type="text" class="inputText" style="width:30px; text-align:center;" name="searchnum" value="<?php echo $this->_tpl_vars['public']['searchnum']; ?>
" /> 条</td>
            </tr>
            <tr>
            	<td align="right">导航分隔字符：</td>
            	<td><input type="text" class="inputText" style="width:30px; text-align:center;" name="navsplit"  value="<?php echo $this->_tpl_vars['public']['navsplit']; ?>
" /> <span class="succ">前台所在位置分隔符</span></td>
            </tr>
            <tr>
            	<td align="right">开启留言板：</td>
            	<td><label for="isbook1"><input type="radio" name="isbook" <?php if ($this->_tpl_vars['public']['isbook'] == 1): ?> checked="checked"<?php endif; ?> value="1" id="isbook1" />是</label>&nbsp;&nbsp;<label for="isbook0"><input type="radio" id="isbook0" name="isbook" value='0'<?php if ($this->_tpl_vars['public']['isbook'] == 0): ?> checked="checked"<?php endif; ?> />否</label></td>
            </tr>
            <tr>
            	<td align="right">是否获取留言数据</td>
                <td><label for="isbookdata1"><input type="radio" name="isbookdata" <?php if ($this->_tpl_vars['public']['isbookdata'] == 1): ?> checked="checked"<?php endif; ?> value="1" id="isbookdata1" />是</label>&nbsp;&nbsp;<label for="isbookdata0"><input type="radio" id="isbookdata0" name="isbookdata" value='0'<?php if ($this->_tpl_vars['public']['isbookdata'] == 0): ?> checked="checked"<?php endif; ?> />否</label></td>
            </tr>
            <tr>
            	<td align="right">重复留言时间限制：</td>
            	<td><input type="text" class="inputText" style="width:30px; text-align:center;" name="repeatbook" value="<?php echo $this->_tpl_vars['public']['repeatbook']; ?>
" /> 秒 </td>
            </tr>
            <tr>
            	<td align="right">留言板每页显示：</td>
            	<td><input type="text" class="inputText" style="width:30px; text-align:center;" name="booknum" value="<?php echo $this->_tpl_vars['public']['booknum']; ?>
" /> 条 </td>
            </tr>
            <tr>
            	<td align="right">留言是否审核可见：</td>
                <td><label for="bookDisplay1"><input type="radio" id='bookDisplay1' name="bookDisplay"<?php if ($this->_tpl_vars['public']['bookDisplay'] == 1): ?> checked="checked"<?php endif; ?> value="1" />是</label> <label for="bookDisplay0"><input type="radio"<?php if ($this->_tpl_vars['public']['bookDisplay'] == 0): ?> checked="checked"<?php endif; ?> name="bookDisplay" value="0" id='bookDisplay0' />否</label></td>
            </tr>
            <tr>
            	<td align="right">上传图片默认选项：</td>
            	<td><label for="iswater"><input type="checkbox" <?php if ($this->_tpl_vars['public']['iswater'] == 1): ?> checked="checked"<?php endif; ?> value=1 name="iswater" id="iswater" />加水印</label> <label for="issmall"><input type="checkbox" value=1 name="issmall" id="issmall"<?php if ($this->_tpl_vars['public']['issmall'] == 1): ?> checked="checked"<?php endif; ?> />生成缩略图</label>：宽度 <input type="text" style="width:40px;" class="inputText" name="small_width" value="<?php echo $this->_tpl_vars['public']['small_width']; ?>
" />&nbsp;&nbsp;高度 <input type="text" style="width:40px;" class="inputText" value="<?php echo $this->_tpl_vars['public']['small_height']; ?>
" name="small_height" /></td>
            </tr>
            <tr>
            	<td align="right">水印图片：</td>
                <td><input type="text" value="<?php echo $this->_tpl_vars['public']['markImg']; ?>
" name="markImg" class="inputText inputWidth" /> <span class="succ">“/”为根目录</span></td>
            </tr>
            <tr>
            	<td align="right">推荐名称：</td>
                <td><textarea class="textarea" name="tuijianSelect"><?php echo $this->_tpl_vars['public']['tuijianSelect']; ?>
</textarea> <span class="succ">每行一条</span></td>
            </tr>
            <tr>
            	<td align="right">热门名称：</td>
                <td><textarea class="textarea" name="remenSelect"><?php echo $this->_tpl_vars['public']['remenSelect']; ?>
</textarea> <span class="succ">每行一条</span></td>
            </tr>
        </table>
        <div class="mainBoxSub"><input type="submit" value="保存配置" class="inputSub" name="setBasic" id="setBasic" /></div>
        </form>
    </div>
</div>
</body>
</html>