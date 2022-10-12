<?php
	$servername = "node106155-youcraft.w1-us.cloudjiffy.net";
	$username = "root";
	$password = "XBYyqs07257";
	
	// Creating connection
	$conn = mysqli_connect($servername, $username, $password);
	// Checking connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Creating a database named newDB
	$sql = "CREATE DATABASE IF NOT EXISTS `blockchaindb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
	if (mysqli_query($conn, $sql)) {
		// echo "Database created successfully with the name newDB";
		$sql2 = "USE `blockchaindb`";
		if (mysqli_query($conn, $sql2)) {}
	} else {
		echo "Error creating database: " . mysqli_error($conn);
	}
	
	// closing connection
	mysqli_close($conn);
	define("DB_HOST", 'node106155-youcraft.w1-us.cloudjiffy.net');
	define("DB_USER", 'root');
	define("DB_PASS",'XBYyqs07257');
	define("DB_NAME", 'blockchaindb');
 ?>

