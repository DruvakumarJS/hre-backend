@extends('layouts.app')

@section('content')

@php
$xvalue=array();
$yvalue=array();
@endphp

<style type="text/css">
  
</style>

<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<div class="container" >
    <div class="row ">
        <div >
            <!-- <div class="c ard">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> -->

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

            
<!-- graph -->
            <div>
                

                <div class="row">
                  @if($count > 0)
                  <div class="col-sm-6 col-md-6 card">
                    <label>Tickets</label>
                      <canvas id="tickets_chart" ></canvas>
                 </div>
                  @endif

                 <div class="col-sm-6 col-md-6" >

                  @if(sizeof(json_decode($pc_given))>0)

                  <div class="wrapper card border-white" style="height: 370px">
                    <label>PettyCash</label>
                    <canvas id="myChart4" ></canvas>
                  </div>


                  @endif
                         
                 </div>                    
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
                  @if(sizeof($yvalue)>0)  
                    <div class="card border-white" style="height: 370px">
                        <label>Pending Intends</label>
                        
                      
                    <div>
                        <canvas id="myChart" ></canvas>
                    </div>
                   
                  </div>
                   @endif
                          

                           
                 </div>
                    
                </div>


                  
            </div>
            @endif


    </div>
</div>
</div>

<!-- Tickets -->
<script>

   var xValues = <?php echo $tickets_xValue; ?>;
   var yValues = <?php echo $tickets_yValue; ?>;
   var tickets_closed_yValue= <?php echo $tickets_closed_yValue; ?>;
   
   
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
        legend: {display: true},
        tooltips: {
                  mode: 'index'
                },
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

    <script type="text/javascript">
      
      var ctx = document.getElementById("myChart4").getContext('2d');

var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
   // labels: ["<  1","1 - 2","3 - 4","5 - 9","10 - 14","15 - 19","20 - 24","25 - 29","> - 29"],
    labels: <?php echo $date; ?>,
    datasets: [
     {
      
       label: 'Utilised Amount',
      backgroundColor: "#ff9933",
      //data: [12, 59, 5, 56, 58,12, 59, 87, 45],
      
        data: <?php echo $pc_used  ?>,
    },{
      label: 'Remaining Amount',
      backgroundColor: "#66ffff",
      data: <?php echo $pc_given?>,
     

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
          barPercentage: 0.2,

          scaleLabel: {
                    display: true,
                    labelString: '----- Date ----- ',
                    fontColor: '#000', }
      }],
      yAxes: [{
        stacked: true,
        gridLines: {
          display: true,
        },
        ticks: {
          beginAtZero: true,
        },

        type: 'linear',
        scaleLabel: {
                    display: true,
                    labelString: '----- Amount in Rs ----- ',
                    fontColor: '#000', }
      }]
    },
    responsive: true,
    maintainAspectRatio: false,
    legend: { position: 'top' },
  }
});
    </script>
@endsection
