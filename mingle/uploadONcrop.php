<?php
require ($_SERVER['DOCUMENT_ROOT'].'/cropimagesign/config/db.php');
 
if(isset($_FILES['image']['tmp_name'])){
 
  $tmpFilePath = $_FILES['image']['tmp_name'];
  
  $time = date("d-m-Y")."-".time();
  $newfilename = $time.".jpg";
  $newFilePath = "./uploads/" .$newfilename;

  insertFiledata($newfilename);  

   // ye commented wali script bhi kaam kar rhi lekin file size bhut badi h jabki image ko recreate karne se jpg me hone ke vajah se file size kam ho ja rhi h
 /* 
  if(move_uploaded_file($tmpFilePath, $newFilePath)) {   // moving file to uploads folder
     
   // echo $newFilePath."||".filesize($newFilePath);
   list($width, $height) = getimagesize($newFilePath);
    
   echo "<img id='croppedImg'  name='image' src=$newFilePath alt=''>"."||".filesize($newFilePath)."||".$width."||".$height;

    }else{
    echo "error";
  }
  */
 

 $old_FilePath = $tmpFilePath;  // dot (.) is mandotary
  list($width, $height) = getimagesize($old_FilePath);
  
  $image_p = imagecreatetruecolor($width, $height);
  $image =imagecreatefromstring(file_get_contents($old_FilePath));
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
  imagejpeg($image_p, $newFilePath, 100);  // it convert $image_p url to jpeg,save, quality
  echo "<img id='croppedImg'  name='image' src=$newFilePath alt=''>"."||".filesize($newFilePath)."||".$width."||".$height;
  
}

function insertFiledata($filename){
  global $conn; 
 $sql="INSERT INTO `mingle`(`filename`) VALUES (?)";
  $stmt1= $conn->prepare($sql);
  $stmt1->bind_param('s',$filename);
  $stmt1->execute();
}


?>