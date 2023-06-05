<?php
declare(strict_types = 1); // Pour activer la gestion de erreur PHP ligne 12
require_once 'vendor/autoload.php';
$weather = new App\OpenWeather('ENTRER_APIKEY_ICI'); // Pour obtenir une APIKEY : https://openweathermap.org/api
$error = null;
try {
    // $data = explode(' '); // génère une erreur PHP récupérée par le catch
    $forecast = $weather->getForecast('Montpellier,fr');
    $today = $weather->getToDay('Montpellier,fr');
} catch (Exception | Error $e) {
    $error = $e->getMessage();
}

// [
//     [
//         'temp' => 5.03,
//         'description' => "...",
//         'date' => DateTime()
//     ]
// ]

require 'elements/header.php';
?>

<?php if($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php else: ?>
    <div class="container">
        <ul>
            <li>En ce moment <?= $today['description']?> <?= $today['temp']?>°C</li>
            <?php foreach($forecast as $day): ?>
            <li><?= $day['date']->format('d/m/Y')?> <?= $day['description']?> <?= $day['temp']?>°C</li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
<?php require 'elements/footer.php' ?>