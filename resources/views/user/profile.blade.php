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
                    <img
                        src="{{asset(USER_DIR . $user->avatar ?? '76358702a311d1ba_5ad85d27aa3a3c7e_8224914664781762143215.jpg')}}"
                        style="width: 100%" id="avatar" alt="{{$user->avatar}}">
                    @if(Auth::user()->id == $user->id)
                        <form action="{{route('user.updateImg')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input class="form-control" name="avatar" type="file" onchange="readURL(this);">
                            <input class="btn btn-primary" type="submit" value="Choose">
                        </form>
                    @endif
                </div>

            </div>
            <div class="col-md-8">
                <h2> Favorite game:</h2>
                <div class="row">
                    @foreach($favoriteGames as $gameF)
                        <div class="col-md-3">
                            <div class="card" style="width:100%;height: 220px">
                                <label class="container">
                                    <img width="100%" height="200px" src="{{asset(GAME_DIR.$gameF->game->image)}}">
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="height: 400px">
                    <div class="card-body text-center">
                        <h4 class="card-title">{{$user->fullname}}</h4>
                        <p class="card-text">Address: {{$user->address ?: 'none'}}</p>
                        <p class="card-text">Date of birth: {{$user->dob ?: 'none'}}</p>
                        @if(Auth::user()->id === $user->id)
                            <form action="{{route('user.edit')}}" method="GET">
                                @csrf
                                <input class="btn btn-primary" type="submit" value="Edit profile">
                            </form>
                            <form action="{{route('user.addGame')}}" method="GET">
                                @csrf
                                <input class="btn btn-warning" type="submit" value="Add your favorite game">
                            </form>
                        @else
                            @if($follow)
                                @if($follow->status)
                                    <form action="{{route('follow.update')}}" method="POST">
                                        @csrf

                                        <input type="hidden" value="{{$user->id}}" name="user_id2">
                                        <input type="hidden" value="0" name="status">
                                        <input class="btn btn-warning" type="submit" value="Following">
                                    </form>
                                @else
                                    <form action="{{route('follow.update')}}" method="POST">
                                        @csrf

                                        <input type="hidden" value="{{$user->id}}" name="user_id2">
                                        <input type="hidden" value="1" name="status">
                                        <input class="btn btn-primary" type="submit" value="Follow">
                                    </form>
                                @endif
                            @else
                                <form action="{{route('follow.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="user_id2">
                                    <input class="btn btn-primary" type="submit" value="Follow">
                                </form>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-md-8">

            </div>

        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar').src = e.target.result

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
