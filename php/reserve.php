<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Reserve</title>
		</div>
		<?php include '../html/header.html';?>
		<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	</head>
	
	<body>
		<?php
			session_start();

			if ( !isset($_SESSION["account"]) ) 
			{ ?>
			<p><div align="center">You must be a Library Member to Browse Our Books<br><br><a href="login.php" style="text-decoration:none">Become a Member Today</a></div></p>
			<?php } 
			else { echo('<p style="color:green">Logged In As: '. $_SESSION["account"]."</p>\n");
			?>
			
			<?php
				require_once "db_library.php";
				
				$user = mysql_real_escape_string($_SESSION["account"]);
				$date = date("Y-m-d");
				
				if ( isset($_POST['reserve']) && isset($_POST['id']))
				{
					$id = mysql_real_escape_string($_POST['id']);
					$sql_insert = "INSERT INTO reservations VALUES ('$id', '$user', '$date')";
					$sql_update = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$id'";
					mysql_query($sql_insert);
					mysql_query($sql_update);
					echo '<div align="center">Success! Book Reserved <p><a href="home.php">Return to Home</a></p></div>';
					return;
				}
				$id = mysql_real_escape_string($_GET['id']);
				$result = mysql_query("SELECT * FROM books WHERE ISBN='$id'");
				$row = mysql_fetch_row($result);
				echo "<div align=\"center\"><p>Confirm Reserving: $row[1]</p>\n";
				echo('<form method="post"><input type="hidden" ');
				echo('name="id" value="'.htmlentities($row[0]).'">'."\n");
				echo('<input type="submit" value="Reserve" name="reserve">');
				echo('<p><a href="home.php">Cancel</a></p>');
				echo("\n</form></div>\n");
			?>
			
		<footer>
			<?php include '../html/footer.html';?>
		</footer>
	<?php } ?>
	</body>
</html>		