<?php
    require('elements' . DIRECTORY_SEPARATOR . 'header.php');
?>

<?php
    $title = "Notre Menu";
    $nav = "menu";

    // $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv';
    $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.csv';

    // $menu = file_get_contents($fichier, 'r');
    // $lignes = explode(PHP_EOL, $menu);
    $lignes = file($fichier);
    
    $menu = [];
    foreach ($lignes as $k => $ligne) {
        // pour fichier .tsv
        // $lignes[$k] = explode("\t", trim($ligne)); // Réecrit chaque ligne du tableau

        //pour fichier .csv
        $lignes[$k] = str_getcsv(trim(($ligne), " \t\n\r\0\x0B,"));  // Réecrit chaque ligne du tableau
    }
?>

<h1>MENU</h1>

<?php foreach($lignes as $ligne): ?>
    <?php if(count($ligne) === 1): ?>
        <h2><?= $ligne[0] ?></h2>
    <?php else: ?>
        <div class="row">
            <div class="col-sm-8">
                <p>
                    <strong><?= $ligne[0] ?></strong><br>
                    <?= $ligne[1] ?>
                </p>
            </div>
            <div class="col-sm-4">
                <strong><?= number_format($ligne[2], 2, ',', ' ') ?> €</strong>
            </div>
        </div>
    <?php endif ?>
<?php endforeach ?>


<?php
    require('elements' . DIRECTORY_SEPARATOR . 'footer.php');
?>

<?php
    // Fonctions:
    // explode — Scinde une chaîne de caractères en segments
    // file — Lit le fichier ligne par ligne et renvoie le résultat dans un tableau
    // trim — Supprime les caractères invisibles en début et fin de chaîne
    // count — Compte tous les éléments d'un tableau ou dans un objet Countable
    // number_format — Formate un nombre pour l'affichage
    // str_getcsv — Analyse une chaîne de caractères CSV dans un tableau

    // Constantes prédéfinies (https://www.php.net/manual/fr/reserved.constants.php):
    // PHP_EOL (string) - Le bon symbole de fin de ligne pour cette plateforme.
?>