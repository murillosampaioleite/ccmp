<?php
require_once('connections/MysqlConnect.php');

$queryPortal = "
SELECT 
	u.uid,
    mail,
    field_profile_nome_value,
    field_profile_cpf_value,
    field_profile_cnpj_value,
	field_profile_sexo_value, 	
	field_profile_estado_civil_value,
	field_profile_nascimento_value,
    field_profile_cep_value,
    field_profile_endereco_value,
    field_profile_numero_endereco_value,
    field_profile_bairro_value,
    field_profile_cidade_value
    field_profile_estado_value,
    n.vid,
    ctp.nid,
    field_profile_num_contrato_value
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



