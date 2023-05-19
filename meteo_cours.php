<?php

$curl = curl_init('https://api.openweathermap.org/data/2.5/forecast?q=Lyon,fr&units=metric&lang=fr&APPID=ENTRER_APIKEY_ICI');
// Pour obtenir une APIKEY : https://openweathermap.org/api

curl_setopt_array($curl, [
    CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 4
]);
// curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer'); //certificat pour le https
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   // Option pour return les data au lieu de les afficher
$data = curl_exec($curl);

if($data === false) {
    var_dump(curl_error($curl));
} else {
    if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
        $data = json_decode($data, true);
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    } else {
        echo 'Error :' . curl_getinfo($curl, CURLINFO_HTTP_CODE);
    }
    
}

curl_close($curl);

