//this code is only being use in mingle.html (when user click on cropBTN) beacuse cropped image size(blob) is totally depends on width and height 
// 
// width and height should be always in pixels   

function isSizeAllow(width,height){
 
    var size = width * height

    size = (size /1024) / 1024

    if(size < 10)    // (here 10 MB taken ) it depends on PHP server allowed upload_max_filesize  AND post_max_size  
    return true                             // But when click on resize btn we don't know what would be resized filesize so I did not use for that.
    else
    return false;


}