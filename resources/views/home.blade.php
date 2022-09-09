@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('msg'))
                            <div class="alert alert-success" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif
                        <form action="{{route('posts.create')}}" method="get">
                            @csrf
                            <input type="submit" class="btn btn-dark" value="Create new post">
                        </form>

                    </div>
                </div>
            </div>
            @foreach($posts as $post)
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{--                            <img src="{{asset()}}" alt="">--}}
                            <h2>{{$post->user->fullname}}</h2>
                        </div>
                        <div class="card-header" style="display: flex;justify-content: space-around">
                            <p>Title: {{ $post->title }}</p>
                            <p>{{$post->game->title}}</p>
                        </div>

                        <div class="card-body">
                            <div style="display: flex;justify-content: center">
                                <img width="400px" src="{{asset(POST_DIR.$post->image)}}" alt="">
                            </div>
                            <p>{{$post->content}}</p>
                            <div style="display: flex">
                                <a href="" class="btn btn-dark">See more</a>
                                @if(\Illuminate\Support\Facades\Auth::user()->id == $post->user_id)
                                    <form action="{{route('posts.edit',$post->id)}}" method="get">
                                        @csrf
                                        <input type="submit" class="btn btn-warning" value="Edit">
                                    </form>
                                    <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Remove">
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
