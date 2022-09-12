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

        $res = $this->followService->create($request->validated()['user_id2']);
        return redirect()->route('user', $request->validated()['user_id2'])->with('msg', $res['message']);
    }

    public function update(UpdateFollowRequest $request, $id)
    {

        $res = $this->followService->update($request->validated());
        return redirect()->route('user', $request->validated()['user_id2'])->with('msg', $res['message']);
    }
}
