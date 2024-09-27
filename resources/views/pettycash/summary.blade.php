@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container-fluid">
	<div class="row justify-content-center">
     <div class="container-header">
      
     

     <div id="div1">
          <h4 style="font-weight: bold;">Petty Cash Summary</h4>
         <label id="div1" style="font-size: 10px;margin-left: 20px">(Approved Bills & Fund Transfer Only)</label>
        </div>
         

        <div id="div2" style="margin-right: 30px;">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View Petty Cash List</a>
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
         <label class="div-margin" style="font-weight: bolder;font-size: 25px">{{$user->name}} - {{$user->employee_id}} - </label> <label >{{$user->user->roles->alias}}</label>
       
       <!--  <div id="div2" style="margin-right: 30px">
           <label class="label-bold">Outstanding Balance : </label> <label> {{$data->balance}}</label> 
        </div> -->

         <div id="div2" style="margin-right: 30px">
        <label>Opening Balance : </label> <label id="opening" class="label-bold"></label> <label style="margin-left: 30px">  Closing Balance : </label> <label id="closing" class="label-bold"></label>
      </div>
     
         
      </div>

     

    <div class="form-build">

    	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

	    <table class="table table-striped">
	        <thead>
	        <tr>
              <th>PCS_ID</th>
	            <th>Trasnsaction Date</th>
              <th>Mode</th>
              <th>Reference No. / Bill No.</th>
	            <th>Narration</th>
              <th>Debit</th>
	            <th>Credit</th>
              <th>Entry Date</th>
              <th></th>
	           <!--  <th>Balance</th> -->
	           
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
   // alert(start);
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
    
    console.log(data['summary']);
     var openingAmt = formatNumberIndianStyle(data['opening']);
   $("#opening").html(openingAmt);
    $("#closing").html( formatNumberIndianStyle(data['closing']));
   
    var output = '';
    var bal='';
    $('#total_records').text(data.length);
    for(var count = 0; count < data['summary'].length; count++)
    {
      var dates = data['summary'][count].date ;

   // alert(dates);

     output += '<tr>';
   /*  output += '<td>' + data[count].date + '</td>';*/
     output += '<td>' + data['summary'][count].id + '</td>';
     output += '<td>' + data['summary'][count].issued_date + '</td>';
     output += '<td>'+ data['summary'][count].mode + '</td>';
     output += '<td width="300px;">'+ data['summary'][count].ref + '</td>';
     output += '<td width="300px;">' + data['summary'][count].comment + '</td>';


      var tittle = 'Created&nbsp;on&nbsp;'+data['summary'][count].created_at+'&nbsp;by&#13;'+data['summary'][count].finance_id;
     
    
     if(data['summary'][count].type == 'Debit'){
         output += '<td class="text-danger">' + formatNumberIndianStyle(data['summary'][count].amount) + '</td>';
         var tittle = 'Approved&nbsp;on&nbsp;'+data['summary'][count].created_at+'&nbsp;by&#13;'+data['summary'][count].finance_id;
     
     }
     else {
          output += '<td></td>';
     }

     if(data['summary'][count].type == 'Credit'){
         output += '<td class="text-success">' + formatNumberIndianStyle(data['summary'][count].amount) + '</td>';
         var tittle = 'Created&nbsp;on&nbsp;'+data['summary'][count].created_at+'&nbsp;by&#13;'+data['summary'][count].finance_id;
     
     }
     else {
          output += '<td></td>';
     }

     output += '<td>' + data['summary'][count].date + '</td>';
     output += '<td> <i class="fa fa-user"  title=' + tittle +'></i> </td>';
     
    
    // bal = data[count].balance;
    
    /* output += '<td>' + data[count].balance + '</td>';*/
     
     
    }
    $('tbody').html(output);
    document.getElementById('balance').innerHTML=bal;

   }
  })
 }
     
 }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        maxDate : moment(),
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

<script>
    function formatNumberIndianStyle(number) {
        let numStr = number.toString();

        // Return the number as-is if it has 3 or fewer digits
        if (numStr.length <= 3) {
            return `₹${numStr}`; 
        }

        let lastThreeDigits = numStr.slice(-3);
        let remainingDigits = numStr.slice(0, -3);

        // Format the remaining digits with commas
        if (remainingDigits !== '') {
            remainingDigits = remainingDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ",");
        }
       
        return `₹${remainingDigits + ',' + lastThreeDigits}`;

        
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        let numberCells = document.querySelectorAll('.number');
        numberCells.forEach((cell) => {
            let originalNumber = cell.textContent.trim(); // Get the original number
            let formattedNumber = formatNumberIndianStyle(originalNumber); // Format it
            cell.textContent = formattedNumber; // Update the table cell
        });
    });
</script>

@endsection