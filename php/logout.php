<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Logout</title>
		</div>
		<?php include '../html/header.html';?>
		<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	</head>

	<body>
	<?php 

	session_start(); 
	session_destroy(); 

	echo '<p style="color:green">Logged Out Successfully</p>';
	//header("Location: login.php");

	?>

	<footer>
		<?php include '../html/footer.html';?>
	</footer>
	
	</body>
</html>
