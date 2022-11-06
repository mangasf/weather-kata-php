<?php

namespace WeatherKata\UseCase;

use WeatherKata\Repository\MetaweatherLocationRepository;
use WeatherKata\RequestModel\GetForecastPredictionRequest;

class GetForecastWindPredictionUseCase implements IGetForecastPredictionUseCase
{
    private MetaweatherLocationRepository $metaweatherLocationRepository;

    public function __construct(MetaweatherLocationRepository $metaweatherLocationRepository)
    {
        $this->metaweatherLocationRepository = $metaweatherLocationRepository;
    }

    public function doPrediction(GetForecastPredictionRequest &$request): string
    {
        // Find the id of the city on metawheather
        $cityId = $this->metaweatherLocationRepository->findLocationIdByName($request->getCityName());
        $request->setCityId($cityId);
        
        // Find the predictions for the city
        $results = $this->metaweatherLocationRepository->findLocationPredictionsById($request->getCityId());

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
