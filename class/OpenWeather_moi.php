<?php
class OpenWeather {

    public $keyAPI;
    public $coordonee;

    public function __construct(string $keyAPI)
    {
        $this->keyAPI = $keyAPI;
    }

    public function getForecast(string $coordonee)
    {
        $result['coordonnee'] = $coordonee;
        $curl = curl_init("https://api.openweathermap.org/data/2.5/forecast?q={$coordonee}&units=metric&lang=fr&APPID={$this->keyAPI}");
        curl_setopt_array($curl, [
        CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cert.cer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 4
        ]);
        $data = curl_exec($curl);
        if($data === false) {
            var_dump(curl_error($curl));
        } else {
            if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $data = json_decode($data, true);
                $data = $data['list'];
                for ($i=0; $i < 5; $i++) {
                    $temp[] = $data[$i];
                    foreach($temp as $key => $meteoOfDay) {
                        $result['data'][$key]['temp'] = $meteoOfDay['main']['temp'];
                        $result['data'][$key]['description'] = $meteoOfDay['weather'][0]['description'];
                        $result['data'][$key]['date'] = new DateTime($meteoOfDay['dt_txt']);
                    }
                }
                return $result;
            } else {
                return 'Error :' . curl_getinfo($curl, CURLINFO_HTTP_CODE);
            }
            
        }
        curl_close($curl);
    }
}