<?php 

function nav_item (string $lien, string $titre, string $linkClass = ''): string 
{
    $classe = "nav-item";
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe .= ' active';
    }
    /* Utilisation de Heredoc (<<< puis un identifiant) pour un code html plus clair */
    return <<<HTML
    <li class="$classe">
        <a class="$linkClass" href="$lien">$titre</a>
    </li>
HTML; // Heredoc: ATENTION à n'avoir aucun caractère (espace, tab, etc...) avant l'identifiant 
}

function nav_menu (string $linkClass = ''): string
{
    return
        nav_item('/index.php', 'Accueil', $linkClass) .
        nav_item('/contact.php', 'Contact', $linkClass);
}
?>