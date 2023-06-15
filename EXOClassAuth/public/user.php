<?php
require '../../vendor/autoload.php';

$user = App\App::getAuth()->requireRole('user', 'admin');
?>

Réservé à l'utilisateur