<?php
include ("classes/initial.php");
include ("classes/config.inc.php");
include ("classes/Database.class.php");
include ("classes/functions.php");
include ("classes/Session.class.php");
include ("classes/Password.php");
$sitesession = new Session();
$sitesession->Session();

if ($_POST['btnsubmit']) {

    $Error=0;
    $Mobile = trim($_POST['Mobile']);
    $Password = trim($_POST['Password']);
    $FirstName = ucfirst(trim($_POST['FirstName']));
    $LastName = ucfirst(trim($_POST['LastName']));

    if (strlen($Mobile)!=10) {
        $Error=1;
        $Mobile_Error = "Please enter your valid 10 digit mobile number.";
    }
    if (strlen($Password)<8) {
        $Error=1;
        $Password_Error = "Length of password should be minimum 8.";
    }
    if (strlen($FirstName)<2) {
        $Error=1;
        $FirstName_Error = "Length of first name should be minimum 2.";
    }
    if (strlen($LastName)<2) {
        $Error=1;
        $FirstName_Error = "Length of last name should be minimum 2.";
    }

    if ($Error==1) {
        $Error_Message = "Sorry, we have detected issues with your submission.";
    }else {

      $chkrsq = $db->query("select Mobile from members where Mobile='".$db->escape($Mobile)."'");
      if (mysql_num_rows($chkrsq)>0) {
        $Error_Message = "Sorry, this mobile number is already registered.";
      }else {

        $MobileVerificationCode=rand(1000,9999);

          $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

        $sql = "insert into members set ";
        $sql .= "Mobile='".$db->escape($Mobile)."', ";
        $sql .= "MobileVerificationCode='".$db->escape($MobileVerificationCode)."', ";
        $sql .= "Password='".$db->escape($hashed_password)."', ";
        $sql .= "FirstName='".$db->escape($FirstName)."', ";
        $sql .= "LastName='".$db->escape($LastName)."', ";
        $sql .= "Status='1', ";
        $sql .= "CreatedOn='".TODAY."', ";
        $sql .= "UpdatedOn='".TODAY."'";

        $TextMessage = $MobileVerificationCode . " is your verification code for mysbn.org.";
        sendsms($Mobile,$TextMessage);

        if (!$db->query($sql)) {
          $Error_Message = "Sorry, we are experiencing technical issues, try again later.";
        }else {
          $id = mysql_insert_id();
          ?><script>location.href="mobile-verification.php?SuccessID=<?=$id?>";</script><?
        }

      }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:description" content="Create your SBN Account for Free!">
    <meta name="description" content="Create your SBN Account for Free!">
    <title>(SBN) Satsang Business Network : Sign Up</title>
    <?php include("includes/style.php"); ?>
  </head>
  <body>
    <?php include("includes/header.php"); ?>
    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p">
              <h4 class="tx-color-01 mg-b-5">Create your SBN Account.</h4>
              <p class="tx-color-03 tx-16 mg-b-40">It's free to signup and only takes a minute.</p>

              <?php if ($Error_Message!="") { ?>
                <div class="alert alert-danger" role="alert"><?=$Error_Message?></div>
              <?php } ?>
                <form name="sbnform" id="sbnform" action="<?=$_SERVER['PHP_SELF']?>" method="post">
              <div class="form-group">
                <label>Mobile Number *</label>
                <input type="text" name="Mobile" id="Mobile" class="form-control" placeholder="Enter your mobile number" value="<?=$Mobile?>" minlength="10" maxlength="10" required>
                <div class="error"><?=$Mobile_Error?></div>
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password *</label>
                </div>
                <input type="password" name="Password" id="Password" class="form-control" placeholder="Enter your password" value="<?=$Password?>" maxlength="50" required>
                <div class="error"><?=$Password_Error?></div>
              </div>
              <div class="form-group">
                <label>First Name *</label>
                <input type="text" name="FirstName" class="form-control" placeholder="Enter your firstname"  value="<?=$FirstName?>" maxlength="30" required>
                <div class="error"><?=$FirstName_Error?></div>
              </div>
              <div class="form-group">
                <label>Last Name *</label>
                <input type="text" name="LastName" class="form-control" placeholder="Enter your lastname" value="<?=$LastName?>" maxlength="30" required>
                <div class="error"><?=$LastName_Error?></div>
              </div>
              <div class="form-group tx-12">
                By clicking <strong>Create Account</strong> below, you agree to our terms of service and privacy statement.
              </div><!-- form-group -->

              <input type="submit" name="btnsubmit" class="btn btn-brand-02 btn-block" value="Create Account">
              <div class="tx-13 mg-t-20 tx-center">Already have an account? <a href="signin">Sign In</a></div>
            </div>
          </div><!-- sign-wrapper -->
          <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
              <img src="assets/img/img16.png" class="img-fluid" alt="">
            </div>

          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <?php include("includes/footer.php"); ?>
    <?php include("includes/footer-js.php"); ?>
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
