<?php

namespace SherifNabil\Press\Tests\Feature;

use Parsedown;
use Orchestra\Testbench\TestCase;
use SherifNabil\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    /** @test */
    public function simple_markdown_is_parsed(): void
    {
        $parsedown = MarkdownParser::parse('# Sherif');
        $this->assertEquals($parsedown, "<h1>Sherif</h1>");
    }
}
