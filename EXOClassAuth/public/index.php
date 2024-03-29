<?php
use App\App;

require '../../vendor/autoload.php';

$users = App::getPDO()->query('SELECT * FROM users')->fetchAll();
$user = App::getAuth()->user();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Classe authentification</title>
</head>
<body class="p-4">

    <h1>Accèder aux pages</h1>

    <?php if(isset($_GET['login'])): ?>
        <div class="alert alert-success">Vous êtes bien identifié</div>
    <?php endif ?>

    <?php if($user): ?>
        <p>
            Vous êtes connecté en tant que <?= $user->username ?> - 
            <a href="logout.php">Se déconnecter</a>
        </p>
    <?php endif ?>

    <ul>
        <li><a href="admin.php">Page réservée à l'administrateur</a></li>
        <li><a href="user.php">Page réservée à l'utilisateur</a></li>
    </ul>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['role'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>