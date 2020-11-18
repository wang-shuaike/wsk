$(function(){
	$("#extime").simpleDatepicker({startdate:2014,enddate:2020});	
	var load_type = $('#type option:selected').val();
	$('#ad'+load_type).css('display','table');
	$('#type').change(function(){
		var index = $(this).val();
		$('.ad').css('display','none');
		$('#ad'+index).css('display','table');	
	})
	
})
function check(){
	var name = $('#name').val();
	if(!name){
		alert('广告名称不能为空');
		$('#name').focus();
		return false;
	}
	var type = $('#type option:selected').val();
	if(type != 0 && type != 1 && type != 2){
		alert('广告类型有误');
		$('#type').focus();
		return false;
	}
	var extime = $('#extime').val();
	if(!extime){
		alert('到期时间不能为空');
		$('#name').focus();
		return false;
	}
}