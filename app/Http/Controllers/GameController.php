<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $gameService;
    public function __construct()
    {
        $this->gameService = new GameService();
    }

    public function index()
    {
        //
        return view('game.games')->with('games',$this->gameService->games());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:games|max:255',
            'image' => 'required',

        ]);
        $image = '';
        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            if (!file_exists(storage_path('public/image/game/'.$filename))) {
                $file-> move(public_path('image/game'), $filename);
            }

            $image= $filename;
        }
        $res = $this->gameService->create($request->input('title'),$image,Auth::guard('admin')->user()->id);

        return redirect()->route('games.create')->with('msg',$res['message']);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('game.edit')->with('game',$this->gameService->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image = '';
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('image/game'), $filename);
            $image= $filename;
        }
        $res = $this->gameService->update($request->input('title'),$image,Auth::guard('admin')->user()->id,$id);
        return redirect()->route('games.edit',$id)->with("msg",$res['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res = $this->gameService->delete($id);
        return redirect()->route('games.index')->with('msg',$res['message']);
    }
}
