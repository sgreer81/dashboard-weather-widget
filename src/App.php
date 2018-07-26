<?php

namespace Weather;

use Auryn\Injector;
use Weather\Rest\RestRegister;

class App
{
    /**
     * @var Injector
     */
    private $injector;

    /**
     * The constructor
     *
     * @param Injector $injector
     */
    public function __construct(Injector $injector)
    {
        $this->injector = $injector;

        $this->publicInit();
        $this->adminInit();
    }

    /**
     * Instantiates App
     *
     * @param Injector $injector
     *
     * @return App
     */
    public static function create(Injector $injector)
    {
        return new self($injector);
    }

    /**
     * Instantiates public modules
     */
    private function publicInit()
    {
        $restRegister = new RestRegister($this->injector);
        $restRegister->registerEndpoints();
    }

    /**
     * Instantiates admin modules
     */
    private function adminInit()
    {
        if (is_admin()) {
            try {
                $this->injector->make('Weather\Admin\WeatherWidget');
            } catch (\Exception $e) {
                error_log($e);
            }
        }
    }
}
