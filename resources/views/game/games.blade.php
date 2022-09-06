@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('List games') }}</h1>

                        <a href="{{route('games.create')}}" class="btn btn-primary" > Create new game</a>


                    </div>
                    <div class="card-body">


                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Create by</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach ($games as $game)
                                    <tr>
                                    <td>1</td>
                                    <td>{{ $game->title }}</td>
                                    <td><img src="../image/game/{{$game->image}}" style="width: 100px"></td>
                                    <td>{{$game->admin->fullname}}</td>
                                    <td>
                                        <form action="{{ route('admin.logout') }}" method="POST" >
                                            <input type="button" class="btn btn-warning" value="Edit"/>
                                        </form>
                                        <form action="{{ route('admin.logout') }}" method="POST" >
                                            <input type="button" class="btn btn-danger" value="Remove"/>
                                        </form>

                                    </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
