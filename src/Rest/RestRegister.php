<?php

namespace Weather\Rest;

use Auryn\Injector;

class RestRegister
{
    /** 
     * @var Injector
     */
    private $injector;

    /**
     * The constructor.
     *
     * @param Injector $injector
     */
    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    /**
     * Register modules endpoints
     */
    public function registerEndpoints()
    {
        $fqcns = $this->getRegisterable();
        
        foreach($fqcns as $fqcn) {
            if (isset(class_implements($fqcn)['Weather\Rest\RestRegisterable'])) {
                try {
                    $instance = $this->injector->make($fqcn);
                    $instance->restRegister();
                } catch(\Exception $e) {
                    error_log($e->getMessage());
                    return false;
                }
            }
        }
    }

    /**
     * Get list of rest registerable modules
     */
    private function getRegisterable() {
        return [
            '\Weather\Rest\Weather',
        ];
    }
}