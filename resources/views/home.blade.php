@extends('layouts.app')

@section('content')

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
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Today's Indent</h4>
                           
                        </div >
                        <label class="card-text-label ">No. of indent created today</label>
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
                        <label class="card-text-label" style="color:#fff">Today working</label>
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
                        <label class="card-text-label ">Pending Tickets</label>
                    </div>
                    <!--</div>-->
                </div>


              
            </div>

            <div>
                <label>Customers</label>

                <div class="row">
                  <div class="col-sm-6 col-md-9">
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
                            @foreach($Pcn as $key =>$value)
                            <tr>  
                              <td>{{$value->client_name}}</td>
                              <td>{{$value->pcn}}</td>
                              <td>39</td>
                            </tr>
                           @endforeach 
                          </tbody>
                        </table>
                        
                    </div>
                    <!--</div>-->
                 </div>

                 <div class="col-sm-6 col-md-3" >
                    <div class="card border-white" style="height: 350px">
                        <label>Pending Intends</label>
                        
                        
                    <div>
                        <canvas id="myChart" style="height: 200px ; width: 200px" ></canvas>
                    </div>
                  </div>
                           <script>
                            var xValues = ["Arathi", "Brigade" ,"Prestige"];
                            var yValues = [99,98,90];
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
                                  backgroundColor: barColors,
                                  borderWidth: 0, 
                                  data: yValues
                                }]
                              },
                              options: {
                                title: {
                                  display: true
                                 
                                }
                              }
                            });
                            </script>

                           
                 </div>
                    
                </div>
            </div>



    </div>
</div>
</div>
@endsection
