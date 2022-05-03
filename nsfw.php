<?php
    $age = null;
    
    if (!empty($_POST['birthday'])) {
        setcookie('birthday', $_POST['birthday']);
        $_COOKIE['birthday'] = $_POST['birthday'];
    }
    if (!empty($_COOKIE['birthday'])) {
        $birthday = (int)$_COOKIE['birthday'];
        $age = (int)date('Y') - $birthday;
    }
    
    require('elements' . DIRECTORY_SEPARATOR . 'header.php');
?>
<?php
// demander à l'utilisateur sa date de naissance (select 2000 à 1919)
// Persister la date de naissance dans un cookie
// Si l'utilisateur est assez agé lui montrer le contenu
// sinon on affiche un message d'erreur

?>

<?php if ($age >= 18): ?>
    <h1>Vous avez accès au contenu</h1>
<?php elseif ($age !== null): ?>
    <div class="alert alert-danger">Vous n'avez pas l'âge requis pour voir le contenu</div>
<?php else: ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="birthday">Section réservée aux adultes, entrez votre année de naissance</label>
            <select name="birthday" id="birthday" class="form-control">
                <?php for($i = 2010; $i > 1919; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
            </select>
        </div>
        <button class="btn btn-primary">Valider</button>
    </form>
<?php endif ?>


<?php
    require('elements' . DIRECTORY_SEPARATOR . 'footer.php');
?>