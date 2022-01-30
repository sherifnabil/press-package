<?php

namespace Sherif\Press\Drivers;

use Sherif\Press\Drivers\Driver;
use Sherif\Press\PressFileParser;
use Illuminate\Support\Facades\File;

class FileDriver extends Driver
{
    public function fetchPosts()
    {
        if (!is_dir(config('press.path'))) {
            mkdir(config('press.path'));
            file_put_contents(config('press.path') . '/test.md', file_get_contents(__DIR__ . '/../../blogs/sample-post.md'));
        }

        $files = File::files(config('press.path'));

        foreach ($files as $file) {
            $posts[] = (new PressFileParser($file->getPathname()))->getData();
        }

        return $posts ?? [];
    }
}
