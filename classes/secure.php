<?php
	if ($_SESSION['SESSIONMOBILE']=="") { 

		$domain = $_SERVER['HTTP_HOST'];
		$path = $_SERVER['SCRIPT_NAME'];
		$queryString = $_SERVER['QUERY_STRING'];
		$url = "https://" . $domain . $path . "?" . $queryString;

		header("Location: ".WEBPATH."signin?ref=".$url);
		exit;
	} 
?>