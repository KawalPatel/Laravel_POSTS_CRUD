@extends('layouts.app')

@section('content')

<h3>Show all posts</h3>
This is index.blade.php
<br><br><br>
@if(count($posts) > 0 )

<div class="container">
  <div style="text-align: center;">

    <a class="btn btn-link" data-href="/exportAll" id="exportAll" onclick="exportTasks(event.target);">Export all data to CSV</a>
    <br><br>
    <div style="float: right;"><br>{{ $posts->links() }}<br></div>
  </div>
  <br>
  <form action="postuser" method="POST" enctype="multipart/form-data">
    @csrf
    <table class="table table-striped" id="category-table">
      <tr>

        <th>select all &nbsp;&nbsp; <input type="checkbox" id="select-all"> </th>
        <th>Id</th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>View</th>
        <th>Edit</th>

      </tr>
      @foreach ($posts as $post)

      <tr>
        <td><input type="checkbox" value="{{$post['id']}}" name=" checkbox[]"></td>

        <td>{{$post['id']}}<input type="hidden" value="{{$post['id']}}" name="id[]"></td>

        <td>{{$post['title']}}<input type="hidden" value="{{$post['title']}}" name="title[]"></td>

        <td>{{$post['body']}}<input type="hidden" value="{{$post['body']}}" name="body[]"></td>


        <td><a href="/posts/{{$post['id']}}" class="btn btn-info">View</td>
        <td><a href="/posts/{{$post['id']}}/edit" class="btn btn-warning">Edit</td>

  </form>


  </tr>
  @endforeach

  </table>

  <div style="float: right;"><br>{{ $posts->links() }}<br></div>
  <br><br><br><br>
  <button type="submit" value="Submit" class="btn btn-success" name="getDataFromApi_StoreToDatabase">Get Data From API</button><br><br>
  <button type="submit" value="Submit" class="btn btn-success" name="export_to_csv">Export selected data to CSV</button><br>
  <!-- <button type="submit" value="Submit" class="btn btn-success" name="truncate_posts">Truncate posts table</button><br> -->
  <small>select one, more or all data to export to CSV</small>


</div>
<br><br>


<br><br>

@else
<form action="postuser" method="POST" enctype="multipart/form-data">
  @csrf
  <button type="submit" value="Submit" class="btn btn-success" name="getDataFromApi_StoreToDatabase">Get Data From API</button><br>
</form>
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