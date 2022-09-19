<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Jobs\SendNewCommentPostEmail;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct()
    {
        $this->commentService = new CommentService();
    }

    public function edit($post_id, $comment_id)
    {
        return view('comment.edit')->with('comment', $this->commentService->find($comment_id));
    }

    public function update(UpdateCommentRequest $request, $post_id, $comment_id)
    {
        $res = $this->commentService->update($request->validated(), $comment_id);
        return redirect()->route('posts.show', $post_id)->with('msg', $res['message']);
    }

    public function store(StoreCommentRequest $request, $post_id)
    {
        $res = $this->commentService->create($request->validated(), $post_id);

        if ($res['success']) {
            SendNewCommentPostEmail::dispatch($post_id, Auth::user())->onQueue('comment');
        }

        return redirect()->route('posts.show', $post_id)->with('msg', $res['message']);
    }

    public function destroy(RemoveCommentRequest $request, $post_id, $comment_id)
    {
        $res = $this->commentService->remove($comment_id);
        return redirect()->route('posts.show', $post_id)->with('msg', $res['message']);
    }
}
