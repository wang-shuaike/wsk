$(function(){
	//导航下拉
	$('#nav li').hover(function(){
		$(this).find('dl').fadeIn(200);
	},function(){
		$('#nav li dl').css('display','none');
	})
	
	//首页产品切换
	$('#prev').click(function(){
		var index = $('#slide_product li.curr').index()-1;
		slide_product(index);
	})
	$('#next').click(function(){
		var index = $('#slide_product li.curr').index()+1;
		slide_product(index);
	})
	
	//内容页面切换
	$('.sidle_con_r li').click(function(){
		var index = $(this).index();
		$('.sidle_con_l li').css('display','none');
		$('.sidle_con_r li').removeClass('dq');
		$(this).addClass('dq');
		$('.sidle_con_l li').eq(index).fadeIn();
	})
	
	$('#c_prev').click(function(){
		var index = $('.sidle_con_r li.dq').index();
		var count = $('.sidle_con_r li').length - 1;
		num = index == 0 ? count : index - 1;
		$('.sidle_con_l li').css('display','none');
		$('.sidle_con_r li').removeClass('dq');
		$('.sidle_con_r li').eq(num).addClass('dq');
		$('.sidle_con_l li').eq(num).fadeIn();
	})
	
	$('#c_next').click(function(){
		var index = $('.sidle_con_r li.dq').index();
		var count = $('.sidle_con_r li').length - 1;
		num = index == count ? 0 : index + 1;
		$('.sidle_con_l li').css('display','none');
		$('.sidle_con_r li').removeClass('dq');
		$('.sidle_con_r li').eq(num).addClass('dq');
		$('.sidle_con_l li').eq(num).fadeIn();
	})
	
})

//产品切换
function slide_product(index){
	var len = $('#slide_product li').length;
	if(index <= 0){
		index == len;
	}else if(index >= len){
		index = 0;
	}
	$('#slide_product li').fadeOut(200).removeClass('curr');
	$('#slide_product li').eq(index).fadeIn(400).addClass('curr');
}