<?php

namespace Sherif\Press;

use Illuminate\Support\Str;

class Press
{
    public static function configNotPublished()
    {
        return is_null(config('press'));
    }

    public static function driver()
    {
        $driver = Str::title(config('press.driver'));
        $class = 'Sherif\Press\Drivers\\' . $driver . 'Driver';

        return new $class;
    }
}
