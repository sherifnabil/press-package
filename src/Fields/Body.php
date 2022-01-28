<?php

namespace SherifNabil\Press\Fields;

use Illuminate\Mail\Markdown;
use SherifNabil\Press\Fields\FieldContract;

class Body extends FieldContract
{
    public static function process($type, $value, $data): array
    {
        return [
            $type   =>  Markdown::parse($value)
        ];
    }
}
