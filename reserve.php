<!-- Check for valid user session at start of file -->
<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: login.php');
	}
	
	//connect to database using dbconnect.php
	require_once "dbconnect.php";

	if (isset($_POST['reserve']) && isset($_POST['isbn']))
	{
		$isbn = $_POST['isbn'];
		$user = $_SESSION['username'];
		$date = date("Y-m-d");

		$update = 	"UPDATE book SET Reserved = 'Y' WHERE ISBN = '$isbn';";
		$insert = 	"INSERT INTO reservation (ISBN, Username, ReservedDate)
					VALUES ('$isbn', '$user', '$date');";

		mysqli_query($db, $update);
		mysqli_query($db, $insert);
	}
	header('Location: index.php');
	mysqli_close($db);
?>