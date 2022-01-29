<?php

namespace Sherif\Press\Console;

use Sherif\Press\Post;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Sherif\Press\MarkdownParser;
use Sherif\Press\PressFileParser;
use Illuminate\Support\Facades\File;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        $files = File::files(__DIR__ . '/../../blogs');
        foreach ($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();

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
