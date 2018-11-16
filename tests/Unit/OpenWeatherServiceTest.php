<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Weather\OpenWeatherApiService;

class OpenWeatherServiceTest extends TestCase
{

    protected $api;

    public function setup()
    {
        parent::setup();

        $this->api = new OpenWeatherApiService;
        $this->location = "78704,us";

    }

    /**
     * Test the service responds successfully for a geographic location.
     *
     * @return void
     * @group openWeatherApi
     */
    public function testItRespondsSuccesfully()
    {
        $response = $this->api->send_request($this->location);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test the service Throws an Exception for a invalid geographic location.
     *
     * @expectedException Exception
     * @return void
     * @group openWeatherApi
     */
    public function testItThrowsException()
    {
        $location = "00000,us";
        $response = $this->api->send_request($location);        
    }

   /**
     * Test the service returns a full weather report.
     *
     * @return void
     * @group openWeatherApi
     */
    public function testItReturnsFullWeatherReport()
    {
        $weather = json_decode($this->api->full_weather_report($this->location));

        $this->assertObjectHasAttribute('weather', $weather);
        $this->assertObjectHasAttribute('main', $weather);
        $this->assertObjectHasAttribute('wind', $weather);
        $this->assertObjectHasAttribute('clouds', $weather);
    }    
}
