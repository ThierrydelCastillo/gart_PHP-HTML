<?php

use phpDocumentor\Reflection\Types\Boolean;

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

function select (string $name, $value, array $options): string
{
    $html_options = [];
    foreach ($options as $k => $option) {
        $attributes = $k == $value ? ' selected' : '';
        $html_options[] = "<option value='$k' $attributes>$option</option>";
    }

    return "<select class='form-control' name='$name'>" . implode($html_options) . "</select>";
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

function creneaux_html(array $creneaux)
{
    if (empty($creneaux)) {
        return 'Fermé';
    }
    $phrases = [];
    foreach ($creneaux as $creneau) {
        $phrases[] = "de <strong>{$creneau[0]}h</strong> à <strong>{$creneau[1]}h</strong>";
    }
    return 'Ouvert ' . implode(' et ', $phrases);
}

function in_creneaux (int $heure, array $creneaux): Bool
{
    foreach ($creneaux as $creneau) {
        $debut = $creneau[0];
        $fin = $creneau[1];
        if ($heure >= $debut && $heure < $fin) {
            return true;
        }
    }
    return false;
}
?>