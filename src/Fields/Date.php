<?php

namespace SherifNabil\Press\Fields;

use Carbon\Carbon;
use SherifNabil\Press\Fields\FieldContract;

class Date extends FieldContract
{
    public static function process($type, $value, $data): array
    {
        return [
            $type       =>  Carbon::parse($value),
            'parsed_at' =>  Carbon::now()
        ];
    }
}
