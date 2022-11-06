<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class City
{
  private string $name 

  private function __construct(string $city_name)
  {
    $this->name = $city_name;
  }

  public static function getID(string &$city): string
  {
    // Create a Guzzle Http Client
    $client = new Client();
    
    $_city = new City($city);

    $woeid = $client->get("https://www.metaweather.com/api/location/search/?query=$_city->name");

    return $woeid;
  }
}