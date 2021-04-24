@extends('layouts.app')

@section('content')

<h3>Show all posts</h3>
This is index.blade.php
<br><br><br>
@if(count($posts) > 0 )

<div class="container">
  <div style="text-align: center;">

    <a href="/posts/create">Create new post</a> &nbsp;&nbsp;||<a class="btn btn-link" data-href="/exportAll" id="exportAll" onclick="exportTasks(event.target);">Export all data to CSV</a>

    <br><br>
  </div>
  <div style="float: right;">{{ $posts->links() }}</div>
  <br>
  <form action="customExport" method="POST" enctype="multipart/form-data">
    @csrf
    <table class="table table-striped" id="category-table">
      <tr>

        <th>select all &nbsp;&nbsp; <input type="checkbox" id="select-all"> </th>
        <th>Id</th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>

      </tr>
      @foreach ($posts as $post)

      <tr>
        <td><input type="checkbox" name="checkbox[]" value="{{$post['id']}}"></td>
        <td>{{$post['id']}}</td>
        <td>{{$post['title']}}</td>
        <td>{{$post['body']}}</td>

        <td><a href="/posts/{{$post['id']}}" class="btn btn-info">View</td>
        <td><a href="/posts/{{$post['id']}}/edit" class="btn btn-warning">Edit</td>
  </form>
  <td>{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=> 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger','name' => 'del'])}}
    {!!Form::close() !!}
  </td>

  </tr>
  @endforeach

  </table>
  <button type="submit" value="Submit" class="btn btn-success" name="export_to_csv">Export selected data to CSV</button><br>
  <small>select one, more or all data to export to CSV</small>


</div>
<br><br>
<div style="float: right;">{{ $posts->links() }}</div>

<br><br>

@else
<p>no posts found</p>
&nbsp; <a href="/posts/create">Create post</a>

@endif
<script>
  function exportTasks(_this) {
    let _url = $(_this).data('href');
    window.location.href = _url;
  }


  $(function() {
    $('#select-all').click(function(event) {

      var selected = this.checked;
      // Iterate each checkbox
      $(':checkbox').each(function() {
        this.checked = selected;
      });

    });
  });
</script>
@endsection