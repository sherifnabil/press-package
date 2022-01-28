<?php

namespace SherifNabil\Press\Tests\Feature;

use Orchestra\Testbench\TestCase;
use SherifNabil\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split(): void
    {
        $pressFileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString('Blog post body', $data[2]);
    }

    /** @test */
    public function each_head_field_gets_seperated(): void
    {
        $pressFileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('My Title', $data['title']);
        $this->assertEquals('Description here', $data['description']);
    }
}
