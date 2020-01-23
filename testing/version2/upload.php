<?php

	if(isset($_FILES['file'])){
	  $file = $_FILES['file'];
	  if(move_uploaded_file($file['tmp_name'], $file['name'])){
	    echo $file['name'];
	  }
	}

?>