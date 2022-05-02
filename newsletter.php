<?php
    $error = null;
    $success = null;
    $email = null;
    if(!empty($_POST['email'])) {
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $success = "Votre email a bien été enregistré";
            $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
            file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
            $email = null;
        } else {
            $error = "Email invalide";
        }
    }
    require('elements' . DIRECTORY_SEPARATOR . 'header.php');
?>

<h1>S'inscrire à la New Letter</h1>

<p>
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut suscipit error ratione quod, quasi est voluptas laboriosam officia repudiandae quibusdam minus, delectus magnam quam, nam necessitatibus dicta dolor corporis unde!
</p>

<?php if($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif ?>

<?php if($success): ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif ?>

<form action="newsletter.php" method="post" class="form-inline">
    <div class="form-group">
        <input type="email" name="email" placeholder="Entrez votre email" required class="form-control" value="<?= htmlentities($email) ?>">
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>



<?php
    require('elements' . DIRECTORY_SEPARATOR . 'footer.php');
?>

<?php
    // Fonctions:
    // filter_var — Filtre une variable avec un filtre spécifique
    // htmlentities — Convertit tous les caractères éligibles en entités HTML
    // date — Formate une date/heure locale
?>