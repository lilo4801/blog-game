<?php


namespace App\Services;


use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService extends GeneralService
{
    public function posts()
    {
        return Post::with('game')->get();
    }

    public function create(array $data): array
    {
        try {
            Post::create([
                'title' => $data['title'],
                'image' => $this->hanldeFileAndGetFileName($data['image'], POST_DIR),
                'user_id' => Auth::user()->id,
                'content' => $data['content'],
                'game_id' => $data['game_id'],
            ]);
            return ['success' => true, 'message' => __('Post has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Post')];
        }
    }
}
