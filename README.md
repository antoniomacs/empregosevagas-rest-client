## PHP API REST client EFETIVO - Empregos e vagas


## Informações básicas

Cria um cliente REST para acessar vagas de uma empresa cadastradas no www.empregosevagas.com.br

## Instalação

Inclua o arquivo efetivo.php e informe as chaves geradas através do painel de gestão de empresas.

```php
<?php

require_once('efetivo.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

```

## Pegando uma lista de vagas

```php
<?php

require_once('efetivo.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

$parametros = array();
$parametros['status'] = 'all';
$parametros['limit'] = '5';
$parametros['order'] = 'alpha_asc';
$parametros['format'] = 'json';
$vagas_lista = $ev->getPositions($parametros);

echo $vagas_lista;

```


## Pegando detalhes de uma vaga

```php
<?php

require_once('efetivo.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

$parametros = array();
$parametros['guid'] = 'INFORME vaga_id';
$parametros['details'] = 'no';
$parametros['format'] = 'xml';
$vaga = $ev->getPosition($parametros);

echo $vaga;

```


## Documentação

Informações sobre parâmetros e métodos disponíveis na API disponíveis em: http://api.empregosevagas.com.br/docs/


