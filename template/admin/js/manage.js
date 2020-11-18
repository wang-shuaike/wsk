$(function(){
	$('#addManage').click(function(){
		var name=$('#name').val();
		if(!name){
			$('#name').parent('td').find('.error').html('用户名不能为空');
			return false;
		}
		var path=/^[a-zA-Z0-9_]+$/;
		if(!path.test(name)){
			$('#name').parent('td').find('.error').html('用户名格式错误');
			return false;
		}
		var pwd=$('#pwd').val();
		if(!pwd){
			$('#pwd').parent('td').find('span').html('密码不能为空');
			return false;
		}
		var pwd2=$('#pwd2').val();
		if(!pwd2){
			$('#pwd2').parent('td').find('.error').html('确认密码不能为空');
			return false;
		}
		if(pwd != pwd2){
			$('#pwd2').parent('td').find('.error').html('两次密码输入不一致');
			return false;
		}
	})
	$('#updateManage').click(function(){
		var name=$('#name').val();
		if(!name){
			$('#name').parent('td').find('.error').html('用户名不能为空');
			return false;
		}
		var path=/^[a-zA-Z0-9_]+$/;
		if(!path.test(name)){
			$('#name').parent('td').find('.error').html('用户名格式错误');
			return false;
		}
		var pwd=$('#pwd').val();
		var pwd2=$('#pwd2').val();
		if(pwd || pwd2){
			if(!pwd){
				$('#pwd').parent('td').find('span').html('密码不能为空');
				return false;
			}
			if(!pwd2){
				$('#pwd2').parent('td').find('.error').html('确认密码不能为空');
				return false;
			}
			if(pwd != pwd2){
				$('#pwd2').parent('td').find('.error').html('两次密码输入不一致');
				return false;
			}
		}
		
	})
	$('#mainForm input:text').blur(function(){
		$(this).parent('td').find('.error').html('');
	})
})
