<?php
    $nom = null;
    $user = [
        'prenom' => 'John',
        'nom' => 'Doe',
        'age' => 18
    ];
    setcookie('utilisateur', serialize($user));

    if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter' ) {
        unset($_COOKIE['utilisateur']);
        setcookie('utilisateur', '', time() - 10);
    }
    if (!empty($_COOKIE['utilisateur'])) {
        $nom = $_COOKIE['utilisateur'];
    }
    if (!empty($_POST['nom'])) {
        setcookie('utilisateur', $_POST['nom']);
        $nom = $_POST['nom'];
    }
    require('elements' . DIRECTORY_SEPARATOR . 'header.php');
?>

<?php if (!empty($nom)): ?>
    <h1>Bonjour <?= htmlentities($nom) ?></h1>
    <a href="profil.php?action=deconnecter">Se déconnecter</a>
<?php else: ?>
    <form action="" method="post">
        <div class="form-group">
            <input class="form-control" name="nom" placeholder="Entrez votre nom">
            <button class="btn btn-primary">Se connecter</button>
        </div>
    </form>
<?php endif ?>



<?php
    require('elements' . DIRECTORY_SEPARATOR . 'footer.php');
?>

<?php
    // FONCTIONS
    // setcookie — Envoie un cookie
    // unset — Détruit une variable
    // serialize — Génère une représentation stockable d'une valeur
    // unserialize — Crée une variable PHP à partir d'une valeur linéarisée