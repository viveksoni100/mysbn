<?
$tmp_name = $_FILES["img"]["tmp_name"];
$t = $_FILES["img"]["name"];
$imageFileType = pathinfo($t,PATHINFO_EXTENSION);
$name = basename($_FILES["img"]["name"]);
$img_url = "img_pro_pic/".basename($_FILES["img"]["name"]);
if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif"){
	move_uploaded_file($tmp_name, "/img_pro_pic/$name");
	move_uploaded_file($tmp_name1, "/img_pro_pic/$name1");
}
?>
<HTML>
<body>
	<input type="file" name="img" id="inputfile">
</body>
</HTML>