<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class captcha{
	
	
		public static function toCode($reloadCount){
				
			$fingerprint = fingerPrint();

			(string)$encryptData = str_replace([
			"+", "-", "/"		
			], null, md5($reloadCount.''.$fingerprint));		
			$encryptData = strtoupper($encryptData);
			$encryptData = substr($encryptData ,15,4);
		
			return (string)$encryptData;
		//	return $reloadCount;

			
		}
		
		
		
		public static function ViewCode(){
			
			return self::toCode(($_SESSION['reloadCount'] + 1));
					
		}
		
		public static function PostCode(){
			
			return self::toCode($_SESSION['reloadCount']);
			
		}

		
		public static function captchaGet(){				
		
			$ViewEngine = new ViewEngine();			
			return $ViewEngine->view("static/captcha", [
			"captchaPlaceholder" => __("captchaPlaceholder", "Güvenlik Kodunu Giriniz."),
			"captchaCode" => self::captchaCode(),
			"viewRand" => rand(11111,99999),
			]);
			
		}

		public static function captchaCode(){
			
			return md5($_SESSION['reloadCount'].''.fingerPrint());			
			
		}		

	
}


		Route::run('/captchaReload', function () {
			hookSystem::add_action("index", function(){
				immunity(true);
				FormTokenSecure::reloadCount();
				return json_encode(["status" => true]);

			});
		});
		
		
		Route::run('/captchaRefresh', function () {
			immunity(true);
			hookSystem::add_action("index", function(){
				
					return json_encode(["code" => captcha::captchaCode()]);			

			});
		});
		
		Route::run('/captcha.js', function () {
			immunity(true);
			hookSystem::add_action("index", function(){					
					header('Content-Type: application/javascript');
					$ViewEngine = new ViewEngine();	
					return $ViewEngine->view("static/captchascript", []);

			});
		});

		Route::run('/viewCode', function () {
			immunity(true);
			hookSystem::add_action("index", function(){				
				if(developerMode == true){
					header('Content-Type: application/javascript');					
					return json_encode(["viewCode" => captcha::ViewCode()]);
				}
			});
		});

	
		Route::run('/captcha.jpg', function () {
			immunity(true);
			hookSystem::add_action("index", function(){
				
				function imageWave($img, $width, $height, $period = 10, $amplitude = 5) {
					$p = $period * rand(1, 3);
					$k = mt_rand(0, 100);
					for ($i = 0; $i<$width; $i++) {
						imagecopy($img, $img, $i-1, sin($k+$i/$p) * $amplitude, $i, 0, 1, $height);
					}
					$k = mt_rand(0,100);
					for ($i = 0; $i<$height; $i++) {
						imagecopy($img, $img, sin($k+$i/$p) * $amplitude, $i-1, 0, $i, $width, 1);
					}
					return $img;
				}
			
			
			header('Content-type: image/png');
								
				$image = imagecreatetruecolor(200, 50);

				imageantialias($image, true);

				$colors = [];

				$red = rand(125, 175);
				$green = rand(125, 175);
				$blue = rand(125, 175);

				for($i = 0; $i < 5; $i++) {
				  $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
				}

				imagefill($image, 0, 0, $colors[0]);

				for($i = 0; $i < (captchaDifficultyLevel / 5); $i++) {
				  imagesetthickness($image, rand(2, 10));
				  $rect_color = $colors[rand(1, 4)];
				  imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
				}
				
				$black = imagecolorallocate($image, 0, 0, 0);
				$white = imagecolorallocate($image, 255, 255, 255);
				$textcolors = [$black, $white];

			
				$fonts = glob(homepath.'/bitnameagencyframework/src/fonts/captcha/*.ttf');


				$string_length = 4;
				$captcha_string = captcha::ViewCode();
				
		

				for($i = 0; $i < $string_length; $i++) {
				  $letter_space = 170/$string_length;
				  $initial = 20;
				  
				@imagettftext($image, 35, rand(-15, 15), $initial + $i*$letter_space, rand(30, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);

				}
				
				
				for($i = 0; $i < 5; $i++) {
				  $colors[] = imagecolortransparent($image, imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i));
				}
				
				for($i = 0; $i < (captchaDifficultyLevel / 5); $i++) {
				  imagesetthickness($image, 1.5);
				  $rect_color = $colors[rand(1, 4)];
				  imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
				}				
				

				
				for ($i = 0; $i < captchaDifficultyLevel; $i++) {					
				$line_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
				imageline($image, rand(0, 5) * 100, rand(0, 100), rand(0, 100) * 0, rand(1,50), $line_color);
				}
				
			

				imageWave($image, imagesx($image), imagesy($image));
				
				//imagefilter($image,IMG_FILTER_GRAYSCALE);
				//imagefilter($image,IMG_FILTER_COLORIZE, 100,50,0,0);

				imagepng($image);
				imagedestroy($image);
							
			
			
			});
		});
