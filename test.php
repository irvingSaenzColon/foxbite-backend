<?php
header('Access-Control-Allow-Origin: *');
/*
$filename = uniqid("FILE-", true);
$filePath = './files/documents/'.$filename;
$src = fopen($file, 'r');
$trg = fopen($filePath, 'w');
stream_filter_append($src, 'convert.base64-decode');
stream_copy_to_stream($src, $trg);
fclose($src);
fclose($trg);
*/

//Para los diplomas
/*
header("Content-type: image/jpeg");
$imgPath = 'image.jpg';
$image = imagecreatefromjpeg($imgPath);
$color = imagecolorallocate($image, 255, 255, 255);
$string = "http://recentsolutions.net";
$fontSize = 3;
$x = 115;
$y = 185;
imagestring($image, $fontSize, $x, $y, $string, $color);
imagejpeg($image);
*/