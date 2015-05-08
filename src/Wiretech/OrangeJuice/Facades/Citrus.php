<?php 

namespace Wiretech\OrangeJuice\Facades;

use Illuminate\Support\Facades\Facade;

class Citrus extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'citrus'; }

}