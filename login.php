<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//Obriga o usuário a não estar logado
Login::requireLogout();

//Mensagens de alerta dos formulários
$alertaLogin = '';
$alertaCadastro = '';

//Validação do Post
if(isset($_POST['acao'])) {

    switch($_POST['acao']) {
        case 'logar':
            
            // Busca usuário por e-mail
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            // Valida a instancia e a senha
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) {
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }

            // Loga o usuário
            Login::login($obUsuario);

            break;

        case 'cadastrar':

            //Validação dos campos obrigatórios
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {

                // Busca usuário por e-mail
                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                if($obUsuario instanceof Usuario) {
                    $alertaCadastro = 'O e-mail digitado já está em uso';
                    break;
                }

                // Novo usuário
                $obUsuario = new Usuario;
                $obUsuario->nome = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();

                //Loga o usuário
                Login::login($obUsuario);
            }

            break;
    }
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';