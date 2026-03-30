<?php

namespace App\Core;

abstract class Controller {

    public function view(string $nomeDaView, array $dados = []) {
        extract($dados);

        $arquivo = "../resources/views/./{$nomeDaView}.php";

        if (file_exists($arquivo)) {
            require_once $arquivo;
        } else {
            die("Erro: A view '{$nomeDaView}' não foi encontrada!");
        }
    }

    protected function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL_BASE . "user/login");
            exit();
        }
    }

    protected function checkNotAuth() {
        if (isset($_SESSION['user_id'])) {
            header("Location: " . URL_BASE . "home/index");
            exit();
        }
    }

    protected function redirect(string $rota) {
        header("Location: " . URL_BASE . ltrim($rota, '/'));
        exit();
    }
}