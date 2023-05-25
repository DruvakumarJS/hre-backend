@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Employee History</label>

        <div id="div2" >
            <div class="mb-3 d">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
</div>
            </div>
        </div>

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
                        <h2>{{$hour}}Hr : {{$min}}Min</h2>
                        <p>Total Working Hours</p>
                    </div>
                   
                    <div class="col-4 text-center">
                        <h1>02</h1>
                        <p>Leaves</p>
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
                    <th scope="col">Login Time</th>
                    <th scope="col">Logout Time</th>
                    <th scope="col">Working Hours</th>
                </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>

        </div>
    </div>

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

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
        var from_date = start.format('YYYY-MM-DD');
        var to_date = end.format('YYYY-MM-DD');

        var _token = $('input[name="_token"]').val();

 fetch_data(from_date, to_date);

 function fetch_data(from_date = '', to_date = '')
 {

  $.ajax({
   url:"{{ route('fetch_attendance') }}",
   method:"POST",
   data:{from_date:from_date, to_date:to_date, _token:_token},
   dataType:"json",
   success:function(data)
   {

    console.log(data);
    var output = '';
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
    {
         
     output += '<tr>';
     output += '<td>' + data[count].date + '</td>';
     output += '<td>' + data[count].login_time + '</td>';
     output += '<td>' + data[count].logout_time + '</td>';
     output += '<td>' + data[count].total_hours/60+'Hr : ' + data[count].total_hours%60+'Min'+ '</td></tr>';
    }
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
</script>


@endsection
