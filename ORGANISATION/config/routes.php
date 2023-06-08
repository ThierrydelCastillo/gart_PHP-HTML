<?php
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