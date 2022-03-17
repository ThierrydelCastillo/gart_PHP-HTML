<?php 
    require_once('config.php');
    require_once('bootstrap.php');
    require_once('functions.php');
    $title = "Nous contacter";
    $nav = "contact";
    // Récupérer l'heure d'aujourd'hui $heure
    date_default_timezone_set('Europe/Paris');
    $heure = (int)($_GET['heure'] ?? (int)date('G'));
    $jour = (int)($_GET['jour'] ?? date('N') - 1);
    // Récupérer les créneaux d'aujourd'hui $creneaux
    $creneaux = CRENEAUX[$jour];
    // Récupérer l'état d'ouverture du magasin
    $ouvert = in_creneaux($heure, $creneaux);
    $color = $ouvert ? 'green' : 'red';
    // $color = 'green';
    // if (!$ouvert) { $color = "red"; }
    require('header.php');
?>

<div class="row">
    <div class="col-md-8">
        <h2>Nous contacter</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores voluptate aspernatur perferendis ipsum porro, architecto magni dicta, voluptatibus aliquam nam et molestias. Natus rerum maxime, cum error eaque sint quod!</p>
    </div>
    <div class="col-md-4">
        <h2>Horaires d'ouverture</h2>
        
        <?php if($ouvert): ?>
            <div class="alert alert-success">
                Le magasin sera ouvert
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Le magasin sera fermé
            </div>
        <?php endif ?>

        <form>
            <div class="form-group">
                <?= select('jour', $jour, JOURS) ?>
                
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure ?>"> 
            </div>
            <button class="btn btn-primary">Voir si le magasin est ouvert</button>
        </form>
        
        <ul>
            <?php foreach (JOURS as $k => $jour): ?>
                <li>
                    <strong><?= $jour ?></strong> : 
                    <?= creneaux_html(CRENEAUX[$k]) ?>
                </li>
            <?php endforeach ?>
        </ul>
        
    </div>
</div>

<?php require('footer.php') ?>