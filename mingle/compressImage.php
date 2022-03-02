<?php

$filename = basename($_POST['filepath']);  // it may contains times stamp at end of url so we have to remove it
$quality = $_POST['quality'];
$filePath = './uploads/'.$filename;  // dot (.) is mandotary

$image =imagecreatefromstring(file_get_contents($filePath));

imagejpeg($image, './uploads/'.$filename, $quality);  // it convert $image_p url to jpeg,save, quality

list($width, $height) = getimagesize($filePath);

echo $filePath."||".filesize($filePath)."||".$width."||".$height;

?>