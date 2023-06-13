@extends('layouts.app')

@section('content')

@php
$xvalue=array();
$yvalue=array();
@endphp

<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<div class="container" >
    <div class="row ">
        <div >
           

        <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>
          
            
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.svg') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$todaysIndent}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Indents</h4>
                           
                        </div >
                        <label class="card-text-label ">{{date('d M Y')}} 's  Indent</label>
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black" style="background-color: #242424">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$attendance}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #fff; font-weight: bold; font-size: 25px">Attendance</h4>
                           
                        </div >
                        <label class="card-text-label" style="color:#fff">{{date('d M Y')}} 's Headcount</label>
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$tickets}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Tickets</h4>
                           
                        </div >
                        <label class="card-text-label ">{{date('d M Y')}} 's  Tickets</label>
                    </div>
                    <!--</div>-->
                </div>


              
            </div>

            <div>
                
                @if(sizeof($result)>0)  
                <label class="label-bold">Customers</label>
                <div class="row">
                  <div class="col-sm-6 col-md-6">
                    <div class="card border-white" style="height: 350px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Customer Name</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Pending Indent</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($result as $key =>$value)
                              @php
                                 
                                  $sum = 0;
                              @endphp
                           
                            <tr>  
                              <td>{{$key}}</td>
                            
                            <td>
                              <table>
                              @foreach($value as $kk => $val)
                              <tr> 
                                  <td>  {{ $kk }} </td>
                              </tr>
                              @endforeach
                            </table>
                             </td>
                             <td>
                              <table>
                              @foreach($value as $kk => $val)
                              @php 
                                 $sum += $val['0'];
                              @endphp
                              <tr> 
                                  <td>  {{ $val['0'] }} </td>
                              </tr>
                              @endforeach
                              @php 
                                if($sum > 0){
                                 $xvalue[] = $key;
                                 $yvalue[] = $sum;
                                }
                              @endphp
                            </table>
                             </td>
                            
                           @endforeach 

                          </tbody>
                        </table>
                    </div>
                    
                 </div>

                 <div class="col-sm-6 col-md-6" >
                 
                    <div class="card border-white" style="height: 350px">
                        <label>Pending Intends</label>
                         
                    <div>
                        <canvas id="myChart" ></canvas>
                    </div>
                   
                  </div>
                 
                          
                           
                 </div>
                    
                </div>
             @endif

                  
            </div>
<!-- graph -->
            <div>

              <div class="row">

                <div class="col-sm-6 col-md-6 ">

                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                             <div class="form-group">
                                <label  class="col-sm-6 control-label text-right label-bold">Over All Tickets </label>
                                <div class="col-sm-9">
                                  <div class="row mx-md-n5">
                                    <div class="col">
                                      <label >Raised : </label>
                                      <label class="label-bold">{{$counts_array['o_tickets']}}</label>
                                    </div>
                                    
                                  </div>

                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-6">

                                      <label >Closed : </label>
                                      <label class="label-bold">{{$counts_array['o_closed']}}</label>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </div>



                        <div class="col-sm-6 col-md-6">
                             <div class="form-group">
                                <label  class="control-label text-right label-bold">Current Month Tickets </label>
                                <div class="col-sm-9">
                                  <div class="row mx-md-n5">
                                    <div class="col">
                                      <label >Raised : </label>
                                      <label class="label-bold">{{$counts_array['m_tickets']}}</label>
                                    </div>
                                    
                                  </div>

                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-6">

                                      <label >Closed : </label>
                                      <label class="label-bold">{{$counts_array['m_closed']}}</label>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </div>

                      
                    </div>

                </div>

                <div class="col-sm-6 col-md-6 ">

                  <div class="row">
                        <div class="col-sm-6 col-md-6 " >
                             <div class="form-group">
                                <label  class="col-sm-6 control-label text-right label-bold">Total PettyCash </label>
                                <div class="col-sm-9">
                                  <div class="row mx-md-n5">
                                    <div class="col">
                                      <label >Issued : </label>
                                      <label class="label-bold">{{$counts_array['o_alloted']}}</label>
                                    </div>
                                    
                                  </div>

                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-9">
                                <div class="row">
                                    <div class="col">

                                      <label >Utilized : </label>
                                      <label class="label-bold">{{$counts_array['o_used']}}</label>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </div>



                        <div class="col-sm-6 col-md-6 " >
                             <div class="form-group">
                                <label  class="control-label text-right label-bold">Current Month PettyCash </label>
                                <div class="col-sm-9">
                                  <div class="row mx-md-n5">
                                    <div class="col">
                                      <label >Issued : </label>
                                      <label class="label-bold">{{$counts_array['m_alloted']}}</label>
                                    </div>
                                    
                                  </div>

                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-9">
                                <div class="row">
                                    <div class="col">

                                      <label >Utilized : </label>
                                      <label class="label-bold">{{$counts_array['m_used']}}</label>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </div>

                      
                    </div>
 
                 
                  
                </div>
                
              </div>



                <div class="row">
                 
                  <div class="col-sm-6 col-md-6 card">
                     <label style="color: black;font-weight: bold;"> {{date('M  Y')}} Tickets </label>


                      <canvas id="tickets_chart" ></canvas>
                 </div>
                 

                 <div class="col-sm-6 col-md-6" >

                  

                  <div class="wrapper card border-white" style="height: 370px">
                    <label style="color: black;font-weight: bold;">{{date('M  Y')}} PettyCash</label>

                    <canvas id="pettycash_chart" ></canvas>
                  </div>

                         
                 </div>                    
                </div>



         </div>



    </div>
