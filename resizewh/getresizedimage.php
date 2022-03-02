<?php


function getImage($source) {

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

  return $image;
  //return $destination;
}

if(isset($_POST['filepath'])){
  $new_width = $_POST['width'];
  $new_height = $_POST['height'];
 // echo $new_height."".$new_width;
  //$filename = $_FILES['image']['tmp_name'];
 
  $filename = basename($_POST['filepath']);  // it may contains times stamp at end of url so we have to remove it

  

$old_FilePath = './uploads/'.$filename;  // dot (.) is mandotary
list($width, $height) = getimagesize($old_FilePath);

$image_p = imagecreatetruecolor($new_width, $new_height);


//$image = imagecreatefromstring(file_get_contents($old_FilePath)); // i used it but now switch to below line
$image  = getImage($old_FilePath);
if($image === false)
{
 echo "error||";  // slpit("||")[0]  will be error in ajax response
}
else{


imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);



imagejpeg($image_p, './uploads/'.$filename, 100);  // it convert $image_p url to jpeg,save, quality


//echo "<img id='croppedImg'  name='image' src='$old_FilePath' alt=''>";
echo $old_FilePath."||".$new_width."||".$new_height;
}

}


?>