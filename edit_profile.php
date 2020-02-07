<?
include ("classes/initial.php");
include ("classes/config.inc.php");
include ("classes/Database.class.php");
include ("classes/functions.php");
include ("classes/Session.class.php");
$sitesession = new Session();
$sitesession->Session();

$link = mysqli_connect("127.0.0.1", "root", "", "sbn_db");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
} /*echo "done done london...";*/

$qr_last_name = "SELECT LastName FROM members WHERE Mobile=".$_SESSION['SESSIONMOBILE']."";
if ($result = $link->query($qr_last_name)) {
  while ($row = $result->fetch_row()) {
        $memberLastName = $row[0];
  }
  /*echo "$memberLastName";*/
  $result->free_result();
}

$link->close();
        /*echo "connection close bhai...";*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:description" content="Create your SBN Account for Free!">
    <meta name="description" content="Create your SBN Account for Free!">
    <title>Edit your profile : SBN</title>
    <? include("includes/style.php"); ?>
  </head>
  <!-- fiddle try -->
  <!-- jsfiddle apikey : AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk -->
  <!-- Vivek apikey : AIzaSyBnzedToDdeq9Ax0F2DyjmUsxyG0GdeLF0 -->
  <!-- Hardik apikey : AIzaSyBy43cdR8Qwzawh762nRG3SozbNBP5R5HI -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnzedToDdeq9Ax0F2DyjmUsxyG0GdeLF0&libraries=places&callback=initAutocomplete"
        async defer></script>

        <!-- ajax and jquery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

var placeSearch, autocomplete;
var locationString;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function submitBTNClicked(){

  validationCheck();
  console.log("validation are fulfilled...");
  storingRecordInDB();

  alert("Your record has been saved.");
    
    window.location.href="http://localhost/mysbn/dashboard.php?SuccessID=";

}//submitBTNClickedEnds

function storingRecordInDB(){

  console.log("storing record...");

  var first_name = document.getElementById("firstName");
  var last_name = document.getElementById("lastName");
  var mobile = document.getElementById("mobileNumber");
  var email_id = document.getElementById("email");
  var location_detail = document.getElementById("autocomplete");
  var city = document.getElementById("locality");
  var state = document.getElementById("administrative_area_level_1"); //
  var country_code = document.getElementById("country");  //
  
  var file_upload_field = document.getElementById("fileToUpload");
  var strFileUpload = file_upload_field.value + "";
  var strFileUploadArr = strFileUpload.split("\\");
  var path = "/profilepics/" + strFileUploadArr[2];

  var occupation_detail = document.getElementById("occupation");
  var headline_detail = document.getElementById("headline");

/*  console.log(first_name.value + last_name.value + mobile.value + email_id.value + location_detail.value +
    city.value + state.value + country_code.value + path + occupation_detail.value + headline_detail.value
    );*/

  var dataItems = "firstName="+first_name.value+"&lastName="+last_name.value+
    "&mobileNumber="+mobile.value+"&email="+email_id.value+"&autocomplete="+location_detail.value+
    "&locality="+city.value+"&administrative_area_level_1="+state.value+"&country="+country_code.value+
    "&fileToUpload="+path+"&occupation="+occupation_detail.value+"&headline="+headline_detail.value;

    console.log(dataItems);

    storingRecordInDBAJAX(dataItems);

}// storingRecordInDB

function storingRecordInDBAJAX(dataItems){

  console.log("go ahead...");
  console.log(dataItems);

$(document).ready(function() {
    console.log("document ready...");
    $.ajax({
    type: "POST",
    url: "savingRecord.php",
    data: dataItems,
      success: function(data) {
        console.log("success");
      },
      error: function(){
        console.log("work harder...");
      }
  });
});

}//storingRecordInDBAJAXEnds

function validationCheck(){

  console.log("in validationCheck");

  validateOccupation();
  //validateHeadline();
  validateEmail();
  validateLocation();
  validateFileToUpload();

}//validationCheckEnds

function validateFileToUpload(){
  var file_upload_button = document.getElementById("fileToUpload");
  if(file_upload_button.value == ""){
    alert("Please select your profile picture");
  } else {
    // alert(document.getElementById("uploadForm"));
    document.getElementById("submit").click();
    console.log("submit button click thyu bhai...");
  }
}



function validateLocation(){
  var locationTextBox = document.getElementById("autocomplete");
  if(locationTextBox.value == ""){
    alert("Please enter your location");
  }
}

function validateEmail(){

  var emailTextBox = document.getElementById("email");
    if(!emailTextBox.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
      alert("Please enter valid email address");
    }

}//validateEmail

function validateHeadline(){

  var headlineTextBox = document.getElementById("headline");
    if (headlineTextBox.value == "") {
    alert("Please give yourself a headline");
  } else if (!headlineTextBox.value.match(/^[A-Za-z]+$/)) {
    alert("Please enter only characters for headlines");
  }

}//validateHeadline

