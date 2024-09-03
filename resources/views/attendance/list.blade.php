@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container-fluid">
    <div class="container-header">
        <label class="label-bold" id="div1">Today's Attendance</label>

        @if(auth::user()->role_id == '1')

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('users')}}"><i class="fa fa-plus"></i> Create Employee</a>

        </div>
        @endif
        
         @if((auth::user()->role_id == '1') or (auth::user()->roles->team_id == '4') or (auth::user()->role_id == '2')) 
           @if(auth::user()->role_id == '1' OR auth::user()->role_id == '2' OR auth::user()->role_id == '9')
          <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('employee-details')}}"> View Employees</a>
        </div>

         @endif
        
         <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_attendance_by_date')}}" >
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" id="date" type="text" name="search_date" autocomplete="off" value="{{$date}}" >
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" id="search_date" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

       

         <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_user_attendance')}}" >
            @csrf
             <div class="input-group mb-3">
                <input type="hidden" name="date" value="{{$date}}">
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

    
   
    <div class="page-container">
        <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Login </th>
                    <th scope="col">Logout</th>
                    <th scope="col">Total Hours</th>
                    <!-- <th scope="col">Action</th> -->
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                       
                        <td>{{$value['employee_id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['role']}}</td>
                        <td>{{$value['login']}}</td>
                       
                        <td>{{$value['logout']}}</td>

                        @php
                          $minute = $value['total_hours'];
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value['total_hours'] == '0')
                        <td>0Hr : 0Min</td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif
                        
                       
                    </tr>

                   @endforeach 

    
                </tbody>
            </table>

           

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
            $('#search_date').click();
           $('.date').hide();
           
          
        }
      });
    });

  
</script>



@endsection
