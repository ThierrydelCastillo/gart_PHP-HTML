<?php

use App\NumberHelper;
use App\TableHelper;
use App\URLHelper;

define('PER_PAGE', 20);

require '../vendor/autoload.php';
$pdo = new PDO('sqlite:./data/products.db', null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$query ='SELECT * FROM products';
$queryCount = 'SELECT COUNT(id) as count FROM products';
$params = [];
$sortable = ['id', 'name', 'price', 'city', 'address'];

//rechercher par ville
if(!empty($_GET['q'])) {
    $query .=" WHERE city LIKE :city";
    $queryCount .= " WHERE city LIKE :city";
    $params['city'] = '%' . $_GET['q'] . '%';
}

//Tri
if(!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
    $direction = $_GET['dir'] ?? 'asc';
    if(!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc';
    }
    $query .= " ORDER BY " . $_GET['sort'] . " $direction ";
}

//Pagination
$numPage = (int)($_GET['p']?? 1);
$offset = ($numPage - 1) * PER_PAGE;

//requete
$query .= ' LIMIT ' . PER_PAGE . " OFFSET $offset";
$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();

// $count = (int)$pdo->query('SELECT COUNT(id) as count FROM products')->fetch()['count'];
$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$count = $statement->fetch()['count'];
$numberPages = ceil($count / PER_PAGE);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biens immobiliers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="p-4">
    <h1>Les biens immobiliers</h1>
    <form class="mb-4">
        <div class="form-group">
            <input type="text" class="form-control" name="q" placeholder="Rechercher par ville" value="<?= $_GET['q'] ?? '' ?>">
        </div>
        <button class="btn btn-primary">Rechercher</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= TableHelper::sort('id', 'ID', $_GET) ?></th>
                <th><?= TableHelper::sort('name', 'Nom', $_GET) ?></th>
                <th><?= TableHelper::sort('price', 'Prix', $_GET) ?></th>
                <th><?= TableHelper::sort('city', 'Ville', $_GET) ?></th>
                <th><?= TableHelper::sort('address', 'Adresse', $_GET) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
            <tr>
                <td>#<?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= NumberHelper::price($product['price']) ?></td>
                <td><?= $product['city'] ?></td>
                <td><?= $product['address'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php if($numberPages > 1 && $numPage > 1): ?>
        <a href="?<?= URLHelper::withParam($_GET, 'p', $numPage - 1) ?>" class="btn btn-primary">Page précédente</a>
    <?php endif ?>

    <?php if($numberPages > 1 && $numPage < $numberPages): ?>
        <a href="?<?= URLHelper::withParam($_GET, 'p', $numPage + 1) ?>" class="btn btn-primary">Page suivante</a>
    <?php endif ?>

</body>
</html>