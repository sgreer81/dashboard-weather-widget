<?php

namespace Weather\Rest;

abstract class RestBase
{
    /**
     * Register a rest route to WP
     *
     * @param string $route
     * @param array $callback
     * @param string $method
     * @param array $args
     * @return void
     */
    protected function registerRoute(
        string $route,
        array $callback,
        string $method = 'GET',
        array $args = []
    ) {
        add_action('rest_api_init', function () use ($route, $callback, $method, $args) {
            register_rest_route('Weather/v1', $route, [
                'methods' => $method,
                'callback' => $callback,
                $args
            ]);
        });
    }
}