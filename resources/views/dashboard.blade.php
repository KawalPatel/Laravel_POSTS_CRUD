@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User details</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div style="text-align:center;"><a href="/posts">Show all posts</a></div><br>

                    @if (count($users)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>

                        </tr>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>**********</td>

                        </tr>

                        @endforeach
                    </table>@else
                    <p>You have no users</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection