<?php

namespace WeatherKata\RequestModel;

class GetForecastPredictionRequest
{
    private string $city;
    private ?\DateTime $datetime;

    public function __construct(string $city, ?\DateTime $datetime = null)
    {
        $this->city = $city;
        $this->datetime = $datetime;
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
