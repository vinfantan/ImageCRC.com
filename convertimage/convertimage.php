<?php
require ($_SERVER['DOCUMENT_ROOT'].'/cropimagesign/config/db.php');
 
if(isset($_POST['filepath'])){
 
  $oldFilePath = $_POST['filepath'];
  $newEx = $_POST['imagetype'];
  
  $oldfilename = basename($oldFilePath);

  $only_name = pathinfo($oldfilename, PATHINFO_FILENAME);
  $oldFilePath = './uploads/'.$oldfilename;

  $newFilePath  = './uploads/'.$only_name;  
  $newFilePath = getconvertedimage($oldFilePath,$newFilePath,$newEx);

  if($newFilePath == "error")
 {
      echo "error";
 }
  else{
  echo $newFilePath."||"."success";
  }
  
}
else{
    echo "error";
}

function getconvertedimage($filename,$newFilePath,$newEx){
         
         $oldEx = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

         switch(exif_imagetype($filename)){
             case IMAGETYPE_JPEG:
                 if($newEx == 'jpg' || $newEx == 'jpeg')
                 {
                  return $filename;
                 }
                $image = imagecreatefromjpeg($filename);
                break;
             case IMAGETYPE_GIF:
                if($newEx == 'gif')
                 {
                    return $filename;
                 }
                $image = imagecreatefromgif($filename);
                break;
             case IMAGETYPE_PNG: 
                if($newEx == 'png')
                 {
                    return $filename;
                 }
                $image = imagecreatefrompng($filename);
                break;
            case IMAGETYPE_WEBP: 
               if($newEx == 'webp')
                  {
                     return $filename;
                  }
               $image = imagecreatefromwebp($filename);
               break;
            default:
                 return "error";
         }

        if($newEx == 'jpg' || $newEx == 'jpeg')  // since download karte time extention javascript me laga de rhe h isliye yha jpeg ke liye bhi jpg hi laga dete
         {
            $newFilePath = $newFilePath.'.jpg';
            $newImage = imagejpeg($image,$newFilePath,9);            
         }
         else if($newEx == 'png')
         {
             $newFilePath = $newFilePath.'.png';
             $newImage = imagepng($image,$newFilePath,9);
         }
         else if($newEx == 'gif')
         {
            $newFilePath = $newFilePath.'.gif';
            $newImage = imagegif($image,$newFilePath,9);
         }
         else if($newEx == 'webp')
         {
            $newFilePath = $newFilePath.'.webp';
            
            if($oldEx == "gif")                  // it is a special case when convert from gif to  webp    we have to perform this below operation
            imagepalettetotruecolor($image);
            
            $newImage = imagewebp($image,$newFilePath,9);
         }
         else{
             return "error";
         }
         return $newFilePath;
         
}

?>