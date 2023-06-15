<?php
require '../../vendor/autoload.php';

use App\App;

session_start();
$error = false;
$auth = App::getAuth();

/*
if($auth->user() != null) {
    header('Location: index.php');
    exit();
}
*/

if(!empty($_POST)){
    $auth = App::getAuth();
    $user = $auth->login($_POST['username'], $_POST['password']);
    if($user){
        header('Location: index.php?login=1');
        exit();
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Se connecter</title>
</head>
<body class="p-4">
    <h1>Se connecter</h1>

    <?php if($error): ?>
        <div class="alert alert-danger">
            Identifiant ou mot de passe incorrect
        </div>
    <?php endif ?>

    <?php if(isset($_GET['forbid'])): ?>
        <div class="alert alert-danger">
           L'accès à la page vous est refusé
        </div>
    <?php endif ?>

    <form method="post">
        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="pseudo">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Mot de passe">
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
</body>
</html>