</div>
</div>

<!-- PIE CHART -->
 <script>
var xValues = <?php echo json_encode($xvalue); ?>;
var yValues = <?php echo json_encode($yvalue); ?>;

var barColors = [
  "#2C2C2C",
  "#FDF2DF",
  "#E31E24"
 
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: getRandomColor(),
      borderWidth: 0, 
      data: yValues
    }]
  },
  options: {
     legend: {
        position: 'right'
      },
    title: {
      display: true
     
    }
  }
});

function getRandomColor() { //generates random colours and puts them in string
  var colors = [];
  var size = <?php echo sizeof($yvalue); ?> ;
  for (var i = 0; i < size; i++) {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var x = 0; x < 6; x++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    colors.push(color);
  }
  return colors;
}

</script>

<!-- Tickets -->
<script>

   var xValues = <?php echo $ticketArry['tickets_xValue']; ?>;
   var yValues = <?php echo $ticketArry['tickets_yValue']; ?>;
   var tickets_closed_yValue= <?php echo $ticketArry['tickets_closed_yValue']; ?>;
   
   
    new Chart("tickets_chart", {
      type: "bar",
      title:{
        text:"Chart Title",
       },
      
      data: {
        labels: xValues,

        datasets: [
        {
          label: 'Tickets raised',  
          fill: false,
          lineTension: 0,
          backgroundColor: "<?php echo 'red';  ?>",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        },
        {
          label: 'Tickets Closed',  
          fill: false,
          lineTension: 0,
          backgroundColor: "<?php echo 'green';  ?>",
          borderColor: "rgba(0,0,255,0.1)",
          data: tickets_closed_yValue
        },
       
        ]
      },
      options: {
         tooltips: {
                  mode: 'index'
                },
        legend: {display: true},
        scales: {
          yAxes: [{
            gridLines: {
             drawOnChartArea: true },

            ticks: {min: 0, max:10} ,
            scaleLabel: {
                    display: true,
                    labelString: '----- Number of Tickets -----',
                    fontColor: '#000',   }
                }],
          xAxes: [{
            barPercentage: 1.5,
             gridLines: {
             drawOnChartArea: false },
            ticks: {min: 0, max:31} ,
            scaleLabel: {
                    display: true,
                    labelString: '----- Date ----- ',
                    fontColor: '#000', }
                }],
        }
      }
    });
</script>

<!-- Pettycash -->
<script type="text/javascript">

  var ctx = document.getElementById("pettycash_chart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels:  <?php echo $ticketArry['tickets_xValue']; ?>,
    datasets: [{
      label: 'Balance Amount',
      backgroundColor: "#66ffff",
     data: <?php echo $pettycashArry['pc_balance'];  ?>,
    }, {
      label: 'Utilized Amount',
      backgroundColor: "#ff9933",
      data: <?php echo $pettycashArry['pc_used'] ; ?>,
    }],
  },
options: {
    tooltips: {
      displayColors: true,
      callbacks:{
        mode: 'x',
      },
    },
    scales: {
      xAxes: [{
        stacked: true,
        gridLines: {
          display: false,
        },
        scaleLabel: {
                    display: true,
                    labelString: '----- Date ----- ',
                    fontColor: '#000', }
      }],
      yAxes: [{
        stacked: true,
        ticks: {
          beginAtZero: true,
        },
        scaleLabel: {
                    display: true,
                    labelString: '----- Amount in Rs ----- ',
                    fontColor: '#000', },
        type: 'linear',
      }]
    },
    responsive: true,
    maintainAspectRatio: false,
    legend: { position: 'top' },
  }
});

</script>


@endsection