function validateOccupation(){

  var validateSelectedOption = document.getElementById("occupation");
    if (validateSelectedOption.selectedIndex == "") {
    alert("Please select occupation");
  }

}//validateOccupation

function fillStateCityCountry() {

  locationString = document.getElementById('autocomplete').value;

  var locationArr = locationString.split(',').map(function(item){
   return item.trim(); 
  });
  var lastIndex = locationArr.length - 1;
  var country = locationArr[lastIndex];
  var state = locationArr[lastIndex-1];
  var city = locationArr[lastIndex-2];
  
  document.getElementById('locality').value = city;
  document.getElementById('administrative_area_level_1').value = state;
  document.getElementById('country').value = country;

}//fillStateCityCountryEnds

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}//initAutocompleteEnds

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}//fillInAddressEnds

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {

  autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('autocomplete'), {types: ['geocode']});

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
        autocomplete.setBounds(circle.getBounds());
    });
  }
}//geolocateEnds
</script>
<script type="text/javascript">

  $(document).ready(function (e){
  $("#uploadForm").on('submit',(function(e){
    console.log("image mate button submit click thyu...");
    e.preventDefault();
    $.ajax({
    url: "upload.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      $("#targetLayer").html(data);
      console.log("image uploaded...");
    },
    error: function(){console.log("work harder...");}           
    });
  }));
});
  
</script>

  <body>
    <? include("includes/header.php"); ?>
    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
              
              <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Profile Info</a>
                  </li>
                  <li class="nav-item">
                    <!-- <a class="nav-link" href="#">Link</a> -->
                  </li>
                  <li class="nav-item">
                    <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" align="left"><label>First Name</label></th>
                      <th scope="col">
                        <input type="text" name="fistName" id="firstName" class="form-control" placeholder="Enter your first name" value="<?=$_SESSION['SESSIONNAME']?>" required>
                      </th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Last Name</label></th>
                      <th scope="col"><input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter your last name" value="<? echo $memberLastName ?>" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Mobile</label></th>
                      <th scope="col"><input type="text" name="mobileNumber" id="mobileNumber" class="form-control" placeholder="Enter your moblie number" minlength="10" maxlength="10" value="<?=$_SESSION['SESSIONMOBILE']?>" required></th>
                      <th scope="col"><label for="verified">Verified</label></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Email</label></th>
                      <th scope="col"><input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email address" value="" required></th>
                      <th scope="col"><label for="forVerification">Click to Verify</label></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Location</label></th>
                      <th scope="col"><input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Location" onFocus="geolocate()" onfocusout="fillStateCityCountry()" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>City</label></th>
                      <th scope="col"><input name="locality" id="locality" class="form-control" placeholder="City" disabled="true"></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>State</label></th>
                      <th scope="col"><input name="administrative_area_level_1" id="administrative_area_level_1" class="form-control" placeholder="State" disabled="true"></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Country</label></th>
                      <th scope="col"><input name="country" id="country" class="form-control" placeholder="Country" disabled="true"></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col">Profile Pic</th>
                      <th scope="col">

                        <form action="upload.php"  id="uploadForm" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" style="visibility:hidden;" id="submit" class="btn btn-primary" value="Upload Image" name="submit">
                        <!-- <input type="file" name="inputfile" id="inputfile"> -->
                        
                      </th>
                      <th scope="col">
                        <div id="targetLayer">
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                    </tr>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col">Occupation</th>
                      <th scope="col"> <select name="occupation" id="occupation" style="width: 350px">
                                          <option value="empty"></option>
                                          <option value="BusinessOwner">Business Owner</option>
                                          <option value="Employee">Employee</option>
                                          <option value="Freelancer">Freelancer</option>
                                          <option value="Other">Other</option>
                      </select> </th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                    </tr>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Headline</label></th>
                      <th scope="col"><input type="text" name="headline" id="headline" class="form-control" placeholder="Enter your title : i.e - Software Developer" value="" required=""></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                      <th scope="col" style="border-bottom: 1px solid  #a1b5c0;"></th>
                    </tr>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  </table>

                <a href="#" class="btn btn-primary" onclick="submitBTNClicked()">Submit Form</a>
              </div>
              </div>

          <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
              <!-- <img src="assets/img/sbn_logo.jpg" class="img-fluid" alt=""> -->
            </div>
           
          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <? include("includes/footer.php"); ?>
    <? include("includes/footer-js.php"); ?>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>        
        $(document).ready(function() {
            $("#sbnform").validate({
                rules: {
                    Mobile: {
                    required: true,
                    number: true
                    }
                }
            });
        });      
    </script>    
  </body>
</html>
