function Fromcheck(){
	var formname = $('#formname').val();
	if(!formname){
		alert('表单名称不能为空');
		$('#formname').focus();
		return false;
	}
}

function Fieldcheck(){
	var fieldname = $('#fieldname').val();
	if(!fieldname){
		alert('字段名称不能为空');
		$('#fieldname').focus();
		return false;
	}
	var fieldtitle = $('#fieldtitle').val();
	if(!fieldtitle){
		alert('字段标识不能为空');
		$('#fieldtitle').focus();
		return false;
	}
	var fieldtype = $('#fieldtype option:selected').attr('value');
	if(!fieldtype){
		alert('字段标识不能为空');
		$('#fieldtype').focus();
		return false;
	}
}