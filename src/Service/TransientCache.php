<?php

namespace Weather\Service;

trait TransientCache
{
    /**
     * Get item from transient cache
     *
     * @param string $url
     * 
     * @return mixed|bool Returns data or false if there is no valid cache
     */
    private function getCache(string $url)
    {
        $transient = 'WEATHER_' . md5($url);
        $cachedData = \get_transient($transient);

        if ($cachedData) {
            $cachedData['cached'] = true;
            return $cachedData;
        }

        return false;
    }

    /**
     * Add entry to transient cache
     *
     * @param string $url
     * @param string|array $data
     * @param integer $ttl
     *
     * @return boolean
     */
    private function setCache(string $url, $data, int $ttl = HOUR_IN_SECONDS): bool
    {
        $transient = 'WEATHER_' . md5($url);
        return \set_transient($transient, $data, $ttl);
    }
}
