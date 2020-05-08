<?php
$conn = mysqli_connect("127.0.0.1", "root", "BeAJain", "sbn_db");
if(!$conn){
//    echo "work harder...";
}
//    echo "go ahead...";
//    echo "<script> console.log('PHP: ',",get_option("slides_data"),");</script>";
$query_for_fetching_profile_picture_path = "SELECT Profile_picture_path FROM `members` WHERE Mobile=".$_SESSION['SESSIONMOBILE']."";

if ($result = $conn -> query($query_for_fetching_profile_picture_path)) {
  $profile_pic_path = $result -> fetch_assoc();
    $image = array_pop($profile_pic_path);
  // Free result set
  $result -> free_result();
}

$conn -> close();

?>

<header class="navbar navbar-header navbar-header-fixed">
  <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
  <div class="navbar-brand">
    <a href="signup.php" class="df-logo">SBN</a>
  </div><!-- navbar-brand -->
  <div id="navbarMenu" class="navbar-menu-wrapper">
    <div class="navbar-menu-header">
      <a href="#" class="df-logo">SBN</a>
      <a id="mainMenuClose" href="#"><i data-feather="x"></i></a>
    </div><!-- navbar-menu-header -->

    <?php if ($_SESSION['SESSIONMOBILE']!="") { ?>

      <ul class="nav navbar-menu">
          <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
          <li class="nav-item active">
            <a href="#" class="nav-link">Dashboard</a>            
          </li>
          
          
          <li class="nav-item"><a href="http://themepixels.me/dashforge/components/" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path><polyline points="2.32 6.16 12 11 21.68 6.16"></polyline><line x1="12" y1="22.76" x2="12" y2="11"></line></svg> I Offer</a></li>
          <li class="nav-item"><a href="http://themepixels.me/dashforge/collections/" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> I Need</a></li>

            <li class="nav-item with-sub">
            <a href="#" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path><polyline points="2.32 6.16 12 11 21.68 6.16"></polyline><line x1="12" y1="22.76" x2="12" y2="11"></line><line x1="7" y1="3.5" x2="17" y2="8.5"></line></svg> My Network</a>
            <ul class="navbar-menu-sub">              
              <li class="nav-sub-item"><a href="app-chat.html" class="nav-sub-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>Messages</a></li>
              <li class="nav-sub-item"><a href="app-contacts.html" class="nav-sub-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Contacts</a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="http://themepixels.me/dashforge/collections/" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Event Calendar</a></li>
          
        </ul>

          <? } ?>
    
  </div><!-- navbar-menu-wrapper -->
  <div class="navbar-right">

  <?php if ($_SESSION['SESSIONMOBILE']=="") { ?>

    <div class="d-flex">
      <a href="signup.php" class="btn btn-xs btn-white flex-fill">Sign Up</a>
      <a href="signin.php" class="btn btn-xs btn-primary flex-fill mg-l-10">Sign In</a>
    </div>

  <?php } else { ?>


    <div class="dropdown dropdown-profile">
          <a href="#" class="dropdown-link" data-toggle="dropdown" data-display="static" aria-expanded="false">
            <div class="avatar avatar-sm"><img src="<? echo $image; ?>" class="rounded-circle" alt=""></div>
          </a><!-- dropdown-link -->
          <div class="dropdown-menu dropdown-menu-right tx-13">
            <!--<div class="avatar avatar-lg mg-b-15"><img src="assets/img/img1.png" class="rounded-circle" alt=""></div>-->
              <div class="avatar avatar-lg mg-b-15"><img src="<? echo $image; ?>" class="rounded-circle" alt=""></div>
            <h6 class="tx-semibold mg-b-5"><?=$_SESSION['SESSIONNAME']?></h6>

            <a href="edit_profile.php" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg> Edit Profile</a>
            <a href="#" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> View Profile</a>
            <div class="dropdown-divider"></div>
           
           
            <a href="signout.php" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>Sign Out</a>
          </div><!-- dropdown-menu -->
        </div>

  <?php } ?>

  </div><!-- navbar-right -->
</header><!-- navbar -->