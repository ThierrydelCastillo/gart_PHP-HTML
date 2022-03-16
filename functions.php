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

function checkbox (string $name, string $value, array $data): string
{
    $attributes = '';
    if (isset($data[$name]) && in_array($value, $data[$name])) {
        $attributes .= 'checked';
    }
    
    return <<<HTMl
    <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTMl; 
}

function radio (string $name, string $value, array $data): string
{
    $attributes = '';
    if (isset($data[$name]) && $value === $data[$name]) {
        $attributes .= 'checked';
    }
    
    return <<<HTMl
    <input type="radio" name="{$name}" value="$value" $attributes>
HTMl; 
}

function inputCheckbox (bool $type, string $name, array $options): string
{
    $type ? $type = "checkbox" : $type = "radio";
    $html = '<div class="form-group">';
    foreach ($options as $option) {
        $html .= '<input type="'. $type . '" name="' . $name . '[]" value="'. $option .'"> ' . $option .'<br>';
    }
    $html .= '</div>';

    return $html;
}

?>