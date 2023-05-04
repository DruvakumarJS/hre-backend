@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Edit User</label>
          <div id="div2">
             <button class="btn btn-light" > View Users</button>
          </div>
          
           @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif       
       
        </div>
    </div>


    <div class="page-container">
      <form method="post" action="{{route('update_user')}}">
        @csrf
       <div class="row">
           
           <div class="col-md-4">
                <label>Employee ID</label>
                <input class="form-control" type="input" name="employee_id" placeholder="Enter Empoyee ID" required="" value="{{$userData->employee_id}}" readonly="readonly">
                 @error('employee_id')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Name</label>
                <input class="form-control" type="input" name="name" placeholder="Enter Name" required=""value="{{$userData->name}}">
                 @error('name')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

      </div>
    

       <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Mobile Number</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{$userData->mobile}}" readonly="readonly">
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Email ID</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required=""value="{{$userData->email}}" readonly="readonly">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Password</label>
                <input class="form-control" type="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="password" required="" placeholder="Enter Password">
                
                
          </div>

           <div class="col-md-4">
                <label>Confirm Password</label>
                <input class="form-control" type="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="confirm_password" required="" placeholder="Enter Confirm Password">
                 
                
          </div>


          <input type="hidden" name="role" value="{{$userData->role}}">
          <input type="hidden" name="user_id" value="{{$userData->user_id}}">


        

       </div>

       <button class="btn btn-primary div-margin" type="submit" value="submit">SUBMIT</button>

      </form>
    </div>
    </div>


@endsection