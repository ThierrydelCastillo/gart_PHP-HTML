<?php

use App\NumberHelper;
use App\QueryBuilder;
use App\TableHelper;
use App\URLHelper;
use App\Table;

define('PER_PAGE', 20);

require '../../vendor/autoload.php';
$pdo = new PDO('sqlite:../data/products.db', null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$query = (new QueryBuilder($pdo))->from('products');

//rechercher par ville
if(!empty($_GET['q'])) {
    $query
        ->where('city LIKE :city')
        ->setParam('city', '%' . $_GET['q'] . '%');
}

$table = (New Table($query, $_GET))
    ->sortable('id', 'city', 'price')
    ->format('price', function ($value) {
        return NumberHelper::price($value);
    })
    ->columns([
        'id' => 'ID',
        'name' => 'Nom',
        'city' => 'Ville',
        'price' => 'Prix'
    ]);

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

    <?= $table->render() ?>

</body>
</html>