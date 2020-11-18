//var statusE = document.getElementById('swfu-upload-status');//文件上传进度节点
var swfuOption = {//swfupload选项
	flash_url : "/plug/swfupload/swfupload.swf",//swfupload压缩包解压后swfupload.swf的url
	button_placeholder_id : "swfu-placeholder",//上传按钮占位符的id
	
	button_width: 73, //按钮宽度
	button_height: 22, //按钮高度
	file_upload_limit : 0,
	use_query_string : false, 
	file_queue_limit : 10,
	button_text: '<span class="btn-txt">选择文件</span>',//按钮文字
	button_text_style: '.btn-txt{color: #000;font-size:12px;font-family:"微软雅黑"}',//按钮文字样式
	button_text_top_padding: 0,//文字距按钮顶部距离
	button_text_left_padding: 10,//文字距离按钮左边距离
	button_image_url: "/template/admin/img/subbg1.gif",//按钮背景
	debug: false,//开启调试模式
	
	file_queued_handler:fileQueued,
	file_queue_error_handler:fileQueueError,
	upload_progress_handler: uploadProgress,//文件上传中
	upload_error_handler: uploadError,//文件上传出错
	upload_complete_handler: uploadComplete//文件上传完成，在upload_error_handler或者upload_success_handler之后触发
	//这个地方在windows上有个bug，官方如是说：在window平台下，那么服务端的处理程序在处理完文件存储以后，必须返回一个非空值，否则此事件不会被触发，随后的uploadComplete事件也无法执行。
	

	
}


//用来动态显示文件上传进度
function uploadProgress(file, curBytes, totalBytes) {
	var bfb = parseInt((curBytes/totalBytes)*100) + '%';
	$('#'+file.id+' b.baifenbinum').html(bfb);
	$('#'+file.id+' b.baifenbi').css('width',bfb);
}

//上传出错
function uploadError(file,errCode,msg) {
	$('#'+file.id+' b.baifenbinum').html('上传出错，请重新上传');
}


//加入队列
function fileQueued(file) {
	var str = "<li id='"+file.id+"'><p><span>"+file.name+"</span><font title='移除' onclick='delFile("+file.id+")'>X</font><b class='baifenbi'></b></p><b class='baifenbinum'></b></li>";
	$('.fileduilie ul').append(str);
}
//上传完成，无论上传过程中出错还是上传成功，都会触发该事件，并且在那两个事件后被触发
function uploadComplete(file) {
	this.startUpload();//继续上传
}
//选择文件关闭窗口错处提示
function fileQueueError(file,error,message){
	if(error == -110){
		alert('文件大小超过系统设置');
	}else if(error == -100){
		alert('选择文件数量超过了系统限制');
	}else if(error == -120){
		alert('文件大小不能为0');
	}else if(error == -130){
		alert('文件类型不符合要求');
	}else{
		alert('未知错误');	
	}
}
//移除队列
function delFile(file){
	$('#'+file.id).fadeOut();
	$('#'+file.id).remove();
	swfu.cancelUpload(file.id,false);
}

