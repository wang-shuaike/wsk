//定位框架宽度与高度
window.onload = function () {(
	window.onresize = function(){
		var mainBoxWidth=document.documentElement.clientWidth;
		var mainBoxHeight=document.documentElement.clientHeight;
		$('#leftBox').css('height',(mainBoxHeight-155)+'px');
		$('#rightBox').css('height',(mainBoxHeight-155)+'px');
		$('#rightBox').css('width',(mainBoxWidth-210)+'px');
	}
)()}

$(function(){
	$('.nav li').click(function(){
		$('#leftBox dl').css('display','none');	
		$('.nav li a').removeClass('curr');
		$(this).find('a').addClass('curr');
		$('#leftBox dl').eq($(this).index()).css('display','block');
	})
	$('#leftBox dd').click(function(){
		$('#leftBox dd a').removeClass('curr');
		$(this).find('a').addClass('curr');	
	})
	
	$('.inputText,.textarea').live('blur',function(){
		$(this).removeClass('inputBG');
	})
	$('.inputText,.textarea').live('focus',function(){
		$(this).addClass('inputBG');
	})
	
	
	$('.mainList tr').hover(function(){
		$(this).addClass('curr');
	},function(){
		$('.mainList tr').removeClass('curr');
	})
	
	$('#slideSub span').click(function(){
		var index=$(this).index();
		$('#slideSub span').removeClass('curr');
		$(this).addClass('curr');
		$('.slideBox').css('display','none');
		$('#k'+index).css('display','table');
	})
	
	//全选
	$('.allcheckbox').click(function(){
		$("#allcheckbox input:checkbox").attr("checked",!!$(this).attr("checked"));
	})
	

})
//打开上传
function selectUpload(type,path,field,ismore){
	if(!path){
		alert('参数有误');
		return false;	
	}
	if(!field){
		alert('参数有误');
		return false;	
	}
	var ismorestr = '';
	if(ismore){
		ismorestr = '&ismore='+ismore;
	}
	var openUrl;
	if(type == 1){
		openUrl='?m=Upload&a=img&dir='+path+'&field='+field+ismorestr;
	}else if(type == 2){
		openUrl='?m=Upload&a=file&dir='+path+'&field='+field+ismorestr;
	}else{
		return false;	
	}
	window.open(openUrl,'','width=700,height=550,scrollbars=yes');
}
function getClasslisthtml(){
	$.post('?m=ajax&a=getClasslistHtml',{},function(data){
		$('.contentClassList').html(data);
	});
}


function redirect(url) {
	location.href = url;
}

//设置滚动条始终在最下面
function scrollToBottom() {
    var scrollTop = $("ul")[0].scrollHeight;
    $("ul").scrollTop(scrollTop);
 }
 
function getLoad(host_v){
	$.ajax({
		 type: "GET",
		 url: "?m=Ajax&a=get_lmxcms_info",
		 async:true,
		 timeout:10000,
		 dataType:"json",
		 beforeSend:function(){
			$('#version').html('<img src="/template/admin/img/load.gif" />');	 
			$('#linkNews').html('<tr><td><img src="/template/admin/img/load.gif" /></td></tr>');	 
		 },
		 success:function(data){
			 var host_vstr = host_v.replace('.','');
			 var link_v = data.update.v;
			 var link_vstr = link_v.replace('.','');
			 if(link_vstr > host_vstr){
				$('#version').html('<a href="'+data.update.url+'" class="error" style=" padding:0px;" target="_blank">已有新版本点击查看更新说明</a>');
			 }else{
				$('#version').html(host_v+' <span class="succ">已经是最新</span>');
			 }
			 var html = '';
			 if(data.news.length > 0){
				 $.each(data.news,function(k,i){
					 html += '<tr><td><a href="'+i.url+'" target="_blank">'+i.title+'</a></td></tr>';
				 })
			 }else{
				 html += '<tr><td><span class="hong">暂无</span></td></tr>';
			 }
			 $('#linkNews').html(html);
		 },
		 error:function(){
			var html ='<span id="repeat_link" class="hong" style=" cursor:pointer;">获取远程信息失败，点击重试</span>';
			$('#version').html(html);	 
			$('#linkNews').html('<tr><td>'+html+'</td></tr>');	 
		 }
	 });
}