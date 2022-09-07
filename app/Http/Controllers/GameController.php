<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Services\GameService;
use Illuminate\Http\Request;
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
        $request->validate();
        $image = '';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();

            if (!file_exists(storage_path('public/image/game/' . $filename))) {
                $file->move(public_path('image/game'), $filename);
            }

            $image = $filename;
        }

        $res = $this->gameService->create($request->input('title'), $image, Auth::guard('admin')->user()->id);

        return redirect()->route('games.create')->with('msg', $res['message']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return view('game.edit')->with('game', $this->gameService->find($id));
    }

    public function update(Request $request, $id)
    {
        $image = '';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!file_exists(storage_path('public/image/game/' . $filename))) {
                $file->move(public_path('image/game'), $filename);
            }

            $image = $filename;
        }

        $res = $this->gameService->update($request->input('title'), $image, Auth::guard('admin')->user()->id, $id);
        return redirect()->route('games.edit', $id)->with('msg', $res['message']);
    }

    public function destroy($id)
    {
        $res = $this->gameService->delete($id);
        return redirect()->route('games.index')->with('msg', $res['message']);
    }
}
