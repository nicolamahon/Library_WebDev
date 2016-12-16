<!DOCTYPE html>
<html>
	<head>
		<div>
			<title>Library Register New User</title>
		</div>
		<?php include '../html/header.html';?>
		<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	</head>
	
	<body>
	
			<?php
				require_once "db_library.php";
				
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					//echo '<div align="center"><table cellpadding="8" border="1" style="text-align:left">';
					
					$newuser = check_input($_POST["newuser"]);
					$pw1 = check_input($_POST["pw1"]);
					$pw2 = check_input($_POST["pw2"]);
					$fname = check_input($_POST["fname"]);
					$sname = check_input($_POST["sname"]);
					$add1 = check_input($_POST["add1"]);
					$add2 = check_input($_POST["add2"]);
					$city = check_input($_POST["city"]);
					$tel = check_input($_POST["tel"]);
					$mob = check_input($_POST["mob"]);
					
					$result = mysql_query("select * from from users where Username = '$newuser'"); 
					
					// if the query return true then there is already a user with that username
					if($result)
					{
						echo('<p style="color:red">Username Already Exists</p>');
					}
					else // otherwise check the new user's inputted values
					{
						// if the password is minimum 6 chars long
						if(strlen($pw1) >= 6)
						{
							// if the passwords match
							if ($pw1 == $pw2)
							{
								// if the mobile number is 10 chars long
								if(strlen($mob) == 10)
								{
									// all values passed, perform insert of user to database
									$insert = mysql_query("INSERT INTO users 
									(Username, Password, Firstname, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
									VALUES ('$newuser', '$pw1', '$fname', '$sname', '$add1', '$add2', '$city', '$tel', '$mob')");
									if($insert)
									{
										//echo 'You are now registered';
										echo('<p style="color:green">You are now registered<br>Please login</p>');
									}
									else
									{
										// database has rejected the username as it already exists
										echo('<p style="color:red">Username Already Exists</p>');
									}
								}
								else 
								{
									//echo 'ERROR: Mobile should contain 10 digits';
									echo('<p style="color:red">ERROR: Mobile should contain 10 digits</p>');
								}
							}
							else
							{
								//echo 'ERROR: Passwords do not match';
								echo('<p style="color:red">ERROR: Passwords do not match</p>');
							}
						}
						else
						{
							//echo 'ERROR: Password should contain at least 6 characters';
							echo('<p style="color:red">ERROR: Passwords should contain at least 6 characters</p>');
						}	
					}
				}
				function check_input($data) 
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
		?>
		<p><h3>Please enter your details below:</h3></p>
		<div id="container">
			<form method="post"> 
			<table cellpadding="10" align="center">
				<tr><td>Username:</td><td><input type="text" name="newuser" value="" required></td></tr> 
				<tr><td>Password:</td><td><input type="password" name="pw1" value="" required></td></tr> 
				<tr><td>Re-Type Password:</td><td><input type="password" name="pw2" value="" required></tr></td> 
				<tr><td>Firstname: </td><td><input type="text" name="fname" value="" required></tr></td> 
				<tr><td>Surname:</td><td> <input type="text" name="sname" value="" required></tr></td> 
				<tr><td>AddressLine1: </td><td><input type="text" name="add1" value="" required></tr></td> 
				<tr><td>AddressLine2: </td><td><input type="text" name="add2" value="" required></tr></td> 
				<tr><td>City:</td><td> <input type="text" name="city" value="" required></tr></td> 
				<tr><td>Telephone:</td><td> <input type="number" name="tel" value="" required></tr></td> 
				<tr><td>Mobile:</td><td> <input type="number" name="mob" value="" required></tr></td> 
				
				<tr><td><input type="submit" name="register" value="Register"></td><td>
				<input type="submit" id="cancel" value="Cancel" onclick="location.href='home.php'; return false"></td></tr>
			</table>
			</form> 
		</div>
			
			
		<footer>
			<?php include '../html/footer.html';?>
		</footer>
		</body>
</html>