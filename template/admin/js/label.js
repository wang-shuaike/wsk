$(function(){
	$('#labelNav li span').click(function(){
		$(document).scrollTop(0);	
		var index = $(this).parent('li').index();
		$('.labelBoxCon').css('display','none');
		$('#labelBox'+index).css('display','block');
		$('#labelNav span').removeClass('curr');
		$(this).addClass('curr');
	})
	
	$('.labelBox_r tr').hover(function(){
		$(this).addClass('curr');
	},function(){
		$('.labelBox_r tr').removeClass('curr');
	})
	
	//滚动
	$(window).scroll(function(){
		var topheight = $(document).scrollTop();	
		if(topheight > 48){
			$('#labelNav').css('top',(topheight-48)+'px');
		}else{
			$('#labelNav').css('top','0px');
		}
	})
	
})

//定位
function posBox(index,h){
	$('.labelBoxCon').css('display','none');
	$('#labelBox'+index).css('display','block');
	$('#labelNav span').removeClass('curr');
	$('#labelNav span').eq(index).addClass('curr');
	var h1heht = $('#labelBox'+index+' h1').eq(h).offset().top;
	$(document).scrollTop(h1heht);
}