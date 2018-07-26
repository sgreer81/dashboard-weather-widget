<?php

namespace Weather\Admin;

use Weather\Includes\AssetHandler;

class WeatherWidget
{
    /**
     * @var AssetHandler
     */
    private $assetHandler;

    public function __construct(AssetHandler $assetHandler)
    {
        $this->assetHandler = $assetHandler;
        $this->addActions();
    }

    /**
     * Register a dashboard widget in WP admin
     */
    public function registerWidget()
    {
        \wp_add_dashboard_widget(
            'weather_dashboard_widget',
            'Weather',
            [$this, 'widgetContent']
        );
    }

    /**
     * Set widget content to a div that React can attach to
     */
    public function widgetContent()
    {
        echo '<div id="weatherRoot"></div>';
    }

    /**
     * Set widget content to a div that React can attach to
     */
    public function enqueueScripts(string $hook)
    {
        if ($hook !== 'index.php') {
            return;
        }
        wp_enqueue_script(
            'weatherWidget',
            WEATHER_ASSETS_URL . $this->assetHandler->getFilename('bundle.js'),
            [],
            null,
            true
        );

        wp_enqueue_style(
            'weatherWidget',
            WEATHER_ASSETS_URL . $this->assetHandler->getFilename('bundle.css'),
            [],
            null
        );
    }

    /**
     * Add actions to WordPress
     */
    private function addActions()
    {
        add_action('wp_dashboard_setup', [$this, 'registerWidget']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
    }
}
