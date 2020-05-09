<?php

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);

 $FirstName=$_POST['firstName'];
 $LastName=$_POST['lastName'];
 $Mobile=$_POST['mobileNumber'];
 $Email=$_POST['email'];
 $Location=$_POST['autocomplete'];
 $City=$_POST['locality'];
 $State=$_POST['administrative_area_level_1'];
 $Country=$_POST['country'];
 $Profile_picture_path=$_POST['fileToUpload'];
 $Occupation=$_POST['occupation'];
 $Headline=$_POST['headline'];
 $Facebook=$_POST['facebook'];
 $Twitter=$_POST['twitter'];
 $LinkedIn=$_POST['linkedin'];
 $WhatsApp=$_POST['whatsapp'];
 $Instagram=$_POST['instagram'];
 $Youtube=$_POST['youtube'];

//WORKING
$sql = "UPDATE `members` SET `FirstName`='$FirstName',`LastName`='$LastName',`Mobile`='$Mobile',`Email`='$Email',`Location`='$Location',`State`='$State',`City`='$City',`Country`='$Country',`Profile_picture_path`='$Profile_picture_path',`Occupation`='$Occupation',`Headline`='$Headline',`facebook`='$Facebook',`twitter`='$Twitter',`linkedin`='$LinkedIn',`whatsapp`='$WhatsApp',`instagram`='$Instagram',`youtube`='$Youtube' WHERE `Mobile`='$Mobile'";

if ($conn->query($sql) === TRUE) {
    echo "Worked";
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

?>