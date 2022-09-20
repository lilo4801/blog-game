<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Support\Facades\Redis;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected PostService $postService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with('posts', $this->postService->posts());
    }
}
