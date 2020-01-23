<?
include ("classes/initial.php");
include ("classes/config.inc.php");
include ("classes/Database.class.php");
include ("classes/functions.php");
include ("classes/Session.class.php");
$sitesession = new Session();
$sitesession->Session();

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
  <!-- try 2.0 -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBnzedToDdeq9Ax0F2DyjmUsxyG0GdeLF0"></script>
  <script type="text/javascript">
    function initialize() {
      var input = document.getElementById('location');
      var options = {
        types: ['address'],
        // componentRestrictions: {
        //   country: 'us'
        // }
      };
      autocomplete = new google.maps.places.Autocomplete(input, options);
      autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          var place = autocomplete.getPlace();
          for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++) {
              if (place.address_components[i].types[j] == "postal_code") {
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
              }
            }
          }
        })
      }//initializeEnds
      google.maps.event.addDomListener(window, "load", initialize);
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
                        <input type="text" name="fistName" id="fistName" class="form-control" placeholder="Enter your first name" value="" required>
                      </th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Last Name</label></th>
                      <th scope="col"><input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter your last name" value="" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Mobile</label></th>
                      <th scope="col"><input type="text" name="mobileNumber" id="mobileNumber" class="form-control" placeholder="Enter your moblie number" minlength="10" maxlength="10" value="" required></th>
                      <th scope="col"><label for="verified">Verified</label></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Email</label></th>
                      <th scope="col"><input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email address" value="" required></th>
                      <th scope="col"><label for="forVerification">Click to Verify</label></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>Location</label></th>
                      <th scope="col"><input type="text" name="location" id="location" class="form-control" placeholder="Location" value="" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>State</label></th>
                      <th scope="col"><input type="text" name="state" id="state" class="form-control" placeholder="State" value="" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col"><label>City</label></th>
                      <th scope="col"><input type="text" name="city" id="city" class="form-control" placeholder="City" value="" required></th>
                      <th scope="col"></th>
                    </tr>
                    <tr>
                      <th scope="col">Profile Picture</th>
                      <th scope="col"><input type="file" name="profilePicture" id="profilePicture" style="width: 250px"></th>
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
                      <th scope="col">Occupation</th>
                      <th scope="col"> <select name="occupation" id="occupation" style="width: 250px">
                                          <option value=""></option>
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
                      <th scope="col"><input type="text" name="headline" id="headline" class="form-control" placeholder="Enter your title" value="" required></th>
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

                <a href="#" class="btn btn-primary">Submit</a>
              </div>
              </div>

          <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
              <img src="assets/img/img16.png" class="img-fluid" alt="">
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
