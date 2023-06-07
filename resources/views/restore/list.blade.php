@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Restore & Recycle</label>
    </div>

    <div class="justify-content-center div-margin">

      <div class="row">
        <div class="col-md-3">
          <a href="{{route('restore-users')}}"><button class="btn btn-sm btn-light btn-outline-secondary">Users</button></a>
          
        </div>
        <div class="col-md-3">
          <a href="{{route('restore-customers')}}"><button class="btn btn-sm btn-light btn-outline-secondary">Customers</button></a>
          
        </div>

         <div class="col-md-3">
          <a href="{{route('restore-category')}}"><button class="btn btn-sm btn-light btn-outline-secondary">Categories</button></a>
          
        </div>

         <div class="col-md-3">
          <a href="{{route('restore-material')}}"><button class="btn btn-sm btn-light btn-outline-secondary">Materials</button></a>
          
        </div>
        
      </div>


      
    </div>

    
</div>
@endsection