<?php
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
define('DB_SERVER',"localhost");
define('DB_USER',"root");
define('DB_PASS',"BeAJain");
define('DB_DATABASE',"sbn_db");
define('WEBPATH',"http://localhost/mysbn/system/");
define('PROJECT_TITLE',"Satsang Business Network");
define('TODAY',date("Y-m-d H:i:s"));
define('IPADDRESS',$_SERVER['REMOTE_ADDR']);
define('MODE','Offline');
?>