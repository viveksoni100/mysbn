<?
$tmp_name = $_FILES['img']["tmp_name"];
$t = $_FILES['img']["name"];
$imageFileType = pathinfo($t,PATHINFO_EXTENSION);
$name = basename($_FILES['img']["name"]);
$img_url = "img_pro_pic/".basename($_FILES['img']["name"]);

if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif"){
        if(move_uploaded_file($tmp_name, "$uploads_dir/$name") && move_uploaded_file($tmp_name1, "$uploads_dir/$name1")){
            $sql1 = "INSERT INTO `Driver`(`DriverId`, `Name`, `ImgUrl`, `DocumentsUrl`, `Contact`, `TransId`) VALUES ($did,'$fname','$img_url','$img_url1',$contact,$did)";
            if(mysqli_query($con,$sql1)){
                echo "<script> alert('Driver Added!'); </script>";
                echo '<script type="text/javascript"> window.location = "/admin/driver.php" </script>';
            }   
        }
        else{
            echo "nahi hua";
        }
    }
?>