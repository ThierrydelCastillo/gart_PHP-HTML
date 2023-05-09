<?php
$erreur = null;
$password = '$2y$14$M9bfowwk6e5N8x3vJOUSi..X0C88PLg3uTPlb.Fr9mDSFu0NpAZsO';
if(!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if($_POST['pseudo'] === 'John' && password_verify($_POST['motdepasse'], $password)) {
        session_start();
        $_SESSION['connecte'] = 1;
        header('Location: /dashboard.php');
        exit();
    } else {
        $erreur = 'Identifiants incorrects';
    }
}

require_once 'functions/auth.php';
if(est_connecte()) {
    header('Location: /dashboard.php');
    exit();
}

require_once 'elements' . DIRECTORY_SEPARATOR. 'header.php';


?>

<?php if($erreur): ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php endif ?>

<form method="post">
    <div class="form-group">
        <input class="form-control" type="text" name=pseudo placeholder="Entrer votre nom d'utilisateur">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="motdepasse" placeholder="Entrez votre mot de passe">
    </div>
    <button class="btn btn-primary">Se connecter</button>
</form>



<?php require 'elements' . DIRECTORY_SEPARATOR. 'footer.php' ?>