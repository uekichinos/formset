<?php

namespace khyrie\Formset\Facades;

use Illuminate\Support\Facades\Facade;

class Formset extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'formset';
    }
}
