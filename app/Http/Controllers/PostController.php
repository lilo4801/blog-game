<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemovePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\GameService;
use App\Services\PostService;

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

    public function show($id)
    {
        $post = $this->postService->find($id);

        if (!$post) {
            abort(404);
        }

        return view('post.post')->with('post', $post);
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

    public function edit($id)
    {
        $post = $this->postService->find($id);

        if (!$post) {
            abort(404);
        }

        return view('post.edit')->with('post', $post)
            ->with('games', $this->gameService->games());
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $res = $this->postService->update($request->validated(), $id);
        return redirect()->route('posts.edit', $id)->with('msg', $res['message']);
    }

    public function destroy(RemovePostRequest $request, $id)
    {
        $res = $this->postService->remove($id);
        return redirect()->route('posts.index')->with('msg', $res['message']);
    }

    public function showList($type)
    {
        $res = $this->postService->getPostsByType($type);
        return view('home')->with('posts', $res);
    }

}
