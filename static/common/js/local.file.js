$(document).ready(function(){
	initUpload();
});
function initUpload(){
	$("#upload_file").on('click',function(){
		doUpload();
	});
	$(".editormd-file-input input[name=editormd-image-file]").delegate('click',function(){
		doUpload();
	});
}
function doUpload() {
        // 上传方法
				console.log('doUpload');
				$('.fa.fa-close.editormd-dialog-close').trigger('click');
        var token=$('#token').val();
        $.upload({
                        // 上传地址
                        url:baseurl+"index.php/upload/upload_file/",
                        // 文件域名字
                        fileName: 'file',
                        // 其他表单数据
                        params:{stb_csrf_token:token},
                        // 上传完成后, 返回json, text
                        dataType: 'json',
                        // 上传之前回调,return true表示可继续上传
                        onSend: function() {
                                        return true;
                        },
                        // 上传之后回调
                        onComplate: function(data) {
	                        if(data.file_url){
	                        var addString = '![]('+baseurl+data.file_url +' "")';
							var textareaContain = $("#post_content").eq(0);
							//$('#post_content').val(textareaContain.val()+addString);
							//$("#post_content").insertAtCaret(addString);
							testEditor.insertValue(addString);
							// $('#post_content').val(textareaContain.val()+addString);
              } else {
								alert(data.error);
							}

                        }
        });
}
