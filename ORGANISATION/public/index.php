<?php
require '../../vendor/autoload.php';
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter(); // https://github.com/dannyvankooten/AltoRouter

$router->map('GET', '/', 'home');
$router->map('GET', '/nous-contacter', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/bonjour', function () { // passage d'une closure (fonction anonyme) sans parametres 
    echo "bonjour";
});
$router->map('GET', '/addition/[i:a]-[i:b]', function ($a, $b) { // passage d'une closure (fonction anonyme) avec parametres 
    $result = $a + $b;
    echo "$a + $b = $result";
});

$match = $router->match();
if(is_array($match)){
    require '../elements/header.php';
    if(is_callable($match['target'])) {
        // $match['target']($match['params']['a'], $match['params']['b']);  // erreur si pas params vide
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../templates/{$match['target']}.php";
    }
    require '../elements/footer.php';
} else {
    echo '404';
}