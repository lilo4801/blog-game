<?php


namespace App\Services;


use App\Enums\PostType;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService extends GeneralService
{
    public function posts()
    {
        return Post::with('game', 'user')->paginate(3);
    }

    public function create(array $data): array
    {

        data_set($data, 'image', $this->hanldeFileAndGetFileName(data_get($data, 'image'), POST_DIR));
        data_set($data, 'user_id', Auth::user()->id);

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
        DB::beginTransaction();
        try {
            $result = Post::find($id);
            $result->comments()->delete();
            $result->likes()->delete();
            $result->delete();
            if (!$result) {
                return ['success' => false, 'message' => __('Post is not found')];
            }
            DB::commit();
            return ['success' => true, 'message' => __('Post has been removed')];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => __('Failed to remove Post')];
        }
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function findPostsBy($type)
    {
        if (isset($type) && is_numeric($type) && (int)$type === PostType::BY_FOLLOWING_USER) {
            $userIdList = Auth::user()->follows()->get()->map(function ($follow) {
                return $follow->user_id2;
            });

            return Post::with('game', 'user')->whereIn('user_id', $userIdList)->orderBy('created_at', 'desc')->paginate(3);
        }

        if (isset($type) && is_numeric($type) && (int)$type === PostType::BY_FAVORITE_GAME) {
            $gameIdList = Auth::user()->favoriteGames()->get()->map(function ($game) {
                return $game->game_id;
            });

            return Post::with('game', 'user')->whereIn('game_id', $gameIdList)->orderBy('created_at', 'desc')->paginate(3);
        }

        return Post::with('game', 'user')->whereIn('user_id', [Auth::user()->id])->orderBy('created_at', 'desc')->paginate(3);
    }


}
