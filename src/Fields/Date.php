<?php

namespace Sherif\Press\Fields;

use Carbon\Carbon;
use Sherif\Press\Fields\FieldContract;

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
