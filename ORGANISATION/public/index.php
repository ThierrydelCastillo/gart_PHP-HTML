<?php
require '../../vendor/autoload.php';
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter(); // https://github.com/dannyvankooten/AltoRouter
require '../config/routes.php';

$match = $router->match();
if(is_array($match)){
    if(is_callable($match['target'])) {
        // $match['target']($match['params']['a'], $match['params']['b']);  // erreur si pas params vide
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        // ob_start();
        $pageContent = require "../templates/{$match['target']}.php";
        // $pageContent = ob_get_clean();
    }
    require '../elements/layout.php';
} else {
    echo '404';
}