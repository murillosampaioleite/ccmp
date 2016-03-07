<?php

$mysqli_P = new mysqli('localhost', 'AppUsrCCMP', 'AppUsrCCMP', 'mleite_portal');
$mysqli_A = new mysqli('localhost', 'AppUsrCCMP', 'AppUsrCCMP', 'ALFANDEGA');

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$query = "
SELECT
	u.uid,
    mail,
    field_profile_nome_value as nome,
    field_profile_cpf_value as cpf,
    field_profile_cnpj_value as cnpj,
	field_profile_sexo_value as sexo,
	field_profile_estado_civil_value as estado_civil,
	field_profile_nascimento_value as data_nascimento,
    field_profile_cep_value as cep,
    field_profile_endereco_value as endereco,
    field_profile_numero_endereco_value as numero_endereco,
    field_profile_bairro_value as bairro,
    field_profile_cidade_value as cidade,
    field_profile_estado_value as estado,
    n.vid,
    ctp.nid,
    field_profile_num_contrato_value as num_contrato
FROM
	users u
INNER JOIN
	node n
    ON (n.uid = u.uid)
INNER JOIN
	content_type_profile ctp
    ON (ctp.nid = n.nid
    AND ctp.vid = n.vid)
WHERE n.type = 'profile'
";

if ($result = $mysqli_P->query($query)) {
	while ($obj = $result->fetch_object()) {
		insertUserAlfandega($obj, $mysqli_A);
	}
}

function insertUserAlfandega ($obj, $mysqli_A) {
	$insertAlfandegaPortal = <<<SQL
		INSERT INTO
			portal_users (
				uid,
				email,
				nome,
				cpf,
				cnpj,
				sexo,
				estado_civil,
				dt_nascimento,
				cep,
				endereco,
				num_endereco,
				bairro,
				cidade,
				uf,
				vid,
				nid,
				num_contrato
			)
			VALUES (
				$obj->uid,
				"$obj->mail",
				"$obj->nome",
				"$obj->cpf",
				"$obj->cnpj",
				"$obj->sexo",
				"$obj->estado_civil",
				"$obj->data_nascimento",
				"$obj->cep",
				"$obj->endereco",
				"$obj->numero_endereco",
				"$obj->bairro",
				"$obj->cidade",
				"$obj->estado",
				$obj->vid,
				$obj->nid,
				"$obj->num_contrato"
			)
SQL;
	$mysqli_A->query($insertAlfandegaPortal);
}

$mysqli_P->close();
$mysqli_A->close();

?>