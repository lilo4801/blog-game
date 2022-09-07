@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(isset($user))
                <div class="col-md-4">
                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{session('msg')}}!</strong>
                        </div>
                    @endif
                    <div style="width: 100%;background-color: #cbd5e0">

                        @if(Auth::user()->id == $user->id)
                            <img
                                src="../image/avatar/{{$user->avatar ?? '76358702a311d1ba_5ad85d27aa3a3c7e_8224914664781762143215.jpg'}}"
                                style="width: 100%" id="avatar" alt="{{$user->avatar}}">
                            <form action="{{route('user.updateImg')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" name="avatar" type="file" onchange="readURL(this);">
                                <input class="btn btn-primary" type="submit" value="Choose">
                            </form>
                        @endif
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card" style="height: 400px">
                        <div class="card-body">
                            <h4 class="card-title">{{$user->fullname}}</h4>
                            <p class="card-text">Address: {{$user->address ?: 'none'}}</p>
                            <p class="card-text">Date of birth: {{$user->dob ?: 'none'}}</p>
                            @if(Auth::user()->id == $user->id)
                                <form action="{{route('user.edit',Auth::user()->id)}}" method="GET" >
                                    @csrf
                                    <input class="btn btn-primary" type="submit" value="Edit">
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            @endif

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
