<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveFavoriteGame;
use App\Http\Requests\StoreFavoriteGameRequest;
use App\Services\FavoriteGameService;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteGameController extends Controller
{
    protected GameService $gameService;
    protected FavoriteGameService $favoriteGameService;

    public function __construct()
    {
        $this->gameService = new GameService();
        $this->favoriteGameService = new FavoriteGameService();
    }

    public function create()
    {

        return view('user.addGame')->with('games', $this->gameService->games())
            ->with('favoriteGames', $this->favoriteGameService->findFGamesbyUserId(Auth::user()->id));
    }

    public function store(StoreFavoriteGameRequest $request)
    {


        $res = $this->favoriteGameService->create($request->validated());
        return redirect()->route('user.addGame')->with('msg', $res['message']);
    }

    public function destroy(RemoveFavoriteGame $request, $id)
    {
        $res = $this->favoriteGameService->remove($id);
        return redirect()->route('user.addGame')->with('msg', $res['message']);
    }
}
