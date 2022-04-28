<?php
$fichier = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'laposte_hexasmal.csv';

// Ecrire dans un fichier
/*
$size = file_put_contents($fichier, ' marc comment ca va ?'  . "\n\r", FILE_APPEND);    // @ permet de ne pas log l'erreur
if ($size === false) {
    echo "impossible d'écrire dans le fichier \n\r";
} else {
    echo "Ecriture réussie \n\r";
}
*/
// lire le fichier
//echo file_get_contents($fichier) . "\n\r";


$ressource = fopen($fichier, 'r'); // Accès à un fichier en lecture seulement
//echo fread($ressource, 10); // lit les 10 premiers octets du fichier. Utile pour lire un seul octet


//lecture fichier ligne par ligne
$k = 0;
while ($line = fgets($ressource)) {
    $k++;
    if ($k == 3) {
        echo $line;
        break;
    }
}
fclose($ressource); // Ferme le fichier en mémoire

// Fonctions vues:
// @ devant une fonction empeche le retour des erreurs
// dirname — Renvoie le chemin du dossier parent
// file_put_contents — Écrit des données dans un fichier
// file_get_contents — Lit tout un fichier dans une chaîne
// file — Lit le fichier et renvoie le résultat dans un tableau
// fgets — Récupère la ligne courante à partir de l'emplacement du pointeur sur fichier
// fstat — Lit les informations sur un fichier à partir d'un pointeur de fichier
// fseek — Modifie la position du pointeur de fichier
// fwrite — Écrit un fichier en mode binaire
// fclose — Ferme un fichier

// Constantes prédéfinies (https://www.php.net/manual/fr/reserved.constants.php):
// DIRECTORY_SEPARATOR (https://www.php.net/manual/fr/dir.constants.php#dir.constants)
