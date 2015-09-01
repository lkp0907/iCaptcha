<?php
 header('charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$_SESSION['count'] = time();
$image;
$lang = 'ko';
$flag = 5;

if(isset($_POST['lang'])){
	$lang = $_POST['lang'];
}
if (isset($_POST["flag"])) { // flag 가 존재할경우 
    $input = $_POST["input"];
    $flag = $_POST["flag"];
}	
if ($flag == 1) { // input 값 넘어왔을때
	
    if ($input == $_SESSION['captcha_string']) {
		// 성공
		echo json_encode(array('error'=>'0'));
    } else {
        // 에러
        echo json_encode(array('error'=>'1'));
    }
} else {
	// 처음 시작
    create_image();
   
}

function  create_image()
{
	global $lang;
    global $image;
    $image = imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");
    $background_color = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 255, 255);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    $pixel_color = imagecolorallocate($image, 0, 0, 255);
    imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
    for ($i = 0; $i < 3; $i++) {
        imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
    }
    for ($i = 0; $i < 1000; $i++) {
        imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
    }
	//$letters = 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやゆよわをん';
    //$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$letters = array('가','나','다','라','마','바','사','아','자','차','타','카','타','파','하');
	if($lang == 'jp'){
		$letters = array('あ','い','う','え','お','か','き','く','け','こ','さ','し','す','せ','そ','た','ち','つ','て','と','な','に','ぬ','ね','の','は','ひ','ふ','へ','ほ','ま','み','む','め','も','や','ゆ','よ','わ','を','ん');	
	}
	else if($lang == 'en'){
		$letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	}
	
    $len = count($letters);
    $letter = $letters[rand(0, $len - 1)];

    $text_color = imagecolorallocate($image, 0, 0, 0);
    $word = "";
    for ($i = 0; $i < 4; $i++) {
        $letter = $letters[rand(0, $len - 1)];
        
		// Change Here !!!!
		$font = '/home/devsfolder/iCaptcha/src/font/ARIALUNI.TTF'; 
		// Must Change Here !!!!
		
		imagettftext ($image , 24.0 ,0, 40 + ($i * 30), 35, $text_color, $font, $letter );
        $word .= $letter;
    }
    $_SESSION['captcha_string'] = $word;
    $images = glob("*.png");
    foreach ($images as $image_to_delete) {
        @unlink($image_to_delete);
    }
    imagepng($image, "img/image" . $_SESSION['count'] . ".png");
	$return = array('img'=> "img/image" . $_SESSION['count'] . ".png" );
	echo json_encode($return);
}
?>