<?php

  use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();

  $usuario = $usuarioLogado ? 
             $usuarioLogado['nome'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' :
             'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <title>WDEV Vagas</title>
  </head>
  <body class="bg-dark text-light">
      <div class="container">

        <div class="jumbotron bg-danger">
            <h1>WDEV Vagas</h1>
            <p>Painel simples orientados a objetos</p>

            <hr class="border-light">

            <div class="d-flex justify-content-start">
              <?=$usuario?>
            </div>
        </div>

   