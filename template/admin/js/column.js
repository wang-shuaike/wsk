$(function(){
	$('.spanInput').live('blur',function(){
		$('#spanInput').removeClass('inputBG');	
		$('#singlespanInput').removeClass('inputBG');	
		$('.qspanInputText').removeClass('inputBG');
	})
	$('.spanInput').live('focus',function(){
		$('#spanInput').addClass('inputBG');		
		$('#singlespanInput').addClass('inputBG');		
		$('.qspanInputText').addClass('inputBG');		
	})
	//生成拼音文件名
	$('#scSingleFile').click(function(){
		var classname = $('#classname').val();
		if(!classname){
			alert('请填写栏目名称');
			$('#classname').focus();
			return false;
		}
		$.post('?m=Ajax&a=PinYinDir',{path:classname},function(data){
			var singleparentPath = $('#singleparentPath').val();
			if(singleparentPath == '/'){
				$('#singlepath').val(data);
			}else{
				$('#singlepath').val(singleparentPath+'/'+data);
			}
		});
	})
	//检测单页文件是否存在
	$('#isFile').click(function(){
		var singlepath = $('#singlepath').val();
		if(!singlepath){
			alert('请填写单页文件名');
			$('#singlepath').focus();
			return false;
		}
		$.post('?m=Ajax&a=isFile',{path:singlepath,fix:'.html'},function(data){
			singlepath = singlepath.replace(/\/$/,'');
			if(data == 1){
				alert('单页文件名 /'+singlepath+'.html 已存在');
			}else{
				alert('恭喜，/'+singlepath+'.html 检测通过');	
			}
		})
	})
	//生成拼音目录
	$('#scDir').click(function(){
		var classname = $('#classname').val();
		if(!classname){
			alert('请填写栏目名称');
			$('#classname').focus();
			return false;
		}	
		$.post('?m=Ajax&a=PinYinDir',{path:classname},function(data){
			var parentPath = $('#parentPath').val();
			if(parentPath == '/'){
				$('#classpath').val(data);
			}else{
				$('#classpath').val(parentPath+'/'+data);
			}
		});
	})
	//检测目录是否存在
	$('#isDir').click(function(){
		var classpath = $('#classpath').val();
		if(!classpath){
			alert('请填写本栏目目录');
			$('#classpath').focus();
			return false;
		}
		classpath = classpath.replace(/\/$/,'');
		$.post('?m=Ajax&a=isDir',{path:classpath},function(data){
			if(data == 1){
				alert('目录 /'+classpath+' 已存在');
			}else{
				alert('恭喜，/'+classpath+' 检测通过');	
			}
		})
	})
	
	//栏目类型表单显示切换
	var classtype=$('#classtype').val();
	displayType(classtype);
	$('#classtype').change(function(){
		classtype=$('#classtype').val();	
		displayType(classtype);
	})
	
	
	//重新选择栏目类型赋值各项参数
	$('#classtype').change(function(){
		var classtype = $('#classtype').val();
		var uid = $('#uid').val();
		var uidPath = $('#uid').find('option:selected').attr('data-path');
		if(classtype == 0 ){
			if(uid == 0 || !uidPath || uidPath == '/'){
				$('#classpath').val('');
			}else{
				$('#classpath').val(uidPath+'/');
			}
			$('#parentPath').val(uidPath);
			$('#classpath').focus();
		}else if(classtype == 1){
			if(uid == 0 || uidPath == '/'){
				$('#singlepath').val('');
			}else{
				$('#singlepath').val(uidPath+'/');
			}
			$('#singleparentPath').val(uidPath);
			$('#singlepath').focus();
		}
	})
	//激活目录表单
	$('#spanInput').click(function(){
		$('#classpath').focus();	
	})
	//赋值上层目录
	$('#uid').change(function(){
		if(classtype < 0 || classtype > 2){
			alert('栏目类型有误');
			$('#classtype').focus();
			return false;
		}
		var uid = $(this).val();
		var path = $(this).find('option:selected').attr('data-path');
		if(classtype == 0){
			if(uid == 0 || !path || path == '/'){
				$('#classpath').val('');
			}else{
				$('#classpath').val(path+'/');
			}
			$('#parentPath').val(path);
			$('#classpath').focus();
		}else if(classtype == 1){
			if(uid == 0 || !path || path == '/'){
				$('#singlepath').val('');
			}else{
				$('#singlepath').val(path+'/');
			}
			$('#singleparentPath').val(path);
			$('#singlepath').focus();
		}
	})
	
	//验证数据
	$('#addColumn').click(function(){
		var classname = $('#classname').val();
		if(!classname){
			alert('栏目名称不能为空');
			$('#classname').focus();
			return false;
		}
		
		if(classtype < 0 || classtype > 2){
			alert('栏目类型有误');
			$('#classtype').focus();
			return false;
		}
		var uid = $('#uid').val();
		if(!/^[0-9]+$/.test(uid)){
			alert('上级栏目有误');
			$('#uid').focus();
			return false;
		}
		var classpath = $('#classpath').val();
		if(classtype == 0){
			var mid = parseInt($('#mid').val());
			if(!mid){
				alert('所属模块有误');
				$('#mid').focus();
				return false;
			}
			var classpathPath=/^[a-zA-Z0-9_\/]+$/;
			if(!classpathPath.test(classpath)){
				alert('请正确填写目录名称');
				$('#classpath').focus();
				return false;
			}
			var uidPath = $('#uid').find('option:selected').attr('data-path');
			if(classpath == (uidPath+'/')){
				alert('本栏目目录不能与上级栏目相同');
				$('#classpath').focus();
				return false;
			}
			var listtems = $('#listtem').val();
			if(!listtems || listtems == 0){
				alert('请选择栏目模板');
				$('#listtems').focus();
				return false;
			}
			var contem = $('#contem').val();
			if(!contem || contem == 0){
				alert('请选择内容模板');
				$('#contem').focus();
				return false;
			}
		}
		if(classtype == 1){
			var mid = parseInt($('#mid').val());
			if(!mid){
				alert('所属模块有误');
				$('#mid').focus();
				return false;
			}
			var singlepath = $('#singlepath').val();
			var singlepathPath=/^[a-zA-Z0-9_\/]+$/;
			if(!singlepathPath.test(singlepath)){
				alert('请正确填写单页文件名');
				$('#singlepath').focus();
				return false;
			}
			var uidPath = $('#uid').find('option:selected').attr('data-path');
			if(singlepath == (uidPath+'/')){
				alert('单页文件名不能与上级栏目相同');
				$('#singlepath').focus();
				return false;
			}
			var singletem = $('#singletem').val();
			if(!singletem || singletem == 0){
				alert('请选择单页模板');
				$('#singletem').focus();
				return false;
			}
		}
	})
})




//栏目类型显示切换
function displayType(id){
	$('.columnK').css('display','none');
	$('.display'+id).css('display','table');
	if(id == 1){
		$('.columnK_seo').css('display','table');
	}
}