<?php

?>
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>
<body>
	<form method="post" action="upload.php" enctype="multipart/form-data">
	<input type="file" id="image" />
	</form>
	<div id="show-image"></div>

	<script src="jquery-3.4.1.min.js"></script>
	<script>
		$('#image').change(function(){
			var data = new FormData();
			data.append('file', $('#image')[0].files[0]);
			$.ajax({
				url: 'upload.php',
				type: 'POST',
				data: data,
				processData: false,
				contentType: false,
				beforeSend: function(){
					$('#show-image').html('Loading...');
				},
				success: function(data){
				//alert(data);
				$('#show-image').html('<img src="'+data+'" style="width:50%" alt="Avatar" />');
				}
		});
	return false;
	});
	</script>

</body>
</html>