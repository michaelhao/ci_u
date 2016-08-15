<?php
if (!isset($_SESSION)) {
  session_start();
}


// Captcha options
$code = ''; // Set to code to default
$length = 4; // Default code is 4 digits and / or letters, you can do it with 5, 6 or more for more security
$imgwidth = 80; // Width of image
$imgheight = 35; // Height of image
$bgR = rand(0,255); $bgG = rand(0,255); $bgB = rand(0,255); // Random background color
$lR = rand(0,255); $lG = rand(0,255); $lB = rand(0,255); // Random color lines
$fontsize = 20; // Font size (default is 20)
$lines = 1; // Lines on image (default is 5)

// Random numbers from 0 to 9 and letters a to z (only small)
$code = substr(str_shuffle("0123456789"), 0, $length);

// Random only letters from a to z (only large)
#$code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

// Random only letters from a to z (only small)
#$code = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);

/*
// Random numbers
for ($counter = 0; $counter < $length; $counter++) {
   $code .= rand(0, 9);
}
*/

$_SESSION["code"] = $code; // Add captcha code to session

$img = imagecreatetruecolor($imgwidth, $imgheight); // Width and height of the image
$bgimg = imagecolorallocate($img, $bgR, $bgG, $bgB); // Backgound of image in RGB color code (random)
#$bgimg = imagecolorallocate($img, 255, 51, 102); // Salmon color (manually)
$fg = imagecolorallocate($img, 255, 255, 255); // Color of digits/numbers in RGB color code (white color)
imagefill($img, 0, 0, $bgimg);

// Fonts
$fonts=array("fonts/vintage.ttf","fonts/cicis-pizza-new.ttf", "fonts/Aerolite.ttf",); // Store fonts in array (name)
shuffle($fonts); // Get random font
imagettftext($img, $fontsize, 0, 7, 27, $fg, $fonts[0], $code); // 0 - angle, 7 - x, 27 - y, $fb - font color, $fonts[0] - random fonts, $code - here is code of captcha

// Draw lines
$linecolor = imagecolorallocate($img, $lR, $lG, $lB); // Color of lines
for($i=0; $i < $lines; $i++) { 
    imagesetthickness($img, rand(1,3));
    imageline($img, rand(0,160), 0, rand(0,160), 45, $linecolor);
}

header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');

imagepng($img); // Output a PNG image to either the browser or a file
imagedestroy($img); // Destroy an image
?>