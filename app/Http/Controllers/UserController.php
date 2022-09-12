<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Services\FavoriteGameService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected UserService $userService;
    protected FavoriteGameService $favoriteGameService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->favoriteGameService = new FavoriteGameService();
    }

    public function show($id)
    {
        return view('user.profile')->with('user', $this->userService->find($id))
            ->with('favoriteGames', $this->favoriteGameService->findFGamesbyUserId($id));
    }

    public function edit()
    {
        return view('user.edit')->with('user', Auth::user());
    }

    public function updateInfo(UpdateUserInfoRequest $request)
    {

        $res = $this->userService->updateInfo($request->validated());

        return redirect()->route('user.edit', Auth::user()->id)->with('msg', $res['message']);
    }

    public function updateImg(UpdateImageRequest $request)
    {

        $res = $this->userService->updateImg($request->validated());
        return redirect()->route('user', Auth::user()->id)->with('msg', $res['message']);
    }
}
