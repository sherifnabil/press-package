<?php

namespace SherifNabil\Press\Fields;

use Carbon\Carbon;

class Date
{
    public static function process($type, $value): array
    {
        return [
            $type       =>  Carbon::parse($value),
            'parsed_at' =>  Carbon::now()
        ];
    }
}
