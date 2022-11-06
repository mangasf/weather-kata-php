<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class MetaweatherLocationRepository
{
  const META_WEATHER_LOCATION_API_URL = "https://www.metaweather.com/api/location/";
  private Client $client;

  public function __construct(Client $client)
  {
      $this->client = $client;
  }

  public function findLocationIdByName(string $cityName): int
  {
    return $this->client->get(
      self::META_WEATHER_LOCATION_API_URL . "search/?query=" . $cityName
    );
  }

  public function findLocationPredictionsById(int $cityId): array
  {
    return $this->client->get(
      self::META_WEATHER_LOCATION_API_URL . $cityId
  );
  }
}
