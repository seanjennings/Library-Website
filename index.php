<!-- Check for valid user session at start of file -->
<?php
	session_start();
	if (! isset($_SESSION['username']))
	{
		header('Location: login.php');
	}
	require_once "dbconnect.php";
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
			//Include header
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
			
			<!-- Search Form -->
			<form class="form" method="post" action="search.php">
				<label class="form1" for="search" >Search for: </label>
				<input class="box" type="text" name="search" /><br/>
				<br>

				<label class="form1" for="field">Search By: </label><br>
				<input class="radio" type="radio" name="field" value="title" checked="checked">Title<br/>
				<input class="radio" type="radio" name="field" value="author">Author<br/>
				<input class="radio" type="radio" name="field" value="auth_title">Author/Title<br/>
				<input class="radio" type="radio" name="field" value="category">Category<br/>

				<input class="submit" type="submit" value="Search" /><br/>
			</form>

			<br><br>

			<?php
				/* Search Results */
				if (isset($_SESSION['result']))
				{
					if (mysqli_query($db, $_SESSION['sql']))
					{
					
						echo '<table class="table1" >'."\n";
						?>
						<!-- Column Titles -->
						<tr>
							<td>ISBN</td>
							<td>Title</td>
							<td>Author</td>
							<td>Edition</td>
							<td>Year</td>
							<td>Reserved</td>
						</tr>

						<?php
						$result = mysqli_query($db, $_SESSION['sql']);

						while ($row = mysqli_fetch_array($result)) {

							echo("<tr class='row'><td>");
							echo(htmlentities($row[0]));
							echo("</td><td>");
							echo(htmlentities($row[1]));
							echo("</td><td>");
							echo(htmlentities($row[2]));
							echo("</td><td>");
							echo(htmlentities($row[3]));
							echo("</td><td>");
							echo(htmlentities($row[4]));
							echo("</td><td>");

							echo('<form method="post" action="reserve.php">');
							echo('<input type="hidden" ');
							echo('name="isbn" value="' . $row[0] . '">' . "\n");

							echo('<input class="reserve" type="submit" value="Reserve" name="reserve" ');
							if($row[6] == "Y")
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
					else
					{
						die('Error: '. mysqli_error());
					}
				}
				mysqli_close($db);
			?>

			<?php
				//Include footer file
				include 'footer.html';
			?>
		</div>

	</body>
</html>