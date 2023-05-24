<?php
header('Access-Control-Allow-Origin: *');

$pStudent = $_GET['student'];
$pTeacher = $_GET['teacher'];
$pCourse = $_GET['course'];
$pDate = $_GET['date'];


//Para los diplomas
$imgPath = 'diploma.jpg';
$image = imagecreatefromjpeg($imgPath);
$color = imagecolorallocate($image, 0, 0, 0);
$dir = dirname(realpath(__FILE__));
$resp = DIRECTORY_SEPARATOR;
$fontFamily = $dir.$resp.'fonts'.$resp.'static'.$resp.'Nunito-Black.ttf';
$fontSize = 36;
$fontSize2 = 24;
$student = $pStudent;
$date= $pDate;
$teacher = $pTeacher;
$course = $pCourse;
$width = imagesx($image);
$height = imagesy($image);
$centerX = $width / 2;
$centerY = $height / 2;
list($left, $bottom, $right, , ,$top) = imageftbbox($fontSize, 0, $fontFamily, $student);
list($left2, $bottom2, $right2, , ,$top2) = imageftbbox($fontSize2, 0, $fontFamily, $date);
list($left3, $bottom3, $right3, , ,$top3) = imageftbbox($fontSize2, 0, $fontFamily, $teacher);
list($left4, $bottom4, $right4, , ,$top4) = imageftbbox($fontSize2, 0, $fontFamily, $course);

//Determine offset of text
$left_offset = ($right - $left) / 2;
$top_offset = ($bottom - $top) / 2;

$left_offset2 = ($right2 - $left2) / 2;
$top_offset2 = ($bottom2 - $top2) / 2;

$left_offset3 = ($right3 - $left3) / 2;
$top_offset3 = ($bottom3 - $top3) / 2;

$left_offset4 = ($right4 - $left4) / 2;
$top_offset4 = 16.5;
// Generate coordinates
$x = $centerX - $left_offset;
$y = $centerY + $top_offset;

$xCourse = $centerX - $left_offset4;
$yCourse = $centerY + ($top_offset4 * 4);

$xdate = ($left_offset2) + 425;
$ydate = ($height - $top_offset2)-250;

$xTeacher = ($width - $left_offset3) - 600;
$yTeacher = ($height - $top_offset3)-250;
imagettftext($image, $fontSize, 0,$x, $y, $color, $fontFamily,$student);
imagettftext($image, $fontSize2, 0,$xdate, $ydate, $color, $fontFamily,$date);
imagettftext($image, $fontSize2, 0,$xTeacher, $yTeacher, $color, $fontFamily,$teacher);
imagettftext($image, $fontSize2, 0,$xCourse, $yCourse, $color, $fontFamily,$course);
imagejpeg($image, 'diploma2.jpg', 100);
$imageContent = file_get_contents('diploma2.jpg');
header("Content-type: image/jpeg");
echo $imageContent;