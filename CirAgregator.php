<?php 
require_once('connections/MssqlConnect.php');

$queryDebAuto = '
SELECT 
TOP 1 *
FROM 			
[CIR2000_VALOR].[DBO].[CADASTRO_PESSOA] AS CP
INNER JOIN	
[CIR2000_VALOR].[DBO].[CONTRATO_ASSINANTE] AS CA
ON
CP.CD_CONTABIL_PESSOA = CA.CD_CONTABIL_PESSOA
INNER JOIN
[CIR2000_VALOR].[DBO].[PERIODO_ASSINANTE] AS PA
ON
CA.CD_CONTABIL_PESSOA	=	PA.CD_CONTABIL_PESSOA
AND	CA.NU_SERIE_CTR			=	PA.NU_SERIE_CTR
AND	CA.NU_CTR				=	PA.NU_CTR
AND	CA.NU_DV_CTR			=	PA.NU_DV_CTR
AND	CA.NU_PERIODO_ATUAL		=	PA.NU_PERIODO
INNER JOIN
[CIR2000_VALOR].[DBO].[PLANO_COMERCIAL] AS PC
ON
PA.CD_PLANO = 	PC.CD_PLANO
INNER JOIN
[CIR2000_VALOR].[DBO].[FORMA_PAGAMENTO] as FP
ON
pc.CD_FORMA_PAG = fp.CD_FORMA_PAG
INNER JOIN
[CIR2000_VALOR].[DBO].[TMP_ARQUIVO_DEBITO_RECIBO] as DC
on
DC.NU_RECIBO = pa.NU_RECIBO
INNER JOIN
[CIR2000_VALOR].[DBO].[DEBITO_CONTA_CORRENTE] as CC
on
CC.CD_CONTABIL_PESSOA = ca.CD_CONTABIL_PESSOA
inner join
[CIR2000_VALOR].[DBO].[RECIBO_ASSINANTE] as RA
on
RA.NU_RECIBO = PA.NU_RECIBO
and RA.CD_CONTABIL_PESSOA	=	PA.CD_CONTABIL_PESSOA
AND	RA.NU_SERIE_CTR			=	PA.NU_SERIE_CTR
AND	RA.NU_CTR				=	PA.NU_CTR
AND	RA.NU_DV_CTR			=	PA.NU_DV_CTR	
inner join
[CIR2000_VALOR].[DBO].[CANAL_VENDA] as CV
on
cv.CD_CANAL = PA.CD_CANAL
';

echo searchMss($queryDebAuto);



function searchMss($queryMss) {
	$queryMssResult = mssql_query($queryMss);
	$row = mssql_fetch_array($queryMssResult);

	if($row != FALSE) {
		print_r($row);
	}
}