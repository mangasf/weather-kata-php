<?php

namespace WeatherKata;

class GetForecastWindPredictionUseCase implements IGetForecastPredictionUseCase
{
    private MetaweatherLocationRepository $metaweatherLocationRepository;

    public function __construct(MetaweatherLocationRepository $metaweatherLocationRepository)
    {
        $this->metaweatherLocationRepository = $metaweatherLocationRepository;
    }

    public function doPrediction(GetForecastPredictionRequest $request): string
    {
        // Find the id of the city on metawheather
        $cityId = $this->metaweatherLocationRepository->findLocationIdByName($request->getCityName());
        // Find the predictions for the city
        $results = $this->metaweatherLocationRepository->findLocationPredictionsById($cityId);

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
