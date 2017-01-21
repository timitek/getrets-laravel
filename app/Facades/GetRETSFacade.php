<?php

namespace Timitek\GetRETS\Facades;

use Illuminate\Support\Facades\Facade;

class GetRETSFacade extends Facade {
    protected static function getFacadeAccessor() { return 'getrets'; }
}