<?php

include ("classes/initial.php");
include ("classes/config.inc.php");
include ("classes/Database.class.php");
include ("classes/functions.php");
include ("classes/Session.class.php");
include ("classes/Password.php");
$sitesession = new Session();
$sitesession->Session();

$con = mysqli_connect("127.0.0.1","root" ,"BeAJain","sbn_db");

$qry_fetch_hash_pass = "SELECT Password FROM `members` WHERE Mobile=".$_POST['Mobile']."";

if ($result = $con->query($qry_fetch_hash_pass)) {
  while ($row = $result->fetch_row()) {
        $hashed_password = $row[0];
  }
  /*echo "$memberLastName";*/
  $result->free_result();
}

if ($_POST['btnsubmit']) {

    $Error=0;
    $Mobile = trim($_POST['Mobile']);
    $Password = trim($_POST['Password']);

    if (strlen($Mobile)!=10) {
        $Error=1;
        $Mobile_Error = "Please enter valid mobile number.";
    }
    if (strlen($Password)=="") {
      $Error=1;
      $Password_Error = "Please enter your password.";
  }

    if ($Error==1) {
        $Error_Message = "Sorry, we have detected issues with your submission.";
    }else {
        
    if (password_verify($Password, $hashed_password)) {
            $Password = $hashed_password;
        } else {
            echo "work even harder . . .";
        }

    if (password_verify($Password, $hashed_password)) {
            $Password = $hashed_password;
        } else {
            echo "work even harder . . .";
        }

      $chkrsq = $db->query("select * from members where Mobile='".$db->escape($Mobile)."' and Password='".$db->escape($Password)."'");
      if (mysql_num_rows($chkrsq)==0) {
        $Error_Message = "Sorry, login credentials are incorrect.";
      }else {

        $chkrs = mysql_fetch_assoc($chkrsq);
        if ($chkrs['Status']=="0") {
          $Error_Message = "Sorry, your status is inactive, contact administrator.";
        }else {
          if ($chkrs['MobileVerificationStatus']=="0") {
            ?><script>location.href="mobile-verification?SuccessID=<?=$chkrs['MemberId']?>";</script><?
          }else {

            $sitesession->set('SESSIONTYPE',"USER");
            $sitesession->set('SESSIONID',$chkrs['MemberId']);
            $sitesession->set('SESSIONMOBILE',$chkrs['Mobile']);
            $sitesession->set('SESSIONNAME',$chkrs['FirstName']);



            ?><script>location.href="dashboard.php?SuccessID=<?=$id?>";</script><?
          }
        }
      }
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:description" content="Create your SBN Account for Free!">
    <meta name="description" content="Create your SBN Account for Free!">
    <title>(SBN) Satsang Business Network : Sign In</title>
    <?php include("includes/style.php"); ?>
  </head>
  <body>
    <?php include("includes/header.php"); ?>
    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p  mg-b-40">
              <h4 class="tx-color-01 mg-b-5 text-center">Sign in</h4>
              <hr>
              <p class="tx-color-03 tx-16 mg-b-40 text-center">Enter your mobile number and password.</p>

              <?php if ($Error_Message!="") { ?>
                <div class="alert alert-danger" role="alert"><?=$Error_Message?></div>
              <?php } ?>
                <form name="sbnform" id="sbnform" action="<?=$_SERVER['PHP_SELF']?>?SuccessID=<?=$SuccessID?>" method="post">
              <div class="form-group">
                <label>Enter your mobile</label>
                <input type="text" name="Mobile" id="Mobile" class="form-control" placeholder="" minlength="10" maxlength="10" required>
              </div>
              <div class="form-group">
                <label>Enter your password</label>
                <input type="password" name="Password" id="Password" class="form-control" placeholder="" required>
              </div>

              <input type="submit" name="btnsubmit" class="btn btn-brand-02 btn-block" value="Login">



            </div>

            <div class="tx-13 tx-lg-14 mg-b-40">
                <a href="signup" class="btn btn-brand-02 d-inline-flex align-items-center">Create Account</a>
                <a href="mailto:support@mysbn.org" class="btn btn-white d-inline-flex align-items-center mg-l-5">Forgot Password</a>
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
