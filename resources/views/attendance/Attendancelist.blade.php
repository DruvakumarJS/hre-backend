@extends('layouts.app')

@section('content')
<style>

</style>


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Today's Attendance</label>

        @if(auth::user()->role_id == '1')

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('users')}}"><i class="fa fa-plus"></i> Create Employee</a>

        </div>
        @endif
        
         @if((auth::user()->role_id == '1') or (auth::user()->role_id == '5')) 
         <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('get_attendance_by_date')}}" >
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" id="date" type="text" name="search_date" autocomplete="off" placeholder="{{$date}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('employee-details')}}"> View Employees</a>
        </div>

         <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_attendance')}}" >
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search by Name / ID">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
         @endif
       

        

         <!-- <div id="div2" style="margin-right: 20px">
          <input type="hidden" id="loggedin" value="{{Auth::user()->isloggedin}}">
            <label class="switch">
              <input class="switch-input" type="checkbox" id="togBtn" value="false"  />
              <span class="switch-label" data-on="logout" data-off="login"></span> 
              <span class="switch-handle"></span> 
            </label>
          </div> -->


        
       
    </div>

    
   
    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Login </th>
                   <!--  @if((auth::user()->role_id == '1') or (auth::user()->role_id == '5')) 
                    <th scope="col">Login Location</th>
                    @endif -->
                    <th scope="col">Logout</th>
                   <!--  @if((auth::user()->role_id == '1') or (auth::user()->role_id == '5')) 
                    <th scope="col">Logout Location </th>
                    @endif -->
                    <th scope="col">Out Of Work</th>
                    <th scope="col">Total Hours</th>
                    <!-- <th scope="col">Action</th> -->
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                       
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->user->roles->alias}}</td>
                        <td>{{$value->login_time}}</td>
                        <!-- @if((auth::user()->role_id == '1') or (auth::user()->role_id == '5')) 
                        <td width="200px">{{$value->login_location}}</td>
                        @endif -->
                        <td>{{$value->logout_time}}</td>
                       <!--  @if((auth::user()->role_id == '1') or (auth::user()->role_id == '5')) 
                         <td width="200px">{{$value->logout_location}}</td>
                         @endif -->
                        @php
                          $minute1 = $value->out_of_work;
                          $hour1=  floor($minute1 / 60) ;
                          $min1 = $minute1 % 60 ;
                        @endphp
                        @if($value->total_hours == '0')
                        <td></td>
                        @else
                        <td>{{$hour1}}Hr : {{$min1}}Min</td>
                        @endif


                        @php
                          $minute = $value->total_hours;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value->total_hours == '0')
                        <td></td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif
                        
                        <!-- <td>
                            <a href="{{route('employee-history', $value->user_id)}}"><button type="button" class="btn btn-sm curved-text">view</button></a>
                            
                        </td> -->
                    </tr>
<!-- Modal -->

            <div class="modal" id="modal_{{$key}}" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('update_attendance') }}" method="POST" >
                    @csrf
                    <label>Employee ID : </label>
                    <label class="label-bold">{{$value->employee->employee_id}}</label>
                    <div class="row div-margin" >  
                        <div class="col-md-6">
                          <label>Logout Time</label>
                          <input class="form-control" type="time" name="logout_time">
                        </div>
                    </div>

                    <div class="row div-margin" >  
                        <div class="col-md-6">
                          <label>Out of Work (Hours)</label>
                          <input class="form-control" type="number" name="break" placeholder="Enter Out of work hours">
                        </div>
                    </div>

                    <input type="hidden" name="id" value="{{$value->id}}">
                    <button class="btn btn-primary" style="margin-top: 20px">Update</button>
                    
                </form>
                                    </div>
                    </div>
                  </div>
                </div>

<!--  end Modal -->

 <script>
$(document).ready(function(){
  $('#MybtnModal_{{$key}}').click(function(){
    $('#modal_{{$key}}').modal('show');
  });
});  
</script>
                   @endforeach 

    
                </tbody>
            </table>

            <label>Showing {{ $attendance->firstItem() }} to {{ $attendance->lastItem() }}
                                    of {{$attendance->total()}} results</label>

                                {!! $attendance->links('pagination::bootstrap-4') !!}

        </div>
    </div>

</div>

<script type="text/javascript">
 var switchStatus = false;
 var x = document.getElementById("demo");
 var lat = '';
 var long = '';
 var action = '';

 var isloggedin = $('#loggedin').val()
 //alert(isloggedin);

 if(isloggedin == '0'){
  $("#togBtn").attr("checked", false);
 }
 else {
  $("#togBtn").attr("checked", true);
 }

  //$("#togBtn").attr("checked", true);

$("#togBtn").on('change', function() {

    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
      //  alert(switchStatus);// To verify
     
        action = 'login';

       if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(showPosition );
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }

             
    }
    else {
       switchStatus = $(this).is(':checked');
       //alert(switchStatus);// To verify
       action = 'logout';

         if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(showPosition );
      } else { 
       // x.innerHTML = "Geolocation is not supported by this browser.";
      }

        
    }
});

function showPosition(position ) {
 
  lat = position.coords.latitude ;
  long =  position.coords.longitude ;

  //alert(action);

  var path = "{{ route('add_attendance') }}";
   
         $.ajax({
           url:"{{ route('add_attendance') }}",
           method:"POST",
           data:{action:action , lattitude:lat , longitude:long , _token: '{{csrf_token()}}' },
           dataType:"json",
           success:function(data)
           {
             
            console.log(data);
            
           }
          })
}
</script>

<script type="text/javascript">
  $( function() {
      $( "#date" ).datepicker({
        maxDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         // alert(dateText);
          setenddate(dateText);
          
        }
      });
    });
</script>



@endsection
