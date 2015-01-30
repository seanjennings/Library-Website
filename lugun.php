<?php
	$db = mysqli_connect('localhost','root','','library');
	
	if(isset($_POST["username"]))
	{
		$u = $_POST["username"];
		$p = $_POST["pw"];
	
		$res = mysqli_query($db, "SELECT * FROM user WHERE Username = '$u' AND Password = '$p'");
		$uexist = mysqli_query($db, "SELECT * FROM user WHERE Username = '$u'");
	
		$row = mysqli_fetch_array($res);
	
		if($u == $row[0] && $p == $row[1])
		{
			echo "Welcome $u.";
		}
		else if(!empty(mysqli_fetch_array($uexist)))
		{
			echo "Incorrect Password.";
		}
		else
		{
			echo "Username not Found. <a href=\"register.php\">Click Here to Register.</a>";
		}
	}
	mysqli_close($db);
?>

<html>
	<form method="post">
		<p>Username: <input type="text" name="username"></p>
		<p>Password: <input type="password" name="pw"></p>
		<p><input type="submit" value="Log In"></p>
	</form>
</html>