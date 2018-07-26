<?php
/*
Plugin Name:  Dashboard Weather Widget
Description:  Adds a widget to the WordPress admin dashboard that displays current weather information.
Plugin URI:   https://stephengreer.me
Version:      0.1.0
Author:       Stephen Greer
Author URI:   https://stephengreer.me
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

namespace Weather;

use Auryn\Injector;

defined('ABSPATH') or die();

define('WEATHER_PATH', __DIR__);
define('WEATHER_URL', plugin_dir_url(__FILE__));
define('WEATHER_ASSETS_URL', plugin_dir_url(__FILE__) . 'dist/');

// Use Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

$injector = new Injector();

App::create($injector);
