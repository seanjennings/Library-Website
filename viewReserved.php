<!-- Check for valid user session at start of file -->
<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: login.php');
	}
	
	//connect to database using dbconnect.php
	require_once "dbconnect.php";

	$user = $_SESSION['username'];

	$sql = "SELECT b.BookTitle, b.Author, b.ISBN, b.Reserved
			FROM book AS b
			INNER JOIN reservation AS r
			ON b.ISBN=r.ISBN
			WHERE r.Username = '$user';";


	if (isset($_POST['delete']) && isset($_POST['isbn']))
	{
		$i = $_POST['isbn'];
		$update = "UPDATE book SET Reserved = 'N' WHERE ISBN = '$i';";
		$unreserve = "DELETE FROM reservation WHERE ISBN = '$i'; ";

		if(mysqli_query($db, $update))
		{
			mysqli_query($db, $update);
		}
		else
		{
			die('Error: ' . mysqli_error());
		}

		if(mysqli_query($db, $unreserve))
		{
			mysqli_query($db, $unreserve);
		}
		else
		{
			die('Error: ' . mysqli_error());
		}
	}

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
	include 'header.html';
?>
	<div class="container">
		<br>
				<!-- Display Username -->
				<div class="uname">
					<?php
						if(isset($_SESSION['username']))
						{
							echo ('<p> Account: '.$_SESSION["username"]."</p>\n");
						}
					?>
				</div>
			</br>

		<?php
			if (mysqli_query($db, $sql))
			{
				echo '<table class="table1">'."\n";
				$result = mysqli_query($db, $sql);
				?>
				
				<tr>
					<td>Title</td>
					<td>Author</td>
				</tr>
				
				<?php	
				while ($row = mysqli_fetch_array($result)) {

					echo("<tr class='row'><td>");
					echo(htmlentities($row[0]));
					echo("</td><td>");
					echo(htmlentities($row[1]));
					echo("</td><td>");

					echo('<form method="post">');
					echo('<input type="hidden" ');
					echo('name="isbn" value="' . $row[2] . '">' . "\n");

					echo('<input class="reserve" type="submit" value="Unreserve" name="delete" ');
					if($row[3] == "N")
					{
						echo('disabled >');
					}
					else
					{
						echo('>');
					}

					echo("</form></td></tr>");

				}
				echo('</table>');
			}
			mysqli_close($db);
		?>
		<?php
			include 'footer.html';
		?>
	</div>
</body>
</html>