<?php
	session_start();
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
			//Include header in page
			include 'header.html';
		?>
		
		<div class="container">
		
			<h1>Please Log In</h1>
			
			<?php
				//display login errors, if any
				if (isset($_SESSION["error"]))
				{
					echo ('<p style="color:red">Error: '.$_SESSION["error"]."</p>\n");
					unset($_SESSION["error"]); //unset error after displaying
				}
			?>
			
			<!-- Login Form -->
			<form class="form" method="post" action="loginVal.php">
				<p>
					<label class="form1" for="username">Account:</label>
					<input class="box" type="text" name="username" />
				</p>
				<p>
					<label class="form1" for="pw">Password:</label>
					<input class="box" type="password" name="pw" />
				</p>
				<p>
					<input class="submit" type="submit" value="Log In"/>
				</p>
			</form>
			
			<!-- Link to registration page -->
			<p>Click <a href="Register.php">here</a> to Register</p>

			<?php
				//include footer file
				include 'footer.html';
			?>
		</div>
	</body>
</html>
