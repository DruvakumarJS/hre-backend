@extends('layouts.app')

@section('content')
<style>

</style>


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Today's Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('users')}}"><i class="fa fa-plus"></i> Create Employee</a>

        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('employee-details')}}"> View Employees</a>
        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('download_monthly_attendance')}}"> Download</a>
        </div>

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
                    <th scope="col">Logout</th>
                    <th scope="col">Total Hours</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                       
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->user->roles->alias}}</td>
                        <td>{{$value->login_time}}</td>
                        <td>{{$value->logout_time}}</td>
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
                        
                        <td>
                            <a href="{{route('employee-history', $value->user_id)}}"><button type="button" class="btn btn-sm curved-text">view</button></a>
                        </td>
                    </tr>
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



@endsection
