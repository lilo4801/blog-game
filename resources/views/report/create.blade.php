@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Report') }}</div>

                    <div class="card-body">
                        @if (session('msg'))
                            <div class="alert alert-success" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif
                        <form action="{{route('user.report.store')}}" method="post"
                              style="display: flex;flex-direction: column">
                            @csrf
                            <input class="form-control" type="hidden" value="{{$post_id}}" name="post_id">

                            <div class="form-group">
                                <label>Content:</label>
                                <input class="form-control" type="text" name="content">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-dark" value="Create new report">
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
