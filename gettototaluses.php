<?php
require ($_SERVER['DOCUMENT_ROOT'].'/cropimagesign/config/db.php');
 
if(isset($_POST['totalcount'])){

   $total = getCountCompressImages() + getCountCropImage()+getCountMingle()+getCountResizeWH() + getConvertCount();

   echo $total;

}

if(isset($_POST['compresscount'])){

    $total = getCountCompressImages(); 
    echo $total;

 }
 if(isset($_POST['cropcount'])){

    $total = getCountCropImage(); 
    echo $total;

 }

 if(isset($_POST['resizewhcount'])){

    $total = getCountResizeWH();
    echo $total;

 }
 
 if(isset($_POST['minglecount'])){

    $total = getCountMingle();
    echo $total;

 }

 
 if(isset($_POST['convertcount'])){

   $total =  getConvertCount();
   echo $total;

}

function getCountCompressImages(){
    global $conn; 
    $result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `compressimages`");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
     return $count;
}
function getCountCropImage(){
    global $conn; 
    $result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `cropimage`");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
     return $count;
}
function getCountMingle(){
    global $conn; 
    $result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `mingle`");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
     return $count;
}
function getCountResizeWH(){
    global $conn; 
    $result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `resizewh`");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
     return $count;
}

function getConvertCount(){

   global $conn; 
     $result = mysqli_query($conn,"SELECT COUNT(*) AS `count` FROM `convertimage`");
     $row = mysqli_fetch_assoc($result);
     $count = $row['count'];
   return $count;

}

?>