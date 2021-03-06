<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Search</title>
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
		<?php } else { echo('<p style="color:green">Logged In As: '. $_SESSION["account"]."</p>\n");
		?>
		
		<?php
			require_once "db_library.php";
			echo '<div align="center"><table cellpadding="8" border="1" style="text-align:left">';
			
			$begin = 0;
			$limit = 5;
			
			if(isset($_GET['page']))
			{
				$page = $_GET['page'];
				$begin = ($page-1) * $limit;
			}
			else
			{
				$page = 1;
			}
			
			if (isset($_POST['title']) && isset($_POST['author'])) 
			{
				$_SESSION['title'] = mysql_real_escape_string($_POST['title']);
				$_SESSION['author'] = mysql_real_escape_string($_POST['author']);
			}
			
			if (isset($_SESSION['title']) && isset($_SESSION['author'])) 
			{
				$author = $_SESSION['author'];
				$title = $_SESSION['title'];
				//Set the SESSION vars, so they will be passed on after re-load
				$result = mysql_query("select * from books 
				join (categories) using (categoryID)
				where author like '%$author%' AND booktitle like '%$title%'");
				
				$num_pages = mysql_num_rows($result);
				$num_pages = ceil($num_pages / $limit);
				
				$new_result = mysql_query("select * from books 
				join (categories) using (categoryID)
				where author like '%$author%' AND booktitle like '%$title%' LIMIT $begin, $limit");
				
				$_SESSION['page'] = $page;
				$_SESSION['limit'] = $limit;
				$_SESSION['begin'] = $begin;
				
				if ((mysql_num_rows($new_result)==0))
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
					echo('<strong>Author</strong>');
					echo("</td><td>");
					echo('<strong>Edition</strong>');
					echo("</td><td>");
					echo('<strong>Year</strong>');
					echo("</td><td>");
					echo('<strong>Category</strong>');
					echo("</td><td>");
					echo('<strong>Reserve</strong>');
					echo("</td><tr>");
					
					while ( $row = mysql_fetch_row($new_result) ) 
					{
						echo "<tr><td>";
						echo(htmlentities($row[1]));
						echo("</td><td>");
						echo(htmlentities($row[2]));
						echo("</td><td>");
						echo(htmlentities($row[3]));
						echo("</td><td>");
						echo(htmlentities($row[4]));
						echo("</td><td>");
						echo(htmlentities($row[5]));
						echo("</td><td>");
						echo(htmlentities($row[7]));
						echo("</td><td>");
						
						if ($row[6] == 'Y')
						{
							echo("Reserved");
							echo("</td></tr>\n");
						}
						else if ($row[6] == 'N')
						{
							echo '<input type="button" value="Reserve" onclick="location.href=\'reserve.php?id='.htmlentities($row[1]).'\'; return false">';
							echo("</td></tr>\n");
						}
					} // end while
					
					echo '<div align="center"><table cellpadding="20">';
					
					// print the linked page nums
					for ($i=1; $i<=$num_pages; $i++)
					{
						if($i==$page) 
						{ 
							echo "<td align=\"center\">Page: ".$i."</td>"; 
						}
				
						else 
						{ 
							echo "<td align=\"center\"><a href='?page=".$i."'>".$i."</a></td>"; 
						}
					} // end for
					echo '</table></div>';
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