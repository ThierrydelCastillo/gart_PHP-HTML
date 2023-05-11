<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';
$creneau = new Creneau(14, 19);
$creneau->debut = 9;
$creneau->fin = 12;
$creneau2 = new Creneau(9, 12);
var_dump(
    $creneau->intersect($creneau2)
);
echo $creneau->toHTML();