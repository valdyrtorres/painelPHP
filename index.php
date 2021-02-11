<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;

//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

//FILTRO DE STATUS
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus, ['s', 'n']) ? $filtroStatus : '';

//echo "<pre>";
//print_r($filtroStatus);
//echo "</pre>";

//Condições SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ', '%', $busca).'%"' : null,
    strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

//Remove posições vazias
$condicoes = array_filter($condicoes);

//Cláusula Where
$where = implode(' AND', $condicoes);

// Quantidade total de vagas
$quantidadeVagas = Vaga::getQuantidadeVagas($where);

// Paginação
$obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);
// echo "<pre>";
// print_r($obPagination->getLimit());
// echo "</pre>"; exit;

//Obtem as vagas
$vagas = Vaga::getVagas($where, null, $obPagination->getLimit());

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';