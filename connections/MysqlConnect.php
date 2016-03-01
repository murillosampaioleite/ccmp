<?php
$user = "AppUsrCCMP";
$pass = "AppUsrCCMP";

$mysConnection = new PDO('mysql:host=localhost;dbname=ALFANDEGA', $user, $pass);

if($mysConnection) {
	echo "connected";
} else {
	echo "deu ruim";
}
?>