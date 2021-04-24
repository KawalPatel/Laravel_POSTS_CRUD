<html>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</head>

@extends('layouts.app')

@section('content')
<h1>Create new post</h1>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('postuser') }}" id="sectionForm">
                @csrf

                <div class="form-group row">
                    <label for="">Post title</label>

                    <input type="text" class="form-control" name="title" class="form-group" placeholder="Enter title">
                </div>
                <div class="form-group row">
                    <label for="">Post body</label>
                    <textarea type="text" class="form-control" name="body" id="exampleFormControlTextarea1" rows="6" placeholder="Enter body"></textarea>
                </div>
                <div class="form-group row mb-0">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

                </script>
            </form>
        </div>
    </div>
</div>
<!--<input type="text" id="txtName"/>-->

@endsection

</html>