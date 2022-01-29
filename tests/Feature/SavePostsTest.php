<?php

namespace Sherif\Press\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Sherif\Press\Post;
use Sherif\Press\Tests\TestCase;

class SavePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created_with_the_factory(): void
    {
        $post = factory(Post::class)->create();

        $this->assertCount(1, Post::all());
    }
}
