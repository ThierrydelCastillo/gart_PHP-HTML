<?php
$erreur = null;
if(!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if($_POST['pseudo'] === 'John' && $_POST['motdepasse'] === 'Doe') {
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