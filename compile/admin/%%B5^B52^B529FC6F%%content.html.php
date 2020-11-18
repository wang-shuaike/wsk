<?php /* Smarty version 2.6.28, created on 2014-08-27 23:50:59
         compiled from Content/content.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'Content/content.html', 84, false),)), $this); ?>
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
	<li>信息管理</li>
</ul>
</div>
<div class="mainBox">
    <div class="mainList" id="allcheckbox">
    	<div class="mainHead"><form method="get" action="">
        <span class="succ" style="margin-left:20px;">选择栏目：</span><select name="classid">
        <?php $_from = $this->_tpl_vars['selectData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
            <option value=<?php echo $this->_tpl_vars['i']['classid']; ?>
<?php if ($this->_tpl_vars['classData']['classid'] == $this->_tpl_vars['i']['classid']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['i']['html']; ?>
<?php echo $this->_tpl_vars['i']['classname']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
        <input type="hidden" name="m" value="Content" />
        <input type="hidden" name="a" value="add" />
        <input type="submit" class="inputSub1" value="+增加信息" />
        </form>
        <p><form method="get" class="right_form" action="">搜索：
        <input type="hidden" name="m" value="Search" />
        <input type="hidden" name="a" value="search" />
        <input type="text" class="inputText inputText1" name="keywords" value='<?php echo $this->_tpl_vars['keywords']; ?>
' />
        <input type="hidden" name="field" value="title,keywords,description" />
        <select name="mid">
        <?php $_from = $this->_tpl_vars['allModData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
            <option value=<?php echo $this->_tpl_vars['i']['mid']; ?>
<?php if ($this->_tpl_vars['modData']['mid'] == $this->_tpl_vars['i']['mid']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['i']['mname']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
        <select name="classid">
        	<option value="0">不限栏目</option>
        <?php $_from = $this->_tpl_vars['selectData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
            <option value=<?php echo $this->_tpl_vars['i']['classid']; ?>
<?php if ($this->_tpl_vars['classData']['classid'] == $this->_tpl_vars['i']['classid']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['i']['html']; ?>
<?php echo $this->_tpl_vars['i']['classname']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
        <select name="attr">
        	<option value="0">不限</option>
            <option value="1"<?php if ($this->_tpl_vars['attr'] == 1): ?> selected<?php endif; ?>>热门</option>
            <option value="2"<?php if ($this->_tpl_vars['attr'] == 2): ?> selected<?php endif; ?>>推荐</option>
        </select>
        <select name="time">
        	<option value="0"<?php if ($this->_tpl_vars['time'] == 0): ?> selected<?php endif; ?>>全部时间</option>
        	<option value="1"<?php if ($this->_tpl_vars['time'] == 1): ?> selected<?php endif; ?>>1天</option>
        	<option value="2"<?php if ($this->_tpl_vars['time'] == 2): ?> selected<?php endif; ?>>2天</option>
        	<option value="3"<?php if ($this->_tpl_vars['time'] == 3): ?> selected<?php endif; ?>>7天</option>
        	<option value="4"<?php if ($this->_tpl_vars['time'] == 4): ?> selected<?php endif; ?>>一个月</option>
        	<option value="5"<?php if ($this->_tpl_vars['time'] == 5): ?> selected<?php endif; ?>>三个月</option>
        	<option value="6"<?php if ($this->_tpl_vars['time'] == 6): ?> selected<?php endif; ?>>半年</option>
        	<option value="7"<?php if ($this->_tpl_vars['time'] == 7): ?> selected<?php endif; ?>>一年</option>
        </select>
        <input type="submit" name="searchSub" class="inputSub1" value="搜索" />
        </form>
        </p></div>
        <table cellpadding="0" cellspacing="1" border="0">
            <tr>
            	<th width="5">选择</th>
                <th width="5%">信息ID</th>
                <th width="35%">标题</th>
                <th width="15%">属性</th>
                <th width="10%">所属栏目</th>
                <th width="15%">发布时间</th>
                <th width="15%">操作</th>
            </tr>
            <form method="post" action="?m=Content&a=infoManage">
                <input type="hidden" name="classid" value="<?php echo $this->_tpl_vars['classData']['classid']; ?>
" />
            <?php $_from = $this->_tpl_vars['listInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <tr>
            	<td><input type="checkbox" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" name="id[]" /></td>
                <td><?php echo $this->_tpl_vars['v']['id']; ?>
</a></td>
                <td class="padding"><a href="<?php echo $this->_tpl_vars['v']['url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['v']['title']; ?>
</a></td>
                <td><?php if ($this->_tpl_vars['v']['tuijian']): ?><span class="hong">[<?php echo $this->_tpl_vars['tuijianSelect'][$this->_tpl_vars['v']['tuijian']]; ?>
]</span><?php endif; ?><?php if ($this->_tpl_vars['v']['remen']): ?><span class="hong">[<?php echo $this->_tpl_vars['remenSelect'][$this->_tpl_vars['v']['remen']]; ?>
] </span><?php endif; ?><?php if (! $this->_tpl_vars['v']['remen'] && ! $this->_tpl_vars['v']['tuijian']): ?>无<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['allclass'][$this->_tpl_vars['v']['classid']]['classname']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                <td><a href="?m=Content&a=update&id=<?php echo $this->_tpl_vars['v']['id']; ?>
&classid=<?php echo $this->_tpl_vars['v']['classid']; ?>
">修改</a><a href="?m=Content&a=delete&id=<?php echo $this->_tpl_vars['v']['id']; ?>
&classid=<?php echo $this->_tpl_vars['v']['classid']; ?>
" onclick="return confirm('确定要删除此信息？');">删除</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
            	<td width="5%"><input type="checkbox" class="allcheckbox" /></td>
                <td width="95%" colspan="6" class="padding">
                <input type="submit" value="删除" onclick="return confirm('确定要删除这些信息？');" class="inputSub1" name="deleteInfo" />
                <select name="tuijian">
                <option value=0>不推荐</option>
                <?php $_from = $this->_tpl_vars['tuijianSelect']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <option value=<?php echo $this->_tpl_vars['k']; ?>
><?php echo $this->_tpl_vars['v']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
                <input type="submit" value="推荐" class="inputSub1" name="tuijianInfo" />
                <select name="remen">
                <option value=0>不推荐</option>
                <?php $_from = $this->_tpl_vars['remenSelect']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <option value=<?php echo $this->_tpl_vars['k']; ?>
><?php echo $this->_tpl_vars['v']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
                <input type="submit" value="热门" class="inputSub1" name="remenInfo" />
                </td>
            </tr>
            </form>
        </table>
    </div>
    <div class="page">共 <?php echo $this->_tpl_vars['num']; ?>
 条 <?php echo $this->_tpl_vars['page']; ?>
</div>
</div>
</body>
</html>