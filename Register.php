<?php
	//connect to database using dbconnect.php
	require_once "dbconnect.php";
	
	//check that all registration fields were filled in
	if ( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) &&
		 isset($_POST['surname']) && isset($_POST['address1']) && isset($_POST['address2']) && 
		 isset($_POST['city']) && isset($_POST['telephone']) && isset($_POST['mobile']) )
	{
		//POST values from HTML registration form
		$uname = mysql_real_escape_string($_POST['username']);
		$pwd = mysql_real_escape_string($_POST['password']);
		$pwdcmp = mysql_real_escape_string($_POST['passwordcmp']);
		$first = mysql_real_escape_string($_POST['firstname']);
		$surname = mysql_real_escape_string($_POST['surname']);
		$add1 = mysql_real_escape_string($_POST['address1']);
		$add2 = mysql_real_escape_string($_POST['address2']);
		$city = mysql_real_escape_string($_POST['city']);
		$telephone = mysql_real_escape_string($_POST['telephone']);
		$mobile = mysql_real_escape_string($_POST['mobile']);
		
		/* Error Checking */
		//User already exists in database
		$uexist = mysqli_query($db, "SELECT * FROM user WHERE Username = '$uname';");
		if(mysqli_fetch_array($uexist) != NULL)
		{
			$_SESSION["error"] = "Username already in use.";
		}
		//Matching Passwords error checking
		else if($pwd == $pwdcmp)
		{
			//Create Insert Statement to input user information into database
			$sql = "INSERT INTO user (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile)
			VALUES ('$uname', '$pwd', '$first', '$surname', '$add1', '$add2', '$city', '$telephone', '$mobile');";
			
			//Query database with above insert statement
			mysqli_query($db, $sql);
			
			//Save success message linking back to login page
			$_SESSION["success"] = "Account Created! Please <a href=\"Login.php\">Log In.</a>";
		}
		else if($pwd != $pwdcmp)
		{
			//set non-matching passwords error
			$_SESSION["error"] = "Passwords did not match.";
		}
	}

	//close connection to database
	mysqli_close($db);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="layouts.css">
</head>
<body>

	<?php
		//include header file
		include 'header.html';
	?>
		<div class="container">
		
			<?php
				//Display errors if any
				if (isset($_SESSION["error"]))
				{
					echo ('<p style="color:red">Error: '.$_SESSION["error"]."</p>\n");
					unset($_SESSION["error"]); //unset error after displaying
				}
				
				//Display successes if any
				if (isset($_SESSION["success"]))
				{
					echo ('<p style="color:green">'.$_SESSION["success"]."</p>\n");
					unset($_SESSION["success"]); //unset success after displaying
				}
			?>
			
			<!-- Registration Form -->
			<form class="form" method="post">
				<p>
					<label class="form1" for "username">Username: </label>
					<input required class="box" type="text" name="username" maxlength="20" />
				</p>
				<p>
					<label class="form1"  for "password">Password: </label>
					<input pattern=".{6,}" required title="Min Character Length: 6" class="box" type="password" name="password"/>
				</p>
				<p>
					<label class="form1"  for "passwordcmp">Retype Password: </label>
					<input pattern=".{6,}" required title="Min Character Length: 6" class="box" type="password" name="passwordcmp"/>
				</p>
				<p>
					<label class="form1"  for "firstname">Firstname: </label>
					<input required class="box" type="text" name="firstname" maxlength="15" />
				</p>
				<p>
					<label class="form1"  for "surname">Surname: </label>
					<input required class="box" type="text" name="surname" maxlength="20" />
				</p>
				<p>
					<label class="form1"  for "address1">Address Line 1: </label>
					<input required class="box" type="text" name="address1" maxlength="30" />
				</p>
				<p>
					<label class="form1"  for "address2">Address Line 2: </label>
					<input required class="box" type="text" name="address2" maxlength="20" />
				</p>
				<p>
					<label class="form1"  for "city">City: </label>
					<input required class="box" type="text" name="city" maxlength="15" />
				</p>
				<p>
					<label class="form1"  for "telephone">Telephone: </label>
					<input required class="box" type="tel" name="telephone" pattern="[0-9]{7,10}" />
				</p>
				<p>
					<label class="form1"  for "mobile">Mobile: </label>
					<input required class="box" type="tel" name="mobile" pattern="[0-9]{10}" />
				</p>
				
				<p>
					<input class="register" type="submit" value="Register" />
				</p><br><br>
				
				<!-- Link back to login page, after complete registration -->
				<p>
					<p>Click <a href="Login.php">here</a> to return to Login</p>
				</p>
			</form>
			
			<!-- Including Page Footer -->
			<?php
				include 'footer.html';
			?>
		</div>

</body>
</html>