@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row ">
        <div >
           
        <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>

            <div id="div2">
             <div class="badge badge-danger border border-secondary label-bold" style="margin-right: 30px">
             <span style="color: black;">{{date('d M Y')}}</span>
           <span id="current-time-now" data-start="<?php echo time() ?>" style="color: black;"></span>
           </div>
          </div> 
           
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white card_shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.png') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$todaysIndent}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Received Indent</h4>
                            
                        </div>
                        <label class="card-text-label ">Today's Indent</label>
                       
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black" style="background-color: #5A5A5A">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$attendance}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;color: #fff">Attendance</h4>
                           
                        </div>
                         <label class="card-text-label" style="color:#fff">Today's Head Count</label>
                        
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white card_shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$tickets}}</h2>
                        </div>
                        <div>
                           <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Tickets</h4>
                            
                        </div>
                        <label class="card-text-label">Today's Ticket</label>
                        
                        
                    </div>
                   
                </div>


              
            </div>

            <!-- Ticket & Pettycash Graph -->
    <!--   <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6" >
          <div class="card h-90">
             <label style="color: black;font-weight: bold;"> Tickets </label>
             <canvas id="tickets_chart" ></canvas>
          </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="row h-100">
            <div class="col-md-6 col-sm-6">
          <div class="">
          

          <div class=" justify-content-between m-2" >
            <div class="card border border-black card_shadow">
               <div class="card-header text-white label-bold  align-items-center d-flex justify-content-center" style="background-color: #f10909;">Overall Tickets</div>
            <div class="" >
              
              <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Raised </label>
                            <label style="margin-left: 10px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_tickets']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Closed  </label>
                             <label style="margin-left: 8px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_closed']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
              </div>
              
            </div>
            </div>
            <div class="card border border-black card_shadow">
               <div class="card-header text-white label-bold  align-items-center d-flex justify-content-center" style="background-color: #f10909;">Current Month-MTD Tickets</div>
               <div class="" >
              
              <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Raised </label>
                            <label style="margin-left: 10px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_tickets']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Closed  </label>
                             <label style="margin-left: 8px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_closed']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
              </div>
            </div>

          

            
          </div></div>
          
        </div>
        </div>
          
        </div>
        
      </div>
 -->
            <div>
                <label class="label-bold">Recent Indent</label>

                <div class="row">
                  <div class="col-sm-6 col-md-12">
                    <div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                             <th scope="col">Date</th>
                              <th scope="col">Indend Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                              
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                            <tr>  
                                 <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td>  
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                
                            </tr>
                            @endforeach
     
                          </tbody>
                        </table>
                        
                    </div>
                   
                 </div>

                
                    
                </div>
            </div>



    </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var freshTime = new Date(parseInt($("#current-time-now").attr("data-start"))*1000);
    //loop to tick clock every second
    var func = function myFunc() {
        //set text of clock to show current time
        $("#current-time-now").text(freshTime.toLocaleTimeString());
        //add a second to freshtime var
        freshTime.setSeconds(freshTime.getSeconds() + 1);
        //wait for 1 second and go again
        setTimeout(myFunc, 1000);
    };
    func();
});


</script>

<!-- Tickets -->
<script>

   var xValues = <?php echo $ticketArry['tickets_xValue']; ?>;
   var yValues = <?php echo $ticketArry['tickets_yValue']; ?>;
   var tickets_closed_yValue= <?php echo $ticketArry['tickets_closed_yValue']; ?>;
   Chart.defaults.global.defaultFontStyle = 'bold';

   
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
          backgroundColor: "<?php echo '#f10909' ;  ?>",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        },
        {
          label: 'Tickets Closed',  
          fill: false,
          lineTension: 0,
          backgroundColor: "<?php echo '#f0c6c3';  ?>",
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
          pointLabels :{
           fontStyle: "bold",
            },
          yAxes: [{
            gridLines: {
             drawOnChartArea: false },

            ticks: {min: 0 , max:20} ,
            scaleLabel: {
                    display: true,
                    labelString: 'Number of Tickets',
                    fontColor: '#000',   }
                }],
          xAxes: [{
            barPercentage: 1.5,
             gridLines: {
             drawOnChartArea: false },
            ticks: {min: 0, max:31 ,autoSkip: false} ,
            scaleLabel: {
                    display: true,
                    labelString: '<?php echo date('M  Y');?>',
                    fontColor: '#000', }
                }],
        }
      }
    });
</script>
@endsection
