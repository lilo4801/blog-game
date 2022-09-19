<?php


namespace App\Services\API\User;


use App\Models\Post;

class PostService
{
    public function getRecentPost()
    {
        $posts = Post::with('user', 'game')->whereRaw('datediff(now(), created_at) <= ?', [1])->get();
        return [
            'data' => $posts->map(function ($post) {
                return [
                    'title' => $post->title,
                    'content' => $post->content,
                    'imageUrl' => $post->image,
                    'game' => $post->game->toArray(),
                    'authorName' => $post->user->fullname,
                ];
            })->toArray(),
        ];
    }
}
