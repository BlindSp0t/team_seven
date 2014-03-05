<?php

# include this file in every page that requires a connection to the MySQL Database.
# define user pass and connection variables to access localhost database

define("DB_DATA_SOURCE","mysql:host=localhost;dbname=teamseven");
define("DB_USER","u1253064");
define("DB_PASS","13dec93");

# connect to the database via PDO 
try {
    $conn = new PDO(DB_DATA_SOURCE,DB_USER,DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
# catch and display error message 	
} catch(PDOException $e) {
    echo 'Oh dear. There was an error: ' . $e->getMessage();
}
?>
