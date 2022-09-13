@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    Admin page
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Report user</th>
                                <th>post</th>
                                <th>Content</th>
                                <th>Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>1</td>
                                    <td>{{$report->user->fullname}}</td>
                                    <td><a href="{{route('posts.show',$report->post_id)}}" class="btn btn-info">See
                                            more</a></td>
                                    <td>{{$report->content}}</td>
                                    <td>
                                        @if($report->status === 0)
                                            <form action="{{route('admin.report.update')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="report_id" value="{{$report->id}}">
                                                <select name="status">
                                                    <option {{$report->status === 1 ? 'selected' : '' }}  value="1">
                                                        Accept
                                                    </option>
                                                    <option {{$report->status === 0 ? 'selected' : '' }} value="0">
                                                        Pending
                                                    </option>
                                                    <option {{$report->status === -1 ? 'selected' : '' }} value="-1">
                                                        Reject
                                                    </option>
                                                </select>
                                                <input type="submit" class="btn btn-warning" value="Update">
                                            </form>
                                        @elseif($report->status === 1 )
                                            Accepted
                                        @else
                                            Rejected
                                        @endif
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
