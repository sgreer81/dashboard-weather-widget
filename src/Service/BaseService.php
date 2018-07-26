<?php

namespace Weather\Service;

class WeatherService
{
    const API_BASE = 'https://api.openweathermap.org/data/2.5/';

    /**
     * Api Key used to make request from API
     *
     * @var string
     */
    private $weatherApiKey = '';

    public function __construct()
    {
        if (defined('WEATHER_API_KEY')) {
            $this->weatherApiKey = WEATHER_API_KEY;
        }
    }

    /**
     * Get the current weather for a city
     *
     * @param string $city The city to get the weather for
     * 
     * @return array Weather information
     * 
     * @throws \Exception
     */
    public function getCurrent(string $city): array
    {
        $requestUrl = $this->buildRequestUrl(
            'weather',
            [
                'q' => $city,
                'units' => 'imperial',
            ]
        );

        $response = \wp_remote_get($requestUrl);

        if (\is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        $http_code = \wp_remote_retrieve_response_code($response);

        if ($http_code != 200) {
            throw new \Exception("{$http_code} response from API");
        }

        $body = \wp_remote_retrieve_body($response);
        $body = \json_decode($body, true);

        return $body;
    }

    /**
     * Build a request URL with authentication
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    private function buildRequestUrl(string $route, array $params = []): string
    {
        $paramsString = '';

        foreach ($params as $key => $value) {
            $paramsString .= "&{$key}={$value}";
        }

        return self::API_BASE . $route . '/' . '?appid=' . $this->weatherApiKey . $paramsString;
    }
}
