@extends('layouts.app')

@section('content')

@php
$xvalue=array();
$yvalue=array();
@endphp

<div class="container" >
    <div class="row ">
       <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>      
          <div id="div2">
            <a style="margin-right: 30px" class="btn border border-secondary label-bold" href="{{route('users')}}"> {{date('d M Y')}}</a>
          </div>   
        </div>
       <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card border-white card_shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.svg') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$todaysIndent}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Indents</h4>
                           
                        </div >
                        <label class="card-text-label ">Today's Indent</label>
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black card_shadow" style="background-color: #242424">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$attendance}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #fff; font-weight: bold; font-size: 25px">Attendance</h4>
                           
                        </div >
                        <label class="card-text-label" style="color:#fff">Today's Headcount</label>
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white card_shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$tickets}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Tickets</h4>
                           
                        </div >
                        <label class="card-text-label ">Today's Tickets</label>
                    </div>
                    <!--</div>-->
                </div>
      
      </div>
 
<!-- Ticket & Pettycash data -->
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6">

           <div class="row">
              <div class="col-sm-6">
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                  <div class="card-header label-bold">Over All Tickets</div>
                  <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: red">Raised : </label>
                            <label class="label-bold">{{$counts_array['o_tickets']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #ffe6e6">Closed : </label>
                            <label class="label-bold">{{$counts_array['o_closed']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card text-white bg-white mb-3 card_shadow" style="max-width: 18rem;">
                  <div class="card-header bg-danger label-bold">Current Month Tickets</div>
                  <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: red">Raised : </label>
                            <label class="label-bold">{{$counts_array['m_tickets']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #ffe6e6">Closed : </label>
                            <label class="label-bold">{{$counts_array['m_closed']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          
        </div>

        <div class="col-md-6 col-sm-6">

          <div class="row">
              <div class="col-sm-6">
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                  <div class="card-header label-bold">Total PettyCash </div>
                  <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #00aaff">Balance  : </label>
                            <label class="label-bold">{{$counts_array['o_alloted']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #cceeff">Utilized : </label>
                            <label class="label-bold">{{$counts_array['o_used']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card border-primary mb-3 card_shadow" style="max-width: 18rem;">
                  <div class="card-header bg-info label-bold">Current Month PettyCash</div>
                  <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #00aaff">Balance  : </label>
                            <label class="label-bold">{{$counts_array['m_alloted']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label style="color: #cceeff">Utilized : </label>
                            <label class="label-bold">{{$counts_array['m_used']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          
        </div>
        
      </div>

<!-- Ticket & Pettycash Graph -->
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6 card">
             <label style="color: black;font-weight: bold;"> {{date('M  Y')}} Tickets </label>
             <canvas id="tickets_chart" ></canvas>
 
        </div>

        <div class="col-md-6 col-sm-6 card">
          <div class="wrapper " style="height: 300px">
            <label style="color: black;font-weight: bold;">{{date('M  Y')}} PettyCash</label>

            <canvas id="pettycash_chart" ></canvas>
          </div>
          
        </div>
        
      </div>
<!-- PCN & Pie chart -->
 @if(sizeof($result)>0)  
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6">
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

        <div class="col-md-6 col-sm-6">
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
          backgroundColor: "<?php echo '#ffe6e6';  ?>",
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
             drawOnChartArea: false },

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
      backgroundColor: "#00aaff",
      lineTension: 0,
     data: <?php echo $pettycashArry['pc_balance'];  ?>,
    }, {
      label: 'Utilized Amount',
      backgroundColor: "#cceeff",
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
        ticks: {
          autoSkip: false,
        },
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
          beginAtZero: false,
           autoSkip: true,
        },
        gridLines: {
          display: false,
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
