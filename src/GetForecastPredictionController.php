<?php

namespace WeatherKata;

use WeatherKata\ForecastPredictionRequest;

class GetForecastPredictionController
{
  private $metaweatherLocationRepository;

  public function __construct()
  {
    $this->metaweatherLocationRepository = new MetaweatherLocationRepository(new Client());
  }

  public function predict(string &$city, \DateTime $datetime = null, bool $wind = false)
  {
    $request = new GetForecastPredictionRequest($city, $datetime);
    
    // If there aren't predictions
    if ($request->getDatetime() >= new \DateTime("+6 days 00:00:00")) {
      return "";
    }

    $getForecastPredictionUseCase = $wind ?
      new GetForecastWindPredictionUseCase($this->metaweatherLocationRepository) :
      new GetForecastWeatherPredictionUseCase($this->metaweatherLocationRepository);
   
    
    return $getForecastPredictionUseCase->doPrediction($request);
  }
}
