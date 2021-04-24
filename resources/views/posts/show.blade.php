@extends('layouts.app')

@section('content')This is show.blade.php<br><br>
<h5>Post details</h5>
<table class="table table-striped">
    <tr>
        <th>id</th>
        <th>title</th>
        <th>body</th>

    </tr>
    <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>


    </tr>
</table>

<a href="/posts" class="btn  btn-outline-dark">go back</a>&nbsp;&nbsp;&nbsp;




<a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>&nbsp;&nbsp;&nbsp;
<br><br><br><br>
{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=> 'pull-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close() !!}

@endsection