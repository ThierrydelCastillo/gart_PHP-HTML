<h1>Ma homepage</h1>

<ul>
    <li><a href="<?= $router->generate('contact') ?>">Nous contacter</a></li>
    <li><a href="<?= $router->generate('article', ['id' => 60, 'slug' => 'importe-quoi']) ?>">Voir un article</a></li>
</ul>

