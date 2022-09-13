<?php


namespace App\Services;


use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService extends GeneralService
{
    public function posts()
    {
        return Post::with('game', 'user')->get();
    }

    public function create(array $data): array
    {

        data_set($data, 'image', $this->hanldeFileAndGetFileName(data_get($data, 'image'), POST_DIR));
        data_set($data, 'user_id', Auth::user()->id, POST_DIR);

        try {
            Post::create($data);
            return ['success' => true, 'message' => __('Post has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Post')];
        }
    }

    public function find($id)
    {
        return Post::with('game', 'user')->find($id);
    }

    public function update(array $data, int $id): array
    {
        try {
            data_get($data, 'image') &&
            data_set($data, 'image', $this->hanldeFileAndGetFileName(data_get($data, 'image'), POST_DIR));

            $result = Post::find($id)->update($data);

            if (!$result) {
                return ['success' => false, 'message' => __('Post is not found')];
            }

            return ['success' => true, 'message' => __('Post has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Post')];
        }
    }

    public function remove($id): array
    {
        try {
            $result = Post::find($id)->delete();

            if (!$result) {
                return ['success' => false, 'message' => __('Post is not found')];
            }

            return ['success' => true, 'message' => __('Post has been removed')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to remove Post')];
        }
    }
}
