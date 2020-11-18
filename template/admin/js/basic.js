$(function(){
	$('#setBasic').live('click',function(){
		var weburl=$('#weburl').val();
		if(!weburl){
			alert('网站地址不能为空');
			return false;
		}
		var path=/\/$/;
		if(!path.test(weburl)){
			alert('网站地址必须以“/”结尾');
			return false;
		}
		if($('.addVarBox tr').length > 1){
			var path1=/^[a-zA-Z0-9_]+$/;
			var isName=true;
			var isValue=true;
			var varName='';
			var varValue='';
			$('.varName').each(function() {
				varName=$(this).val();
				if(varName){
					if(!path1.test(varName)){
						isName=false;
						return false;
					}
				}
				varValue=$(this).parents('tr').find('.varValue').val();
				if(!varName && varValue){
					isValue=false;
					return false;	
				}
			});
			if(!isName){
				alert('变量名只能由字母、数字、下划线组成');
				return false;
			}
			if(!isValue){
				alert('请填写变量名');
				return false;
			}
		}
	})
	
	//增加扩展变量
	$('#addVar').click(function(){
		var i=$('.addVarBox tr').length;
		var type=$('#varType').val();
		var parent=$(this).parent('table');
		var input='';
		if(type == 2){
			input="<textarea class='textarea varValue' name='global["+i+"][value]'></textarea>";
		}else{
			input="<input type='text' class='inputText varValue' name='global["+i+"][value]' />";
		}
		var str="<tr>";
			str+="<td>变量名：<br /><input type='text' class='inputText varName' style=' width:100%;' name='global["+i+"][name]' /><br /><span class='hui'>字母数字下划线组成</span></td>";
			str+="<td>变量值：<em class='delVar' title='删除该变量'>X</em><br /><input type='hidden' name='global["+i+"][type]' value="+type+" />"+input+"</td>";
			str+="</tr>";
		$('.addVarBox').append(str);
	})
	$('.delVar').live('click',function(){
		if(!confirm('确定要删除吗？')){
			return false;
		}
		$(this).parents('tr').remove();
	})
})
