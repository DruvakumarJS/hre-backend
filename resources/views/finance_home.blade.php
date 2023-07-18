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
           
          <!--  <span id="timestamp"  class="badge badge-danger border border-secondary label-bold" style="color: black;margin-right: 30px"></span> -->
           <div  class="badge badge-danger border border-secondary label-bold" style="margin-right: 30px">
             <span style="color: black;">{{date('d M Y')}}</span>
           <span id="current-time-now" data-start="<?php echo time() ?>" style="color: black;"></span>
           </div>

          </div>   
        </div>
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white card_shadow" >
                        <div class="card-body">
                            <img src="{{ asset('images/indent.png') }}" alt="intend" style="width:30px;height: 30px;">
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
                    <div class="card border-black card_shadow" style="background-color: #5A5A5A">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$attendance}}</h2>
                        </div>
                        <div  >
                            <h4 class="card-text-black" style="color: #fff; font-weight: bold; font-size: 25px">Attendance</h4>
                           
                        </div >
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
                        <div  >
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Tickets</h4>
                           
                        </div >
                        <label class="card-text-label ">Today's Ticket</label>
                    </div>
                    <!--</div>-->
                </div>
      
      </div>

      <!-- TEST -->

      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6">
          <div class="card border border-black card_shadow">
          <div class="card-header text-white label-bold  align-items-center d-flex justify-content-center" style="background-color: #f10909;">Tickets</div>

          <div class="row justify-content-between m-2" >
            <div class="col-md-5 div-margin " style="border:2px solid #f0c6c3; ">
              <div class="text-black label-bold align-items-center d-flex justify-content-center">Overall</div>

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

            <div class="col-md-5 div-margin"  style="border:2px solid #f0c6c3; ">
              <div class="text-black label-bold align-items-center d-flex justify-content-center">Current Month - MTD</div>
              <div class="card-body text-black">
            
                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Raised</label>
                             <label style="margin-left: 10px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['m_tickets']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-9">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Closed </label>
                             <label style="margin-left: 8px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['m_closed']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
              
            </div>

            
          </div></div>
          
        </div>

        <div class="col-md-6 col-sm-6">
           <div class="card border border-black card_shadow">

          <div class="card-header text-white label-bold align-items-center d-flex justify-content-center" style="background-color: #5A5A5A">Petty Cash</div>

          <div class="row justify-content-between m-2" >
            <div class="col-md-5 div-margin"  style="border:2px solid #eeeeee; ">
             
               <div class="text-black label-bold align-items-center d-flex justify-content-center">Overall</div>
             
              <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-12">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Issued  </label>
                             <label style="margin-left: 35px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_alloted']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-12">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Approved </label>
                             <label style="margin-left: 13px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['o_used']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
              
            </div>

            <div class="col-md-5 div-margin"  style="border:2px solid #eeeeee; ">
              
            <div class="text-black label-bold align-items-center d-flex justify-content-center">Current Month - MTD</div>
             
              <div class="card-body text-black">
                    <div class="form-group">            
                      <div class="col-sm-12">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold">Issued   </label>
                            <label style="margin-left: 35px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['m_alloted']}}</label>
                          </div>
                          
                        </div>

                      </div>
                    </div>

                    <div class="form-group">            
                      <div class="col-sm-12">
                        <div class="row mx-md-n5">
                          <div class="col">
                            <label class="label-bold" >Approved  </label>
                            <label style="margin-left: 13px"> : </label>
                            <label style="margin-left: 10px">{{$counts_array['m_used']}}</label>
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


<!-- TEST -->

<!-- Ticket & Pettycash Graph -->
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6" >
          <div class="card">
             <label style="color: black;font-weight: bold;"> Tickets </label>
             <canvas id="tickets_chart" ></canvas>
          </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="card">     
            <label style="color: black;font-weight: bold;"> PettyCash</label>
            <canvas id="pettycash_chart" ></canvas>
        </div>
          
        </div>
        
      </div>
 
 <!-- PCN & Pie chart -->
 @if(sizeof($result)>0)  
      <div class="row justify-content-between div-margin">
        <div class="col-md-6 col-sm-6">
          <div class="card border-white scroll tableFixHead" style="height: 350px;padding: 0px 5px 20px 20px">

                        <table class="table" >
                          <thead>
                            <tr>
                              <th scope="col">Billing Name</th>
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
               <label class="label-bold">Pending Intends</label>
                         
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
Chart.defaults.global.defaultFontStyle = 'bold';
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
        position: 'right',
        labels: {
              fontSize: 8
        },
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

<!-- Pettycash -->
<script>

   var date = <?php echo $pettycashArry['date']; ?>;
   var issued = <?php echo $pettycashArry['total_issued']; ?>;
   var approved= <?php echo $pettycashArry['total_utilised']; ?>;
   Chart.defaults.global.defaultFontStyle = 'bold';

   
    new Chart("pettycash_chart", {
      type: "line",
      title:{
        text:"Chart Title",
       },
      
      data: {
        labels: date,

        datasets: [
        {
          label: 'Issued Amount',  
          fill: false,
          lineTension: 0,
          /*backgroundColor: "<?php echo '#5A5A5A' ;  ?>",
          borderColor: "rgba(0,0,255,0.1)",*/
          backgroundColor: "<?php echo '#5A5A5A' ;  ?>",
          borderColor: "<?php echo '#5A5A5A' ;  ?>",
          data: issued
        },
        {
          label: 'Approved Amount',  
          fill: false,
          lineTension: 0,
          /*backgroundColor: "<?php echo '#eeeeee';  ?>",
          borderColor: "rgba(0,0,255,0.1)",*/
          backgroundColor: "<?php echo '#bebebe' ;  ?>",
          borderColor: "<?php echo '#bebebe' ;  ?>",
          data: approved
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
             ticks: {min: 0} ,
          
            scaleLabel: {
                    display: true,
                    labelString: 'Amount in Rs.',
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


@endsection
