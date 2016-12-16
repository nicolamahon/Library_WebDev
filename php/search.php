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
			
			<h2>Search by Book Title, Author or Category</h2>
		<form action = "search_other.php" method="post">
			<table cellpadding="15" align="center">
					<tr><td colspan="100" align="right"><label>Book Title: </label></td>
					<td align="left"><input type="text" name="title" size="43"/></td></tr>
					<tr><td colspan="100" align="right"><label>Author:</label></td>
					<td align="left"><input type="text" name="author" size="43"/></td></tr>
					<tr><td align="right" width="50%" colspan="100"><input type="reset" value="Clear"/></td>
					<td><input type="submit" value="Search"/></td></tr>
			</table>
		</form>
		
		</br>
		
		<form action = "search_cat.php" method="post">
			<table cellpadding="15" align="center">
					<tr><td colspan="100" align="right"><label>Category:</label></td>
					<td align="left"><?php 
						require_once "db_library.php";
						
						$sql=mysql_query("SELECT CategoryDescription FROM categories");
						if(mysql_num_rows($sql))
						{
							$select= '<div align="center"><select align="left" name="category" style="width:305px; font-size:30px;">';
							while($value=mysql_fetch_array($sql))
							{
								$select.='<option value="'.$value['CategoryDescription'].'">'.$value['CategoryDescription'].'</option>';
							}
						}
						$select.='</select></div>';
						echo $select;
				?></td></tr>
				<tr><td align="right" width="50%" colspan="100"><input type="reset" value="Clear"/></td>
				<td><input type="submit" value="Search"/></td></tr>
			</table>
		</form>
		
		</br>
		
		<table cellpadding="15" align="center" >
			<tr><td colspan="100" width="15.50%" align="center"><input type="button" value="Return" width="30" onclick="location.href='home.php'; return false"/></td>
			<td width="15.50%" align="center"><input type="button" value="Log Out" onclick="location.href='logout.php'; return false"/></td></tr>
		</table>
		
		
		
		<footer>
			<?php include '../html/footer.html';?>
		</footer>
		<?php } ?>
	</body>
</html>