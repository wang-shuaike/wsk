function check(){
	var content = $('#content').val()
	if(!content){
		alert('回复内容不能为空');
		$('#content').focus();
		return false;
	}
}