<?php

namespace Sherif\Press\Console;

use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        $this->info('Hi...');
    }
}
