<?php
$mysqli_P = new mysqli('localhost', 'AppUsrCCMP', 'AppUsrCCMP', 'mleite_portal');
$mysqli_A = new mysqli('localhost', 'AppUsrCCMP', 'AppUsrCCMP', 'ALFANDEGA');

$queryNews = "
SELECT 
	nw.uid,
	nw.type,
	nw.timestamp
FROM 
	users u 
INNER JOIN 
	node n 
    ON (n.uid = u.uid) 
INNER JOIN 
	content_type_profile ctp 
    ON (ctp.nid = n.nid 
    AND ctp.vid = n.vid)
INNER JOIN
	newsletter_subscriptions nw
	ON (u.uid = nw.uid)
WHERE n.type = 'profile'
AND nw.type != 'newsletter_gestao_patrimonio'
";

if ($result = $mysqli_P->query($queryNews)) {
	while ($obj = $result->fetch_object()) {
		insertNewsAlfandega($obj, $mysqli_A);
	}	
}

function insertNewsAlfandega ($obj, $mysqli_A) {
	$insertNewsAlfandega =<<<SQL
		INSERT INTO 
			portal_newsletter (
				fk_uid, 
				newsletter,
				user_signed
			) VALUES (
				$obj->uid,
				'$obj->type',
				$obj->timestamp
			)
SQL;
	
	var_dump($insertNewsAlfandega);

	$mysqli_A->query($insertNewsAlfandega);

}

$mysqli_P->close();
$mysqli_A->close();

?>