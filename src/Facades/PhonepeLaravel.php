<?php

namespace Anburocky3\PhonepeLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class PhonepeLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Anburocky3\PhonepeLaravel\PhonePe::class;
    }
}
