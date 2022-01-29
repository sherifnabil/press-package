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
        if (is_null(config('press'))) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        $files = File::files(config('press.path'));
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
