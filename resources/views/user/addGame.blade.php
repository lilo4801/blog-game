@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                @if(session('msg'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{session('msg')}}!</strong>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="width: 100%;background-color: #cbd5e0">
                    <h1>Your game:</h1>
                    <div class="row">
                        @foreach($favoriteGames as $game)
                            <div class="col-md-3">
                                <label class="container">
                                    <img width="100%" height="50px" src="{{asset(GAME_DIR.$game->game->image)}}">
                                    <form action="{{route('user.removeGame',$game->id)}}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-warning" style="width: 100%" value="X">
                                    </form>
                                </label>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <h1>Add new Game</h1>
                <form action="{{route('user.storeGame')}}" method="post" class="row">
                    @csrf
                    @foreach($games as $game)
                        <div class="col-md-3">
                            <div class="card" style="width:100%;height: 220px">
                                <label class="container">
                                    <img width="100%" height="200px" src="{{asset(GAME_DIR.$game->image)}}">
                                    <input type="checkbox" name="game_id[]" value="{{$game->id}}"
                                    @foreach($favoriteGames as $fgame)
                                        {{$fgame->game_id === $game->id ? 'checked disabled':''}}
                                        @endforeach

                                    >
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    @endforeach
                    <br>
                    <input type="submit" class="btn btn-dark" value="Add">
                </form>
            </div>


        </div>
    </div>
@endsection
