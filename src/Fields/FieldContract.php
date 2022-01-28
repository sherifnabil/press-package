<?php

namespace SherifNabil\Press\Fields;

abstract class FieldContract
{
    public static function process($fieldType, $fieldValue, $data): array
    {
        return [$fieldType  =>   $fieldValue];
    }
}
