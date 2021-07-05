<?php
// SQL Konfiguration
define( 'DBSERVER', 'localhost' ); // in der Regel localhost, ausser der Server liegt nicht da wo das PHP Script liegt
define( 'DBUSER', 'root' ); 
define( 'DBPASSWORT', 'root' ); // root für MAMP
define( 'DBNAME', 'fooddoze' ); 

define( 'SESSION_EXPIRY', 5 );

$connection = mysqli_connect(DBSERVER, DBUSER, DBPASSWORT, DBNAME) OR die('Connection error: '.mysqli_connect_error());

define( 'IMAGEFOLDER', './img/' );
define( 'IMAGEFOLDERPATH', 'Applications\MAMP\htdocs\00_sae\01_projekte\fooddoze\img' );
?>