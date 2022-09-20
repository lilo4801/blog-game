<?php


namespace App\Services\API\User;


use App\Models\Post;
use Carbon\Carbon;

class PostService
{
    /**
     * @return array
     */
    public function getRecentPost(int $day = 1): array
    {
        $posts = Post::with('user', 'game')->where('created_at', '>=', Carbon::now()->subDays($day))->get();
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
