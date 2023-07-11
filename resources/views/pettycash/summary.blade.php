@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
     <div class="container-header">
      
     

     <div id="div1">
          <h4 style="font-weight: bold;">Petty Cash Summary</h4>
         <label id="div1" style="font-size: 10px;margin-left: 20px">(Approved Bills & Fund Transfer Only)</label>
        </div>
         

        <div id="div2" style="margin-right: 30px;">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View PettyCash List</a>
        </div>

        <div  id="div2" style="margin-right: 30px" >
            <div class="mb-3 d">
              <input type="hidden" name="id" id="id" value="{{$id}}">
              
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar" max="<?php echo date('Y-m-d');  ?>"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>

        <form method="POST" action="{{route('export_summary')}}">
          @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
            <input type="hidden" name="start_date" id="start_date">
            <input type="hidden" name="end_date" id="end_date" >

            <div id="div3" style="margin-right: 30px">
                <button type="submit" class="btn btn-light btn-outline-secondary" > Download CSV</button>
            </div>
          
        </form>

      </div>


      <div>
         <label class="div-margin" style="font-weight: bolder;font-size: 25px">{{$user->name}}</label> <label >{{$user->user->roles->alias}}</label>
      </div>
    
    <div class="form-build">

    	<div class="card">

	    <table class="table table-striped">
	        <thead>
	        <tr>
              <th>Date</th>
	            <th>Trasnsaction Date</th>
              <th>Mode</th>
              <th>Reference No.</th>
	            <th>Description</th>
	            <th>Credit</th>
	            <th>Debit</th>
	            <th>Balance</th>
	           
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
   url:"{{ route('fetch_summary') }}",
   method:"POST",
   data:{from_date:from_date, to_date:to_date, _token:_token , id:id},
   dataType:"json",
   success:function(data)
   {
    
    console.log(data);
    var output = '';
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
    {
      var dates = data[count].date ;

     output += '<tr>';
     output += '<td>' + data[count].date + '</td>';
     output += '<td>' + data[count].issued_date + '</td>';
     output += '<td>'+ data[count].mode + '</td>';
     output += '<td>'+ data[count].ref + '</td>';
     output += '<td>' + data[count].comment + '</td>';
    
     if(data[count].type == 'Credit'){
         output += '<td>' + data[count].amount + '</td>';
     }
     else {
          output += '<td></td>';
     }

     if(data[count].type == 'Debit'){
         output += '<td>' + data[count].amount + '</td>';
     }
     else {
          output += '<td></td>';
     }
     
    
     output += '<td>' + data[count].balance + '</td>';
    
     
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