<?php 
session_start(); 
unset($_SESSION["account"]); 
require_once "db_library.php";

if ( isset($_POST["account"]) && isset($_POST["pw"]) ) 
{ 	
	$user = $_POST['account'];
	echo $user;
	$password = $_POST['pw'];
	echo $password;

	$result = mysql_query("SELECT * FROM users where username = '$user' and password = '$password'");
	$numrows = mysql_num_rows($result);
	
	if ($numrows != 0)
	{ 	
		$_SESSION["account"] = $_POST["account"]; 
		$_SESSION["success"] = " Success: Logged In"; 
		header( 'Location: home.php' ) ; 
		return; 
	} 
	else 
	{ 
		$_SESSION["error"] = " Incorrect Details Entered."; 
		header( 'Location: login.php' ) ; 
		return; 
	}
} 
else if( count($_POST) > 0 ) 
{ 
	$_SESSION["error"] = " Missing Required Information"; 
	header( 'Location: login.php' ) ; 
	return; 
} 

?> 

<html> 
	<head> 
		<?php include '../html/header.html';?>
		<div>
			<title>Library Login</title>
		</div>
		<link rel="stylesheet" type="text/css" href="../css/library.css">
	</head> 
	
	<body> 
		<div align="center">
		<h2>Please Log In</h2> 
		<?php if ( isset($_SESSION["error"]) ) 
		{ 
			echo('<p style="color:red">Error:'. $_SESSION["error"]."</p>\n"); 
			unset($_SESSION["error"]);
		} ?> 
		
		<form method="post"> 
			<p>Username: <input type="text" name="account" value="" required></p> 
			<p>Password: <input type="password" name="pw" value="" required></p> 
			<p><input type="submit" id="loginButton" value="Log In"></p><br>
			<p>If you are not currently a Library Member, please register with us today</p>
			<p><input type="submit" id="registerButton" value="Register" onclick="location.href='register.php'; return false"></p>
		</form> 
		</div>
		
		<footer>
			<?php include '../html/footer.html';?>
		</footer>
	</body> 
</html>