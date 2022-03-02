<?php
require ($_SERVER['DOCUMENT_ROOT'].'/cropimagesign/config/db.php');
 
if(isset($_FILES['image']['tmp_name'])){
 
  $tmpFilePath = $_FILES['image']['tmp_name'];
  

  //$filename = $_FILES['video_file']['name'];
  //$ext = pathinfo($filename, PATHINFO_EXTENSION);

  $oldfiletype = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);

  $time = date("d-m-Y")."-".time();
  $newfilename = $time.'.'.$oldfiletype;

  $newFilePath = "./uploads/" .$newfilename;

  insertFiledata($newfilename);  

   // ye commented wali script bhi kaam kar rhi lekin file size bhut badi h jabki image ko recreate karne se jpg me hone ke vajah se file size kam ho ja rhi h
 
  if(move_uploaded_file($tmpFilePath, $newFilePath)) {   // moving file to uploads folder
     
    
   echo $newFilePath."||"."success";

    }else{
    echo "error";
  }

}
else{
    echo "error";
}

function insertFiledata($filename){
  global $conn; 
 $sql="INSERT INTO `convertimage`(`filename`) VALUES (?)";
  $stmt1= $conn->prepare($sql);
  $stmt1->bind_param('s',$filename);
  $stmt1->execute();
}


?>