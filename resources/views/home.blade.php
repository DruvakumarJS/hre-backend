@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
        <div >
            <!-- <div class="card">
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
            <label id="div1">Dashboard</label>
           <div id="div2">
            <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create User</button>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create Customer</button>
          </div>

            
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.svg') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">34</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Today's Intend</h4>
                           
                        </div >
                        <label class="card-text-label ">No. of intend created today</label>
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black" style="background-color: #242424">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">54</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #fff; font-weight: bold; font-size: 25px">Attendance</h4>
                           
                        </div >
                        <label class="card-text-label" style="color:#fff">Today's working</label>
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">12</h2>
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
                              <th scope="col">Pending Intend</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>Prestige Apartment</td>
                              <td>PCN885</td>
                              <td>39</td>
                            </tr>
                            <tr>    
                              <td>Arathi Interior</td>
                              <td>PCN886</td>
                              <td>42</td>
                            </tr>
                            <tr>
                              <td>Brigade</td>
                              <td>PCN887</td>
                              <td>12</td>
                            </tr>
                            <tr>  
                              <td>Prestige Apartment</td>
                              <td>PCN885</td>
                              <td>55</td>
                            </tr>
                            <tr>    
                              <td>Arathi Interior</td>
                              <td>PCN886</td>
                              <td>39</td>
                            </tr>
                            <tr>
                              <td>Brigade</td>
                              <td>PCN887</td>
                              <td>25</td>
                            </tr>
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
                            var yValues = [49,25,70];
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
@endsection
