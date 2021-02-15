<?php

namespace App\Session;

class Login {
    // Nessa classe não vale a pena criar instâncias

    /**
     * Método responsável por iniciar a sessão
     *
     * @return void
     */
    private static function init() {

        // Verifica o status da sessão
        if(session_status() !== PHP_SESSION_ACTIVE) {
            // Inicia a Sessão
            session_start();
        }
    }

    public static function getUsuarioLogado() {
        // Inicia a sessão
        self::init();   
        
        // Retorna dados do usuário
        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Método responsável por logar o usuário
     * @param Usuario $obUsuario
     */
    public static function login($obUsuario) {
        // Inicia a sessão
        self::init();

        //Sessão de usuário
        $_SESSION['usuario'] = [
            'id'    => $obUsuario->id,
            'nome'  => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        // Redireciona usuario para index
        header('location: index.php');
        exit;

    }

    /**
     * Método responsável por deslogar o usuário
     */
    public static function logout() {
        // Inicia a sessão
        self::init();   
        
        // Remove a sessão de usuário
        unset($_SESSION['usuario']);

        // Redireciona usuário para login
        header('location: login.php');
        exit;
    }

    /**
     * Método responsável por verificar se o usuário está ogado
     * @return boolean
     */
    public static function isLogged() {
        // Inicia a sessão
        self::init();

        //Validação da sessão
        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método responsável por obrigar o usuário a estar logado para acessar
     */
    public static function requireLogin() {
        if(!self::isLogged()) {
            header('location: login.php');
            exit;
        }
    }

    /**
     * Método responsável por obrigar o usuário a estar deslogado para acessar
     */
    public static function requireLogout() {
        if(self::isLogged()) {
            header('location: index.php');
            exit;
        }
    }
}