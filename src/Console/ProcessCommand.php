<?php

namespace Sherif\Press\Console;

use Illuminate\Console\Command;
use Sherif\Press\Facades\Press;
use Sherif\Press\Repositories\PostRepository;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle(PostRepository $repo)
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            $this->info('Number of Posts: ' . count($posts));

            foreach ($posts as $post) {
                $repo->save($post);
                $this->info('Post: ' . $post['title']);
            }
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
