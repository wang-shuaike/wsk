$(function(){
	var len = $('#slide5 li').length;
	var width = $('#slide5').width();
	var spanWidth = width / len;
	var index = 0;
	
	var subStr = '';
	//插入按钮
	for(i=0;i<len;i++){
		if(i==0){
			subStr += '<span class="curr" style=" width:'+spanWidth+'px"></span>';
		}else{
			subStr += '<span style=" width:'+spanWidth+'px"></span>';
		}
	}
	$('#slide5').append("<p>"+subStr+"</p>");
	
	//点击按钮
	$('#slide5 p span').live('click',function(){
		var clickIndex = $(this).index();
		index = clickIndex;
		slide5(clickIndex);
	})
	
	//自动播放
	if(len > 1){
		$("#slide5").hover(function() {
			clearInterval(slide);
		},function(){
			slide = setInterval(function() {
				index++;
				if(index == len) {index = 0;}
				slide5(index);
			},4000); 
		}).trigger("mouseleave");
	}
	function slide5(index){
		$('#slide5 li').css('display','none');
		$('#slide5 p span').removeClass('curr');
		$('#slide5 li').eq(index).fadeIn(200);
		$('#slide5 p span').eq(index).addClass('curr');
	}
})