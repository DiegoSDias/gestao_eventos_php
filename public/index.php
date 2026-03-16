<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../config/config.php';

spl_autoload_register(function ($classe) {
    $caminhoRelativo = str_replace(['App\\', '\\'], ['', '/'], $classe);
    
    $arquivo = __DIR__ . '/../app/' . $caminhoRelativo . '.php';

    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});

$url = isset($_GET['url']) ? $_GET['url'] : '/';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controllerNome = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$controllerCompleto = "App\\Controllers\\" . $controllerNome;
$metodo = !empty($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

//var_dump($controllerNome); die();

// Agora usamos a variável com o caminho completo
if (class_exists($controllerCompleto)) {
    $controller = new $controllerCompleto();
    
    if (method_exists($controller, $metodo)) {
        call_user_func_array([$controller, $metodo], $params);
    } else {
        echo "Erro 404: Método '$metodo' não encontrado.";
    }
} else {
    echo "Erro 404: Controller '$controllerCompleto' não encontrado.";
}