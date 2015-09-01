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
			
				var html = '  <div style="text-align:center;">\
									<h3>Please Input Text in Image</h3>\
									<b>It is just check you are not robot.</b>\
									<div style="display:block;margin-bottom:20px;margin-top:20px;">\
										<img id="captchaImg" src="'+settings.path+'/'+data.img+'">\
									</div>\
									<form id="sendCaptcha" name="sendCaptcha" action="" method="POST"\
									/ >\
										<input type="text" name="input"/>\
										<input type="hidden" name="flag" value="1"/>\
										<input type="hidden" name="lang" value="'+settings.lang+'">\
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
				
				$("#btnSendCaptcha").click(function(){
					var formData = $("#sendCaptcha").serialize();
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