@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Employee History</label>


        <div id="div2" >
            <div class="mb-3 d">
              <input type="hidden" name="id" id="id" value="{{$employee->user_id}}">
              
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar" max="<?php echo date('Y-m-d');  ?>"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>
         <form method="POST" action="{{route('export_attendance')}}">
          @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{$employee->user_id}}">
            <input type="hidden" name="start_date" id="start_date" value="{{$employee->user_id}}">
            <input type="hidden" name="end_date" id="end_date" value="{{$employee->user_id}}">

            <div id="div3" style="margin-right: 30px">
                <button type="submit" class="btn btn-light btn-outline-secondary" > Download CSV</button>
            </div>
          
        </form>

        

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card employee-card">
                <div class="row">
                    <div class="col-4">
                        <h5><b>{{$employee->name}}</b></h5>
                        <h6>{{$employee->user->roles->alias}}</h6>
                        <h6>{{$employee->employee_id}}</h6>
                    </div>
                    <div class="col-4 text-center">
                         @php
                          $minute = $total_hour;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        <h2 id="totalHour"></h2>
                        <!-- <input type="text" name="totalHour" id="totalHour"> -->
                        <p>Total Working Hours</p>
                    </div>

                    <div class="col-4 text-center">
                         @php
                          $minute = $total_hour;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        <h2 id="shiftHour"></h2>
                        <!-- <input type="text" name="totalHour" id="totalHour"> -->
                        <p>Total Shift Hours</p>
                    </div>
                   
                   
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Login Time(24 hour format)</th>
                    <th scope="col">Logout Time(24 hour format)</th>
                    <th scope="col">Out Of Work</th>
                    <th scope="col">Working Hours</th>
                    <th scope="col">Shift Hours</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>

        </div>
    </div>

   <!-- Modal -->

            <div class="modal" id="modal" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Attendance</h5>
                     
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   
                   
                          <form action="{{ route('update_attendance') }}" method="POST" >
                              @csrf
                              <label>Employee ID : </label><label class="label-bold">{{$employee->employee_id}}</label>
                              <div>
                                 <label>Date : </label> <label  class="label-bold" id="edidate"></label>
                              </div>
                             
                              <div class="row div-margin" >  
                                  <div class="col-md-6">
                                    <label>Logout Time </label>
                                    <input class="form-control" type="datetime-local" name="logout_time">
                                  </div>
                              </div>

                              <div class="row div-margin" >
                              <label>Out of Work </label>  
                                  <div class="col-md-4">
                                      <input class="form-control" type="number" name="break" placeholder="Enter hr / min">   
                                  </div>
                                  <div class="col-md-4" >
                                    
                                    <select class="form-control form-select" name="unit">
                                          <option value="Hr">Hour(s)</option>
                                          <option value="Min">Minutes</option>
                                        </select>
                                    
                                  </div>
                              </div>
                               <input type="hidden" name="date" id="date">
                              <input type="hidden" name="id" value="{{$employee->user_id}}">

                              
                              <button class="btn btn-danger" style="margin-top: 20px">Update</button>
                              
                          </form>
                      </div>
                    </div>
                  </div>
                </div>

<!--  end Modal -->

</div>

<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    alert(start);
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

<script type="text/javascript">
$(function() {
    
    var today = <?php echo date('d');  ?>;
    var dd= today-1;
    var start = moment().subtract(dd, 'days');
    var end = moment();

 /**/

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
        var from_date = start.format('YYYY-MM-DD');
        var to_date = end.format('YYYY-MM-DD');

       document.getElementById('start_date').value=from_date
       document.getElementById('end_date').value=to_date;
        var id = document.getElementById('id').value;

        var _token = $('input[name="_token"]').val();


 fetch_data(from_date, to_date);

 function fetch_data(from_date = '', to_date = '')
 {

  $.ajax({
   url:"{{ route('fetch_attendance') }}",
   method:"POST",
   data:{from_date:from_date, to_date:to_date, _token:_token , user_id:id},
   dataType:"json",
   success:function(data)
   {

    console.log(data);
    var output = '';
    var total_hours = 0;
    var shift_working_hours = 0;
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
    {
      var dates = data[count].date ;

     output += '<tr>';
     output += '<td>' + data[count].date + '</td>';
     output += '<td>' + data[count].login_time + '</td>';
     output += '<td>' + data[count].logout_time + '</td>';
     output += '<td>' + data[count].out_of_work + '</td>';

 if(data[count].total_hours > 0){
    var num = data[count].total_hours;
    var hours = (num / 60);
    var rhours = Math.floor(hours);
    var minutes = (hours - rhours) * 60;
    var rminutes = Math.round(minutes);
    var working_hours = rhours+'Hr : '+rminutes+"Min ";
    }
    else {
       var working_hours = '0Hr : '+"0Min ";
    }
    
     output += '<td>' + working_hours + '</td>';

  if(data[count].working > 0){
    var num3 = data[count].working;
    var hours3 = (num3 / 60);
    var rhours3 = Math.floor(hours3);
    var minutes3 = (hours3 - rhours3) * 60;
    var rminutes3 = Math.round(minutes3);
    var shift_hours = rhours3+'Hr : '+rminutes3+"Min ";
    }
    else {
       var shift_hours = '0Hr : '+"0Min ";
    }
     output += '<td>' + shift_hours + '</td>';



     if(data[count].total_hours == '---'){
          data[count].total_hours = '0';
     }

    total_hours += parseInt(data[count].total_hours) ;
    if(total_hours > 0){
      var num2 = total_hours;
    var hours2 = (num2 / 60);
    var rhours2 = Math.floor(hours2);
    var minutes2 = (hours2 - rhours2) * 60;
    var rminutes2 = Math.round(minutes2);
    var working_hours2 = rhours2+'Hr : '+rminutes2+"Min ";
    }
    else {
       var working_hours2 = '0Hr : '+"0Min ";
    }

    if(data[count].working == '---'){
          data[count].working = '0';
     }

    shift_working_hours += parseInt(data[count].working) ;
    if(shift_working_hours > 0){
      var num21 = shift_working_hours;
    var hours21 = (num21 / 60);
    var rhours21 = Math.floor(hours21);
    var minutes21 = (hours21 - rhours21) * 60;
    var rminutes21 = Math.round(minutes21);
    var working_hours21 = rhours21+'Hr : '+rminutes21+"Min ";
    }
    else {
       var working_hours21 = '0Hr : '+"0Min ";
    }
    

    //$('#totalHour').val=working_hours2;


    
     output += '<td>' + '@if((Auth::user()->role_id == 1)OR (Auth::user()->role_id == 5) )<button type="button" value='+data[count].date+' id="editdate'+count+'" data-date="'+dates+'" class="btn btn-sm btn-light btn-outline-secondary" onclick="edit('+count+')">Edit</button>@endif'+'</td></tr>';
   
    }
   // alert(working_hours2);
    document.getElementById('totalHour').textContent =working_hours2;
    $('tbody').html(output);

    document.getElementById('shiftHour').textContent =working_hours21;
    $('tbody').html(output);
   }
  })
 }
     
 }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});

function edit(cnt){
  var date = document.getElementById('editdate'+cnt).value;
 // alert(date);
 document.getElementById('date').value=date;
    $(".modal-body #edidate").text(date);
    $('#modal').modal('show');
  
}
 
</script>


@endsection
