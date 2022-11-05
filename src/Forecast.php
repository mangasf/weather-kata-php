<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

interface WeatherClientService
{
    public function get(string $url): string|array;
}

class GetForecastPredictionRequest
{
    private string $city;
    private \DateTime $datetime;
    private bool $wind;

    public function __construct(string $city, \DateTime $datetime, bool $wind)
    {
        $this->city = $city;
        $this->datetime = $datetime;
        $this->wind = $wind;
    }

    public function getCityName(): string
    {
        return $this->city;
    }

    public function getDatetime(): \DateTime
    {
        return !$this->datetime ? new \DateTime() : $this->datetime;
    }
}

class GetForecastPrediction
{
    private WeatherClientService $client;

    public function __construct(WeatherClientService $client)
    {
        $this->client = $client;
    }

    public function predict(GetForecastPredictionRequest $request): string
    {
        // If there aren't predictions
        if ($request->getDatetime() >= new \DateTime("+6 days 00:00:00")) {
            return;
        }

        // Find the id of the city on metawheather
        $cityId = $client->get(
            "https://www.metaweather.com/api/location/search/?query=" .
                $request->getCityName()
        );
        // Find the predictions for the city
        $results = $client->get(
            "https://www.metaweather.com/api/location/$cityId"
        );

        // Maybe add methdo that parses results?
        foreach ($results as $result) {
            // When the date is the expected
            if ($result["applicable_date"] == $datetime->format("Y-m-d")) {
                // If we have to return the wind information
                if ($wind) {
                    return $result["wind_speed"];
                } else {
                    return $result["weather_state_name"];
                }
            }
        }
    }
}
