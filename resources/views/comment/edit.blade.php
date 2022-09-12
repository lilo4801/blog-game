@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit comment') }}</div>

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


                    <div class="card-body">
                        <form action="{{route('posts.comments.update',[$comment->post_id,$comment->id])}}"
                              method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Comments:</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1"
                                          rows="3">{{$comment->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
