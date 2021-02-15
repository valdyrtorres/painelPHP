<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Session\Login;

//Obriga o usuário a estar logado
Login::requireLogin();

// VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

// CONSULTA A VAGA
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDAÇÃO DA VAGA
if(!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}

// debug
//echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

//Validação do POST
if(isset($_POST['excluir'])) {

    $obVaga->excluir();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';