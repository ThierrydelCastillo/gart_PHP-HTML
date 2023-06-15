<?php
require '../../vendor/autoload.php';

$user = App\App::getAuth()->requireRole('admin');
?>

Réservé à l'admin