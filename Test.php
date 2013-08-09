<?php

header("Content-type: text/xml; charset=utf-8");

require_once('efetivo.php');

$ev = new Efetivo();
$ev->setApiKey('_SUA_CHAVE_API_');
$ev->setSecret('_SUA_CHAVE_SECRETA_');

$parametros = array();
$parametros['status'] = 'all';
$parametros['limit'] = '10';
$parametros['order'] = 'alpha_asc';
$parametros['format'] = 'xml';
$vagas_lista = $ev->getPositions($parametros);


echo $vagas_lista;

/*
$parametros = array();
$parametros['guid'] = '__UMA_ID_DE_VAGA__';
$parametros['details'] = 'false';
$parametros['format'] = 'xml';
$vaga = $ev->getPosition($parametros);
*/


/*
echo '<pre>'.var_dump($vaga).'</pre>';
echo '<pre>'.var_dump($vagas_lista).'</pre>';
*/

?>
