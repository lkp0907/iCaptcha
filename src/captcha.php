<?php
 header('charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$idx = time();
$image;
$lang = 'ko';
$flag = 5;
$type = 1;

if(isset($_POST['type'])){
	$type = trim($_POST['type']);
}
if(isset($_POST['lang'])){
	$lang = trim($_POST['lang']);
}
if (isset($_POST["flag"])) { // flag 가 존재할경우 
    $input = trim($_POST["input"]);
    $flag = trim($_POST["flag"]);
	$idx = trim($_POST["idx"]);
}	
if ($flag == 1) { // input 값 넘어왔을때
	$captchId = "captcha_$idx";

    if ($input == $_SESSION[$captchId]) {
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
	global $idx;
	global $lang;
    global $image;
	global $type;
    $image = imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");
    $background_color = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 255, 255);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    $pixel_color = imagecolorallocate($image, 0, 0, 255);
    imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
	
	if($type==2 || $type==4){
		for ($i = 0; $i < 4; $i++) {
			imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
		}	
	}
	if($type==3 || $type==4){
		for ($i = 0; $i < 1000; $i++) {
			imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
		}	
	}
    
	$letters = array('가','나','다','라','마','바','사','아','자','차','타','카','타','파','하');
	if($lang == 'jp'){
		$letters = array('ぱ','ぴ','ぷ','ぺ','ぽ','が','ざ','だ','ば','ぎ','じ','ぢ','び','ぐ','ず','づ','ぶ','げ','ぜ','で','べ','ご','ぞ','ど','ぼ','あ','か','さ','た','な','は','ま','や','ら','わ','い','き','し','ち','に','ひ','み','り','う','く','す','つ','ぬ','ふ','む','ゆ','る','ん','え','け','せ','て','ね','へ','め','れ','お','こ','そ','と','の','ほ','も','よ','ろ','を');	
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
		$font = 'font/ARIALUNI.TTF'; 
		// Must Change Here !!!!
		
		imagettftext ($image , 24.0 ,0, 40 + ($i * 30), 35, $text_color, $font, $letter );
        $word .= $letter;
    }
    $_SESSION["captcha_$idx"] = $word;
    $images = glob("img/*.png");
    foreach ($images as $image_to_delete) {
        @unlink($image_to_delete);
    }
    imagepng($image, "img/image" .$idx. ".png");
	$return = array('img'=> "img/image" .$idx . ".png",'idx'=>$idx);
	echo json_encode($return);
}
?>