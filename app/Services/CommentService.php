<?php


namespace App\Services;


use App\Models\Comment;

use Illuminate\Support\Facades\Auth;

class CommentService
{

    public function find($id)
    {
        return Comment::find($id);
    }

    public function create(array $arr, int $post_id): array
    {
        try {
            Comment::create([
                'user_id' => Auth::user()->id,
                'content' => $arr['content'],
                'post_id' => $post_id,
            ]);
            return ['success' => true, 'message' => __('Comment has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Comment')];
        }
    }

    public function remove(int $comment_id): array
    {
        try {
            $comment = Comment::where('id', $comment_id)->delete();

            if (!$comment) {
                return ['success' => false, 'message' => __('Comment not found')];
            }

            return ['success' => true, 'message' => __('Comment has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function update(array $arr, int $comment_id): array
    {
        try {
            $comment = Comment::find($comment_id)->update($arr);

            if (!$comment) {
                return ['success' => false, 'message' => __('Comment not found')];
            }

            return ['success' => true, 'message' => __('Comment has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}
