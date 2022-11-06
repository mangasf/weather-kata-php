<?php

namespace WeatherKata;

use WeatherKata\ForecastPredictionRequest;
use WeatherKata\MetaweatherLocationRepository;


interface GetForecastPredictionUseCase
{
  public function doPrediction(ForecastPredictionRequest $request): string;
}

class GetForecastWindPredictionUseCase implements GetForecastPredictionUseCase
{
    private MetaweatherLocationRepository $metaweatherLocationRepository;

    public function __construct(MetaweatherLocationRepository $metaweatherLocationRepository)
    {
        $this->metaweatherLocationRepository = $metaweatherLocationRepository;
    }

    public function doPrediction(ForecastPredictionRequest $request): string
    {
        // Find the id of the city on metawheather
        $cityId = $this->metaweatherLocationRepository->findCityIdByCityName($request->getCityName());
        // Find the predictions for the city
        $results = $this->metaweatherLocationRepository->findCityPredictionsByCityId($cityId);

        foreach ($results as $result) {
          // If the date is not the expected, skip to next result.
          if ($result["applicable_date"] !== $request->getDatetime()->format("Y-m-d")) {
            break;
          }
          
          return $result["wind_speed"];
        }

        return "";
    }
}

class GetForecastWeatherPredictionUseCase implements GetForecastPredictionUseCase
{
    private MetaweatherLocationRepository $metaweatherLocationRepository;

    public function __construct(MetaweatherLocationRepository $metaweatherLocationRepository)
    {
        $this->metaweatherLocationRepository = $metaweatherLocationRepository;
    }

    public function doPrediction(ForecastPredictionRequest $request): string
    {
        // Find the id of the city on metawheather
        $cityId = $this->metaweatherLocationRepository->findCityIdByCityName($request->getCityName());
        // Find the predictions for the city
        $results = $this->metaweatherLocationRepository->findCityPredictionsByCityId($cityId);

        foreach ($results as $result) {
          // If the date is not the expected, skip to next result.
          if ($result["applicable_date"] !== $request->getDatetime()->format("Y-m-d")) {
            break;
          }

          return $result["weather_state_name"];
        }

        return "";
    }
}