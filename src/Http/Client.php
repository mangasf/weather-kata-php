<?php

namespace WeatherKata\Http;

class Client
{
    public function get(string $a_url): string|array
    {

        $datetime1 = new \DateTime();
        $datetime2 = new \DateTime('+2 days');

        if (strpos($a_url, 'search')) {
            return '766273';
        }
        return [
            [
                'applicable_date' => $datetime1->format('Y-m-d'),
                'wind_speed' => 60.0,
                'weather_state_name' => 'sunny'
            ],
            [
                'applicable_date' => $datetime2->format('Y-m-d'),
                'wind_speed' => 40.0,
                'weather_state_name' => 'sunny'
            ],
        ];
    }
}