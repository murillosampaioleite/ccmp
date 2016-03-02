<?php
//Alfandega Connection
$host_A = "localhost";
$user_A = "AppUsrCCMP";
$pass_A = "AppUsrCCMP";
$database_A = "ALFANDEGA";

$mysqlConnectionAlfandega = mysqli_connect($host_A, $user_A, $pass_A, $database_A);

if($mysqlConnectionAlfandega){ echo "Connected Alfandega"; }

//Portal Connection
$host_P = "10.30.0.138:3307";
$user_P = "mleite";
$pass_P = "valor123";
$database_P = "mleite_portal";

$mysqlConnectionPortal = mysqli_connect($host_P, $user_P, $pass_P, $database_P);

if($mysqlConnectionPortal) { echo "connected Portal"; }

?>