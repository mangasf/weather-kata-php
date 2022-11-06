<?php

namespace WeatherKata;

use WeatherKata\Http\Client;
use WeatherKata\UseCase\GetForecastWeatherPredictionUseCase;
use WeatherKata\UseCase\GetForecastWindPredictionUseCase;
use WeatherKata\Repository\MetaweatherLocationRepository;
use WeatherKata\RequestModel\GetForecastPredictionRequest;

class GetForecastPredictionController
{
  private $metaweatherLocationRepository;

  public function __construct()
  {
    $this->metaweatherLocationRepository = new MetaweatherLocationRepository(new Client());
  }

  public function predict(string &$city, \DateTime $datetime = null, bool $wind = false)
  {
    $request = GetForecastPredictionRequest::create($city, $datetime);
    
    // If there aren't predictions
    if ($request->getDatetime() >= new \DateTime("+6 days 00:00:00")) {
      return "";
    }

    $getForecastPredictionUseCase = $wind ?
      new GetForecastWindPredictionUseCase($this->metaweatherLocationRepository) :
      new GetForecastWeatherPredictionUseCase($this->metaweatherLocationRepository);
       
    $prediction = $getForecastPredictionUseCase->doPrediction($request);
    $city = $request->getCityId();

    return $prediction;
  }
}
