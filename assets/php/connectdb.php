<?php
	$servername = "localhost";
	$username = "root";
	$password = '';
	$dbname = "ski_academicprofile";

	$conn = mysqli_connect($servername, $username, $password, $dbname)or die(mysqli_connect_error());

//     $conn = mysqli_init();
//     mysqli_ssl_set($conn,NULL,NULL, "assets/certs/DigiCertGlobalRootCA.crt.pem", NULL, NULL); 
//     mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL);

//     if (mysqli_connect_errno($conn)) {
//         die('Failed to connect to MySQL: '.mysqli_connect_error());
//     }
?>
  
