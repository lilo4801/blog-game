@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('msg'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{session('msg')}}!</strong>
                    </div>
                @endif
                <img width="380px" src="" id="image">
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create new post') }}</div>

                    <div class="card-body">

                        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title"
                                       name="title">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="game">Type game</label>
                                <select class="form-control" name="game_id">
                                    @foreach($games as $game)
                                        <option value="{{$game->id}}">{{$game->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Choose image:</label>
                                <input type="file" onchange="readURL(this);" class="form-control-file" id="image"
                                       name="image">
                            </div>
                            <input type="submit" class="btn btn-dark" value="Create">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image').src = e.target.result
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
