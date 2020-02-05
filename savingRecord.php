<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "sbn_db");

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

//WORKING
$sql = "UPDATE `members` SET `FirstName`='$FirstName',`LastName`='$LastName',`Mobile`='$Mobile',`Email`='$Email',`Location`='$Location',`State`='$State',`City`='$City',`Country`='$Country',`Profile_picture_path`='$Profile_picture_path',`Occupation`='$Occupation',`Headline`='$Headline' WHERE `Mobile`='$Mobile'";

if ($conn->query($sql) === TRUE) {
    echo "Worked";
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

?>