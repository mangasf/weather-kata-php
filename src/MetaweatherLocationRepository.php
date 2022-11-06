<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class MetaweatherLocationAPI
{
  public const META_WEATHER_LOCATION_API_URL = "https://www.metaweather.com/api/location/";
  private Client $client;

  public function __construct(Client $client)
  {
      $this->client = $client;
  }

  public function findLocationIdByName(string $cityName): int
  {
    return $this->client->get(
      $this->META_WEATHER_LOCATION_API_URL . "search/?query=" . $cityName
    );
  }

  public function findLocationPredictionsById(int $cityId): array
  {
    return $this->client->get(
      $this->META_WEATHER_LOCATION_API_URL . $cityId
  );
  }
}
