$(function(){
	$('.delform').live('click',function(){
		$(this).parent('li').remove();
	})
})
function addimg(type,id,path){
	var num = $('#'+id+' li').length + 1;
	if(type == 1){
		var name = '选择图片';
	}else if(type == 2){
		var name = '选择文件';	
	}
	var str = "<li><input type='text' name='"+id+"[]' id='"+id+num+"' class='inputText inputWidth' /><input type='button' class='inputSub1' value='"+name+"' onclick=\"selectUpload("+type+",'"+path+"','"+id+num+"');\" /> <input type='button' value='移除' class='inputSub1 delform' /></li>";
	$('#'+id).append(str);
}