@extends('layouts.app')

@section('content')

@php
$xvalue=array();
$yvalue=array();
@endphp

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
                        <label class="card-text-label ">Today's Indent</label>
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
                        <label class="card-text-label" style="color:#fff">Today's Headcount</label>
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
                        <label class="card-text-label ">Today's Tickets</label>
                    </div>
                    <!--</div>-->
                </div>


              
            </div>

            <!-- graph -->
            <div>
                

                <div class="row">
                   <div class="col-sm-6 col-md-6" >
                 
                    <div class="card border-white" style="height: 350px">
                        <label class="label-bold">PettyCash</label>             
                    <div>
                        <canvas id="pettycash" ></canvas>
                    </div>
                   
                  </div>
                  
                          
                 </div>
                  <div class="col-sm-6 col-md-6 card">
                     
                    <canvas id="tickets_chart" ></canvas>
                  
                    
                 </div>
   
                </div>


                  
            </div>
<!-- graph -->

            <div>
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
                    <div class="card border-white" style="height: 350px">
                        <label>Pending Intends</label>
                        
                      
                    <div>
                        <canvas id="myChart" ></canvas>
                    </div>
                   
                  </div>
                   @endif
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

                           
                 </div>
                    
                </div>


                  
            </div>



    </div>
</div>
</div>

<script>

           var xValues = <?php echo $tickets_xValue; ?>;
           var yValues = <?php echo $tickets_yValue; ?>;
           var tickets_closed_yValue= <?php echo $tickets_closed_yValue; ?>;
           
           
            new Chart("tickets_chart", {
              type: "bar",
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
                scales: {
                  yAxes: [{
                    ticks: {min: 0, max:50} ,
                    scaleLabel: {
                            display: true,
                            labelString: '----- Number of Tickets -----',
                            fontColor: '#000',   }
                        }],
                  xAxes: [{
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


  <script>

           var xpcValues = <?php echo $date; ?>;
           var ypcValues = <?php echo $total_given; ?>;
           var spent_yValue= <?php echo $total_used; ?>;

           
            new Chart("pettycash", {
              type: "bar",
              axisY:{
                  minimum: <?php echo '0' ?>,
                  maximum: <?php echo '20000' ?>,
                  interval: <?php echo '1000' ?>,
                },
              data: {
                labels: xpcValues,
                datasets: [
                {
                  label: 'Released Amount',  
                  fill: false,
                  lineTension: 0,
                  backgroundColor: "<?php echo 'grey';  ?>",
                  borderColor: "rgba(0,0,255,0.1)",
                  data: ypcValues
                },
                {
                  label: 'Amount Spent',  
                  fill: false,
                  lineTension: 0,
                  backgroundColor: "<?php echo 'gold';  ?>",
                  borderColor: "rgba(0,0,255,0.1)",
                  data: spent_yValue
                },
                
               
                ]
              },
              options: {
                legend: {display: true},
                scales: {
                  yAxes: [{
                    ticks: {min: 0, max:20000} ,
                    scaleLabel: {
                            display: true,
                            labelString: '----- Number of Tickets -----',
                            fontColor: '#000',   }
                        }],
                  xAxes: [{
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
@endsection