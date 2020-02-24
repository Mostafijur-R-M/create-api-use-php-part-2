<?php
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "my_api";

	$conn = new mysqli($server, $username, $password, $dbname);

	/*if ($conn -> connect_error) {
		die("conection failed" . $conn -> connect_error);
	}
	echo "connection successfully done";*/

?>