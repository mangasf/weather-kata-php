<?php

namespace WeatherKata;

interface IGetForecastPredictionUseCase
{
  public function doPrediction(GetForecastPredictionRequest $request): string;
}