<?php

namespace Sherif\Press\Tests\Feature;

use Sherif\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    /** @test */
    public function simple_markdown_is_parsed(): void
    {
        $parsedown = MarkdownParser::parse('# Sherif');
        $this->assertEquals($parsedown, "<h1>Sherif</h1>");
    }
}
