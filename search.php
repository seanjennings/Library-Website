<!-- Check for valid user session at start of file -->
<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: login.php');
	}
	
	//connect to database using dbconnect.php
	require_once "dbconnect.php";
	
	//Different search types based on radio buttons
	if (isset($_POST['search'])) {

		$search = mysql_real_escape_string($_POST['search']);
		if (isset($_POST['field']))
		{
			$field = $_POST['field'];	
		}
		else
		{
			$field = "title";
		}
		
		$col = "BookTitle";
		if ($field == "title")
		{
			$col == "BookTitle";
		}
		else if ($field == "author")
		{
			$col = "Author";
		}
		else if ($field == "auth_title")
		{
			$col = "BookTitle LIKE '%$search%' OR Author";
		}
		
		if($field == "category")
		{
			$_SESSION['sql'] = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year,
									c.CategoryDescription, b.Reserved
									FROM book AS b
									INNER JOIN category AS c
									ON b.Category=c.CategoryID
									WHERE c.CategoryDescription LIKE '%$search%'
									ORDER BY c.CategoryDescription;";
		}
		else
		{
			$_SESSION['sql'] = "SELECT * FROM book WHERE $col LIKE '%$search%';";
		}

		if (mysqli_query($db, $_SESSION['sql']))
		{
			$_SESSION['result'] = mysqli_query($db, $_SESSION['sql']);
		}
		else
		{
			die('Error: '. mysqli_error());
		}
	}
	mysqli_close($db);
	
	//Return to index to display results
	header('Location: index.php');

?>