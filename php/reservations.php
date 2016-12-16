<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Reservations</title>
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
				echo '<div align="center"><table cellpadding="8" border="1" style="text-align:left">';
				
				$user = mysql_real_escape_string($_SESSION["account"]);
				
				$result = mysql_query("select ISBN, booktitle, username, reservedDate from reservations 
				join books using (ISBN)
				where Username = '$user'");
				
				if ((mysql_num_rows($result)==0))
				{
					echo '<tr><td style="color:red">';
					echo 'No results found';
				}
				else
				{
					echo "<tr><td>";
					echo('<strong>ISBN</strong>');
					echo("</td><td>");
					echo('<strong>Book Title</strong>');
					echo("</td><td>");
					echo('<strong>Username</strong>');
					echo("</td><td>");
					echo('<strong>Reserved Date</strong>');
					echo("</td><td>");
					echo('<strong>Unreserve</strong>');
					echo("</td><tr>");
					
					while ( $row = mysql_fetch_row($result) ) 
					{
						echo "<tr><td>";
						echo(htmlentities($row[0]));
						echo("</td><td>");
						echo(htmlentities($row[1]));
						echo("</td><td>");
						echo(htmlentities($row[2]));
						echo("</td><td>");
						echo(htmlentities($row[3]));
						echo("</td><td>");
						echo '<input type="button" value="Unreserve" onclick="location.href=\'unreserve.php?id='.htmlentities($row[0]).'\'; return false">';
						echo("</td></tr>\n");
					}
				}
				echo '</table></div>';
			?>
			
		</br>
		
		<table align="center">
			<tr><td colspan="100" width="11.50%" align="right"><input type="button" value="Return" onclick="location.href='search.php'; return false"/></td>
			<td width="11.50%" align="left"><input type="button" value="Log Out" onclick="location.href='logout.php'; return false"/></td></tr>
		</table>

		<footer>
			<?php include '../html/footer.html';?>
		</footer>
	<?php } ?>
	</body>
</html>		