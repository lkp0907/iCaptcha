(function( $ ) {
 
    // Plugin definition.
    $.fn.iCaptcha = function( options ) {
		var obj = this;
        var defaults = {
			lang : 'en',
			fail : function(){},
			success : function(){},
			width:200,
			height:50
		};
		var settings = $.extend({},defaults,options);
		
		$.ajax({
			type: "POST",
			url: settings.path+"/captcha.php",
			dataType: "json",
			data: settings,
			success: function(data){
				
				//  이 곳에서 이미지를 받아옵니다. 추가로, idx 값을 설정해주어야 합니다.
				// idx < 사용자 요청 id
				// 디자인을 바꾸어주세요, 단 hidden Input 값들은 모두 들어가야합니다.
				///////////////////////////////Change Design/////////////////////////////////////////////////
				
				var html = '<div style="text-align:center;">\
									<h3>Please Input Text in Image</h3>\
									<b>It is just check you are not robot.</b>\
									<div style="display:block;margin-bottom:20px;margin-top:20px;">\
										<img id="captchaImg" src="'+settings.path+'/'+data.img+'">\
									</div>\
									<form id="sendCaptcha" name="sendCaptcha" action="" method="POST"\
									/ >\
										<input type="text" name="input"/>\
										<input type="hidden" name="flag" value="1"/>\
										<input type="hidden" name="idx" value="'+data.idx+'"/>\
										<input type="hidden" name="lang" value="'+settings.lang+'">\
										<input type="hidden" name="type" value="'+settings.types+'">\
										<input type="button" id="btnSendCaptcha" value="submit" name="submit"/>\
									</form>\
									<form id="refreshCaptcha" name="refreshCaptcha" action="" method="POST">\
										<input type="hidden" name="lang" value="'+settings.lang+'">\
										<input type="button" id="btnRefreshCaptcha" value="Refresh">\
									</form>\
									<h3>결과창입니다</h3>\
									<p id="result">-</p>\
								</div>';
				obj.html(html);
				////////////////////////////////////////////////////////////////////////////////////////////////
				
				$("#btnSendCaptcha").click(function(){
					var formData = $("#sendCaptcha").serialize();
					console.log(JSON.stringify(formData));
					$.ajax({
						type: "POST",
						url: settings.path+"/captcha.php",
						dataType: "json",
						data: formData,
						success: function(data){
							//$("#captchaImg").attr("src",data.img);
							console.log(JSON.stringify(data));
							if(data.error==="0"){
								$("#result").text("Correct");	
								$("#result").css("color","green");
							}else if(data.error==="1"){
								$("#result").text("Wrong Answer");
								$("#result").css("color","red");
							}
							
						}
					});
				});
				
				$("#btnRefreshCaptcha").click(function(){
					var formData = $("#refreshCaptcha").serialize();
					$.ajax({
						type: "POST",
						url: settings.path+"/captcha.php",
						dataType: "json",
						data: formData,
						success: function(data){
							$("#captchaImg").attr("src",settings.path+"/"+data.img);
							$("#result").text("Refresh");
							$("#result").css("color","black");
						}
					});
				
				});
			},
			error:function(request,status,error){
				console.log(request.responseText);
			}
		});
	};
 
})( jQuery );