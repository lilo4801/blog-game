<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\GameService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected GameService $gameService;
    protected PostService $postService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->gameService = new GameService();
    }

    public function index()
    {
        return view('home')->with('posts', $this->postService->posts());
    }

    public function create()
    {

        return view('post.create')->with('games', $this->gameService->games());
    }

    public function store(StorePostRequest $request)
    {
        $res = $this->postService->create($request->validated());
        return redirect()->route('posts.create')->with('msg', $res['message']);
    }
}
