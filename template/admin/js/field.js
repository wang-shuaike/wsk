$(function(){
	
	//默认提示文字
	var str = '多个值用"回车"格开；格式用：名称==值；当值等于名称时，名称可省略；';
	var typeVal = $('#ftype option:selected').attr('value');
	if(typeVal == 'select' || typeVal == 'checkbox' || typeVal == 'radio'){
		$('#point').html(str);
	}else{
		$('#point').html('');	
	}
	//选择后提示文字
	$('#ftype').change(function(){
		var typeVal = $(this).val();
		if(typeVal == 'selects' || typeVal == 'checkbox' || typeVal == 'radio'){
			$('#point').html(str);
		}else{
			$('#point').html('');	
		}
	})
	
	
})

//验证表单
function checkField(){
	var fname = $('#fname').val();
	if(!fname){
		alert('字段名称不能为空');
		$('#fname').focus();
		return false;
	}
	if(fname.length < 3 || fname.length > 10){
		alert('字段名称不能小于3位大于10位');
		$('#fname').focus();
		return false;
	}
	if(!/^[a-zA-Z]+[a-zA-Z0-9]+$/.test(fname)){
		alert('字段名称必须由字母、数字组成，并且仅能字母开头');
		$('#fname').focus();
		return false;
	}
	var ftitle = $('#ftitle').val();
	if(!ftitle){
		alert('字段标识不能为空');
		$('#ftitle').focus();
		return false;
	}
	
}