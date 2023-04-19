@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Settings</label>
    </div>

    <div class="row div-margin">
      <div class="col-md-4">
         <a class="btn btn-dark" href="{{route('users')}}"> <label>User Master</label></a>
        
      </div>

      <div class="col-md-4">
         <a class="btn btn-dark" href="{{route('materials_master')}}"> <label>Material Master</label></a>
        
      </div>
              
              
    </div>
</div>
@endsection