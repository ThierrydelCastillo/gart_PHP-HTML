<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'OpenWeather_moi.php'; 
$OpenWeather = new OpenWeather('ENTRER_APIKEY_ICI'); // Pour obtenir une APIKEY : https://openweathermap.org/api
$forecast = $OpenWeather->getForecast('Montpellier,fr');

if(isset($forecast['coordonnee'])){
    $coordonnee = $forecast['coordonnee'];
} else {
    $coordonnee = null;
}
?>


Prévisions météo pour <?=$coordonnee?><br>

<?php if(isset($forecast['data'])): ?>
    <?php foreach($forecast['data'] as $meteoday): ?>
        <li><?= $meteoday['date']->format('d/m/Y H') ?>h : <?= $meteoday['description'] ?>, <?= $meteoday['temp'] ?>°C</li>
    <?php endforeach ?>
<?php else: ?>
    Aucune donnée n'est disponible pour les coordonées fournies.
<?php endif ?>

