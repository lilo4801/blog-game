<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Services\GameService;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    protected GameService $gameService;

    public function __construct()
    {
        $this->gameService = new GameService();
    }

    public function index()
    {
        return view('game.games')->with('games', $this->gameService->games());
    }

    public function create()
    {
        return view('game.create');
    }

    public function store(StoreGameRequest $request)
    {

        $res = $this->gameService->create($request->validated());

        return redirect()->route('games.create')->with('msg', $res['message']);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        return view('game.edit')->with('game', $this->gameService->find($id));
    }

    public function update(UpdateGameRequest $request, $id)
    {
        $res = $this->gameService->update($request->validated(), $id);

        return redirect()->route('games.edit', $id)->with('msg', $res['message']);
    }

    public function destroy($id)
    {
        $res = $this->gameService->delete($id);
        return redirect()->route('games.index')->with('msg', $res['message']);
    }
}
