function check(){
	var name = $('#name').val();
	if(!name){
		alert('链接名称不能为空');
		$('#name').focus();
		return false;	
	}
	var url = $('#url').val();
	if(!url){
		alert('链接地址不能为空');
		$('#url').focus();
		return false;	
	}
	if(!/^http:\/\//.test(url)){
		alert('链接地址请以 http:// 开头');
		$('#url').focus();
		return false;	
	}
}