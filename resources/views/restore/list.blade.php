@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Restore & Recycle</label>
    </div>

    <div class="justify-content-center div-margin">

      <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Laravel 8 Import Export Excel & CSV File - <a href="https://techvblogs.com/blog/laravel-import-export-excel-csv-file?ref=repo" target="_blank">TechvBlogs</a>
        </h2>
        <form action="{{ route('import_user') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import Users</button>
            <a class="btn btn-success" href="">Export Users</a>
        </form>
    </div>

    
</div>
@endsection