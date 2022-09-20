<?php


namespace App\Services\API\User;


use App\Models\Post;

class PostService
{
    /**
     * @return array
     */
    public function getRecentPost(int $day = 1): array
    {
        $posts = Post::with('user', 'game')->whereRaw('datediff(now(), created_at) <= ?', [$day])->get();
        return [
            $posts->map(function ($post) {
                return [
                    'title' => $post->title,
                    'content' => $post->content,
                    'imageUrl' => $post->image,
                    'game' => $post->game->title,
                    'authorName' => $post->user->fullname,
                ];
            })->toArray(),
        ];
    }
}
