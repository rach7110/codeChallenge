<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Services\Weather\OpenWeatherApiService;

class WeatherController extends Controller
{
    protected $weatherService;
    
    public function __construct(OpenWeatherApiService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function create (Request $request) {
        $zip = $request->input('zip');

        $validator = Validator::make($request->all(), [
            'zip' => 'required|digits:5'
        ]);

        if ($validator->fails()) {
            return "Please enter a 5 digit zip code.";        
        }

        $location = $zip . ",us";

        return $weather = $this->weatherService->full_weather_report($location);
      }
}
