<?php

namespace Sherif\Press\Repositories;

use Sherif\Press\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostRepository
{
    public function save($post)
    {
        Post::updateOrCreate([
            'identifier'    =>  $post['identifier'],
        ], [
            'slug'          =>  Str::slug($post['title']),
            'title'         =>  $post['title'],
            'body'          =>  $post['body'],
            'extra'         =>  $this->extra($post),
        ]);
    }

    private function extra($post)
    {
        $extra = json_decode($post['extra'] ?? '[]', true);
        $attributes = Arr::except($post, ['title', 'identifier', 'body', 'extra']);
        return json_encode(array_merge($extra, $attributes));
    }
}
