<?php

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
   elseif($info['mime'] == 'image/webp')
     $image = imagecreatefromwebp($source);
    else
    return false;

    imagejpeg($image, $destination, $quality);
    
    return true;
    //return $destination;
}


if(isset($_POST['filepath'])){

$filename = basename($_POST['filepath']);  // it may contains times stamp at end of url so we have to remove it
$quality = $_POST['quality'];
$filePath = './uploads/'.$filename;  // dot (.) is mandotary

//$image =imagecreatefromstring(file_get_contents($filePath));

$time = date("d-m-Y")."-".time();
$newfilename = $time.".jpg";
$newFilePath = "./uploads/" .$newfilename;

//imagejpeg($image, $newFilePath, $quality);  // it convert $image url to jpeg,save, quality
$res = compress($filePath,$newFilePath,$quality);   
if($res == true)
{echo $newFilePath."||".filesize($newFilePath);}
else{
    echo "error||";  // slpit("||")[0]  will be error in ajax response
}

}



?>