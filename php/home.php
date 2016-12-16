<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Homepage</title>
		</div>
		<?php include '../html/header.html';?>
		<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	</head>
	
	<body>
		<?php
			session_start();
			if ( isset($_SESSION["error"]) ) 
			{
				echo('<div align="center"><p style="color:red">Error:'.$_SESSION["error"]."</p></div>\n");
				unset($_SESSION["error"]);
			}
			
			if ( isset($_SESSION["success"]) )
			{
				echo('<div align="center"><p style="color:blue">'.$_SESSION["success"]."</p></div>\n");
				unset($_SESSION["success"]);
			}

			if ( !isset($_SESSION["account"]) ) 
			{ ?> 
			<p><div align="center">You must be a Library Member to Browse Our Books<br><br><a href="login.php" style="text-decoration:none">Become a Member Today</a></div></p>
			<?php } 
			else { echo('<p style="color:green">Logged In As: '. $_SESSION["account"]."</p>\n");  
			?>
				
				<table cellpadding="15" align="center">
				<tr><td colspan="100" align="center">Select an Option:</td></tr>
					<tr><td colspan="100" align="center"><a href="search.php" style="text-decoration:none">Search and Reserve Books</td></tr>
					<tr><td colspan="100" align="center"><a href="reservations.php" style="text-decoration:none">View Currently Reserved Books</td></tr>
					
				</table>
				<br>
				<table align="center">
					<tr><td colspan="100" align="center"><input type="button" value="Log Out" onclick="location.href='logout.php'; return false"></td></tr>
				</table>
		
				<footer>
					<?php include '../html/footer.html';?>
				</footer>
	<?php } ?>
	</body>
</html>