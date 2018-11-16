<?php

namespace App\Services\Weather;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Exception;

class OpenWeatherApiService  
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /** 
     * Send request to API 
     * 
     * @param string $location
     * @return Response|Exception 
     */
    public function send_request($location)
    {
        try {
            $response = $this->client->request('GET', 'http://api.openweathermap.org/data/2.5/weather', [
                   'query' => ['zip' => $location,
                   'appid' => env('WEATHER_API_ID')]
           ]);
            return $response;
       } catch (\GuzzleHttp\Exception\GuzzleException $e) {
           if ($e->hasResponse()) {
               throw new Exception(418);
           }
       } catch (\Exception $e) {
            throw new Exception($e->getMessage());
       }
    }

    /** 
     * Get a full weather report for a particular location.
     * 
     * @param string $location
     * @return string $weather
     */
    public function full_weather_report($location) 
    {
        $response = $this->send_request($location);
        $weather = $response->getBody()->getContents();

        return $weather;
    }
}