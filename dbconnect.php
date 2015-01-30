<?php
	/* PHP used to connect to database on each page of the site */
	
	//login
	$db = mysqli_connect('localhost', 'root', '','library') ;

	//error checking
	if(mysqli_connect_errno($db))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>