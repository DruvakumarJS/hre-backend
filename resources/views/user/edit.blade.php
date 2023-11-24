@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Edit User</label>

          @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)  
          <div id="div2">
             <a data-bs-toggle="modal" data-bs-target="#promoteModal"><button class="btn btn-light btn-outline-success"> Promote </button></a>
          </div>
          @endif
           @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif       
       
        </div>
    </div>


    <div class="page-container">
      <form method="post" action="{{route('update_user',$id)}}">
        @csrf
       <div class="row">
           
           <div class="col-md-4">
                <label>Employee ID</label>
                <input class="form-control" type="input" name="employee_id" placeholder="Enter Empoyee ID" required="" value="{{$userData->employee_id}}">
                 @error('employee_id')
               <div class="alert alert-danger mt-1 mb-1">{{ old('employee_id') }} has been already taken</div>
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
                <input class="form-control" type="text" name="mobile" placeholder="Enter Mobile Number" required=""value="{{$userData->mobile}}" onkeypress='validate(event)'>
                 @error('mobile')
              <div class="alert alert-danger mt-1 mb-1">{{ old('mobile')}} - {{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Email ID</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required=""value="{{$userData->email}}">
                 @error('email')
              <div class="alert alert-danger mt-1 mb-1">{{ old('email')}} - {{ $message }}</div>
             @enderror
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Password</label>
                <input class="form-control" type="text" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="password" required="" placeholder="Enter Password">
                
                
          </div>

           <div class="col-md-4">
                <label>Confirm Password</label>
                <input class="form-control" type="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="confirm_password" required="" placeholder="Enter Confirm Password">
                 
                
          </div>


          <input type="hidden" name="role" value="{{$userData->role}}">
          <input type="hidden" name="user_id" value="{{$userData->user_id}}">
          <input type="hidden" name="row_id" value="{{$userData->id}}">


        

       </div>


       <button class="btn btn-danger div-margin" type="submit" value="submit">SUBMIT</button>

      </form>
    </div>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="promoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Promote / Upgrade Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('promote')}}">
                  @csrf
                  <div class="mb-3">
                    <label>Employee Name : </label> <label class="label-bold">{{ $userData->name }}</label>
                    
                  </div>

                  <div class="mb-3">
                    <label>Employee ID : </label> <label class="label-bold">{{ $userData->employee_id }}</label>
                    
                  </div>
                  <div class="mb-3">
                    <label>Current Designation : </label> <label class="label-bold">{{ $userData->user->roles->alias }}</label>
                    
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">New Designation</label>
                    <select class="form-control form-select" name="newrole" required>
                      <option value="">Select designation</option>
                      @foreach($roles as $key=>$value)
                      @if($value->alias != $userData->user->roles->alias)
                        <option  value="{{$value->id}}">{{ $value->alias}}</option>
                      @endif  
                      @endforeach
                    </select>
                  </div>

                  <input type="hidden" name="user_id" value="{{ $userData->user_id}}">

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">SAVE</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

<script type="text/javascript">
      
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
 }
</script>


@endsection
