<?php

namespace Sherif\Press\Console;

use Sherif\Press\Post;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Sherif\Press\Press;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        $posts = Press::driver()->fetchPosts();

        foreach ($posts as $post) {
            Post::create([
                'identifier'    =>  Str::random(),
                'slug'          =>  Str::slug($post['title']),
                'title'         =>  $post['title'],
                'body'          =>  $post['body'],
                'extra'         =>  $post['extra'] ?? "{}",
            ]);
        }
    }
}
