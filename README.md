# PHP API client empregosevagas.com.br


## Informações básicas

Cria um simples cliente para acessar vagas de sua empresa no www.empregosevagas.com.br

## Instalação

Inclua o arquivo efetivo.php e informe as chaves geradas através do painel de gestão de empresas.

```php
<?php

include('efetivo_client.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

```

## Pegando uma lista de vagas

```php
<?php

include('efetivo_client.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

$parametros = array();
$parametros['status'] = 'all';
$parametros['limit'] = '5';
$parametros['order'] = 'alpha_asc';
$parametros['format'] = 'json';
$vagas_lista = $ev->getPositions($parametros);

$var_dump = $vagas_lista;

```


## Pegando detalhes de uma vaga

```php
<?php

include('efetivo_client.php');

$ev = new Efetivo;
$ev->setApiKey('Sua chave API-KEY');
$ev->setSecret('Sua chave API-SECRET');

$parametros = array();
$parametros['guid'] = 'INFORME A vaga_id';
$parametros['details'] = 'false';
$parametros['format'] = 'xml';
$vaga = $ev->getPosition($parametros);

$var_dump = $vaga;

```


## Documentação

Informações sobre parâmetros e métodos disponíveis na API disponíveis em: http://api.empregosevagas.com.br/docs/


