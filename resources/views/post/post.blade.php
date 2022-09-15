@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post') }}</div>

                    <div class="card-body">
                        @if (session('msg'))
                            <div class="alert alert-success" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
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
                            @if(Auth::guard('admin')->user() )
                                <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Remove">
                                </form>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <form action="{{route('posts.comments.store',$post->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Comments:</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Send" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                    @foreach($post->comments as $comment)
                        <div class="card-header">
                            <h3>{{$comment->user->fullname}}</h3>
                            <p>{{$comment->content}}</p>
                            @if($comment->user_id === \Illuminate\Support\Facades\Auth::user()->id)
                                <div style="display: flex">
                                    <form action="{{route('posts.comments.destroy',[$post->id,$comment->id])}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="form-group">
                                            <input type="submit" value="X" class="btn btn-danger">
                                        </div>
                                    </form>
                                    <form action="{{route('posts.comments.edit',[$post->id,$comment->id])}}"
                                          method="get">
                                        @csrf
                                        <div class="form-group">
                                            <input type="submit" value="Edit" class="btn btn-warning">
                                        </div>
                                    </form>
                                </div>

                            @endif

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
