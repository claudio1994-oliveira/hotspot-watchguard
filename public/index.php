<?php

require __DIR__ . '/../vendor/autoload.php';

//Carregando minhas variaveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


isset($_SERVER['REDIRECT_URL']) ? $path = $_SERVER['REDIRECT_URL'] : $path = "/hotspot";


$routes = require __DIR__ . '/../routes/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);

    $path = "/404";
}


session_start();


$classCrontoller = $routes[$path];

$controller = new $classCrontoller[0]();

//$_SERVER['REQUEST_METHOD'] 

$method = $classCrontoller[1];

$controller->$method();