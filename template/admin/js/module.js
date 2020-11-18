$(function(){
	$('#tab').focus(function(){
		$('#module_text').addClass('inputBG');
	}).blur(function(){
		$('#module_text').removeClass('inputBG');
	})
	
	$('#module_text').click(function(){
		$('#tab').focus();
	})
	
})


function checkModule(){
	var mname = $('#mname').val();
	if(!mname){
		alert('请填写模型名称');
		$('#mname').focus();
		return false;
	}
	var updateModule = $('#updateModule').val();
	//判断是只有增加的时候验证数据表
	if(!updateModule){
		var tab = $('#tab').val();
		if(!tab){
			alert('请填写数据表名称');
			$('#tab').focus();
			return false;
		}
		if(tab.length > 10 || tab.length < 3){
			alert('数据表名称由3-10个字母、数字组成，且以字母开头');
			$('#tab').focus();
			return false;
		}
		//验证数据表名称是否合法
		if(!/^([a-zA-Z]+)[a-zA-Z0-9]+$/.test(tab)){
			alert('请正确填写数据表名称');
			$('#tab').focus();
			return false;
		}
	}
	
}