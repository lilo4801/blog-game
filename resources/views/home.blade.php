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
                            <div style="display: flex;flex-direction: column;">
                                @php
                                    $isCheck = true;
                                @endphp
                                @foreach($post->likes as $like)
                                    @if($like->user_id  === \Illuminate\Support\Facades\Auth::user()->id )
                                        <form action="{{route('user.unlike')}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" value="{{$post->id}}" name="post_id">
                                            <input type="submit" class="btn btn-primary" value="Liked">
                                        </form>
                                        @php
                                            $isCheck = false;
                                        @endphp
                                    @endif
                                @endforeach
                                @if($isCheck)
                                    <form action="{{route('user.like')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$post->id}}" name="post_id">
                                        <input type="submit" class="btn btn-light" value="Like">
                                    </form>
                                @endif
                                <a href="{{route('posts.show',$post->id)}}" class="btn btn-dark">See more</a>
                                <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">See more</a>
                                <a href="{{route('user.report',$post->id)}}" class="btn btn-dark">Report</a>
                                @if(Auth::user() && Auth::user()->id === $post->user_id)
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
