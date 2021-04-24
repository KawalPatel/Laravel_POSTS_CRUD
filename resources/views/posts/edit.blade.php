@extends('layouts.app')

@section('content')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<h1>Edit Post</h1>
{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Post id</label>
                {{Form::text('id', $post->id,['class'=>'form-control', 'placeholder' => 'Id','readonly' => 'true'] )}}
            </div>
            <div class="form-group">
                <label for="">Post title</label>

                {{Form::text('title', $post->title,['class'=>'form-control', 'placeholder' => 'Enter title'])}}
            </div>

            <div class="form-group">
                <label for="">Post body</label>

                {{Form::textarea('body', $post->body,['class'=>'form-control', 'placeholder' => 'Enter body'])}}

            </div>
        </div>
    </div>
</div>
<br><br>
{{Form::hidden('_method','PUT')}}
{{Form::submit('submit', ['class'=>'btn btn-success'])}}

{!! Form::close() !!}

<a href="/posts">Cancel</a>


@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>