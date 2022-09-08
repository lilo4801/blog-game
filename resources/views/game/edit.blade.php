@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Edit game') }}</h1>

                        @if(session('msg'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{session('msg')}}!</strong>
                            </div>
                        @endif

                        <a href="{{route('games.index')}}" class="btn btn-primary"> Back</a>


                    </div>
                    <br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{route('games.update',$game->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" value='{{$game->title}}' placeholder="Enter title"
                                       id="title">
                            </div>


                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                            <div class="form-group">
                                <img src="{{asset(GAME_DIR .$game->image)}}" style="width: 100px">
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
