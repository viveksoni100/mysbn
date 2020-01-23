<?
function createThumbs( $image, $thumbpath, $thumbsize ) {
	if ($image=="") return "Image Missing";
	if ($thumbpath=="") $thumbpath="thumb/";
	if ($thumbsize=="") $thumbsize=200;
	list($width, $height) = getimagesize($image);
	$myImage = imagecreatefromjpeg($image);
	if ($width > $height) {
	  $y = 0;
	  $x = ($width - $height) / 2;
	  $smallestSide = $height;
	} else {
	  $x = 0;
	  $y = ($height - $width) / 2;
	  $smallestSide = $width;
	}
	$thumbSize = $thumbsize;
	$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
	imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

	
	$length=20;
	$randstring = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);


    $newimagename = $randstring.".jpg";
	imagejpeg($thumb, $thumbpath. $newimagename);
	return $newimagename;
}
?>