<?php
require_once 'CurlException.php';
require_once 'HTTPException.php';
require_once 'UnauthorizedHTTPException.php';

/**
 * Gère l'API d'OpenWeather
 *
 * @author  Grafikart (www.grafikart.fr)
 */
class OpenWeather {
    
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    /**
     * Récupère les informations météorologique du jour
     *
     * @param  mixed $city - Ville (ex: Montpellier, fr)
     * @return array
     */
    public function getToDay(string $city): ?array
    {
        $data = $this->callApi("weather?q={$city}");
        return [
            'temp' => 0,
            'description' => 'météo indisponible',
            'date' => new DateTime()
        ];
    }
    
    /**
     * Récupère les prévisions sur plusieurs jours
     *
     * @param  string  $city
     * @return array[]
     */
    public function getForecast(string $city): ?array
    {
        $data = $this->callApi("forecast?q={$city}");
        foreach($data['list'] as $day){
            $results[] = [
                'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        return $results;
    }
    
    /**
     * Appelle l'API OpenWeather
     *
     * @param  mixed $endpoint Action à appeler (weather, weather/forecast)
     * @throws CurlException Curl a rencontré une erreur
     * @throws UnauthorizedHTTPException Accès refusé à l'API (vérifier l'APIKey)
     * @throws HTTPException
     * 
     * @return array
     */
    private function callApi(string $endpoint): ?array
    {
        $curl = curl_init("https://api.openweathermap.org/data/2.5/{$endpoint}&APPID={$this->apiKey}&units=metric&lang=fr");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        if($data === false) {
            throw new CurlException($curl);
        }
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code != 200){
            curl_close($curl);
            if($code === 401) {
                $data = json_decode($data, true);
                throw new UnauthorizedHTTPException($data['message'], 401);
            }
            throw new HTTPException($data, $code);
        }
        curl_close($curl);
        return json_decode($data, true);
    }
}