<?php

namespace WeatherKata\UseCase;

use WeatherKata\RequestModel\GetForecastPredictionRequest;

interface IGetForecastPredictionUseCase
{
  public function doPrediction(GetForecastPredictionRequest &$request): string;
}
