@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Add</label>
          <div id="div2">
            <a href="{{route('users')}}">
              <button class="btn btn-light btn-outline-secondary"> User Master</button>
            </a>
             
          </div>
          

           @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif       
       
        </div>
    </div>


    <div class="page-container">
      <form method="post" action="{{route('save_user')}}">
        @csrf
       <div class="row">
           
           <div class="col-md-4">
                <label>Employee ID *</label>
                <input class="form-control" type="input" name="employee_id" placeholder="Enter Empoyee ID" required="" value="{{old('employee_id')}}">
                 @error('employee_id')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Name *</label>
                <input class="form-control" type="input" name="name" placeholder="Enter Name" required=""value="{{old('name')}}">
                 @error('name')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

      </div>
    

       <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Mobile Number *</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{old('mobile')}}">
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Email ID *</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required=""value="{{old('email')}}">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Password *</label>
                <input class="form-control" type="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="password" required="" placeholder="Enter Password">
                
                
          </div>

           <div class="col-md-4">
                <label>Confirm Password *</label>
                <input class="form-control" type="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="confirm_password" required="" placeholder="Enter Confirm Password">
                 
                
          </div>

          <input type="hidden" name="role" value="{{$role}}">

        

       </div>

       <button class="btn btn-primary div-margin" type="submit" value="submit">SUBMIT</button>

      </form>
    </div>
    </div>


@endsection
