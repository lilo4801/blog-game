<?php


namespace App\Services;


use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowService
{
    public function create(array $data): array
    {
        try {
            Follow::create([
                'user_id1' => Auth::user()->id,
                'user_id2' => $data['user_id2'],
            ]);
            return ['success' => true, 'message' => __('Follow has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create follow')];
        }
    }

    public function find(int $id)
    {
        return Follow::where([['user_id1', Auth::user()->id], ['user_id2', $id]])->first();
    }

    public function update(array $arr): array
    {
        try {
            $result = Follow::where([['user_id2', $arr['user_id2']], ['user_id1', Auth::user()->id]])->update([
                'status' => $arr['status'],
            ]);

            if (!$result) {
                return ['success' => false, 'message' => __('follow not found')];
            }

            return ['success' => true, 'message' => __('follow has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

}
