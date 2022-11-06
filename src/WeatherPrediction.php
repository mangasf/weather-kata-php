<?php

namespace WeatherKata;

use WeatherKata\Http\Client;
use WeatherKata\Prediction;

class WeatherPrediction implements Prediction
{
  private function process_results(array $weather_prediction, \Datetime $datetime): string
  {
    foreach ($weather_prediction as $result) {
      if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
        return $result['weather_state_name'];
      }
    }

    return "";
  }

  static function execute(string &$city_id, \Datetime $datetime): string
  {
    $client = new Client();

    $weather_prediction = $client->get("https://www.metaweather.com/api/location/$city_id");

    $prediction = new WeatherPrediction();

    return $prediction->process_results($weather_prediction, $datetime);
  }
}