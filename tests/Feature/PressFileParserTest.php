<?php

namespace SherifNabil\Press\Tests\Feature;

use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use SherifNabil\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split(): void
    {
        $pressFileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString('Blog post body', $data[2]);
    }

    /** @test */
    public function a_string_can_also_be_used_instead(): void
    {
        $pressFileParser = (new PressFileParser("---\ntitle: My Title\n---\nBlog post body here"));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My Title', $data[1]);
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

    /** @test */
    public function the_body_gets_saved_and_trimmed(): void
    {
        $pressFileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body</p>\n", $data['body']);
    }

    /** @test */
    public function a_date_field_can_be_parsed(): void
    {
        $pressFileParser = (new PressFileParser("---date: May 14, 1988\n---"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
    }

    /** @test */
    public function an_extra_field_gets_saved(): void
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author'  => 'John Doe']), $data['extra']);
    }

    /** @test */
    public function two_additional_fields_are_put_into_extra(): void
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\nimage: some/image.png---\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author'  => 'John Doe', 'image'  => 'some/image.png']), $data['extra']);
    }
}
