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

                        @if(Auth::user())
                            <img
                                src="../../image/avatar/{{Auth::user()->avatar ?? '76358702a311d1ba_5ad85d27aa3a3c7e_8224914664781762143215.jpg'}}"
                                style="width: 100%" id="avatar" alt="{{Auth::user()->avatar}}">
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

                            @if(Auth::user())
                                <form action="{{route('user.updateInfo')}}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="fullname">Fullname:</label>
                                        <input type="text" class="form-control" name="fullname" value="{{Auth::user()->fullname}}" placeholder="Enter fullname" id="fullname">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}" placeholder="Enter address" id="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date of birth:</label>
                                        <input type="date" name="dob" class="form-control" value="{{Auth::user()->dob}}" id="dob">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form action="{{route('user',Auth::user()->id)}}" method="GET" >
                                    @csrf
                                    <input type="submit" class="btn btn-warning" value="Back" />
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
