<?php 
$server = 'sv-cirdev';
$username = 'AppUsrCCMP';
$password = 'AppUsrCCMP';
$database = 'CIR2000_VALOR';
$connection = mssql_connect($server, $username, $password);
 
if($connection != FALSE) { 
	echo "Connected to the database server OK<br />";
}else {
	die("Couldn't connect");
}
 
if(mssql_select_db($database, $connection)) {
	echo "Selected $database ok<br />";
}else {
	die('Failed to select DB');
}





$query_result = mssql_query('SELECT @@VERSION');
$row = mssql_fetch_array($query_result);
 
if($row != FALSE) {
	echo "Version is {$row[0]}<br />";
}
mssql_free_result($query_result);
mssql_close($connection);
