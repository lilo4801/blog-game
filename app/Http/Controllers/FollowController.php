<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;
use App\Services\FollowService;
use Illuminate\Http\Request;

class FollowController extends Controller
{

    protected FollowService $followService;

    public function __construct()
    {
        $this->followService = new FollowService();
    }

    public function store(StoreFollowRequest $request)
    {
        $res = $this->followService->create($request->validated());
        return redirect()->route('user', $request->validated()['user_id2'])->with('msg', $res['message']);
    }

    public function update(Request $request)
    {
        $res = $this->followService->update($request->input());
        return redirect()->route('user', $request->input()['user_id2'])->with('msg', $res['message']);
    }
}
