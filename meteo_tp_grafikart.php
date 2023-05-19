<?php
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('ENTRER_APIKEY_ICI'); // Pour obtenir une APIKEY : https://openweathermap.org/api
$forecast = $weather->getForecast('Montpellier,fr');
$today = $weather->getToDay('Montpellier,fr');
// [
//     [
//         'temp' => 5.03,
//         'description' => "...",
//         'date' => DateTime()
//     ]
// ]

require 'elements/header.php';
?>

<div class="container">
    <ul>
        <li>En ce moment <?= $today['description']?> <?= $today['temp']?>°C</li>
        <?php foreach($forecast as $day): ?>
        <li><?= $day['date']->format('d/m/Y')?> <?= $day['description']?> <?= $day['temp']?>°C</li>
        <?php endforeach ?>
    </ul>
</div>

<?php require 'elements/footer.php' ?>