function login(){
	var name=$('#name').val();
	var pwd=$('#pwd').val();
	if(!name){
		alert('用户名不能为空');
		return false;	
	}
	if(!pwd){
		alert('密码不能为空');
		return false;
	}
}