<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Jobs\SendLikeEmail;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct()
    {
        $this->likeService = new LikeService();
    }

    public function store(StoreLikeRequest $request)
    {
        $res = $this->likeService->create($request->validated());

        if ($res['success']) {
            SendLikeEmail::dispatch(Auth::user(), $request->validated()['post_id'])
                ->onQueue('like');
        }

        return redirect()->route('home')->with('msg', $res['message']);
    }

    public function destroy(Request $request)
    {
        $res = $this->likeService->remove($request->input('post_id'));
        return redirect()->route('home')->with('msg', $res['message']);

    }

}
