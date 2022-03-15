<?php
	$database_servername= "localhost";
	$database_username= "root";
	$database_password= "";
	$database_name= "reservation_db";

	$database_connection= mysqli_connect($database_servername, $database_username, $database_password, $database_name);

	if (!$database_connection)
	{
		echo "Connection Failed!";
	}
?>