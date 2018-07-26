<?php

namespace Weather\Includes;

class AssetHandler
{
    const MANIFEST_PATH = WEATHER_PATH . '/dist/manifest.json';
    private $assets = [];

    /**
     * The constructor
     */
    public function __construct()
    {
        if (\file_exists(self::MANIFEST_PATH)) {
            $assets = \file_get_contents(self::MANIFEST_PATH);
            $this->assets = \json_decode($assets, true);
        }
    }

    /**
     * Get the filename for an asset
     *
     * @param string $filename
     * 
     * @return string
     */
    public function getFilename(string $filename): string
    {
        if (!empty($this->assets[$filename])) {
            return $this->assets[$filename];
        }

        return $filename;
    }
}
