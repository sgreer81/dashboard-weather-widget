<?php

namespace Weather\Rest;

use Weather\Rest\RestBase;
use Weather\Rest\RestRegisterable;
use Weather\Service\WeatherService;

class Weather extends RestBase implements RestRegisterable
{
    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * Register modules rest route with WP
     */
    public function restRegister()
    {
        $this->registerRoute('current', [$this, 'current']);
    }

    /**
     * Get the current weather information
     *
     * @param \WP_Rest_Request $request
     *
     * @return \WP_Rest_Response
     */
    public function current(\WP_Rest_Request $request): \WP_Rest_Response
    {
        try {
            $data = $this->weatherService->getCurrent('phoenix');
        } catch (\Exception $e) {
            if (function_exists('sendToLoggingService')) {
                sendToLoggingService($e);
            }
            return new \WP_Rest_Response(['error' => $e->getMessage()], 500);
        }

        $response = new \WP_Rest_Response($data, 200);

        return $response;
    }
}
