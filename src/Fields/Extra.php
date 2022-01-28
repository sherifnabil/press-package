<?php

namespace SherifNabil\Press\Fields;

use SherifNabil\Press\Fields\FieldContract;

class Extra extends FieldContract
{
    public static function process($type, $value, $data): array
    {
        $extra = isset($data['extra']) ? (array)json_decode($data['extra']) : [];

        return [
            'extra'   =>  json_encode(array_merge($extra, [
                $type   => $value
            ]))
        ];
    }
}
