<?php
	session_start();
	unset($_SESSION["username"]);
	require_once "dbconnect.php"; //connect to database
	
	//Check username & password are set
	if ( !empty($_POST["username"]) && !empty($_POST["pw"]))
	{
		//POST user's login info
		$u = mysql_real_escape_string($_POST['username']);
		$p = mysql_real_escape_string($_POST['pw']);
		
		//Query for login
		$res = mysqli_query($db, "SELECT * FROM user WHERE Username = '$u' AND Password = '$p';");
		//Query to check is username exists
		$uexist = mysqli_query($db, "SELECT * FROM user WHERE Username = '$u';");
		
		//Validate the input data against the user table in database
		while ($row = mysqli_fetch_array($res))
		{
			if ($row[0] == $u && $row[1] == $p)
			{
				$matchPW = $row[1];
			}
		}
		
		if ($p == $matchPW && $p != NULL) //Successful login
		{
			$_SESSION["username"] = $_POST["username"];
			header('Location: index.php');
			return;
		}
		else if(mysqli_fetch_array($uexist) == NULL) //User does not exist in database
		{
			$_SESSION["error"] = "Username Not Found.";
			header ('Location: login.php');
			return;
		}
		else //Password/Username not matching
		{
			$_SESSION["error"] = "Incorrect Password";
			header ('Location: login.php');
			return;
		}
	}
	else if (count($_POST) > 0) //Either username or password missing
	{
		$_SESSION["error"] = "Missing Required Information";
		header('Location: login.php');
		return;
	}
	
	//close connection to database
	mysqli_close($db);
?>