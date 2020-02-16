<?php
$types = array("jpeg"=>IMG_JPG, "jpg"=>IMG_JPG, "gif"=>IMG_GIF, "png"=>IMG_PNG );
function getImageType($name)
{
  global $types;
  
  $way = pathinfo($name);
  $ext = strtolower($way['extension']);
  $t = $types[$ext];
  return $t;  
}
function resize_center($thumbh,$thumbw,$oldname,$thumb_image_path,$newname)
{
  $nh = $thumbh;
  $nw = $thumbw;
  $xoff = 0;
  $yoff = 0;
  $size = getImageSize($oldname);
  $w = $size[0];
  $h = $size[1];
 
  $ratio = $h / $w;
  $nratio = $thumbh / $thumbw; 

  if($ratio > $nratio)
  {
    $x = intval($w * $nh / $h);
    if ($x < $nw)
    {
      $nh = intval($h * $nw / $w);
    } 
    else
    {
      $nw = $x;
    }
    $yoff = intval(($nh - $thumbh) / 2); 
  }
  else
  {
    $x = intval($h * $nw / $w);
    if ($x < $nh)
    {
      $nw = intval($w * $nh / $h);
    } 
    else
    {
      $nh = $x;
    }
    $xoff = intval(($nw - $thumbw) / 2);
  }  
 
  //echo "done";

  $t = getImageType($oldname); 

  switch($t)
  {
    case IMG_JPG: $resimage = imagecreatefromjpeg($oldname);
                  break;
    case IMG_GIF: $resimage = imagecreatefromgif($oldname);
                  break;
    case IMG_PNG: $resimage = imagecreatefrompng($oldname);
                  break;                  
  }  
  $newimage = imagecreatetruecolor($nw, $nh);  
  imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h); 
  $viewimage = imagecreatetruecolor($thumbw, $thumbh);
  imagecopy($viewimage, $newimage, 0, 0, $xoff, $yoff, $nw, $nh);  
  imageJpeg($viewimage, $thumb_image_path.$newname, 85);
}  
?>
