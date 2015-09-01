<!DOCTYPE HTML>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="src/assets/vendor/fullPageMaster/javascript.fullPage.css" />
<style>
#section0 {
	background-color:rgba(127, 140, 141,0.7);
}
#section1 {
	background-color:rgba(127, 140, 141,0.7);
}
#section2 {
	background-color:rgba(127, 140, 141,0.7);
}

.box{
	position:absolute;
	width:640px;
	height:640px;
	left:50%;
	margin-left:-320px;
	top:50%;
	margin-top:-320px;
	background-color:rgba(236, 240, 241,0.2);
	
}
h1,h2,p {
	text-align:center;
}
</style>
</head>
<body>
<div id="fullpage">
	<div class="section" id="section0">
		<div class="content">
			<div class="box">
				<h1>iCaptcha</h1>
				<p>It is Captcha Utility with php-gd, jquery, ajax</p>
				<h2>How to use ?</h2>
				<p>1. Download Source from git</p>
				<p>2. Upload source to your server</p>
				<p>3. import 'javascript' to your website or whatever</p>
				<p><strong>Don't change folder positioning</strong></p>
			</div>
		</div>
	</div>
	<div class="section" id="section1">
		<div class="content">
			<div class="box">
				<h1>iCaptcha - Example</h1>
				<center>
				<select id="languageSelector">
					<option value="ko">Korea</option>
					<option value="jp">Japanese</option>
					<option value="en">English</option>
				</select>
				</center>
				<div id="icaptcha"></div>
				<br>
				<pre  style="margin-left:25%;font-family:arial;font-size:12px;border:1px dashed #CCCCCC;width:50%;height:auto;overflow:auto;background:#f0f0f0;;background-image:URL(http://2.bp.blogspot.com/_z5ltvMQPaa8/SjJXr_U2YBI/AAAAAAAAAAM/46OqEP32CJ8/s320/codebg.gif);padding:0px;color:#000000;text-align:left;line-height:20px;"><code id="code" style="color:#000000;word-wrap:normal;"> $("#icaptcha").iCaptcha({  
           lang:'ko'  
 });  
</code></pre>
			</div>
		</div>
	</div>
	<div class="section" id="section2">
		<div class="content">
		3
		</div>
	</div>
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="src/assets/vendor/fullPageMaster/javascript.fullPage.js"></script>
<script src="src/jquery.icaptcha.js"></script>
<script type="text/javascript">
	fullpage.initialize('#fullpage', {
		anchors: ['Intro','Example','Contact'],
		menu: false,
		
		css3:true,
		fitToSection: true,
		continuousVertical: false
	});
	$("#icaptcha").iCaptcha({
		path: 'src',
		lang:'ko'
	});
	
	$('#languageSelector').change(function(){
		var langs = $("#languageSelector option:selected").val();
		$("#icaptcha").iCaptcha({
			path: 'src',
			lang:langs
		});
		$("#code").html(' $("#icaptcha").iCaptcha({ \n \
           lang:"'+langs+'" \n \
 });  \
');
	});
</script>



</body>
</html>