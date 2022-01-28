<?php

namespace SherifNabil\Press\Fields;

use Illuminate\Mail\Markdown;

class Body
{
    public static function process($type, $value): array
    {
        return [
            $type   =>  Markdown::parse($value)
        ];
    }
}
