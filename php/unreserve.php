<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Unreserve</title>
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
				
				if ( isset($_POST['unreserve']) && isset($_POST['id']))
				{
					$id = mysql_real_escape_string($_POST['id']);
					
					$sql_delete = "DELETE from reservations WHERE ISBN = '$id'";
					$sql_update = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$id'";
					mysql_query($sql_delete);
					mysql_query($sql_update);
					echo '<div align="center">Success! Book Unreserved. <p><a href="home.php">Return to Home</a></p></div>';
					return;
				}
				$id = mysql_real_escape_string($_GET['id']);
				$result = mysql_query("SELECT * FROM books WHERE ISBN='$id'");
				$row = mysql_fetch_row($result);
				echo "<div align=\"center\"><p>Confirm Unreserving: $row[1]</p>\n";
				echo('<form method="post"><input type="hidden" ');
				echo('name="id" value="'.htmlentities($row[0]).'">'."\n");
				echo('<input type="submit" value="Unreserve" name="unreserve">');
				echo('<p><a href="home.php">Cancel</a></p>');
				echo("\n</form></div>\n");
			?>
		<footer>
			<?php include '../html/footer.html';?>
		</footer>
	<?php } ?>
	</body>
</html>		