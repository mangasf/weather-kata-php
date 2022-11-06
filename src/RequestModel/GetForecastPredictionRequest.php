<?php

namespace WeatherKata\RequestModel;

class GetForecastPredictionRequest
{
  private ?int $cityId;
  private string $cityName;
  private ?\DateTime $datetime;

  public function __construct(?int $cityId, string $cityName, ?\DateTime $datetime = null)
  {
    $this->cityId = $cityId;
    $this->cityName = $cityName;
    $this->datetime = $datetime;
  }

  public static function create(string $cityName, ?\DateTime $datetime = null)
  {
    return new self(null, $cityName, $datetime);
  }

  public function getCityId(): ?int
  {
    return $this->cityId;
  }

  public function setCityId(int $cityId)
  {
    $this->cityId = $cityId;
  }

  public function getCityName(): string
  {
      return $this->cityName;
  }

  public function getDatetime(): \DateTime
  {
      return !$this->datetime ? new \DateTime() : $this->datetime;
  }
}
