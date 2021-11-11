<?php
	$servername = "ski-academicprofiledbf.mysql.database.azure.com";
	$username = "skiadmindb";
	$password = 'Pk@s12345';
	$dbname = "ski_academicprofile";

    $conn = mysqli_init();
    mysqli_ssl_set($conn,NULL,NULL, "assets/certs/DigiCertGlobalRootCA.crt.pem", NULL, NULL); 
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL);

    if (mysqli_connect_errno($conn)) {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
?>
  