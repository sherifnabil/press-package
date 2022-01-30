<?php

namespace Sherif\Press\Drivers;

use Sherif\Press\Drivers\Driver;
use Illuminate\Support\Facades\File;
use Sherif\Press\Exceptions\FileDriverDirectoryNotFoundException;

class FileDriver extends Driver
{
    public function fetchPosts()
    {
        $files = File::files($this->config['path']);

        foreach ($files as $file) {
            $this->parse(
                content: $file->getPathname(),
                identifier: $file->getFilename()
            );
        }

        return $this->posts;
    }

    protected function validateSource()
    {
        if (! File::exists($this->config['path'])) {
            throw new FileDriverDirectoryNotFoundException(
                message: 'Directory at \'' . $this->config['path'] . '\' doesn\'t exist. Check the directory path in the config file.'
            );
            file_put_contents(config('press.path') . '/test.md', file_get_contents(__DIR__ . '/../../blogs/sample-post.md'));
        }
    }
}
