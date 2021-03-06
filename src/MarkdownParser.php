<?php

namespace Sherif\Press;

use Parsedown;

class MarkdownParser
{
    public static function parse(string $markdown): string
    {
        return Parsedown::instance()->text($markdown);
    }
}
