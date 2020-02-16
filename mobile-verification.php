<?php

include ("classes/initial.php");
include ("classes/config.inc.php");
include ("classes/Database.class.php");
include ("classes/functions.php");
include ("classes/Session.class.php");
$sitesession = new Session();
$sitesession->Session();

$SuccessID = $_REQUEST['SuccessID'];
if ($SuccessID=="") die("Invalid Request");

$chkrsq = $db->query("select MemberId,Mobile,MobileVerificationCode,MobileVerificationStatus from members where MemberId='".$db->escape($SuccessID)."'");
if (mysql_num_rows($chkrsq)==0) {
  ?><script>location.href="signup";</script><?php
} else {
  $chkrs = mysql_fetch_assoc($chkrsq);
  if ($chkrs['MobileVerificationStatus']==1) {
    ?><script>location.href="signin";</script><?php
  }
}



if ($_POST['btnsubmit']) {

    $Error=0;
    $Code = trim($_POST['Code']);

    if (strlen($Code)!=4) {
        $Error=1;
        $Code_Error = "Please enter valid 4 digit code.";
    }

    if ($Error==1) {
        $Error_Message = "Sorry, we have detected issues with your submission.";
    }else {

      $chkrsq = $db->query("select MobileVerificationCode from members where MobileVerificationCode='".$db->escape($Code)."' and MemberId='".$db->escape($SuccessID)."'");
      if (mysql_num_rows($chkrsq)==0) {
        $Error_Message = "Sorry, the code you have entered was wrong.";
      }else {

        $sql = "update members set ";
        $sql .= "MobileVerificationStatus='1', ";
        $sql .= "MobileVerificationDate='".TODAY."' ";
        $sql .= "where MemberId='".$db->escape($SuccessID)."'";

        if (!$db->query($sql)) {
          $Error_Message = "Sorry, we are experiencing technical issues, try again later.";
        }else {
          ?><script>location.href="mobile-verified.php";</script><?php
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
    <title>Verify your mobile : (SBN) Satsang Business Network</title>
    <?php include("includes/style.php"); ?>
  </head>
  <body>
    <?php include("includes/header.php"); ?>
    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p  mg-b-40">
              <h4 class="tx-color-01 mg-b-5 text-center">Mobile Verification</h4>
              <hr>
              <p class="tx-color-03 tx-16 mg-b-40 text-center">We have sent 4 digit code by sms to your mobile number.</p>

              <?php if ($Error_Message!="") { ?>
                <div class="alert alert-danger" role="alert"><?=$Error_Message?></div>
              <?php } ?>
                <form name="sbnform" id="sbnform" action="<?=$_SERVER['PHP_SELF']?>?SuccessID=<?=$SuccessID?>" method="post">
              <div class="form-group">
                <label class="text-center">Enter 4 digit code *</label>
                <input type="text" name="Code" id="Code" class="form-control" placeholder="" minlength="4" maxlength="4" required>
              </div>

              <input type="submit" name="btnsubmit" class="btn btn-brand-02 btn-block" value="Verify Mobile">
              

             

            </div>

            <div class="tx-13 tx-lg-14 mg-b-40">
                <a href="" class="btn btn-brand-02 d-inline-flex align-items-center">Resend Verification</a>
                <a href="mailto:support@mysbn.org" class="btn btn-white d-inline-flex align-items-center mg-l-5">Contact Support</a>
              </div>

          </div><!-- sign-wrapper -->
          
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
                    Code: {
                    required: true,
                    number: true
                    }
                }
            });
        });      
    </script>    
  </body>
</html>
