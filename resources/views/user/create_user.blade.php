@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Add User</label>
          <div id="div2">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create User</button>
          </div>
           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>
        </div>
    </div>

    <div class="page-container">
      <form method="post" action="{{route('save_user')}}">
        @csrf
       <div class="row">
           
           <div class="col-md-4">
                <label>Employee ID</label>
                <input class="form-control" type="input" name="employee_id" placeholder="Enter Empoyee ID" required="" value="{{old('employee_id')}}">
                 @error('employee_id')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>User Name</label>
                <input class="form-control" type="input" name="name" placeholder="Enter User Name" required=""value="{{old('name')}}">
                 @error('name')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

       </div>

       <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Mobile Number</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{old('mobile')}}">
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Email ID</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required="">
                
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Role</label>
                 <select class="form-control" name="role" >
                            <option>Role</option>
                            @foreach ($roles as $key => $value)
                                <option value="{{ $value->name }}"> 
                                    {{ $value->name }} 
                                </option>
                            @endforeach    
                </select> 
                
          </div>

        

       </div>

       <button class="btn btn-primary div-margin" type="submit" value="submit">SUBMIT</button>

      </form>
    </div>
    </div>

@endsection
